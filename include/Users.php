<?php

namespace App;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Users
{
    private static ?self $instance = null;
    public string $hostname;
    public string $username;
    public string $password;
    public string $dbName;
    private PDO $dbh;
    private ?string $sid = null;
    private ?int $uid = null;

    public function __construct()
    {
        // Загружаем .env из корня проекта (предполагается, что /include - вторая вложенность)
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->safeLoad(); // Лучше safeLoad() — не бросает ошибку, если .env не найден

        $defaultHost = ($_ENV['APP_ENV'] ?? '') === 'docker' ? 'db' : '127.0.0.1';
        $this->hostname = $_ENV['MYSQL_HOST'] ?? $defaultHost;
        $this->username = $_ENV['MYSQL_USER'];
        $this->password = $_ENV['MYSQL_PASSWORD'];
        $this->dbName = $_ENV['MYSQL_DATABASE'];

        $dsn = "mysql:host={$this->hostname};dbname={$this->dbName};charset=utf8mb4";

        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => true,
        ];

        try {
            $this->dbh = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            die("DB connection failed: " . $e->getMessage());
        }

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->sid = null;
        $this->uid = null;
    }

    public static function Instance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // Очистка неиспользуемых сессий (старше 15 мин)
    public function ClearSessions()
    {
        $min = date('Y-m-d H:i:s', time() - 60 * 15);
        $sql = "DELETE FROM sessions WHERE time_last < :time_last";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(['time_last' => $min]);
        return $stmt->rowCount();
    }

    // Авторизация
    public function Login($login, $password, $remember = true)
    {
        $user = $this->GetByLogin($login);
        if (!$user) {
            return false;
        }

        if ($user['password'] !== md5($password)) {
            return false;
        }

        if ($remember) {
            $expire = time() + 3600 * 24 * 100;
            setcookie('login', $login, $expire, "/");
            setcookie('password', md5($password), $expire, "/");
        }

        $this->sid = $this->OpenSession((int)$user['id_user']);
        return true;
    }

    public function GetByLogin($login)
    {
        $sql = "SELECT * FROM users WHERE login = :login";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    private function OpenSession(int $id_user)
    {
        $sid = $this->GenerateStr(10);
        $now = date('Y-m-d H:i:s');

        $sql = "INSERT INTO sessions (id_user, sid, time_start, time_last, online) VALUES (:id_user, :sid, :now, :now, 'online')";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            'id_user' => $id_user,
            'sid' => $sid,
            'now' => $now,
        ]);

        $_SESSION['sid'] = $sid;
        return $sid;
    }

    // Получение пользователя по id_user, если null — по текущему

    private function GenerateStr($length = 10)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;
        for ($i = 0; $i < $length; $i++) {
            $code .= $chars[random_int(0, $clen)];
        }
        return $code;
    }

    public function Logout()
    {
        setcookie('login', '', time() - 3600, "/");
        setcookie('password', '', time() - 3600, "/");
        unset($_COOKIE['login'], $_COOKIE['password'], $_SESSION['sid']);
        $this->sid = null;
        $this->uid = null;
    }

    public function Get($id_user = null)
    {
        if ($id_user === null) {
            $id_user = $this->GetUid();
        }
        if ($id_user === null) {
            return null;
        }

        $sql = "SELECT * FROM users WHERE id_user = :id_user";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(['id_user' => $id_user]);
        $user = $stmt->fetch();
        return $user ?: null;
    }

    public function GetUid()
    {
        if ($this->uid !== null) {
            return $this->uid;
        }

        $sid = $this->GetSid();
        if ($sid === null) {
            return null;
        }

        $sql = "SELECT id_user FROM sessions WHERE sid = :sid";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(['sid' => $sid]);
        $result = $stmt->fetch();

        if (!$result) {
            return null;
        }

        $this->uid = (int)$result['id_user'];
        return $this->uid;
    }

    private function GetSid()
    {
        if ($this->sid !== null) {
            return $this->sid;
        }

        $sid = $_SESSION['sid'] ?? null;

        if ($sid !== null) {
            $now = date('Y-m-d H:i:s');
            $sql = "UPDATE sessions SET time_last = :now WHERE sid = :sid";
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute(['now' => $now, 'sid' => $sid]);

            if ($stmt->rowCount() === 0) {
                // Сессии нет — проверяем, есть ли вообще
                $sqlCheck = "SELECT COUNT(*) AS cnt FROM sessions WHERE sid = :sid";
                $stmtCheck = $this->dbh->prepare($sqlCheck);
                $stmtCheck->execute(['sid' => $sid]);
                $count = $stmtCheck->fetchColumn();
                if ($count == 0) {
                    $sid = null;
                }
            }
        }

        if ($sid === null && isset($_COOKIE['login'], $_COOKIE['password'])) {
            $user = $this->GetByLogin($_COOKIE['login']);
            if ($user && $user['password'] === $_COOKIE['password']) {
                $sid = $this->OpenSession((int)$user['id_user']);
            }
        }

        $this->sid = $sid;
        return $sid;
    }

    // Возвращает список всех пользователей (метод Loging в исходном коде)
    // Возвращает PDOStatement или false
    public function Loging($id_user)
    {
        $sql = "SELECT * FROM users WHERE id_user <> :id_user";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(['id_user' => $id_user]);
        return $stmt;
    }

    // Проверка существования логина (GetLogin)
    // Возвращает массив с count
    public function GetLogin($login)
    {
        $sql = "SELECT COUNT(*) AS count FROM users WHERE login = :login";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(['login' => $login]);
        return $stmt->fetch();
    }

    // Метод Can — возвращает сессии сгруппированные по пользователям (твой старый код)
    public function Can($id_user = null)
    {
        $sql = "SELECT COUNT(*) AS count, id_user FROM sessions GROUP BY id_user ORDER BY id_user";
        $stmt = $this->dbh->query($sql)->fetchAll();
        return $stmt;
    }

    // Возвращает пользователей онлайн, кроме текущего
    public function IsOnline($id_user = null)
    {
        if ($id_user === null) {
            $id_user = $this->GetUid();
        }
        if ($id_user === null) {
            return [];
        }

        $sql = "SELECT n.id_user, c.id_user, c.login, c.avatar, c.name
                FROM sessions n
                INNER JOIN users c ON n.id_user = c.id_user
                WHERE n.id_user <> :id_user
                GROUP BY n.id_user
                ORDER BY n.id_user";

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(['id_user' => $id_user]);
        return $stmt->fetchAll();
    }

    // Сообщения, адресованные пользователю
    public function Message($id_user = null)
    {
        if ($id_user === null) {
            $id_user = $this->GetUid();
        }
        if ($id_user === null) {
            return null;
        }

        $sql = "SELECT * FROM messages, users WHERE id_user_take = :id_user AND id_user = id_user_send ORDER BY id_message DESC";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(['id_user' => $id_user]);
        return $stmt;
    }

    // Сообщения, отправленные пользователем
    public function Message2($id_user = null)
    {
        if ($id_user === null) {
            $id_user = $this->GetUid();
        }
        if ($id_user === null) {
            return null;
        }

        $sql = "SELECT * FROM messages, users WHERE id_user_send = :id_user AND id_user = id_user_take ORDER BY id_message DESC";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(['id_user' => $id_user]);
        return $stmt;
    }

    // Кол-во сообщений для пользователя
    public function message_count($id_user = null)
    {
        if ($id_user === null) {
            $id_user = $this->GetUid();
        }

        $sql = "SELECT DISTINCT COUNT(id_user_take) AS count FROM messages, users WHERE id_user_take = :id_user AND id_user = :id_user";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(['id_user' => $id_user]);
        return $stmt;
    }

    // Получить сообщение по id_message
    public function message_select($id_message)
    {
        $sql = "SELECT * FROM messages, users WHERE id_message = :id_message AND id_user = id_user_send";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(['id_message' => $id_message]);
        return $stmt;
    }

    // Удалить сообщение по id_message
    public function message_delete($id_message)
    {
        $sql = "DELETE FROM messages WHERE id_message = :id_message";
        $stmt = $this->dbh->prepare($sql);
        return $stmt->execute(['id_message' => $id_message]);
    }

    // Вставить сообщение
    public function message_insert($id_user_send, $id_user_take, $content, $title, $send_count, $take_count)
    {
        $date = date('Y-m-d H:i:s');
        $sql = "INSERT INTO messages (id_user_send, id_user_take, date, content, title, send_count, take_count)
                VALUES (:id_user_send, :id_user_take, :date, :content, :title, :send_count, :take_count)";
        $stmt = $this->dbh->prepare($sql);
        return $stmt->execute([
            'id_user_send' => $id_user_send,
            'id_user_take' => $id_user_take,
            'date' => $date,
            'content' => $content,
            'title' => $title,
            'send_count' => $send_count,
            'take_count' => $take_count,
        ]);
    }

    // Вставить пользователя
    public function user_insert($login, $password, $name)
    {
        $avatar = "3.jpg";
        $sql = "INSERT INTO users (login, password, name, avatar) VALUES (:login, :password, :name, :avatar)";
        $stmt = $this->dbh->prepare($sql);
        return $stmt->execute([
            'login' => $login,
            'password' => $password,
            'name' => $name,
            'avatar' => $avatar,
        ]);
    }
}
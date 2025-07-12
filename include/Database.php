<?php

namespace App;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Database
{
    private string $hostname;
    private string $username;
    private string $password;
    private string $dbName;

    private ?PDO $dbh = null;

    public function __construct()
    {
        // Загружаем .env из корня проекта
        $dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->safeLoad(); // Лучше safeLoad() — не бросает ошибку, если .env не найден

        $defaultHost = ($_ENV['APP_ENV'] ?? '') === 'docker' ? 'db' : '127.0.0.1';
        $this->hostname = $_ENV['MYSQL_HOST'] ?? $defaultHost;
        $this->username = $_ENV['MYSQL_USER'];
        $this->password = $_ENV['MYSQL_PASSWORD'];
        $this->dbName = $_ENV['MYSQL_DATABASE'];
    }

    public function forums_select()
    {
        try {
            $sql = 'SELECT * FROM forums WHERE parent_forum_id = 0';
            return $this->getConnection()->query($sql)->fetchAll();
        } catch (PDOException $e) {
            return []; // Возвращаем пустой массив вместо текста ошибки
        }
    }

    private function getConnection(): PDO
    {
        if ($this->dbh === null) {
            try {
                $dsn = "mysql:host={$this->hostname};dbname={$this->dbName};charset=utf8";
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
                ];
                $this->dbh = new PDO($dsn, $this->username, $this->password, $options);
            } catch (PDOException $e) {
                // Здесь можно логировать ошибку, но для совместимости возвращаем её в методы
                throw $e;
            }
        }
        return $this->dbh;
    }

    public function forums_select_podforum($id_parent)
    {
        try {
            $sql = "SELECT * FROM forums WHERE parent_forum_id = :id_parent";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([':id_parent' => $id_parent]);
            return $stmt;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function forums_select_forum($id_forums)
    {
        try {
            $sql = "SELECT * FROM forums WHERE id_forums = :id_forums";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([':id_forums' => $id_forums]);
            return $stmt;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function thread_select($forum_id, $start, $num)
    {
        try {
            $sql = "SELECT * FROM forum_threads, users WHERE forum_id = :forum_id AND id_user = author_user_id ORDER BY priority ASC, date DESC, last_post DESC LIMIT :start, :num";
            $stmt = $this->getConnection()->prepare($sql);
            // PDO не позволяет напрямую bindParam для LIMIT с именованными параметрами, поэтому приводим к int
            $stmt->bindValue(':forum_id', $forum_id, PDO::PARAM_INT);
            $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
            $stmt->bindValue(':num', (int)$num, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function thread_select_thread($id_threads)
    {
        try {
            $sql = "SELECT * FROM forum_threads WHERE id_thread = :id_threads";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([':id_threads' => $id_threads]);
            return $stmt;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function post_select($thread_id, $start, $num)
    {
        try {
            $sql = "SELECT * FROM forum_posts, forum_threads, users WHERE forum_thread_id = :thread_id AND id_thread = :thread_id2 AND id_user = user_id ORDER BY post_date ASC LIMIT :start, :num";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bindValue(':thread_id', $thread_id, PDO::PARAM_INT);
            $stmt->bindValue(':thread_id2', $thread_id, PDO::PARAM_INT);
            $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
            $stmt->bindValue(':num', (int)$num, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function post_select_last($forum_id)
    {
        try {
            $sql = "SELECT * FROM forum_posts, forum_threads, users WHERE forum_id = :forum_id ORDER BY post_date DESC, id_thread DESC";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([':forum_id' => $forum_id]);
            return $stmt;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function post_count($thread_id)
    {
        try {
            $sql = "SELECT COUNT(*) AS count FROM forum_posts WHERE forum_thread_id = $thread_id";
            return $this->dbh->query($sql)->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function post_select_post($id_posts)
    {
        try {
            $sql = "SELECT * FROM forum_posts WHERE id_posts = :id_posts";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([':id_posts' => $id_posts]);
            return $stmt;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function count_table($forum_id)
    {
        try {
            $sql = "SELECT COUNT(forum_id) FROM forum_threads WHERE forum_id = :forum_id";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([':forum_id' => $forum_id]);
            return $stmt;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function forum_delete($id_forum)
    {
        try {
            $sql = "DELETE t1, t2, t3 FROM forums AS t1 LEFT JOIN forum_threads AS t2 ON t1.id_forums = t2.forum_id LEFT JOIN forum_posts AS t3 ON t2.forum_id = t3.forum_thread_id WHERE t1.id_forums = :id_forum";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([':id_forum' => $id_forum]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function thread_delete($id_thread)
    {
        try {
            $sql = "DELETE t1, t2 FROM forum_threads AS t1 LEFT JOIN forum_posts AS t2 ON t1.id_thread = t2.forum_thread_id WHERE t1.id_thread = :id_thread";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([':id_thread' => $id_thread]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function thread_select_count($id_thread)
    {
        try {
            $sql = "SELECT COUNT(forum_thread_id) FROM forum_threads, forum_posts WHERE id_thread = forum_thread_id AND id_thread = :id_thread";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([':id_thread' => $id_thread]);
            return $stmt;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function post_delete($id_post)
    {
        try {
            $sql = "DELETE FROM forum_posts WHERE id_posts = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([$id_post]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function forum_update($id_forums, $forum_name, $description)
    {
        try {
            $sql = "UPDATE forums SET forum_name = ?, description = ? WHERE id_forums = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([$forum_name, $description, $id_forums]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function forum_update_last($id_last_author, $last_author, $id_thread)
    {
        try {
            $last_post = date('Y-m-d H:i:s');
            $sql = "UPDATE forum_threads SET posts_quantity=posts_quantity+1, id_last_author=?, last_author=?, last_post=? WHERE id_thread = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([$id_last_author, $last_author, $last_post, $id_thread]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function forum_update_lastm($id_last_author, $last_author, $id_thread)
    {
        try {
            $last_post = date('Y-m-d H:i:s');
            $sql = "UPDATE forum_threads SET id_last_author=?, last_author=?, last_post=? WHERE id_thread = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([$id_last_author, $last_author, $last_post, $id_thread]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function forum_update_last2($id_last_author, $last_author, $id_forum, $id_thread)
    {
        try {
            $last_post = date('Y-m-d H:i:s');
            $sql = "UPDATE forums SET posts_quantity=posts_quantity+1, id_last_author=?, last_author=?, last_post=?, id_thread_last=? WHERE id_forums = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([$id_last_author, $last_author, $last_post, $id_thread, $id_forum]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function forum_update_lastm2($id_last_author, $last_author, $id_forum)
    {
        try {
            $last_post = date('Y-m-d H:i:s');
            $sql = "UPDATE forums SET id_last_author=?, last_author=?, last_post=? WHERE id_forums = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([$id_last_author, $last_author, $last_post, $id_forum]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function forum_update_lastmm2($id_last_author, $last_author, $id_forum, $c)
    {
        try {
            $last_post = date('Y-m-d H:i:s');
            $sql = "UPDATE forums SET posts_quantity=posts_quantity-?, id_last_author=?, last_author=?, last_post=? WHERE id_forums = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([$c, $id_last_author, $last_author, $last_post, $id_forum]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function forum_insert($parent_id, $forum_name, $id_last_author, $last_author, $description)
    {
        try {
            $last_post = date('Y-m-d H:i:s');
            $sql = "INSERT INTO forums (parent_forum_id, forum_name, id_last_author, last_author, last_post, description) VALUES (:parent_forum_id, :forum_name, :id_last_author, :last_author, :last_post, :description)";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([
                ':parent_forum_id' => $parent_id,
                ':forum_name' => $forum_name,
                ':id_last_author' => $id_last_author,
                ':last_author' => $last_author,
                ':last_post' => $last_post,
                ':description' => $description,
            ]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function posts_insert($forum_thread_id, $header, $user_id, $post_text)
    {
        try {
            $post_date = date('Y-m-d H:i:s');
            $sql = "INSERT INTO forum_posts (forum_thread_id, header, post_date, user_id, post_text) VALUES (:forum_thread_id, :header, :post_date, :user_id, :post_text)";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([
                ':forum_thread_id' => $forum_thread_id,
                ':header' => $header,
                ':post_date' => $post_date,
                ':user_id' => $user_id,
                ':post_text' => $post_text,
            ]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function thread_insert(
        $forum_id,
        $thread_name,
        $description,
        $title,
        $text,
        $user,
        $id_last_author,
        $last_author,
    ) {
        try {
            $date = date('Y-m-d H:i:s');
            $sql = "INSERT INTO forum_threads (forum_id, thread_name, title, text, date, author_user_id, id_last_author, last_author, last_post, description)
                    VALUES (:forum_id, :thread_name, :title, :text, :date, :author_user_id, :id_last_author, :last_author, :last_post, :description)";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([
                ':forum_id' => $forum_id,
                ':thread_name' => $thread_name,
                ':title' => $title,
                ':text' => $text,
                ':date' => $date,
                ':author_user_id' => $user,
                ':id_last_author' => $id_last_author,
                ':last_author' => $last_author,
                ':last_post' => $date,
                ':description' => $description,
            ]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function thread_update($id_threads, $thread_name, $description, $title, $text)
    {
        try {
            $date = date('Y-m-d H:i:s');
            $sql = "UPDATE forum_threads SET thread_name = ?, title = ?, text = ?, date = ?, description = ? WHERE id_thread = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([$thread_name, $title, $text, $date, $description, $id_threads]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function post_update($id_posts, $post_text)
    {
        try {
            $post_date = date('Y-m-d H:i:s');
            $sql = "UPDATE forum_posts SET post_date = ?, post_text = ? WHERE id_posts = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([$post_date, $post_text, $id_posts]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function forum_update_stat($id_forums)
    {
        try {
            $sql = "UPDATE forums SET threads_quantity = threads_quantity + 1 WHERE id_forums = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([$id_forums]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function post_update_stat2($id_threads)
    {
        try {
            $sql = "UPDATE forum_threads SET posts_quantity = posts_quantity - 1 WHERE id_thread = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([$id_threads]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function view_count($id_threads)
    {
        try {
            $sql = "UPDATE forum_threads SET hits_quantity = hits_quantity + 1 WHERE id_thread = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([$id_threads]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function post_update_stat3($id_forums)
    {
        try {
            $sql = "UPDATE forums SET posts_quantity = posts_quantity - 1 WHERE id_forums = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([$id_forums]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function forum_update_statdel($id_forums)
    {
        try {
            $sql = "UPDATE forums SET threads_quantity = threads_quantity - 1 WHERE id_forums = ?";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->execute([$id_forums]);
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
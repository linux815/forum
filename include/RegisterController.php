<?php

namespace App;

class RegisterController extends BaseController
{
    private string $titl = '';
    private string $text = '';
    private string $error = '';

    protected function OnInput(): void
    {
        parent::OnInput();

        $this->title .= ' :: Регистрация';

        $mUsers = Users::Instance();
        $mUsers->ClearSessions();

        if ($_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
            $login = $mUsers->GetLogin($_POST['name_post']);

            if (!empty($login[0])) {
                echo "Такой email уже существует! Введите другой.";
                exit;
            }

            if (!preg_match("/^[\\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $_POST['name_post'])) {
                echo "<p class='otvet'>Email введен не правильно! Повторите попытку..</p>";
                exit;
            }

            if (empty($_POST['fam'])) {
                echo "Введите отображаемое имя";
                exit;
            }

            if (empty($_POST['name_post']) || empty($_POST['fam']) || empty($_POST['pass']) || empty($_POST['repass'])) {
                echo "Ошибка. Заполните все поля в \"Персональных данных\"";
                exit;
            }

            if ($_POST['pass'] !== $_POST['repass']) {
                echo "Ошибка. Пароли не совпадают!";
                exit;
            }

            $email = $_POST['name_post'];
            $password = $_POST['pass'];
            $name = $_POST['fam'];
            $hash = md5($password); // желательно заменить на password_hash()

            $mUsers->user_insert($email, $hash, $name);

            echo "<p class='otvet'>Регистрация успешно завершена!<br />
            Email: {$email}<br />
            Пароль: {$password}<br />
            Запомните ваш логин и пароль.<br />
            <a href='index.php?c=auth'>Войти</a>
            </p>";

            exit;
        }
    }

    protected function OnOutput(): void
    {
        $vars = [
            'id_article' => $this->id_article ?? null,
            'text' => $this->text,
            'error' => $this->error,
            'titl' => $this->titl,
        ];

        $this->content = $this->Template('templates/v_register.php', $vars);
        parent::OnOutput();
    }
}
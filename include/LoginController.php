<?php

namespace App;

class LoginController extends BaseController
{
    private string $titl = '';
    private string $text = '';
    private string $error = '';

    protected function OnInput(): void
    {
        parent::OnInput();

        $database = new Database();
        $this->title .= ' :: Авторизация';

        $mUsers = Users::Instance();

        $mUsers->ClearSessions();
        $mUsers->Logout();

        if (!empty($_POST)) {
            if ($mUsers->Login(
                $_POST['login'],
                $_POST['password'],
                isset($_POST['remember']),
            )) {
                header('Location: index.php');
                exit();
            }
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

        $this->content = $this->Template('templates/v_login.php', $vars);
        parent::OnOutput();
    }
}
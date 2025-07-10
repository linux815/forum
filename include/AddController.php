<?php

namespace App;

class AddController extends BaseController
{
    private ?string $titl = null;
    private ?string $text = null;
    private ?string $error = null;

    protected function OnInput(): void
    {
        parent::OnInput();

        $database = new Database();

        // Менеджер пользователей
        $mUsers = Users::Instance();

        // Очистка старых сессий
        $mUsers->ClearSessions();

        // Получение текущего пользователя
        $this->user = $mUsers->Get();

        $this->title .= ' :: Добавление форума';

        if ($this->IsPost()) {
            $forum_name = $_POST['forum_name'] ?? '';
            $description = $_POST['description'] ?? '';
            $parent_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

            // Добавление форума
            $database->forum_insert(
                $parent_id,
                $forum_name,
                $this->user['id_user'],
                $this->user['name'],
                $description,
            );

            $redirect = isset($_GET['id'])
                ? "index.php?c=showforum&id={$parent_id}&page=1"
                : "index.php";

            header("Location: {$redirect}");
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
        $this->content = $this->Template('templates/v_add.php', $vars);
        parent::OnOutput();
    }
}
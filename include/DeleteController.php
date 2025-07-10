<?php

namespace App;


class DeleteController extends BaseController
{
    private ?string $titl = null;  // заголовок
    private ?string $text = null;  // текст
    private ?string $error = null; // сообщение об ошибке

    protected function OnInput(): void
    {
        parent::OnInput();

        $database = new Database();

        if (isset($_GET['forum'])) {
            $id_forum = (int)$_GET['forum'];
            $database->forum_delete($id_forum);

            if (!isset($_GET['id'])) {
                header('Location: index.php');
            } else {
                $id = (int)$_GET['id'];
                header("Location: index.php?c=showforum&id={$id}&page=1");
            }
            exit;
        }

        if (isset($_GET['thread'])) {
            $num = 1;
            $start = 0;
            $id_forums = (int)$_GET['id'];
            $id_thread = (int)$_GET['thread'];

            $c = $database->thread_select_count($id_thread)->fetch();
            $database->thread_delete($id_thread);
            $database->forum_update_statdel($id_forums);
            $row = $database->thread_select($id_forums, $start, $num)->fetch();
            if ($row) {
                $database->forum_update_lastmm2($row['id_user'], $row['login'], $id_forums, $c[0]);
            }

            header("Location: index.php?c=showforum&id={$id_forums}&page=1");
            exit;
        }

        if (isset($_GET['post'])) {
            $id_post = (int)$_GET['post'];
            $id_forums = (int)$_GET['forums'];
            $id_thread = (int)$_GET['threads'];

            $database->post_delete($id_post);
            $database->post_update_stat2($id_thread);
            $database->post_update_stat3($id_forums);

            $num = 1;
            $start = 0;

            $row = $database->thread_select($id_forums, $start, $num)->fetch();
            $database->forum_update_lastm("0", "", $id_thread);
            if ($row) {
                $database->forum_update_lastm2($row['id_user'], $row['login'], $id_forums);
            }

            header("Location: index.php?c=showmessage&forums={$id_forums}&id={$id_thread}&page=1");
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
        $this->content = $this->Template('templates/v_view.php', $vars);
        parent::OnOutput();
    }
}
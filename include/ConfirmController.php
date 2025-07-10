<?php

namespace App;

class ConfirmController extends BaseController
{
    private ?string $titleText = null;  // заголовок
    private ?string $text = null;        // текст
    private ?string $error = null;       // ошибка
    private ?string $confirmationMessage = null;

    protected function onInput(): void
    {
        parent::onInput();

        $this->title .= ' :: Удаление';

        $idForum = $_GET['forum'] ?? null;
        $idThread = $_GET['thread'] ?? null;
        $idMessage = $_GET['delete'] ?? null;
        $idForums = $_GET['id'] ?? '';
        $idPost = $_GET['post'] ?? null;

        if ($idForum !== null) {
            $this->confirmationMessage = "Вы действительно хотите удалить данный раздел?";
        } elseif ($idThread !== null) {
            $this->confirmationMessage = "Вы действительно хотите удалить данную тему?";
        } elseif ($idPost !== null) {
            $this->confirmationMessage = "Вы действительно хотите удалить данное сообщение?";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['Yes'])) {
                if ($idForum !== null) {
                    header('Location: index.php?c=delete&id=' . urlencode($idForums) . '&forum=' . urlencode($idForum));
                    exit;
                }

                if ($idThread !== null) {
                    header(
                        'Location: index.php?c=delete&id=' . urlencode($idForums) . '&thread=' . urlencode($idThread),
                    );
                    exit;
                }

                if ($idPost !== null) {
                    $forums = $_GET['forums'] ?? '';
                    $threads = $_GET['threads'] ?? '';
                    header(
                        'Location: index.php?c=delete&forums=' . urlencode($forums) . '&post=' . urlencode(
                            $idPost,
                        ) . '&threads=' . urlencode($threads),
                    );
                    exit;
                }
            } elseif (isset($_POST['No'])) {
                header('Location: index.php');
                exit;
            }
        }
    }

    protected function onOutput(): void
    {
        $vars = [
            'char' => $this->confirmationMessage,
            'text' => $this->text,
            'error' => $this->error,
            'titl' => $this->titleText,
        ];

        $this->content = $this->template('templates/v_confirm.php', $vars);
        parent::onOutput();
    }
}
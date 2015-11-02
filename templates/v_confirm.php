<?php
/**
 * Шаблон редактора
 * ================
 * $title - заголовок статьи
 * $text - текст статьи
 * $error - текст ошибки (null, если нет ошибки)
 */
?>

<form method="post">
  <h2><?= $char ?></h2>
  <input type="submit" name="Yes" value="Да" /><input type="submit" name="No" value="Нет" />
</form>

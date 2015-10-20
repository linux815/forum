<?php
/**
 * Шаблон редактора
 * ================
 * $forum_name - заголовок форума
 * $description - описание
 */
?>

<form method="post">
  Название форума: &nbsp; &nbsp;	<textarea name="forum_name" style="height: 23px; width: 500px;"><?= $forum_name ?></textarea><br>
  Описание форума: &nbsp; &nbsp;	<textarea name="description" style="height: 23px; width: 500px;"><?= $description ?></textarea>
  <br/><br/>
  <input type="submit" value="Добавить" /><button type="button" onclick="javascript:history.go(-1)">Отмена</button>
</form>

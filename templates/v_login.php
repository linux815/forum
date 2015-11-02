<?php
/**
 * Шаблон редактора
 * ================
 * $title - заголовок статьи
 * $text - текст статьи
 * $error - текст ошибки (null, если нет ошибки)
 */
?>
<h1>Авторизация</h1>
<a href="index.php">Главная</a>
<form method="post">

  <div>Email:<input type="text" id="validate" width="30" name="login"><span id="validEmail"></span></div>

  Пароль: <input type="password" name="password" /><br/>
  <input type="checkbox" name="remember" /> Запомить меня<br/>
  <input type="submit" />
  <button type="button" onclick="javascript:history.go(-1)">Отмена</button>
</form>
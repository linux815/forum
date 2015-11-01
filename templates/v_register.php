<?php if ($user[0] == ""): {?>
<title>Полноценная регистрационная форма с прогресс-баром</title>

<div class="form-container">
  <h1>Форма регистрации:</h1>
  <p>Заполнено:</p>
  <div id="progress"></div><label id="amount">0%</label>
  <form>
    <div id="panel1" class="form-panel">
      <h2>Персональные данные:</h2>
      <fieldset class="ui-corner-all">
        <label>Введите email <b>(для авторизации)</b>:</label><input type="text" id="name">
        <label>Введите желаемое <b>отображаемое</b> имя:</label><input type="text" id="fam">
        <label>Пароль:</label><input type="password" id="pass">
        <label>Подтверждение пароля:</label><input type="password" id="repass">
      </fieldset>
    </div>
    <div id="panel2" class="form-panel ui-helper-hidden">
      <h2>Контакты:</h2>
      <fieldset class="ui-corner-all">
        <label>ICQ:</label><input type="text" id="email">
        <label>Телефон:</label><input type="text" id="telefon">
        <label>Адрес:</label><textarea rows="3" cols="25" id="adr"></textarea>
      </fieldset>
    </div>
    <div id="thanks" class="form-panel ui-helper-hidden">
      <h2>Отправка анкеты</h2>
      <fieldset class="ui-corner-all">
        <div id="loading"><img src="images/loader.gif" width="24" height="24" alt="*" /></div>
        <p>Теперь Вы можете отправить свою анкету</p>
      </fieldset>
    </div>
    <button id="submit" disabled="">Отправить</button><button id="next">Далее</button><button id="back" disabled="disabled">Назад</button>
  </form>
</div>
<?php } else: echo "Доступ запрещен!"; endif;?>
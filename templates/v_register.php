<?php if (empty($user)): ?>
    <title>Полноценная регистрационная форма с прогресс-баром</title>

    <div class="form-container">
        <h1>Форма регистрации:</h1>
        <p>Заполнено:</p>
        <div id="progress" class="progress mb-2">
            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <label id="amount">0%</label>

        <form>
            <div id="panel1" class="form-panel">
                <h2>Персональные данные:</h2>
                <fieldset class="ui-corner-all">
                    <label for="name">Введите email <b>(для авторизации)</b>:</label>
                    <input type="text" id="name" name="name_post" class="form-control" />

                    <label for="fam">Введите желаемое <b>отображаемое</b> имя:</label>
                    <input type="text" id="fam" name="fam" class="form-control" />

                    <label for="pass">Пароль:</label>
                    <input type="password" id="pass" name="pass" class="form-control" />

                    <label for="repass">Подтверждение пароля:</label>
                    <input type="password" id="repass" name="repass" class="form-control" />
                </fieldset>
            </div>

            <div id="panel2" class="form-panel ui-helper-hidden">
                <h2>Контакты:</h2>
                <fieldset class="ui-corner-all">
                    <label for="email">ICQ:</label>
                    <input type="text" id="email" name="icq" class="form-control" />

                    <label for="telefon">Телефон:</label>
                    <input type="text" id="telefon" name="telefon" class="form-control" />

                    <label for="adr">Адрес:</label>
                    <textarea rows="3" cols="25" id="adr" name="adr" class="form-control"></textarea>
                </fieldset>
            </div>

            <div id="thanks" class="form-panel ui-helper-hidden">
                <h2>Отправка анкеты</h2>
                <fieldset class="ui-corner-all">
                    <div id="loading">
                        <img src="images/loader.gif" width="24" height="24" alt="Загрузка..." />
                    </div>
                    <p>Теперь Вы можете отправить свою анкету</p>
                </fieldset>
            </div>

            <div class="mt-3">
                <button id="submit" class="btn btn-success" disabled>Отправить</button>
                <button id="next" class="btn btn-primary">Далее</button>
                <button id="back" class="btn btn-secondary" disabled>Назад</button>
            </div>
        </form>
    </div>
<?php else: ?>
    <div class="alert alert-danger">Доступ запрещён!</div>
<?php endif; ?>
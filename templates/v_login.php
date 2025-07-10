<?php
/**
 * Шаблон редактора авторизации
 * ============================
 * @var string|null $title   Заголовок статьи
 * @var string|null $text    Текст статьи
 * @var string|null $error   Сообщение об ошибке (null, если нет ошибки)
 */
?>

<h1>Авторизация</h1>
<a href="index.php">Главная</a>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger" role="alert">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<form method="post" class="mt-3">
    <div class="mb-3">
        <label for="login" class="form-label">Email:</label>
        <input type="text" class="form-control" id="login" name="login" value="<?= htmlspecialchars($_POST['login'] ?? '') ?>">
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Пароль:</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>

    <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="remember" name="remember" <?= isset($_POST['remember']) ? 'checked' : '' ?> >
        <label class="form-check-label" for="remember">Запомнить меня</label>
    </div>

    <button type="submit" class="btn btn-primary">Войти</button>
    <button type="button" class="btn btn-secondary" onclick="history.back()">Отмена</button>
</form>
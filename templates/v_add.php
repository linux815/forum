<?php
/**
 * Шаблон редактора форума с Bootstrap
 * =====================
 * $forum_name - заголовок форума
 * $description - описание
 */
?>

<div class="container mt-4">
    <h2 class="mb-4">Добавление форума</h2>

    <form method="post">
        <div class="mb-3">
            <label for="forum_name" class="form-label">Название форума</label>
            <input
                    type="text"
                    name="forum_name"
                    id="forum_name"
                    class="form-control"
                    value="<?= htmlspecialchars($forum_name ?? '') ?>"
                    required
            >
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Описание форума</label>
            <textarea
                    name="description"
                    id="description"
                    class="form-control"
                    rows="4"
            ><?= htmlspecialchars($description ?? '') ?></textarea>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Добавить</button>
            <button type="button" class="btn btn-secondary" onclick="history.back()">Отмена</button>
        </div>
    </form>
</div>
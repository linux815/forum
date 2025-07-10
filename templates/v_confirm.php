<?php
/**
 * Шаблон подтверждения удаления с Bootstrap 5
 * ============================================
 * $char - сообщение подтверждения
 */
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title mb-4"><?= htmlspecialchars($char) ?></h2>
            <form method="post" class="d-flex gap-2">
                <button type="submit" name="Yes" class="btn btn-danger">Да</button>
                <button type="submit" name="No" class="btn btn-secondary">Нет</button>
            </form>
        </div>
    </div>
</div>
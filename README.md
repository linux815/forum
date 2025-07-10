# PHP Форум

Полностью самописный форум на PHP с поддержкой:

- Бесконечной вложенности тем и подфорумов
- Отправки и получения личных сообщений
- Поддержки BBCode через [jbbcode/jbbcode](https://github.com/jbowens/jBBCode)
- Вёрстки с использованием Bootstrap 5
- Совместимости с PHP 8
- Современного веб-сервера Caddy + FrankenPHP
- Автоматической установки через `setup.sh`


---

## Быстрый старт

```bash
./setup.sh
```

После запуска форум будет доступен по адресу:  
https://localhost


---

## Данные для входа по умолчанию

- **Логин:** `ivan.bazhenov@gmail.com`
- **Пароль:** `1`

Если вы хотите сменить пароль, можно вручную отредактировать SQL-дамп перед импортом:

```sql
UPDATE users SET password = MD5('ваш_пароль') WHERE email = 'ivan.bazhenov@gmail.com';
```


---

## Структура проекта

- `/include/` — классы контроллеров, моделей, шаблонов
- `/templates/` — HTML-шаблоны
- `/vendor/` — Composer-зависимости

## Используемые технологии

- PHP 8
- Composer (jBBCode, vlucas/phpdotenv и др.)
- Caddy (сгенерированный HTTPS)
- FrankenPHP (современный PHP-рантайм)
- Bootstrap 5

## Лицензия

MIT
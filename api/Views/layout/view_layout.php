<!DOCTYPE html>

<html lang="ru">
<head>

    <meta charset="UTF-8">
    <?php if (isset($session['admin'])): ?>
        <script src="/public/js/admin.js"></script>
    <?php endif; ?>
    <script src="/public/js/main.js"></script>
    <link rel="stylesheet" href="/public/css/main.css">
    <?php if (isset($title)): ?>
        <title><?= $title ?></title>
    <?php endif; ?>
</head>

<body>
<header>
    <a href="?Class=Home">На главную</a>
    <?php if (!isset($session['admin'])): ?>
        <a href="?Class=Login">Войти</a>
    <?php else: ?>
        <a href="?Class=Admin">В панель</a>
        <a href="?Class=Login&Methode=logout">Выйти</a>
    <?php endif; ?>
</header>
[insert]content[/insert]
</body>

</html>
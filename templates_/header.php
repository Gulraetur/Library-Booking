<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require __DIR__.'/../templates_/modals.php'; ?>
    <?php include '../public/message.php'; ?>
    <div class="container">
        <header>
            <h1><?= APP_NAME ?></h1>
            <nav>
                <a href="index.php">Главная</a>
                <a href="reports.php">Отчеты</a>
                <button type="button" class="btn-add-user" id="openAddUserModal">Добавить пользователя</button>
                <button type="button" class="btn-add-book" id="openAddBooksModal">Добавить книгу</button>
            </nav>
        </header>
        <main>
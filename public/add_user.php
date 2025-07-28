<?php
// add_user.php

require_once __DIR__.'/../config/config.php';
require_once __DIR__.'/../app/src/classes/Database.php';
require_once __DIR__.'/../app/src/classes/User.php';

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $user = new User($db);
    
    try {
        $result = $user->create(
            $_POST['full_name'] ?? '',
            $_POST['email'] ?? ''
        );
        
        if ($result) {
            $_SESSION['message'] = '✓ Пользователь успешно добавлен!';
        } else {
            $_SESSION['error'] = '✗ Ошибка при добавлении пользователя';
        }
    } catch (Exception $e) {
        $_SESSION['error'] = 'Ошибка: ' . $e->getMessage();
    }
    
    // Перенаправляем обратно на предыдущую страницу
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

?>
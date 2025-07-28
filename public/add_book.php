<?php
// add_book.php
require_once __DIR__.'/../config/config.php';
require_once __DIR__.'/../app/src/classes/Database.php';
require_once __DIR__.'/../app/src/classes/Book.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $book = new Book($db);
    
    try {
        $result = $book->create(
            $_POST['title'] ?? '',
            $_POST['author'] ?? '',
            $_POST['status'] ?? 'available'
        );
        
        if ($result) {
            $_SESSION['message'] = '✓ Книга успешно добавлена!';
        } else {
            $_SESSION['error'] = '✗ Ошибка при добавлении книги';
        }
    } catch (Exception $e) {
        $_SESSION['error'] = 'Ошибка: ' . $e->getMessage();
    }
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

header("HTTP/1.0 404 Not Found");
echo "Страница не найдена";
?>
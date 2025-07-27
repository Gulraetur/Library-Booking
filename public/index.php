<?php
session_start();
require_once __DIR__.'/../src/config.php';
require_once __DIR__.'/../src/classes/Database.php';
require_once __DIR__.'/../src/classes/Book.php';
require_once __DIR__.'/../src/classes/User.php';
require_once __DIR__.'/../src/classes/Booking.php';

$db = new Database();
$book = new Book($db);
$user = new User($db);
$booking = new Booking($db);

// Создание брони
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book_book'])) {
    $days = intval($_POST['days'] ?? 14);
    if ($booking->create($_POST['user_id'], $_POST['book_id'], $days)) {
        $_SESSION['message'] = 'Книга забронирована до ' . 
            date('d.m.Y', strtotime("+$days days"));
    }
    // Перенаправление на эту же страницу методом GET
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

// Отмена брони
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn-confirm'])) {
    if ($booking->cancel($_POST['booking_id'])) {
        $_SESSION['message'] = 'Бронирование отменено';
    } else {
        $_SESSION['error'] = 'Ошибка при отмене бронирования';
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

// Получение данных
$users = $user->getAllUsers();
$available_books = $book->getAvailableBooks();
$active_bookings = $booking->getActiveBookings();

require __DIR__.'/../templates_/header.php';
require __DIR__.'/../templates_/main.php';
require __DIR__.'/../templates_/footer.php';
?>
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

// Обработка действий
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Обработка бронирования книги
    if (isset($_POST['book_book'])) {
        if ($booking->create($_POST['user_id'], $_POST['book_id'])) {
            $_SESSION['message'] = 'Книга забронирована!';
        } else {
            $_SESSION['error'] = 'Ошибка бронирования';
        }
    }

    // Возврат книги
    if (isset($_POST['return_book'])) {
        if ($booking->complete($_POST['booking_id'])) {
            $_SESSION['message'] = 'Книга возвращена!';
        } else {
            $_SESSION['error'] = 'Ошибка возврата';
        }
    }

    header("Location: ".$_SERVER['REQUEST_URI']);
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
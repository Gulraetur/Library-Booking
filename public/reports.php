<?php
require_once __DIR__.'/../config/config.php';
require_once __DIR__.'/../app/src/classes/Database.php';
require_once __DIR__.'/../app/src/classes/Booking.php';

$db = new Database();
$booking = new Booking($db);

// Фильтрация
$filters = [
    'user_name' => $_GET['user_name'] ?? null,
    'book_title' => $_GET['book_title'] ?? null,
    'status' => $_GET['status'] ?? null
];

$bookings = $booking->getFilteredBookings($filters);

require __DIR__.'/../app/views/header.php';
require __DIR__.'/../app/views/bookings_report.php';
require __DIR__.'/../app/views/footer.php';
?>
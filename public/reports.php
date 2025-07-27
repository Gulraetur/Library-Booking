<?php
require_once __DIR__.'/../src/config.php';
require_once __DIR__.'/../src/classes/Database.php';
require_once __DIR__.'/../src/classes/Booking.php';

$db = new Database();
$booking = new Booking($db);

// Фильтрация
$filters = [
    'user_name' => $_GET['user_name'] ?? null,
    'book_title' => $_GET['book_title'] ?? null,
    'status' => $_GET['status'] ?? null
];

$bookings = $booking->getFilteredBookings($filters);

require __DIR__.'/../templates_/header.php';
require __DIR__.'/../templates_/bookings_report.php';
require __DIR__.'/../templates_/footer.php';
?>
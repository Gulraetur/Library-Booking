<section class="booking-form">
    <h2>Бронирование книги</h2>
    <button type="button" id="openBookModal">Забронировать книгу</button>
</section>

<section class="active-bookings">
    <h2>Активные бронирования</h2>
    <?php if (empty($active_bookings)): ?>
        <p>Нет активных бронирований</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Читатель</th>
                    <th>Книга</th>
                    <th>Дата бронирования</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($active_bookings as $booking): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking->full_name) ?></td>
                        <td><?= htmlspecialchars($booking->title) ?></td>
                        <td><?= date('d.m.Y H:i', strtotime($booking->booking_date)) ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="booking_id" value="<?= $booking->id ?>">
                                <button type="submit" name="return_book" class="btn-return">Вернуть</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>
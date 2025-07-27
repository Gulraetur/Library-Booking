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
                    <th>Период брони</th>  
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($active_bookings as $booking): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking->full_name) ?></td>
                        <td><?= htmlspecialchars($booking->title) ?></td>
                        <td>
                            <?= date('d.m.Y', strtotime($booking->start_date)) ?> - 
                            <?= date('d.m.Y', strtotime($booking->end_date)) ?>
                        </td>
                        <td>
                            <button 
                                type="button" 
                                class="btn-cancel open-cancel-modal" 
                                data-booking-id="<?= $booking->id ?>"
                                data-book-title="<?= htmlspecialchars($booking->title) ?>"
                                data-start-date="<?= date('d.m.Y', strtotime($booking->start_date)) ?>"
                                data-end-date="<?= date('d.m.Y', strtotime($booking->end_date)) ?>"
                                >
                                Отменить
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>
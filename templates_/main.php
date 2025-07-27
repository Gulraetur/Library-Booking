<section class="booking-form">
    <h2>Бронирование книги</h2>
    <form method="POST">
        <div class="form-group">
            <label for="user_id">Читатель:</label>
            <select name="user_id" id="user_id" required>
                <option value="">Выберите читателя</option>
                <?php foreach ($users as $user): ?>
                    <option value="<?= $user->id ?>"><?= htmlspecialchars($user->full_name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="book_id">Книга:</label>
            <select name="book_id" id="book_id" required>
                <option value="">Выберите книгу</option>
                <?php foreach ($available_books as $book): ?>
                    <option value="<?= $book->id ?>"><?= htmlspecialchars($book->title) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" name="book_book">Забронировать</button>
    </form>
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
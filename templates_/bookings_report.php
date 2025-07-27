<section class="report-filters">
    
    <h2>Фильтры отчета</h2>
    <form method="GET">
        <div class="form-group">
            <label for="user_name">ФИО читателя:</label>
            <input type="text" name="user_name" id="user_name" value="<?= htmlspecialchars($filters['user_name'] ?? '') ?>">
        </div>
        
        <div class="form-group">
            <label for="book_title">Название книги:</label>
            <input type="text" name="book_title" id="book_title" value="<?= htmlspecialchars($filters['book_title'] ?? '') ?>">
        </div>
        
        <div class="form-group">
            <label for="status">Статус:</label>
            <select name="status" id="status">
                <option value="">Все</option>
                <option value="active" <?= ($filters['status'] ?? '') === 'active' ? 'selected' : '' ?>>Активные</option>
                <option value="completed" <?= ($filters['status'] ?? '') === 'completed' ? 'selected' : '' ?>>Завершенные</option>
            </select>
        </div>
        
        <button type="submit">Применить</button>
        <a href="reports.php" class="btn-clear">Сбросить</a>
    </form>
</section>

<section class="report-results">
    <h2>Результаты</h2>
    <?php if (empty($bookings)): ?>
        <p>Нет данных по заданным фильтрам</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Читатель</th>
                    <th>Книга</th>
                    <th>Период бронирования</th>
                    <th>Дата отмены</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking->full_name) ?></td>
                        <td><?= htmlspecialchars($booking->title) ?></td>
                        <td>
                            <?= date('d.m.Y', strtotime($booking->start_date)) ?> - 
                            <?= date('d.m.Y', strtotime($booking->end_date)) ?>
                        </td>
                        <td><?= $booking->cancel_date ? date('d.m.Y H:i', strtotime($booking->cancel_date)) : '—' ?></td>
                        <td class="status-<?= $booking->status ?>"><?= $booking->status === 'active' ? 'Активно' : 'Завершено' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</section>
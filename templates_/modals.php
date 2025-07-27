<!-- Модальное окно добавления пользователя -->
<div id="addUserModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Добавить нового пользователя</h2>
        </div>
        <form id="addUserForm" method="POST" action="add_user.php">
            <div class="form-group">
                <label for="full_name">ФИО:</label>
                <input type="text" name="full_name" id="full_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-submit">Добавить</button>
                <button type="button" class="btn-cancel close-modal">Отмена</button>
            </div>
        </form>
    </div>
</div>

<!-- Модальное окно бронирования книги -->
<div id="bookModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Бронирование книги</h2>
        </div>
        <form id="bookForm" method="POST">
            <div class="form-group">
                <label for="modal_user_id">Читатель:</label>
                <select name="user_id" id="modal_user_id" required>
                    <option value="">Выберите читателя</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user->id ?>"><?= htmlspecialchars($user->full_name) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="modal_book_id">Книга:</label>
                <select name="book_id" id="modal_book_id" required>
                    <option value="">Выберите книгу</option>
                    <?php foreach ($available_books as $book): ?>
                        <option value="<?= $book->id ?>"><?= htmlspecialchars($book->title) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="booking_days">Срок бронирования (дней):</label>
                <input type="number" name="days" id="booking_days" 
                       min="1" max="30" value="14" required>
                <small class="hint">Максимум 30 дней</small>
            </div>
            
            <div class="modal-footer">
                <button type="submit" name="book_book">Забронировать</button>
                <button type="button" class="btn-cancel close-modal">Отмена</button>
            </div>
        </form>
    </div>
</div>


<!-- Модальное окно отмены брони -->
<div id="cancelModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Отмена бронирования</h2>
        </div>
        <form id="cancelForm" method="POST" action="index.php">
            <input type="hidden" name="action" value="cancel_booking">
            <input type="hidden" name="booking_id" id="cancel_booking_id">
            
            <div class="confirmation-message">
                <p>Вы уверены, что хотите отменить бронирование?</p>
                <div class="booking-info">
                    <p><strong>Книга:</strong> <span id="cancel_book_title"></span></p>
                    <p><strong>Период:</strong> <span id="cancel_booking_period"></span></p>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="submit" name="btn-confirm" class="btn-confirm">Подтвердить отмену</button>
                <button type="button" class="btn-cancel close-modal">Отмена</button>
            </div>
        </form>
    </div>
</div>
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
            
            <div class="modal-footer">
                <button type="submit" name="book_book">Забронировать</button>
                <button type="button" class="btn-cancel close-modal">Отмена</button>
            </div>
        </form>
    </div>
</div>
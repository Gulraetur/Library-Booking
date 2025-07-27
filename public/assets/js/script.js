document.addEventListener('DOMContentLoaded', function() {

    // Модальное окно бронирования книги
    const bookModal = document.getElementById('bookModal');
    const openBookBtn = document.getElementById('openBookModal');
    const closeBookModal = document.querySelectorAll('#bookModal .close, #bookModal .close-modal, #bookModal .btn-cancel');
    console.log(openBookBtn)
    console.log(bookModal)
    if (openBookBtn && bookModal) {
        // Открытие модального окна
        openBookBtn.addEventListener('click', function() {
            bookModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });

        // Закрытие модального окна
        function closeModal() {
            bookModal.style.display = 'none';
            document.body.style.overflow = '';
        }

        // Назначение обработчиков закрытия
        closeBookModal.forEach(btn => {
            btn.addEventListener('click', closeModal);
        });

        // Закрытие при нажатии Esc
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && bookModal.style.display === 'block') {
                closeModal();
            }
        });
    }

    // Обработка открытия модального окна отмены брони
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('open-cancel-modal')) {
            const bookingId = e.target.getAttribute('data-booking-id');
            const bookTitle = e.target.getAttribute('data-book-title');
            const startDate = e.target.getAttribute('data-start-date');
            const endDate = e.target.getAttribute('data-end-date');

            // Заполняем данные в модальном окне
            document.getElementById('cancel_booking_id').value = bookingId;
            document.getElementById('cancel_book_title').textContent = bookTitle;
            document.getElementById('cancel_booking_period').textContent = 
                `${startDate} - ${endDate}`;

            // Показываем модальное окно
            document.getElementById('cancelModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    });

    // Закрытие модального окна
    document.querySelectorAll('#cancelModal .close, #cancelModal .close-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('cancelModal').style.display = 'none';
            document.body.style.overflow = '';
        });
    });

    // Обработка отправки формы отмены 
    document.getElementById('cancelForm')?.addEventListener('submit', function() {});


    const userModal = document.getElementById('addUserModal')
    const openUserModal = document.getElementById('openAddUserModal')
    const closeUserModal = document.querySelectorAll('#addUserModal .close, #addUserModal .close-modal, #addUserModal .btn-cancel');
    

    if (openUserModal && userModal) {
        // Открытие модального окна

        openUserModal.addEventListener('click', function() {
            userModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });

        // Закрытие модального окна
        function closeModal() {
            userModal.style.display = 'none';
            document.body.style.overflow = '';
        }

        // Назначение обработчиков закрытия
        closeUserModal.forEach(btn => {
            btn.addEventListener('click', closeModal);
        });

        // Закрытие при нажатии Esc
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && userModal.style.display === 'block') {
                closeModal();
            }
        });
    }
    const bookAddModal = document.getElementById('addBookModal');
    const openBooksModal = document.getElementById('openAddBooksModal');
    const closeAddBookModal = document.querySelectorAll('#addBookModal .close, #addBookModal .close-modal, #addBookModal .btn-cancel');

    if (bookAddModal && openBooksModal) {
        
        // Функция открытия
        openBooksModal.addEventListener('click', function() {
            bookAddModal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });

        // Функция закрытия
        function closeModal() {
            bookAddModal.style.display = 'none';
            document.body.style.overflow = '';
        }

        // Закрытие по кнопкам
        closeAddBookModal.forEach(btn => {
            btn.addEventListener('click', closeModal);
        });

        // Закрытие по клику вне окна
        bookAddModal.addEventListener('click', function(e) {
            if (e.target === bookAddModal) {
                closeModal();
            }
        });

        // Закрытие по Esc
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && bookAddModal.style.display === 'block') {
                closeModal();
            }
        });

        // Предотвращение закрытия при клике внутри контента
        document.querySelector('#addBookModal .modal-content').addEventListener('click', function(e) {
            e.stopPropagation();
        });
    } else {
        console.error('Не найдены элементы:', {bookAddModal, openAddBookModal});
    }


    // Инициализация  модальных окон при загрузке
    document.addEventListener('DOMContentLoaded', function() {
        initModal('bookModal', 'openBookModal', 'bookForm');
        initModal('addUserModal', 'openAddUserModal', 'addUserForm');
        initModal('addBookModal', 'openAddBookModal', 'addBookForm');
    });
    
    
    
    // Динамическое обновление статуса
    if (window.location.pathname === '/reports.php') {
        const statusCells = document.querySelectorAll('td[class^="status-"]');
        
        statusCells.forEach(cell => {
            cell.textContent = cell.classList.contains('status-active') 
                ? 'Активно' 
                : 'Завершено';
        });
    }
    const alerts = document.querySelectorAll('.alert-popup');
    
    alerts.forEach(alert => {
        // Показывает уведомление
        alert.style.display = 'block';
        
        // Через 3 секунды начинает исчезать
        setTimeout(() => {
            alert.classList.add('hide');
            
            // После завершения анимации удаляет элемент
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 3000);
    });
});
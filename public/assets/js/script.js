document.addEventListener('DOMContentLoaded', function() {
    // Модальное окно бронирования книги
    const bookModal = document.getElementById('bookModal');
    const openBookBtn = document.getElementById('openBookModal');
    const closeBookModal = document.querySelectorAll('#bookModal .close, #bookModal .close-modal, #bookModal .btn-cancel');
    console.log(openBookBtn)
    console.log(bookModal)
    if (openBookBtn && bookModal) {
        console.log('1111')
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

    // Инициализация  модальных окон при загрузке
    document.addEventListener('DOMContentLoaded', function() {
        initModal('bookModal', 'openBookModal', 'bookForm');
        initModal('addBookModal', 'openAddBookModal', 'addBookForm');
    });

    // Валидация форм
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            let valid = true;
            
            form.querySelectorAll('[required]').forEach(field => {
                if (!field.value.trim()) {
                    valid = false;
                    field.style.borderColor = '#e74c3c';
                } else {
                    field.style.borderColor = '';
                }
            });
            
            if (!valid) {
                e.preventDefault();
                alert('Пожалуйста, заполните все обязательные поля');
            }
        });
    });
    
    // Подтверждение действий
    document.querySelectorAll('.btn-return').forEach(btn => {
        btn.addEventListener('click', function(e) {
            if (!confirm('Вы уверены, что хотите отметить книгу как возвращенную?')) {
                e.preventDefault();
            }
        });
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
});
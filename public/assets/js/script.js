document.addEventListener('DOMContentLoaded', function() {
    // Модальное окно бронирования книги
    const bookModal = document.getElementById('bookModal');
    const openBookBtn = document.getElementById('openBookModal');
    const closeBookModal = document.querySelectorAll('#bookModal .close, #bookModal .close-modal, #bookModal .btn-cancel');
    const backdropBook = bookModal.querySelector('.modal-backdrop');


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
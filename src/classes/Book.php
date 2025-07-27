<?php
class Book {

    //Функции класса Book
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }


    public function getAllBooks() {
        $stmt = $this->db->query("SELECT * FROM books ORDER BY title");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAvailableBooks() {
        $stmt = $this->db->query("SELECT * FROM books WHERE status = 'available'");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function create($title, $author, $status = 'available') {
        // Валидация данных
        if (empty($title) || empty($author)) {
            throw new Exception("Название и автор обязательны");
        }
        // Проверка уникальности названия 
        if (!empty($title)) {
            $stmt = $this->db->query(
                "SELECT id FROM books WHERE title = ?", 
                [$title]
            );
            
            if ($stmt->fetch()) {
                throw new Exception("Книга с таким названием уже существует");
            }
        }
        
        // Добавление книги
        return $this->db->query(
            "INSERT INTO books (title, author, status) VALUES (?, ?, ?)",
            [$title, $author, $status]
        );
    }

    public function updateStatus($id, $status) {
        return $this->db->query(
            "UPDATE books SET status = ? WHERE id = ?", 
            [$status, $id]
        );
    }
}
?>
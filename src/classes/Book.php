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

    public function updateStatus($id, $status) {
        return $this->db->query(
            "UPDATE books SET status = ? WHERE id = ?", 
            [$status, $id]
        );
    }
}
?>
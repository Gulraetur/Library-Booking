<?php
class User {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    //Получаем всех пользователей
    public function getAllUsers() {
        $stmt = $this->db->query("SELECT * FROM users ORDER BY full_name");
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
?>
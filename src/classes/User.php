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
    public function create($full_name, $email) {
        // Валидация данных
        if (empty($full_name) || empty($email)) {
            throw new Exception("Все поля обязательны для заполнения");
        }
        
        // Проверка email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Некорректный email");
        }
        
        // Проверка существования пользователя
        $stmt = $this->db->query(
            "SELECT id FROM users WHERE email = ?", 
            [$email]
        );
        if ($stmt->fetch()) {
            throw new Exception("Пользователь с таким email уже существует");
        }
        
        // Создание пользователя
        return $this->db->query(
            "INSERT INTO users (full_name, email) VALUES (?, ?)",
            [$full_name, $email]
        );
    }
}
?>
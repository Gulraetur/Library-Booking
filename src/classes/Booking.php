<?php
class Booking {
    //Функции класса Booking
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    //Создание бронирования
    public function create($user_id, $book_id) {
        $this->db->query("BEGIN");
        
        try {
            $this->db->query(
                "INSERT INTO bookings (user_id, book_id) VALUES (?, ?)",
                [$user_id, $book_id]
            );
            
            $this->db->query(
                "UPDATE books SET status = 'booked' WHERE id = ?",
                [$book_id]
            );
            
            
            $this->db->query("COMMIT");
            return true;
        } catch (Exception $e) {
            $this->db->query("ROLLBACK");
            return false;
        }
    }

    //Завершение бронирования
    public function complete($booking_id) {
        $this->db->query("BEGIN");
        
        try {
            // Получаем данные о бронировании
            $stmt = $this->db->query(
                "SELECT book_id FROM bookings WHERE id = ? AND status = 'active'", 
                [$booking_id]
            );
            
            $booking = $stmt->fetch(PDO::FETCH_OBJ); 
            
            if (!$booking || !isset($booking->book_id)) {
                throw new Exception("Активное бронирование не найдено");
            }
            
            $book_id = $booking->book_id;
            
            //Обновляем статус бронирования
            $this->db->query(
                "UPDATE bookings SET status = 'completed', return_date = NOW() 
                WHERE id = ? AND status = 'active'",
                [$booking_id]
            );
            
            //Обновляем статус книги
            $this->db->query(
                "UPDATE books SET status = 'available' 
                WHERE id = ?",
                [$book_id]
            );
            
            $this->db->query("COMMIT");
            return true;
        } catch (Exception $e) {
            $this->db->query("ROLLBACK");
            error_log("Ошибка возврата книги: " . $e->getMessage());
            return false;
        }
    }

    //Фильтры броней
    public function getFilteredBookings($filters = []) {
        $where = [];
        $params = [];
        
        if (!empty($filters['user_name'])) {
            $where[] = "u.full_name ILIKE ?";
            $params[] = "%{$filters['user_name']}%";
        }
        
        if (!empty($filters['book_title'])) {
            $where[] = "b.title ILIKE ?";
            $params[] = "%{$filters['book_title']}%";
        }
        
        if (!empty($filters['status'])) {
            $where[] = "bk.status = ?";
            $params[] = $filters['status'];
        }
        
        $whereClause = $where ? "WHERE " . implode(" AND ", $where) : "";
        
        $sql = "SELECT bk.id, u.full_name, b.title, bk.booking_date, bk.return_date, bk.status
                FROM bookings bk
                JOIN users u ON bk.user_id = u.id
                JOIN books b ON bk.book_id = b.id
                $whereClause
                ORDER BY bk.booking_date DESC";
                
        return $this->db->query($sql, $params)->fetchAll(PDO::FETCH_OBJ);
    }

    //Получение активных броней
    public function getActiveBookings() {
        
        $sql = "SELECT bk.id, u.full_name, b.title, bk.booking_date, bk.return_date, bk.status
                FROM bookings bk
                JOIN users u ON bk.user_id = u.id
                JOIN books b ON bk.book_id = b.id
                WHERE bk.status = 'active'
                ORDER BY bk.booking_date DESC";
                
        return $this->db->query($sql)->fetchAll(PDO::FETCH_OBJ);
    
    }
}
?>
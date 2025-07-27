<?php
class Booking {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    // Создание бронирования с периодом
    public function create($user_id, $book_id, $days = 14) {
        $this->db->query("BEGIN");
        
        try {
            $start_date = date('Y-m-d H:i:s');
            $end_date = date('Y-m-d H:i:s', strtotime("+$days days"));
            
            $this->db->query(
                "INSERT INTO bookings (user_id, book_id, start_date, end_date) 
                 VALUES (?, ?, ?, ?)",
                [$user_id, $book_id, $start_date, $end_date]
            );
            
            $this->db->query(
                "UPDATE books SET status = 'booked' WHERE id = ?",
                [$book_id]
            );
            
            $this->db->query("COMMIT");
            return true;
        } catch (Exception $e) {
            $this->db->query("ROLLBACK");
            error_log("Ошибка бронирования: " . $e->getMessage());
            return false;
        }
    }

    // Отмена бронирования
    public function cancel($booking_id) {
        $this->db->query("BEGIN");
        
        try {
            $stmt = $this->db->query(
                "SELECT book_id FROM bookings WHERE id = ? AND status = 'active'",
                [$booking_id]
            );
            
            $booking = $stmt -> fetch(PDO::FETCH_OBJ);
            
            $book_id = $booking -> book_id;
            $this->db->query(
                "UPDATE bookings 
                 SET status = 'cancelled', cancel_date = NOW() 
                 WHERE id = ? AND status = 'active'",
                [$booking_id]
            );
            
            $this->db->query(
                "UPDATE books SET status = 'available' WHERE id = ?",
                [$book_id]
            );
            
            $this->db->query("COMMIT");
            return true;
        } catch (Exception $e) {
            $this->db->query("ROLLBACK");
            error_log("Ошибка отмены брони: " . $e->getMessage());
            return false;
        }
    }


    // Фильтрация бронирований
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
        
        $sql = "SELECT 
                    bk.id, 
                    u.full_name, 
                    b.title, 
                    bk.start_date, 
                    bk.end_date,
                    bk.cancel_date,
                    bk.status,
                    CASE
                        WHEN bk.status = 'active' AND bk.end_date < NOW() THEN 'expired'
                        ELSE bk.status
                    END AS actual_status
                FROM bookings bk
                JOIN users u ON bk.user_id = u.id
                JOIN books b ON bk.book_id = b.id
                $whereClause
                ORDER BY bk.start_date DESC";
                
        return $this->db->query($sql, $params)->fetchAll(PDO::FETCH_OBJ);
    }

    // Получение активных бронирований
    public function getActiveBookings() {
        $sql = "SELECT 
                    bk.id, 
                    u.full_name, 
                    b.title, 
                    bk.start_date, 
                    bk.end_date,
                    EXTRACT(DAY FROM (bk.end_date - NOW())) AS days_remaining
                FROM bookings bk
                JOIN users u ON bk.user_id = u.id
                JOIN books b ON bk.book_id = b.id
                WHERE bk.status = 'active'
                ORDER BY bk.end_date ASC";
                
        return $this->db->query($sql)->fetchAll(PDO::FETCH_OBJ);
    }
}
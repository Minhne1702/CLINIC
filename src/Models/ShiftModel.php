<?php

class ShiftModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Tạo ca làm việc mới
     */
    public function createShift($name, $startTime, $endTime, $desc)
    {
        try {
            // Map đúng tên cột với tiền tố sh_
            $sql = "INSERT INTO shifts (sh_name, sh_start_time, sh_end_time, sh_description, sh_is_active, created_at) 
                    VALUES (:name, :startTime, :endTime, :description, :isActive, :createdAt)";

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':name'        => $name,
                ':startTime'   => $startTime, // Định dạng 'HH:mm' hoặc 'HH:mm:ss'
                ':endTime'     => $endTime,   // Định dạng 'HH:mm' hoặc 'HH:mm:ss'
                ':description' => $desc,
                ':isActive'    => 1,
                ':createdAt'   => date('Y-m-d H:i:s')
            ]) ? $this->db->lastInsertId() : false;
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createShift: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Lấy danh sách các ca đang hoạt động
     */
    public function getActiveShifts()
    {
        try {
            // Truy vấn theo tiền tố sh_ và sắp xếp theo giờ bắt đầu
            $sql = "SELECT * FROM shifts WHERE sh_is_active = 1 ORDER BY sh_start_time ASC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getActiveShifts: " . $e->getMessage());
            return [];
        }
    }
}

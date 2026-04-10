<?php

class RoomModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Tạo phòng mới
     */
    public function createRoom($roomNumber, $floor)
    {
        try {
            // Cập nhật tên cột khớp với MySQL Workbench
            $sql = "INSERT INTO rooms (room_number, room_floor, room_is_active, created_at) 
                    VALUES (:roomNumber, :floor, :isActive, :createdAt)";

            $stmt = $this->db->prepare($sql);

            $now = date('Y-m-d H:i:s');

            $stmt->execute([
                ':roomNumber' => $roomNumber,
                ':floor'      => (int)$floor,
                ':isActive'   => 1,
                ':createdAt'  => $now
            ]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createRoom (RoomModel): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Lấy danh sách các phòng đang hoạt động theo tầng
     */
    public function getRoomsByFloor($floor)
    {
        try {
            // Cập nhật query theo tiền tố room_
            $sql = "SELECT * FROM rooms 
                    WHERE room_floor = :floor 
                      AND room_is_active = 1 
                    ORDER BY room_number ASC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([':floor' => (int)$floor]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getRoomsByFloor: " . $e->getMessage());
            return [];
        }
    }
}

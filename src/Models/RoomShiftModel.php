<?php

class RoomShiftModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Tạo cấu hình Ca cho Phòng
     */
    public function createRoomShift($data)
    {
        try {
            // 1. Chuẩn hóa dữ liệu (Bỏ ObjectId)
            $data['roomId']   = $data['roomId'] ?? null;
            $data['shiftId']  = $data['shiftId'] ?? null;
            $data['clinicId'] = $data['clinicId'] ?? null;
            $data['isActive'] = 1;
            $data['createdAt'] = date('Y-m-d H:i:s');

            // Xóa key _id rác nếu có
            unset($data['_id']);

            // 2. Tự động build câu lệnh INSERT động
            $columns = [];
            $placeholders = [];
            $params = [];

            foreach ($data as $key => $value) {
                $columns[] = $key;
                $placeholders[] = ":$key";
                $params[":$key"] = $value;
            }

            $sql = "INSERT INTO room_shifts (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createRoomShift: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Lấy tất cả các cấu hình đang hoạt động
     */
    public function getActiveConfigs()
    {
        try {
            $sql = "SELECT * FROM room_shifts WHERE isActive = 1";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getActiveConfigs: " . $e->getMessage());
            return [];
        }
    }
}

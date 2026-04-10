<?php

class AppointmentModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createAppointment($data)
    {
        try {
            // 1. Ghi đè/Thêm các giá trị mặc định (Giữ nguyên logic của bạn)
            // Lưu ý: Key truyền vào từ data phải khớp với tiền tố app_ ở trên
            $data['app_status'] = 'pending';
            $data['created_at'] = date('Y-m-d H:i:s');

            // Xóa các key rác của Mongo
            unset($data['_id']);

            // 2. Build câu lệnh INSERT động
            $columns = [];
            $placeholders = [];
            $params = [];

            foreach ($data as $key => $value) {
                $columns[] = "`$key`";
                $placeholders[] = ":$key";
                $params[":$key"] = $value;
            }

            $sql = "INSERT INTO appointments (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createAppointment: " . $e->getMessage());
            return false;
        }
    }

    public function cancelAppointment($id, $reason)
    {
        try {
            // Cập nhật tên cột app_status và app_cancel_reason cho đồng bộ
            $sql = "UPDATE appointments SET app_status = 'cancelled', app_cancel_reason = :reason WHERE id = :id";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':id'     => $id,
                ':reason' => $reason
            ]);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở cancelAppointment: " . $e->getMessage());
            return false;
        }
    }
}

<?php

class NotificationModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Tạo thông báo mới cho người dùng
     */
    public function createNotification($data)
    {
        try {
            // 1. Chuẩn hóa dữ liệu (Map sang tiền tố noti_)
            $formattedData = [
                'noti_user_id' => (!empty($data['userId'])) ? $data['userId'] : null,
                'noti_title'   => $data['title'] ?? 'Thông báo hệ thống',
                'noti_content' => $data['content'] ?? '',
                'noti_type'    => $data['type'] ?? 'system',
                'noti_status'  => 'unread',
                'created_at'   => date('Y-m-d H:i:s')
            ];

            // Xóa key _id rác nếu có
            unset($data['_id']);

            // 2. Tự động build câu lệnh INSERT động
            $columns = [];
            $placeholders = [];
            $params = [];

            foreach ($formattedData as $key => $value) {
                $columns[] = "`$key`";
                $placeholders[] = ":$key";
                $params[":$key"] = $value;
            }

            $sql = "INSERT INTO notifications (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createNotification (NotificationModel): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Đánh dấu thông báo là đã đọc
     */
    public function markAsRead($id)
    {
        try {
            // Cập nhật đúng tên cột noti_status
            $sql = "UPDATE notifications SET noti_status = 'read' WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở markAsRead (NotificationModel): " . $e->getMessage());
            return false;
        }
    }
}

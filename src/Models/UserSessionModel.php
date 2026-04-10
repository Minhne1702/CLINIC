<?php

class UserSessionModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Tạo phiên đăng nhập mới (Hết hạn sau 7 ngày)
     */
    public function createSession($userId, $tokenHash, $ip, $device)
    {
        try {
            // Map đúng tên cột với tiền tố sess_
            $sql = "INSERT INTO user_sessions (sess_user_id, sess_token_hash, sess_ip_address, sess_device_info, sess_expires_at, created_at) 
                    VALUES (:userId, :tokenHash, :ipAddress, :deviceInfo, :expiresAt, :createdAt)";

            $stmt = $this->db->prepare($sql);

            // Tính toán thời gian hết hạn: hiện tại + 7 ngày
            $expiresAt = date('Y-m-d H:i:s', time() + (86400 * 7));
            $now = date('Y-m-d H:i:s');

            $stmt->execute([
                ':userId'     => $userId,
                ':tokenHash'  => $tokenHash,
                ':ipAddress'  => $ip,
                ':deviceInfo' => $device,
                ':expiresAt'  => $expiresAt,
                ':createdAt'  => $now
            ]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createSession (UserSessionModel): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Xóa phiên đăng nhập (Đăng xuất)
     */
    public function deleteSession($tokenHash)
    {
        try {
            // Cập nhật query theo tiền tố sess_token_hash
            $sql = "DELETE FROM user_sessions WHERE sess_token_hash = :tokenHash";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([':tokenHash' => $tokenHash]);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở deleteSession: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Kiểm tra phiên còn hạn hay không (Bổ sung thêm cho logic của bạn)
     */
    public function validateSession($tokenHash)
    {
        try {
            $sql = "SELECT sess_user_id FROM user_sessions 
                    WHERE sess_token_hash = :tokenHash 
                      AND sess_expires_at > NOW() 
                    LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':tokenHash' => $tokenHash]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return false;
        }
    }
}

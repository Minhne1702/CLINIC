<?php

class MfaTokenModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Tạo mã xác thực mới (mặc định hết hạn sau 5 phút)
     */
    public function createToken($userId, $token, $type = 'email')
    {
        try {
            // Cập nhật tên cột với tiền tố mfa_
            $sql = "INSERT INTO mfa_tokens (mfa_user_id, mfa_token, mfa_type, mfa_expires_at, mfa_is_used, created_at) 
                    VALUES (:userId, :token, :type, :expiresAt, :isUsed, :createdAt)";

            $stmt = $this->db->prepare($sql);

            // Tính toán thời gian hết hạn: hiện tại + 300 giây (5 phút)
            $expiresAt = date('Y-m-d H:i:s', time() + 300);
            $now = date('Y-m-d H:i:s');

            $stmt->execute([
                ':userId'    => $userId,
                ':token'     => (string)$token,
                ':type'      => $type,
                ':expiresAt' => $expiresAt,
                ':isUsed'    => 0,
                ':createdAt' => $now
            ]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createToken (MfaTokenModel): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Kiểm tra mã xác thực có hợp lệ không và đánh dấu đã sử dụng
     */
    public function verifyToken($userId, $token)
    {
        try {
            // Kiểm tra token: đúng user, đúng mã, chưa dùng, và chưa hết hạn
            $sql = "SELECT id FROM mfa_tokens 
                    WHERE mfa_user_id = :userId 
                      AND mfa_token = :token 
                      AND mfa_is_used = 0 
                      AND mfa_expires_at > :now 
                    LIMIT 1";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':userId' => $userId,
                ':token'  => (string)$token,
                ':now'    => date('Y-m-d H:i:s')
            ]);

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                // Nếu hợp lệ, đánh dấu là đã sử dụng ngay lập tức
                $updateSql = "UPDATE mfa_tokens SET mfa_is_used = 1 WHERE id = :id";
                $updateStmt = $this->db->prepare($updateSql);
                $updateStmt->execute([':id' => $result['id']]);

                return true;
            }

            return false;
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở verifyToken (MfaTokenModel): " . $e->getMessage());
            return false;
        }
    }
}

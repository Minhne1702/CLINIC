<?php
class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // --- CÁC HÀM LẤY DỮ LIỆU ---

    public function findUserByEmail($email)
    {
        try {
            // Đã sửa: user_email -> email
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Lỗi SQL ở findUserByEmail: " . $e->getMessage());
            return null;
        }
    }

    public function getUserById($userId)
    {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
            $stmt->execute(['id' => $userId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }

    public function getAllUsersByRole($role)
    {
        // Đã sửa: user_role -> role
        $stmt = $this->db->prepare("SELECT * FROM users WHERE role = :role");
        $stmt->execute(['role' => $role]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // --- CÁC HÀM XỬ LÝ (LOGIN / REGISTER) ---

    public function login($email, $password)
    {
        // Đã sửa: user_email -> email, user_is_active -> isActive
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email AND isActive = 1 LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) return false;

        // Đã sửa: user_password -> password
        $hash = $user['password'] ?? null;
        if ($hash && password_verify($password, $hash)) {
            return $user;
        }
        return false;
    }

    public function registerUser($data)
    {
        try {
            $hashedPassword = null;
            if (!empty($data['password'])) {
                $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
            }

            // Đã sửa lại toàn bộ tên cột: fullName, email, password, phone, role, avatar, googleId, createdAt, isActive
            $sql = "INSERT INTO users (fullName, email, password, phone, role, avatar, googleId, createdAt, isActive) 
                    VALUES (:fullName, :email, :password, :phone, :role, :avatar, :googleId, :createdAt, :isActive)";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':fullName'  => $data['fullName'] ?? $data['name'] ?? null,
                ':email'     => $data['email'],
                ':password'  => $hashedPassword,
                ':phone'     => $data['phone'] ?? null,
                ':role'      => $data['role'] ?? 'patient',
                ':avatar'    => $data['avatar'] ?? null,
                ':googleId'  => $data['googleId'] ?? null,
                ':createdAt' => date('Y-m-d H:i:s'),
                ':isActive'  => 1
            ]);

            return $this->db->lastInsertId();
        } catch (Exception $e) {
            error_log("Lỗi SQL ở registerUser: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Cập nhật thông tin (Build SQL động)
     */
    public function updateProfile($userId, $updateData)
    {
        try {
            if (empty($updateData)) return false;

            $fields = "";
            $params = [':id' => $userId];

            foreach ($updateData as $key => $value) {
                // Key truyền vào phải khớp chính xác với tên cột trong DB
                $fields .= "$key = :$key, ";
                $params[":$key"] = $value;
            }
            $fields = rtrim($fields, ", ");

            $sql = "UPDATE users SET $fields WHERE id = :id";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
        } catch (Exception $e) {
            error_log("Lỗi SQL ở updateProfile: " . $e->getMessage());
            return false;
        }
    }
    public function checkEmailExists($email)
    {
        try {
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);

            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Lỗi checkEmailExists: " . $e->getMessage());
            return false;
        }
    }
}

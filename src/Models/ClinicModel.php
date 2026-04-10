<?php

class ClinicModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Tạo chuyên khoa mới
     */
    public function createClinic($name, $description = "")
    {
        try {
            $sql = "INSERT INTO clinics (clin_name, clin_description, clin_is_active, created_at) 
                    VALUES (:name, :description, :isActive, :createdAt)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':name'        => $name,
                ':description' => $description,
                ':isActive'    => 1,
                ':createdAt'   => date('Y-m-d H:i:s')
            ]);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createClinic: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Lấy danh sách tất cả chuyên khoa đang hoạt động
     */
    public function getAllActive()
    {
        try {
            $sql = "SELECT * FROM clinics WHERE clin_is_active = 1 ORDER BY clin_name ASC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getAllActive: " . $e->getMessage());
            return [];
        }
    }
}

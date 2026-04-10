<?php

class DoctorModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Tạo hồ sơ bác sĩ mới
     */
    public function createProfile($data)
    {
        try {
            // 1. Map dữ liệu đầu vào với tiền tố doc_
            $formattedData = [
                'doc_user_id'          => $data['userId'] ?? null,
                'doc_clinic_id'        => $data['clinicId'] ?? null,
                'doc_code'             => $data['doctorCode'] ?? null,
                'doc_name'             => $data['name'] ?? null,
                'doc_specialty'        => $data['specialty'] ?? null,
                'doc_degree'           => $data['degree'] ?? null,
                'doc_bio'              => $data['bio'] ?? null,
                'doc_experience_years' => $data['experienceYears'] ?? 0
            ];

            // Xóa key _id rác nếu có
            unset($data['_id']);

            // 2. Build câu lệnh INSERT động (Giữ nguyên logic của bạn)
            $columns = [];
            $placeholders = [];
            $params = [];

            foreach ($formattedData as $key => $value) {
                $columns[] = "`$key`";
                $placeholders[] = ":$key";
                $params[":$key"] = $value;
            }

            $sql = "INSERT INTO doctors (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createProfile (DoctorModel): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Tìm bác sĩ bằng mã bác sĩ
     */
    public function getByDoctorCode($code)
    {
        try {
            // Cập nhật tên cột doc_code cho khớp MySQL
            $sql = "SELECT * FROM doctors WHERE doc_code = :code LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':code' => $code]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getByDoctorCode: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Cập nhật tiểu sử bác sĩ
     */
    public function updateBio($id, $bio)
    {
        try {
            // Cập nhật tên cột doc_bio
            $sql = "UPDATE doctors SET doc_bio = :bio WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':bio' => $bio,
                ':id'  => $id
            ]);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở updateBio: " . $e->getMessage());
            return false;
        }
    }
}

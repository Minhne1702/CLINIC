<?php

class PatientModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Tạo hồ sơ bệnh nhân mới
     */
    public function createPatient($data)
    {
        try {
            // 1. Chuẩn hóa dữ liệu (Map sang tiền tố pat_)
            $formattedData = [
                'pat_user_id' => $data['userId'] ?? null,
                'pat_code'    => $data['patientCode'] ?? null,
                'pat_name'    => $data['name'] ?? null,
                'pat_gender'  => $data['gender'] ?? null,
                'pat_dob'     => !empty($data['dob']) ? date('Y-m-d', strtotime($data['dob'])) : null,
                'pat_phone'   => $data['phone'] ?? null,
                'pat_cccd'    => $data['cccd'] ?? null,
                'pat_bhyt'    => $data['bhyt'] ?? null,
                'pat_address' => $data['address'] ?? null,
                'created_at'  => date('Y-m-d H:i:s')
            ];

            // Xóa key _id rác của Mongo
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

            $sql = "INSERT INTO patients (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createPatient: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Lấy thông tin bệnh nhân qua ID
     */
    public function getPatientById($id)
    {
        try {
            $sql = "SELECT * FROM patients WHERE id = :id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getPatientById: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Tìm kiếm bệnh nhân theo các thông tin định danh duy nhất (OR logic)
     */
    public function findByUniqueInfo($patientCode = null, $cccd = null, $bhyt = null, $phone = null)
    {
        try {
            $conditions = [];
            $params = [];

            if ($patientCode) {
                $conditions[] = "pat_code = :patientCode";
                $params[':patientCode'] = $patientCode;
            }
            if ($cccd) {
                $conditions[] = "pat_cccd = :cccd";
                $params[':cccd'] = $cccd;
            }
            if ($bhyt) {
                $conditions[] = "pat_bhyt = :bhyt";
                $params[':bhyt'] = $bhyt;
            }
            if ($phone) {
                $conditions[] = "pat_phone = :phone";
                $params[':phone'] = $phone;
            }

            if (empty($conditions)) return null;

            $sql = "SELECT * FROM patients WHERE " . implode(" OR ", $conditions) . " LIMIT 1";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở findByUniqueInfo: " . $e->getMessage());
            return null;
        }
    }
}

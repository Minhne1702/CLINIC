<?php

class MedicalRecordModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Tạo hồ sơ bệnh án mới
     */
    public function createRecord($data)
    {
        try {
            // 1. Chuẩn hóa dữ liệu (Map đúng tên cột với tiền tố mr_)
            $formattedData = [
                'mr_patient_id'     => $data['patientId'] ?? null,
                'mr_doctor_id'      => $data['doctorId'] ?? null,
                'mr_appointment_id' => $data['appointmentId'] ?? null,
                'mr_symptoms'       => $data['symptoms'] ?? null,
                'mr_status'         => 'examining',
                'created_at'        => date('Y-m-d H:i:s')
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

            $sql = "INSERT INTO medical_records (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createRecord (MedicalRecordModel): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Cập nhật chẩn đoán và hoàn tất khám
     */
    public function updateDiagnosis($id, $icdCode, $note)
    {
        try {
            // Cập nhật đúng các cột mr_diagnosis_code và mr_diagnosis_note
            $sql = "UPDATE medical_records 
                    SET mr_diagnosis_code = :icdCode, 
                        mr_diagnosis_note = :note, 
                        mr_status = 'examined',
                        updated_at = :updatedAt
                    WHERE id = :id";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':icdCode'   => $icdCode,
                ':note'      => $note,
                ':updatedAt' => date('Y-m-d H:i:s'),
                ':id'        => $id
            ]);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở updateDiagnosis (MedicalRecordModel): " . $e->getMessage());
            return false;
        }
    }
}

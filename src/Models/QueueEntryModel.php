<?php

class QueueEntryModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Thêm bệnh nhân vào hàng đợi (Cấp số thứ tự)
     */
    public function addToQueue($data)
    {
        try {
            // 1. Chuẩn hóa dữ liệu (Map sang tiền tố q_)
            $formattedData = [
                'q_patient_id'     => $data['patientId'] ?? null,
                'q_clinic_id'      => $data['clinicId'] ?? null,
                'q_appointment_id' => $data['appointmentId'] ?? null,
                'q_number'         => $data['number'] ?? 0,
                'q_status'         => 'waiting',
                'created_at'       => date('Y-m-d H:i:s')
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

            $sql = "INSERT INTO queue_entries (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            // Trả về ID của lượt xếp hàng vừa tạo
            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở addToQueue (QueueEntryModel): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Cập nhật trạng thái hàng đợi (waiting, calling, completed, cancelled)
     */
    public function updateStatus($id, $status)
    {
        try {
            // Cập nhật đúng tên cột q_status
            $sql = "UPDATE queue_entries SET q_status = :status WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':status' => $status,
                ':id'     => $id
            ]);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở updateStatus (QueueEntryModel): " . $e->getMessage());
            return false;
        }
    }
}

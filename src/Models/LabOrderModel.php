<?php

class LabOrderModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Tạo chỉ định xét nghiệm mới
     */
    public function createOrder($data)
    {
        try {
            // 1. Chuẩn hóa dữ liệu (Map đúng tên cột với tiền tố lab_)
            $formattedData = [
                'lab_medical_record_id' => $data['medicalRecordId'] ?? null,
                'lab_test_name'         => $data['testName'] ?? 'Chưa xác định',
                'lab_test_type'         => $data['testType'] ?? null,
                'lab_status'            => 'pending',
                'created_at'            => date('Y-m-d H:i:s')
            ];

            // Xóa key _id rác của Mongo nếu có
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

            $sql = "INSERT INTO lab_orders (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createOrder (LabOrderModel): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Cập nhật kết quả xét nghiệm
     */
    public function updateResult($id, $resultData)
    {
        try {
            // 1. Chuẩn hóa dữ liệu cập nhật (Map đúng tiền tố lab_)
            $updateFields = [
                'lab_result_summary' => $resultData['resultSummary'] ?? null,
                'lab_result_detail'  => isset($resultData['resultDetail']) ? json_encode($resultData['resultDetail']) : null,
                'lab_technician_id'  => $resultData['technicianId'] ?? null,
                'lab_status'         => 'completed',
                'updated_at'         => date('Y-m-d H:i:s')
            ];

            // 2. Build câu lệnh UPDATE động
            $fields = "";
            $params = [':id' => $id];

            foreach ($updateFields as $key => $value) {
                $fields .= "`$key` = :$key, ";
                $params[":$key"] = $value;
            }
            $fields = rtrim($fields, ", ");

            $sql = "UPDATE lab_orders SET $fields WHERE id = :id";

            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở updateResult (LabOrderModel): " . $e->getMessage());
            return false;
        }
    }
}

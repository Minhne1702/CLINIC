<?php

class AuditLogModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createLog($data)
    {
        try {
            // 1. Xử lý dữ liệu đầu vào (Map với tiền tố log_)
            $formattedData = [
                'log_user_id'       => (!empty($data['userId'])) ? $data['userId'] : null,
                'log_action'        => $data['action'],
                'log_resource_type' => $data['resourceType'],
                'log_resource_id'   => (!empty($data['resourceId'])) ? $data['resourceId'] : null,
                'log_old_value'     => isset($data['oldValue']) ? json_encode($data['oldValue']) : null,
                'log_new_value'     => isset($data['newValue']) ? json_encode($data['newValue']) : null,
                'created_at'        => date('Y-m-d H:i:s')
            ];

            // 2. Tự động build câu lệnh INSERT (Giữ nguyên logic dynamic)
            $columns = [];
            $placeholders = [];
            $params = [];

            foreach ($formattedData as $key => $value) {
                $columns[] = "`$key`";
                $placeholders[] = ":$key";
                $params[":$key"] = $value;
            }

            $sql = "INSERT INTO audit_logs (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createLog (AuditLogModel): " . $e->getMessage());
            return false;
        }
    }

    public function getLogsByResource($resourceType, $resourceId)
    {
        try {
            // Đã cập nhật tên cột sang log_resource_type và log_resource_id
            $sql = "SELECT * FROM audit_logs 
                    WHERE log_resource_type = :resourceType AND log_resource_id = :resourceId 
                    ORDER BY created_at DESC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':resourceType' => $resourceType,
                ':resourceId'   => $resourceId
            ]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getLogsByResource (AuditLogModel): " . $e->getMessage());
            return [];
        }
    }
}

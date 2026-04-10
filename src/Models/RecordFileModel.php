<?php

class RecordFileModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Lưu thông tin file đã upload vào database
     */
    public function uploadFile($data)
    {
        try {
            // 1. Chuẩn hóa dữ liệu (Map sang tiền tố file_)
            $formattedData = [
                'file_medical_record_id' => $data['medicalRecordId'] ?? null,
                'file_name'              => $data['fileName'] ?? 'unnamed_file',
                'file_path'              => $data['filePath'] ?? '',
                'file_type'              => $data['fileType'] ?? null,
                'file_size'              => $data['fileSize'] ?? 0,
                'file_uploaded_by'       => $data['uploadedBy'] ?? null,
                'created_at'             => date('Y-m-d H:i:s')
            ];

            // Xóa key _id rác của Mongo nếu có
            unset($data['_id']);

            // 2. Tự động build câu lệnh INSERT động (Logic của bạn)
            $columns = [];
            $placeholders = [];
            $params = [];

            foreach ($formattedData as $key => $value) {
                $columns[] = "`$key`";
                $placeholders[] = ":$key";
                $params[":$key"] = $value;
            }

            $sql = "INSERT INTO record_files (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở uploadFile (RecordFileModel): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Lấy danh sách các file đính kèm của một hồ sơ bệnh án
     */
    public function getFilesByRecord($recordId)
    {
        try {
            // Cập nhật tên cột và sắp xếp
            $sql = "SELECT * FROM record_files 
                    WHERE file_medical_record_id = :recordId 
                    ORDER BY created_at DESC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([':recordId' => $recordId]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở getFilesByRecord: " . $e->getMessage());
            return [];
        }
    }
}

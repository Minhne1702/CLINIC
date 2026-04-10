<?php

class DoctorScheduleModel
{
    private $db; // PDO Instance

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Tạo lịch làm việc mới cho bác sĩ
     */
    public function createSchedule($data)
    {
        try {
            // 1. Chuẩn hóa dữ liệu (Map đúng tên cột với tiền tố sch_)
            $formattedData = [
                'sch_doctor_id' => $data['doctorId'] ?? null,
                'sch_shift_id'  => $data['shiftId'] ?? null,
                'sch_room_id'   => $data['roomId'] ?? null,
                'sch_clinic_id' => $data['clinicId'] ?? null,
                // Chuyển workDate về định dạng DATE của MySQL
                'sch_work_date' => date('Y-m-d', strtotime($data['workDate'])),
                'sch_status'    => 'scheduled',
                'created_at'    => date('Y-m-d H:i:s')
            ];

            // Xóa key _id rác của Mongo nếu có
            unset($data['_id']);

            // 2. Tự động build câu lệnh INSERT động (Giữ nguyên logic của bạn)
            $columns = [];
            $placeholders = [];
            $params = [];

            foreach ($formattedData as $key => $value) {
                $columns[] = "`$key`";
                $placeholders[] = ":$key";
                $params[":$key"] = $value;
            }

            $sql = "INSERT INTO doctor_schedules (" . implode(', ', $columns) . ") 
                    VALUES (" . implode(', ', $placeholders) . ")";

            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở createSchedule (DoctorScheduleModel): " . $e->getMessage());
            return false;
        }
    }

    /**
     * Cập nhật trạng thái lịch làm việc
     */
    public function updateStatus($id, $status)
    {
        try {
            // Cập nhật tên cột sch_status
            $sql = "UPDATE doctor_schedules SET sch_status = :status WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':status' => $status,
                ':id'     => $id
            ]);
        } catch (PDOException $e) {
            error_log("Lỗi SQL ở updateStatus: " . $e->getMessage());
            return false;
        }
    }
}

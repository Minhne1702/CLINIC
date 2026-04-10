<?php

class HomeController
{
    private $smarty;
    private $db; // Bây giờ sẽ là đối tượng PDO

    public function __construct($smarty, $db = null)
    {
        $this->smarty = $smarty;
        $this->db = $db;
    }

    public function index()
    {
        $featured_doctors = $this->getFeaturedDoctors();

        $this->smarty->assign('services',         []);
        $this->smarty->assign('specialties',      []);
        $this->smarty->assign('featured_doctors', $featured_doctors);
        $this->smarty->assign('testimonials',     []);
        $this->smarty->assign('active_page',      'home');

        $this->smarty->display('guest/home.tpl');
    }

    private function getFeaturedDoctors()
    {
        if (!$this->db) {
            return [];
        }

        try {
            // Giả định bảng của bạn tên là 'users' 
            // và thông tin profile được lưu ở các cột phẳng (flat columns) hoặc join bảng
            // Ở đây tôi viết theo hướng các cột nằm cùng bảng 'users' để giữ logic đơn giản
            $sql = "SELECT * FROM users 
                    WHERE role = :role AND isActive = :active 
                    ORDER BY is_featured DESC, createdAt DESC 
                    LIMIT 4";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                'role'   => 'doctor',
                'active' => 1 // true trong MySQL thường là 1
            ]);

            $doctors = [];
            while ($doc = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Giả lập lại cấu trúc mảng cũ để không phải sửa file .tpl
                $doctors[] = [
                    '_id'          => $doc['id'], // MySQL thường dùng 'id'
                    'full_name'    => $doc['full_name'] ?? $doc['fullName'] ?? 'Bác sĩ',
                    'degree'       => $doc['degree'] ?? 'Bác sĩ',
                    'specialty'    => $doc['specialty'] ?? '',
                    'rating'       => $doc['rating'] ?? '5.0',
                    'review_count' => $doc['review_count'] ?? 0,
                    'avatar'       => $doc['avatar'] ?? '',
                    'is_featured'  => (bool) ($doc['is_featured'] ?? false),
                ];
            }
            return $doctors;
        } catch (\Exception $e) {
            error_log("Lỗi SQL ở getFeaturedDoctors: " . $e->getMessage());
            return [];
        }
    }
}

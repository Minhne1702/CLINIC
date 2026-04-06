<?php

class HomeController
{
    private $smarty;

    public function __construct($smarty)
    {
        $this->smarty = $smarty;
    }

    public function index()
    {
        // Dữ liệu tĩnh — sau này thay bằng query MongoDB thật
        $services = [
            [
                'url' => '/CLINIC/public/?page=services',
                'icon'        => 'fa-solid fa-stethoscope',
                'color'       => '#0ea5e9',
                'name'        => 'Khám chuyên khoa',
                'description' => 'Thăm khám với bác sĩ chuyên khoa đầu ngành tại cơ sở',
            ],
            [
                'url' => '/CLINIC/public/?page=services',
                'icon'        => 'fa-solid fa-video',
                'color'       => '#8b5cf6',
                'name'        => 'Khám từ xa',
                'description' => 'Tư vấn trực tuyến qua video call với bác sĩ của bạn',
            ],
            [
                'url' => '/CLINIC/public/?page=services',
                'icon'        => 'fa-solid fa-clipboard-list',
                'color'       => '#10b981',
                'name'        => 'Khám tổng quát',
                'description' => 'Kiểm tra sức khỏe định kỳ với gói khám toàn diện',
            ],
            [
                'url' => '/CLINIC/public/?page=services',
                'icon'        => 'fa-solid fa-flask',
                'color'       => '#f59e0b',
                'name'        => 'Xét nghiệm y học',
                'description' => 'Kết quả xét nghiệm nhanh chóng và chính xác',
            ],
            [
                'url' => '/CLINIC/public/?page=services',
                'icon'        => 'fa-solid fa-tooth',
                'color'       => '#ef4444',
                'name'        => 'Nha khoa',
                'description' => 'Chăm sóc răng miệng toàn diện từ cơ bản đến thẩm mỹ',
            ],
            [
                'url' => '/CLINIC/public/?page=services',
                'icon'        => 'fa-solid fa-brain',
                'color'       => '#ec4899',
                'name'        => 'Sức khỏe tinh thần',
                'description' => 'Tư vấn tâm lý chuyên sâu và hỗ trợ sức khỏe tâm thần',
            ],
        ];

        $specialties = [
            ['url' => '/CLINIC/public/?page=doctors&spec=tim-mach',   'icon' => 'fa-solid fa-heart',            'name' => 'Tim mạch'],
            ['url' => '/CLINIC/public/?page=doctors&spec=than-kinh',  'icon' => 'fa-solid fa-brain',             'name' => 'Thần kinh'],
            ['url' => '/CLINIC/public/?page=doctors&spec=tieu-hoa',   'icon' => 'fa-solid fa-lungs',             'name' => 'Tiêu hóa'],
            ['url' => '/CLINIC/public/?page=doctors&spec=nhi-khoa',   'icon' => 'fa-solid fa-child',             'name' => 'Nhi khoa'],
            ['url' => '/CLINIC/public/?page=doctors&spec=da-lieu',    'icon' => 'fa-solid fa-hand-dots',         'name' => 'Da liễu'],
            ['url' => '/CLINIC/public/?page=doctors&spec=mat',        'icon' => 'fa-solid fa-eye',               'name' => 'Mắt'],
            ['url' => '/CLINIC/public/?page=doctors&spec=tai-mui-hong','icon'=> 'fa-solid fa-ear-listen',        'name' => 'Tai Mũi Họng'],
            ['url' => '/CLINIC/public/?page=doctors&spec=xuong-khop', 'icon' => 'fa-solid fa-bone',              'name' => 'Cơ xương khớp'],
            ['url' => '/CLINIC/public/?page=doctors&spec=noi-tiet',   'icon' => 'fa-solid fa-syringe',           'name' => 'Nội tiết'],
            ['url' => '/CLINIC/public/?page=doctors&spec=phu-khoa',   'icon' => 'fa-solid fa-venus',             'name' => 'Phụ khoa'],
            ['url' => '/CLINIC/public/?page=doctors&spec=nha-khoa',   'icon' => 'fa-solid fa-tooth',             'name' => 'Nha khoa'],
            ['url' => '/CLINIC/public/?page=doctors&spec=tam-than',   'icon' => 'fa-solid fa-head-side-brain',   'name' => 'Tâm thần'],
        ];

        $featured_doctors = [
            [
                '_id'          => '1',
                'full_name'    => 'BS. Nguyễn Văn An',
                'degree'       => 'Thạc sĩ · Bác sĩ',
                'specialty'    => 'Tim mạch',
                'rating'       => '4.9',
                'review_count' => 142,
                'avatar'       => '',
                'is_featured'  => true,
            ],
            [
                '_id'          => '2',
                'full_name'    => 'BS. Trần Thị Bích',
                'degree'       => 'Tiến sĩ · Bác sĩ',
                'specialty'    => 'Nhi khoa',
                'rating'       => '5.0',
                'review_count' => 98,
                'avatar'       => '',
                'is_featured'  => false,
            ],
            [
                '_id'          => '3',
                'full_name'    => 'BS. Lê Minh Tuấn',
                'degree'       => 'Bác sĩ CKI',
                'specialty'    => 'Da liễu',
                'rating'       => '4.8',
                'review_count' => 76,
                'avatar'       => '',
                'is_featured'  => false,
            ],
            [
                '_id'          => '4',
                'full_name'    => 'BS. Phạm Thu Hà',
                'degree'       => 'Thạc sĩ · Bác sĩ',
                'specialty'    => 'Thần kinh',
                'rating'       => '4.9',
                'review_count' => 115,
                'avatar'       => '',
                'is_featured'  => true,
            ],
        ];

        $testimonials = [
            [
                'name'      => 'Nguyễn Thị Hoa',
                'specialty' => 'Khám Tim mạch',
                'rating'    => 5,
                'content'   => 'Dịch vụ rất tốt, bác sĩ nhiệt tình và tận tâm. Tôi đã đặt lịch khám tim mạch và được tư vấn rất chi tiết.',
            ],
            [
                'name'      => 'Trần Minh Tú',
                'specialty' => 'Khám Tổng quát',
                'rating'    => 5,
                'content'   => 'Đặt lịch nhanh, nhân viên hỗ trợ chu đáo. Phòng khám sạch sẽ, hiện đại. Sẽ giới thiệu cho bạn bè.',
            ],
            [
                'name'      => 'Lê Thanh Mai',
                'specialty' => 'Khám Da liễu',
                'rating'    => 5,
                'content'   => 'Giao diện dễ dùng, đặt lịch chỉ mất vài phút. Bác sĩ da liễu rất giỏi, tư vấn tận tình và kỹ lưỡng.',
            ],
        ];

        $this->smarty->assign('services',          $services);
        $this->smarty->assign('specialties',       $specialties);
        $this->smarty->assign('featured_doctors',  $featured_doctors);
        $this->smarty->assign('testimonials',      $testimonials);
        $this->smarty->assign('active_page',       'home');

        $this->smarty->display('guest/home.tpl');
    }
}

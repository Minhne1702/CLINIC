<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/db.php';

try {
    $db = (new Database())->getDb();
    $users = $db->selectCollection('users');
    $users->deleteMany([]);
    $data = [
        [
            'fullName' => 'Admin System',
            'email'    => 'admin@gmail.com',
            'phone'    => '0123456789',
            'password' => password_hash('123456', PASSWORD_BCRYPT),
            'role'     => 'admin',
            'isActive' => true,
            'createdAt' => new MongoDB\BSON\UTCDateTime()
        ],
        [
            'fullName' => 'BS. Nguyễn Văn Huy',
            'email'    => 'doctor@gmail.com',
            'phone'    => '0123456789',
            'password' => password_hash('123456', PASSWORD_BCRYPT),
            'role'     => 'doctor',
            'isActive' => true,
            'createdAt' => new MongoDB\BSON\UTCDateTime()
        ],
        [
            'fullName' => 'Lễ Tân Thúy Nga',
            'email'    => 'receptionist@gmail.com',
            'phone'    => '0123456789',
            'password' => password_hash('123456', PASSWORD_BCRYPT),
            'role'     => 'receptionist',
            'isActive' => true,
            'createdAt' => new MongoDB\BSON\UTCDateTime()
        ],
        [
            'fullName' => 'Bệnh Nhân Test',
            'email'    => 'patient@gmail.com',
            'phone'    => '0123456789',
            'password' => password_hash('123456', PASSWORD_BCRYPT),
            'role'     => 'patient',
            'isActive' => true,
            'createdAt' => new MongoDB\BSON\UTCDateTime()
        ],
        [
            'fullName' => 'Thu Ngân Test',
            'email'    => 'cashier@gmail.com',
            'phone'    => '0123456789',
            'password' => password_hash('123456', PASSWORD_BCRYPT),
            'role'     => 'cashier',
            'isActive' => true,
            'createdAt' => new MongoDB\BSON\UTCDateTime()
        ],
        [
            'fullName' => 'Dược Sĩ Test',
            'email'    => 'pharmacist@gmail.com',
            'phone'    => '0123456789',
            'password' => password_hash('123456', PASSWORD_BCRYPT),
            'role'     => 'pharmacist',
            'isActive' => true,
            'createdAt' => new MongoDB\BSON\UTCDateTime()
        ]
    ];

    // Đổ dữ liệu vào Database
    $users->insertMany($data);
} catch (Exception $e) {
    // Ghi lỗi vào log máy chủ, không in ra màn hình
    error_log("Lỗi Seeding: " . $e->getMessage());
}

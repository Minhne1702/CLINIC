<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/db.php';

try {
    $db = (new Database())->getDb();
    $now = date('Y-m-d H:i:s');

    echo "<h3>Bắt đầu khởi tạo hệ thống...</h3>";

    // --- 1. DỌN DẸP DATABASE ---
    $db->exec("SET FOREIGN_KEY_CHECKS = 0;");

    $tables = [
        'audit_logs',
        'payments',
        'invoice_items',
        'invoices',
        'prescriptions',
        'drugs',
        'drug_categories',
        'stock_movements',
        'users',
        'specialties',
        'appointments',
        'medical_records',
        'schedules'
    ];

    foreach ($tables as $table) {
        $db->exec("DROP TABLE IF EXISTS $table;");
    }
    echo "✓ Đã làm sạch các bảng cũ.<br>";

    // --- 2. TẠO CẤU TRÚC BẢNG MỚI ---

    // Bảng Chuyên khoa
    $db->exec("CREATE TABLE specialties (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        icon VARCHAR(100),
        created_at DATETIME
    ) ENGINE=InnoDB;");

    // Bảng Người dùng
    $db->exec("CREATE TABLE users (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        fullName VARCHAR(255),
        email VARCHAR(255) UNIQUE,
        password VARCHAR(255),
        phone VARCHAR(20),
        role ENUM('admin', 'receptionist', 'doctor', 'patient', 'pharmacist', 'cashier'),
        specialty_id INT UNSIGNED,
        specialty VARCHAR(255),
        degree VARCHAR(255),
        rating DECIMAL(3,1),
        review_count INT DEFAULT 0,
        avatar VARCHAR(255),
        googleId VARCHAR(255), 
        createdAt DATETIME,
        isActive TINYINT(1) DEFAULT 1,
        CONSTRAINT fk_user_specialty FOREIGN KEY (specialty_id) REFERENCES specialties(id) ON DELETE SET NULL
    ) ENGINE=InnoDB;");

    // Bảng Danh mục thuốc (Thêm description và status)
    $db->exec("CREATE TABLE drug_categories (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        drug_cat_code VARCHAR(50),
        drug_cat_name VARCHAR(255) NOT NULL,
        description TEXT,
        status VARCHAR(20) DEFAULT 'active',
        created_at DATETIME
    ) ENGINE=InnoDB;");

    // Bảng Thuốc (Đầy đủ các cột để fix Warning side_effects, contraindications)
    $db->exec("CREATE TABLE drugs (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        category_id INT UNSIGNED,
        name VARCHAR(255) NOT NULL,
        active_ingredient VARCHAR(255),
        unit VARCHAR(50) DEFAULT 'Viên',
        price DECIMAL(15,2) DEFAULT 0,
        stock_qty INT DEFAULT 0,
        min_qty INT DEFAULT 10,
        side_effects TEXT,
        contraindications TEXT,
        expiry_date DATE,
        created_at DATETIME,
        CONSTRAINT fk_drug_cat FOREIGN KEY (category_id) REFERENCES drug_categories(id) ON DELETE SET NULL
    ) ENGINE=InnoDB;");

    // Bảng Lịch sử kho (QUAN TRỌNG: Fix lỗi khi phát thuốc hoặc nhập kho)
    $db->exec("CREATE TABLE stock_movements (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        sm_drug_id INT UNSIGNED,
        sm_type ENUM('in', 'out') NOT NULL,
        sm_qty INT NOT NULL,
        sm_supplier VARCHAR(255),
        sm_import_date DATE,
        sm_note TEXT,
        created_at DATETIME,
        CONSTRAINT fk_sm_drug FOREIGN KEY (sm_drug_id) REFERENCES drugs(id) ON DELETE CASCADE
    ) ENGINE=InnoDB;");

    // Bảng Đơn thuốc
    $db->exec("CREATE TABLE prescriptions (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        code VARCHAR(50) UNIQUE,
        patient_id INT UNSIGNED,
        patient_name VARCHAR(255),
        doctor_id INT UNSIGNED,
        doctor_name VARCHAR(255),
        diagnosis VARCHAR(255),
        drugs_json LONGTEXT,
        status ENUM('pending', 'paid', 'dispensing', 'done', 'cancelled') DEFAULT 'pending',
        created_at DATETIME
    ) ENGINE=InnoDB;");

    // Bảng Hóa đơn
    $db->exec("CREATE TABLE invoices (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        invoice_code VARCHAR(50) UNIQUE,
        prescription_id INT UNSIGNED,
        patient_id INT UNSIGNED,
        patient_name VARCHAR(255),
        total_amount DECIMAL(15,2) DEFAULT 0,
        status ENUM('pending', 'paid', 'cancelled') DEFAULT 'pending',
        payment_method ENUM('cash', 'transfer', 'qr') DEFAULT 'cash',
        cashier_id INT UNSIGNED,
        created_at DATETIME,
        updated_at DATETIME,
        CONSTRAINT fk_inv_patient FOREIGN KEY (patient_id) REFERENCES users(id) ON DELETE SET NULL,
        CONSTRAINT fk_inv_pres FOREIGN KEY (prescription_id) REFERENCES prescriptions(id) ON DELETE SET NULL
    ) ENGINE=InnoDB;");

    $db->exec("SET FOREIGN_KEY_CHECKS = 1;");
    echo "✓ Đã tạo cấu trúc bảng chuẩn MySQL.<br>";

    // --- 3. SEED DỮ LIỆU MẪU ---

    // Chèn Chuyên khoa
    $db->exec("INSERT INTO specialties (name, icon, created_at) VALUES ('Nội tổng quát', 'fa-user-doctor', '$now')");
    $specId = $db->lastInsertId();

    // Mật khẩu chung: 123456
    $password = password_hash('123456', PASSWORD_BCRYPT);

    // Seed 6 Roles
    $userData = [
        ['fullName' => 'Quản trị viên',   'email' => 'admin@gmail.com',       'role' => 'admin'],
        ['fullName' => 'Bác sĩ Huy',      'email' => 'doctor@gmail.com',      'role' => 'doctor'],
        ['fullName' => 'Lễ tân Thúy Nga', 'email' => 'receptionist@gmail.com', 'role' => 'receptionist'],
        ['fullName' => 'Dược sĩ Minh',    'email' => 'pharmacist@gmail.com',   'role' => 'pharmacist'],
        ['fullName' => 'Thu ngân Ngọc',   'email' => 'cashier@gmail.com',      'role' => 'cashier'],
        ['fullName' => 'Bệnh nhân An',    'email' => 'patient@gmail.com',      'role' => 'patient'],
    ];

    $stmtUser = $db->prepare("INSERT INTO users (fullName, email, password, role, specialty_id, createdAt, isActive) VALUES (?, ?, ?, ?, ?, ?, 1)");
    $ids = [];
    foreach ($userData as $u) {
        $stmtUser->execute([$u['fullName'], $u['email'], $password, $u['role'], ($u['role'] === 'doctor' ? $specId : null), $now]);
        $ids[$u['role']] = $db->lastInsertId();
    }

    // Seed Danh mục thuốc có đầy đủ mô tả
    $db->exec("INSERT INTO drug_categories (drug_cat_name, description, status, created_at) 
               VALUES ('Thuốc kháng sinh', 'Tiêu diệt hoặc kìm hãm sự phát triển của vi khuẩn', 'active', '$now')");
    $catIdKhangSinh = $db->lastInsertId();

    $db->exec("INSERT INTO drug_categories (drug_cat_name, description, status, created_at) 
               VALUES ('Thuốc giảm đau', 'Hỗ trợ giảm đau, hạ sốt, kháng viêm', 'active', '$now')");
    $catIdGiamDau = $db->lastInsertId();

    // Seed Thuốc có đầy đủ side_effects và contraindications
    $db->exec("INSERT INTO drugs (category_id, name, active_ingredient, unit, price, stock_qty, min_qty, side_effects, contraindications, created_at) 
               VALUES ($catIdGiamDau, 'Paracetamol 500mg', 'Paracetamol', 'Viên', 1500, 100, 10, 'Buồn nôn, phát ban', 'Người suy gan nặng', '$now')");

    $db->exec("INSERT INTO drugs (category_id, name, active_ingredient, unit, price, stock_qty, min_qty, side_effects, contraindications, created_at) 
               VALUES ($catIdKhangSinh, 'Amoxicillin', 'Amoxicillin', 'Viên', 3000, 5, 10, 'Tiêu chảy, mẩn ngứa', 'Người dị ứng Penicillin', '$now')");

    // Seed Đơn thuốc và Hóa đơn mẫu (Trạng thái PAID để Dược sĩ xử lý luôn)
    $db->exec("INSERT INTO prescriptions (code, patient_id, patient_name, doctor_id, doctor_name, diagnosis, status, created_at) 
               VALUES ('RX-001', {$ids['patient']}, 'Bệnh nhân An', {$ids['doctor']}, 'Bác sĩ Huy', 'Viêm họng cấp', 'paid', '$now')");
    $presId = $db->lastInsertId();

    $db->exec("INSERT INTO invoices (invoice_code, prescription_id, patient_id, patient_name, total_amount, status, created_at) 
               VALUES ('INV-001', $presId, {$ids['patient']}, 'Bệnh nhân An', 150000, 'paid', '$now')");

    echo "<h3>✅ Hoàn tất Seed hệ thống!</h3>";
    echo "Giao diện của bạn bây giờ sẽ sạch lỗi Warning.<br>";
} catch (Exception $e) {
    echo "<h3 style='color:red'>❌ Lỗi: " . $e->getMessage() . "</h3>";
}

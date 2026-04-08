<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/db.php';

try {
    $db = (new Database())->getDb();

    // ─── 1. Users ─────────────────────────────────────────────────────────────
    $users = $db->selectCollection('users');
    $users->deleteMany([]);

    $userData = [
        ['fullName' => 'Admin System',      'email' => 'admin@gmail.com',       'role' => 'admin'],
        ['fullName' => 'BS. Nguyễn Văn Huy','email' => 'doctor@gmail.com',      'role' => 'doctor'],
        ['fullName' => 'Lễ Tân Thúy Nga',  'email' => 'receptionist@gmail.com','role' => 'receptionist'],
        ['fullName' => 'Bệnh Nhân Test',    'email' => 'patient@gmail.com',     'role' => 'patient'],
        ['fullName' => 'Thu Ngân Test',     'email' => 'cashier@gmail.com',     'role' => 'cashier'],
        ['fullName' => 'Dược Sĩ Test',     'email' => 'pharmacist@gmail.com',  'role' => 'pharmacist'],
    ];

    $insertedUsers = [];
    foreach ($userData as $u) {
        $u['phone']     = '0123456789';
        $u['password']  = password_hash('123456', PASSWORD_BCRYPT);
        $u['isActive']  = true;
        $u['createdAt'] = new MongoDB\BSON\UTCDateTime();
        $result = $users->insertOne($u);
        $insertedUsers[$u['role']] = $result->getInsertedId();
    }

    $doctorId    = $insertedUsers['doctor'];
    $patientId   = $insertedUsers['patient'];
    $patientCode = 'BN-' . strtoupper(substr((string)$patientId, -5));

    // ─── 2. Drug Categories ───────────────────────────────────────────────────
    $catCol = $db->selectCollection('drug_categories');
    $catCol->deleteMany([]);

    $catData = [
        ['code' => 'KS',  'name' => 'Kháng sinh',  'description' => 'Thuốc kháng khuẩn'],
        ['code' => 'GD',  'name' => 'Giảm đau',    'description' => 'Thuốc hạ sốt, giảm đau'],
        ['code' => 'KV',  'name' => 'Kháng viêm',  'description' => 'Thuốc chống viêm'],
        ['code' => 'VIT', 'name' => 'Vitamin',      'description' => 'Bổ sung vitamin và khoáng chất'],
    ];

    $insertedCats = [];
    foreach ($catData as $c) {
        $c['is_active']  = true;
        $c['created_at'] = new MongoDB\BSON\UTCDateTime();
        $result = $catCol->insertOne($c);
        $insertedCats[$c['code']] = $result->getInsertedId();
    }

    // ─── 3. Drugs ─────────────────────────────────────────────────────────────
    $drugCol = $db->selectCollection('drugs');
    $drugCol->deleteMany([]);

    $now    = time();
    $drugs  = [
        [
            'name'              => 'Amoxicillin 500mg',
            'active_ingredient' => 'Amoxicillin',
            'concentration'     => '500mg',
            'dosage_form'       => 'viên',
            'unit'              => 'viên',
            'category_id'       => (string)$insertedCats['KS'],
            'category_name'     => 'Kháng sinh',
            'stock_qty'         => 500,
            'min_qty'           => 50,
            'lot_number'        => 'LOT-KS001',
            'expiry_date'       => new MongoDB\BSON\UTCDateTime(($now + 365 * 86400) * 1000),
            'price'             => 5000,
            'side_effects'      => 'Buồn nôn, tiêu chảy',
            'contraindications' => 'Dị ứng Penicillin',
            'is_active'         => true,
        ],
        [
            'name'              => 'Paracetamol 500mg',
            'active_ingredient' => 'Paracetamol',
            'concentration'     => '500mg',
            'dosage_form'       => 'viên',
            'unit'              => 'viên',
            'category_id'       => (string)$insertedCats['GD'],
            'category_name'     => 'Giảm đau',
            'stock_qty'         => 1000,
            'min_qty'           => 100,
            'lot_number'        => 'LOT-GD001',
            'expiry_date'       => new MongoDB\BSON\UTCDateTime(($now + 730 * 86400) * 1000),
            'price'             => 1500,
            'side_effects'      => 'Hiếm gặp khi dùng đúng liều',
            'contraindications' => 'Suy gan nặng',
            'is_active'         => true,
        ],
        [
            'name'              => 'Ibuprofen 400mg',
            'active_ingredient' => 'Ibuprofen',
            'concentration'     => '400mg',
            'dosage_form'       => 'viên',
            'unit'              => 'viên',
            'category_id'       => (string)$insertedCats['KV'],
            'category_name'     => 'Kháng viêm',
            'stock_qty'         => 8,          // Sắp hết — để test cảnh báo
            'min_qty'           => 30,
            'lot_number'        => 'LOT-KV001',
            'expiry_date'       => new MongoDB\BSON\UTCDateTime(($now + 20 * 86400) * 1000), // Sắp hết hạn
            'price'             => 3000,
            'side_effects'      => 'Kích ứng dạ dày',
            'contraindications' => 'Loét dạ dày, suy thận',
            'is_active'         => true,
        ],
        [
            'name'              => 'Vitamin C 500mg',
            'active_ingredient' => 'Ascorbic acid',
            'concentration'     => '500mg',
            'dosage_form'       => 'viên',
            'unit'              => 'viên',
            'category_id'       => (string)$insertedCats['VIT'],
            'category_name'     => 'Vitamin',
            'stock_qty'         => 300,
            'min_qty'           => 50,
            'lot_number'        => 'LOT-VIT001',
            'expiry_date'       => new MongoDB\BSON\UTCDateTime(($now + 540 * 86400) * 1000),
            'price'             => 2000,
            'side_effects'      => 'Không đáng kể',
            'contraindications' => 'Sỏi thận oxalate',
            'is_active'         => true,
        ],
        [
            'name'              => 'Azithromycin 500mg',
            'active_ingredient' => 'Azithromycin',
            'concentration'     => '500mg',
            'dosage_form'       => 'viên',
            'unit'              => 'viên',
            'category_id'       => (string)$insertedCats['KS'],
            'category_name'     => 'Kháng sinh',
            'stock_qty'         => 0,          // Hết hàng — để test cảnh báo
            'min_qty'           => 20,
            'lot_number'        => 'LOT-KS002',
            'expiry_date'       => new MongoDB\BSON\UTCDateTime(($now + 180 * 86400) * 1000),
            'price'             => 15000,
            'side_effects'      => 'Buồn nôn, tiêu chảy nhẹ',
            'contraindications' => 'Dị ứng macrolide',
            'is_active'         => true,
        ],
    ];

    $insertedDrugs = [];
    foreach ($drugs as $d) {
        $d['created_at'] = new MongoDB\BSON\UTCDateTime();
        $result          = $drugCol->insertOne($d);
        $insertedDrugs[$d['name']] = $result->getInsertedId();
    }

    // ─── 4. Prescriptions ─────────────────────────────────────────────────────
    $rxCol = $db->selectCollection('prescriptions');
    $rxCol->deleteMany([]);

    $prescriptions = [
        [
            'code'                  => 'RX-' . strtoupper(substr(uniqid(), -6)),
            'patient_id'            => $patientId,
            'patient_name'          => 'Bệnh Nhân Test',
            'patient_code'          => $patientCode,
            'doctor_id'             => $doctorId,
            'doctor_name'           => 'BS. Nguyễn Văn Huy',
            'diagnosis'             => 'Viêm họng cấp tính',
            'patient_drug_allergies'=> '',
            'drugs'                 => [
                [
                    'drug_id'           => $insertedDrugs['Amoxicillin 500mg'],
                    'name'              => 'Amoxicillin 500mg',
                    'active_ingredient' => 'Amoxicillin',
                    'concentration'     => '500mg',
                    'qty'               => 21,
                    'unit'              => 'viên',
                    'dosage'            => '3 viên/ngày',
                    'instruction'       => 'Sau ăn, cách đều nhau 8 tiếng',
                    'category_name'     => 'Kháng sinh',
                ],
                [
                    'drug_id'           => $insertedDrugs['Paracetamol 500mg'],
                    'name'              => 'Paracetamol 500mg',
                    'active_ingredient' => 'Paracetamol',
                    'concentration'     => '500mg',
                    'qty'               => 10,
                    'unit'              => 'viên',
                    'dosage'            => '2 viên/lần, 4 lần/ngày khi sốt',
                    'instruction'       => 'Uống khi sốt trên 38.5°C',
                    'category_name'     => 'Giảm đau',
                ],
            ],
            'prescription_note'     => 'Uống nhiều nước, nghỉ ngơi, tái khám nếu không cải thiện sau 3 ngày',
            'status'                => 'pending',
            'drug_count'            => 2,
            'created_at'            => new MongoDB\BSON\UTCDateTime(($now - 3600) * 1000), // 1 giờ trước
        ],
        [
            'code'                  => 'RX-' . strtoupper(substr(uniqid(), -6)),
            'patient_id'            => $patientId,
            'patient_name'          => 'Bệnh Nhân Test',
            'patient_code'          => $patientCode,
            'doctor_id'             => $doctorId,
            'doctor_name'           => 'BS. Nguyễn Văn Huy',
            'diagnosis'             => 'Cảm cúm thông thường',
            'patient_drug_allergies'=> 'Penicillin',
            'drugs'                 => [
                [
                    'drug_id'           => $insertedDrugs['Paracetamol 500mg'],
                    'name'              => 'Paracetamol 500mg',
                    'active_ingredient' => 'Paracetamol',
                    'concentration'     => '500mg',
                    'qty'               => 15,
                    'unit'              => 'viên',
                    'dosage'            => '2 viên/lần, 3 lần/ngày',
                    'instruction'       => 'Sau ăn',
                    'category_name'     => 'Giảm đau',
                ],
                [
                    'drug_id'           => $insertedDrugs['Vitamin C 500mg'],
                    'name'              => 'Vitamin C 500mg',
                    'active_ingredient' => 'Ascorbic acid',
                    'concentration'     => '500mg',
                    'qty'               => 14,
                    'unit'              => 'viên',
                    'dosage'            => '1 viên/ngày',
                    'instruction'       => 'Sau bữa ăn sáng',
                    'category_name'     => 'Vitamin',
                ],
            ],
            'prescription_note'     => 'Nghỉ ngơi, giữ ấm cơ thể',
            'status'                => 'done',
            'drug_count'            => 2,
            'created_at'            => new MongoDB\BSON\UTCDateTime(($now - 86400) * 1000), // Hôm qua
            'dispensed_at'          => new MongoDB\BSON\UTCDateTime(($now - 82800) * 1000),
            'dispensed_name'        => 'Dược Sĩ Test',
        ],
    ];

    $insertedRx = [];
    foreach ($prescriptions as $rx) {
        $result       = $rxCol->insertOne($rx);
        $insertedRx[] = $result->getInsertedId();
    }

    // ─── 5. Bills ─────────────────────────────────────────────────────────────
    $billCol = $db->selectCollection('bills');
    $billCol->deleteMany([]);

    $bills = [
        // Hóa đơn chờ thanh toán (liên kết với prescription đầu tiên)
        [
            'invoice_code'   => '',   // Chưa có mã vì chưa thanh toán
            'patient_id'     => $patientId,
            'patient_name'   => 'Bệnh Nhân Test',
            'patient_code'   => $patientCode,
            'doctor_id'      => $doctorId,
            'doctor_name'    => 'BS. Nguyễn Văn Huy',
            'prescription_id'=> $insertedRx[0],
            'diagnosis'      => 'Viêm họng cấp tính',
            'bhyt_code'      => '',
            'items'          => [
                ['description' => 'Phí khám bệnh',     'type' => 'service', 'qty' => 1,  'unit_price' => 200000, 'total' => 200000],
                ['description' => 'Amoxicillin 500mg', 'type' => 'drug',    'qty' => 21, 'unit_price' => 5000,   'total' => 105000],
                ['description' => 'Paracetamol 500mg', 'type' => 'drug',    'qty' => 10, 'unit_price' => 1500,   'total' => 15000],
            ],
            'subtotal'       => 320000,
            'bhyt_amount'    => 0,
            'discount'       => 0,
            'total_amount'   => 320000,
            'service_fee'    => 200000,
            'drug_fee'       => 120000,
            'status'         => 'pending',
            'payment_method' => '',
            'amount_received'=> 0,
            'cashier_id'     => '',
            'cashier_name'   => '',
            'created_at'     => new MongoDB\BSON\UTCDateTime(($now - 3500) * 1000),
        ],
        // Hóa đơn đã thanh toán hôm qua
        [
            'invoice_code'   => 'INV-TEST01',
            'patient_id'     => $patientId,
            'patient_name'   => 'Bệnh Nhân Test',
            'patient_code'   => $patientCode,
            'doctor_id'      => $doctorId,
            'doctor_name'    => 'BS. Nguyễn Văn Huy',
            'prescription_id'=> $insertedRx[1],
            'diagnosis'      => 'Cảm cúm thông thường',
            'bhyt_code'      => '',
            'items'          => [
                ['description' => 'Phí khám bệnh',     'type' => 'service', 'qty' => 1,  'unit_price' => 200000, 'total' => 200000],
                ['description' => 'Paracetamol 500mg', 'type' => 'drug',    'qty' => 15, 'unit_price' => 1500,   'total' => 22500],
                ['description' => 'Vitamin C 500mg',   'type' => 'drug',    'qty' => 14, 'unit_price' => 2000,   'total' => 28000],
            ],
            'subtotal'       => 250500,
            'bhyt_amount'    => 0,
            'discount'       => 0,
            'total_amount'   => 250500,
            'service_fee'    => 200000,
            'drug_fee'       => 50500,
            'status'         => 'paid',
            'payment_method' => 'cash',
            'amount_received'=> 300000,
            'cashier_id'     => (string)$insertedUsers['cashier'],
            'cashier_name'   => 'Thu Ngân Test',
            'created_at'     => new MongoDB\BSON\UTCDateTime(($now - 86400) * 1000),
            'paid_at'        => new MongoDB\BSON\UTCDateTime(($now - 83000) * 1000),
        ],
    ];

    foreach ($bills as $bill) {
        $billCol->insertOne($bill);
    }

    echo "✅ Seed thành công!\n";
    echo "   Users: " . count($userData) . " tài khoản (password: 123456)\n";
    echo "   Drug categories: " . count($catData) . "\n";
    echo "   Drugs: " . count($drugs) . " (có 1 sắp hết hàng, 1 hết hàng, 1 sắp hết hạn)\n";
    echo "   Prescriptions: " . count($prescriptions) . "\n";
    echo "   Bills: " . count($bills) . " (1 chờ TT, 1 đã TT)\n";

} catch (Exception $e) {
    error_log("Lỗi Seeding: " . $e->getMessage());
    echo "❌ Lỗi: " . $e->getMessage() . "\n";
}

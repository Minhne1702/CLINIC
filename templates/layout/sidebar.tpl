{assign var="role" value=$current_user_role|default:$smarty.session.role|default:''}

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{$page_title|default:"MediCare HMS"}</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&family=Be+Vietnam+Pro:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{$BASE_URL}/assets/css/admin.css">
  
  <style>
    .sidebar--patient .sidebar__link { padding: 0.85rem 1.25rem; font-size: 1.05rem; margin-bottom: 0.35rem; border-radius: 8px; }
    .sidebar--patient .sidebar__link i { font-size: 1.15rem; width: 26px; }
    .btn-book-sidebar { display: flex; align-items: center; justify-content: center; gap: 8px; background: linear-gradient(135deg, #0ea5e9, #0284c7); color: #fff !important; padding: 0.85rem; border-radius: 8px; text-decoration: none; font-weight: 600; margin: 1rem; box-shadow: 0 4px 6px -1px rgba(2, 132, 199, 0.2); transition: all 0.2s; }
    .btn-book-sidebar:hover { transform: translateY(-2px); box-shadow: 0 6px 8px -1px rgba(2, 132, 199, 0.3); }
  </style>

  {block name="extra_css"}{/block}
</head>
<body class="{if $role == 'patient'}patient-portal{/if}">

<aside class="sidebar {if $role == 'patient'}sidebar--patient{/if}" id="sidebar">

  <div class="sidebar__logo">
    <div class="sidebar__logo-icon"><i class="fa-solid fa-heart-pulse"></i></div>
    <div class="sidebar__logo-text">
      <span class="sidebar__logo-name">MediCare</span>
      <span class="sidebar__logo-role">
        {if $role == 'admin'}Admin Panel
        {elseif $role == 'doctor'}Bác sĩ
        {elseif $role == 'receptionist'}Lễ tân
        {elseif $role == 'cashier'}Thu ngân
        {elseif $role == 'pharmacist'}Dược sĩ
        {elseif $role == 'patient'}Cổng Bệnh Nhân
        {else}HMS{/if}
      </span>
    </div>
    <button class="sidebar__toggle" id="sidebarToggle">
      <i class="fa-solid fa-chevron-left"></i>
    </button>
  </div>

  <nav class="sidebar__nav">

    {* ===== PATIENT ===== *}
    {if $role == 'patient'}
      <a href="{$BASE_URL}/?page=book" class="btn-book-sidebar">
        <i class="fa-solid fa-calendar-plus"></i> Đặt lịch khám ngay
      </a>

      <div class="sidebar__section-label">Bảng điều khiển</div>
      <a href="{$BASE_URL}/?page=dashboard" class="sidebar__link {if $active_page == 'dashboard'}active{/if}">
        <i class="fa-solid fa-house-medical"></i><span>Tổng quan</span>
      </a>

      <div class="sidebar__section-label">Hồ sơ y tế của tôi</div>
      <a href="{$BASE_URL}/?page=appointments" class="sidebar__link {if $active_page == 'appointments'}active{/if}">
        <i class="fa-solid fa-calendar-check"></i><span>Lịch hẹn</span>
      </a>
      <a href="{$BASE_URL}/?page=records" class="sidebar__link {if $active_page == 'records'}active{/if}">
        <i class="fa-solid fa-folder-open"></i><span>Bệnh án</span>
      </a>
      <a href="{$BASE_URL}/?page=prescriptions" class="sidebar__link {if $active_page == 'prescriptions'}active{/if}">
        <i class="fa-solid fa-prescription"></i><span>Đơn thuốc</span>
      </a>
      <a href="{$BASE_URL}/?page=test-results" class="sidebar__link {if $active_page == 'test-results'}active{/if}">
        <i class="fa-solid fa-flask"></i><span>Xét nghiệm</span>
      </a>

      <div class="sidebar__section-label">Tài khoản</div>
      <a href="{$BASE_URL}/?page=profile" class="sidebar__link {if $active_page == 'profile'}active{/if}">
        <i class="fa-solid fa-id-card"></i><span>Hồ sơ cá nhân</span>
      </a>

    {* ===== ADMIN ===== *}
    {elseif $role == 'admin'}
      <div class="sidebar__section-label">Tổng quan</div>
      <a href="{$BASE_URL}/?page=dashboard"      class="sidebar__link {if $active_page == 'dashboard'}active{/if}"><i class="fa-solid fa-chart-pie"></i><span>Dashboard</span></a>

      <div class="sidebar__section-label">Người dùng</div>
      <a href="{$BASE_URL}/?page=users"          class="sidebar__link {if $active_page == 'users'}active{/if}"><i class="fa-solid fa-users"></i><span>Tài khoản</span></a>
      <a href="{$BASE_URL}/?page=doctors"        class="sidebar__link {if $active_page == 'doctors'}active{/if}"><i class="fa-solid fa-user-doctor"></i><span>Bác sĩ</span></a>
      <a href="{$BASE_URL}/?page=patients"       class="sidebar__link {if $active_page == 'patients'}active{/if}"><i class="fa-solid fa-hospital-user"></i><span>Bệnh nhân</span></a>

      <div class="sidebar__section-label">Danh mục y tế</div>
      <a href="{$BASE_URL}/?page=specialties"    class="sidebar__link {if $active_page == 'specialties'}active{/if}"><i class="fa-solid fa-stethoscope"></i><span>Chuyên khoa</span></a>
      <a href="{$BASE_URL}/?page=diseases"       class="sidebar__link {if $active_page == 'diseases'}active{/if}"><i class="fa-solid fa-virus"></i><span>Bệnh (ICD-10)</span></a>
      <a href="{$BASE_URL}/?page=drugs"          class="sidebar__link {if $active_page == 'drugs'}active{/if}"><i class="fa-solid fa-pills"></i><span>Thuốc</span></a>
      <a href="{$BASE_URL}/?page=drug-categories" class="sidebar__link {if $active_page == 'drug-categories'}active{/if}"><i class="fa-solid fa-layer-group"></i><span>Nhóm thuốc</span></a>

      <div class="sidebar__section-label">Vận hành</div>
      <a href="{$BASE_URL}/?page=appointments"   class="sidebar__link {if $active_page == 'appointments'}active{/if}"><i class="fa-solid fa-calendar-check"></i><span>Lịch hẹn</span></a>
      <a href="{$BASE_URL}/?page=reports"        class="sidebar__link {if $active_page == 'reports'}active{/if}"><i class="fa-solid fa-chart-bar"></i><span>Báo cáo</span></a>
      <a href="{$BASE_URL}/?page=audit-log"      class="sidebar__link {if $active_page == 'audit-log'}active{/if}"><i class="fa-solid fa-shield-halved"></i><span>Audit Log</span></a>
      <a href="{$BASE_URL}/?page=settings"       class="sidebar__link {if $active_page == 'settings'}active{/if}"><i class="fa-solid fa-gear"></i><span>Cài đặt</span></a>

    {* ===== DOCTOR ===== *}
    {elseif $role == 'doctor'}
      <div class="sidebar__section-label">Làm việc</div>
      <a href="{$BASE_URL}/?page=dashboard"     class="sidebar__link {if $active_page == 'dashboard'}active{/if}"><i class="fa-solid fa-house-medical"></i><span>Tổng quan</span></a>
      <a href="{$BASE_URL}/?page=queue"         class="sidebar__link {if $active_page == 'queue'}active{/if}"><i class="fa-solid fa-list-ol"></i><span>Hàng chờ khám</span></a>
      <a href="{$BASE_URL}/?page=appointments"  class="sidebar__link {if $active_page == 'appointments'}active{/if}"><i class="fa-solid fa-calendar-check"></i><span>Lịch hẹn của tôi</span></a>

      <div class="sidebar__section-label">Bệnh nhân</div>
      <a href="{$BASE_URL}/?page=patients"      class="sidebar__link {if $active_page == 'patients'}active{/if}"><i class="fa-solid fa-hospital-user"></i><span>Danh sách BN</span></a>
      <a href="{$BASE_URL}/?page=examination"   class="sidebar__link {if $active_page == 'examination'}active{/if}"><i class="fa-solid fa-notes-medical"></i><span>Khám bệnh</span></a>
      <a href="{$BASE_URL}/?page=prescriptions" class="sidebar__link {if $active_page == 'prescriptions'}active{/if}"><i class="fa-solid fa-prescription"></i><span>Đơn thuốc</span></a>

      <div class="sidebar__section-label">Tra cứu</div>
      <a href="{$BASE_URL}/?page=diseases"      class="sidebar__link {if $active_page == 'diseases'}active{/if}"><i class="fa-solid fa-virus"></i><span>Bệnh (ICD-10)</span></a>
      <a href="{$BASE_URL}/?page=drugs"         class="sidebar__link {if $active_page == 'drugs'}active{/if}"><i class="fa-solid fa-pills"></i><span>Danh mục thuốc</span></a>

      <div class="sidebar__section-label">Cá nhân</div>
      <a href="{$BASE_URL}/?page=schedule"      class="sidebar__link {if $active_page == 'schedule'}active{/if}"><i class="fa-regular fa-calendar"></i><span>Lịch làm việc</span></a>
      <a href="{$BASE_URL}/?page=profile"       class="sidebar__link {if $active_page == 'profile'}active{/if}"><i class="fa-solid fa-id-card"></i><span>Hồ sơ cá nhân</span></a>

    {* ===== RECEPTIONIST ===== *}
    {elseif $role == 'receptionist'}
      <div class="sidebar__section-label">Tiếp nhận</div>
      <a href="{$BASE_URL}/?page=dashboard"   class="sidebar__link {if $active_page == 'dashboard'}active{/if}"><i class="fa-solid fa-house-medical"></i><span>Tổng quan</span></a>
      <a href="{$BASE_URL}/?page=checkin"     class="sidebar__link {if $active_page == 'checkin'}active{/if}"><i class="fa-solid fa-qrcode"></i><span>Check-in BN</span></a>
      <a href="{$BASE_URL}/?page=queue"       class="sidebar__link {if $active_page == 'queue'}active{/if}"><i class="fa-solid fa-list-ol"></i><span>Hàng chờ</span></a>

      <div class="sidebar__section-label">Lịch hẹn</div>
      <a href="{$BASE_URL}/?page=appointments" class="sidebar__link {if $active_page == 'appointments'}active{/if}"><i class="fa-solid fa-calendar-check"></i><span>Quản lý lịch hẹn</span></a>
      <a href="{$BASE_URL}/?page=walk-in"     class="sidebar__link {if $active_page == 'walk-in'}active{/if}"><i class="fa-solid fa-person-walking-arrow-right"></i><span>Đăng ký tại chỗ</span></a>

      <div class="sidebar__section-label">Bệnh nhân</div>
      <a href="{$BASE_URL}/?page=patients"    class="sidebar__link {if $active_page == 'patients'}active{/if}"><i class="fa-solid fa-hospital-user"></i><span>Hồ sơ bệnh nhân</span></a>
      <a href="{$BASE_URL}/?page=patient-new" class="sidebar__link {if $active_page == 'patient-new'}active{/if}"><i class="fa-solid fa-user-plus"></i><span>Thêm bệnh nhân</span></a>

      <div class="sidebar__section-label">Danh mục</div>
      <a href="{$BASE_URL}/?page=doctors"     class="sidebar__link {if $active_page == 'doctors'}active{/if}"><i class="fa-solid fa-user-doctor"></i><span>Bác sĩ &amp; lịch trực</span></a>

    {* ===== CASHIER ===== *}
    {elseif $role == 'cashier'}
      <div class="sidebar__section-label">Thanh toán</div>
      <a href="{$BASE_URL}/?page=dashboard"    class="sidebar__link {if $active_page == 'dashboard'}active{/if}"><i class="fa-solid fa-house-medical"></i><span>Tổng quan</span></a>
      <a href="{$BASE_URL}/?page=billing"      class="sidebar__link {if $active_page == 'billing'}active{/if}"><i class="fa-solid fa-file-invoice-dollar"></i><span>Lập hóa đơn</span></a>
      <a href="{$BASE_URL}/?page=pending"      class="sidebar__link {if $active_page == 'pending'}active{/if}">
        <i class="fa-solid fa-clock"></i><span>Chờ thanh toán</span>
        {if $pending_count > 0}<span class="sidebar__badge">{$pending_count}</span>{/if}
      </a>
      <a href="{$BASE_URL}/?page=history"      class="sidebar__link {if $active_page == 'history'}active{/if}"><i class="fa-solid fa-clock-rotate-left"></i><span>Lịch sử thanh toán</span></a>

      <div class="sidebar__section-label">Công cụ</div>
      <a href="{$BASE_URL}/?page=advance"      class="sidebar__link {if $active_page == 'advance'}active{/if}"><i class="fa-solid fa-hand-holding-dollar"></i><span>Tạm ứng</span></a>
      <a href="{$BASE_URL}/?page=insurance"    class="sidebar__link {if $active_page == 'insurance'}active{/if}"><i class="fa-solid fa-shield-heart"></i><span>BHYT</span></a>
      <a href="{$BASE_URL}/?page=reports"      class="sidebar__link {if $active_page == 'reports'}active{/if}"><i class="fa-solid fa-chart-bar"></i><span>Báo cáo doanh thu</span></a>

    {* ===== PHARMACIST ===== *}
    {elseif $role == 'pharmacist'}
      <div class="sidebar__section-label">Nhà thuốc</div>
      <a href="{$BASE_URL}/?page=dashboard"    class="sidebar__link {if $active_page == 'dashboard'}active{/if}"><i class="fa-solid fa-house-medical"></i><span>Tổng quan</span></a>
      <a href="{$BASE_URL}/?page=prescriptions" class="sidebar__link {if $active_page == 'prescriptions'}active{/if}">
        <i class="fa-solid fa-prescription"></i><span>Đơn thuốc đến</span>
        {if $new_rx_count > 0}<span class="sidebar__badge">{$new_rx_count}</span>{/if}
      </a>
      <a href="{$BASE_URL}/?page=dispensing"   class="sidebar__link {if $active_page == 'dispensing'}active{/if}"><i class="fa-solid fa-capsules"></i><span>Phát thuốc</span></a>

      <div class="sidebar__section-label">Kho thuốc</div>
      <a href="{$BASE_URL}/?page=inventory"    class="sidebar__link {if $active_page == 'inventory'}active{/if}"><i class="fa-solid fa-boxes-stacked"></i><span>Tồn kho</span></a>
      <a href="{$BASE_URL}/?page=stock-in"     class="sidebar__link {if $active_page == 'stock-in'}active{/if}"><i class="fa-solid fa-truck-ramp-box"></i><span>Nhập kho</span></a>
      <a href="{$BASE_URL}/?page=low-stock"    class="sidebar__link {if $active_page == 'low-stock'}active{/if}"><i class="fa-solid fa-triangle-exclamation"></i><span>Sắp hết hàng</span></a>
      <a href="{$BASE_URL}/?page=expiring"     class="sidebar__link {if $active_page == 'expiring'}active{/if}"><i class="fa-regular fa-calendar-xmark"></i><span>Sắp hết hạn</span></a>

      <div class="sidebar__section-label">Danh mục</div>
      <a href="{$BASE_URL}/?page=drugs"        class="sidebar__link {if $active_page == 'drugs'}active{/if}"><i class="fa-solid fa-pills"></i><span>Danh mục thuốc</span></a>
      <a href="{$BASE_URL}/?page=drug-categories" class="sidebar__link {if $active_page == 'drug-categories'}active{/if}"><i class="fa-solid fa-layer-group"></i><span>Nhóm thuốc</span></a>
      <a href="{$BASE_URL}/?page=reports"      class="sidebar__link {if $active_page == 'reports'}active{/if}"><i class="fa-solid fa-chart-bar"></i><span>Báo cáo</span></a>

    {/if}

  </nav>

  <div class="sidebar__footer">
    <div class="sidebar__avatar">{$current_user_name|default:"?"|truncate:1:""}</div>
    <div class="sidebar__user-info">
      <strong>{$current_user_name|default:"Người dùng"}</strong>
      <span>
        {if $role == 'admin'}Quản trị viên
        {elseif $role == 'doctor'}Bác sĩ
        {elseif $role == 'receptionist'}Lễ tân
        {elseif $role == 'cashier'}Thu ngân
        {elseif $role == 'pharmacist'}Dược sĩ
        {elseif $role == 'patient'}Bệnh nhân
        {/if}
      </span>
    </div>
    <a href="{$BASE_URL}/?action=logout" class="sidebar__logout" title="Đăng xuất">
      <i class="fa-solid fa-right-from-bracket"></i>
    </a>
  </div>

</aside>

<div class="admin-main" id="adminMain">

  <header class="admin-topnav">
    <div class="admin-topnav__left">
      <button class="btn-hamburger" id="mobileSidebarToggle">
        <i class="fa-solid fa-bars"></i>
      </button>
      <div class="admin-breadcrumb">
        <span>
          {if $role == 'admin'}Admin
          {elseif $role == 'doctor'}Bác sĩ
          {elseif $role == 'receptionist'}Lễ tân
          {elseif $role == 'cashier'}Thu ngân
          {elseif $role == 'pharmacist'}Dược sĩ
          {elseif $role == 'patient'}Cổng Bệnh Nhân
          {/if}
        </span>
        <i class="fa-solid fa-chevron-right"></i>
        <span>{$page_title|default:"Tổng quan"}</span>
      </div>
    </div>
    <div class="admin-topnav__right">
      <button class="topnav-btn" title="Thông báo">
        <i class="fa-regular fa-bell"></i>
        {if isset($notification_count) && $notification_count > 0}
        <span class="badge badge--danger">{$notification_count}</span>
        {/if}
      </button>
      <div class="topnav-user">
        <div class="topnav-avatar">{$current_user_name|default:"?"|truncate:1:""}</div>
        <span>{$current_user_name|default:"Người dùng"}</span>
        <a href="{$BASE_URL}/?action=logout" class="topnav-logout">
          <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
        </a>
      </div>
    </div>
  </header>

  <div class="admin-content">
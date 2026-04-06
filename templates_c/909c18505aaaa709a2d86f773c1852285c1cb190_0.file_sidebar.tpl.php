<?php
/* Smarty version 5.8.0, created on 2026-04-06 05:40:31
  from 'file:layout/sidebar.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d32b2f33d984_12702624',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '909c18505aaaa709a2d86f773c1852285c1cb190' => 
    array (
      0 => 'layout/sidebar.tpl',
      1 => 1775437634,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_69d32b2f33d984_12702624 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\layout';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo (($tmp = $_smarty_tpl->getValue('page_title') ?? null)===null||$tmp==='' ? "MediCare HMS" ?? null : $tmp);?>
</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&family=Be+Vietnam+Pro:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="/CLINIC/public/assets/css/admin.css">
  <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_99650336969d32b2f20de26_54073801', "extra_css");
?>

</head>
<body>

<?php $_smarty_tpl->assign('role', (($tmp = $_smarty_tpl->getValue('current_user_role') ?? null)===null||$tmp==='' ? '' ?? null : $tmp), false, NULL);?>

<!-- ===== SIDEBAR ===== -->
<aside class="sidebar" id="sidebar">

  <div class="sidebar__logo">
    <div class="sidebar__logo-icon"><i class="fa-solid fa-heart-pulse"></i></div>
    <div class="sidebar__logo-text">
      <span class="sidebar__logo-name">MediCare</span>
      <span class="sidebar__logo-role">
        <?php if ($_smarty_tpl->getValue('role') == 'admin') {?>Admin Panel
        <?php } elseif ($_smarty_tpl->getValue('role') == 'doctor') {?>Bác sĩ
        <?php } elseif ($_smarty_tpl->getValue('role') == 'receptionist') {?>Lễ tân
        <?php } elseif ($_smarty_tpl->getValue('role') == 'cashier') {?>Thu ngân
        <?php } elseif ($_smarty_tpl->getValue('role') == 'pharmacist') {?>Dược sĩ
        <?php } else { ?>HMS<?php }?>
      </span>
    </div>
    <button class="sidebar__toggle" id="sidebarToggle">
      <i class="fa-solid fa-chevron-left"></i>
    </button>
  </div>

  <nav class="sidebar__nav">

        <?php if ($_smarty_tpl->getValue('role') == 'admin') {?>
      <div class="sidebar__section-label">Tổng quan</div>
      <a href="/CLINIC/public/?role=admin&page=dashboard"      class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'dashboard') {?>active<?php }?>"><i class="fa-solid fa-chart-pie"></i><span>Dashboard</span></a>

      <div class="sidebar__section-label">Người dùng</div>
      <a href="/CLINIC/public/?role=admin&page=users"          class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'users') {?>active<?php }?>"><i class="fa-solid fa-users"></i><span>Tài khoản</span></a>
      <a href="/CLINIC/public/?role=admin&page=doctors"        class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'doctors') {?>active<?php }?>"><i class="fa-solid fa-user-doctor"></i><span>Bác sĩ</span></a>
      <a href="/CLINIC/public/?role=admin&page=patients"       class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'patients') {?>active<?php }?>"><i class="fa-solid fa-hospital-user"></i><span>Bệnh nhân</span></a>

      <div class="sidebar__section-label">Danh mục y tế</div>
      <a href="/CLINIC/public/?role=admin&page=specialties"    class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'specialties') {?>active<?php }?>"><i class="fa-solid fa-stethoscope"></i><span>Chuyên khoa</span></a>
      <a href="/CLINIC/public/?role=admin&page=diseases"       class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'diseases') {?>active<?php }?>"><i class="fa-solid fa-virus"></i><span>Bệnh (ICD-10)</span></a>
      <a href="/CLINIC/public/?role=admin&page=drugs"          class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'drugs') {?>active<?php }?>"><i class="fa-solid fa-pills"></i><span>Thuốc</span></a>
      <a href="/CLINIC/public/?role=admin&page=drug-categories" class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'drug-categories') {?>active<?php }?>"><i class="fa-solid fa-layer-group"></i><span>Nhóm thuốc</span></a>

      <div class="sidebar__section-label">Vận hành</div>
      <a href="/CLINIC/public/?role=admin&page=appointments"   class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'appointments') {?>active<?php }?>"><i class="fa-solid fa-calendar-check"></i><span>Lịch hẹn</span></a>
      <a href="/CLINIC/public/?role=admin&page=reports"        class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'reports') {?>active<?php }?>"><i class="fa-solid fa-chart-bar"></i><span>Báo cáo</span></a>
      <a href="/CLINIC/public/?role=admin&page=audit-log"      class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'audit-log') {?>active<?php }?>"><i class="fa-solid fa-shield-halved"></i><span>Audit Log</span></a>
      <a href="/CLINIC/public/?role=admin&page=settings"       class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'settings') {?>active<?php }?>"><i class="fa-solid fa-gear"></i><span>Cài đặt</span></a>

        <?php } elseif ($_smarty_tpl->getValue('role') == 'doctor') {?>
      <div class="sidebar__section-label">Làm việc</div>
      <a href="/CLINIC/public/?role=doctor&page=dashboard"     class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'dashboard') {?>active<?php }?>"><i class="fa-solid fa-house-medical"></i><span>Tổng quan</span></a>
      <a href="/CLINIC/public/?role=doctor&page=queue"         class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'queue') {?>active<?php }?>"><i class="fa-solid fa-list-ol"></i><span>Hàng chờ khám</span></a>
      <a href="/CLINIC/public/?role=doctor&page=appointments"  class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'appointments') {?>active<?php }?>"><i class="fa-solid fa-calendar-check"></i><span>Lịch hẹn của tôi</span></a>

      <div class="sidebar__section-label">Bệnh nhân</div>
      <a href="/CLINIC/public/?role=doctor&page=patients"      class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'patients') {?>active<?php }?>"><i class="fa-solid fa-hospital-user"></i><span>Danh sách BN</span></a>
      <a href="/CLINIC/public/?role=doctor&page=examination"   class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'examination') {?>active<?php }?>"><i class="fa-solid fa-notes-medical"></i><span>Khám bệnh</span></a>
      <a href="/CLINIC/public/?role=doctor&page=prescriptions" class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'prescriptions') {?>active<?php }?>"><i class="fa-solid fa-prescription"></i><span>Đơn thuốc</span></a>

      <div class="sidebar__section-label">Tra cứu</div>
      <a href="/CLINIC/public/?role=doctor&page=diseases"      class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'diseases') {?>active<?php }?>"><i class="fa-solid fa-virus"></i><span>Bệnh (ICD-10)</span></a>
      <a href="/CLINIC/public/?role=doctor&page=drugs"         class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'drugs') {?>active<?php }?>"><i class="fa-solid fa-pills"></i><span>Danh mục thuốc</span></a>

      <div class="sidebar__section-label">Cá nhân</div>
      <a href="/CLINIC/public/?role=doctor&page=schedule"      class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'schedule') {?>active<?php }?>"><i class="fa-regular fa-calendar"></i><span>Lịch làm việc</span></a>
      <a href="/CLINIC/public/?role=doctor&page=profile"       class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'profile') {?>active<?php }?>"><i class="fa-solid fa-id-card"></i><span>Hồ sơ cá nhân</span></a>

        <?php } elseif ($_smarty_tpl->getValue('role') == 'receptionist') {?>
      <div class="sidebar__section-label">Tiếp nhận</div>
      <a href="/CLINIC/public/?role=receptionist&page=dashboard"   class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'dashboard') {?>active<?php }?>"><i class="fa-solid fa-house-medical"></i><span>Tổng quan</span></a>
      <a href="/CLINIC/public/?role=receptionist&page=checkin"     class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'checkin') {?>active<?php }?>"><i class="fa-solid fa-qrcode"></i><span>Check-in BN</span></a>
      <a href="/CLINIC/public/?role=receptionist&page=queue"       class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'queue') {?>active<?php }?>"><i class="fa-solid fa-list-ol"></i><span>Hàng chờ</span></a>

      <div class="sidebar__section-label">Lịch hẹn</div>
      <a href="/CLINIC/public/?role=receptionist&page=appointments" class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'appointments') {?>active<?php }?>"><i class="fa-solid fa-calendar-check"></i><span>Quản lý lịch hẹn</span></a>
      <a href="/CLINIC/public/?role=receptionist&page=walk-in"     class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'walk-in') {?>active<?php }?>"><i class="fa-solid fa-person-walking-arrow-right"></i><span>Đăng ký tại chỗ</span></a>

      <div class="sidebar__section-label">Bệnh nhân</div>
      <a href="/CLINIC/public/?role=receptionist&page=patients"    class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'patients') {?>active<?php }?>"><i class="fa-solid fa-hospital-user"></i><span>Hồ sơ bệnh nhân</span></a>
      <a href="/CLINIC/public/?role=receptionist&page=patient-new" class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'patient-new') {?>active<?php }?>"><i class="fa-solid fa-user-plus"></i><span>Thêm bệnh nhân</span></a>

      <div class="sidebar__section-label">Danh mục</div>
      <a href="/CLINIC/public/?role=receptionist&page=doctors"     class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'doctors') {?>active<?php }?>"><i class="fa-solid fa-user-doctor"></i><span>Bác sĩ &amp; lịch trực</span></a>

        <?php } elseif ($_smarty_tpl->getValue('role') == 'cashier') {?>
      <div class="sidebar__section-label">Thanh toán</div>
      <a href="/CLINIC/public/?role=cashier&page=dashboard"    class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'dashboard') {?>active<?php }?>"><i class="fa-solid fa-house-medical"></i><span>Tổng quan</span></a>
      <a href="/CLINIC/public/?role=cashier&page=billing"      class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'billing') {?>active<?php }?>"><i class="fa-solid fa-file-invoice-dollar"></i><span>Lập hóa đơn</span></a>
      <a href="/CLINIC/public/?role=cashier&page=pending"      class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'pending') {?>active<?php }?>">
        <i class="fa-solid fa-clock"></i><span>Chờ thanh toán</span>
        <?php if ($_smarty_tpl->getValue('pending_count') > 0) {?><span class="sidebar__badge"><?php echo $_smarty_tpl->getValue('pending_count');?>
</span><?php }?>
      </a>
      <a href="/CLINIC/public/?role=cashier&page=history"      class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'history') {?>active<?php }?>"><i class="fa-solid fa-clock-rotate-left"></i><span>Lịch sử thanh toán</span></a>

      <div class="sidebar__section-label">Công cụ</div>
      <a href="/CLINIC/public/?role=cashier&page=advance"      class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'advance') {?>active<?php }?>"><i class="fa-solid fa-hand-holding-dollar"></i><span>Tạm ứng</span></a>
      <a href="/CLINIC/public/?role=cashier&page=insurance"    class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'insurance') {?>active<?php }?>"><i class="fa-solid fa-shield-heart"></i><span>BHYT</span></a>
      <a href="/CLINIC/public/?role=cashier&page=reports"      class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'reports') {?>active<?php }?>"><i class="fa-solid fa-chart-bar"></i><span>Báo cáo doanh thu</span></a>

        <?php } elseif ($_smarty_tpl->getValue('role') == 'pharmacist') {?>
      <div class="sidebar__section-label">Nhà thuốc</div>
      <a href="/CLINIC/public/?role=pharmacist&page=dashboard"    class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'dashboard') {?>active<?php }?>"><i class="fa-solid fa-house-medical"></i><span>Tổng quan</span></a>
      <a href="/CLINIC/public/?role=pharmacist&page=prescriptions" class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'prescriptions') {?>active<?php }?>">
        <i class="fa-solid fa-prescription"></i><span>Đơn thuốc đến</span>
        <?php if ($_smarty_tpl->getValue('new_rx_count') > 0) {?><span class="sidebar__badge"><?php echo $_smarty_tpl->getValue('new_rx_count');?>
</span><?php }?>
      </a>
      <a href="/CLINIC/public/?role=pharmacist&page=dispensing"   class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'dispensing') {?>active<?php }?>"><i class="fa-solid fa-capsules"></i><span>Phát thuốc</span></a>

      <div class="sidebar__section-label">Kho thuốc</div>
      <a href="/CLINIC/public/?role=pharmacist&page=inventory"    class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'inventory') {?>active<?php }?>"><i class="fa-solid fa-boxes-stacking"></i><span>Tồn kho</span></a>
      <a href="/CLINIC/public/?role=pharmacist&page=stock-in"     class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'stock-in') {?>active<?php }?>"><i class="fa-solid fa-truck-ramp-box"></i><span>Nhập kho</span></a>
      <a href="/CLINIC/public/?role=pharmacist&page=low-stock"    class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'low-stock') {?>active<?php }?>"><i class="fa-solid fa-triangle-exclamation"></i><span>Sắp hết hàng</span></a>
      <a href="/CLINIC/public/?role=pharmacist&page=expiring"     class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'expiring') {?>active<?php }?>"><i class="fa-regular fa-calendar-xmark"></i><span>Sắp hết hạn</span></a>

      <div class="sidebar__section-label">Danh mục</div>
      <a href="/CLINIC/public/?role=pharmacist&page=drugs"        class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'drugs') {?>active<?php }?>"><i class="fa-solid fa-pills"></i><span>Danh mục thuốc</span></a>
      <a href="/CLINIC/public/?role=pharmacist&page=drug-categories" class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'drug-categories') {?>active<?php }?>"><i class="fa-solid fa-layer-group"></i><span>Nhóm thuốc</span></a>
      <a href="/CLINIC/public/?role=pharmacist&page=reports"      class="sidebar__link <?php if ($_smarty_tpl->getValue('active_page') == 'reports') {?>active<?php }?>"><i class="fa-solid fa-chart-bar"></i><span>Báo cáo</span></a>

    <?php }?>

  </nav>

  <!-- Footer user info -->
  <div class="sidebar__footer">
    <div class="sidebar__avatar"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')((($tmp = $_smarty_tpl->getValue('current_user_name') ?? null)===null||$tmp==='' ? "?" ?? null : $tmp),1,'');?>
</div>
    <div class="sidebar__user-info">
      <strong><?php echo (($tmp = $_smarty_tpl->getValue('current_user_name') ?? null)===null||$tmp==='' ? "Người dùng" ?? null : $tmp);?>
</strong>
      <span>
        <?php if ($_smarty_tpl->getValue('role') == 'admin') {?>Quản trị viên
        <?php } elseif ($_smarty_tpl->getValue('role') == 'doctor') {?>Bác sĩ
        <?php } elseif ($_smarty_tpl->getValue('role') == 'receptionist') {?>Lễ tân
        <?php } elseif ($_smarty_tpl->getValue('role') == 'cashier') {?>Thu ngân
        <?php } elseif ($_smarty_tpl->getValue('role') == 'pharmacist') {?>Dược sĩ
        <?php }?>
      </span>
    </div>
    <a href="/CLINIC/public/?action=logout" class="sidebar__logout" title="Đăng xuất">
      <i class="fa-solid fa-right-from-bracket"></i>
    </a>
  </div>

</aside>

<!-- ===== MAIN WRAPPER ===== -->
<div class="admin-main" id="adminMain">

  <!-- TOP NAV -->
  <header class="admin-topnav">
    <div class="admin-topnav__left">
      <button class="btn-hamburger" id="mobileSidebarToggle">
        <i class="fa-solid fa-bars"></i>
      </button>
      <div class="admin-breadcrumb">
        <span>
          <?php if ($_smarty_tpl->getValue('role') == 'admin') {?>Admin
          <?php } elseif ($_smarty_tpl->getValue('role') == 'doctor') {?>Bác sĩ
          <?php } elseif ($_smarty_tpl->getValue('role') == 'receptionist') {?>Lễ tân
          <?php } elseif ($_smarty_tpl->getValue('role') == 'cashier') {?>Thu ngân
          <?php } elseif ($_smarty_tpl->getValue('role') == 'pharmacist') {?>Dược sĩ
          <?php }?>
        </span>
        <i class="fa-solid fa-chevron-right"></i>
        <span><?php echo (($tmp = $_smarty_tpl->getValue('page_title') ?? null)===null||$tmp==='' ? "Tổng quan" ?? null : $tmp);?>
</span>
      </div>
    </div>
    <div class="admin-topnav__right">
      <button class="topnav-btn" title="Thông báo">
        <i class="fa-regular fa-bell"></i>
        <?php if ($_smarty_tpl->getValue('notification_count') > 0) {?>
        <span class="badge badge--danger"><?php echo $_smarty_tpl->getValue('notification_count');?>
</span>
        <?php }?>
      </button>
      <div class="topnav-user">
        <div class="topnav-avatar"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')((($tmp = $_smarty_tpl->getValue('current_user_name') ?? null)===null||$tmp==='' ? "?" ?? null : $tmp),1,'');?>
</div>
        <span><?php echo (($tmp = $_smarty_tpl->getValue('current_user_name') ?? null)===null||$tmp==='' ? "Người dùng" ?? null : $tmp);?>
</span>
        <a href="/CLINIC/public/?action=logout" class="topnav-logout">
          <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
        </a>
      </div>
    </div>
  </header>

  <!-- PAGE CONTENT -->
  <div class="admin-content">
<?php }
/* {block "extra_css"} */
class Block_99650336969d32b2f20de26_54073801 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\layout';
}
}
/* {/block "extra_css"} */
}

<?php
/* Smarty version 5.8.0, created on 2026-04-10 13:56:40
  from 'file:patient/dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d90198832e44_65828525',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d233d7bd3279144aa35324086d7e659d70d3b20' => 
    array (
      0 => 'patient/dashboard.tpl',
      1 => 1775782839,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/header.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d90198832e44_65828525 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\patient';
$_smarty_tpl->renderSubTemplate("file:layout/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Tổng quan Bệnh nhân",'active_page'=>"dashboard"), (int) 0, $_smarty_current_dir);
?>

<style>
  /* Layout Welcome */
  .patient-welcome { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; background: linear-gradient(to right, #f0f9ff, #e0f2fe); padding: 1.5rem 2rem; border-radius: 12px; margin-top: 1.5rem; margin-bottom: 2rem; border: 1px solid #bae6fd; }
  .patient-welcome__text h2 { margin: 0 0 0.5rem 0; font-size: 1.8rem; color: #0f172a; }
  .patient-welcome__text p { margin: 0; color: #475569; font-size: 1rem; }
  
  /* Thẻ thống kê 4 ô - FIX ICON CENTER */
  .patient-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
  .patient-stat-card { background: #fff; padding: 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 1.25rem; text-decoration: none; transition: all 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
  .patient-stat-card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-color: #0284c7; }
  
  .patient-stat-icon { 
    font-size: 1.5rem; color: var(--c); background: #f8fafc; 
    width: 56px; height: 56px; 
    display: flex; align-items: center; justify-content: center; /* Quan trọng để căn giữa icon */
    border-radius: 50%; flex-shrink: 0; 
  }
  .patient-stat-text p { margin: 0; font-size: 0.9rem; color: #64748b; font-weight: 500; }
  .patient-stat-text strong { font-size: 1.5rem; color: #0f172a; display: block; margin-top: 0.25rem; }

  /* Grid chính - FIX LỖI LỆCH TRANG */
  .dashboard-main-grid {
    display: grid;
    grid-template-columns: 1fr; /* Mobile 1 cột */
    gap: 1.5rem;
    margin-bottom: 2rem;
  }
  @media (min-width: 992px) { 
      .dashboard-main-grid { grid-template-columns: 1fr 1fr; /* PC 2 cột bằng nhau */ } 
  }

  .full-height-card {
    background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem;
    display: flex; flex-direction: column; height: 100%; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
  }
  
  .empty-placeholder {
    flex: 1; display: flex; align-items: center; justify-content: center;
    border: 1px dashed #e2e8f0; border-radius: 8px; min-height: 150px; text-align: center;
  }

  @media (max-width: 768px) {
      .patient-welcome__btn { margin-top: 1rem; width: 100%; justify-content: center; }
  }
</style>

<div class="patient-welcome">
  <div class="patient-welcome__text">
    <h2>Xin chào, <span style="color:#0284c7;"><?php echo (($tmp = $_smarty_tpl->getValue('current_user_name') ?? null)===null||$tmp==='' ? "Bạn" ?? null : $tmp);?>
</span> 👋</h2>
    <p>Hôm nay <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),"%d/%m/%Y");?>
 — Chúc bạn một ngày nhiều sức khỏe!</p>
  </div>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=book" class="btn-primary patient-welcome__btn" style="padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 500; background-color: #0284c7; color: #fff;">
    <i class="fa-regular fa-calendar-plus"></i> Đặt lịch khám mới
  </a>
</div>

<?php if ((true && ($_smarty_tpl->hasVariable('today_visit') && null !== ($_smarty_tpl->getValue('today_visit') ?? null))) && $_smarty_tpl->getValue('today_visit')) {?>
<div class="dashboard-alert" style="background: #eff6ff; border-left: 4px solid #3b82f6; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
  <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div>
      <h3 style="color: #1e3a8a; margin-bottom: 0.5rem; font-size: 1.2rem;"><i class="fa-solid fa-truck-medical"></i> Lịch khám hôm nay</h3>
      <p style="margin: 0; color: #1e40af;">Khoa: <strong><?php echo $_smarty_tpl->getValue('today_visit')['specialty'];?>
</strong> | Bác sĩ: <strong><?php echo $_smarty_tpl->getValue('today_visit')['doctor_name'];?>
</strong></p>
      <div style="margin-top: 0.75rem;">
        <span class="badge" style="padding: 0.4rem 0.8rem; background: #dbeafe; color: #1e40af; border-radius: 6px;">STT: <strong><?php echo (($tmp = $_smarty_tpl->getValue('today_visit')['queue_number'] ?? null)===null||$tmp==='' ? 'Chờ cấp' ?? null : $tmp);?>
</strong></span>
        <span class="badge" style="padding: 0.4rem 0.8rem; margin-left: 0.5rem; background: #fef3c7; color: #92400e; border-radius: 6px;"><?php echo (($tmp = $_smarty_tpl->getValue('today_visit')['status_text'] ?? null)===null||$tmp==='' ? 'Đang chờ' ?? null : $tmp);?>
</span>
      </div>
    </div>
    <button onclick="showQRCode('<?php echo $_smarty_tpl->getValue('today_visit')['qr_code'];?>
')" style="padding: 0.75rem 1.25rem; background: #0284c7; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-weight: 500;">
      <i class="fa-solid fa-qrcode"></i> Mã QR Check-in
    </button>
  </div>
</div>
<?php }?>
<div class="patient-stats">
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#0284c7"><i class="fa-regular fa-calendar-check"></i></div>
    <div class="patient-stat-text"><p>Lịch hẹn sắp tới</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['upcoming'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div>
  </a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=prescriptions" class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-prescription-bottle-medical"></i></div>
    <div class="patient-stat-text"><p>Đơn thuốc của tôi</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['prescriptions'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div>
  </a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=test-results" class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-microscope"></i></div>
    <div class="patient-stat-text"><p>Kết quả xét nghiệm</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['test_results'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div>
  </a>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=records" class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-solid fa-folder-open"></i></div>
    <div class="patient-stat-text"><p>Hồ sơ bệnh án</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['records'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div>
  </a>
</div>

<div class="dashboard-main-grid">
  <div class="full-height-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 1rem;">
      <h3 style="margin: 0; font-size: 1.1rem; color: #0f172a;"><i class="fa-regular fa-calendar-days" style="color: #0284c7; margin-right: 5px;"></i> Lịch hẹn sắp tới</h3>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=appointments" style="color: #0284c7; text-decoration: none; font-size: 0.85rem;">Xem tất cả &rarr;</a>
    </div>
    
    <div class="card-content-area" style="flex:1">
      <?php if ((true && ($_smarty_tpl->hasVariable('upcoming_appointments') && null !== ($_smarty_tpl->getValue('upcoming_appointments') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('upcoming_appointments')) > 0) {?>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('upcoming_appointments'), 'apt');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('apt')->value) {
$foreach0DoElse = false;
?>
          <div style="display: flex; gap: 1rem; padding: 1rem; border-bottom: 1px solid #f1f5f9; align-items: center;">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.5rem; text-align: center; min-width: 70px;">
              <strong style="display: block; font-size: 1.3rem; color: #0284c7;"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('apt')['date'],"%d");?>
</strong>
              <small><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('apt')['date'],"%m/%Y");?>
</small>
            </div>
            <div style="flex: 1;">
              <strong style="color: #0f172a;">BS. <?php echo $_smarty_tpl->getValue('apt')['doctor_name'];?>
</strong>
              <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Khoa: <?php echo $_smarty_tpl->getValue('apt')['specialty'];?>
</p>
            </div>
          </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      <?php } else { ?>
        <div class="empty-placeholder"><p style="color: #94a3b8;">Bạn không có lịch hẹn nào sắp tới.</p></div>
      <?php }?>
    </div>
  </div>

  <div class="full-height-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 1rem;">
      <h3 style="margin: 0; font-size: 1.1rem; color: #0f172a;"><i class="fa-solid fa-folder-open" style="color: #f59e0b; margin-right: 5px;"></i> Hồ sơ khám gần đây</h3>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=records" style="color: #0284c7; text-decoration: none; font-size: 0.85rem;">Tất cả hồ sơ &rarr;</a>
    </div>
    
    <div class="card-content-area" style="flex:1">
      <?php if ((true && ($_smarty_tpl->hasVariable('recent_records') && null !== ($_smarty_tpl->getValue('recent_records') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('recent_records')) > 0) {?>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('recent_records'), 'rec');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('rec')->value) {
$foreach1DoElse = false;
?>
          <div style="display: flex; align-items: center; gap: 1rem; padding: 0.75rem 0; border-bottom: 1px solid #f1f5f9;">
            <div style="flex: 1;">
              <strong style="color: #0f172a;"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')((($tmp = $_smarty_tpl->getValue('rec')['diagnosis'] ?? null)===null||$tmp==='' ? 'Chẩn đoán tổng quát' ?? null : $tmp),40);?>
</strong>
              <p style="margin: 0; color: #64748b; font-size: 0.8rem;">Ngày khám: <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('rec')['date'],"%d/%m/%Y");?>
</p>
            </div>
            <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=records&id=<?php echo (($tmp = $_smarty_tpl->getValue('rec')['id'] ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('rec')['_id'] ?? null : $tmp);?>
" style="color: #0284c7;"><i class="fa-solid fa-chevron-right"></i></a>
          </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      <?php } else { ?>
        <div class="empty-placeholder"><p style="color: #94a3b8;">Chưa có hồ sơ bệnh án.</p></div>
      <?php }?>
    </div>
  </div>
</div>

<?php if ((true && ($_smarty_tpl->hasVariable('notifications') && null !== ($_smarty_tpl->getValue('notifications') ?? null))) && $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('notifications')) > 0) {?>
<div class="full-height-card" style="margin-bottom: 2rem;">
  <h3 style="margin: 0 0 1rem 0; font-size: 1.1rem; color: #0f172a;"><i class="fa-regular fa-bell" style="color: #f59e0b; margin-right: 5px;"></i> Thông báo hệ thống</h3>
  <div class="notif-list">
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('notifications'), 'notif');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('notif')->value) {
$foreach2DoElse = false;
?>
      <div style="padding: 1rem; border-bottom: 1px solid #f1f5f9; <?php if (!$_smarty_tpl->getValue('notif')['is_read']) {?>background-color: #f0f9ff;<?php }?> border-radius: 8px; margin-bottom: 5px;">
        <p style="margin: 0; font-size: 0.95rem; color: #1e293b;"><?php echo $_smarty_tpl->getValue('notif')['message'];?>
</p>
        <small style="color: #64748b;"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('notif')['created_at'],"%H:%M %d/%m/%Y");?>
</small>
      </div>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  </div>
</div>
<?php }?>

<div id="qrModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
  <div style="background: #fff; padding: 2rem; border-radius: 12px; width: 90%; max-width: 350px; text-align: center; position: relative;">
    <span style="position: absolute; top: 10px; right: 15px; font-size: 24px; cursor: pointer;" onclick="document.getElementById('qrModal').style.display='none'">&times;</span>
    <h3 style="margin-bottom: 1rem;">Mã QR Check-in</h3>
    <div id="qrCodeContainer"></div>
    <p style="font-size: 0.85rem; color: #64748b; margin-top: 1rem;">Quét mã này tại quầy lễ tân khi đến khám.</p>
  </div>
</div>

<?php echo '<script'; ?>
>

  function showQRCode(qrData) {
    if(!qrData) { alert("Dữ liệu QR chưa sẵn sàng."); return; }
    const container = document.getElementById('qrCodeContainer');
    container.innerHTML = `<img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrData}" style="border: 1px solid #e2e8f0; padding: 10px; border-radius: 8px;"/>`;
    document.getElementById('qrModal').style.display = 'flex';
  }

<?php echo '</script'; ?>
>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

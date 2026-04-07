<?php
/* Smarty version 5.8.0, created on 2026-04-07 07:16:15
  from 'file:doctor/dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d4931f746be7_22039485',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3386192dd0f88f6e7a0fe564ac81e98658d05696' => 
    array (
      0 => 'doctor/dashboard.tpl',
      1 => 1775538584,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d4931f746be7_22039485 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\doctor';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Tổng quan",'active_page'=>"dashboard"), (int) 0, $_smarty_current_dir);
?>

<div class="patient-welcome" style="background:linear-gradient(135deg,#0e7490 0%,#0891b2 60%,#06b6d4 100%)">
  <div class="patient-welcome__text">
    <h2>Xin chào, <span style="color:#a5f3fc">BS. <?php echo (($tmp = $_smarty_tpl->getValue('current_user_name') ?? null)===null||$tmp==='' ? "Bác sĩ" ?? null : $tmp);?>
</span> 👨‍⚕️</h2>
    <p>Hôm nay <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),"%d/%m/%Y");?>
 — Bạn có <strong style="color:#fff"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['today_queue'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong> bệnh nhân chờ khám</p>
  </div>
  <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/?role=doctor&page=examination" class="btn-admin-primary" style="background:#fff;color:#0e7490">
    <i class="fa-solid fa-stethoscope"></i> Bắt đầu khám
  </a>
</div>

<div class="patient-stats">
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#0891b2"><i class="fa-solid fa-list-ol"></i></div><div><p>Hàng chờ hôm nay</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['today_queue'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-circle-check"></i></div><div><p>Đã khám hôm nay</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['done_today'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-solid fa-calendar-check"></i></div><div><p>Lịch hẹn hôm nay</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['appointments_today'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-prescription"></i></div><div><p>Đơn thuốc đã kê</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['prescriptions_today'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div></div>
</div>

<div class="dashboard-grid">

  <div class="admin-card admin-card--lg">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-list-ol"></i> Hàng chờ khám hôm nay</h3>
      <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/?role=doctor&page=queue" class="btn-link">Xem đầy đủ</a>
    </div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead><tr><th>STT</th><th>Bệnh nhân</th><th>Triệu chứng</th><th>Ưu tiên</th><th>Giờ hẹn</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
        <tbody>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('queue'), 'q');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('q')->value) {
$foreach0DoElse = false;
?>
          <tr>
            <td><span class="code-tag"><?php echo $_smarty_tpl->getValue('q')['queue_no'];?>
</span></td>
            <td><div class="table-user"><div class="table-avatar"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('q')['patient_name'],1,'');?>
</div><div><strong><?php echo $_smarty_tpl->getValue('q')['patient_name'];?>
</strong><small><?php echo $_smarty_tpl->getValue('q')['patient_code'];?>
</small></div></div></td>
            <td><span style="font-size:13px"><?php echo (($tmp = $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('q')['symptoms'],40,'...') ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</span></td>
            <td>
              <?php if ($_smarty_tpl->getValue('q')['priority'] == 'emergency') {?><span class="badge badge--danger"><i class="fa-solid fa-bolt"></i> Cấp cứu</span>
              <?php } elseif ($_smarty_tpl->getValue('q')['priority'] == 'elderly') {?><span class="badge badge--orange">Người cao tuổi</span>
              <?php } elseif ($_smarty_tpl->getValue('q')['priority'] == 'child') {?><span class="badge badge--blue">Trẻ em</span>
              <?php } else { ?><span class="badge badge--neutral">Thường</span><?php }?>
            </td>
            <td><?php echo (($tmp = $_smarty_tpl->getValue('q')['time'] ?? null)===null||$tmp==='' ? 'Walk-in' ?? null : $tmp);?>
</td>
            <td>
              <?php if ($_smarty_tpl->getValue('q')['status'] == 'waiting') {?><span class="badge badge--warning">Chờ khám</span>
              <?php } elseif ($_smarty_tpl->getValue('q')['status'] == 'in_progress') {?><span class="badge badge--blue">Đang khám</span>
              <?php } elseif ($_smarty_tpl->getValue('q')['status'] == 'done') {?><span class="badge badge--success">Đã khám</span>
              <?php } else { ?><span class="badge badge--neutral"><?php echo $_smarty_tpl->getValue('q')['status'];?>
</span><?php }?>
            </td>
            <td>
              <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/?role=doctor&page=examination&patient_id=<?php echo $_smarty_tpl->getValue('q')['patient_id'];?>
&queue_id=<?php echo $_smarty_tpl->getValue('q')['_id'];?>
" class="btn-admin-primary" style="font-size:12px;padding:.35rem .75rem"><i class="fa-solid fa-stethoscope"></i> Khám</a>
            </td>
          </tr>
          <?php
}
if ($foreach0DoElse) {
?>
          <tr><td colspan="7" class="table-empty">Chưa có bệnh nhân trong hàng chờ</td></tr>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-calendar-check"></i> Lịch hẹn hôm nay</h3></div>
    <div class="admin-card__body p-0">
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('today_appointments'), 'apt');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('apt')->value) {
$foreach1DoElse = false;
?>
      <div class="appt-item">
        <div class="appt-item__date"><strong><?php echo $_smarty_tpl->getValue('apt')['time'];?>
</strong><span><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('apt')['date'],"%d/%m");?>
</span></div>
        <div class="appt-item__info">
          <strong><?php echo $_smarty_tpl->getValue('apt')['patient_name'];?>
</strong>
          <p><?php echo $_smarty_tpl->getValue('apt')['specialty'];?>
 · <?php if ($_smarty_tpl->getValue('apt')['type'] == 'online') {?><i class="fa-solid fa-video"></i> Online<?php } else { ?>Trực tiếp<?php }?></p>
        </div>
        <span class="badge badge--<?php if ($_smarty_tpl->getValue('apt')['status'] == 'confirmed') {?>blue<?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'pending') {?>warning<?php } else { ?>neutral<?php }?>">
          <?php if ($_smarty_tpl->getValue('apt')['status'] == 'confirmed') {?>Xác nhận<?php } elseif ($_smarty_tpl->getValue('apt')['status'] == 'pending') {?>Chờ<?php } else {
echo $_smarty_tpl->getValue('apt')['status'];
}?>
        </span>
      </div>
      <?php
}
if ($foreach1DoElse) {
?>
      <div class="empty-state" style="padding:2rem"><i class="fa-regular fa-calendar"></i><p>Không có lịch hẹn hôm nay</p></div>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>
  </div>

</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

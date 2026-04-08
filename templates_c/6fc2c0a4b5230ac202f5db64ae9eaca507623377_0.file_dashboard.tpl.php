<?php
/* Smarty version 5.8.0, created on 2026-04-08 03:54:49
  from 'file:pharmacist/dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d5d189980809_58500876',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6fc2c0a4b5230ac202f5db64ae9eaca507623377' => 
    array (
      0 => 'pharmacist/dashboard.tpl',
      1 => 1775611356,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d5d189980809_58500876 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\pharmacist';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Tổng quan",'active_page'=>"dashboard"), (int) 0, $_smarty_current_dir);
?>

<div class="patient-welcome" style="background:linear-gradient(135deg,#4c1d95 0%,#8b5cf6 100%)">
  <div class="patient-welcome__text">
    <h2>Xin chào, <span style="color:#ede9fe"><?php echo (($tmp = $_smarty_tpl->getValue('current_user_name') ?? null)===null||$tmp==='' ? "Dược sĩ" ?? null : $tmp);?>
</span> 💊</h2>
    <p>Có <strong style="color:#fff"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['new_rx'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong> đơn thuốc mới cần xử lý hôm nay</p>
  </div>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=prescriptions" class="btn-admin-primary" style="background:#fff;color:#4c1d95">
    <i class="fa-solid fa-prescription"></i> Xử lý đơn thuốc
  </a>
</div>

<div class="patient-stats">
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-prescription"></i></div><div><p>Đơn thuốc mới</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['new_rx'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-capsules"></i></div><div><p>Đã phát hôm nay</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['dispensed_today'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#ef4444"><i class="fa-solid fa-triangle-exclamation"></i></div><div><p>Thuốc sắp hết</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['low_stock'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-regular fa-calendar-xmark"></i></div><div><p>Thuốc sắp hết hạn</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['expiring'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div></div>
</div>

<?php if ($_smarty_tpl->getValue('stats')['low_stock'] > 0) {?>
<div class="alert alert--warning mb-1"><i class="fa-solid fa-triangle-exclamation"></i> Có <strong><?php echo $_smarty_tpl->getValue('stats')['low_stock'];?>
</strong> loại thuốc sắp hết hàng. <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=low-stock">Xem ngay →</a></div>
<?php }?>

<div class="dashboard-grid">
  <div class="admin-card admin-card--lg">
    <div class="admin-card__header"><h3><i class="fa-solid fa-prescription"></i> Đơn thuốc mới nhất</h3><a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=prescriptions" class="btn-link">Xem tất cả</a></div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead><tr><th>Mã đơn</th><th>Bệnh nhân</th><th>Bác sĩ kê</th><th>Thời gian</th><th>Số thuốc</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
        <tbody>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('new_prescriptions'), 'rx');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('rx')->value) {
$foreach0DoElse = false;
?>
          <tr>
            <td><span class="code-tag"><?php echo $_smarty_tpl->getValue('rx')['code'];?>
</span></td>
            <td><div class="table-user"><div class="table-avatar"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('rx')['patient_name'],1,'');?>
</div><strong><?php echo $_smarty_tpl->getValue('rx')['patient_name'];?>
</strong></div></td>
            <td><?php echo $_smarty_tpl->getValue('rx')['doctor_name'];?>
</td>
            <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('rx')['created_at'],"%H:%M %d/%m");?>
</td>
            <td><span class="badge badge--blue"><?php echo $_smarty_tpl->getValue('rx')['drug_count'];?>
 thuốc</span></td>
            <td>
              <?php if ($_smarty_tpl->getValue('rx')['status'] == 'pending') {?><span class="badge badge--warning">Chờ phát</span>
              <?php } elseif ($_smarty_tpl->getValue('rx')['status'] == 'dispensing') {?><span class="badge badge--blue">Đang bốc</span>
              <?php } elseif ($_smarty_tpl->getValue('rx')['status'] == 'done') {?><span class="badge badge--success">Đã phát</span>
              <?php } else { ?><span class="badge badge--neutral"><?php echo $_smarty_tpl->getValue('rx')['status'];?>
</span><?php }?>
            </td>
            <td><a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=dispensing&id=<?php echo $_smarty_tpl->getValue('rx')['_id'];?>
" class="btn-admin-primary" style="font-size:12px;padding:.35rem .75rem"><i class="fa-solid fa-capsules"></i> Phát thuốc</a></td>
          </tr>
          <?php
}
if ($foreach0DoElse) {
?><tr><td colspan="7" class="table-empty">Không có đơn thuốc mới</td></tr>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-boxes-stacking"></i> Tồn kho thấp</h3><a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=low-stock" class="btn-link">Xem tất cả</a></div>
    <div class="admin-card__body p-0">
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('low_stock_drugs'), 'drug');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('drug')->value) {
$foreach1DoElse = false;
?>
      <div class="record-item">
        <div class="record-item__icon" style="background:rgba(239,68,68,.1);color:var(--admin-danger)"><i class="fa-solid fa-pills"></i></div>
        <div class="record-item__info"><strong><?php echo $_smarty_tpl->getValue('drug')['name'];?>
</strong><p><?php echo $_smarty_tpl->getValue('drug')['stock_qty'];?>
 <?php echo $_smarty_tpl->getValue('drug')['unit'];?>
 còn lại · Tối thiểu: <?php echo $_smarty_tpl->getValue('drug')['min_qty'];?>
</p></div>
        <span class="badge badge--danger">Thấp</span>
      </div>
      <?php
}
if ($foreach1DoElse) {
?><div class="empty-state" style="padding:2rem"><i class="fa-solid fa-box-open"></i><p>Tồn kho ổn định</p></div>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>
  </div>
</div>
<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

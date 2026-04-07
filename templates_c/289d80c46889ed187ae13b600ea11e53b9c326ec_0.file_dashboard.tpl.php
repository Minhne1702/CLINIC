<?php
/* Smarty version 5.8.0, created on 2026-04-07 07:16:28
  from 'file:cashier/dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d4932ce7b475_01770774',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '289d80c46889ed187ae13b600ea11e53b9c326ec' => 
    array (
      0 => 'cashier/dashboard.tpl',
      1 => 1775538583,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d4932ce7b475_01770774 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\cashier';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Tổng quan",'active_page'=>"dashboard"), (int) 0, $_smarty_current_dir);
?>

<div class="patient-welcome" style="background:linear-gradient(135deg,#92400e 0%,#f59e0b 100%)">
  <div class="patient-welcome__text">
    <h2>Xin chào, <span style="color:#fef3c7"><?php echo (($tmp = $_smarty_tpl->getValue('current_user_name') ?? null)===null||$tmp==='' ? "Thu ngân" ?? null : $tmp);?>
</span> 💰</h2>
    <p>Hôm nay <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),"%d/%m/%Y");?>
 — Doanh thu: <strong style="color:#fff"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['today_revenue'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></p>
  </div>
  <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/?role=cashier&page=billing" class="btn-admin-primary" style="background:#fff;color:#92400e">
    <i class="fa-solid fa-file-invoice-dollar"></i> Lập hóa đơn
  </a>
</div>

<div class="patient-stats">
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-solid fa-sack-dollar"></i></div><div><p>Doanh thu hôm nay</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['today_revenue'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#ef4444"><i class="fa-solid fa-clock"></i></div><div><p>Chờ thanh toán</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['pending_count'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-circle-check"></i></div><div><p>Đã thanh toán</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['paid_today'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div></div>
  <div class="patient-stat-card"><div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-hand-holding-dollar"></i></div><div><p>Tạm ứng</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['advance_today'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div></div>
</div>

<div class="dashboard-grid">
  <div class="admin-card admin-card--lg">
    <div class="admin-card__header"><h3><i class="fa-solid fa-clock"></i> Chờ thanh toán</h3><a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/?role=cashier&page=pending" class="btn-link">Xem tất cả</a></div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead><tr><th>Bệnh nhân</th><th>Bác sĩ</th><th>Dịch vụ</th><th>Tổng tiền</th><th>Thao tác</th></tr></thead>
        <tbody>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('pending_bills'), 'bill');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('bill')->value) {
$foreach0DoElse = false;
?>
          <tr>
            <td><div class="table-user"><div class="table-avatar"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('bill')['patient_name'],1,'');?>
</div><div><strong><?php echo $_smarty_tpl->getValue('bill')['patient_name'];?>
</strong><small>#<?php echo $_smarty_tpl->getValue('bill')['patient_code'];?>
</small></div></div></td>
            <td><?php echo $_smarty_tpl->getValue('bill')['doctor_name'];?>
</td>
            <td><small><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('bill')['services'],40,'...');?>
</small></td>
            <td><strong style="color:var(--admin-success)"><?php echo $_smarty_tpl->getValue('bill')['total_amount'];?>
</strong></td>
            <td><a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/?role=cashier&page=billing&id=<?php echo $_smarty_tpl->getValue('bill')['_id'];?>
" class="btn-admin-primary" style="font-size:12px;padding:.35rem .8rem"><i class="fa-solid fa-cash-register"></i> Thanh toán</a></td>
          </tr>
          <?php
}
if ($foreach0DoElse) {
?><tr><td colspan="5" class="table-empty">Không có hóa đơn chờ thanh toán</td></tr>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-chart-bar"></i> Thống kê hôm nay</h3></div>
    <div class="admin-card__body">
      <div class="quick-stats">
        <div class="quick-stat"><span>Tiền mặt</span><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['cash_today'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
        <div class="quick-stat"><span>Chuyển khoản</span><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['transfer_today'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
        <div class="quick-stat"><span>QR Code</span><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['qr_today'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
        <div class="quick-stat"><span>BHYT chi trả</span><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['insurance_today'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
        <div class="quick-stat"><span>Tổng doanh thu</span><strong class="text-success"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['today_revenue'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
      </div>
    </div>
  </div>
</div>
<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

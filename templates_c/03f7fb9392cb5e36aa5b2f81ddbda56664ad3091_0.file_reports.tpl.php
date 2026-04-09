<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:13:49
  from 'file:cashier/reports.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d75fbd61ac77_09425243',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '03f7fb9392cb5e36aa5b2f81ddbda56664ad3091' => 
    array (
      0 => 'cashier/reports.tpl',
      1 => 1775696496,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d75fbd61ac77_09425243 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\cashier';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Báo cáo doanh thu",'active_page'=>"reports"), (int) 0, $_smarty_current_dir);
?>
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-chart-line"></i> Báo cáo doanh thu</h2><p class="page-subtitle">Thống kê theo khoảng thời gian</p></div>
  <div class="page-toolbar__right">
    <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=cashier&page=reports&action=export&date_from=<?php echo $_smarty_tpl->getValue('filter')['date_from'];?>
&date_to=<?php echo $_smarty_tpl->getValue('filter')['date_to'];?>
&period=<?php echo $_smarty_tpl->getValue('filter')['period'];?>
" class="btn-admin-secondary"><i class="fa-solid fa-file-excel"></i> Xuất báo cáo</a>
  </div>
</div>

<?php if ((true && ($_smarty_tpl->hasVariable('error_message') && null !== ($_smarty_tpl->getValue('error_message') ?? null)))) {?><div class="alert alert--warning"><i class="fa-solid fa-triangle-exclamation"></i> <?php echo $_smarty_tpl->getValue('error_message');?>
</div><?php }?>

<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" class="filter-bar">
    <input type="hidden" name="role" value="cashier">
    <input type="hidden" name="page" value="reports">
    <div class="filter-bar__group">
      <select name="period" onchange="this.form.submit()">
        <option value="7"  <?php if ($_smarty_tpl->getValue('filter')['period'] == '7') {?>selected<?php }?>>7 ngày qua</option>
        <option value="30" <?php if ($_smarty_tpl->getValue('filter')['period'] == '30') {?>selected<?php }?>>30 ngày qua</option>
        <option value="90" <?php if ($_smarty_tpl->getValue('filter')['period'] == '90') {?>selected<?php }?>>90 ngày qua</option>
        <option value="0"  <?php if ($_smarty_tpl->getValue('filter')['period'] == '0') {?>selected<?php }?>>Tùy chỉnh</option>
      </select>
      <input type="date" name="date_from" value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
      <input type="date" name="date_to"   value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Xem báo cáo</button>
    </div>
  </form>
</div></div>

<div class="patient-stats">
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-solid fa-sack-dollar"></i></div>
    <div><p>Tổng doanh thu</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('report')['total_revenue'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-receipt"></i></div>
    <div><p>Số hóa đơn</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('report')['total_invoices'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#3b82f6"><i class="fa-solid fa-money-bill-wave"></i></div>
    <div><p>Tiền mặt</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('report')['cash_total'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-building-columns"></i></div>
    <div><p>Chuyển khoản</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('report')['transfer_total'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#ec4899"><i class="fa-solid fa-qrcode"></i></div>
    <div><p>QR Code</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('report')['qr_total'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card__header"><h3><i class="fa-solid fa-chart-bar"></i> Phân tích phương thức thanh toán</h3></div>
  <div class="admin-card__body">
    <div class="quick-stats">
      <div class="quick-stat"><span><i class="fa-solid fa-money-bill-wave" style="color:#3b82f6"></i> Tiền mặt</span><strong><?php echo (($tmp = $_smarty_tpl->getValue('report')['cash_total'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
      <div class="quick-stat"><span><i class="fa-solid fa-building-columns" style="color:#8b5cf6"></i> Chuyển khoản</span><strong><?php echo (($tmp = $_smarty_tpl->getValue('report')['transfer_total'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
      <div class="quick-stat"><span><i class="fa-solid fa-qrcode" style="color:#ec4899"></i> QR Code</span><strong><?php echo (($tmp = $_smarty_tpl->getValue('report')['qr_total'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
      <div class="quick-stat"><span><i class="fa-solid fa-calendar-range" style="color:#6b7280"></i> Thời gian</span><strong><?php echo $_smarty_tpl->getValue('filter')['date_from'];?>
 → <?php echo $_smarty_tpl->getValue('filter')['date_to'];?>
</strong></div>
      <div class="quick-stat"><span>Tổng doanh thu</span><strong class="text-success"><?php echo (($tmp = $_smarty_tpl->getValue('report')['total_revenue'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
    </div>
  </div>
</div>
<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

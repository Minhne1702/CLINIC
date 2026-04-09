<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:06:43
  from 'file:cashier/history.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d75e130e5b99_00508160',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df275d7c6a50c29fcd2b58645a24340c08240d17' => 
    array (
      0 => 'cashier/history.tpl',
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
function content_69d75e130e5b99_00508160 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\cashier';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Lịch sử thanh toán",'active_page'=>"history"), (int) 0, $_smarty_current_dir);
?>
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-clock-rotate-left"></i> Lịch sử thanh toán</h2><p class="page-subtitle">Tất cả giao dịch đã hoàn thành</p></div>
  <div class="page-toolbar__right">
    <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=cashier&page=history&action=export" class="btn-admin-secondary"><i class="fa-solid fa-file-excel"></i> Xuất Excel</a>
  </div>
</div>
<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" class="filter-bar"><input type="hidden" name="role" value="cashier"><input type="hidden" name="page" value="history">
    <div class="filter-bar__group">
      <div class="filter-input"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="q" placeholder="Tên BN, mã hóa đơn..." value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"></div>
      <input type="date" name="date_from" value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
      <input type="date" name="date_to"   value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
      <select name="method"><option value="">Tất cả PT TT</option><option value="cash" <?php if ($_smarty_tpl->getValue('filter')['method'] == 'cash') {?>selected<?php }?>>Tiền mặt</option><option value="transfer" <?php if ($_smarty_tpl->getValue('filter')['method'] == 'transfer') {?>selected<?php }?>>Chuyển khoản</option><option value="qr" <?php if ($_smarty_tpl->getValue('filter')['method'] == 'qr') {?>selected<?php }?>>QR Code</option></select>
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
    </div>
  </form>
</div></div>
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table"><thead><tr><th>Mã HĐ</th><th>Bệnh nhân</th><th>Bác sĩ</th><th>Ngày TT</th><th>PT thanh toán</th><th>Tổng tiền</th><th>Thu ngân</th><th>Thao tác</th></tr></thead>
  <tbody>
    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('history'), 'bill');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('bill')->value) {
$foreach0DoElse = false;
?>
    <tr>
      <td><span class="code-tag"><?php echo $_smarty_tpl->getValue('bill')['invoice_code'];?>
</span></td>
      <td><strong><?php echo $_smarty_tpl->getValue('bill')['patient_name'];?>
</strong><br><small><?php echo $_smarty_tpl->getValue('bill')['patient_code'];?>
</small></td>
      <td><?php echo $_smarty_tpl->getValue('bill')['doctor_name'];?>
</td>
      <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('bill')['paid_at'],"%d/%m/%Y %H:%M");?>
</td>
      <td>
        <?php if ($_smarty_tpl->getValue('bill')['payment_method'] == 'cash') {?><span class="badge badge--green">Tiền mặt</span>
        <?php } elseif ($_smarty_tpl->getValue('bill')['payment_method'] == 'transfer') {?><span class="badge badge--blue">Chuyển khoản</span>
        <?php } elseif ($_smarty_tpl->getValue('bill')['payment_method'] == 'qr') {?><span class="badge badge--purple">QR Code</span>
        <?php } else { ?><span class="badge badge--neutral"><?php echo $_smarty_tpl->getValue('bill')['payment_method'];?>
</span><?php }?>
      </td>
      <td><strong style="color:var(--admin-success)"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('bill')['total_amount'],0,',','.');?>
đ</strong></td>
      <td><?php echo $_smarty_tpl->getValue('bill')['cashier_name'];?>
</td>
      <td><a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=cashier&page=history&id=<?php echo $_smarty_tpl->getValue('bill')['_id'];?>
" class="action-btn" title="Xem & In"><i class="fa-solid fa-print"></i></a></td>
    </tr>
    <?php
}
if ($foreach0DoElse) {
?><tr><td colspan="8" class="table-empty">Chưa có giao dịch nào</td></tr>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  </tbody></table>
</div></div>
<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

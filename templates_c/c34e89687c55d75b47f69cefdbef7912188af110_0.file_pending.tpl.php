<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:03:54
  from 'file:cashier/pending.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d75d6a11ef50_01364701',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c34e89687c55d75b47f69cefdbef7912188af110' => 
    array (
      0 => 'cashier/pending.tpl',
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
function content_69d75d6a11ef50_01364701 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\cashier';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Chờ thanh toán",'active_page'=>"pending"), (int) 0, $_smarty_current_dir);
?>
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-clock"></i> Chờ thanh toán</h2><p class="page-subtitle">Danh sách bệnh nhân đã khám xong, chờ thanh toán</p></div>
</div>
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table"><thead><tr><th>Bệnh nhân</th><th>Bác sĩ</th><th>Chẩn đoán</th><th>Phí KCB</th><th>Phí thuốc</th><th>Tổng tiền</th><th>Thời gian chờ</th><th>Thao tác</th></tr></thead>
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
</strong><small><?php echo $_smarty_tpl->getValue('bill')['patient_code'];?>
</small></div></div></td>
      <td><?php echo $_smarty_tpl->getValue('bill')['doctor_name'];?>
</td>
      <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')((($tmp = $_smarty_tpl->getValue('bill')['diagnosis'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp),35,'...');?>
</td>
      <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('bill')['service_fee'],0,',','.');?>
đ</td>
      <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('bill')['drug_fee'],0,',','.');?>
đ</td>
      <td><strong style="color:var(--admin-success)"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('bill')['total_amount'],0,',','.');?>
đ</strong></td>
      <td><span class="text-muted" style="font-size:13px"><?php echo (($tmp = $_smarty_tpl->getValue('bill')['wait_time'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</span></td>
      <td><a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=cashier&page=billing&id=<?php echo $_smarty_tpl->getValue('bill')['_id'];?>
" class="btn-admin-primary" style="font-size:12px;padding:.35rem .8rem"><i class="fa-solid fa-cash-register"></i> Thanh toán</a></td>
    </tr>
    <?php
}
if ($foreach0DoElse) {
?><tr><td colspan="8" class="table-empty">Không có hóa đơn nào chờ thanh toán</td></tr>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
  </tbody></table>
</div></div>
<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

<?php
/* Smarty version 5.8.0, created on 2026-04-10 13:54:22
  from 'file:cashier/insurance.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d9010eee2853_52910589',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c08f371a766b3c044ac1b2e2e45c3e4fe47b44e0' => 
    array (
      0 => 'cashier/insurance.tpl',
      1 => 1775696150,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d9010eee2853_52910589 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\cashier';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"BHYT",'active_page'=>"insurance"), (int) 0, $_smarty_current_dir);
?>
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-shield-heart"></i> Thanh toán BHYT</h2><p class="page-subtitle">Danh sách bệnh nhân có bảo hiểm y tế</p></div>
</div>

<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" class="filter-bar">
    <input type="hidden" name="role" value="cashier">
    <input type="hidden" name="page" value="insurance">
    <div class="filter-bar__group">
      <div class="filter-input"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="q" placeholder="Tên BN, mã BHYT..." value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"></div>
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
    </div>
  </form>
</div></div>

<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table">
    <thead>
      <tr>
        <th>Bệnh nhân</th>
        <th>Mã BHYT</th>
        <th>Bác sĩ</th>
        <th>Chẩn đoán</th>
        <th>Tổng tiền</th>
        <th>BHYT chi trả</th>
        <th>BN đồng chi trả</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('insurance_bills'), 'bill');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('bill')->value) {
$foreach0DoElse = false;
?>
      <tr>
        <td>
          <div class="table-user">
            <div class="table-avatar"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('bill')['patient_name'],1,'');?>
</div>
            <div><strong><?php echo $_smarty_tpl->getValue('bill')['patient_name'];?>
</strong><small><?php echo $_smarty_tpl->getValue('bill')['patient_code'];?>
</small></div>
          </div>
        </td>
        <td><span class="badge badge--success"><?php echo $_smarty_tpl->getValue('bill')['bhyt_code'];?>
</span></td>
        <td><?php echo $_smarty_tpl->getValue('bill')['doctor_name'];?>
</td>
        <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')((($tmp = $_smarty_tpl->getValue('bill')['diagnosis'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp),30,'...');?>
</td>
        <td><strong><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')((($tmp = $_smarty_tpl->getValue('bill')['subtotal'] ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('bill')['total_amount'] ?? null : $tmp),0,',','.');?>
đ</strong></td>
        <td style="color:var(--admin-success)">-<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')((($tmp = $_smarty_tpl->getValue('bill')['bhyt_amount'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp),0,',','.');?>
đ</td>
        <td><strong style="color:var(--admin-danger)"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('bill')['total_amount'],0,',','.');?>
đ</strong></td>
        <td>
          <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=cashier&page=billing&id=<?php echo $_smarty_tpl->getValue('bill')['_id'];?>
" class="btn-admin-primary" style="font-size:12px;padding:.35rem .8rem">
            <i class="fa-solid fa-cash-register"></i> Thanh toán
          </a>
        </td>
      </tr>
      <?php
}
if ($foreach0DoElse) {
?>
      <tr><td colspan="8" class="table-empty">Không có bệnh nhân BHYT nào chờ thanh toán</td></tr>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </tbody>
  </table>
</div></div>
<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

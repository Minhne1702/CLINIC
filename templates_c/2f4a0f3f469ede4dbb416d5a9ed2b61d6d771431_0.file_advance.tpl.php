<?php
/* Smarty version 5.8.0, created on 2026-04-10 13:54:21
  from 'file:cashier/advance.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d9010de40589_53835226',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2f4a0f3f469ede4dbb416d5a9ed2b61d6d771431' => 
    array (
      0 => 'cashier/advance.tpl',
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
function content_69d9010de40589_53835226 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\cashier';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Tạm ứng",'active_page'=>"advance"), (int) 0, $_smarty_current_dir);
?>
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-hand-holding-dollar"></i> Tạm ứng</h2><p class="page-subtitle">Ghi nhận tạm ứng từ bệnh nhân</p></div>
</div>

<?php if ((true && ($_smarty_tpl->hasVariable('success_message') && null !== ($_smarty_tpl->getValue('success_message') ?? null)))) {?><div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div><?php }
if ((true && ($_smarty_tpl->hasVariable('error_message') && null !== ($_smarty_tpl->getValue('error_message') ?? null)))) {?><div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $_smarty_tpl->getValue('error_message');?>
</div><?php }?>

<div class="dashboard-grid">
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-plus"></i> Ghi nhận tạm ứng mới</h3></div>
    <div class="admin-card__body">
      <form method="POST" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=cashier&page=advance" class="appt-form">
        <div class="form-group">
          <label>Tên bệnh nhân <span class="required">*</span></label>
          <input type="text" name="patient_name" placeholder="Nhập tên bệnh nhân..." required>
        </div>
        <div class="form-group">
          <label>Mã bệnh nhân</label>
          <input type="text" name="patient_code" placeholder="BN-XXXXXX">
        </div>
        <div class="form-row-2">
          <div class="form-group">
            <label>Số tiền tạm ứng <span class="required">*</span></label>
            <input type="number" name="amount" placeholder="0" step="1000" min="0" required>
          </div>
          <div class="form-group">
            <label>Phương thức</label>
            <select name="payment_method">
              <option value="cash">Tiền mặt</option>
              <option value="transfer">Chuyển khoản</option>
              <option value="qr">QR Code</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Ghi chú</label>
          <textarea name="note" rows="2" placeholder="Lý do tạm ứng..."></textarea>
        </div>
        <button type="submit" class="btn-admin-primary"><i class="fa-solid fa-floppy-disk"></i> Ghi nhận tạm ứng</button>
      </form>
    </div>
  </div>

  <div class="admin-card admin-card--lg">
    <div class="admin-card__header"><h3><i class="fa-solid fa-list"></i> Danh sách tạm ứng</h3></div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead><tr><th>Bệnh nhân</th><th>Mã BN</th><th>Số tiền</th><th>PT TT</th><th>Ghi chú</th><th>Ngày</th></tr></thead>
        <tbody>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('advances'), 'adv');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('adv')->value) {
$foreach0DoElse = false;
?>
          <tr>
            <td><strong><?php echo $_smarty_tpl->getValue('adv')['patient_name'];?>
</strong></td>
            <td><?php echo $_smarty_tpl->getValue('adv')['patient_code'];?>
</td>
            <td><strong style="color:var(--admin-success)"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('adv')['amount'],0,',','.');?>
đ</strong></td>
            <td>
              <?php if ($_smarty_tpl->getValue('adv')['payment_method'] == 'cash') {?><span class="badge badge--green">Tiền mặt</span>
              <?php } elseif ($_smarty_tpl->getValue('adv')['payment_method'] == 'transfer') {?><span class="badge badge--blue">Chuyển khoản</span>
              <?php } else { ?><span class="badge badge--purple">QR Code</span><?php }?>
            </td>
            <td><?php echo (($tmp = $_smarty_tpl->getValue('adv')['note'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
            <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('adv')['created_at'],"%d/%m/%Y");?>
</td>
          </tr>
          <?php
}
if ($foreach0DoElse) {
?>
          <tr><td colspan="6" class="table-empty">Chưa có giao dịch tạm ứng nào</td></tr>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

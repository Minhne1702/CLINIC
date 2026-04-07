<?php
/* Smarty version 5.8.0, created on 2026-04-07 07:16:31
  from 'file:cashier/billing.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d4932fe34036_43300460',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'acb2f5a56f8f9eba147b8874c26bf270d382eac4' => 
    array (
      0 => 'cashier/billing.tpl',
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
function content_69d4932fe34036_43300460 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\cashier';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Lập hóa đơn",'active_page'=>"billing"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-file-invoice-dollar"></i> Lập hóa đơn</h2><p class="page-subtitle">Xử lý thanh toán cho bệnh nhân</p></div>
  <div class="page-toolbar__right">
    <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/?role=cashier&page=pending" class="btn-admin-secondary"><i class="fa-solid fa-clock"></i> Chờ TT (<?php echo (($tmp = $_smarty_tpl->getValue('pending_count') ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
)</a>
  </div>
</div>

<?php if ($_smarty_tpl->getValue('success_message')) {?><div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div><?php }
if ($_smarty_tpl->getValue('error_message')) {?><div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $_smarty_tpl->getValue('error_message');?>
</div><?php }?>

<?php if ($_smarty_tpl->getValue('bill')) {?>
<!-- Chi tiết hóa đơn để thanh toán -->
<div class="billing-layout">
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-hospital-user"></i> Thông tin bệnh nhân</h3></div>
    <div class="admin-card__body">
      <div class="emr-section"><label>Họ và tên</label><p><strong><?php echo $_smarty_tpl->getValue('bill')['patient_name'];?>
</strong></p></div>
      <div class="emr-section"><label>Mã BN</label><p><?php echo $_smarty_tpl->getValue('bill')['patient_code'];?>
</p></div>
      <div class="emr-section"><label>Bác sĩ</label><p><?php echo $_smarty_tpl->getValue('bill')['doctor_name'];?>
</p></div>
      <div class="emr-section"><label>Chẩn đoán</label><p><?php echo (($tmp = $_smarty_tpl->getValue('bill')['diagnosis'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</p></div>
      <?php if ($_smarty_tpl->getValue('bill')['bhyt_code']) {?><div class="emr-section"><label>BHYT</label><p><span class="badge badge--success"><?php echo $_smarty_tpl->getValue('bill')['bhyt_code'];?>
</span></p></div><?php }?>
    </div>
  </div>

  <div class="admin-card admin-card--lg">
    <div class="admin-card__header"><h3><i class="fa-solid fa-list"></i> Chi tiết dịch vụ & thuốc</h3></div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead><tr><th>Mô tả</th><th>Loại</th><th>Số lượng</th><th>Đơn giá</th><th>Thành tiền</th></tr></thead>
        <tbody>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('bill')['items'], 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
          <tr>
            <td><?php echo $_smarty_tpl->getValue('item')['description'];?>
</td>
            <td><span class="badge badge--<?php if ($_smarty_tpl->getValue('item')['type'] == 'service') {?>blue<?php } elseif ($_smarty_tpl->getValue('item')['type'] == 'drug') {?>orange<?php } else { ?>neutral<?php }?>"><?php if ($_smarty_tpl->getValue('item')['type'] == 'service') {?>Dịch vụ<?php } elseif ($_smarty_tpl->getValue('item')['type'] == 'drug') {?>Thuốc<?php } else { ?>Khác<?php }?></span></td>
            <td><?php echo $_smarty_tpl->getValue('item')['qty'];?>
</td>
            <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('item')['unit_price'],0,',','.');?>
đ</td>
            <td><strong><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('item')['total'],0,',','.');?>
đ</strong></td>
          </tr>
          <?php
}
if ($foreach0DoElse) {
?><tr><td colspan="5" class="table-empty">Không có dịch vụ</td></tr>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </tbody>
        <tfoot>
          <tr style="border-top:2px solid var(--admin-border)">
            <td colspan="4" style="text-align:right;padding:.75rem 1rem;font-weight:600">Tổng cộng:</td>
            <td style="padding:.75rem 1rem"><strong style="font-size:1.1rem;color:var(--admin-success)"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('bill')['subtotal'],0,',','.');?>
đ</strong></td>
          </tr>
          <?php if ($_smarty_tpl->getValue('bill')['bhyt_amount'] > 0) {?>
          <tr>
            <td colspan="4" style="text-align:right;padding:.4rem 1rem;color:var(--admin-text-secondary)">BHYT chi trả:</td>
            <td style="padding:.4rem 1rem;color:var(--admin-success)">-<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('bill')['bhyt_amount'],0,',','.');?>
đ</td>
          </tr>
          <?php }?>
          <?php if ($_smarty_tpl->getValue('bill')['discount'] > 0) {?>
          <tr>
            <td colspan="4" style="text-align:right;padding:.4rem 1rem;color:var(--admin-text-secondary)">Giảm giá:</td>
            <td style="padding:.4rem 1rem;color:var(--admin-success)">-<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('bill')['discount'],0,',','.');?>
đ</td>
          </tr>
          <?php }?>
          <tr style="background:#f0fdf4">
            <td colspan="4" style="text-align:right;padding:.75rem 1rem;font-weight:700;font-size:15px">Số tiền cần thanh toán:</td>
            <td style="padding:.75rem 1rem"><strong style="font-size:1.3rem;color:var(--admin-success)"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('bill')['total_amount'],0,',','.');?>
đ</strong></td>
          </tr>
        </tfoot>
      </table>
    </div>

    <div class="admin-card__footer">
      <form action="<?php echo $_smarty_tpl->getValue('base_url');?>
/" method="POST" class="appt-form">
        <input type="hidden" name="role" value="cashier">
        <input type="hidden" name="page" value="billing">
        <input type="hidden" name="action" value="pay">
        <input type="hidden" name="bill_id" value="<?php echo $_smarty_tpl->getValue('bill')['_id'];?>
">
        <div class="form-row-2" style="margin-bottom:1rem">
          <div class="form-group">
            <label>Phương thức thanh toán <span class="required">*</span></label>
            <select name="payment_method" required>
              <option value="cash">Tiền mặt</option>
              <option value="transfer">Chuyển khoản</option>
              <option value="qr">QR Code (VietQR)</option>
            </select>
          </div>
          <div class="form-group">
            <label>Số tiền khách đưa</label>
            <input type="number" name="amount_received" placeholder="<?php echo $_smarty_tpl->getValue('bill')['total_amount'];?>
" step="1000">
          </div>
        </div>
        <div style="display:flex;gap:.75rem;flex-wrap:wrap">
          <button type="submit" class="btn-admin-primary"><i class="fa-solid fa-cash-register"></i> Xác nhận thanh toán & In hóa đơn</button>
          <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/?role=cashier&page=pending" class="btn-admin-ghost">Hủy</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php } else { ?>
<!-- Tìm kiếm hóa đơn -->
<div class="admin-card">
  <div class="admin-card__body">
    <form method="GET" action="<?php echo $_smarty_tpl->getValue('base_url');?>
/" class="appt-form">
      <input type="hidden" name="role" value="cashier"><input type="hidden" name="page" value="billing">
      <div class="form-group"><label>Tìm bệnh nhân / mã lịch hẹn</label>
        <div class="input-icon-wrap"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="q" value="<?php echo (($tmp = $_smarty_tpl->getValue('search_q') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" placeholder="Tên bệnh nhân, mã lịch, CCCD..."></div>
      </div>
      <button type="submit" class="btn-admin-primary"><i class="fa-solid fa-search"></i> Tìm kiếm</button>
    </form>
    <?php if ($_smarty_tpl->getValue('search_results')) {?>
    <div style="margin-top:1.5rem">
      <table class="admin-table">
        <thead><tr><th>Bệnh nhân</th><th>Bác sĩ</th><th>Tổng tiền</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
        <tbody>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('search_results'), 'r');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('r')->value) {
$foreach1DoElse = false;
?>
          <tr>
            <td><strong><?php echo $_smarty_tpl->getValue('r')['patient_name'];?>
</strong><br><small><?php echo $_smarty_tpl->getValue('r')['patient_code'];?>
</small></td>
            <td><?php echo $_smarty_tpl->getValue('r')['doctor_name'];?>
</td>
            <td><strong><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('r')['total_amount'],0,',','.');?>
đ</strong></td>
            <td><span class="badge badge--warning">Chờ TT</span></td>
            <td><a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/?role=cashier&page=billing&id=<?php echo $_smarty_tpl->getValue('r')['_id'];?>
" class="btn-admin-primary" style="font-size:12px;padding:.35rem .8rem"><i class="fa-solid fa-cash-register"></i> Thanh toán</a></td>
          </tr>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </tbody>
      </table>
    </div>
    <?php }?>
  </div>
</div>
<?php }?>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:20:06
  from 'file:cashier/billing.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d761360813c5_10740500',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '67680aea8aea12f38c7f0474baa6fc436acb2b42' => 
    array (
      0 => 'cashier/billing.tpl',
      1 => 1775722804,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d761360813c5_10740500 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\cashier';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Lập hóa đơn",'active_page'=>"billing"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-file-invoice-dollar"></i> Lập hóa đơn</h2>
    <p class="page-subtitle">Xử lý thanh toán và in biên lai cho bệnh nhân</p>
  </div>
  <div class="page-toolbar__right">
    <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=cashier&page=pending" class="btn-admin-secondary">
      <i class="fa-solid fa-clock"></i> Chờ thanh toán (<?php echo (($tmp = $_smarty_tpl->getValue('pending_count') ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
)
    </a>
  </div>
</div>

<?php if ($_smarty_tpl->getValue('success_message')) {?><div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div><?php }
if ($_smarty_tpl->getValue('error_message')) {?><div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $_smarty_tpl->getValue('error_message');?>
</div><?php }?>

<?php if ($_smarty_tpl->getValue('bill')) {?>
<div style="display: grid; grid-template-columns: 320px 1fr; gap: 24px; align-items: stretch;">
  
  <div class="admin-card" style="margin-bottom: 0; display: flex; flex-direction: column;">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-hospital-user"></i> Thông tin bệnh nhân</h3>
    </div>
    <div class="admin-card__body" style="flex-grow: 1;">
      <div class="emr-section">
        <label style="text-transform: uppercase; font-size: 11px; color: #94a3b8; font-weight: 600;">Họ và tên</label>
        <p style="font-weight: 700; color: #1e293b; margin-top: 4px; font-size: 1.1rem;"><?php echo $_smarty_tpl->getValue('bill')['patient_name'];?>
</p>
      </div>
      <div class="emr-section" style="margin-top: 15px;">
        <label style="text-transform: uppercase; font-size: 11px; color: #94a3b8; font-weight: 600;">Mã BN</label>
        <p style="color: #475569; margin-top: 4px;"><?php echo $_smarty_tpl->getValue('bill')['patient_code'];?>
</p>
      </div>
      <div class="emr-section" style="margin-top: 15px;">
        <label style="text-transform: uppercase; font-size: 11px; color: #94a3b8; font-weight: 600;">Bác sĩ chỉ định</label>
        <p style="color: #475569; margin-top: 4px;"><?php echo $_smarty_tpl->getValue('bill')['doctor_name'];?>
</p>
      </div>
      <div class="emr-section" style="margin-top: 15px;">
        <label style="text-transform: uppercase; font-size: 11px; color: #94a3b8; font-weight: 600;">Chẩn đoán</label>
        <p style="color: #475569; margin-top: 4px;"><?php echo (($tmp = $_smarty_tpl->getValue('bill')['diagnosis'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</p>
      </div>
      
      <?php if ($_smarty_tpl->getValue('bill')['bhyt_code']) {?>
      <div style="background: #f0fdf4; border-left: 4px solid #10b981; padding: 12px; border-radius: 8px; margin-top: 20px;">
        <strong style="font-size: 11px; color: #059669; display: block; margin-bottom: 4px;">
          <i class="fa-solid fa-shield-halved"></i> ĐỐI TƯỢNG BHYT
        </strong>
        <p style="font-size: 14px; color: #064e3b; font-weight: 700; margin: 0;"><?php echo $_smarty_tpl->getValue('bill')['bhyt_code'];?>
</p>
      </div>
      <?php }?>
    </div>
  </div>

  <div class="admin-card" style="margin-bottom: 0; display: flex; flex-direction: column;">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-list-check"></i> Chi tiết dịch vụ & thuốc</h3>
    </div>
    <div class="admin-card__body p-0" style="flex-grow: 1;">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Mô tả hạng mục</th>
            <th>Loại</th>
            <th class="text-center">SL</th>
            <th class="text-right">Đơn giá</th>
            <th class="text-right">Thành tiền</th>
          </tr>
        </thead>
        <tbody>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('bill')['items'], 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
          <tr>
            <td><strong style="color:#334155"><?php echo $_smarty_tpl->getValue('item')['description'];?>
</strong></td>
            <td>
              <span class="badge" style="background: <?php if ($_smarty_tpl->getValue('item')['type'] == 'service') {?>#dcfce7; color: #166534<?php } elseif ($_smarty_tpl->getValue('item')['type'] == 'drug') {?>#fff7ed; color: #9a3412<?php } else { ?>#f1f5f9; color: #475569<?php }?>; font-size: 11px;">
                <?php if ($_smarty_tpl->getValue('item')['type'] == 'service') {?>Dịch vụ<?php } elseif ($_smarty_tpl->getValue('item')['type'] == 'drug') {?>Thuốc<?php } else { ?>Khác<?php }?>
              </span>
            </td>
            <td class="text-center"><?php echo $_smarty_tpl->getValue('item')['qty'];?>
</td>
            <td class="text-right"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('item')['unit_price'],0,',','.');?>
đ</td>
            <td class="text-right"><strong><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('item')['total'],0,',','.');?>
đ</strong></td>
          </tr>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </tbody>
        <tfoot>
          <tr style="border-top: 2px solid #e2e8f0; background: #f8fafc;">
            <td colspan="4" class="text-right" style="padding: 12px 20px; font-weight: 600; color: #64748b;">Tổng cộng:</td>
            <td class="text-right" style="padding: 12px 20px;"><strong style="color: #1e293b;"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('bill')['subtotal'],0,',','.');?>
đ</strong></td>
          </tr>
          <?php if ($_smarty_tpl->getValue('bill')['bhyt_amount'] > 0) {?>
          <tr>
            <td colspan="4" class="text-right" style="padding: 8px 20px; color: #059669;">BHYT chi trả (-):</td>
            <td class="text-right" style="padding: 8px 20px; color: #059669;">-<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('bill')['bhyt_amount'],0,',','.');?>
đ</td>
          </tr>
          <?php }?>
          <tr style="background: #f0fdf4;">
            <td colspan="4" class="text-right" style="padding: 16px 20px; font-weight: 700; font-size: 16px; color: #1e293b;">THỰC THU:</td>
            <td class="text-right" style="padding: 16px 20px;">
              <strong style="font-size: 1.5rem; color: #10b981;"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('bill')['total_amount'],0,',','.');?>
đ</strong>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>

    <div class="admin-card__footer" style="padding: 24px; background: #fff; border-top: 1px solid #e2e8f0; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
      <form action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" method="POST" id="paymentForm">
        <input type="hidden" name="role" value="cashier">
        <input type="hidden" name="page" value="billing">
        <input type="hidden" name="action" value="pay">
        <input type="hidden" name="bill_id" value="<?php echo $_smarty_tpl->getValue('bill')['_id'];?>
">
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
          <div class="form-group">
            <label style="font-weight: 600; color: #475569; margin-bottom: 8px; display: block;">Phương thức thanh toán <span class="required">*</span></label>
            <select name="payment_method" class="form-control" style="height: 48px; border-radius: 8px; border: 1px solid #cbd5e1;">
              <option value="cash">💵 Tiền mặt</option>
              <option value="transfer">🏦 Chuyển khoản</option>
              <option value="qr">📱 QR Code (VietQR)</option>
            </select>
          </div>
          <div class="form-group">
            <label style="font-weight: 600; color: #475569; margin-bottom: 8px; display: block;">Số tiền khách đưa</label>
            <input type="number" name="amount_received" id="amount_received" 
                   class="form-control" style="height: 48px; border-radius: 8px; font-weight: 700; font-size: 18px; border: 1px solid #f59e0b;" 
                   value="<?php echo $_smarty_tpl->getValue('bill')['total_amount'];?>
" step="1000">
          </div>
        </div>

        <div id="change_display" style="margin-bottom: 20px; padding: 12px 16px; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
          <span style="color: #64748b; font-size: 14px;">Tiền thừa trả khách:</span>
          <strong id="change_amount" style="color: #64748b; font-size: 18px;">0đ</strong>
        </div>
        
        <div style="display: flex; gap: 12px;">
          <button type="submit" class="btn-admin-primary" style="padding: 14px 28px; font-weight: 700; font-size: 15px; flex: 1;">
            <i class="fa-solid fa-cash-register"></i> XÁC NHẬN THANH TOÁN & IN BIÊN LAI
          </button>
          <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=cashier&page=pending" class="btn-admin-ghost" style="padding: 14px 28px;">Hủy bỏ</a>
        </div>
      </form>
    </div>
  </div>
</div>

<?php echo '<script'; ?>
>

// Script tính tiền thừa thời gian thực
document.getElementById('amount_received').addEventListener('input', function() {
    const total = <?php echo $_smarty_tpl->getValue('bill')['total_amount'];?>
;
    const received = parseInt(this.value) || 0;
    const change = received - total;
    
    const display = document.getElementById('change_amount');
    if (change > 0) {
        display.innerText = new Intl.NumberFormat('vi-VN').format(change) + 'đ';
        display.style.color = '#10b981'; // Xanh lá nếu có tiền thừa
    } else if (change < 0) {
        display.innerText = 'Chưa đủ tiền';
        display.style.color = '#ef4444'; // Đỏ nếu thiếu tiền
    } else {
        display.innerText = '0đ';
        display.style.color = '#64748b';
    }
});

<?php echo '</script'; ?>
>

<?php } else { ?>
<div class="admin-card" style="max-width: 900px; margin: 0 auto;">
  <div class="admin-card__body" style="padding: 3rem 2rem; text-align: center;">
    <div style="font-size: 4rem; color: #fef3c7; margin-bottom: 1.5rem;"><i class="fa-solid fa-magnifying-glass-dollar"></i></div>
    <h3 style="color: #1e293b; font-size: 1.5rem;">Tìm kiếm hóa đơn</h3>
    <p class="text-muted" style="margin-bottom: 2rem;">Vui lòng nhập tên bệnh nhân hoặc mã số để thanh toán</p>
    
    <form method="GET" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" style="display: flex; gap: 12px; max-width: 600px; margin: 0 auto;">
      <input type="hidden" name="role" value="cashier">
      <input type="hidden" name="page" value="billing">
      <div style="flex: 1; position: relative;">
        <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
        <input type="text" name="q" value="<?php echo (($tmp = $_smarty_tpl->getValue('search_q') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" placeholder="Tên bệnh nhân, mã số, CCCD..." 
               style="width: 100%; padding: 14px 14px 14px 45px; border: 2px solid #e2e8f0; border-radius: 12px; font-size: 16px; outline: none;">
      </div>
      <button type="submit" class="btn-admin-primary" style="padding: 0 30px; border-radius: 12px;">Tìm kiếm</button>
    </form>
    
    <?php if ($_smarty_tpl->getValue('search_results')) {?>
    <div style="margin-top: 3rem; text-align: left;">
      <table class="admin-table">
        <thead>
          <tr><th>Bệnh nhân</th><th>Bác sĩ</th><th class="text-right">Tổng tiền</th><th class="text-center">Thao tác</th></tr>
        </thead>
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
            <td class="text-right"><strong style="color: #10b981;"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('number_format')($_smarty_tpl->getValue('r')['total_amount'],0,',','.');?>
đ</strong></td>
            <td class="text-center">
              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=cashier&page=billing&id=<?php echo $_smarty_tpl->getValue('r')['_id'];?>
" class="btn-admin-primary" style="font-size:12px; padding: 6px 16px;">
                <i class="fa-solid fa-cash-register"></i> Thanh toán
              </a>
            </td>
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

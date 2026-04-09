<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:03:55
  from 'file:cashier/dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d75d6b386f30_07853152',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '19994c0d4ecdcab23b18035ea085aefc0529e319' => 
    array (
      0 => 'cashier/dashboard.tpl',
      1 => 1775721414,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d75d6b386f30_07853152 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\cashier';
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
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=cashier&page=billing" class="btn-admin-primary" style="background:#fff;color:#92400e; font-weight: 700;">
    <i class="fa-solid fa-file-invoice-dollar"></i> Lập hóa đơn
  </a>
</div>

<div class="patient-stats">
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-solid fa-sack-dollar"></i></div>
    <div><p>Doanh thu hôm nay</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['today_revenue'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#ef4444"><i class="fa-solid fa-clock"></i></div>
    <div><p>Chờ thanh toán</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['pending_count'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-circle-check"></i></div>
    <div><p>Đã thanh toán</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['paid_today'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong></div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-hand-holding-dollar"></i></div>
    <div><p>Tạm ứng</p><strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['advance_today'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong></div>
  </div>
</div>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: stretch; margin-top: 20px;">
  
  <div class="admin-card" style="margin-bottom: 0; display: flex; flex-direction: column;">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-clock"></i> Chờ thanh toán</h3>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=cashier&page=pending" class="btn-link">Xem tất cả</a>
    </div>
    <div class="admin-card__body p-0" style="flex-grow: 1;">
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Bệnh nhân</th>
              <th>Bác sĩ</th>
              <th>Dịch vụ</th>
              <th>Tổng tiền</th>
              <th>Thao tác</th>
            </tr>
          </thead>
          <tbody>
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('pending_bills'), 'bill');
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
</strong><small>#<?php echo $_smarty_tpl->getValue('bill')['patient_code'];?>
</small></div>
                </div>
              </td>
              <td><?php echo $_smarty_tpl->getValue('bill')['doctor_name'];?>
</td>
              <td><small title="<?php echo $_smarty_tpl->getValue('bill')['services'];?>
"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('bill')['services'],40,'...');?>
</small></td>
              <td><strong style="color:var(--admin-success)"><?php echo $_smarty_tpl->getValue('bill')['total_amount'];?>
</strong></td>
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
            <tr>
              <td colspan="5" class="table-empty" style="padding: 4rem 0; text-align: center;">Không có hóa đơn chờ thanh toán</td>
            </tr>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="admin-card" style="margin-bottom: 0; display: flex; flex-direction: column;">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-chart-bar" style="color: #f59e0b;"></i> Thống kê hôm nay</h3>
    </div>
    <div class="admin-card__body" style="flex-grow: 1; background: #fff; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
      <div class="quick-stats" style="display: flex; flex-direction: column; gap: 4px;">
        
        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
          <span style="color: #64748b; font-size: 14px;"><i class="fa-solid fa-money-bill-1-wave" style="width: 20px;"></i> Tiền mặt</span>
          <strong style="color: #1e293b;"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['cash_today'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong>
        </div>
        
        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
          <span style="color: #64748b; font-size: 14px;"><i class="fa-solid fa-building-columns" style="width: 20px;"></i> Chuyển khoản</span>
          <strong style="color: #1e293b;"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['transfer_today'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong>
        </div>
        
        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
          <span style="color: #64748b; font-size: 14px;"><i class="fa-solid fa-qrcode" style="width: 20px;"></i> QR Code</span>
          <strong style="color: #1e293b;"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['qr_today'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong>
        </div>
        
        <div style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #f1f5f9;">
          <span style="color: #64748b; font-size: 14px;"><i class="fa-solid fa-shield-heart" style="width: 20px;"></i> BHYT chi trả</span>
          <strong style="color: #1e293b;"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['insurance_today'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong>
        </div>
        
        <div style="display: flex; justify-content: space-between; padding: 16px 0; margin-top: 8px;">
          <span style="color: #1e293b; font-weight: 700; font-size: 15px;">Tổng doanh thu</span>
          <strong style="color: #10b981; font-size: 18px;"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['today_revenue'] ?? null)===null||$tmp==='' ? "0đ" ?? null : $tmp);?>
</strong>
        </div>

      </div>
    </div>
  </div>

</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

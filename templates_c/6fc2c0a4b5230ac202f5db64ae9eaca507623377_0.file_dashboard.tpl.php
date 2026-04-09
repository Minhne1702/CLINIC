<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:29:25
  from 'file:pharmacist/dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d763654a6342_28459821',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6fc2c0a4b5230ac202f5db64ae9eaca507623377' => 
    array (
      0 => 'pharmacist/dashboard.tpl',
      1 => 1775720404,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d763654a6342_28459821 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\pharmacist';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Tổng quan",'active_page'=>"dashboard"), (int) 0, $_smarty_current_dir);
?>

<div class="patient-welcome" style="background:linear-gradient(135deg, #4c1d95 0%, #8b5cf6 100%)">
  <div class="patient-welcome__text">
    <h2>Xin chào, <span style="color:#ede9fe"><?php echo (($tmp = $_smarty_tpl->getValue('current_user_name') ?? null)===null||$tmp==='' ? "Dược sĩ" ?? null : $tmp);?>
</span> 💊</h2>
    <p>Có <strong style="color:#fff"><?php echo (($tmp = $_smarty_tpl->getValue('stats')['new_rx'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong> đơn thuốc mới cần xử lý hôm nay</p>
  </div>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=prescriptions" class="btn-admin-primary" style="background:#fff; color:#4c1d95">
    <i class="fa-solid fa-prescription"></i> Xử lý đơn thuốc
  </a>
</div>

<div class="patient-stats">
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-prescription"></i></div>
    <div>
      <p>Đơn thuốc mới</p>
      <strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['new_rx'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong>
    </div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-capsules"></i></div>
    <div>
      <p>Đã phát hôm nay</p>
      <strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['dispensed_today'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong>
    </div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#ef4444"><i class="fa-solid fa-boxes-stacked"></i></div>
    <div>
      <p>Thuốc sắp hết</p>
      <strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['low_stock'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong>
    </div>
  </div>
  <div class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-regular fa-calendar-xmark"></i></div>
    <div>
      <p>Thuốc sắp hết hạn</p>
      <strong><?php echo (($tmp = $_smarty_tpl->getValue('stats')['expiring'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
</strong>
    </div>
  </div>
</div>

<?php if ($_smarty_tpl->getValue('stats')['low_stock'] > 0) {?>
<div class="alert alert--warning mb-1">
  <i class="fa-solid fa-triangle-exclamation"></i> Có <strong><?php echo $_smarty_tpl->getValue('stats')['low_stock'];?>
</strong> loại thuốc sắp hết hàng. 
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=low-stock">Xem ngay →</a>
</div>
<?php }?>

<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: stretch; margin-top: 20px;">
  
  <div class="admin-card" style="margin-bottom: 0; display: flex; flex-direction: column;">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-prescription"></i> Đơn thuốc mới nhất</h3>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=prescriptions" class="btn-link">Xem tất cả</a>
    </div>
    <div class="admin-card__body p-0" style="flex-grow: 1;">
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Mã đơn</th>
              <th>Bệnh nhân</th>
              <th>Bác sĩ kê</th>
              <th>Thời gian</th>
              <th>Số lượng</th>
              <th>Trạng thái</th>
              <th>Thao tác</th>
            </tr>
          </thead>
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
              <td>
                <div class="table-user">
                  <div class="table-avatar"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('rx')['patient_name'],1,'');?>
</div>
                  <strong><?php echo $_smarty_tpl->getValue('rx')['patient_name'];?>
</strong>
                </div>
              </td>
              <td><?php echo $_smarty_tpl->getValue('rx')['doctor_name'];?>
</td>
              <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('rx')['created_at'],"%H:%M %d/%m");?>
</td>
              <td><span class="badge badge--blue"><?php echo $_smarty_tpl->getValue('rx')['drug_count'];?>
 thuốc</span></td>
              <td>
                <?php if ($_smarty_tpl->getValue('rx')['status'] == 'pending') {?>
                  <span class="badge badge--warning">Chờ phát</span>
                <?php } elseif ($_smarty_tpl->getValue('rx')['status'] == 'dispensing') {?>
                  <span class="badge badge--blue">Đang bốc</span>
                <?php } elseif ($_smarty_tpl->getValue('rx')['status'] == 'done') {?>
                  <span class="badge badge--success">Đã phát</span>
                <?php } else { ?>
                  <span class="badge badge--neutral"><?php echo $_smarty_tpl->getValue('rx')['status'];?>
</span>
                <?php }?>
              </td>
              <td>
                <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=dispensing&id=<?php echo $_smarty_tpl->getValue('rx')['_id'];?>
" class="btn-admin-primary" style="font-size:12px; padding:.35rem .75rem">
                  <i class="fa-solid fa-capsules"></i> Phát thuốc
                </a>
              </td>
            </tr>
            <?php
}
if ($foreach0DoElse) {
?>
            <tr>
              <td colspan="7" class="table-empty" style="padding: 3rem 0; text-align: center;">Không có đơn thuốc mới cần xử lý</td>
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
    <div class="admin-card__header" style="padding: 16px 20px;">
      <h3><i class="fa-solid fa-boxes-stacked" style="color: #0ea5e9;"></i> Tồn kho thấp</h3>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=low-stock" class="btn-link">Xem tất cả</a>
    </div>
    
    <div class="admin-card__body p-0" style="flex-grow: 1; background-color: #fff; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('low_stock_drugs'), 'drug', false, NULL, 'stock_loop', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('drug')->value) {
$foreach1DoElse = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_stock_loop']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_stock_loop']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_stock_loop']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_stock_loop']->value['total'];
?>
      
      <div style="display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; <?php if (!($_smarty_tpl->getValue('__smarty_foreach_stock_loop')['last'] ?? null)) {?>border-bottom: 1px solid #f1f5f9;<?php }?>">
        <div style="display: flex; align-items: center; gap: 12px;">
          <div style="width: 42px; height: 42px; display: flex; align-items: center; justify-content: center; background: #fee2e2; color: #ef4444; border-radius: 8px; font-size: 18px; flex-shrink: 0;">
            <i class="fa-solid fa-pills"></i>
          </div>
          <div>
            <strong style="display: block; font-size: 14px; color: #0f172a; margin-bottom: 4px;"><?php echo $_smarty_tpl->getValue('drug')['name'];?>
</strong>
            <p style="margin: 0; font-size: 13px; color: #64748b;">
              Còn lại: <strong style="color: #ef4444;"><?php echo $_smarty_tpl->getValue('drug')['stock_qty'];?>
</strong> <?php echo (($tmp = $_smarty_tpl->getValue('drug')['unit'] ?? null)===null||$tmp==='' ? 'viên' ?? null : $tmp);?>
 <span style="color:#cbd5e1; margin:0 4px;">|</span> Tối thiểu: <?php echo $_smarty_tpl->getValue('drug')['min_qty'];?>

            </p>
          </div>
        </div>
        <span class="badge" style="background: #fee2e2; color: #991b1b; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 500;">Thấp</span>
      </div>

      <?php
}
if ($foreach1DoElse) {
?>
      <div class="empty-state" style="padding:4rem 1rem; text-align: center;">
        <i class="fa-solid fa-box-open" style="font-size: 3rem; color: #e2e8f0; margin-bottom: 1rem; display: block;"></i>
        <p style="color: #64748b; margin: 0;">Tồn kho đang ở mức ổn định</p>
      </div>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      
    </div>
  </div>

</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

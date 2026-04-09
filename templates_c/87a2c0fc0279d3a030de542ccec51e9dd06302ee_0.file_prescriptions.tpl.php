<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:24:03
  from 'file:doctor/prescriptions.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d76223bd2085_65182758',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '87a2c0fc0279d3a030de542ccec51e9dd06302ee' => 
    array (
      0 => 'doctor/prescriptions.tpl',
      1 => 1775718349,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d76223bd2085_65182758 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\doctor';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Đơn thuốc đã kê",'active_page'=>"prescriptions"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-prescription"></i> Đơn thuốc đã kê</h2>
    <p class="page-subtitle">Lịch sử đơn thuốc bác sĩ đã kê</p>
  </div>
</div>

<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" class="filter-bar">
      <input type="hidden" name="role" value="doctor">
      <input type="hidden" name="page" value="prescriptions">
      
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Tên bệnh nhân, mã đơn..." value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        </div>
        <input type="date" name="date_from" value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        <input type="date" name="date_to"   value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
      </div>
    </form>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Mã đơn</th>
          <th>Bệnh nhân</th>
          <th>Chẩn đoán</th>
          <th>Ngày kê</th>
          <th>Số thuốc</th>
          <th>Tình trạng phát</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('prescriptions'), 'rx');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('rx')->value) {
$foreach0DoElse = false;
?>
        <tr>
          <td><span class="code-tag"><?php echo $_smarty_tpl->getValue('rx')['code'];?>
</span></td>
          <td><strong><?php echo $_smarty_tpl->getValue('rx')['patient_name'];?>
</strong></td>
          <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')((($tmp = $_smarty_tpl->getValue('rx')['diagnosis'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp),40,'...');?>
</td>
          <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('rx')['date'],"%d/%m/%Y");?>
</td>
          <td><span class="badge badge--blue"><?php echo (($tmp = $_smarty_tpl->getValue('rx')['drug_count'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
 thuốc</span></td>
          <td>
                        <?php if ($_smarty_tpl->getValue('rx')['status'] == 'done') {?>
              <span class="badge badge--success"><i class="fa-solid fa-check"></i> Đã phát</span>
            <?php } elseif ($_smarty_tpl->getValue('rx')['status'] == 'paid') {?>
              <span class="badge badge--warning">Chờ phát thuốc</span>
            <?php } else { ?>
              <span class="badge badge--neutral">Chờ thanh toán</span>
            <?php }?>
          </td>
          <td>
            <div class="table-actions">
              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=doctor&page=prescriptions&id=<?php echo $_smarty_tpl->getValue('rx')['_id'];?>
" class="action-btn" title="Xem chi tiết">
                <i class="fa-solid fa-eye"></i>
              </a>
            </div>
          </td>
        </tr>
        <?php
}
if ($foreach0DoElse) {
?>
        <tr>
          <td colspan="7" class="table-empty">Chưa có đơn thuốc nào</td>
        </tr>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </tbody>
    </table>
  </div>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

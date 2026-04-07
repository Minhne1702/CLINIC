<?php
/* Smarty version 5.8.0, created on 2026-04-07 08:01:53
  from 'file:patient/test-results.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d4b9f1f02430_80027151',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '06dc41e0ddb23aeb1db459c886d2474fedcb0ead' => 
    array (
      0 => 'patient/test-results.tpl',
      1 => 1775539480,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d4b9f1f02430_80027151 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\patient';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Kết quả xét nghiệm",'active_page'=>"test-results"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-flask"></i> Kết quả xét nghiệm</h2>
    <p class="page-subtitle">Tra cứu kết quả xét nghiệm và chẩn đoán hình ảnh</p>
  </div>
</div>

<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="<?php echo $_smarty_tpl->getValue('base_url');?>
/" class="filter-bar">
    <input type="hidden" name="role" value="patient">
    <input type="hidden" name="page" value="test-results">
    <div class="filter-bar__group">
      <div class="filter-input">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" name="q" placeholder="Tên xét nghiệm, bác sĩ..." value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['q'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
      </div>
      <input type="date" name="date_from" value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_from'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
      <input type="date" name="date_to"   value="<?php echo (($tmp = $_smarty_tpl->getValue('filter')['date_to'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
    </div>
  </form>
</div></div>

<?php if ($_smarty_tpl->getValue('test_result')) {?>
<a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/?page=test-results" class="btn-admin-ghost" style="margin-bottom:1rem;display:inline-flex">
  <i class="fa-solid fa-arrow-left"></i> Quay lại
</a>
<div class="admin-card">
  <div class="admin-card__header">
    <h3><i class="fa-solid fa-flask"></i> <?php echo $_smarty_tpl->getValue('test_result')['name'];?>
</h3>
    <span class="text-muted" style="font-size:13px"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('test_result')['date'],"%d/%m/%Y");?>
</span>
  </div>
  <div class="admin-card__body">
    <div class="emr-header__grid" style="margin-bottom:1rem">
      <div><label class="section-eyebrow" style="font-size:11px">Bác sĩ chỉ định</label><p>BS. <?php echo $_smarty_tpl->getValue('test_result')['doctor_name'];?>
</p></div>
      <div><label class="section-eyebrow" style="font-size:11px">Ngày làm</label><p><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('test_result')['date'],"%d/%m/%Y");?>
</p></div>
      <div><label class="section-eyebrow" style="font-size:11px">Chẩn đoán</label><p><?php echo (($tmp = $_smarty_tpl->getValue('test_result')['diagnosis'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</p></div>
      <div><label class="section-eyebrow" style="font-size:11px">Trạng thái</label><span class="badge badge--success">Có kết quả</span></div>
    </div>
    <?php if ($_smarty_tpl->getValue('test_result')['items']) {?>
    <table class="admin-table">
      <thead><tr><th>Tên chỉ số</th><th>Kết quả</th><th>Đơn vị</th><th>Chỉ số bình thường</th><th>Đánh giá</th></tr></thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('test_result')['items'], 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
        <tr>
          <td><?php echo $_smarty_tpl->getValue('item')['name'];?>
</td>
          <td><strong class="<?php if ($_smarty_tpl->getValue('item')['status'] == 'normal') {?>text-success<?php } elseif ($_smarty_tpl->getValue('item')['status'] == 'high' || $_smarty_tpl->getValue('item')['status'] == 'low') {?>text-danger<?php }?>"><?php echo $_smarty_tpl->getValue('item')['value'];?>
</strong></td>
          <td class="text-muted"><?php echo (($tmp = $_smarty_tpl->getValue('item')['unit'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
          <td class="text-muted"><?php echo (($tmp = $_smarty_tpl->getValue('item')['normal_range'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
          <td>
            <?php if ($_smarty_tpl->getValue('item')['status'] == 'normal') {?><span class="badge badge--success">Bình thường</span>
            <?php } elseif ($_smarty_tpl->getValue('item')['status'] == 'high') {?><span class="badge badge--danger">Cao</span>
            <?php } elseif ($_smarty_tpl->getValue('item')['status'] == 'low') {?><span class="badge badge--warning">Thấp</span>
            <?php } else { ?><span class="badge badge--neutral">—</span><?php }?>
          </td>
        </tr>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </tbody>
    </table>
    <?php }?>
    <?php if ($_smarty_tpl->getValue('test_result')['files']) {?>
    <div style="margin-top:1rem;display:flex;gap:.5rem;flex-wrap:wrap">
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('test_result')['files'], 'file');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('file')->value) {
$foreach1DoElse = false;
?>
      <a href="<?php echo $_smarty_tpl->getValue('file')['url'];?>
" target="_blank" class="btn-admin-secondary" style="font-size:13px">
        <i class="fa-solid fa-file-<?php if ($_smarty_tpl->getValue('file')['type'] == 'pdf') {?>pdf<?php } else { ?>image<?php }?>"></i> <?php echo $_smarty_tpl->getValue('file')['name'];?>

      </a>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>
    <?php }?>
    <?php if ($_smarty_tpl->getValue('test_result')['note']) {?>
    <div style="margin-top:1rem;padding:1rem;background:#f0f9ff;border-radius:8px;border-left:3px solid var(--admin-primary)">
      <strong style="font-size:13px">Nhận xét của bác sĩ:</strong>
      <p style="font-size:13px;margin-top:.3rem"><?php echo $_smarty_tpl->getValue('test_result')['note'];?>
</p>
    </div>
    <?php }?>
  </div>
</div>
<?php } else { ?>
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table">
    <thead><tr><th>Ngày</th><th>Tên xét nghiệm</th><th>Bác sĩ chỉ định</th><th>Chẩn đoán</th><th>File đính kèm</th><th>Thao tác</th></tr></thead>
    <tbody>
      <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('test_results'), 'tr');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('tr')->value) {
$foreach2DoElse = false;
?>
      <tr>
        <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('tr')['date'],"%d/%m/%Y");?>
</td>
        <td><strong><?php echo $_smarty_tpl->getValue('tr')['name'];?>
</strong></td>
        <td>BS. <?php echo $_smarty_tpl->getValue('tr')['doctor_name'];?>
</td>
        <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')((($tmp = $_smarty_tpl->getValue('tr')['diagnosis'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp),35,'...');?>
</td>
        <td>
          <?php if ($_smarty_tpl->getValue('tr')['file_count'] > 0) {?>
            <span class="badge badge--blue"><?php echo $_smarty_tpl->getValue('tr')['file_count'];?>
 file</span>
          <?php } else { ?>
            <span class="text-muted">—</span>
          <?php }?>
        </td>
        <td>
          <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/?page=test-results&id=<?php echo $_smarty_tpl->getValue('tr')['_id'];?>
" class="action-btn" title="Xem chi tiết">
            <i class="fa-solid fa-eye"></i>
          </a>
        </td>
      </tr>
      <?php
}
if ($foreach2DoElse) {
?>
      <tr><td colspan="6" class="table-empty">Chưa có kết quả xét nghiệm nào</td></tr>
      <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </tbody>
  </table>
</div></div>
<?php }?>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

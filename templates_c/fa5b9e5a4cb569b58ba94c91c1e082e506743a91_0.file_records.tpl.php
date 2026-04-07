<?php
/* Smarty version 5.8.0, created on 2026-04-07 08:01:57
  from 'file:patient/records.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d4b9f556dd80_03966149',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fa5b9e5a4cb569b58ba94c91c1e082e506743a91' => 
    array (
      0 => 'patient/records.tpl',
      1 => 1775546728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d4b9f556dd80_03966149 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\patient';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Hồ sơ bệnh án",'active_page'=>"records"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-folder-open"></i> Hồ sơ bệnh án</h2>
    <p class="page-subtitle">Lịch sử khám bệnh và kết quả điều trị</p>
  </div>
  <?php if (!$_smarty_tpl->getValue('record')) {?>
  <div class="page-toolbar__right">
    <div class="filter-input" style="min-width:240px">
      <i class="fa-solid fa-magnifying-glass"></i>
      <input type="text" id="searchRecord" placeholder="Tìm chẩn đoán, bác sĩ...">
    </div>
  </div>
  <?php }?>
</div>

<?php if ($_smarty_tpl->getValue('record')) {?>
<a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=records" class="btn-admin-ghost" style="margin-bottom:1rem;display:inline-flex">
  <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
</a>

<div class="emr-header admin-card" style="margin-bottom:1rem">
  <div class="admin-card__body">
    <div class="emr-header__grid">
      <div>
        <p class="section-eyebrow" style="font-size:11px">Ngày khám</p>
        <h3><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('record')['date'],"%d/%m/%Y");?>
</h3>
        <p class="text-muted" style="font-size:13px"><?php echo $_smarty_tpl->getValue('record')['time'];?>
</p>
      </div>
      <div>
        <p class="section-eyebrow" style="font-size:11px">Bác sĩ điều trị</p>
        <h3>BS. <?php echo $_smarty_tpl->getValue('record')['doctor_name'];?>
</h3>
        <p class="text-muted" style="font-size:13px"><?php echo $_smarty_tpl->getValue('record')['specialty'];?>
</p>
      </div>
      <div>
        <p class="section-eyebrow" style="font-size:11px">Mã lịch hẹn</p>
        <code style="font-size:14px;background:#f1f5f9;padding:4px 10px;border-radius:6px"><?php echo (($tmp = $_smarty_tpl->getValue('record')['apt_code'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</code>
      </div>
      <div>
        <p class="section-eyebrow" style="font-size:11px">Trạng thái</p>
        <span class="badge badge--success">Đã khám</span>
      </div>
    </div>
  </div>
</div>

<div class="emr-grid">

  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-notes-medical"></i> Chẩn đoán & Triệu chứng</h3></div>
    <div class="admin-card__body">
      <div class="emr-section">
        <label>Triệu chứng</label>
        <p><?php echo (($tmp = $_smarty_tpl->getValue('record')['symptoms'] ?? null)===null||$tmp==='' ? 'Không ghi nhận' ?? null : $tmp);?>
</p>
      </div>
      <div class="emr-section">
        <label>Sinh hiệu</label>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:.5rem;margin-top:.3rem">
          <?php if ($_smarty_tpl->getValue('record')['blood_pressure']) {?><div class="admin-card" style="padding:.5rem .75rem;text-align:center"><small>Huyết áp</small><br><strong><?php echo $_smarty_tpl->getValue('record')['blood_pressure'];?>
</strong></div><?php }?>
          <?php if ($_smarty_tpl->getValue('record')['pulse']) {?><div class="admin-card" style="padding:.5rem .75rem;text-align:center"><small>Mạch</small><br><strong><?php echo $_smarty_tpl->getValue('record')['pulse'];?>
 lần/phút</strong></div><?php }?>
          <?php if ($_smarty_tpl->getValue('record')['temperature']) {?><div class="admin-card" style="padding:.5rem .75rem;text-align:center"><small>Nhiệt độ</small><br><strong><?php echo $_smarty_tpl->getValue('record')['temperature'];?>
°C</strong></div><?php }?>
        </div>
      </div>
      <div class="emr-section">
        <label>Chẩn đoán</label>
        <p>
          <?php if ($_smarty_tpl->getValue('record')['icd_code']) {?><span class="code-tag code-tag--blue" style="margin-right:.5rem"><?php echo $_smarty_tpl->getValue('record')['icd_code'];?>
</span><?php }?>
          <strong><?php echo (($tmp = $_smarty_tpl->getValue('record')['diagnosis'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</strong>
        </p>
      </div>
      <?php if ($_smarty_tpl->getValue('record')['doctor_note']) {?>
      <div class="emr-section">
        <label>Lời dặn của bác sĩ</label>
        <p style="background:#f0f9ff;padding:.75rem;border-radius:8px;border-left:3px solid var(--admin-primary)"><?php echo $_smarty_tpl->getValue('record')['doctor_note'];?>
</p>
      </div>
      <?php }?>
    </div>
  </div>

  <div class="admin-card">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-prescription"></i> Đơn thuốc</h3>
      <?php if ($_smarty_tpl->getValue('record')['prescription']['_id']) {?>
      <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=prescriptions&id=<?php echo $_smarty_tpl->getValue('record')['prescription']['_id'];?>
" class="btn-admin-secondary" style="font-size:12px;padding:.35rem .75rem">
        <i class="fa-solid fa-print"></i> In đơn
      </a>
      <?php }?>
    </div>
    <div class="admin-card__body p-0">
      <?php if ($_smarty_tpl->getValue('record')['prescription']['drugs']) {?>
      <table class="admin-table">
        <thead><tr><th>Tên thuốc</th><th>Hàm lượng</th><th>Số lượng</th><th>Liều dùng</th><th>Số ngày</th><th>Cách dùng</th></tr></thead>
        <tbody>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('record')['prescription']['drugs'], 'drug');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('drug')->value) {
$foreach0DoElse = false;
?>
          <tr>
            <td><strong><?php echo $_smarty_tpl->getValue('drug')['name'];?>
</strong><br><small class="text-muted"><?php echo (($tmp = $_smarty_tpl->getValue('drug')['active_ingredient'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</small></td>
            <td><?php echo (($tmp = $_smarty_tpl->getValue('drug')['concentration'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
            <td><strong><?php echo $_smarty_tpl->getValue('drug')['qty'];?>
 <?php echo $_smarty_tpl->getValue('drug')['unit'];?>
</strong></td>
            <td><?php echo $_smarty_tpl->getValue('drug')['dosage'];?>
</td>
            <td><?php echo $_smarty_tpl->getValue('drug')['days'];?>
 ngày</td>
            <td style="font-size:13px"><?php echo $_smarty_tpl->getValue('drug')['instruction'];?>
</td>
          </tr>
          <?php
}
if ($foreach0DoElse) {
?>
          <tr><td colspan="6" class="table-empty">Không có đơn thuốc</td></tr>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </tbody>
      </table>
      <?php if ($_smarty_tpl->getValue('record')['prescription']['prescription_note']) {?>
      <div style="padding:.75rem 1.25rem;background:#f8fafc;border-top:1px solid var(--admin-border);font-size:13px">
        <strong>Lời dặn:</strong> <?php echo $_smarty_tpl->getValue('record')['prescription']['prescription_note'];?>

      </div>
      <?php }?>
      <?php } else { ?>
      <div class="table-empty">Không có đơn thuốc</div>
      <?php }?>
    </div>
  </div>

  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-flask"></i> Kết quả xét nghiệm</h3></div>
    <div class="admin-card__body p-0">
      <?php if ($_smarty_tpl->getValue('record')['lab_results']) {?>
      <table class="admin-table">
        <thead><tr><th>Tên xét nghiệm</th><th>Kết quả</th><th>Chỉ số bình thường</th><th>Đánh giá</th></tr></thead>
        <tbody>
          <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('record')['lab_results'], 'lab');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('lab')->value) {
$foreach1DoElse = false;
?>
          <tr>
            <td><?php echo $_smarty_tpl->getValue('lab')['name'];?>
</td>
            <td><strong><?php echo $_smarty_tpl->getValue('lab')['value'];?>
 <?php echo $_smarty_tpl->getValue('lab')['unit'];?>
</strong></td>
            <td class="text-muted"><?php echo (($tmp = $_smarty_tpl->getValue('lab')['normal_range'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
            <td>
              <?php if ($_smarty_tpl->getValue('lab')['status'] == 'normal') {?><span class="badge badge--success">Bình thường</span>
              <?php } elseif ($_smarty_tpl->getValue('lab')['status'] == 'high') {?><span class="badge badge--danger">Cao</span>
              <?php } elseif ($_smarty_tpl->getValue('lab')['status'] == 'low') {?><span class="badge badge--warning">Thấp</span>
              <?php } else { ?><span class="badge badge--neutral">—</span><?php }?>
            </td>
          </tr>
          <?php
}
if ($foreach1DoElse) {
?>
          <tr><td colspan="4" class="table-empty">Không có kết quả xét nghiệm</td></tr>
          <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </tbody>
      </table>
      <?php if ($_smarty_tpl->getValue('record')['lab_files']) {?>
      <div style="padding:.75rem 1.25rem;border-top:1px solid var(--admin-border);display:flex;gap:.5rem;flex-wrap:wrap">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('record')['lab_files'], 'file');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('file')->value) {
$foreach2DoElse = false;
?>
        <a href="<?php echo $_smarty_tpl->getValue('file')['url'];?>
" target="_blank" class="btn-admin-secondary" style="font-size:12px;padding:.35rem .75rem">
          <i class="fa-solid fa-file-<?php if ($_smarty_tpl->getValue('file')['type'] == 'pdf') {?>pdf<?php } else { ?>image<?php }?>"></i> <?php echo $_smarty_tpl->getValue('file')['name'];?>

        </a>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </div>
      <?php }?>
      <?php } else { ?>
      <div class="table-empty">Không có kết quả xét nghiệm</div>
      <?php }?>
    </div>
  </div>

  <?php if ($_smarty_tpl->getValue('record')['images']) {?>
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-file-image"></i> Hình ảnh (X-quang, CT, siêu âm...)</h3></div>
    <div class="admin-card__body">
      <div class="image-grid">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('record')['images'], 'img');
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('img')->value) {
$foreach3DoElse = false;
?>
        <a href="<?php echo $_smarty_tpl->getValue('img')['url'];?>
" target="_blank" class="image-thumb">
          <img src="<?php echo $_smarty_tpl->getValue('img')['url'];?>
" alt="<?php echo $_smarty_tpl->getValue('img')['name'];?>
" loading="lazy">
          <span><?php echo $_smarty_tpl->getValue('img')['name'];?>
</span>
        </a>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </div>
    </div>
  </div>
  <?php }?>

</div>

<?php } else { ?>
<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table" id="recordsTable">
      <thead>
        <tr>
          <th>Ngày khám</th>
          <th>Bác sĩ điều trị</th>
          <th>Chuyên khoa</th>
          <th>Chẩn đoán</th>
          <th>Đơn thuốc</th>
          <th>Xét nghiệm</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('records'), 'rec');
$foreach4DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('rec')->value) {
$foreach4DoElse = false;
?>
        <tr>
          <td>
            <strong><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('rec')['date'],"%d/%m/%Y");?>
</strong>
            <br><small class="text-muted"><?php echo $_smarty_tpl->getValue('rec')['time'];?>
</small>
          </td>
          <td>BS. <?php echo $_smarty_tpl->getValue('rec')['doctor_name'];?>
</td>
          <td><?php echo $_smarty_tpl->getValue('rec')['specialty'];?>
</td>
          <td>
            <?php if ($_smarty_tpl->getValue('rec')['icd_code']) {?>
            <span class="code-tag code-tag--blue" style="font-size:11px"><?php echo $_smarty_tpl->getValue('rec')['icd_code'];?>
</span>
            <?php }?>
            <span style="font-size:13px"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')((($tmp = $_smarty_tpl->getValue('rec')['diagnosis'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp),40,'...');?>
</span>
          </td>
          <td>
            <?php if ($_smarty_tpl->getValue('rec')['has_prescription']) {?>
              <span class="badge badge--success"><i class="fa-solid fa-check"></i> Có đơn</span>
            <?php } else { ?>
              <span class="badge badge--neutral">Không</span>
            <?php }?>
          </td>
          <td>
            <?php if ($_smarty_tpl->getValue('rec')['lab_count'] > 0) {?>
              <span class="badge badge--blue"><?php echo $_smarty_tpl->getValue('rec')['lab_count'];?>
 XN</span>
            <?php }?>
            <?php if ($_smarty_tpl->getValue('rec')['image_count'] > 0) {?>
              <span class="badge badge--purple"><?php echo $_smarty_tpl->getValue('rec')['image_count'];?>
 ảnh</span>
            <?php }?>
            <?php if (!$_smarty_tpl->getValue('rec')['lab_count'] && !$_smarty_tpl->getValue('rec')['image_count']) {?>
              <span class="text-muted">—</span>
            <?php }?>
          </td>
          <td>
            <div class="table-actions">
              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=records&id=<?php echo $_smarty_tpl->getValue('rec')['_id'];?>
" class="action-btn" title="Xem chi tiết">
                <i class="fa-solid fa-eye"></i>
              </a>
              <?php if ($_smarty_tpl->getValue('rec')['has_prescription']) {?>
              <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=prescriptions&record_id=<?php echo $_smarty_tpl->getValue('rec')['_id'];?>
" class="action-btn" title="Xem đơn thuốc">
                <i class="fa-solid fa-prescription"></i>
              </a>
              <?php }?>
            </div>
          </td>
        </tr>
        <?php
}
if ($foreach4DoElse) {
?>
        <tr><td colspan="7" class="table-empty">Chưa có lịch sử khám bệnh nào</td></tr>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </tbody>
    </table>
  </div>
</div>
<?php }?>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<?php echo '<script'; ?>
>
const searchInput = document.getElementById('searchRecord');
if (searchInput) {
  searchInput.addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#recordsTable tbody tr').forEach(row => {
      row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
  });
}
<?php echo '</script'; ?>
>
<?php }
}

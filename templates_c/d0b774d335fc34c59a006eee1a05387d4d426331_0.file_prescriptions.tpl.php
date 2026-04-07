<?php
/* Smarty version 5.8.0, created on 2026-04-07 08:01:55
  from 'file:patient/prescriptions.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d4b9f3ae6de3_11912608',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd0b774d335fc34c59a006eee1a05387d4d426331' => 
    array (
      0 => 'patient/prescriptions.tpl',
      1 => 1775546721,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d4b9f3ae6de3_11912608 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\Admin\\Music\\CLINIC\\templates\\patient';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Đơn thuốc của tôi",'active_page'=>"prescriptions"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-prescription"></i> Đơn thuốc của tôi</h2>
    <p class="page-subtitle">Lịch sử đơn thuốc đã được kê</p>
  </div>
  <?php if ($_smarty_tpl->getValue('prescription')) {?>
  <div class="page-toolbar__right">
    <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=prescriptions" class="btn-admin-ghost">
      <i class="fa-solid fa-arrow-left"></i> Quay lại
    </a>
    <button class="btn-admin-secondary" onclick="window.print()">
      <i class="fa-solid fa-print"></i> In đơn thuốc
    </button>
  </div>
  <?php }?>
</div>

<?php if ($_smarty_tpl->getValue('prescription')) {?>
<div class="admin-card rx-print-area">
  <div class="admin-card__body">

    <div class="rx-header">
      <div class="rx-header__clinic">
        <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:.4rem">
          <div class="logo-icon" style="width:34px;height:34px;font-size:14px;background:linear-gradient(135deg,#0891b2,#06b6d4);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff">
            <i class="fa-solid fa-heart-pulse"></i>
          </div>
          <strong style="font-size:16px;color:var(--admin-primary)">MediCare</strong>
        </div>
        <p style="font-size:12px;color:var(--admin-text-secondary)">123 Nguyễn Thị Minh Khai, Q.1, TP.HCM</p>
        <p style="font-size:12px;color:var(--admin-text-secondary)">Hotline: 1900 xxxx</p>
      </div>
      <div class="rx-header__title">
        <h2>ĐƠN THUỐC</h2>
        <p>Mã đơn: <strong><?php echo (($tmp = $_smarty_tpl->getValue('prescription')['code'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</strong></p>
        <p>Ngày kê: <strong><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('prescription')['date'],"%d/%m/%Y");?>
</strong></p>
      </div>
    </div>

    <div class="rx-patient-info">
      <div class="rx-info-row"><span>Họ và tên:</span><strong><?php echo $_smarty_tpl->getValue('prescription')['patient_name'];?>
</strong></div>
      <div class="rx-info-row"><span>Ngày sinh:</span><strong><?php echo (($tmp = $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('prescription')['patient_birthday'],"%d/%m/%Y") ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</strong></div>
      <div class="rx-info-row"><span>Giới tính:</span><strong><?php if ($_smarty_tpl->getValue('prescription')['patient_gender'] == 'male') {?>Nam<?php } elseif ($_smarty_tpl->getValue('prescription')['patient_gender'] == 'female') {?>Nữ<?php } else { ?>—<?php }?></strong></div>
      <div class="rx-info-row"><span>Chẩn đoán:</span><strong><?php echo (($tmp = $_smarty_tpl->getValue('prescription')['diagnosis'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</strong></div>
    </div>

    <table class="admin-table rx-drug-table">
      <thead>
        <tr>
          <th style="width:28px">STT</th>
          <th>Tên thuốc</th>
          <th>Hoạt chất</th>
          <th>Hàm lượng</th>
          <th>Số lượng</th>
          <th>Liều dùng</th>
          <th>Số ngày</th>
          <th>Cách dùng</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('prescription')['drugs'], 'drug', false, NULL, 'dloop', array (
  'iteration' => true,
));
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('drug')->value) {
$foreach0DoElse = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_dloop']->value['iteration']++;
?>
        <tr>
          <td style="text-align:center"><?php echo ($_smarty_tpl->getValue('__smarty_foreach_dloop')['iteration'] ?? null);?>
</td>
          <td><strong><?php echo $_smarty_tpl->getValue('drug')['name'];?>
</strong></td>
          <td class="text-muted"><?php echo (($tmp = $_smarty_tpl->getValue('drug')['active_ingredient'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</td>
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
        <tr><td colspan="8" class="table-empty">Không có thuốc trong đơn</td></tr>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </tbody>
    </table>

    <?php if ($_smarty_tpl->getValue('prescription')['prescription_note']) {?>
    <div style="margin-top:1rem;padding:1rem;background:#f0f9ff;border-radius:8px;border-left:3px solid var(--admin-primary)">
      <strong style="font-size:13px;color:var(--admin-primary)">Lời dặn của bác sĩ:</strong>
      <p style="font-size:13px;margin-top:.3rem"><?php echo $_smarty_tpl->getValue('prescription')['prescription_note'];?>
</p>
    </div>
    <?php }?>

    <div class="rx-footer">
      <div>
        <p style="font-size:13px;color:var(--admin-text-secondary)">
          Tái khám sau: <strong><?php echo (($tmp = $_smarty_tpl->getValue('prescription')['followup_days'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
 ngày</strong>
        </p>
        <p style="font-size:12px;color:var(--admin-text-muted);margin-top:.25rem">
          Ngày tái khám: <?php echo (($tmp = $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('prescription')['followup_date'],"%d/%m/%Y") ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>

        </p>
      </div>
      <div style="text-align:center">
        <p style="font-size:12px;color:var(--admin-text-secondary)">Bác sĩ điều trị</p>
        <p style="margin-top:2.5rem;font-weight:600">BS. <?php echo $_smarty_tpl->getValue('prescription')['doctor_name'];?>
</p>
        <p style="font-size:12px;color:var(--admin-text-muted)"><?php echo $_smarty_tpl->getValue('prescription')['specialty'];?>
</p>
      </div>
    </div>

  </div>
</div>

<?php } else { ?>
<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Mã đơn</th>
          <th>Ngày kê</th>
          <th>Bác sĩ kê đơn</th>
          <th>Chẩn đoán</th>
          <th>Số loại thuốc</th>
          <th>Tái khám</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('prescriptions'), 'rx');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('rx')->value) {
$foreach1DoElse = false;
?>
        <tr>
          <td><span class="code-tag"><?php echo $_smarty_tpl->getValue('rx')['code'];?>
</span></td>
          <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('rx')['date'],"%d/%m/%Y");?>
</td>
          <td>BS. <?php echo $_smarty_tpl->getValue('rx')['doctor_name'];?>
</td>
          <td><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')((($tmp = $_smarty_tpl->getValue('rx')['diagnosis'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp),40,'...');?>
</td>
          <td><span class="badge badge--blue"><?php echo (($tmp = $_smarty_tpl->getValue('rx')['drug_count'] ?? null)===null||$tmp==='' ? 0 ?? null : $tmp);?>
 thuốc</span></td>
          <td>
            <?php if ($_smarty_tpl->getValue('rx')['followup_date']) {?>
              <span class="badge badge--warning"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('rx')['followup_date'],"%d/%m/%Y");?>
</span>
            <?php } else { ?>
              <span class="text-muted">—</span>
            <?php }?>
          </td>
          <td>
            <?php if ($_smarty_tpl->getValue('rx')['dispensed']) {?>
              <span class="badge badge--success"><i class="fa-solid fa-check"></i> Đã phát</span>
            <?php } else { ?>
              <span class="badge badge--warning">Chờ phát</span>
            <?php }?>
          </td>
          <td>
            <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?page=prescriptions&id=<?php echo $_smarty_tpl->getValue('rx')['_id'];?>
" class="action-btn" title="Xem & In">
              <i class="fa-solid fa-eye"></i>
            </a>
          </td>
        </tr>
        <?php
}
if ($foreach1DoElse) {
?>
        <tr><td colspan="8" class="table-empty">Chưa có đơn thuốc nào</td></tr>
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

<style media="print">
  .sidebar, .admin-topnav, .page-toolbar .page-toolbar__right,
  .admin-main { margin-left: 0 !important; }
  .admin-content { padding: 0 !important; }
  .admin-card { border: none !important; box-shadow: none !important; }
</style>
<?php }
}

<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:24:01
  from 'file:doctor/examination.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d76221ca3e92_80243394',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da385fc91a7b5bab267f8d06d31038881a0bf763' => 
    array (
      0 => 'doctor/examination.tpl',
      1 => 1775717822,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d76221ca3e92_80243394 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\doctor';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Khám bệnh",'active_page'=>"examination"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-notes-medical"></i> Khám bệnh</h2>
    <?php if ($_smarty_tpl->getValue('patient')) {?><p class="page-subtitle">Bệnh nhân: <strong><?php echo $_smarty_tpl->getValue('patient')['full_name'];?>
</strong> — #<?php echo $_smarty_tpl->getValue('patient')['patient_code'];?>
</p><?php }?>
  </div>
  <div class="page-toolbar__right">
    <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=doctor&page=queue" class="btn-admin-ghost"><i class="fa-solid fa-arrow-left"></i> Hàng chờ</a>
  </div>
</div>

<?php if ($_smarty_tpl->getValue('success_message')) {?><div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div><?php }
if ($_smarty_tpl->getValue('error_message')) {?><div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $_smarty_tpl->getValue('error_message');?>
</div><?php }?>

<?php if ($_smarty_tpl->getValue('patient')) {?>
<div class="exam-layout">

  <div class="exam-patient-panel">
    <div class="admin-card">
      <div class="admin-card__header"><h3><i class="fa-solid fa-hospital-user"></i> Thông tin bệnh nhân</h3></div>
      <div class="admin-card__body">
        <div style="text-align:center;margin-bottom:1rem">
          <div class="table-avatar" style="width:60px;height:60px;font-size:22px;margin:0 auto .5rem"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')($_smarty_tpl->getValue('patient')['full_name'],1,'');?>
</div>
          <strong style="font-size:15px"><?php echo $_smarty_tpl->getValue('patient')['full_name'];?>
</strong>
          <p class="text-muted" style="font-size:12px">#<?php echo $_smarty_tpl->getValue('patient')['patient_code'];?>
</p>
        </div>
        <div class="emr-section"><label>Ngày sinh</label><p><?php echo (($tmp = $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('patient')['birthday'],"%d/%m/%Y") ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</p></div>
        <div class="emr-section"><label>Giới tính</label><p><?php if ($_smarty_tpl->getValue('patient')['gender'] == 'male') {?>Nam<?php } elseif ($_smarty_tpl->getValue('patient')['gender'] == 'female') {?>Nữ<?php } else { ?>—<?php }?></p></div>
        <div class="emr-section"><label>Nhóm máu</label><p><?php echo (($tmp = $_smarty_tpl->getValue('patient')['blood_type'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp);?>
</p></div>
        <div class="emr-section"><label>Số BHYT</label><p><?php echo (($tmp = $_smarty_tpl->getValue('patient')['bhyt_code'] ?? null)===null||$tmp==='' ? 'Không có' ?? null : $tmp);?>
</p></div>
        
        <?php if ($_smarty_tpl->getValue('patient')['drug_allergies']) {?>
        <div class="emr-section" style="background:#fef2f2;padding:.75rem;border-radius:8px;border-left:3px solid var(--admin-danger)">
          <label style="color:var(--admin-danger)"><i class="fa-solid fa-triangle-exclamation"></i> Dị ứng thuốc</label>
          <p style="color:#991b1b;font-weight:500"><?php echo $_smarty_tpl->getValue('patient')['drug_allergies'];?>
</p>
        </div>
        <?php }?>
        
        <?php if ($_smarty_tpl->getValue('patient')['medical_history']) {?>
        <div class="emr-section"><label>Tiền sử bệnh</label><p style="font-size:13px"><?php echo $_smarty_tpl->getValue('patient')['medical_history'];?>
</p></div>
        <?php }?>
      </div>
    </div>

    <div class="admin-card" style="margin-top:1rem">
      <div class="admin-card__header"><h3><i class="fa-solid fa-clock-rotate-left"></i> Lịch sử khám</h3></div>
      <div class="admin-card__body p-0">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('recent_records'), 'rec');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('rec')->value) {
$foreach0DoElse = false;
?>
        <div class="record-item">
          <div class="record-item__icon"><i class="fa-solid fa-notes-medical"></i></div>
          <div class="record-item__info">
            <strong style="font-size:13px"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('truncate')((($tmp = $_smarty_tpl->getValue('rec')['diagnosis'] ?? null)===null||$tmp==='' ? '—' ?? null : $tmp),30,'...');?>
</strong>
            <p><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('rec')['date'],"%d/%m/%Y");?>
 · <?php echo $_smarty_tpl->getValue('rec')['doctor_name'];?>
</p>
          </div>
          <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=doctor&page=records&id=<?php echo $_smarty_tpl->getValue('rec')['_id'];?>
" class="action-btn" title="Xem chi tiết"><i class="fa-solid fa-eye"></i></a>
        </div>
        <?php
}
if ($foreach0DoElse) {
?>
        <div class="table-empty">Chưa có lịch sử khám</div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
      </div>
    </div>
  </div>
  <div class="exam-form-area">
    <form action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/" method="POST" id="examForm">
      <input type="hidden" name="role" value="doctor">
      <input type="hidden" name="page" value="examination">
      <input type="hidden" name="action" value="save">
      <input type="hidden" name="patient_id" value="<?php echo $_smarty_tpl->getValue('patient')['_id'];?>
">
      <input type="hidden" name="queue_id" value="<?php echo (($tmp = $_smarty_tpl->getValue('queue_id') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">

      <div class="admin-card mb-1">
        <div class="admin-card__header"><h3><i class="fa-solid fa-heart-pulse"></i> Sinh hiệu</h3></div>
        <div class="admin-card__body">
          <div class="vitals-grid">
            <div class="form-group"><label>Huyết áp (mmHg)</label><input type="text" name="blood_pressure" placeholder="VD: 120/80" value="<?php echo (($tmp = $_smarty_tpl->getValue('exam')['blood_pressure'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"></div>
            <div class="form-group"><label>Mạch (lần/phút)</label><input type="number" name="pulse" placeholder="VD: 72" value="<?php echo (($tmp = $_smarty_tpl->getValue('exam')['pulse'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"></div>
            <div class="form-group"><label>Nhiệt độ (°C)</label><input type="number" name="temperature" step="0.1" placeholder="VD: 36.5" value="<?php echo (($tmp = $_smarty_tpl->getValue('exam')['temperature'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"></div>
            <div class="form-group"><label>SpO2 (%)</label><input type="number" name="spo2" placeholder="VD: 98" value="<?php echo (($tmp = $_smarty_tpl->getValue('exam')['spo2'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"></div>
            <div class="form-group"><label>Cân nặng (kg)</label><input type="number" name="weight" placeholder="" value="<?php echo (($tmp = $_smarty_tpl->getValue('patient')['weight'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"></div>
            <div class="form-group"><label>Nhịp thở (lần/phút)</label><input type="number" name="respiration" placeholder="VD: 16" value="<?php echo (($tmp = $_smarty_tpl->getValue('exam')['respiration'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
"></div>
          </div>
        </div>
      </div>

      <div class="admin-card mb-1">
        <div class="admin-card__header"><h3><i class="fa-solid fa-virus"></i> Triệu chứng & Chẩn đoán</h3></div>
        <div class="admin-card__body">
          <div class="form-group">
            <label>Lý do khám / Triệu chứng chính <span class="required">*</span></label>
            <textarea name="symptoms" rows="3" required placeholder="Mô tả triệu chứng bệnh nhân..."><?php echo (($tmp = (($tmp = $_smarty_tpl->getValue('exam')['symptoms'] ?? null)===null||$tmp==='' ? $_smarty_tpl->getValue('queue_symptoms') ?? null : $tmp) ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</textarea>
          </div>
          <div class="form-group">
            <label>Khám lâm sàng</label>
            <textarea name="clinical_exam" rows="3" placeholder="Kết quả thăm khám lâm sàng..."><?php echo (($tmp = $_smarty_tpl->getValue('exam')['clinical_exam'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</textarea>
          </div>
          
          <div class="form-row-2">
            <div class="form-group position-relative">
              <label>Chẩn đoán sơ bộ (Gõ để tìm kiếm)</label>
              <input type="text" name="diagnosis_primary" placeholder="Nhập tên bệnh..." value="<?php echo (($tmp = $_smarty_tpl->getValue('exam')['diagnosis_primary'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" id="diagInput" autocomplete="off">
              <div id="diagSuggestions" class="autocomplete-box" style="display:none; position:absolute; z-index:100; background:#fff; border:1px solid #ccc; width:100%; max-height:200px; overflow-y:auto; border-radius:4px; box-shadow:0 4px 6px rgba(0,0,0,0.1);"></div>
            </div>
            <div class="form-group">
              <label>Mã ICD-10</label>
              <input type="text" name="icd_code" placeholder="VD: J06.9" value="<?php echo (($tmp = $_smarty_tpl->getValue('exam')['icd_code'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" id="icdInput">
            </div>
          </div>

          <div class="form-group">
            <label>Chẩn đoán phân biệt</label>
            <input type="text" name="diagnosis_secondary" placeholder="Chẩn đoán phân biệt (nếu có)..." value="<?php echo (($tmp = $_smarty_tpl->getValue('exam')['diagnosis_secondary'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
          </div>
          <div class="form-group">
            <label>Ghi chú bác sĩ</label>
            <textarea name="doctor_note" rows="2" placeholder="Ghi chú thêm nội bộ..."><?php echo (($tmp = $_smarty_tpl->getValue('exam')['doctor_note'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</textarea>
          </div>
        </div>
      </div>
      <div class="admin-card mb-1">
        <div class="admin-card__header">
          <h3><i class="fa-solid fa-prescription"></i> Kê đơn thuốc</h3>
          <button type="button" class="btn-admin-secondary" onclick="addDrugRow()"><i class="fa-solid fa-plus"></i> Thêm thuốc</button>
        </div>
        <div class="admin-card__body">
          <div class="table-responsive">
            <table class="admin-table" id="drugTable">
              <thead><tr><th>Tên thuốc</th><th>Hàm lượng</th><th>Số lượng</th><th>Đơn vị</th><th>Liều dùng</th><th>Số ngày</th><th>Cách dùng</th><th></th></tr></thead>
              <tbody id="drugRows">
                <?php if ($_smarty_tpl->getValue('exam')['prescription_drugs']) {?>
                  <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('exam')['prescription_drugs'], 'drug');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('drug')->value) {
$foreach1DoElse = false;
?>
                  <tr>
                    <td><input type="text" name="drug_name[]" value="<?php echo $_smarty_tpl->getValue('drug')['name'];?>
" placeholder="Tên thuốc" style="width:140px" class="drug-input"></td>
                    <td><input type="text" name="drug_concentration[]" value="<?php echo $_smarty_tpl->getValue('drug')['concentration'];?>
" placeholder="500mg" style="width:80px"></td>
                    <td><input type="number" name="drug_qty[]" value="<?php echo $_smarty_tpl->getValue('drug')['qty'];?>
" placeholder="10" style="width:65px" min="1"></td>
                    <td><select name="drug_unit[]" style="width:70px"><option value="vien" <?php if ($_smarty_tpl->getValue('drug')['unit'] == 'vien') {?>selected<?php }?>>Viên</option><option value="chai" <?php if ($_smarty_tpl->getValue('drug')['unit'] == 'chai') {?>selected<?php }?>>Chai</option><option value="ong" <?php if ($_smarty_tpl->getValue('drug')['unit'] == 'ong') {?>selected<?php }?>>Ống</option><option value="goi" <?php if ($_smarty_tpl->getValue('drug')['unit'] == 'goi') {?>selected<?php }?>>Gói</option></select></td>
                    <td><input type="text" name="drug_dosage[]" value="<?php echo $_smarty_tpl->getValue('drug')['dosage'];?>
" placeholder="2 viên/lần" style="width:110px"></td>
                    <td><input type="number" name="drug_days[]" value="<?php echo $_smarty_tpl->getValue('drug')['days'];?>
" placeholder="7" style="width:60px" min="1"></td>
                    <td><input type="text" name="drug_instruction[]" value="<?php echo $_smarty_tpl->getValue('drug')['instruction'];?>
" placeholder="Uống sau ăn" style="width:130px"></td>
                    <td><button type="button" class="action-btn action-btn--danger" onclick="this.closest('tr').remove()"><i class="fa-solid fa-trash"></i></button></td>
                  </tr>
                  <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                <?php } else { ?>
                  <tr id="emptyDrugRow"><td colspan="8" class="table-empty">Chưa có thuốc. Nhấn "Thêm thuốc" để kê đơn.</td></tr>
                <?php }?>
              </tbody>
            </table>
          </div>
          <div class="form-group" style="margin-top:1rem">
            <label>Lời dặn / Hẹn tái khám</label>
            <textarea name="prescription_note" rows="2" placeholder="VD: Uống nhiều nước, nghỉ ngơi, tái khám sau 7 ngày nếu không đỡ..."><?php echo (($tmp = $_smarty_tpl->getValue('exam')['prescription_note'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</textarea>
          </div>
        </div>
      </div>

      <div class="admin-card mb-1">
        <div class="admin-card__header">
          <h3><i class="fa-solid fa-flask"></i> Chỉ định xét nghiệm / Cận lâm sàng</h3>
          <button type="button" class="btn-admin-secondary" onclick="addLabRow()"><i class="fa-solid fa-plus"></i> Thêm</button>
        </div>
        <div class="admin-card__body">
          <div id="labRows" style="display: flex; flex-direction: column; gap: 10px;">
            <?php if ($_smarty_tpl->getValue('exam')['lab_orders']) {?>
              <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('exam')['lab_orders'], 'lab');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('lab')->value) {
$foreach2DoElse = false;
?>
              <div class="lab-row" style="display: flex; gap: 10px; align-items: center;">
                <input type="text" name="lab_name[]" value="<?php echo $_smarty_tpl->getValue('lab')['name'];?>
" placeholder="Tên xét nghiệm (X-Quang, Siêu âm, Máu...)" style="flex:1" class="form-control">
                <input type="text" name="lab_note[]" value="<?php echo $_smarty_tpl->getValue('lab')['note'];?>
" placeholder="Ghi chú vùng cần chụp/xét nghiệm..." style="flex:1" class="form-control">
                <button type="button" class="action-btn action-btn--danger" onclick="this.closest('.lab-row').remove()"><i class="fa-solid fa-trash"></i></button>
              </div>
              <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
              <p class="text-muted" style="font-size:13px" id="emptyLabMsg">Không có chỉ định xét nghiệm.</p>
            <?php }?>
          </div>
        </div>
      </div>

      <div class="admin-card">
        <div class="admin-card__body" style="display:flex;gap:1rem;justify-content:flex-end;flex-wrap:wrap; background-color: #f8fafc;">
          <button type="submit" name="exam_status" value="draft" class="btn-admin-secondary">
            <i class="fa-regular fa-floppy-disk"></i> Lưu nháp bệnh án
          </button>
          
          <button type="submit" name="exam_status" value="completed" class="btn-admin-primary" onclick="return confirm('Xác nhận hoàn tất phiên khám này?\nBệnh án sẽ được lưu và bệnh nhân sẽ chuyển sang trạng thái chờ thanh toán.');">
            <i class="fa-solid fa-check-double"></i> Hoàn tất khám — Chuyển thanh toán
          </button>
        </div>
      </div>

    </form>
  </div>
</div>

<?php } else { ?>
<div class="empty-state admin-card" style="padding:4rem; text-align: center;">
  <div style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1rem;"><i class="fa-solid fa-user-doctor"></i></div>
  <h3>Chưa chọn bệnh nhân</h3>
  <p class="text-muted">Vui lòng chọn bệnh nhân từ hàng chờ để bắt đầu phiên khám.</p>
  <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=doctor&page=queue" class="btn-admin-primary" style="margin-top:1.5rem; display: inline-block;"><i class="fa-solid fa-list-ol"></i> Xem danh sách hàng chờ</a>
</div>
<?php }?>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>

<?php echo '<script'; ?>
>
function addDrugRow() {
  const emptyRow = document.getElementById('emptyDrugRow');
  if (emptyRow) emptyRow.remove();
  
  const tbody = document.getElementById('drugRows');
  const tr = document.createElement('tr');
  tr.innerHTML = `
    <td><input type="text" name="drug_name[]" placeholder="Tên thuốc..." style="width:140px" class="drug-input" required></td>
    <td><input type="text" name="drug_concentration[]" placeholder="500mg..." style="width:80px"></td>
    <td><input type="number" name="drug_qty[]" placeholder="10" style="width:65px" min="1" required></td>
    <td>
      <select name="drug_unit[]" style="width:70px">
        <option value="vien">Viên</option>
        <option value="chai">Chai</option>
        <option value="ong">Ống</option>
        <option value="goi">Gói</option>
      </select>
    </td>
    <td><input type="text" name="drug_dosage[]" placeholder="VD: 2 viên/lần" style="width:110px"></td>
    <td><input type="number" name="drug_days[]" placeholder="7" style="width:60px" min="1"></td>
    <td><input type="text" name="drug_instruction[]" placeholder="VD: Sáng, Tối sau ăn" style="width:130px"></td>
    <td><button type="button" class="action-btn action-btn--danger" onclick="this.closest('tr').remove()"><i class="fa-solid fa-trash"></i></button></td>
  `;
  tbody.appendChild(tr);
}

function addLabRow() {
  const msg = document.getElementById('emptyLabMsg');
  if (msg) msg.remove();
  
  const container = document.getElementById('labRows');
  const div = document.createElement('div');
  div.className = 'lab-row';
  div.style.cssText = 'display: flex; gap: 10px; align-items: center; margin-bottom: 8px;';
  div.innerHTML = `
    <input type="text" name="lab_name[]" placeholder="Tên chỉ định (VD: Siêu âm ổ bụng)..." style="flex:1" class="form-control" required>
    <input type="text" name="lab_note[]" placeholder="Ghi chú lâm sàng..." style="flex:1" class="form-control">
    <button type="button" class="action-btn action-btn--danger" onclick="this.closest('.lab-row').remove()"><i class="fa-solid fa-trash"></i></button>
  `;
  container.appendChild(div);
}
<?php echo '</script'; ?>
>
<?php }
}

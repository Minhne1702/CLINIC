{include file="layout/sidebar.tpl" page_title="Khám bệnh" active_page="examination"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-notes-medical"></i> Khám bệnh</h2>
    {if $patient}<p class="page-subtitle">Bệnh nhân: <strong>{$patient.full_name}</strong> — #{$patient.patient_code}</p>{/if}
  </div>
  <div class="page-toolbar__right">
    <a href="{$BASE_URL}/?role=doctor&page=queue" class="btn-admin-ghost"><i class="fa-solid fa-arrow-left"></i> Hàng chờ</a>
  </div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}
{if $error_message}<div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>{/if}

{if $patient}
<div class="exam-layout">

  <!-- Patient info panel -->
  <div class="exam-patient-panel">
    <div class="admin-card">
      <div class="admin-card__header"><h3><i class="fa-solid fa-hospital-user"></i> Thông tin bệnh nhân</h3></div>
      <div class="admin-card__body">
        <div style="text-align:center;margin-bottom:1rem">
          <div class="table-avatar" style="width:60px;height:60px;font-size:22px;margin:0 auto .5rem">{$patient.full_name|truncate:1:""}</div>
          <strong style="font-size:15px">{$patient.full_name}</strong>
          <p class="text-muted" style="font-size:12px">#{$patient.patient_code}</p>
        </div>
        <div class="emr-section"><label>Ngày sinh</label><p>{$patient.birthday|date_format:"%d/%m/%Y"|default:'—'}</p></div>
        <div class="emr-section"><label>Giới tính</label><p>{if $patient.gender=='male'}Nam{elseif $patient.gender=='female'}Nữ{else}—{/if}</p></div>
        <div class="emr-section"><label>Nhóm máu</label><p>{$patient.blood_type|default:'—'}</p></div>
        <div class="emr-section"><label>Số BHYT</label><p>{$patient.bhyt_code|default:'Không có'}</p></div>
        {if $patient.drug_allergies}
        <div class="emr-section" style="background:#fef2f2;padding:.75rem;border-radius:8px;border-left:3px solid var(--admin-danger)">
          <label style="color:var(--admin-danger)"><i class="fa-solid fa-triangle-exclamation"></i> Dị ứng thuốc</label>
          <p style="color:#991b1b;font-weight:500">{$patient.drug_allergies}</p>
        </div>
        {/if}
        {if $patient.medical_history}
        <div class="emr-section"><label>Tiền sử bệnh</label><p style="font-size:13px">{$patient.medical_history}</p></div>
        {/if}
      </div>
    </div>

    <!-- Recent visits -->
    <div class="admin-card" style="margin-top:1rem">
      <div class="admin-card__header"><h3><i class="fa-solid fa-clock-rotate-left"></i> Lịch sử khám gần đây</h3></div>
      <div class="admin-card__body p-0">
        {foreach from=$recent_records item=rec}
        <div class="record-item">
          <div class="record-item__icon"><i class="fa-solid fa-notes-medical"></i></div>
          <div class="record-item__info">
            <strong style="font-size:13px">{$rec.diagnosis|default:'—'|truncate:30:'...'}</strong>
            <p>{$rec.date|date_format:"%d/%m/%Y"} · {$rec.doctor_name}</p>
          </div>
          <a href="{$BASE_URL}/?role=doctor&page=records&id={$rec._id}" class="action-btn" title="Xem"><i class="fa-solid fa-eye"></i></a>
        </div>
        {foreachelse}
        <div class="table-empty">Chưa có lịch sử</div>
        {/foreach}
      </div>
    </div>
  </div>

  <!-- Examination form -->
  <div class="exam-form-area">
    <form action="{$BASE_URL}/" method="POST" id="examForm">
      <input type="hidden" name="role" value="doctor">
      <input type="hidden" name="page" value="examination">
      <input type="hidden" name="action" value="save">
      <input type="hidden" name="patient_id" value="{$patient._id}">
      <input type="hidden" name="queue_id" value="{$queue_id|default:''}">

      <!-- Vital signs -->
      <div class="admin-card mb-1">
        <div class="admin-card__header"><h3><i class="fa-solid fa-heart-pulse"></i> Sinh hiệu</h3></div>
        <div class="admin-card__body">
          <div class="vitals-grid">
            <div class="form-group"><label>Huyết áp (mmHg)</label><input type="text" name="blood_pressure" placeholder="VD: 120/80" value="{$exam.blood_pressure|default:''}"></div>
            <div class="form-group"><label>Mạch (lần/phút)</label><input type="number" name="pulse" placeholder="VD: 72" value="{$exam.pulse|default:''}"></div>
            <div class="form-group"><label>Nhiệt độ (°C)</label><input type="number" name="temperature" step="0.1" placeholder="VD: 36.5" value="{$exam.temperature|default:''}"></div>
            <div class="form-group"><label>SpO2 (%)</label><input type="number" name="spo2" placeholder="VD: 98" value="{$exam.spo2|default:''}"></div>
            <div class="form-group"><label>Cân nặng (kg)</label><input type="number" name="weight" placeholder="" value="{$patient.weight|default:''}"></div>
            <div class="form-group"><label>Nhịp thở (lần/phút)</label><input type="number" name="respiration" placeholder="VD: 16" value="{$exam.respiration|default:''}"></div>
          </div>
        </div>
      </div>

      <!-- Symptoms & Diagnosis -->
      <div class="admin-card mb-1">
        <div class="admin-card__header"><h3><i class="fa-solid fa-virus"></i> Triệu chứng & Chẩn đoán</h3></div>
        <div class="admin-card__body">
          <div class="form-group">
            <label>Lý do khám / Triệu chứng chính <span class="required">*</span></label>
            <textarea name="symptoms" rows="3" required placeholder="Mô tả triệu chứng bệnh nhân...">{$exam.symptoms|default:$queue_symptoms|default:''}</textarea>
          </div>
          <div class="form-group">
            <label>Khám lâm sàng</label>
            <textarea name="clinical_exam" rows="3" placeholder="Kết quả thăm khám lâm sàng...">{$exam.clinical_exam|default:''}</textarea>
          </div>
          <div class="form-row-2">
            <div class="form-group">
              <label>Chẩn đoán sơ bộ</label>
              <input type="text" name="diagnosis_primary" placeholder="Nhập chẩn đoán..." value="{$exam.diagnosis_primary|default:''}" id="diagInput" autocomplete="off">
              <div id="diagSuggestions" class="autocomplete-box"></div>
            </div>
            <div class="form-group">
              <label>Mã ICD-10</label>
              <input type="text" name="icd_code" placeholder="VD: J06.9" value="{$exam.icd_code|default:''}" id="icdInput">
            </div>
          </div>
          <div class="form-group">
            <label>Chẩn đoán phân biệt</label>
            <input type="text" name="diagnosis_secondary" placeholder="Chẩn đoán phân biệt (nếu có)..." value="{$exam.diagnosis_secondary|default:''}">
          </div>
          <div class="form-group">
            <label>Ghi chú bác sĩ</label>
            <textarea name="doctor_note" rows="2" placeholder="Ghi chú thêm...">{$exam.doctor_note|default:''}</textarea>
          </div>
        </div>
      </div>

      <!-- Prescription -->
      <div class="admin-card mb-1">
        <div class="admin-card__header">
          <h3><i class="fa-solid fa-prescription"></i> Kê đơn thuốc</h3>
          <button type="button" class="btn-admin-secondary" onclick="addDrugRow()"><i class="fa-solid fa-plus"></i> Thêm thuốc</button>
        </div>
        <div class="admin-card__body">
          <table class="admin-table" id="drugTable">
            <thead><tr><th>Tên thuốc</th><th>Hàm lượng</th><th>Số lượng</th><th>Đơn vị</th><th>Liều dùng</th><th>Số ngày</th><th>Cách dùng</th><th></th></tr></thead>
            <tbody id="drugRows">
              {if $exam.prescription_drugs}
              {foreach from=$exam.prescription_drugs item=drug name=dloop}
              <tr>
                <td><input type="text" name="drug_name[]" value="{$drug.name}" placeholder="Tên thuốc" style="width:100%" class="drug-input"></td>
                <td><input type="text" name="drug_concentration[]" value="{$drug.concentration}" placeholder="500mg" style="width:80px"></td>
                <td><input type="number" name="drug_qty[]" value="{$drug.qty}" placeholder="10" style="width:65px" min="1"></td>
                <td><select name="drug_unit[]" style="width:70px"><option value="vien" {if $drug.unit=='vien'}selected{/if}>Viên</option><option value="chai" {if $drug.unit=='chai'}selected{/if}>Chai</option><option value="ong" {if $drug.unit=='ong'}selected{/if}>Ống</option><option value="goi" {if $drug.unit=='goi'}selected{/if}>Gói</option></select></td>
                <td><input type="text" name="drug_dosage[]" value="{$drug.dosage}" placeholder="2 viên/lần" style="width:110px"></td>
                <td><input type="number" name="drug_days[]" value="{$drug.days}" placeholder="7" style="width:60px" min="1"></td>
                <td><input type="text" name="drug_instruction[]" value="{$drug.instruction}" placeholder="Uống sau ăn" style="width:130px"></td>
                <td><button type="button" class="action-btn action-btn--danger" onclick="this.closest('tr').remove()"><i class="fa-solid fa-trash"></i></button></td>
              </tr>
              {/foreach}
              {else}
              <tr id="emptyDrugRow"><td colspan="8" class="table-empty">Chưa có thuốc. Nhấn "Thêm thuốc" để kê đơn.</td></tr>
              {/if}
            </tbody>
          </table>
          <div class="form-group" style="margin-top:1rem">
            <label>Lời dặn / Tái khám</label>
            <textarea name="prescription_note" rows="2" placeholder="VD: Uống nhiều nước, nghỉ ngơi, tái khám sau 7 ngày nếu không đỡ...">{$exam.prescription_note|default:''}</textarea>
          </div>
        </div>
      </div>

      <!-- Lab orders -->
      <div class="admin-card mb-1">
        <div class="admin-card__header">
          <h3><i class="fa-solid fa-flask"></i> Chỉ định xét nghiệm / Chẩn đoán hình ảnh</h3>
          <button type="button" class="btn-admin-secondary" onclick="addLabRow()"><i class="fa-solid fa-plus"></i> Thêm</button>
        </div>
        <div class="admin-card__body">
          <div id="labRows">
            {if $exam.lab_orders}
            {foreach from=$exam.lab_orders item=lab}
            <div class="lab-row">
              <input type="text" name="lab_name[]" value="{$lab.name}" placeholder="Tên xét nghiệm..." style="flex:1">
              <input type="text" name="lab_note[]" value="{$lab.note}" placeholder="Ghi chú..." style="flex:1">
              <button type="button" class="action-btn action-btn--danger" onclick="this.closest('.lab-row').remove()"><i class="fa-solid fa-trash"></i></button>
            </div>
            {/foreach}
            {else}
            <p class="text-muted" style="font-size:13px">Không có chỉ định xét nghiệm.</p>
            {/if}
          </div>
        </div>
      </div>

      <!-- Submit -->
      <div class="admin-card">
        <div class="admin-card__body" style="display:flex;gap:1rem;justify-content:flex-end;flex-wrap:wrap">
          <button type="submit" name="exam_status" value="draft" class="btn-admin-secondary">
            <i class="fa-regular fa-floppy-disk"></i> Lưu nháp
          </button>
          <button type="submit" name="exam_status" value="completed" class="btn-admin-primary">
            <i class="fa-solid fa-circle-check"></i> Hoàn tất khám — Chuyển thanh toán
          </button>
        </div>
      </div>

    </form>
  </div>

</div>

{else}
<div class="empty-state admin-card" style="padding:3rem">
  <i class="fa-solid fa-user-doctor"></i>
  <h3>Chưa chọn bệnh nhân</h3>
  <p>Vui lòng chọn bệnh nhân từ hàng chờ để bắt đầu khám.</p>
  <a href="{$BASE_URL}/?role=doctor&page=queue" class="btn-admin-primary" style="margin-top:1rem"><i class="fa-solid fa-list-ol"></i> Xem hàng chờ</a>
</div>
{/if}

{include file="layout/footer.tpl"}

<script>
function addDrugRow() {
  document.getElementById('emptyDrugRow')?.remove();
  const tbody = document.getElementById('drugRows');
  const tr = document.createElement('tr');
  tr.innerHTML = `
    <td><input type="text" name="drug_name[]" placeholder="Tên thuốc" style="width:100%" class="drug-input"></td>
    <td><input type="text" name="drug_concentration[]" placeholder="500mg" style="width:80px"></td>
    <td><input type="number" name="drug_qty[]" placeholder="10" style="width:65px" min="1"></td>
    <td><select name="drug_unit[]" style="width:70px"><option value="vien">Viên</option><option value="chai">Chai</option><option value="ong">Ống</option><option value="goi">Gói</option></select></td>
    <td><input type="text" name="drug_dosage[]" placeholder="2 viên/lần" style="width:110px"></td>
    <td><input type="number" name="drug_days[]" placeholder="7" style="width:60px" min="1"></td>
    <td><input type="text" name="drug_instruction[]" placeholder="Uống sau ăn" style="width:130px"></td>
    <td><button type="button" class="action-btn action-btn--danger" onclick="this.closest('tr').remove()"><i class="fa-solid fa-trash"></i></button></td>
  `;
  tbody.appendChild(tr);
}

function addLabRow() {
  const container = document.getElementById('labRows');
  const emptyP = container.querySelector('p');
  if (emptyP) emptyP.remove();
  const div = document.createElement('div');
  div.className = 'lab-row';
  div.innerHTML = `
    <input type="text" name="lab_name[]" placeholder="Tên xét nghiệm..." style="flex:1">
    <input type="text" name="lab_note[]" placeholder="Ghi chú..." style="flex:1">
    <button type="button" class="action-btn action-btn--danger" onclick="this.closest('.lab-row').remove()"><i class="fa-solid fa-trash"></i></button>
  `;
  container.appendChild(div);
}
</script>

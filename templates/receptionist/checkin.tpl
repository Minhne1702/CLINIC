{include file="layout/sidebar.tpl" page_title="Check-in bệnh nhân" active_page="checkin"}

<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-qrcode"></i> Check-in bệnh nhân</h2><p class="page-subtitle">Quét QR hoặc nhập mã đặt lịch / CCCD</p></div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}
{if $error_message}<div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>{/if}

<div class="checkin-layout">

  <!-- Search / Scan panel -->
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm bệnh nhân</h3></div>
    <div class="admin-card__body">
      <form method="GET" action="/CLINIC/public/" class="appt-form">
        <input type="hidden" name="role" value="receptionist">
        <input type="hidden" name="page" value="checkin">
        <div class="form-group">
          <label>Mã đặt lịch / CCCD / SĐT / Tên</label>
          <div class="input-icon-wrap">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" name="q" value="{$search_q|default:''}" placeholder="Nhập mã lịch hẹn, CCCD hoặc SĐT..." autofocus>
          </div>
        </div>
        <button type="submit" class="btn-admin-primary"><i class="fa-solid fa-search"></i> Tìm kiếm</button>
      </form>

      <div class="checkin-divider"><span>hoặc</span></div>

      <div class="qr-scan-area" id="qrArea">
        <i class="fa-solid fa-qrcode"></i>
        <p>Đưa mã QR vào camera để quét</p>
        <button class="btn-admin-secondary" onclick="startQR()" type="button"><i class="fa-solid fa-camera"></i> Bật camera quét QR</button>
        <div id="qrReader" style="display:none;margin-top:1rem"></div>
      </div>
    </div>
  </div>

  <!-- Result panel -->
  {if $found_patient}
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-hospital-user"></i> Thông tin bệnh nhân</h3></div>
    <div class="admin-card__body">
      <div class="checkin-patient-info">
        <div class="table-avatar" style="width:60px;height:60px;font-size:22px;margin-bottom:.75rem">{$found_patient.full_name|truncate:1:""}</div>
        <h3>{$found_patient.full_name}</h3>
        <p class="text-muted">#{$found_patient.patient_code}</p>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:.5rem 1.5rem;margin-top:1rem;text-align:left">
          <div class="emr-section"><label>Ngày sinh</label><p>{$found_patient.birthday|date_format:"%d/%m/%Y"|default:'—'}</p></div>
          <div class="emr-section"><label>Giới tính</label><p>{if $found_patient.gender=='male'}Nam{else}Nữ{/if}</p></div>
          <div class="emr-section"><label>CCCD</label><p>{$found_patient.cccd|default:'—'}</p></div>
          <div class="emr-section"><label>BHYT</label><p>{$found_patient.bhyt_code|default:'Không có'}</p></div>
        </div>
        {if $found_patient.drug_allergies}
        <div style="background:#fef2f2;border-left:3px solid var(--admin-danger);padding:.75rem;border-radius:8px;margin-top:.75rem">
          <strong style="font-size:12px;color:var(--admin-danger)"><i class="fa-solid fa-triangle-exclamation"></i> DỊ ỨNG THUỐC</strong>
          <p style="font-size:13px;color:#991b1b;font-weight:500;margin-top:.25rem">{$found_patient.drug_allergies}</p>
        </div>
        {/if}
      </div>

      {if $found_appointment}
      <div style="background:#f0f9ff;border:1px solid #bae6fd;border-radius:10px;padding:1rem;margin-top:1rem">
        <p style="font-size:12px;font-weight:600;color:#0c4a6e;margin-bottom:.5rem">LỊCH HẸN</p>
        <p><strong>{$found_appointment.doctor_name}</strong> — {$found_appointment.specialty}</p>
        <p>{$found_appointment.date|date_format:"%d/%m/%Y"} lúc {$found_appointment.time}</p>
      </div>
      {/if}

      <form action="/CLINIC/public/" method="POST" class="appt-form" style="margin-top:1.25rem">
        <input type="hidden" name="role" value="receptionist">
        <input type="hidden" name="page" value="checkin">
        <input type="hidden" name="action" value="checkin">
        <input type="hidden" name="patient_id" value="{$found_patient._id}">
        <input type="hidden" name="appointment_id" value="{$found_appointment._id|default:''}">
        <div class="form-row-2">
          <div class="form-group">
            <label>Phân loại</label>
            <select name="visit_type">
              <option value="normal">Khám thường</option>
              <option value="emergency">Cấp cứu</option>
            </select>
          </div>
          <div class="form-group">
            <label>Triệu chứng ban đầu</label>
            <input type="text" name="symptoms" placeholder="VD: Sốt, đau đầu...">
          </div>
        </div>
        <div class="form-group">
          <label>Bác sĩ phụ trách</label>
          <select name="doctor_id">
            <option value="">-- Chọn bác sĩ --</option>
            {foreach from=$doctors item=doc}
            <option value="{$doc._id}" {if $found_appointment.doctor_id==$doc._id}selected{/if}>{$doc.full_name} — {$doc.specialty}</option>
            {/foreach}
          </select>
        </div>
        <button type="submit" class="btn-admin-primary"><i class="fa-solid fa-circle-check"></i> Xác nhận Check-in & Cấp số thứ tự</button>
      </form>
    </div>
  </div>

  {elseif $search_q}
  <div class="admin-card">
    <div class="admin-card__body">
      <div class="empty-state" style="padding:2rem">
        <i class="fa-solid fa-user-xmark"></i>
        <h3>Không tìm thấy bệnh nhân</h3>
        <p>Không có kết quả cho "<strong>{$search_q}</strong>"</p>
        <a href="/CLINIC/public/?role=receptionist&page=patient-new" class="btn-admin-primary" style="margin-top:1rem"><i class="fa-solid fa-user-plus"></i> Tạo hồ sơ mới</a>
      </div>
    </div>
  </div>
  {/if}

</div>

{include file="layout/footer.tpl"}

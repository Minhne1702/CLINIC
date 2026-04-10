{include file="layout/sidebar.tpl" page_title="Check-in bệnh nhân" active_page="checkin"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-qrcode"></i> Check-in bệnh nhân (Đã có lịch hẹn)</h2>
    <p class="page-subtitle">Quét QR hoặc nhập mã đặt lịch để xác nhận đến khám</p>
  </div>
</div>

{if $success_message}
<div class="alert alert--success" style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; margin-bottom: 1.5rem; background-color: #d1fae5; border: 1px solid #34d399; border-radius: 8px;">
  <div>
    <i class="fa-solid fa-circle-check" style="color: #059669; font-size: 1.2rem;"></i> 
    <span style="color: #064e3b; margin-left: 0.5rem;">{$success_message}</span> 
    {if $queue_no} — Số thứ tự: <strong style="color: #dc2626; font-size: 1.5rem; margin-left: 0.5rem; background: #fff; padding: 0.2rem 0.8rem; border-radius: 4px; border: 1px solid #fca5a5;">{$queue_no}</strong>
    {/if}
  </div>
  <button onclick="window.print()" class="btn-admin-primary" style="background: #059669; border: none; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <i class="fa-solid fa-print"></i> In phiếu khám
  </button>
</div>
{/if}

{if $error_message}
<div class="alert alert--danger" style="margin-bottom: 1.5rem;">
  <i class="fa-solid fa-circle-exclamation"></i> {$error_message}
</div>
{/if}

<div class="checkin-layout" style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 1.5rem; align-items: start;">

  <div class="admin-card">
    <div class="admin-card__header" style="background: #f8fafc;">
      <h3><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm & Quét QR</h3>
    </div>
    <div class="admin-card__body">
      
      <div class="qr-scan-area" id="qrArea" style="text-align: center; padding: 2rem; border: 2px dashed #cbd5e1; border-radius: 8px; background: #f1f5f9; margin-bottom: 1.5rem;">
        <i class="fa-solid fa-qrcode" style="font-size: 3rem; color: #64748b; margin-bottom: 1rem;"></i>
        <h4 style="margin-bottom: 0.5rem; color: #334155;">Quét mã QR lịch hẹn</h4>
        <p style="color: #64748b; font-size: 0.9rem; margin-bottom: 1rem;">Đưa mã QR trên ứng dụng/email của bệnh nhân vào camera.</p>
        <button class="btn-admin-secondary" onclick="startQR()" type="button" style="width: 100%; justify-content: center; background: #fff; border-color: #94a3b8; color: #0f172a;">
          <i class="fa-solid fa-camera"></i> Bật camera quét QR
        </button>
        <div id="qrReader" style="display:none; margin-top:1rem;"></div>
      </div>

      <div class="checkin-divider" style="text-align: center; margin: 1rem 0; position: relative;">
        <span style="background: #fff; padding: 0 10px; color: #94a3b8; font-size: 0.9rem; position: relative; z-index: 1;">HOẶC NHẬP THỦ CÔNG</span>
        <div style="position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: #e2e8f0; z-index: 0;"></div>
      </div>

      <form method="GET" action="{$BASE_URL}/" class="appt-form">
        <input type="hidden" name="role" value="receptionist">
        <input type="hidden" name="page" value="checkin">
        <div class="form-group" style="margin-bottom: 1rem;">
          <label for="search_input" style="font-size: 0.9rem;">Nhập mã đặt lịch (Booking ID), CCCD hoặc SĐT</label>
          <div class="input-icon-wrap" style="margin-top: 0.5rem;">
            <i class="fa-solid fa-keyboard" style="color: #94a3b8;"></i>
            <input type="text" id="search_input" name="q" value="{$search_q|default:''}" placeholder="Ví dụ: BK-12345..." autofocus style="padding-left: 2.5rem; height: 45px; font-size: 1rem;">
          </div>
        </div>
        <button type="submit" class="btn-admin-primary" style="width: 100%; height: 45px; font-size: 1rem; justify-content: center;">
          <i class="fa-solid fa-search"></i> Kiểm tra lịch hẹn
        </button>
      </form>

    </div>
  </div>

  {if $found_patient}
  <div class="admin-card">
    <div class="admin-card__header" style="background: #eff6ff; border-bottom-color: #bfdbfe;">
      <h3 style="color: #1e3a8a;"><i class="fa-solid fa-hospital-user"></i> Xác nhận Check-in</h3>
      <a href="{$BASE_URL}/?role=receptionist&page=checkin" class="btn-link" style="font-size: 0.9rem; color: #64748b;">Hủy</a>
    </div>
    <div class="admin-card__body">
      <div class="checkin-patient-info" style="display: flex; gap: 1.5rem; align-items: flex-start; padding-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0;">
        <div class="table-avatar" style="width:70px; height:70px; font-size:28px; background: #e0f2fe; color: #0284c7; flex-shrink: 0;">{$found_patient.full_name|truncate:1:""}</div>
        <div style="flex-grow: 1;">
          <h3 style="font-size: 1.25rem; margin-bottom: 0.25rem;">{$found_patient.full_name}</h3>
          <p class="text-muted" style="font-size: 0.9rem;">Mã BN: #{$found_patient.patient_code}</p>
          
          <div style="display:grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; margin-top: 1rem; font-size: 0.95rem;">
            <div><span style="color: #64748b;">Ngày sinh:</span> <strong>{$found_patient.birthday|date_format:"%d/%m/%Y"|default:'—'}</strong></div>
            <div><span style="color: #64748b;">Giới tính:</span> <strong>{if $found_patient.gender=='male'}Nam{else}Nữ{/if}</strong></div>
            <div><span style="color: #64748b;">CCCD:</span> <strong>{$found_patient.cccd|default:'—'}</strong></div>
            <div><span style="color: #64748b;">BHYT:</span> <strong>{$found_patient.bhyt_code|default:'Không có'}</strong></div>
          </div>
        </div>
      </div>

      {if $found_patient.drug_allergies}
      <div style="background:#fef2f2; border-left:4px solid var(--admin-danger); padding:1rem; border-radius:0 8px 8px 0; margin-top: 1.5rem;">
        <strong style="font-size:13px; color:var(--admin-danger); display: flex; align-items: center; gap: 0.5rem;"><i class="fa-solid fa-triangle-exclamation"></i> LƯU Ý DỊ ỨNG THUỐC</strong>
        <p style="font-size:14px; color:#991b1b; font-weight:600; margin-top:0.5rem;">{$found_patient.drug_allergies}</p>
      </div>
      {/if}

      {if $found_appointment}
      <div style="background:#f8fafc; border:1px solid #cbd5e1; border-radius:8px; padding:1.25rem; margin-top: 1.5rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
          <span style="font-size:12px; font-weight:700; color:#475569; letter-spacing: 0.5px;">THÔNG TIN LỊCH HẸN</span>
          <span class="badge badge--success" style="font-size: 0.8rem;">Đã xác nhận</span>
        </div>
        <p style="font-size: 1.1rem; margin-bottom: 0.25rem;">Bác sĩ: <strong>{$found_appointment.doctor_name}</strong></p>
        <p style="color: #475569;">Chuyên khoa: {$found_appointment.specialty}</p>
        <p style="margin-top: 0.5rem; color: #0284c7; font-weight: 500;"><i class="fa-regular fa-clock"></i> {$found_appointment.date|date_format:"%d/%m/%Y"} lúc {$found_appointment.time}</p>
      </div>
      {else}
      <div class="alert alert--warning" style="margin-top: 1.5rem;">
        <i class="fa-solid fa-circle-info"></i> Bệnh nhân này hiện không có lịch hẹn trực tuyến nào cho hôm nay.
      </div>
      {/if}

      <form action="{$BASE_URL}/" method="POST" class="appt-form" style="margin-top: 2rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
        <input type="hidden" name="role" value="receptionist">
        <input type="hidden" name="page" value="checkin">
        <input type="hidden" name="action" value="checkin">
        <input type="hidden" name="patient_id" value="{$found_patient._id}">
        <input type="hidden" name="appointment_id" value="{$found_appointment._id|default:''}">
        
        <h4 style="margin-bottom: 1rem; color: #334155; font-size: 1.1rem;">Cập nhật tình trạng hiện tại</h4>
        <div class="form-row-2">
          <div class="form-group">
            <label>Phân loại ưu tiên <span class="required">*</span></label>
            <select name="priority" required style="font-weight: bold;">
              <option value="normal" selected>Khám thường</option>
              <option value="elderly">Người cao tuổi (>65 tuổi)</option>
              <option value="child">Trẻ em (<5 tuổi)</option>
              <option value="emergency" style="color: #ef4444; font-weight: bold;">🚨 CẤP CỨU (Chuyển lên đầu hàng chờ)</option>
            </select>
          </div>
          <div class="form-group">
            <label>Bác sĩ phụ trách <span class="required">*</span></label>
            <select name="doctor_id" required>
              <option value="">-- Chọn bác sĩ --</option>
              {foreach from=$doctors item=doc}
              <option value="{$doc._id}" {if $found_appointment.doctor_id==$doc._id}selected{/if}>{$doc.full_name} — {$doc.specialty}</option>
              {/foreach}
            </select>
          </div>
        </div>

        <div class="form-group">
          <label>Triệu chứng ban đầu (Cập nhật nếu có) <span class="required">*</span></label>
          <textarea name="symptoms" rows="2" placeholder="Ghi nhận tóm tắt tình trạng lúc đến (VD: Sốt, đau đầu...)" required style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px;"></textarea>
        </div>
        
        <div style="display: flex; justify-content: flex-end; margin-top: 1.5rem;">
          <button type="submit" class="btn-admin-primary" style="padding: 0.75rem 2rem; font-size: 1.1rem; background: #0284c7; border: none;">
            <i class="fa-solid fa-right-to-bracket"></i> Xác nhận Check-in & In Phiếu
          </button>
        </div>
      </form>
    </div>
  </div>

  {elseif $search_q}
  <div class="admin-card">
    <div class="admin-card__body">
      <div class="empty-state" style="padding:3rem 2rem; text-align: center;">
        <i class="fa-solid fa-user-xmark" style="font-size: 3rem; color: #94a3b8; margin-bottom: 1rem;"></i>
        <h3 style="color: #334155; margin-bottom: 0.5rem;">Không tìm thấy lịch hẹn hoặc bệnh nhân</h3>
        <p style="color: #64748b;">Hệ thống không tìm thấy kết quả nào khớp với "<strong>{$search_q}</strong>".</p>
        <p style="color: #64748b; font-size: 0.9rem; margin-top: 0.5rem;">Vui lòng kiểm tra lại mã hoặc đăng ký bệnh nhân mới.</p>
        
        <div style="margin-top: 2rem; display: flex; gap: 1rem; justify-content: center;">
          <a href="{$BASE_URL}/?role=receptionist&page=checkin" class="btn-admin-secondary"><i class="fa-solid fa-rotate-left"></i> Thử lại</a>
          <a href="{$BASE_URL}/?role=receptionist&page=walk-in" class="btn-admin-primary"><i class="fa-solid fa-person-walking-arrow-right"></i> Chuyển sang Đăng ký tại chỗ (Walk-in)</a>
        </div>
      </div>
    </div>
  </div>
  {/if}

</div>

{include file="layout/footer.tpl"}
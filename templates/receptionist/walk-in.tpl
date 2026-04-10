{include file="layout/sidebar.tpl" page_title="Đăng ký khám tại chỗ" active_page="walk-in"}
<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-person-walking-arrow-right"></i> Đăng ký khám tại chỗ</h2>
    <p class="page-subtitle">Tiếp nhận bệnh nhân Walk-in — Tự động điền thông tin nếu đã có hồ sơ</p>
  </div>
</div>

{if $success_message}
<div class="alert alert--success" style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; margin-bottom: 1.5rem; background-color: #d1fae5; border: 1px solid #34d399; border-radius: 8px;">
  <div>
    <i class="fa-solid fa-circle-check" style="color: #059669; font-size: 1.2rem;"></i> 
    <span style="color: #064e3b; margin-left: 0.5rem;">{$success_message} — Số thứ tự khám:</span> 
    <strong style="color: #dc2626; font-size: 1.5rem; margin-left: 0.5rem; background: #fff; padding: 0.2rem 0.8rem; border-radius: 4px; border: 1px solid #fca5a5;">{$queue_no}</strong>
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

<div class="checkin-layout">
  <div class="admin-card" style="margin-bottom: 1.5rem;">
    <div class="admin-card__header" style="background: #f8fafc;">
      <h3><i class="fa-solid fa-magnifying-glass" style="color: #3b82f6;"></i> Tìm hồ sơ cũ (Auto-fill)</h3>
    </div>
    <div class="admin-card__body">
      <form method="GET" action="{$BASE_URL}/" class="appt-form" style="display: flex; gap: 1rem; align-items: flex-end;">
        <input type="hidden" name="role" value="receptionist">
        <input type="hidden" name="page" value="walk-in">
        <div class="form-group" style="flex: 1; margin-bottom: 0;">
          <label for="search_q">Nhập CCCD, SĐT hoặc Tên bệnh nhân để tải dữ liệu</label>
          <div class="input-icon-wrap" style="margin-top: 0.5rem;">
            <i class="fa-solid fa-id-card"></i>
            <input type="text" id="search_q" name="q" value="{$search_q|default:''}" placeholder="Nhập từ khóa và nhấn Tìm..." style="padding-left: 2.5rem;">
          </div>
        </div>
        <button type="submit" class="btn-admin-secondary" style="height: 42px;">
          <i class="fa-solid fa-search"></i> Kiểm tra
        </button>
        {if $found_patient}
          <a href="{$BASE_URL}/?role=receptionist&page=walk-in" class="btn-admin-secondary" style="height: 42px; background: #f1f5f9; color: #64748b; border-color: #cbd5e1;">Hủy</a>
        {/if}
      </form>
      {if $found_patient}
        <div style="margin-top: 1rem; padding: 0.75rem; background: #eff6ff; border-left: 4px solid #3b82f6; color: #1e3a8a; font-size: 0.9rem;">
          <i class="fa-solid fa-check-circle"></i> Đã tải hồ sơ bệnh nhân: <strong>{$found_patient.full_name}</strong>
        </div>
      {/if}
    </div>
  </div>

  <div class="admin-card">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-file-medical"></i> {if $found_patient}Xác nhận đăng ký khám{else}Tạo hồ sơ mới & Đăng ký khám{/if}</h3>
    </div>
    <div class="admin-card__body">
      <form action="{$BASE_URL}/" method="POST" class="appt-form">
        <input type="hidden" name="role" value="receptionist">
        <input type="hidden" name="page" value="walk-in">
        <input type="hidden" name="action" value="register">
        <input type="hidden" name="patient_id" value="{$found_patient._id|default:''}">
        
        <div class="form-row-2">
          <div class="form-group">
            <label>Họ và tên <span class="required">*</span></label>
            <input type="text" name="full_name" value="{$found_patient.full_name|default:''}" required {if $found_patient}readonly style="background:#f1f5f9;"{/if}>
          </div>
          <div class="form-group">
            <label>Số điện thoại <span class="required">*</span></label>
            <input type="tel" name="phone" value="{$found_patient.phone|default:''}" required {if $found_patient}readonly style="background:#f1f5f9;"{/if}>
          </div>
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label>Số CCCD / Passport</label>
            <input type="text" name="cccd" value="{$found_patient.cccd|default:''}" {if $found_patient && $found_patient.cccd}readonly style="background:#f1f5f9;"{/if}>
          </div>
          <div class="form-group">
            <label>Ngày sinh</label>
            <input type="date" name="birthday" value="{$found_patient.birthday|default:''}" {if $found_patient && $found_patient.birthday}readonly style="background:#f1f5f9;"{/if}>
          </div>
        </div>

        <div class="form-group">
        <label>Giới tính</label>
        <select name="gender" {if $found_patient}style="pointer-events: none; background:#f1f5f9;"{/if}>
          <option value="male" {if $found_patient && $found_patient.gender=='male'}selected{/if}>Nam</option>
          <option value="female" {if $found_patient && $found_patient.gender=='female'}selected{/if}>Nữ</option>
        </select>
      </div>
          
          <div class="form-group">
            <label>Phân loại ưu tiên <span class="required">*</span></label>
            <select name="priority" required style="font-weight: bold;">
              <option value="normal">Khám thường</option>
              <option value="elderly">Người cao tuổi (>65 tuổi)</option>
              <option value="child">Trẻ em (<5 tuổi)</option>
              <option value="emergency" style="color: #ef4444; font-weight: bold;">🚨 CẤP CỨU (Ưu tiên số 1)</option>
            </select>
          </div>
        </div>

        <div class="form-row-2">
          <div class="form-group">
            <label>Chuyên khoa / Bác sĩ <span class="required">*</span></label>
            <select name="doctor_id" required>
              <option value="">-- Chọn bác sĩ chỉ định --</option>
              {foreach from=$doctors item=doc}
                <option value="{$doc._id}">{$doc.full_name} — {$doc.specialty}</option>
              {/foreach}
            </select>
          </div>
        </div>

        <div class="form-group">
          <label>Triệu chứng ban đầu <span class="required">*</span></label>
          <textarea name="symptoms" rows="3" placeholder="Ghi nhận tóm tắt tình trạng, triệu chứng người bệnh khai báo (VD: Sốt cao 39 độ, đau quặn bụng...)" required style="width: 100%; padding: 0.75rem; border: 1px solid #ccc; border-radius: 4px; resize: vertical;"></textarea>
        </div>

        <div style="border-top: 1px solid #e2e8f0; padding-top: 1.5rem; margin-top: 1rem; display: flex; justify-content: flex-end;">
          <button type="submit" class="btn-admin-primary" style="padding: 0.75rem 2rem; font-size: 1.1rem;">
            <i class="fa-solid fa-clipboard-check"></i> Đăng ký & Cấp số thứ tự
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{include file="layout/footer.tpl"}
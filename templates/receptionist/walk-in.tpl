{include file="layout/sidebar.tpl" page_title="Đăng ký khám tại chỗ" active_page="walk-in"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-person-walking-arrow-right"></i> Đăng ký khám tại chỗ</h2><p class="page-subtitle">Walk-in — không cần đặt lịch trước</p></div>
</div>
{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message} — Số thứ tự: <strong>{$queue_no}</strong></div>{/if}
{if $error_message}<div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>{/if}

<div class="checkin-layout">
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-magnifying-glass"></i> Tìm bệnh nhân hiện có</h3></div>
    <div class="admin-card__body">
      <form method="GET" action="{$base_url}/" class="appt-form">
        <input type="hidden" name="role" value="receptionist"><input type="hidden" name="page" value="walk-in">
        <div class="form-group">
          <div class="input-icon-wrap"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="q" value="{$search_q|default:''}" placeholder="CCCD, SĐT hoặc tên bệnh nhân..."></div>
        </div>
        <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-search"></i> Tìm</button>
      </form>
    </div>
  </div>

  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-user-plus"></i> {if $found_patient}Xác nhận đăng ký{else}Tạo hồ sơ & Đăng ký{/if}</h3></div>
    <div class="admin-card__body">
      <form action="{$base_url}/" method="POST" class="appt-form">
        <input type="hidden" name="role" value="receptionist"><input type="hidden" name="page" value="walk-in"><input type="hidden" name="action" value="register">
        <input type="hidden" name="patient_id" value="{$found_patient._id|default:''}">
        <div class="form-row-2">
          <div class="form-group"><label>Họ và tên <span class="required">*</span></label><input type="text" name="full_name" value="{$found_patient.full_name|default:''}" required></div>
          <div class="form-group"><label>Số điện thoại <span class="required">*</span></label><input type="tel" name="phone" value="{$found_patient.phone|default:''}" required></div>
        </div>
        <div class="form-row-2">
          <div class="form-group"><label>CCCD</label><input type="text" name="cccd" value="{$found_patient.cccd|default:''}"></div>
          <div class="form-group"><label>Ngày sinh</label><input type="date" name="birthday" value="{$found_patient.birthday|default:''}"></div>
        </div>
        <div class="form-row-2">
          <div class="form-group"><label>Giới tính</label>
            <select name="gender"><option value="male" {if $found_patient.gender=='male'}selected{/if}>Nam</option><option value="female" {if $found_patient.gender=='female'}selected{/if}>Nữ</option></select>
          </div>
          <div class="form-group"><label>Phân loại</label>
            <select name="priority"><option value="normal">Khám thường</option><option value="elderly">Người cao tuổi</option><option value="child">Trẻ em</option><option value="emergency">Cấp cứu</option></select>
          </div>
        </div>
        <div class="form-group"><label>Chuyên khoa / Bác sĩ <span class="required">*</span></label>
          <select name="doctor_id" required><option value="">-- Chọn bác sĩ --</option>{foreach from=$doctors item=doc}<option value="{$doc._id}">{$doc.full_name} — {$doc.specialty}</option>{/foreach}</select>
        </div>
        <div class="form-group"><label>Triệu chứng ban đầu</label><input type="text" name="symptoms" placeholder="VD: Sốt, đau bụng, mệt mỏi..."></div>
        <button type="submit" class="btn-admin-primary"><i class="fa-solid fa-circle-check"></i> Đăng ký & Cấp số thứ tự</button>
      </form>
    </div>
  </div>
</div>
{include file="layout/footer.tpl"}

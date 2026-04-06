{include file="layout/sidebar.tpl" page_title="Cài đặt hệ thống" active_page="settings"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-gear"></i> Cài đặt hệ thống</h2>
    <p class="page-subtitle">Cấu hình hoạt động của phòng khám</p>
  </div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}

<div class="settings-layout">

  <!-- Tabs -->
  <div class="settings-tabs">
    <button class="settings-tab active" onclick="switchTab('general', this)"><i class="fa-solid fa-hospital"></i> Thông tin PK</button>
    <button class="settings-tab" onclick="switchTab('schedule', this)"><i class="fa-regular fa-clock"></i> Giờ làm việc</button>
    <button class="settings-tab" onclick="switchTab('appointment', this)"><i class="fa-solid fa-calendar-check"></i> Đặt lịch</button>
    <button class="settings-tab" onclick="switchTab('notification', this)"><i class="fa-solid fa-bell"></i> Thông báo</button>
    <button class="settings-tab" onclick="switchTab('security', this)"><i class="fa-solid fa-shield-halved"></i> Bảo mật</button>
  </div>

  <!-- Tab contents -->
  <div class="settings-content">

    <!-- General -->
    <div class="settings-pane active" id="tab-general">
      <form action="/CLINIC/public/" method="POST" class="appt-form">
        <input type="hidden" name="role" value="admin">
        <input type="hidden" name="page" value="settings">
        <input type="hidden" name="tab" value="general">
        <div class="admin-card">
          <div class="admin-card__header"><h3>Thông tin phòng khám</h3></div>
          <div class="admin-card__body">
            <div class="form-row-2">
              <div class="form-group">
                <label>Tên phòng khám <span class="required">*</span></label>
                <input type="text" name="clinic_name" value="{$settings.clinic_name|default:'MediCare'}" required>
              </div>
              <div class="form-group">
                <label>Hotline <span class="required">*</span></label>
                <input type="text" name="hotline" value="{$settings.hotline|default:''}">
              </div>
            </div>
            <div class="form-group">
              <label>Địa chỉ</label>
              <input type="text" name="address" value="{$settings.address|default:''}">
            </div>
            <div class="form-row-2">
              <div class="form-group">
                <label>Email liên hệ</label>
                <input type="email" name="email" value="{$settings.email|default:''}">
              </div>
              <div class="form-group">
                <label>Website</label>
                <input type="url" name="website" value="{$settings.website|default:''}">
              </div>
            </div>
            <div class="form-group">
              <label>Giới thiệu ngắn</label>
              <textarea name="description" rows="3">{$settings.description|default:''}</textarea>
            </div>
            <button type="submit" class="btn-admin-primary" style="margin-top:.5rem"><i class="fa-solid fa-floppy-disk"></i> Lưu cài đặt</button>
          </div>
        </div>
      </form>
    </div>

    <!-- Schedule -->
    <div class="settings-pane" id="tab-schedule">
      <form action="/CLINIC/public/" method="POST" class="appt-form">
        <input type="hidden" name="role" value="admin">
        <input type="hidden" name="page" value="settings">
        <input type="hidden" name="tab" value="schedule">
        <div class="admin-card">
          <div class="admin-card__header"><h3>Giờ làm việc</h3></div>
          <div class="admin-card__body">
            {foreach from=['monday','tuesday','wednesday','thursday','friday','saturday','sunday'] item=day}
            {assign var="day_label" value=['monday'=>'Thứ 2','tuesday'=>'Thứ 3','wednesday'=>'Thứ 4','thursday'=>'Thứ 5','friday'=>'Thứ 6','saturday'=>'Thứ 7','sunday'=>'Chủ nhật']}
            <div class="schedule-row">
              <label class="checkbox-label" style="min-width:100px">
                <input type="checkbox" name="open_{$day}" {if $settings["open_{$day}"]|default:true}checked{/if}> {$day_label[$day]}
              </label>
              <input type="time" name="open_from_{$day}" value="{$settings["open_from_{$day}"]|default:'07:30'}">
              <span style="color:var(--admin-text-secondary)">—</span>
              <input type="time" name="open_to_{$day}" value="{$settings["open_to_{$day}"]|default:'17:00'}">
            </div>
            {/foreach}
            <button type="submit" class="btn-admin-primary" style="margin-top:1rem"><i class="fa-solid fa-floppy-disk"></i> Lưu giờ làm việc</button>
          </div>
        </div>
      </form>
    </div>

    <!-- Appointment -->
    <div class="settings-pane" id="tab-appointment">
      <form action="/CLINIC/public/" method="POST" class="appt-form">
        <input type="hidden" name="role" value="admin">
        <input type="hidden" name="page" value="settings">
        <input type="hidden" name="tab" value="appointment">
        <div class="admin-card">
          <div class="admin-card__header"><h3>Cấu hình đặt lịch</h3></div>
          <div class="admin-card__body">
            <div class="form-row-2">
              <div class="form-group">
                <label>Thời lượng khám mặc định (phút)</label>
                <input type="number" name="default_duration" value="{$settings.default_duration|default:30}" min="10" max="120">
              </div>
              <div class="form-group">
                <label>Số BN tối đa / bác sĩ / ngày</label>
                <input type="number" name="max_patients_per_day" value="{$settings.max_patients_per_day|default:30}" min="1">
              </div>
            </div>
            <div class="form-row-2">
              <div class="form-group">
                <label>Cho phép đặt trước (ngày)</label>
                <input type="number" name="advance_booking_days" value="{$settings.advance_booking_days|default:30}" min="1">
              </div>
              <div class="form-group">
                <label>Hủy lịch trước tối thiểu (giờ)</label>
                <input type="number" name="cancel_before_hours" value="{$settings.cancel_before_hours|default:2}" min="1">
              </div>
            </div>
            <div class="form-group">
              <label class="checkbox-label">
                <input type="checkbox" name="auto_confirm" {if $settings.auto_confirm}checked{/if}> Tự động xác nhận lịch hẹn
              </label>
            </div>
            <button type="submit" class="btn-admin-primary" style="margin-top:.5rem"><i class="fa-solid fa-floppy-disk"></i> Lưu cài đặt</button>
          </div>
        </div>
      </form>
    </div>

    <!-- Notification -->
    <div class="settings-pane" id="tab-notification">
      <form action="/CLINIC/public/" method="POST" class="appt-form">
        <input type="hidden" name="role" value="admin">
        <input type="hidden" name="page" value="settings">
        <input type="hidden" name="tab" value="notification">
        <div class="admin-card">
          <div class="admin-card__header"><h3>Cấu hình thông báo</h3></div>
          <div class="admin-card__body">
            <div class="form-group">
              <label class="checkbox-label"><input type="checkbox" name="notify_sms" {if $settings.notify_sms}checked{/if}> Gửi SMS xác nhận lịch hẹn</label>
            </div>
            <div class="form-group">
              <label class="checkbox-label"><input type="checkbox" name="notify_email" {if $settings.notify_email}checked{/if}> Gửi Email xác nhận lịch hẹn</label>
            </div>
            <div class="form-group">
              <label class="checkbox-label"><input type="checkbox" name="reminder_1h" {if $settings.reminder_1h}checked{/if}> Nhắc lịch trước 1 giờ</label>
            </div>
            <div class="form-group">
              <label class="checkbox-label"><input type="checkbox" name="reminder_24h" {if $settings.reminder_24h}checked{/if}> Nhắc lịch trước 24 giờ</label>
            </div>
            <div class="form-group">
              <label>SMS API Key</label>
              <input type="text" name="sms_api_key" value="{$settings.sms_api_key|default:''}" placeholder="Nhập API key SMS gateway">
            </div>
            <button type="submit" class="btn-admin-primary" style="margin-top:.5rem"><i class="fa-solid fa-floppy-disk"></i> Lưu cài đặt</button>
          </div>
        </div>
      </form>
    </div>

    <!-- Security -->
    <div class="settings-pane" id="tab-security">
      <div class="admin-card">
        <div class="admin-card__header"><h3>Cài đặt bảo mật</h3></div>
        <div class="admin-card__body">
          <form action="/CLINIC/public/" method="POST" class="appt-form">
            <input type="hidden" name="role" value="admin">
            <input type="hidden" name="page" value="settings">
            <input type="hidden" name="tab" value="security">
            <div class="form-group">
              <label class="checkbox-label"><input type="checkbox" name="mfa_admin" {if $settings.mfa_admin}checked{/if}> Bật MFA cho Admin</label>
            </div>
            <div class="form-group">
              <label class="checkbox-label"><input type="checkbox" name="mfa_doctor" {if $settings.mfa_doctor}checked{/if}> Bật MFA cho Bác sĩ</label>
            </div>
            <div class="form-group">
              <label>Thời gian hết phiên (phút)</label>
              <input type="number" name="session_timeout" value="{$settings.session_timeout|default:60}" min="10">
            </div>
            <div class="form-group">
              <label>Số lần đăng nhập sai tối đa</label>
              <input type="number" name="max_login_attempts" value="{$settings.max_login_attempts|default:5}" min="3">
            </div>
            <button type="submit" class="btn-admin-primary" style="margin-top:.5rem"><i class="fa-solid fa-floppy-disk"></i> Lưu cài đặt</button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

{include file="layout/footer.tpl"}
<script>
function switchTab(name, btn) {
  document.querySelectorAll('.settings-tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.settings-pane').forEach(p => p.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('tab-' + name).classList.add('active');
}
</script>

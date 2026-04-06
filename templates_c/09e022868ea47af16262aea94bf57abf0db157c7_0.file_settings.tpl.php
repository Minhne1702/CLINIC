<?php
/* Smarty version 5.8.0, created on 2026-04-06 05:47:27
  from 'file:admin/settings.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d32ccfe49296_26648664',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '09e022868ea47af16262aea94bf57abf0db157c7' => 
    array (
      0 => 'admin/settings.tpl',
      1 => 1775447243,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d32ccfe49296_26648664 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\CLINIC\\templates\\admin';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Cài đặt hệ thống",'active_page'=>"settings"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-gear"></i> Cài đặt hệ thống</h2>
    <p class="page-subtitle">Cấu hình hoạt động của phòng khám</p>
  </div>
</div>

<?php if ($_smarty_tpl->getValue('success_message')) {?><div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div><?php }?>

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
                <input type="text" name="clinic_name" value="<?php echo (($tmp = $_smarty_tpl->getValue('settings')['clinic_name'] ?? null)===null||$tmp==='' ? 'MediCare' ?? null : $tmp);?>
" required>
              </div>
              <div class="form-group">
                <label>Hotline <span class="required">*</span></label>
                <input type="text" name="hotline" value="<?php echo (($tmp = $_smarty_tpl->getValue('settings')['hotline'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
              </div>
            </div>
            <div class="form-group">
              <label>Địa chỉ</label>
              <input type="text" name="address" value="<?php echo (($tmp = $_smarty_tpl->getValue('settings')['address'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
            </div>
            <div class="form-row-2">
              <div class="form-group">
                <label>Email liên hệ</label>
                <input type="email" name="email" value="<?php echo (($tmp = $_smarty_tpl->getValue('settings')['email'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
              </div>
              <div class="form-group">
                <label>Website</label>
                <input type="url" name="website" value="<?php echo (($tmp = $_smarty_tpl->getValue('settings')['website'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
              </div>
            </div>
            <div class="form-group">
              <label>Giới thiệu ngắn</label>
              <textarea name="description" rows="3"><?php echo (($tmp = $_smarty_tpl->getValue('settings')['description'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
</textarea>
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
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, array('monday','tuesday','wednesday','thursday','friday','saturday','sunday'), 'day');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('day')->value) {
$foreach0DoElse = false;
?>
            <?php $_smarty_tpl->assign('day_label', array('monday'=>'Thứ 2','tuesday'=>'Thứ 3','wednesday'=>'Thứ 4','thursday'=>'Thứ 5','friday'=>'Thứ 6','saturday'=>'Thứ 7','sunday'=>'Chủ nhật'), false, NULL);?>
            <div class="schedule-row">
              <label class="checkbox-label" style="min-width:100px">
                <input type="checkbox" name="open_<?php echo $_smarty_tpl->getValue('day');?>
" <?php if ((($tmp = $_smarty_tpl->getValue('settings')["open_".((string)$_smarty_tpl->getValue('day'))] ?? null)===null||$tmp==='' ? true ?? null : $tmp)) {?>checked<?php }?>> <?php echo $_smarty_tpl->getValue('day_label')[$_smarty_tpl->getValue('day')];?>

              </label>
              <input type="time" name="open_from_<?php echo $_smarty_tpl->getValue('day');?>
" value="<?php echo (($tmp = $_smarty_tpl->getValue('settings')["open_from_".((string)$_smarty_tpl->getValue('day'))] ?? null)===null||$tmp==='' ? '07:30' ?? null : $tmp);?>
">
              <span style="color:var(--admin-text-secondary)">—</span>
              <input type="time" name="open_to_<?php echo $_smarty_tpl->getValue('day');?>
" value="<?php echo (($tmp = $_smarty_tpl->getValue('settings')["open_to_".((string)$_smarty_tpl->getValue('day'))] ?? null)===null||$tmp==='' ? '17:00' ?? null : $tmp);?>
">
            </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
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
                <input type="number" name="default_duration" value="<?php echo (($tmp = $_smarty_tpl->getValue('settings')['default_duration'] ?? null)===null||$tmp==='' ? 30 ?? null : $tmp);?>
" min="10" max="120">
              </div>
              <div class="form-group">
                <label>Số BN tối đa / bác sĩ / ngày</label>
                <input type="number" name="max_patients_per_day" value="<?php echo (($tmp = $_smarty_tpl->getValue('settings')['max_patients_per_day'] ?? null)===null||$tmp==='' ? 30 ?? null : $tmp);?>
" min="1">
              </div>
            </div>
            <div class="form-row-2">
              <div class="form-group">
                <label>Cho phép đặt trước (ngày)</label>
                <input type="number" name="advance_booking_days" value="<?php echo (($tmp = $_smarty_tpl->getValue('settings')['advance_booking_days'] ?? null)===null||$tmp==='' ? 30 ?? null : $tmp);?>
" min="1">
              </div>
              <div class="form-group">
                <label>Hủy lịch trước tối thiểu (giờ)</label>
                <input type="number" name="cancel_before_hours" value="<?php echo (($tmp = $_smarty_tpl->getValue('settings')['cancel_before_hours'] ?? null)===null||$tmp==='' ? 2 ?? null : $tmp);?>
" min="1">
              </div>
            </div>
            <div class="form-group">
              <label class="checkbox-label">
                <input type="checkbox" name="auto_confirm" <?php if ((($tmp = $_smarty_tpl->getValue('settings')['auto_confirm'] ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>checked<?php }?>> Tự động xác nhận lịch hẹn
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
              <label class="checkbox-label"><input type="checkbox" name="notify_sms" <?php if ((($tmp = $_smarty_tpl->getValue('settings')['notify_sms'] ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>checked<?php }?>> Gửi SMS xác nhận lịch hẹn</label>
            </div>
            <div class="form-group">
              <label class="checkbox-label"><input type="checkbox" name="notify_email" <?php if ((($tmp = $_smarty_tpl->getValue('settings')['notify_email'] ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>checked<?php }?>> Gửi Email xác nhận lịch hẹn</label>
            </div>
            <div class="form-group">
              <label class="checkbox-label"><input type="checkbox" name="reminder_1h" <?php if ((($tmp = $_smarty_tpl->getValue('settings')['reminder_1h'] ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>checked<?php }?>> Nhắc lịch trước 1 giờ</label>
            </div>
            <div class="form-group">
              <label class="checkbox-label"><input type="checkbox" name="reminder_24h" <?php if ((($tmp = $_smarty_tpl->getValue('settings')['reminder_24h'] ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>checked<?php }?>> Nhắc lịch trước 24 giờ</label>
            </div>
            <div class="form-group">
              <label>SMS API Key</label>
              <input type="text" name="sms_api_key" value="<?php echo (($tmp = $_smarty_tpl->getValue('settings')['sms_api_key'] ?? null)===null||$tmp==='' ? false ?? null : $tmp);?>
" placeholder="Nhập API key SMS gateway">
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
              <label class="checkbox-label"><input type="checkbox" name="mfa_admin" <?php if ((($tmp = $_smarty_tpl->getValue('settings')['mfa_admin'] ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>checked<?php }?>> Bật MFA cho Admin</label>
            </div>
            <div class="form-group">
              <label class="checkbox-label"><input type="checkbox" name="mfa_doctor" <?php if ((($tmp = $_smarty_tpl->getValue('settings')['mfa_doctor'] ?? null)===null||$tmp==='' ? false ?? null : $tmp)) {?>checked<?php }?>> Bật MFA cho Bác sĩ</label>
            </div>
            <div class="form-group">
              <label>Thời gian hết phiên (phút)</label>
              <input type="number" name="session_timeout" value="<?php echo (($tmp = $_smarty_tpl->getValue('settings')['session_timeout'] ?? null)===null||$tmp==='' ? false ?? null : $tmp);?>
" min="10">
            </div>
            <div class="form-group">
              <label>Số lần đăng nhập sai tối đa</label>
              <input type="number" name="max_login_attempts" value="<?php echo (($tmp = $_smarty_tpl->getValue('settings')['max_login_attempts'] ?? null)===null||$tmp==='' ? false ?? null : $tmp);?>
" min="3">
            </div>
            <button type="submit" class="btn-admin-primary" style="margin-top:.5rem"><i class="fa-solid fa-floppy-disk"></i> Lưu cài đặt</button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
echo '<script'; ?>
>
function switchTab(name, btn) {
  document.querySelectorAll('.settings-tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.settings-pane').forEach(p => p.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('tab-' + name).classList.add('active');
}
<?php echo '</script'; ?>
>
<?php }
}

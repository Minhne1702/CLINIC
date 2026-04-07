{include file="layout/header.tpl" page_title="Hồ sơ cá nhân" active_page="profile"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-id-card"></i> Hồ sơ cá nhân</h2>
    <p class="page-subtitle">Quản lý thông tin cá nhân và sức khỏe của bạn</p>
  </div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}
{if $error_message}<div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>{/if}

<div class="profile-layout">

  <!-- Sidebar card -->
  <div class="profile-sidebar-card">
    <div class="profile-avatar-wrap">
      <div class="profile-avatar" id="avatarPreview">
        {if $patient.avatar}
          <img src="{$patient.avatar}" alt="">
        {else}
          <span>{$current_user_name|default:'?'|truncate:1:''}</span>
        {/if}
      </div>
      <label class="profile-avatar-edit" title="Đổi ảnh đại diện">
        <i class="fa-solid fa-camera"></i>
        <input type="file" accept="image/*" style="display:none" onchange="previewAvatar(this)">
      </label>
    </div>
    <h3>{$current_user_name|default:'Bệnh nhân'}</h3>
    <p class="text-muted" style="font-size:13px">Mã BN: #{$patient.patient_code|default:'—'}</p>

    <div class="profile-quick-info">
      <div class="profile-quick-row">
        <i class="fa-solid fa-phone"></i>
        <span>{$patient.phone|default:'Chưa cập nhật'}</span>
      </div>
      <div class="profile-quick-row">
        <i class="fa-regular fa-envelope"></i>
        <span>{$patient.email|default:'Chưa cập nhật'}</span>
      </div>
      <div class="profile-quick-row">
        <i class="fa-solid fa-location-dot"></i>
        <span>{$patient.address|default:'Chưa cập nhật'}</span>
      </div>
      <div class="profile-quick-row">
        <i class="fa-solid fa-droplet"></i>
        <span>Nhóm máu: <strong>{$patient.blood_type|default:'Chưa rõ'}</strong></span>
      </div>
      <div class="profile-quick-row">
        <i class="fa-solid fa-shield-heart"></i>
        {if $patient.bhyt_code}
          <span class="badge badge--success" style="font-size:12px">BHYT: {$patient.bhyt_code}</span>
        {else}
          <span class="text-muted" style="font-size:13px">Chưa có BHYT</span>
        {/if}
      </div>
    </div>

    {if $patient.drug_allergies}
    <div style="margin-top:1rem;background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:.75rem;text-align:left">
      <p style="font-size:12px;font-weight:600;color:var(--admin-danger);margin-bottom:.25rem">
        <i class="fa-solid fa-triangle-exclamation"></i> Dị ứng thuốc
      </p>
      <p style="font-size:12.5px;color:#991b1b">{$patient.drug_allergies}</p>
    </div>
    {/if}
  </div>

  <!-- Main content -->
  <div class="profile-content">
    <div class="settings-tabs" style="flex-direction:row;flex-wrap:wrap;margin-bottom:1rem">
      <button class="settings-tab active" onclick="switchTab('info',this)">
        <i class="fa-solid fa-user"></i> Thông tin cá nhân
      </button>
      <button class="settings-tab" onclick="switchTab('health',this)">
        <i class="fa-solid fa-heart-pulse"></i> Sức khỏe
      </button>
      <button class="settings-tab" onclick="switchTab('allergy',this)">
        <i class="fa-solid fa-triangle-exclamation"></i> Dị ứng
      </button>
      <button class="settings-tab" onclick="switchTab('security',this)">
        <i class="fa-solid fa-lock"></i> Đổi mật khẩu
      </button>
    </div>

    <!-- Tab: Thông tin cá nhân -->
    <div class="settings-pane active" id="tab-info">
      <form action="/CLINIC/public/" method="POST" class="appt-form" enctype="multipart/form-data">
        <input type="hidden" name="role" value="patient">
        <input type="hidden" name="page" value="profile">
        <input type="hidden" name="tab" value="info">
        <div class="admin-card">
          <div class="admin-card__header"><h3>Thông tin cá nhân</h3></div>
          <div class="admin-card__body">
            <div class="form-row-2">
              <div class="form-group">
                <label>Họ và tên <span class="required">*</span></label>
                <input type="text" name="full_name" value="{$patient.full_name|default:''}" required>
              </div>
              <div class="form-group">
                <label>Số điện thoại <span class="required">*</span></label>
                <input type="tel" name="phone" value="{$patient.phone|default:''}" required>
              </div>
            </div>
            <div class="form-row-2">
              <div class="form-group">
                <label>Ngày sinh</label>
                <input type="date" name="birthday" value="{$patient.birthday|default:''}">
              </div>
              <div class="form-group">
                <label>Giới tính</label>
                <select name="gender">
                  <option value="male"   {if $patient.gender == 'male'}selected{/if}>Nam</option>
                  <option value="female" {if $patient.gender == 'female'}selected{/if}>Nữ</option>
                  <option value="other"  {if $patient.gender == 'other'}selected{/if}>Khác</option>
                </select>
              </div>
            </div>
            <div class="form-row-2">
              <div class="form-group">
                <label>Số CCCD / CMND</label>
                <input type="text" name="cccd" value="{$patient.cccd|default:''}">
              </div>
              <div class="form-group">
                <label>Số thẻ BHYT</label>
                <input type="text" name="bhyt_code" value="{$patient.bhyt_code|default:''}">
              </div>
            </div>
            <div class="form-group">
              <label>Địa chỉ</label>
              <input type="text" name="address" value="{$patient.address|default:''}">
            </div>
            <div class="form-row-2">
              <div class="form-group">
                <label>Người liên hệ khẩn cấp</label>
                <input type="text" name="emergency_name" placeholder="Họ và tên" value="{$patient.emergency_name|default:''}">
              </div>
              <div class="form-group">
                <label>SĐT người liên hệ</label>
                <input type="tel" name="emergency_phone" placeholder="Số điện thoại" value="{$patient.emergency_phone|default:''}">
              </div>
            </div>
            <button type="submit" class="btn-admin-primary" style="margin-top:.5rem">
              <i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi
            </button>
          </div>
        </div>
      </form>
    </div>

    <!-- Tab: Sức khỏe -->
    <div class="settings-pane" id="tab-health">
      <form action="/CLINIC/public/" method="POST" class="appt-form">
        <input type="hidden" name="role" value="patient">
        <input type="hidden" name="page" value="profile">
        <input type="hidden" name="tab" value="health">
        <div class="admin-card">
          <div class="admin-card__header"><h3>Thông tin sức khỏe cơ bản</h3></div>
          <div class="admin-card__body">
            <div class="form-row-2">
              <div class="form-group">
                <label>Nhóm máu</label>
                <select name="blood_type">
                  <option value="">Không rõ</option>
                  {foreach from=['A+','A-','B+','B-','AB+','AB-','O+','O-'] item=bt}
                  <option value="{$bt}" {if $patient.blood_type == $bt}selected{/if}>{$bt}</option>
                  {/foreach}
                </select>
              </div>
              <div class="form-group">
                <label>Chiều cao (cm)</label>
                <input type="number" name="height" id="hInput" value="{$patient.height|default:''}" min="50" max="250" placeholder="VD: 165">
              </div>
            </div>
            <div class="form-row-2">
              <div class="form-group">
                <label>Cân nặng (kg)</label>
                <input type="number" name="weight" id="wInput" value="{$patient.weight|default:''}" min="1" max="300" placeholder="VD: 60">
              </div>
              <div class="form-group">
                <label>Chỉ số BMI</label>
                <input type="text" id="bmiDisplay" readonly placeholder="Tự động tính sau khi nhập chiều cao & cân nặng" style="background:#f8fafc;cursor:default">
              </div>
            </div>
            <div class="form-group">
              <label>Tiền sử bệnh</label>
              <textarea name="medical_history" rows="4" placeholder="VD: Tiểu đường type 2, tăng huyết áp, hen suyễn...">{$patient.medical_history|default:''}</textarea>
            </div>
            <div class="form-group">
              <label>Thuốc đang sử dụng thường xuyên</label>
              <textarea name="current_medications" rows="3" placeholder="VD: Metformin 500mg 2 lần/ngày, Amlodipine 5mg 1 lần/ngày...">{$patient.current_medications|default:''}</textarea>
            </div>
            <button type="submit" class="btn-admin-primary" style="margin-top:.5rem">
              <i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi
            </button>
          </div>
        </div>
      </form>
    </div>

    <!-- Tab: Dị ứng -->
    <div class="settings-pane" id="tab-allergy">
      <form action="/CLINIC/public/" method="POST" class="appt-form">
        <input type="hidden" name="role" value="patient">
        <input type="hidden" name="page" value="profile">
        <input type="hidden" name="tab" value="allergy">
        <div class="admin-card">
          <div class="admin-card__header">
            <h3><i class="fa-solid fa-triangle-exclamation" style="color:var(--admin-warning)"></i> Thông tin dị ứng</h3>
          </div>
          <div class="admin-card__body">
            <div class="alert alert--warning">
              <i class="fa-solid fa-triangle-exclamation"></i>
              Thông tin dị ứng <strong>rất quan trọng</strong> — giúp bác sĩ và dược sĩ tránh kê đơn thuốc có thể gây hại cho bạn. Hãy điền đầy đủ và chính xác.
            </div>
            <div class="form-group" style="margin-top:1rem">
              <label>Dị ứng thuốc</label>
              <textarea name="drug_allergies" rows="3" placeholder="VD: Penicillin, Aspirin, Ibuprofen, thuốc cản quang Iod...">{$patient.drug_allergies|default:''}</textarea>
            </div>
            <div class="form-group">
              <label>Dị ứng thực phẩm</label>
              <textarea name="food_allergies" rows="3" placeholder="VD: Hải sản, đậu phộng, sữa bò, trứng...">{$patient.food_allergies|default:''}</textarea>
            </div>
            <div class="form-group">
              <label>Dị ứng khác</label>
              <textarea name="other_allergies" rows="2" placeholder="VD: Phấn hoa, lông động vật, cao su latex, bụi nhà...">{$patient.other_allergies|default:''}</textarea>
            </div>
            <button type="submit" class="btn-admin-primary" style="margin-top:.5rem">
              <i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi
            </button>
          </div>
        </div>
      </form>
    </div>

    <!-- Tab: Đổi mật khẩu -->
    <div class="settings-pane" id="tab-security">
      <form action="/CLINIC/public/" method="POST" class="appt-form" id="pwForm">
        <input type="hidden" name="role" value="patient">
        <input type="hidden" name="page" value="profile">
        <input type="hidden" name="tab" value="security">
        <div class="admin-card">
          <div class="admin-card__header"><h3>Đổi mật khẩu</h3></div>
          <div class="admin-card__body">
            <div class="form-group">
              <label>Mật khẩu hiện tại <span class="required">*</span></label>
              <div class="input-icon-wrap">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="current_password" id="pw0" required placeholder="Nhập mật khẩu hiện tại">
                <button type="button" class="input-toggle-pw" onclick="togglePw('pw0',this)"><i class="fa-regular fa-eye"></i></button>
              </div>
            </div>
            <div class="form-group">
              <label>Mật khẩu mới <span class="required">*</span></label>
              <div class="input-icon-wrap">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="new_password" id="pw1" required minlength="8" placeholder="Tối thiểu 8 ký tự">
                <button type="button" class="input-toggle-pw" onclick="togglePw('pw1',this)"><i class="fa-regular fa-eye"></i></button>
              </div>
            </div>
            <div class="form-group">
              <label>Xác nhận mật khẩu mới <span class="required">*</span></label>
              <div class="input-icon-wrap">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="confirm_password" id="pw2" required placeholder="Nhập lại mật khẩu mới">
                <button type="button" class="input-toggle-pw" onclick="togglePw('pw2',this)"><i class="fa-regular fa-eye"></i></button>
              </div>
            </div>
            <div id="pwMatchMsg" style="font-size:13px;margin-top:-.25rem"></div>
            <button type="submit" class="btn-admin-primary" style="margin-top:.75rem">
              <i class="fa-solid fa-key"></i> Đổi mật khẩu
            </button>
          </div>
        </div>
      </form>
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
function previewAvatar(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      const av = document.getElementById('avatarPreview');
      av.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;border-radius:50%">`;
    };
    reader.readAsDataURL(input.files[0]);
  }
}
function togglePw(id, btn) {
  const input = document.getElementById(id);
  const icon  = btn.querySelector('i');
  input.type  = input.type === 'password' ? 'text' : 'password';
  icon.className = input.type === 'password' ? 'fa-regular fa-eye' : 'fa-regular fa-eye-slash';
}
// BMI calculator
const hInput = document.getElementById('hInput');
const wInput = document.getElementById('wInput');
const bmiDisplay = document.getElementById('bmiDisplay');
function calcBMI() {
  const h = parseFloat(hInput?.value) / 100;
  const w = parseFloat(wInput?.value);
  if (h > 0 && w > 0 && bmiDisplay) {
    const bmi = (w / (h * h)).toFixed(1);
    const label = bmi < 18.5 ? 'Thiếu cân' : bmi < 25 ? '✓ Bình thường' : bmi < 30 ? 'Thừa cân' : 'Béo phì';
    bmiDisplay.value = `${bmi} — ${label}`;
  }
}
hInput?.addEventListener('input', calcBMI);
wInput?.addEventListener('input', calcBMI);
calcBMI();

// Password match check
const pw1 = document.getElementById('pw1');
const pw2 = document.getElementById('pw2');
const msg = document.getElementById('pwMatchMsg');
pw2?.addEventListener('input', () => {
  if (pw2.value && pw1.value !== pw2.value) {
    msg.textContent = '✗ Mật khẩu không khớp';
    msg.style.color = 'var(--admin-danger)';
  } else if (pw2.value) {
    msg.textContent = '✓ Mật khẩu khớp';
    msg.style.color = 'var(--admin-success)';
  } else {
    msg.textContent = '';
  }
});
document.getElementById('pwForm')?.addEventListener('submit', e => {
  if (pw1.value !== pw2.value) { e.preventDefault(); alert('Mật khẩu xác nhận không khớp!'); }
});
</script>

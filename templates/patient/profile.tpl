{include file="layout/header.tpl" page_title="Hồ sơ cá nhân" active_page="profile"}

<style>
  .profile-layout { display: flex; flex-wrap: wrap; gap: 2rem; align-items: flex-start; margin-top: 1.5rem; margin-bottom: 3rem; }
  .profile-sidebar { width: 100%; max-width: 320px; flex-shrink: 0; }
  .profile-content { flex: 1; min-width: 300px; }
  .settings-pane { display: none; }
  .settings-pane.active { display: block; animation: fadeIn 0.3s; }
  .settings-tabs { display: flex; gap: 0.5rem; overflow-x: auto; padding-bottom: 0.5rem; border-bottom: 2px solid #e2e8f0; margin-bottom: 1.5rem; }
  .settings-tab { background: none; border: none; padding: 0.75rem 1rem; cursor: pointer; color: #64748b; font-weight: 500; font-size: 0.95rem; display: flex; align-items: center; gap: 0.5rem; border-bottom: 2px solid transparent; margin-bottom: -0.65rem; white-space: nowrap; transition: all 0.2s; }
  .settings-tab:hover { color: #0284c7; }
  .settings-tab.active { color: #0284c7; border-bottom-color: #0284c7; font-weight: 600; }
  .profile-avatar-wrap { position: relative; width: 120px; height: 120px; margin: 0 auto 1.5rem auto; }
  .profile-avatar { width: 100%; height: 100%; border-radius: 50%; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: bold; overflow: hidden; border: 4px solid #fff; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
  .profile-avatar-edit { position: absolute; bottom: 0; right: 0; background: #0284c7; color: #fff; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 3px solid #fff; transition: background 0.2s; }
  .profile-avatar-edit:hover { background: #0369a1; }
  .profile-quick-row { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 0; border-bottom: 1px solid #f1f5f9; color: #475569; font-size: 0.9rem; }
  .profile-quick-row i { color: #94a3b8; width: 16px; text-align: center; }
  .profile-quick-row:last-child { border-bottom: none; }
  @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }
</style>

<div class="page-toolbar" style="margin-top: 1.5rem; margin-bottom: 2rem;">
  <div class="page-toolbar__left">
    <h2 class="page-title" style="margin: 0; font-size: 1.8rem; color: #0f172a;"><i class="fa-solid fa-id-card" style="color: #0284c7;"></i> Hồ sơ cá nhân</h2>
    <p class="page-subtitle" style="margin: 0.5rem 0 0 0; color: #64748b;">Quản lý thông tin cá nhân và dữ liệu sức khỏe của bạn</p>
  </div>
</div>

{if isset($success_message) && $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}
{if isset($error_message) && $error_message}<div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>{/if}

<div class="profile-layout">

  <div class="profile-sidebar">
    <div class="dashboard-card" style="text-align: center;">
      <div class="dashboard-card__body">
        <div class="profile-avatar-wrap">
          <div class="profile-avatar" id="avatarPreview">
            {if isset($patient.avatar) && $patient.avatar}
              <img src="{$patient.avatar}" alt="" style="width:100%; height:100%; object-fit:cover;">
            {else}
              <span>{$smarty.session.user.full_name|default:'?'|truncate:1:''}</span>
            {/if}
          </div>
          <label class="profile-avatar-edit" title="Đổi ảnh đại diện">
            <i class="fa-solid fa-camera"></i>
            <input type="file" accept="image/*" style="display:none" onchange="previewAvatar(this)">
          </label>
        </div>
        
        <h3 style="margin: 0 0 0.25rem 0; color: #0f172a; font-size: 1.25rem;">{$smarty.session.user.full_name|default:'Bệnh nhân'}</h3>
        <p class="text-muted" style="font-size:13px; margin: 0 0 1.5rem 0; color: #64748b;">Mã BN: <strong style="color:#0f172a;">#{$patient.patient_code|default:'—'}</strong></p>

        <div class="profile-quick-info" style="text-align: left;">
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
            <span>Nhóm máu: <strong style="color: #ef4444;">{$patient.blood_type|default:'Chưa rõ'}</strong></span>
          </div>
          <div class="profile-quick-row">
            <i class="fa-solid fa-shield-heart"></i>
            {if isset($patient.bhyt_code) && $patient.bhyt_code}
              <span class="badge badge--success" style="font-size:12px;">BHYT: {$patient.bhyt_code}</span>
            {else}
              <span class="text-muted" style="font-size:12px; background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">Chưa có BHYT</span>
            {/if}
          </div>
        </div>

        {if isset($patient.drug_allergies) && $patient.drug_allergies}
        <div style="margin-top:1.5rem; background:#fef2f2; border:1px solid #fecaca; border-radius:8px; padding:.75rem; text-align:left;">
          <p style="font-size:13px; font-weight:600; color:#dc2626; margin-bottom:.25rem;">
            <i class="fa-solid fa-triangle-exclamation"></i> Dị ứng thuốc cảnh báo
          </p>
          <p style="font-size:13px; color:#991b1b; margin:0;">{$patient.drug_allergies}</p>
        </div>
        {/if}
      </div>
    </div>
  </div>

  <div class="profile-content">
    
    <div class="settings-tabs">
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

    <div class="settings-pane active" id="tab-info">
      <form action="{$BASE_URL}/?page=profile" method="POST" class="appt-form" enctype="multipart/form-data">
        <input type="hidden" name="tab" value="info">
        <div class="dashboard-card">
          <div class="dashboard-card__header"><h3><i class="fa-regular fa-address-card" style="color: #64748b; margin-right: 5px;"></i> Thông tin liên hệ</h3></div>
          <div class="dashboard-card__body">
            
            <div class="form-row-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1rem;">
              <div class="form-group">
                <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Họ và tên <span class="required" style="color:#ef4444">*</span></label>
                <input type="text" name="full_name" class="form-control" value="{$patient.full_name|default:''}" required style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px;">
              </div>
              <div class="form-group">
                <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Số điện thoại <span class="required" style="color:#ef4444">*</span></label>
                <input type="tel" name="phone" class="form-control" value="{$patient.phone|default:''}" required style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px;">
              </div>
            </div>
            
            <div class="form-row-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1rem;">
              <div class="form-group">
                <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Ngày sinh</label>
                <input type="date" name="birthday" class="form-control" value="{$patient.birthday|default:''}" style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px;">
              </div>
              <div class="form-group">
                <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Giới tính</label>
                <select name="gender" class="form-control" style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px; background:#fff;">
                  <option value="male"   {if isset($patient.gender) && $patient.gender == 'male'}selected{/if}>Nam</option>
                  <option value="female" {if isset($patient.gender) && $patient.gender == 'female'}selected{/if}>Nữ</option>
                  <option value="other"  {if isset($patient.gender) && $patient.gender == 'other'}selected{/if}>Khác</option>
                </select>
              </div>
            </div>
            
            <div class="form-row-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1rem;">
              <div class="form-group">
                <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Số CCCD / CMND</label>
                <input type="text" name="cccd" class="form-control" value="{$patient.cccd|default:''}" style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px;">
              </div>
              <div class="form-group">
                <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Số thẻ BHYT</label>
                <input type="text" name="bhyt_code" class="form-control" value="{$patient.bhyt_code|default:''}" style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px;">
              </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 1.5rem;">
              <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Địa chỉ hiện tại</label>
              <input type="text" name="address" class="form-control" value="{$patient.address|default:''}" style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px;">
            </div>
            
            <div style="background: #f8fafc; padding: 1.25rem; border-radius: 8px; border: 1px solid #e2e8f0; margin-bottom: 1.5rem;">
              <h4 style="margin: 0 0 1rem 0; color: #334155; font-size: 1rem;"><i class="fa-solid fa-truck-medical" style="color:#ef4444; margin-right:5px;"></i> Liên hệ khẩn cấp</h4>
              <div class="form-row-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                  <label style="display:block; margin-bottom:0.5rem; font-weight:500; font-size: 0.9rem;">Họ và tên</label>
                  <input type="text" name="emergency_name" class="form-control" placeholder="Tên người thân" value="{$patient.emergency_name|default:''}" style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px;">
                </div>
                <div class="form-group">
                  <label style="display:block; margin-bottom:0.5rem; font-weight:500; font-size: 0.9rem;">Số điện thoại</label>
                  <input type="tel" name="emergency_phone" class="form-control" placeholder="SĐT người thân" value="{$patient.emergency_phone|default:''}" style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px;">
                </div>
              </div>
            </div>
            
            <button type="submit" class="btn-primary" style="padding: 0.75rem 1.5rem; font-size: 1rem; border:none; border-radius:6px; cursor:pointer;">
              <i class="fa-solid fa-floppy-disk"></i> Lưu thông tin
            </button>
          </div>
        </div>
      </form>
    </div>
    <div class="settings-pane" id="tab-health">
      <form action="{$BASE_URL}/?page=profile" method="POST" class="appt-form">
        <input type="hidden" name="tab" value="health">
        <div class="dashboard-card">
          <div class="dashboard-card__header"><h3><i class="fa-solid fa-heart-pulse" style="color: #64748b; margin-right: 5px;"></i> Thông tin sức khỏe cơ bản</h3></div>
          <div class="dashboard-card__body">
            
            <div class="form-row-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1rem;">
              <div class="form-group">
                <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Nhóm máu</label>
                <select name="blood_type" class="form-control" style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px; background:#fff;">
                  <option value="">Không rõ</option>
                  {foreach from=['A+','A-','B+','B-','AB+','AB-','O+','O-'] item=bt}
                  <option value="{$bt}" {if isset($patient.blood_type) && $patient.blood_type == $bt}selected{/if}>{$bt}</option>
                  {/foreach}
                </select>
              </div>
              <div class="form-group">
                <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Chiều cao (cm)</label>
                <input type="number" name="height" id="hInput" class="form-control" value="{$patient.height|default:''}" min="50" max="250" placeholder="VD: 165" style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px;">
              </div>
            </div>
            
            <div class="form-row-2" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1rem;">
              <div class="form-group">
                <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Cân nặng (kg)</label>
                <input type="number" name="weight" id="wInput" class="form-control" value="{$patient.weight|default:''}" min="1" max="300" placeholder="VD: 60" style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px;">
              </div>
              <div class="form-group">
                <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Chỉ số BMI</label>
                <input type="text" id="bmiDisplay" class="form-control" readonly placeholder="Tự động tính sau khi nhập chiều cao & cân nặng" style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px; background:#f8fafc; cursor:default; color:#0f172a; font-weight:600;">
              </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 1rem;">
              <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Tiền sử bệnh tật</label>
              <textarea name="medical_history" class="form-control" rows="4" placeholder="VD: Tiểu đường type 2, tăng huyết áp, hen suyễn, từng phẫu thuật ruột thừa..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px; resize:vertical;">{$patient.medical_history|default:''}</textarea>
            </div>
            
            <div class="form-group" style="margin-bottom: 1.5rem;">
              <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Thuốc đang sử dụng thường xuyên</label>
              <textarea name="current_medications" class="form-control" rows="3" placeholder="VD: Metformin 500mg 2 lần/ngày, Amlodipine 5mg 1 lần/ngày..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px; resize:vertical;">{$patient.current_medications|default:''}</textarea>
            </div>
            
            <button type="submit" class="btn-primary" style="padding: 0.75rem 1.5rem; font-size: 1rem; border:none; border-radius:6px; cursor:pointer;">
              <i class="fa-solid fa-floppy-disk"></i> Lưu hồ sơ sức khỏe
            </button>
          </div>
        </div>
      </form>
    </div>

    <div class="settings-pane" id="tab-allergy">
      <form action="{$BASE_URL}/?page=profile" method="POST" class="appt-form">
        <input type="hidden" name="tab" value="allergy">
        <div class="dashboard-card">
          <div class="dashboard-card__header">
            <h3><i class="fa-solid fa-triangle-exclamation" style="color:#d97706; margin-right:5px;"></i> Thông tin dị ứng</h3>
          </div>
          <div class="dashboard-card__body">
            
            <div class="alert alert--warning" style="background:#fffbeb; color:#b45309; padding:1rem; border-radius:6px; margin-bottom:1.5rem;">
              <i class="fa-solid fa-triangle-exclamation"></i>
              Thông tin dị ứng <strong>rất quan trọng</strong> — giúp bác sĩ và dược sĩ tránh kê đơn thuốc có thể gây hại nghiêm trọng cho bạn. Hãy điền đầy đủ và chính xác.
            </div>
            
            <div class="form-group" style="margin-bottom: 1rem;">
              <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Dị ứng thuốc</label>
              <textarea name="drug_allergies" class="form-control" rows="3" placeholder="VD: Penicillin, Aspirin, Ibuprofen, thuốc cản quang Iod..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px; resize:vertical;">{$patient.drug_allergies|default:''}</textarea>
            </div>
            
            <div class="form-group" style="margin-bottom: 1rem;">
              <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Dị ứng thực phẩm</label>
              <textarea name="food_allergies" class="form-control" rows="3" placeholder="VD: Hải sản, đậu phộng, sữa bò, trứng..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px; resize:vertical;">{$patient.food_allergies|default:''}</textarea>
            </div>
            
            <div class="form-group" style="margin-bottom: 1.5rem;">
              <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Dị ứng môi trường / Khác</label>
              <textarea name="other_allergies" class="form-control" rows="2" placeholder="VD: Phấn hoa, lông chó mèo, cao su latex, bụi nhà..." style="width:100%; padding:0.6rem; border:1px solid #cbd5e1; border-radius:6px; resize:vertical;">{$patient.other_allergies|default:''}</textarea>
            </div>
            
            <button type="submit" class="btn-primary" style="padding: 0.75rem 1.5rem; font-size: 1rem; border:none; border-radius:6px; cursor:pointer;">
              <i class="fa-solid fa-floppy-disk"></i> Cập nhật thông tin dị ứng
            </button>
          </div>
        </div>
      </form>
    </div>

    <div class="settings-pane" id="tab-security">
      <form action="{$BASE_URL}/?page=profile" method="POST" class="appt-form" id="pwForm">
        <input type="hidden" name="tab" value="security">
        <div class="dashboard-card">
          <div class="dashboard-card__header"><h3><i class="fa-solid fa-lock" style="color:#64748b; margin-right:5px;"></i> Đổi mật khẩu</h3></div>
          <div class="dashboard-card__body">
            
            <div class="form-group" style="margin-bottom: 1rem;">
              <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Mật khẩu hiện tại <span class="required" style="color:#ef4444">*</span></label>
              <div class="input-icon-wrap" style="position:relative; display:flex; align-items:center;">
                <i class="fa-solid fa-lock" style="position:absolute; left:12px; color:#94a3b8;"></i>
                <input type="password" name="current_password" id="pw0" class="form-control" required placeholder="Nhập mật khẩu hiện tại" style="width:100%; padding:0.6rem 2.5rem; border:1px solid #cbd5e1; border-radius:6px;">
                <button type="button" class="input-toggle-pw" onclick="togglePw('pw0',this)" style="position:absolute; right:12px; background:none; border:none; color:#64748b; cursor:pointer;"><i class="fa-regular fa-eye"></i></button>
              </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 1rem;">
              <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Mật khẩu mới <span class="required" style="color:#ef4444">*</span></label>
              <div class="input-icon-wrap" style="position:relative; display:flex; align-items:center;">
                <i class="fa-solid fa-key" style="position:absolute; left:12px; color:#94a3b8;"></i>
                <input type="password" name="new_password" id="pw1" class="form-control" required minlength="8" placeholder="Tối thiểu 8 ký tự" style="width:100%; padding:0.6rem 2.5rem; border:1px solid #cbd5e1; border-radius:6px;">
                <button type="button" class="input-toggle-pw" onclick="togglePw('pw1',this)" style="position:absolute; right:12px; background:none; border:none; color:#64748b; cursor:pointer;"><i class="fa-regular fa-eye"></i></button>
              </div>
            </div>
            
            <div class="form-group" style="margin-bottom: 0.5rem;">
              <label style="display:block; margin-bottom:0.5rem; font-weight:500;">Xác nhận mật khẩu mới <span class="required" style="color:#ef4444">*</span></label>
              <div class="input-icon-wrap" style="position:relative; display:flex; align-items:center;">
                <i class="fa-solid fa-key" style="position:absolute; left:12px; color:#94a3b8;"></i>
                <input type="password" name="confirm_password" id="pw2" class="form-control" required placeholder="Nhập lại mật khẩu mới" style="width:100%; padding:0.6rem 2.5rem; border:1px solid #cbd5e1; border-radius:6px;">
                <button type="button" class="input-toggle-pw" onclick="togglePw('pw2',this)" style="position:absolute; right:12px; background:none; border:none; color:#64748b; cursor:pointer;"><i class="fa-regular fa-eye"></i></button>
              </div>
            </div>
            
            <div id="pwMatchMsg" style="font-size:13px; margin-bottom:1.5rem; font-weight:500; min-height: 20px;"></div>
            
            <button type="submit" class="btn-primary" style="padding: 0.75rem 1.5rem; font-size: 1rem; border:none; border-radius:6px; cursor:pointer;">
              <i class="fa-solid fa-shield-halved"></i> Đổi mật khẩu
            </button>
          </div>
        </div>
      </form>
    </div>

  </div> </div> {include file="layout/footer.tpl"}

<script>
{literal}
// 1. Chuyển đổi giữa các Tabs
function switchTab(name, btn) {
  document.querySelectorAll('.settings-tab').forEach(t => t.classList.remove('active'));
  document.querySelectorAll('.settings-pane').forEach(p => p.classList.remove('active'));
  btn.classList.add('active');
  document.getElementById('tab-' + name).classList.add('active');
}

// 2. Preview Ảnh đại diện khi chọn file
function previewAvatar(input) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = e => {
      const av = document.getElementById('avatarPreview');
      av.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover;">`;
    };
    reader.readAsDataURL(input.files[0]);
  }
}

// 3. Ẩn/Hiện Mật khẩu (Nút con mắt)
function togglePw(id, btn) {
  const input = document.getElementById(id);
  const icon  = btn.querySelector('i');
  if (input.type === 'password') {
      input.type = 'text';
      icon.className = 'fa-regular fa-eye-slash';
  } else {
      input.type = 'password';
      icon.className = 'fa-regular fa-eye';
  }
}

// 4. Tính toán chỉ số BMI tự động
const hInput = document.getElementById('hInput');
const wInput = document.getElementById('wInput');
const bmiDisplay = document.getElementById('bmiDisplay');

function calcBMI() {
  const h = parseFloat(hInput?.value) / 100; // Đổi cm sang m
  const w = parseFloat(wInput?.value);
  
  if (h > 0 && w > 0 && bmiDisplay) {
    const bmi = (w / (h * h)).toFixed(1);
    let label = '';
    let color = '';
    
    if (bmi < 18.5) { label = 'Thiếu cân'; color = '#d97706'; }
    else if (bmi < 25) { label = '✓ Bình thường'; color = '#16a34a'; }
    else if (bmi < 30) { label = 'Thừa cân'; color = '#ea580c'; }
    else { label = 'Béo phì'; color = '#dc2626'; }
    
    bmiDisplay.value = `${bmi} — ${label}`;
    bmiDisplay.style.color = color;
  } else if (bmiDisplay) {
      bmiDisplay.value = '';
  }
}

hInput?.addEventListener('input', calcBMI);
wInput?.addEventListener('input', calcBMI);
// Gọi ngay khi load trang để hiển thị nếu có sẵn data
calcBMI();

// 5. Kiểm tra Mật khẩu xác nhận khớp nhau
const pw1 = document.getElementById('pw1');
const pw2 = document.getElementById('pw2');
const msg = document.getElementById('pwMatchMsg');

pw2?.addEventListener('input', () => {
  if (pw2.value && pw1.value !== pw2.value) {
    msg.textContent = '✗ Mật khẩu xác nhận không khớp';
    msg.style.color = '#ef4444'; // Màu đỏ (Danger)
  } else if (pw2.value) {
    msg.textContent = '✓ Mật khẩu khớp';
    msg.style.color = '#16a34a'; // Màu xanh (Success)
  } else {
    msg.textContent = '';
  }
});

// Ngăn submit form nếu mật khẩu không khớp
document.getElementById('pwForm')?.addEventListener('submit', e => {
  if (pw1.value !== pw2.value) { 
      e.preventDefault(); 
      alert('Vui lòng kiểm tra lại! Mật khẩu xác nhận không khớp với mật khẩu mới.'); 
  }
});
{/literal}
</script>
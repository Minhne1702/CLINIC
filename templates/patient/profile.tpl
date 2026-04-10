{include file="layout/sidebar.tpl" page_title="Hồ sơ cá nhân" active_page="profile"}

<style>
  /* --- BỐ CỤC CHUNG --- */
  .profile-wrapper { max-width: 1000px; margin: 2rem auto 4rem auto; padding: 0 1.5rem; }
  .page-toolbar { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem; }
  .page-title { margin: 0; font-size: 1.8rem; color: #0f172a; font-weight: 700; display: flex; align-items: center; gap: 10px; }
  .page-subtitle { margin: 0.5rem 0 0 0; color: #64748b; font-size: 0.95rem; }

  /* --- ALERTS --- */
  .alert { padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 8px; font-weight: 500; }
  .alert--success { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
  .alert--danger { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
  .alert--warning { background: #fffbeb; color: #b45309; border: 1px solid #fef3c7; }

  /* --- LAYOUT CHÍNH --- */
  .profile-layout { display: flex; flex-wrap: wrap; gap: 2rem; align-items: flex-start; }
  .profile-sidebar { width: 100%; max-width: 320px; flex-shrink: 0; }
  .profile-content { flex: 1; min-width: 300px; }

  /* --- CARDS --- */
  .dashboard-card { background: #fff; border-radius: 16px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem; }
  .dashboard-card__header { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; background: #f8fafc; }
  .dashboard-card__header h3 { font-size: 1.15rem; margin: 0; color: #0f172a; font-weight: 600; display: flex; align-items: center; gap: 8px; }
  .dashboard-card__body { padding: 1.5rem; }

  /* --- SIDEBAR AVATAR & INFO --- */
  .profile-avatar-wrap { position: relative; width: 120px; height: 120px; margin: 0 auto 1.5rem auto; }
  .profile-avatar { width: 100%; height: 100%; border-radius: 50%; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 2.5rem; font-weight: bold; overflow: hidden; border: 4px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
  .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
  .profile-avatar-edit { position: absolute; bottom: 0; right: 0; background: #0284c7; color: #fff; width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; border: 3px solid #fff; transition: all 0.2s; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
  .profile-avatar-edit:hover { background: #0369a1; transform: scale(1.05); }
  
  .profile-quick-row { display: flex; align-items: center; gap: 1rem; padding: 0.85rem 0; border-bottom: 1px solid #f1f5f9; color: #475569; font-size: 0.95rem; }
  .profile-quick-row i { color: #94a3b8; width: 20px; text-align: center; font-size: 1.1rem; }
  .profile-quick-row:last-child { border-bottom: none; padding-bottom: 0; }
  
  .badge { padding: 4px 10px; border-radius: 6px; font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; }
  .badge--success { background: #dcfce7; color: #15803d; }

  /* --- TABS --- */
  .settings-tabs { display: flex; gap: 0.5rem; overflow-x: auto; padding-bottom: 0.5rem; border-bottom: 2px solid #e2e8f0; margin-bottom: 1.5rem; }
  .settings-tab { background: none; border: none; padding: 0.75rem 1.25rem; cursor: pointer; color: #64748b; font-weight: 500; font-size: 0.95rem; display: flex; align-items: center; gap: 0.5rem; border-bottom: 2px solid transparent; margin-bottom: -0.65rem; white-space: nowrap; transition: all 0.2s; }
  .settings-tab:hover { color: #0284c7; }
  .settings-tab.active { color: #0284c7; border-bottom-color: #0284c7; font-weight: 600; }
  
  .settings-pane { display: none; }
  .settings-pane.active { display: block; animation: fadeIn 0.3s; }
  @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

  /* --- FORM ELEMENTS --- */
  .form-group { margin-bottom: 1.25rem; }
  .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #334155; font-size: 0.95rem; }
  .form-group label .required { color: #ef4444; }
  .form-control { width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px; outline: none; transition: all 0.2s; color: #0f172a; font-family: inherit; font-size: 0.95rem; background: #fff; }
  .form-control:focus { border-color: #0284c7; box-shadow: 0 0 0 3px #e0f2fe; }
  .form-control:disabled, .form-control[readonly] { background: #f8fafc; color: #64748b; cursor: not-allowed; }
  textarea.form-control { resize: vertical; min-height: 100px; }
  
  .form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; }
  @media (max-width: 768px) { .form-row-2 { grid-template-columns: 1fr; gap: 0; } }

  .input-icon-wrap { position: relative; display: flex; align-items: center; }
  .input-icon-wrap i.left-icon { position: absolute; left: 14px; color: #94a3b8; }
  .input-icon-wrap .form-control { padding-left: 2.75rem; }
  .input-toggle-pw { position: absolute; right: 14px; background: none; border: none; color: #64748b; cursor: pointer; padding: 0; display: flex; align-items: center; justify-content: center; transition: color 0.2s; }
  .input-toggle-pw:hover { color: #0284c7; }

  /* --- BUTTONS --- */
  .btn-primary { padding: 0.85rem 1.5rem; border-radius: 8px; background: #0284c7; color: #fff; border: none; font-weight: 600; font-size: 1rem; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(2, 132, 199, 0.2); }
  .btn-primary:hover { background: #0369a1; transform: translateY(-2px); }
</style>

<div class="profile-wrapper">

  <div class="page-toolbar">
    <div class="page-toolbar__left">
      <h2 class="page-title"><i class="fa-solid fa-id-card" style="color: #0284c7;"></i> Hồ sơ cá nhân</h2>
      <p class="page-subtitle">Quản lý thông tin cá nhân và dữ liệu sức khỏe của bạn</p>
    </div>
  </div>

  {if isset($success_message) && $success_message}
    <div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>
  {/if}
  {if isset($error_message) && $error_message}
    <div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>
  {/if}

  <div class="profile-layout">

    <div class="profile-sidebar">
      <div class="dashboard-card" style="text-align: center;">
        <div class="dashboard-card__body">
          <div class="profile-avatar-wrap">
            <div class="profile-avatar" id="avatarPreview">
              {if isset($patient.avatar) && $patient.avatar}
                <img src="{$patient.avatar}" alt="Avatar">
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
          <p style="font-size: 0.9rem; margin: 0 0 1.5rem 0; color: #64748b;">Mã BN: <strong style="color:#0f172a;">#{$patient.patient_code|default:'—'}</strong></p>

          <div style="text-align: left; padding-top: 0.5rem; border-top: 1px solid #f1f5f9;">
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
                <span class="badge badge--success">BHYT: {$patient.bhyt_code}</span>
              {else}
                <span style="font-size: 0.85rem; background: #f1f5f9; padding: 3px 8px; border-radius: 6px; color: #64748b;">Chưa có thẻ BHYT</span>
              {/if}
            </div>
          </div>

          {if isset($patient.drug_allergies) && $patient.drug_allergies}
          <div style="margin-top: 1.5rem; background: #fef2f2; border: 1px solid #fecaca; border-radius: 10px; padding: 1rem; text-align: left;">
            <p style="font-size: 0.9rem; font-weight: 600; color: #dc2626; margin: 0 0 0.5rem 0; display: flex; align-items: center; gap: 6px;">
              <i class="fa-solid fa-triangle-exclamation"></i> Dị ứng thuốc cảnh báo
            </p>
            <p style="font-size: 0.9rem; color: #991b1b; margin: 0; line-height: 1.5;">{$patient.drug_allergies}</p>
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
        <form action="{$BASE_URL}/?page=profile" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="tab" value="info">
          <div class="dashboard-card">
            <div class="dashboard-card__header">
              <h3><i class="fa-regular fa-address-card" style="color: #64748b;"></i> Thông tin liên hệ</h3>
            </div>
            <div class="dashboard-card__body">
              
              <div class="form-row-2">
                <div class="form-group">
                  <label>Họ và tên <span class="required">*</span></label>
                  <input type="text" name="full_name" class="form-control" value="{$patient.full_name|default:''}" required>
                </div>
                <div class="form-group">
                  <label>Số điện thoại <span class="required">*</span></label>
                  <input type="tel" name="phone" class="form-control" value="{$patient.phone|default:''}" required>
                </div>
              </div>
              
              <div class="form-row-2">
                <div class="form-group">
                  <label>Ngày sinh</label>
                  <input type="date" name="birthday" class="form-control" value="{$patient.birthday|default:''}">
                </div>
                <div class="form-group">
                  <label>Giới tính</label>
                  <select name="gender" class="form-control">
                    <option value="male"   {if isset($patient.gender) && $patient.gender == 'male'}selected{/if}>Nam</option>
                    <option value="female" {if isset($patient.gender) && $patient.gender == 'female'}selected{/if}>Nữ</option>
                    <option value="other"  {if isset($patient.gender) && $patient.gender == 'other'}selected{/if}>Khác</option>
                  </select>
                </div>
              </div>
              
              <div class="form-row-2">
                <div class="form-group">
                  <label>Số CCCD / CMND</label>
                  <input type="text" name="cccd" class="form-control" value="{$patient.cccd|default:''}">
                </div>
                <div class="form-group">
                  <label>Số thẻ BHYT</label>
                  <input type="text" name="bhyt_code" class="form-control" value="{$patient.bhyt_code|default:''}" placeholder="Mã số bảo hiểm y tế">
                </div>
              </div>
              
              <div class="form-group">
                <label>Địa chỉ hiện tại</label>
                <input type="text" name="address" class="form-control" value="{$patient.address|default:''}" placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành phố">
              </div>
              
              <div style="background: #f8fafc; padding: 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0; margin-top: 2rem; margin-bottom: 1.5rem;">
                <h4 style="margin: 0 0 1.25rem 0; color: #334155; font-size: 1.05rem; display: flex; align-items: center; gap: 8px;">
                  <i class="fa-solid fa-truck-medical" style="color:#ef4444;"></i> Liên hệ khẩn cấp
                </h4>
                <div class="form-row-2">
                  <div class="form-group" style="margin-bottom: 0;">
                    <label>Họ và tên người thân</label>
                    <input type="text" name="emergency_name" class="form-control" placeholder="Ví dụ: Nguyễn Văn B" value="{$patient.emergency_name|default:''}">
                  </div>
                  <div class="form-group" style="margin-bottom: 0;">
                    <label>Số điện thoại</label>
                    <input type="tel" name="emergency_phone" class="form-control" placeholder="SĐT người thân" value="{$patient.emergency_phone|default:''}">
                  </div>
                </div>
              </div>
              
              <div style="text-align: right;">
                <button type="submit" class="btn-primary">
                  <i class="fa-solid fa-floppy-disk"></i> Lưu thông tin cá nhân
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="settings-pane" id="tab-health">
        <form action="{$BASE_URL}/?page=profile" method="POST">
          <input type="hidden" name="tab" value="health">
          <div class="dashboard-card">
            <div class="dashboard-card__header">
              <h3><i class="fa-solid fa-heart-pulse" style="color: #64748b;"></i> Thông tin sức khỏe cơ bản</h3>
            </div>
            <div class="dashboard-card__body">
              
              <div class="form-row-2">
                <div class="form-group">
                  <label>Nhóm máu</label>
                  <select name="blood_type" class="form-control">
                    <option value="">Không rõ</option>
                    {foreach from=['A+','A-','B+','B-','AB+','AB-','O+','O-'] item=bt}
                    <option value="{$bt}" {if isset($patient.blood_type) && $patient.blood_type == $bt}selected{/if}>{$bt}</option>
                    {/foreach}
                  </select>
                </div>
                <div class="form-group">
                  <label>Chiều cao (cm)</label>
                  <input type="number" name="height" id="hInput" class="form-control" value="{$patient.height|default:''}" min="50" max="250" placeholder="VD: 165">
                </div>
              </div>
              
              <div class="form-row-2">
                <div class="form-group">
                  <label>Cân nặng (kg)</label>
                  <input type="number" name="weight" id="wInput" class="form-control" value="{$patient.weight|default:''}" min="1" max="300" placeholder="VD: 60">
                </div>
                <div class="form-group">
                  <label>Chỉ số BMI</label>
                  <input type="text" id="bmiDisplay" class="form-control" readonly placeholder="Tự động tính BMI">
                </div>
              </div>
              
              <div class="form-group">
                <label>Tiền sử bệnh lý cá nhân</label>
                <textarea name="medical_history" class="form-control" placeholder="VD: Tiểu đường type 2, tăng huyết áp, hen suyễn, từng phẫu thuật ruột thừa...">{$patient.medical_history|default:''}</textarea>
              </div>
              
              <div class="form-group">
                <label>Thuốc đang sử dụng thường xuyên</label>
                <textarea name="current_medications" class="form-control" placeholder="VD: Metformin 500mg 2 lần/ngày, Amlodipine 5mg 1 lần/ngày...">{$patient.current_medications|default:''}</textarea>
              </div>
              
              <div style="text-align: right; margin-top: 1.5rem;">
                <button type="submit" class="btn-primary">
                  <i class="fa-solid fa-floppy-disk"></i> Lưu hồ sơ sức khỏe
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="settings-pane" id="tab-allergy">
        <form action="{$BASE_URL}/?page=profile" method="POST">
          <input type="hidden" name="tab" value="allergy">
          <div class="dashboard-card">
            <div class="dashboard-card__header">
              <h3><i class="fa-solid fa-triangle-exclamation" style="color:#d97706;"></i> Thông tin dị ứng</h3>
            </div>
            <div class="dashboard-card__body">
              
              <div class="alert alert--warning" style="margin-bottom: 2rem;">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div>
                  <strong>Lưu ý quan trọng:</strong> Khai báo thông tin dị ứng đầy đủ sẽ giúp bác sĩ và dược sĩ phòng tránh việc kê đơn thuốc có thể gây sốc phản vệ hoặc nguy hiểm cho bạn.
                </div>
              </div>
              
              <div class="form-group">
                <label>Dị ứng thuốc</label>
                <textarea name="drug_allergies" class="form-control" placeholder="VD: Penicillin, Aspirin, Ibuprofen, thuốc cản quang Iod...">{$patient.drug_allergies|default:''}</textarea>
              </div>
              
              <div class="form-group">
                <label>Dị ứng thực phẩm</label>
                <textarea name="food_allergies" class="form-control" placeholder="VD: Hải sản, đậu phộng, sữa bò, trứng...">{$patient.food_allergies|default:''}</textarea>
              </div>
              
              <div class="form-group">
                <label>Dị ứng môi trường / Khác</label>
                <textarea name="other_allergies" class="form-control" rows="2" placeholder="VD: Phấn hoa, lông chó mèo, cao su latex, bụi nhà...">{$patient.other_allergies|default:''}</textarea>
              </div>
              
              <div style="text-align: right; margin-top: 1.5rem;">
                <button type="submit" class="btn-primary" style="background: #d97706;">
                  <i class="fa-solid fa-floppy-disk"></i> Cập nhật thông tin dị ứng
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>

      <div class="settings-pane" id="tab-security">
        <form action="{$BASE_URL}/?page=profile" method="POST" id="pwForm">
          <input type="hidden" name="tab" value="security">
          <div class="dashboard-card">
            <div class="dashboard-card__header">
              <h3><i class="fa-solid fa-lock" style="color:#64748b;"></i> Đổi mật khẩu bảo mật</h3>
            </div>
            <div class="dashboard-card__body">
              
              <div class="form-group">
                <label>Mật khẩu hiện tại <span class="required">*</span></label>
                <div class="input-icon-wrap">
                  <i class="fa-solid fa-lock left-icon"></i>
                  <input type="password" name="current_password" id="pw0" class="form-control" required placeholder="Nhập mật khẩu đang sử dụng">
                  <button type="button" class="input-toggle-pw" onclick="togglePw('pw0',this)"><i class="fa-regular fa-eye"></i></button>
                </div>
              </div>
              
              <div class="form-group">
                <label>Mật khẩu mới <span class="required">*</span></label>
                <div class="input-icon-wrap">
                  <i class="fa-solid fa-key left-icon"></i>
                  <input type="password" name="new_password" id="pw1" class="form-control" required minlength="8" placeholder="Tối thiểu 8 ký tự">
                  <button type="button" class="input-toggle-pw" onclick="togglePw('pw1',this)"><i class="fa-regular fa-eye"></i></button>
                </div>
              </div>
              
              <div class="form-group" style="margin-bottom: 0.5rem;">
                <label>Xác nhận mật khẩu mới <span class="required">*</span></label>
                <div class="input-icon-wrap">
                  <i class="fa-solid fa-key left-icon"></i>
                  <input type="password" name="confirm_password" id="pw2" class="form-control" required placeholder="Nhập lại mật khẩu mới">
                  <button type="button" class="input-toggle-pw" onclick="togglePw('pw2',this)"><i class="fa-regular fa-eye"></i></button>
                </div>
              </div>
              
              <div id="pwMatchMsg" style="font-size: 0.9rem; margin-bottom: 2rem; font-weight: 500; min-height: 20px;"></div>
              
              <div style="text-align: right;">
                <button type="submit" class="btn-primary" style="background: #0f172a;">
                  <i class="fa-solid fa-shield-halved"></i> Cập nhật mật khẩu
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>

{include file="layout/footer.tpl"}

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
    msg.style.color = '#ef4444'; // Đỏ
  } else if (pw2.value) {
    msg.textContent = '✓ Mật khẩu khớp hợp lệ';
    msg.style.color = '#16a34a'; // Xanh
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
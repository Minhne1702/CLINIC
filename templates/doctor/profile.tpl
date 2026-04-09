{include file="layout/sidebar.tpl" page_title="Hồ sơ cá nhân" active_page="profile"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-id-card"></i> Hồ sơ cá nhân</h2>
    <p class="page-subtitle">Quản lý thông tin cá nhân, bằng cấp và bảo mật tài khoản</p>
  </div>
</div>

{* Hiển thị thông báo thành công hoặc lỗi *}
{if $success_message}
  <div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>
{/if}
{if $error_message}
  <div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>
{/if}

{* Layout chia 2 cột *}
<div style="display: grid; grid-template-columns: 300px 1fr; gap: 24px; align-items: start;">

  <div class="admin-card">
    <div class="admin-card__body" style="text-align: center; padding: 30px 20px;">
      
      {* Avatar *}
      <div style="width: 100px; height: 100px; border-radius: 50%; background-color: #e2e8f0; color: #475569; font-size: 36px; display: flex; align-items: center; justify-content: center; margin: 0 auto 15px; font-weight: bold;">
        {$current_user_name|default:"?"|truncate:1:""}
      </div>
      
      <h3 style="margin: 0 0 5px; font-size: 18px; color: #1e293b;">{$doctor.full_name|default:$current_user_name}</h3>
      <p style="margin: 0 0 15px; color: #64748b; font-size: 14px;">
        <i class="fa-solid fa-user-doctor"></i> Bác sĩ {if !empty($doctor.specialty)} - {$doctor.specialty}{/if}
      </p>

      <div style="border-top: 1px solid #e2e8f0; margin: 20px 0;"></div>

      <ul style="list-style: none; padding: 0; margin: 0; text-align: left; font-size: 14px; color: #475569; line-height: 2;">
        <li><i class="fa-solid fa-phone" style="width: 20px; color: #94a3b8;"></i> {$doctor.phone|default:'Chưa cập nhật'}</li>
        <li><i class="fa-solid fa-envelope" style="width: 20px; color: #94a3b8;"></i> {$doctor.email|default:'Chưa cập nhật'}</li>
        <li><i class="fa-solid fa-certificate" style="width: 20px; color: #94a3b8;"></i> CCHN: {$doctor.license_number|default:'Chưa cập nhật'}</li>
      </ul>
    </div>
  </div>

  <div style="display: flex; flex-direction: column; gap: 24px;">

    <div class="admin-card">
      <div class="admin-card__header">
        <h3><i class="fa-solid fa-user-pen"></i> Chỉnh sửa thông tin</h3>
      </div>
      <div class="admin-card__body">
        <form action="{$BASE_URL}/?page=profile&action=update_info" method="POST">
          
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
            <div class="form-group">
              <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
              <input type="text" name="full_name" class="form-control" value="{$doctor.full_name|default:$current_user_name}" required>
            </div>
            <div class="form-group">
              <label class="form-label">Giới tính</label>
              <select name="gender" class="form-control">
                <option value="Nam" {if ($doctor.gender|default:'') == 'Nam'}selected{/if}>Nam</option>
                <option value="Nữ" {if ($doctor.gender|default:'') == 'Nữ'}selected{/if}>Nữ</option>
              </select>
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
            <div class="form-group">
              <label class="form-label">Số điện thoại</label>
              <input type="text" name="phone" class="form-control" value="{$doctor.phone|default:''}">
            </div>
            <div class="form-group">
              <label class="form-label">Email (Tài khoản đăng nhập)</label>
              <input type="email" class="form-control" value="{$doctor.email|default:''}" disabled style="background-color: #f8fafc; cursor: not-allowed;">
              <small class="text-muted">Không thể thay đổi email đăng nhập.</small>
            </div>
          </div>

          <div style="border-top: 1px dashed #e2e8f0; margin: 20px 0;"></div>
          <h4 style="margin-bottom: 15px; font-size: 15px; color: #334155;">Thông tin chuyên môn</h4>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
            <div class="form-group">
              <label class="form-label">Chuyên khoa</label>
              <input type="text" name="specialty" class="form-control" value="{$doctor.specialty|default:''}" placeholder="VD: Nội tổng hợp, Răng Hàm Mặt...">
            </div>
            <div class="form-group">
              <label class="form-label">Học hàm / Học vị</label>
              <input type="text" name="degree" class="form-control" value="{$doctor.degree|default:''}" placeholder="VD: ThS.BS, CKII...">
            </div>
          </div>

          <div class="form-group" style="margin-bottom: 15px;">
            <label class="form-label">Giới thiệu bản thân / Kinh nghiệm công tác</label>
            <textarea name="bio" class="form-control" rows="4" placeholder="Nhập một vài dòng giới thiệu để bệnh nhân hiểu thêm về bạn...">{$doctor.bio|default:''}</textarea>
          </div>

          <div class="form-actions" style="text-align: right; margin-top: 20px;">
            <button type="submit" class="btn btn--primary"><i class="fa-solid fa-floppy-disk"></i> Lưu thông tin</button>
          </div>
        </form>
      </div>
    </div>

    <div class="admin-card">
      <div class="admin-card__header">
        <h3><i class="fa-solid fa-shield-halved"></i> Đổi mật khẩu</h3>
      </div>
      <div class="admin-card__body">
        <form action="{$BASE_URL}/?page=profile&action=change_password" method="POST">
          
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
            <div class="form-group">
              <label class="form-label">Mật khẩu hiện tại <span class="text-danger">*</span></label>
              <input type="password" name="current_password" class="form-control" required placeholder="Nhập mật khẩu cũ">
            </div>
          </div>

          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 15px;">
            <div class="form-group">
              <label class="form-label">Mật khẩu mới <span class="text-danger">*</span></label>
              <input type="password" name="new_password" class="form-control" required placeholder="Mật khẩu ít nhất 6 ký tự">
            </div>
            <div class="form-group">
              <label class="form-label">Xác nhận mật khẩu mới <span class="text-danger">*</span></label>
              <input type="password" name="confirm_password" class="form-control" required placeholder="Nhập lại mật khẩu mới">
            </div>
          </div>

          <div class="form-actions" style="text-align: right; margin-top: 10px;">
            <button type="submit" class="btn" style="background-color: #64748b; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
              <i class="fa-solid fa-key"></i> Cập nhật mật khẩu
            </button>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>

{include file="layout/footer.tpl"}
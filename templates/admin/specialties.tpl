{include file="layout/sidebar.tpl" page_title="Quản lý chuyên khoa" active_page="specialties"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-stethoscope"></i> Chuyên khoa</h2>
    <p class="page-subtitle">Quản lý danh mục chuyên khoa y tế</p>
  </div>
  <div class="page-toolbar__right">
    <button class="btn-admin-primary" onclick="openModal('modalSpecialty')">
      <i class="fa-solid fa-plus"></i> Thêm chuyên khoa
    </button>
  </div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}

<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Icon</th>
          <th>Tên chuyên khoa</th>
          <th>Mô tả</th>
          <th>Số bác sĩ</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$specialties item=spec}
        <tr>
          <td><div class="spec-icon-preview" style="background:rgba(8,145,178,.1);color:#0891b2;width:36px;height:36px;border-radius:8px;display:flex;align-items:center;justify-content:center"><i class="{$spec.icon|default:'fa-solid fa-stethoscope'}"></i></div></td>
          <td><strong>{$spec.name}</strong></td>
          <td><span class="text-muted" style="font-size:13px">{$spec.description|truncate:60:'...'|default:'—'}</span></td>
          <td><span class="badge badge--blue">{$spec.doctor_count|default:0} BS</span></td>
          <td>{if $spec.is_active}<span class="badge badge--success">Hoạt động</span>{else}<span class="badge badge--danger">Ẩn</span>{/if}</td>
          <td>
            <div class="table-actions">
              <button class="action-btn" onclick="editSpecialty('{$spec._id}')" title="Sửa"><i class="fa-solid fa-pen"></i></button>
              <a href="{$BASE_URL}/?role=admin&page=specialties&action=toggle&id={$spec._id}" class="action-btn" title="Bật/Tắt"><i class="fa-solid fa-power-off"></i></a>
              <a href="{$BASE_URL}/?role=admin&page=specialties&action=delete&id={$spec._id}" class="action-btn action-btn--danger" title="Xóa" onclick="return confirm('Xóa chuyên khoa này?')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
        {foreachelse}
        <tr><td colspan="6" class="table-empty">Chưa có chuyên khoa nào</td></tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>

<!-- Modal thêm/sửa chuyên khoa -->
<div class="modal-overlay" id="modalSpecialty">
  <div class="modal">
    <div class="modal__header">
      <h3 id="modalSpecialtyTitle">Thêm chuyên khoa</h3>
      <button class="modal__close" onclick="closeModal('modalSpecialty')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <form action="{$BASE_URL}/" method="POST" class="modal__body">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="specialties">
      <input type="hidden" name="action" value="save">
      <input type="hidden" name="id" id="spec_id" value="">
      <div class="form-group">
        <label>Tên chuyên khoa <span class="required">*</span></label>
        <input type="text" name="name" id="spec_name" placeholder="VD: Tim mạch" required>
      </div>
      <div class="form-group">
        <label>Icon (Font Awesome class)</label>
        <input type="text" name="icon" id="spec_icon" placeholder="VD: fa-solid fa-heart">
      </div>
      <div class="form-group">
        <label>Mô tả</label>
        <textarea name="description" id="spec_desc" rows="3" placeholder="Mô tả ngắn về chuyên khoa..."></textarea>
      </div>
      <div class="form-group">
        <label class="checkbox-label">
          <input type="checkbox" name="is_active" id="spec_active" checked> Hiển thị
        </label>
      </div>
      <div class="modal__footer">
        <button type="button" class="btn-admin-ghost" onclick="closeModal('modalSpecialty')">Hủy</button>
        <button type="submit" class="btn-admin-primary">Lưu</button>
      </div>
    </form>
  </div>
</div>

{include file="layout/footer.tpl"}
<script>
function editSpecialty(id) {
  document.getElementById('modalSpecialtyTitle').textContent = 'Sửa chuyên khoa';
  document.getElementById('spec_id').value = id;
  openModal('modalSpecialty');
}
</script>

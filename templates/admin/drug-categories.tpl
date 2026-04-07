{include file="layout/sidebar.tpl" page_title="Nhóm thuốc" active_page="drug-categories"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-layer-group"></i> Nhóm thuốc</h2>
    <p class="page-subtitle">Phân loại thuốc theo nhóm dược lý</p>
  </div>
  <div class="page-toolbar__right">
    <button class="btn-admin-primary" onclick="openModal('modalDrugCat')">
      <i class="fa-solid fa-plus"></i> Thêm nhóm
    </button>
  </div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}

<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Mã nhóm</th>
          <th>Tên nhóm thuốc</th>
          <th>Mô tả</th>
          <th>Số loại thuốc</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$drug_categories item=cat}
        <tr>
          <td><span class="code-tag">{$cat.code|default:'—'}</span></td>
          <td><strong>{$cat.name}</strong></td>
          <td><span class="text-muted" style="font-size:13px">{$cat.description|truncate:60:'...'|default:'—'}</span></td>
          <td><span class="badge badge--blue">{$cat.drug_count|default:0} thuốc</span></td>
          <td>{if $cat.is_active}<span class="badge badge--success">Hoạt động</span>{else}<span class="badge badge--danger">Ẩn</span>{/if}</td>
          <td>
            <div class="table-actions">
              <button class="action-btn" onclick="editCat('{$cat._id}','{$cat.name}','{$cat.code}','{$cat.description}')" title="Sửa"><i class="fa-solid fa-pen"></i></button>
              <a href="{$base_url}/?role=admin&page=drug-categories&action=toggle&id={$cat._id}" class="action-btn" title="Bật/Tắt"><i class="fa-solid fa-power-off"></i></a>
              <a href="{$base_url}/?role=admin&page=drug-categories&action=delete&id={$cat._id}" class="action-btn action-btn--danger" title="Xóa" onclick="return confirm('Xóa nhóm thuốc này?')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
        {foreachelse}
        <tr><td colspan="6" class="table-empty">Chưa có nhóm thuốc nào</td></tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>

<div class="modal-overlay" id="modalDrugCat">
  <div class="modal">
    <div class="modal__header">
      <h3 id="modalDrugCatTitle">Thêm nhóm thuốc</h3>
      <button class="modal__close" onclick="closeModal('modalDrugCat')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <form action="{$base_url}/" method="POST" class="modal__body">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="drug-categories">
      <input type="hidden" name="action" value="save">
      <input type="hidden" name="id" id="cat_id" value="">
      <div class="form-row-2">
        <div class="form-group">
          <label>Mã nhóm <span class="required">*</span></label>
          <input type="text" name="code" id="cat_code" placeholder="VD: ANTIBIOTIC" required>
        </div>
        <div class="form-group">
          <label>Tên nhóm <span class="required">*</span></label>
          <input type="text" name="name" id="cat_name" placeholder="VD: Kháng sinh" required>
        </div>
      </div>
      <div class="form-group">
        <label>Mô tả</label>
        <textarea name="description" id="cat_desc" rows="3" placeholder="Mô tả nhóm thuốc..."></textarea>
      </div>
      <div class="modal__footer">
        <button type="button" class="btn-admin-ghost" onclick="closeModal('modalDrugCat')">Hủy</button>
        <button type="submit" class="btn-admin-primary">Lưu</button>
      </div>
    </form>
  </div>
</div>

{include file="layout/footer.tpl"}
<script>
function editCat(id, name, code, desc) {
  document.getElementById('modalDrugCatTitle').textContent = 'Sửa nhóm thuốc';
  document.getElementById('cat_id').value = id;
  document.getElementById('cat_name').value = name;
  document.getElementById('cat_code').value = code;
  document.getElementById('cat_desc').value = desc;
  openModal('modalDrugCat');
}
</script>

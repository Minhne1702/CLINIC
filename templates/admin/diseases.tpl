{include file="layout/sidebar.tpl" page_title="Quản lý bệnh (ICD-10)" active_page="diseases"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-virus"></i> Danh mục bệnh (ICD-10)</h2>
    <p class="page-subtitle">Chuẩn hóa dữ liệu bệnh dùng toàn hệ thống</p>
  </div>
  <div class="page-toolbar__right">
    <button class="btn-admin-secondary" onclick="openModal('modalImport')">
      <i class="fa-solid fa-file-import"></i> Import ICD-10
    </button>
    <button class="btn-admin-primary" onclick="openModal('modalDisease')">
      <i class="fa-solid fa-plus"></i> Thêm bệnh
    </button>
  </div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}

<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="{$base_url}/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="diseases">
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Mã ICD, tên bệnh..." value="{$filter.q|default:''}">
        </div>
        <select name="group">
          <option value="">Tất cả nhóm</option>
          {foreach from=$disease_groups item=g}
          <option value="{$g._id}" {if $filter.group == $g._id}selected{/if}>{$g.name}</option>
          {/foreach}
        </select>
        <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
      </div>
    </form>
  </div>
</div>

<div class="admin-card">
  <div class="admin-card__body p-0">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Mã ICD-10</th>
          <th>Tên bệnh</th>
          <th>Nhóm bệnh</th>
          <th>Triệu chứng phổ biến</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$diseases item=d}
        <tr>
          <td><span class="code-tag code-tag--blue">{$d.icd_code}</span></td>
          <td><strong>{$d.name}</strong></td>
          <td>{$d.group_name|default:'—'}</td>
          <td><span class="text-muted" style="font-size:12px">{$d.symptoms|truncate:50:'...'|default:'—'}</span></td>
          <td>{if $d.is_active}<span class="badge badge--success">Hoạt động</span>{else}<span class="badge badge--danger">Ẩn</span>{/if}</td>
          <td>
            <div class="table-actions">
              <button class="action-btn" onclick="editDisease('{$d._id}')" title="Sửa"><i class="fa-solid fa-pen"></i></button>
              <a href="{$base_url}/?role=admin&page=diseases&action=delete&id={$d._id}" class="action-btn action-btn--danger" title="Xóa" onclick="return confirm('Xóa bệnh này?')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
        {foreachelse}
        <tr><td colspan="6" class="table-empty">Chưa có dữ liệu bệnh</td></tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>

<!-- Modal thêm/sửa bệnh -->
<div class="modal-overlay" id="modalDisease">
  <div class="modal">
    <div class="modal__header">
      <h3 id="modalDiseaseTitle">Thêm bệnh</h3>
      <button class="modal__close" onclick="closeModal('modalDisease')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <form action="{$base_url}/" method="POST" class="modal__body">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="diseases">
      <input type="hidden" name="action" value="save">
      <input type="hidden" name="id" id="disease_id" value="">
      <div class="form-row-2">
        <div class="form-group">
          <label>Mã ICD-10 <span class="required">*</span></label>
          <input type="text" name="icd_code" id="disease_code" placeholder="VD: J06.9" required>
        </div>
        <div class="form-group">
          <label>Nhóm bệnh</label>
          <select name="group_id">
            <option value="">-- Chọn nhóm --</option>
            {foreach from=$disease_groups item=g}
            <option value="{$g._id}">{$g.name}</option>
            {/foreach}
          </select>
        </div>
      </div>
      <div class="form-group">
        <label>Tên bệnh <span class="required">*</span></label>
        <input type="text" name="name" id="disease_name" placeholder="VD: Viêm đường hô hấp trên cấp tính" required>
      </div>
      <div class="form-group">
        <label>Triệu chứng phổ biến</label>
        <textarea name="symptoms" rows="3" placeholder="Sốt, ho, chảy mũi..."></textarea>
      </div>
      <div class="form-group">
        <label>Mô tả</label>
        <textarea name="description" rows="2" placeholder="Mô tả thêm..."></textarea>
      </div>
      <div class="modal__footer">
        <button type="button" class="btn-admin-ghost" onclick="closeModal('modalDisease')">Hủy</button>
        <button type="submit" class="btn-admin-primary">Lưu</button>
      </div>
    </form>
  </div>
</div>

{include file="layout/footer.tpl"}
<script>
function editDisease(id) {
  document.getElementById('modalDiseaseTitle').textContent = 'Sửa bệnh';
  document.getElementById('disease_id').value = id;
  openModal('modalDisease');
}
</script>

{include file="layout/sidebar.tpl" page_title="Quản lý thuốc" active_page="drugs"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-pills"></i> Danh mục thuốc</h2>
    <p class="page-subtitle">Quản lý thông tin thuốc và cảnh báo tương tác</p>
  </div>
  <div class="page-toolbar__right">
    <button class="btn-admin-primary" onclick="openModal('modalDrug')">
      <i class="fa-solid fa-plus"></i> Thêm thuốc
    </button>
  </div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}

<!-- Low stock alert -->
{if $low_stock_count > 0}
<div class="alert alert--warning mb-1">
  <i class="fa-solid fa-triangle-exclamation"></i>
  Có <strong>{$low_stock_count}</strong> loại thuốc sắp hết hàng.
  <a href="{$base_url}/?role=admin&page=drugs&filter=low-stock">Xem ngay</a>
</div>
{/if}

<div class="admin-card mb-1">
  <div class="admin-card__body">
    <form method="GET" action="{$base_url}/" class="filter-bar">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="drugs">
      <div class="filter-bar__group">
        <div class="filter-input">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" name="q" placeholder="Tên thuốc, hoạt chất..." value="{$filter.q|default:''}">
        </div>
        <select name="category">
          <option value="">Tất cả nhóm</option>
          {foreach from=$drug_categories item=cat}
          <option value="{$cat._id}" {if $filter.category == $cat._id}selected{/if}>{$cat.name}</option>
          {/foreach}
        </select>
        <select name="stock_status">
          <option value="">Tồn kho</option>
          <option value="ok"       {if $filter.stock_status == 'ok'}selected{/if}>Đủ hàng</option>
          <option value="low"      {if $filter.stock_status == 'low'}selected{/if}>Sắp hết</option>
          <option value="out"      {if $filter.stock_status == 'out'}selected{/if}>Hết hàng</option>
          <option value="expiring" {if $filter.stock_status == 'expiring'}selected{/if}>Sắp hết hạn</option>
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
          <th>Tên thuốc</th>
          <th>Hoạt chất</th>
          <th>Nhóm thuốc</th>
          <th>Dạng bào chế</th>
          <th>Đơn vị</th>
          <th>Tồn kho</th>
          <th>Hạn dùng</th>
          <th>Cảnh báo</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$drugs item=drug}
        <tr>
          <td><strong>{$drug.name}</strong></td>
          <td><span class="text-muted">{$drug.active_ingredient|default:'—'}</span></td>
          <td>{$drug.category_name|default:'—'}</td>
          <td>{$drug.dosage_form|default:'—'}</td>
          <td>{$drug.unit|default:'—'}</td>
          <td>
            {if $drug.stock_qty <= 0}
              <span class="badge badge--danger">Hết hàng</span>
            {elseif $drug.stock_qty <= $drug.min_qty}
              <span class="badge badge--warning">{$drug.stock_qty} (thấp)</span>
            {else}
              <span class="badge badge--success">{$drug.stock_qty}</span>
            {/if}
          </td>
          <td>
            {if $drug.expiry_date}
              <span class="{if $drug.is_expiring}text-danger{else}text-muted{/if}" style="font-size:12px">
                {$drug.expiry_date|date_format:"%d/%m/%Y"}
              </span>
            {else}—{/if}
          </td>
          <td>
            {if $drug.side_effects}<span class="badge badge--warning" title="{$drug.side_effects}"><i class="fa-solid fa-triangle-exclamation"></i></span>{/if}
            {if $drug.contraindications}<span class="badge badge--danger" title="{$drug.contraindications}"><i class="fa-solid fa-ban"></i></span>{/if}
          </td>
          <td>
            <div class="table-actions">
              <button class="action-btn" onclick="editDrug('{$drug._id}')" title="Sửa"><i class="fa-solid fa-pen"></i></button>
              <a href="{$base_url}/?role=admin&page=drugs&action=delete&id={$drug._id}" class="action-btn action-btn--danger" title="Xóa" onclick="return confirm('Xóa thuốc này?')"><i class="fa-solid fa-trash"></i></a>
            </div>
          </td>
        </tr>
        {foreachelse}
        <tr><td colspan="9" class="table-empty">Chưa có thuốc nào</td></tr>
        {/foreach}
      </tbody>
    </table>
  </div>
</div>

<!-- Modal thêm/sửa thuốc -->
<div class="modal-overlay" id="modalDrug">
  <div class="modal modal--lg">
    <div class="modal__header">
      <h3 id="modalDrugTitle">Thêm thuốc</h3>
      <button class="modal__close" onclick="closeModal('modalDrug')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <form action="{$base_url}/" method="POST" class="modal__body">
      <input type="hidden" name="role" value="admin">
      <input type="hidden" name="page" value="drugs">
      <input type="hidden" name="action" value="save">
      <input type="hidden" name="id" id="drug_id" value="">
      <div class="form-row-2">
        <div class="form-group">
          <label>Tên thuốc <span class="required">*</span></label>
          <input type="text" name="name" placeholder="VD: Amoxicillin 500mg" required>
        </div>
        <div class="form-group">
          <label>Hoạt chất</label>
          <input type="text" name="active_ingredient" placeholder="VD: Amoxicillin">
        </div>
      </div>
      <div class="form-row-2">
        <div class="form-group">
          <label>Nhóm thuốc</label>
          <select name="category_id">
            <option value="">-- Chọn nhóm --</option>
            {foreach from=$drug_categories item=cat}
            <option value="{$cat._id}">{$cat.name}</option>
            {/foreach}
          </select>
        </div>
        <div class="form-group">
          <label>Dạng bào chế</label>
          <select name="dosage_form">
            <option value="tablet">Viên nén</option>
            <option value="capsule">Viên nang</option>
            <option value="syrup">Siro</option>
            <option value="injection">Tiêm</option>
            <option value="cream">Kem/Mỡ</option>
            <option value="drop">Nhỏ giọt</option>
          </select>
        </div>
      </div>
      <div class="form-row-2">
        <div class="form-group">
          <label>Hàm lượng</label>
          <input type="text" name="concentration" placeholder="VD: 500mg">
        </div>
        <div class="form-group">
          <label>Đơn vị tính <span class="required">*</span></label>
          <select name="unit" required>
            <option value="vien">Viên</option>
            <option value="chai">Chai</option>
            <option value="ong">Ống</option>
            <option value="goi">Gói</option>
            <option value="hop">Hộp</option>
          </select>
        </div>
      </div>
      <div class="form-row-2">
        <div class="form-group">
          <label>Số lượng tồn kho</label>
          <input type="number" name="stock_qty" placeholder="0" min="0">
        </div>
        <div class="form-group">
          <label>Cảnh báo tồn kho tối thiểu</label>
          <input type="number" name="min_qty" placeholder="10" min="0">
        </div>
      </div>
      <div class="form-row-2">
        <div class="form-group">
          <label>Số lô</label>
          <input type="text" name="lot_number" placeholder="VD: LOT2024001">
        </div>
        <div class="form-group">
          <label>Hạn sử dụng</label>
          <input type="date" name="expiry_date">
        </div>
      </div>
      <div class="form-group">
        <label>Tác dụng phụ</label>
        <textarea name="side_effects" rows="2" placeholder="Buồn nôn, tiêu chảy..."></textarea>
      </div>
      <div class="form-group">
        <label>Chống chỉ định</label>
        <textarea name="contraindications" rows="2" placeholder="Dị ứng Penicillin..."></textarea>
      </div>
      <div class="modal__footer">
        <button type="button" class="btn-admin-ghost" onclick="closeModal('modalDrug')">Hủy</button>
        <button type="submit" class="btn-admin-primary">Lưu thuốc</button>
      </div>
    </form>
  </div>
</div>

{include file="layout/footer.tpl"}
<script>
function editDrug(id) {
  document.getElementById('modalDrugTitle').textContent = 'Sửa thuốc';
  document.getElementById('drug_id').value = id;
  openModal('modalDrug');
}
</script>

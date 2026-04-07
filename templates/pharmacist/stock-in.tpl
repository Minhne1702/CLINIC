{include file="layout/sidebar.tpl" page_title="Nhập kho" active_page="stock-in"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-truck-ramp-box"></i> Nhập kho thuốc</h2><p class="page-subtitle">Ghi nhận thuốc nhập về kho</p></div>
  <div class="page-toolbar__right"><a href="{$base_url}/?role=pharmacist&page=inventory" class="btn-admin-ghost"><i class="fa-solid fa-arrow-left"></i> Tồn kho</a></div>
</div>
{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}
{if $error_message}<div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>{/if}
<div class="admin-card">
  <div class="admin-card__header"><h3>Phiếu nhập kho</h3></div>
  <div class="admin-card__body">
    <form action="{$base_url}/" method="POST" class="appt-form">
      <input type="hidden" name="role" value="pharmacist"><input type="hidden" name="page" value="stock-in"><input type="hidden" name="action" value="save">
      <div class="form-row-2">
        <div class="form-group"><label>Nhà cung cấp</label><input type="text" name="supplier" placeholder="Tên nhà cung cấp" value="{$form.supplier|default:''}"></div>
        <div class="form-group"><label>Ngày nhập <span class="required">*</span></label><input type="date" name="import_date" value="{$smarty.now|date_format:'%Y-%m-%d'}" required></div>
      </div>
      <div class="form-group"><label>Ghi chú</label><input type="text" name="note" placeholder="Ghi chú phiếu nhập..."></div>

      <div style="margin-top:1.5rem">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem">
          <label style="font-size:13px;font-weight:600">Danh sách thuốc nhập <span class="required">*</span></label>
          <button type="button" class="btn-admin-secondary" onclick="addStockRow()"><i class="fa-solid fa-plus"></i> Thêm thuốc</button>
        </div>
        <table class="admin-table" id="stockTable">
          <thead><tr><th>Tên thuốc</th><th>Số lô</th><th>Hạn sử dụng</th><th>Số lượng nhập</th><th>Đơn vị</th><th>Đơn giá</th><th></th></tr></thead>
          <tbody id="stockRows">
            <tr id="emptyStockRow"><td colspan="7" class="table-empty">Chưa có thuốc. Nhấn "Thêm thuốc" để bắt đầu.</td></tr>
          </tbody>
        </table>
      </div>
      <div style="display:flex;gap:.75rem;margin-top:1.5rem">
        <button type="submit" class="btn-admin-primary"><i class="fa-solid fa-floppy-disk"></i> Lưu phiếu nhập kho</button>
        <a href="{$base_url}/?role=pharmacist&page=inventory" class="btn-admin-ghost">Hủy</a>
      </div>
    </form>
  </div>
</div>
{include file="layout/footer.tpl"}
<script>
const drugOptions = {$drug_options_json|default:'[]'};
function addStockRow() {
  document.getElementById('emptyStockRow')?.remove();
  const tbody = document.getElementById('stockRows');
  const tr = document.createElement('tr');
  tr.innerHTML = `
    <td><select name="drug_id[]" style="width:200px"><option value="">-- Chọn thuốc --</option>${drugOptions.map(d=>`<option value="${d._id}">${d.name}</option>`).join('')}</select></td>
    <td><input type="text" name="lot_number[]" placeholder="LOT001" style="width:90px"></td>
    <td><input type="date" name="expiry_date[]" style="width:140px"></td>
    <td><input type="number" name="qty[]" placeholder="100" min="1" style="width:80px" required></td>
    <td><select name="unit[]" style="width:70px"><option value="vien">Viên</option><option value="chai">Chai</option><option value="ong">Ống</option><option value="goi">Gói</option><option value="hop">Hộp</option></select></td>
    <td><input type="number" name="unit_price[]" placeholder="5000" min="0" style="width:100px"></td>
    <td><button type="button" class="action-btn action-btn--danger" onclick="this.closest('tr').remove()"><i class="fa-solid fa-trash"></i></button></td>
  `;
  tbody.appendChild(tr);
}
</script>

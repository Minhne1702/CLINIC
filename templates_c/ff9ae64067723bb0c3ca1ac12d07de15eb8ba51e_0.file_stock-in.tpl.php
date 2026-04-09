<?php
/* Smarty version 5.8.0, created on 2026-04-09 08:29:30
  from 'file:pharmacist/stock-in.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_69d7636ac20b58_74703412',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ff9ae64067723bb0c3ca1ac12d07de15eb8ba51e' => 
    array (
      0 => 'pharmacist/stock-in.tpl',
      1 => 1775721250,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout/sidebar.tpl' => 1,
    'file:layout/footer.tpl' => 1,
  ),
))) {
function content_69d7636ac20b58_74703412 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\Users\\THANH TRI\\CLINIC\\templates\\pharmacist';
$_smarty_tpl->renderSubTemplate("file:layout/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('page_title'=>"Nhập kho",'active_page'=>"stock-in"), (int) 0, $_smarty_current_dir);
?>

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-truck-ramp-box"></i> Nhập kho thuốc</h2>
    <p class="page-subtitle">Ghi nhận thuốc nhập về kho</p>
  </div>
  <div class="page-toolbar__right">
    <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=inventory" class="btn-admin-ghost"><i class="fa-solid fa-arrow-left"></i> Tồn kho</a>
  </div>
</div>

<?php if ($_smarty_tpl->getValue('success_message')) {?><div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> <?php echo $_smarty_tpl->getValue('success_message');?>
</div><?php }
if ($_smarty_tpl->getValue('error_message')) {?><div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> <?php echo $_smarty_tpl->getValue('error_message');?>
</div><?php }?>

<div class="admin-card">
  <div class="admin-card__header"><h3>Phiếu nhập kho</h3></div>
  <div class="admin-card__body">
    <form action="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=stock-in" method="POST" class="appt-form">
      <input type="hidden" name="action" value="save">
      
      <div class="form-row-2">
        <div class="form-group">
          <label>Nhà cung cấp</label>
          <input type="text" name="supplier" placeholder="Tên nhà cung cấp" value="<?php echo (($tmp = $_smarty_tpl->getValue('form')['supplier'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        </div>
        <div class="form-group">
          <label>Ngày nhập <span class="required">*</span></label>
          <input type="date" name="import_date" value="<?php echo (($tmp = $_smarty_tpl->getValue('form')['import_date'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
" required>
        </div>
      </div>
      
      <div class="form-group">
        <label>Ghi chú</label>
        <input type="text" name="note" placeholder="Ghi chú phiếu nhập..." value="<?php echo (($tmp = $_smarty_tpl->getValue('form')['note'] ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
      </div>

      <div style="margin-top:1.5rem">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:.75rem">
          <label style="font-size:13px;font-weight:600">Danh sách thuốc nhập <span class="required">*</span></label>
          <button type="button" class="btn-admin-secondary" onclick="addStockRow()"><i class="fa-solid fa-plus"></i> Thêm thuốc</button>
        </div>
        
        <table class="admin-table" id="stockTable">
          <thead>
            <tr>
              <th>Tên thuốc</th>
              <th>Số lô</th>
              <th>Hạn sử dụng</th>
              <th>Số lượng nhập</th>
              <th>Đơn vị</th>
              <th>Đơn giá</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="stockRows">
            <tr id="emptyStockRow">
              <td colspan="7" class="table-empty">Chưa có thuốc. Nhấn "Thêm thuốc" để bắt đầu.</td>
            </tr>
          </tbody>
        </table>
      </div>

      <div style="display:flex;gap:.75rem;margin-top:1.5rem">
        <button type="submit" class="btn-admin-primary"><i class="fa-solid fa-floppy-disk"></i> Lưu phiếu nhập kho</button>
        <a href="<?php echo $_smarty_tpl->getValue('BASE_URL');?>
/?role=pharmacist&page=inventory" class="btn-admin-ghost">Hủy</a>
      </div>
    </form>
  </div>
</div>

<?php echo '<script'; ?>
>
/**
 * Đặt các biến Smarty ra ngoài literal để được biên dịch
 */
const drugOptions = <?php echo (($tmp = $_smarty_tpl->getValue('drug_options_json') ?? null)===null||$tmp==='' ? '[]' ?? null : $tmp);?>
;
const preselectedDrugId = '<?php echo (($tmp = $_smarty_tpl->getValue('preselected_drug_id') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
';


/**
 * Sử dụng literal bao bọc toàn bộ code JS có chứa dấu { } và $
 */
function buildDrugSelect(selectedId) {
    const opts = drugOptions.map(d => {
        const dId = String(d._id);
        const sId = String(selectedId);
        return `<option value="${dId}"${dId === sId ? ' selected' : ''}>${d.name}</option>`;
    }).join('');
    
    return `<select name="drug_id[]" style="width:200px" required>
                <option value="">-- Chọn thuốc --</option>
                ${opts}
            </select>`;
}

function addStockRow(selectedId) {
    const emptyRow = document.getElementById('emptyStockRow');
    if (emptyRow) emptyRow.remove();

    const tbody = document.getElementById('stockRows');
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td>${buildDrugSelect(selectedId || '')}</td>
        <td><input type="text" name="lot_number[]" placeholder="LOT001" style="width:90px" required></td>
        <td><input type="date" name="expiry_date[]" style="width:140px" required></td>
        <td><input type="number" name="qty[]" placeholder="100" min="1" style="width:80px" required></td>
        <td>
            <select name="unit[]" style="width:70px">
                <option value="vien">Viên</option>
                <option value="chai">Chai</option>
                <option value="ong">Ống</option>
                <option value="goi">Gói</option>
                <option value="hop">Hộp</option>
            </select>
        </td>
        <td><input type="number" name="unit_price[]" placeholder="5000" min="0" style="width:100px" required></td>
        <td>
            <button type="button" class="action-btn action-btn--danger" onclick="this.closest('tr').remove()">
                <i class="fa-solid fa-trash"></i>
            </button>
        </td>
    `;
    tbody.appendChild(tr);
}

if (preselectedDrugId) {
    addStockRow(preselectedDrugId);
}

<?php echo '</script'; ?>
>

<?php $_smarty_tpl->renderSubTemplate("file:layout/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
}
}

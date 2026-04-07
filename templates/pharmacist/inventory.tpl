{include file="layout/sidebar.tpl" page_title="Tồn kho thuốc" active_page="inventory"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-boxes-stacking"></i> Tồn kho thuốc</h2><p class="page-subtitle">Theo dõi số lượng tồn kho và hạn sử dụng</p></div>
  <div class="page-toolbar__right">
    <a href="{$base_url}/?role=pharmacist&page=stock-in" class="btn-admin-primary"><i class="fa-solid fa-truck-ramp-box"></i> Nhập kho</a>
  </div>
</div>
{if $stats.low_stock > 0}<div class="alert alert--warning mb-1"><i class="fa-solid fa-triangle-exclamation"></i> <strong>{$stats.low_stock}</strong> loại thuốc tồn kho dưới mức tối thiểu. <a href="{$base_url}/?role=pharmacist&page=low-stock">Xem ngay</a></div>{/if}
{if $stats.expiring > 0}<div class="alert alert--danger mb-1"><i class="fa-regular fa-calendar-xmark"></i> <strong>{$stats.expiring}</strong> loại thuốc sắp hết hạn trong 30 ngày. <a href="{$base_url}/?role=pharmacist&page=expiring">Xem ngay</a></div>{/if}
<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="{$base_url}/" class="filter-bar">
    <input type="hidden" name="role" value="pharmacist"><input type="hidden" name="page" value="inventory">
    <div class="filter-bar__group">
      <div class="filter-input"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="q" placeholder="Tên thuốc, hoạt chất..." value="{$filter.q|default:''}"></div>
      <select name="category"><option value="">Tất cả nhóm</option>{foreach from=$drug_categories item=cat}<option value="{$cat._id}" {if $filter.category==$cat._id}selected{/if}>{$cat.name}</option>{/foreach}</select>
      <select name="stock_status">
        <option value="">Tất cả tồn kho</option>
        <option value="ok"       {if $filter.stock_status=='ok'}selected{/if}>Đủ hàng</option>
        <option value="low"      {if $filter.stock_status=='low'}selected{/if}>Sắp hết</option>
        <option value="out"      {if $filter.stock_status=='out'}selected{/if}>Hết hàng</option>
        <option value="expiring" {if $filter.stock_status=='expiring'}selected{/if}>Sắp hết hạn</option>
      </select>
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
    </div>
  </form>
</div></div>
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table">
    <thead><tr><th>Tên thuốc</th><th>Hoạt chất</th><th>Nhóm</th><th>Dạng bào chế</th><th>Đơn vị</th><th>Tồn kho</th><th>Hạn dùng</th><th>Cảnh báo</th><th>Thao tác</th></tr></thead>
    <tbody>
      {foreach from=$drugs item=drug}
      <tr>
        <td><strong>{$drug.name}</strong><br><small class="text-muted">Lô: {$drug.lot_number|default:'—'}</small></td>
        <td class="text-muted">{$drug.active_ingredient|default:'—'}</td>
        <td>{$drug.category_name|default:'—'}</td>
        <td>{$drug.dosage_form|default:'—'}</td>
        <td>{$drug.unit}</td>
        <td>
          {if $drug.stock_qty <= 0}<span class="badge badge--danger">Hết hàng</span>
          {elseif $drug.stock_qty <= $drug.min_qty}<span class="badge badge--warning">{$drug.stock_qty} (thấp)</span>
          {else}<span class="badge badge--success">{$drug.stock_qty}</span>{/if}
        </td>
        <td><span class="{if $drug.is_expiring}text-danger{else}text-muted{/if}" style="font-size:12px">{$drug.expiry_date|date_format:"%d/%m/%Y"|default:'—'}</span></td>
        <td>
          {if $drug.stock_qty <= 0}<span class="badge badge--danger" style="font-size:11px">Hết hàng</span>
          {elseif $drug.stock_qty <= $drug.min_qty}<span class="badge badge--warning" style="font-size:11px">Sắp hết</span>
          {elseif $drug.is_expiring}<span class="badge badge--danger" style="font-size:11px">Gần hết hạn</span>
          {else}<span class="badge badge--success" style="font-size:11px">OK</span>{/if}
        </td>
        <td><div class="table-actions">
          <a href="{$base_url}/?role=pharmacist&page=stock-in&drug_id={$drug._id}" class="action-btn" title="Nhập thêm"><i class="fa-solid fa-plus"></i></a>
          <a href="{$base_url}/?role=pharmacist&page=inventory&action=view&id={$drug._id}" class="action-btn" title="Lịch sử"><i class="fa-solid fa-clock-rotate-left"></i></a>
        </div></td>
      </tr>
      {foreachelse}<tr><td colspan="9" class="table-empty">Chưa có dữ liệu tồn kho</td></tr>
      {/foreach}
    </tbody>
  </table>
</div></div>
{include file="layout/footer.tpl"}

{include file="layout/sidebar.tpl" page_title="Thuốc sắp hết hạn" active_page="expiring"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-regular fa-calendar-xmark"></i> Thuốc sắp hết hạn</h2><p class="page-subtitle">Thuốc hết hạn trong 30 ngày tới</p></div>
</div>
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table">
    <thead><tr><th>Tên thuốc</th><th>Số lô</th><th>Tồn kho</th><th>Hạn dùng</th><th>Còn lại</th><th>Cảnh báo</th></tr></thead>
    <tbody>
      {foreach from=$expiring_drugs item=drug}
      <tr>
        <td><strong>{$drug.name}</strong><br><small class="text-muted">{$drug.active_ingredient|default:'—'}</small></td>
        <td><span class="code-tag">{$drug.lot_number|default:'—'}</span></td>
        <td>{$drug.stock_qty} {$drug.unit}</td>
        <td><strong class="text-danger">{$drug.expiry_date|date_format:"%d/%m/%Y"}</strong></td>
        <td>
          {if $drug.days_left <= 7}<span class="badge badge--danger">{$drug.days_left} ngày</span>
          {elseif $drug.days_left <= 15}<span class="badge badge--warning">{$drug.days_left} ngày</span>
          {else}<span class="badge badge--orange">{$drug.days_left} ngày</span>{/if}
        </td>
        <td>
          {if $drug.days_left <= 7}<span class="badge badge--danger"><i class="fa-solid fa-circle-exclamation"></i> Rất khẩn cấp</span>
          {elseif $drug.days_left <= 15}<span class="badge badge--warning">Khẩn cấp</span>
          {else}<span class="badge badge--orange">Cần xử lý</span>{/if}
        </td>
      </tr>
      {foreachelse}<tr><td colspan="6" class="table-empty">Không có thuốc nào sắp hết hạn ✓</td></tr>
      {/foreach}
    </tbody>
  </table>
</div></div>
{include file="layout/footer.tpl"}

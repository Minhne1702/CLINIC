{include file="layout/sidebar.tpl" page_title="Thuốc sắp hết" active_page="low-stock"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-triangle-exclamation"></i> Thuốc sắp hết hàng</h2><p class="page-subtitle">Cần nhập thêm để đảm bảo đủ thuốc phục vụ bệnh nhân</p></div>
  <div class="page-toolbar__right"><a href="/CLINIC/public/?role=pharmacist&page=stock-in" class="btn-admin-primary"><i class="fa-solid fa-truck-ramp-box"></i> Nhập kho ngay</a></div>
</div>
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table">
    <thead><tr><th>Tên thuốc</th><th>Nhóm</th><th>Tồn kho hiện tại</th><th>Mức tối thiểu</th><th>Cần nhập thêm</th><th>Thao tác</th></tr></thead>
    <tbody>
      {foreach from=$low_stock_drugs item=drug}
      <tr>
        <td><strong>{$drug.name}</strong><br><small class="text-muted">{$drug.active_ingredient|default:'—'}</small></td>
        <td>{$drug.category_name|default:'—'}</td>
        <td>
          {if $drug.stock_qty <= 0}<span class="badge badge--danger">Hết hàng (0)</span>
          {else}<span class="badge badge--warning">{$drug.stock_qty} {$drug.unit}</span>{/if}
        </td>
        <td>{$drug.min_qty} {$drug.unit}</td>
        <td><strong class="text-danger">{$drug.min_qty - $drug.stock_qty} {$drug.unit}</strong></td>
        <td><a href="/CLINIC/public/?role=pharmacist&page=stock-in&drug_id={$drug._id}" class="btn-admin-primary" style="font-size:12px;padding:.35rem .75rem"><i class="fa-solid fa-plus"></i> Nhập thêm</a></td>
      </tr>
      {foreachelse}<tr><td colspan="6" class="table-empty">Tất cả thuốc đều đủ hàng ✓</td></tr>
      {/foreach}
    </tbody>
  </table>
</div></div>
{include file="layout/footer.tpl"}

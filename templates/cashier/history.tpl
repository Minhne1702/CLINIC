{include file="layout/sidebar.tpl" page_title="Lịch sử thanh toán" active_page="history"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-clock-rotate-left"></i> Lịch sử thanh toán</h2><p class="page-subtitle">Tất cả giao dịch đã hoàn thành</p></div>
  <div class="page-toolbar__right">
    <a href="{$base_url}/?role=cashier&page=history&action=export" class="btn-admin-secondary"><i class="fa-solid fa-file-excel"></i> Xuất Excel</a>
  </div>
</div>
<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="{$base_url}/" class="filter-bar"><input type="hidden" name="role" value="cashier"><input type="hidden" name="page" value="history">
    <div class="filter-bar__group">
      <div class="filter-input"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="q" placeholder="Tên BN, mã hóa đơn..." value="{$filter.q|default:''}"></div>
      <input type="date" name="date_from" value="{$filter.date_from|default:''}">
      <input type="date" name="date_to"   value="{$filter.date_to|default:''}">
      <select name="method"><option value="">Tất cả PT TT</option><option value="cash" {if $filter.method=='cash'}selected{/if}>Tiền mặt</option><option value="transfer" {if $filter.method=='transfer'}selected{/if}>Chuyển khoản</option><option value="qr" {if $filter.method=='qr'}selected{/if}>QR Code</option></select>
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
    </div>
  </form>
</div></div>
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table"><thead><tr><th>Mã HĐ</th><th>Bệnh nhân</th><th>Bác sĩ</th><th>Ngày TT</th><th>PT thanh toán</th><th>Tổng tiền</th><th>Thu ngân</th><th>Thao tác</th></tr></thead>
  <tbody>
    {foreach from=$history item=bill}
    <tr>
      <td><span class="code-tag">{$bill.invoice_code}</span></td>
      <td><strong>{$bill.patient_name}</strong><br><small>{$bill.patient_code}</small></td>
      <td>{$bill.doctor_name}</td>
      <td>{$bill.paid_at|date_format:"%d/%m/%Y %H:%M"}</td>
      <td>
        {if $bill.payment_method=='cash'}<span class="badge badge--green">Tiền mặt</span>
        {elseif $bill.payment_method=='transfer'}<span class="badge badge--blue">Chuyển khoản</span>
        {elseif $bill.payment_method=='qr'}<span class="badge badge--purple">QR Code</span>
        {else}<span class="badge badge--neutral">{$bill.payment_method}</span>{/if}
      </td>
      <td><strong style="color:var(--admin-success)">{$bill.total_amount|number_format:0:',':'.'}đ</strong></td>
      <td>{$bill.cashier_name}</td>
      <td><a href="{$base_url}/?role=cashier&page=history&id={$bill._id}" class="action-btn" title="Xem & In"><i class="fa-solid fa-print"></i></a></td>
    </tr>
    {foreachelse}<tr><td colspan="8" class="table-empty">Chưa có giao dịch nào</td></tr>
    {/foreach}
  </tbody></table>
</div></div>
{include file="layout/footer.tpl"}

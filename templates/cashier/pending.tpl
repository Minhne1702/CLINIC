{include file="layout/sidebar.tpl" page_title="Chờ thanh toán" active_page="pending"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-clock"></i> Chờ thanh toán</h2><p class="page-subtitle">Danh sách bệnh nhân đã khám xong, chờ thanh toán</p></div>
</div>
<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table"><thead><tr><th>Bệnh nhân</th><th>Bác sĩ</th><th>Chẩn đoán</th><th>Phí KCB</th><th>Phí thuốc</th><th>Tổng tiền</th><th>Thời gian chờ</th><th>Thao tác</th></tr></thead>
  <tbody>
    {foreach from=$pending_bills item=bill}
    <tr>
      <td><div class="table-user"><div class="table-avatar">{$bill.patient_name|truncate:1:""}</div><div><strong>{$bill.patient_name}</strong><small>{$bill.patient_code}</small></div></div></td>
      <td>{$bill.doctor_name}</td>
      <td>{$bill.diagnosis|default:'—'|truncate:35:'...'}</td>
      <td>{$bill.service_fee|number_format:0:',':'.'}đ</td>
      <td>{$bill.drug_fee|number_format:0:',':'.'}đ</td>
      <td><strong style="color:var(--admin-success)">{$bill.total_amount|number_format:0:',':'.'}đ</strong></td>
      <td><span class="text-muted" style="font-size:13px">{$bill.wait_time|default:'—'}</span></td>
      <td><a href="{$base_url}/?role=cashier&page=billing&id={$bill._id}" class="btn-admin-primary" style="font-size:12px;padding:.35rem .8rem"><i class="fa-solid fa-cash-register"></i> Thanh toán</a></td>
    </tr>
    {foreachelse}<tr><td colspan="8" class="table-empty">Không có hóa đơn nào chờ thanh toán</td></tr>
    {/foreach}
  </tbody></table>
</div></div>
{include file="layout/footer.tpl"}

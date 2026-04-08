{include file="layout/sidebar.tpl" page_title="BHYT" active_page="insurance"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-shield-heart"></i> Thanh toán BHYT</h2><p class="page-subtitle">Danh sách bệnh nhân có bảo hiểm y tế</p></div>
</div>

<div class="admin-card mb-1"><div class="admin-card__body">
  <form method="GET" action="{$BASE_URL}/" class="filter-bar">
    <input type="hidden" name="role" value="cashier">
    <input type="hidden" name="page" value="insurance">
    <div class="filter-bar__group">
      <div class="filter-input"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="q" placeholder="Tên BN, mã BHYT..." value="{$filter.q|default:''}"></div>
      <button type="submit" class="btn-admin-secondary"><i class="fa-solid fa-filter"></i> Lọc</button>
    </div>
  </form>
</div></div>

<div class="admin-card"><div class="admin-card__body p-0">
  <table class="admin-table">
    <thead>
      <tr>
        <th>Bệnh nhân</th>
        <th>Mã BHYT</th>
        <th>Bác sĩ</th>
        <th>Chẩn đoán</th>
        <th>Tổng tiền</th>
        <th>BHYT chi trả</th>
        <th>BN đồng chi trả</th>
        <th>Thao tác</th>
      </tr>
    </thead>
    <tbody>
      {foreach from=$insurance_bills item=bill}
      <tr>
        <td>
          <div class="table-user">
            <div class="table-avatar">{$bill.patient_name|truncate:1:""}</div>
            <div><strong>{$bill.patient_name}</strong><small>{$bill.patient_code}</small></div>
          </div>
        </td>
        <td><span class="badge badge--success">{$bill.bhyt_code}</span></td>
        <td>{$bill.doctor_name}</td>
        <td>{$bill.diagnosis|default:'—'|truncate:30:'...'}</td>
        <td><strong>{$bill.subtotal|default:$bill.total_amount|number_format:0:',':'.'}đ</strong></td>
        <td style="color:var(--admin-success)">-{$bill.bhyt_amount|default:0|number_format:0:',':'.'}đ</td>
        <td><strong style="color:var(--admin-danger)">{$bill.total_amount|number_format:0:',':'.'}đ</strong></td>
        <td>
          <a href="{$BASE_URL}/?role=cashier&page=billing&id={$bill._id}" class="btn-admin-primary" style="font-size:12px;padding:.35rem .8rem">
            <i class="fa-solid fa-cash-register"></i> Thanh toán
          </a>
        </td>
      </tr>
      {foreachelse}
      <tr><td colspan="8" class="table-empty">Không có bệnh nhân BHYT nào chờ thanh toán</td></tr>
      {/foreach}
    </tbody>
  </table>
</div></div>
{include file="layout/footer.tpl"}

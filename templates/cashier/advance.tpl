{include file="layout/sidebar.tpl" page_title="Tạm ứng" active_page="advance"}
<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-hand-holding-dollar"></i> Tạm ứng</h2><p class="page-subtitle">Ghi nhận tạm ứng từ bệnh nhân</p></div>
</div>

{if isset($success_message)}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}
{if isset($error_message)}<div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>{/if}

<div class="dashboard-grid">
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-plus"></i> Ghi nhận tạm ứng mới</h3></div>
    <div class="admin-card__body">
      <form method="POST" action="{$BASE_URL}/?role=cashier&page=advance" class="appt-form">
        <div class="form-group">
          <label>Tên bệnh nhân <span class="required">*</span></label>
          <input type="text" name="patient_name" placeholder="Nhập tên bệnh nhân..." required>
        </div>
        <div class="form-group">
          <label>Mã bệnh nhân</label>
          <input type="text" name="patient_code" placeholder="BN-XXXXXX">
        </div>
        <div class="form-row-2">
          <div class="form-group">
            <label>Số tiền tạm ứng <span class="required">*</span></label>
            <input type="number" name="amount" placeholder="0" step="1000" min="0" required>
          </div>
          <div class="form-group">
            <label>Phương thức</label>
            <select name="payment_method">
              <option value="cash">Tiền mặt</option>
              <option value="transfer">Chuyển khoản</option>
              <option value="qr">QR Code</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label>Ghi chú</label>
          <textarea name="note" rows="2" placeholder="Lý do tạm ứng..."></textarea>
        </div>
        <button type="submit" class="btn-admin-primary"><i class="fa-solid fa-floppy-disk"></i> Ghi nhận tạm ứng</button>
      </form>
    </div>
  </div>

  <div class="admin-card admin-card--lg">
    <div class="admin-card__header"><h3><i class="fa-solid fa-list"></i> Danh sách tạm ứng</h3></div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead><tr><th>Bệnh nhân</th><th>Mã BN</th><th>Số tiền</th><th>PT TT</th><th>Ghi chú</th><th>Ngày</th></tr></thead>
        <tbody>
          {foreach from=$advances item=adv}
          <tr>
            <td><strong>{$adv.patient_name}</strong></td>
            <td>{$adv.patient_code}</td>
            <td><strong style="color:var(--admin-success)">{$adv.amount|number_format:0:',':'.'}đ</strong></td>
            <td>
              {if $adv.payment_method=='cash'}<span class="badge badge--green">Tiền mặt</span>
              {elseif $adv.payment_method=='transfer'}<span class="badge badge--blue">Chuyển khoản</span>
              {else}<span class="badge badge--purple">QR Code</span>{/if}
            </td>
            <td>{$adv.note|default:'—'}</td>
            <td>{$adv.created_at|date_format:"%d/%m/%Y"}</td>
          </tr>
          {foreachelse}
          <tr><td colspan="6" class="table-empty">Chưa có giao dịch tạm ứng nào</td></tr>
          {/foreach}
        </tbody>
      </table>
    </div>
  </div>
</div>
{include file="layout/footer.tpl"}

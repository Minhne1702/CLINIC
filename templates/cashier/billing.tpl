{include file="layout/sidebar.tpl" page_title="Lập hóa đơn" active_page="billing"}

<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-file-invoice-dollar"></i> Lập hóa đơn</h2><p class="page-subtitle">Xử lý thanh toán cho bệnh nhân</p></div>
  <div class="page-toolbar__right">
    <a href="{$base_url}/?role=cashier&page=pending" class="btn-admin-secondary"><i class="fa-solid fa-clock"></i> Chờ TT ({$pending_count|default:0})</a>
  </div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}
{if $error_message}<div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>{/if}

{if $bill}
<!-- Chi tiết hóa đơn để thanh toán -->
<div class="billing-layout">
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-hospital-user"></i> Thông tin bệnh nhân</h3></div>
    <div class="admin-card__body">
      <div class="emr-section"><label>Họ và tên</label><p><strong>{$bill.patient_name}</strong></p></div>
      <div class="emr-section"><label>Mã BN</label><p>{$bill.patient_code}</p></div>
      <div class="emr-section"><label>Bác sĩ</label><p>{$bill.doctor_name}</p></div>
      <div class="emr-section"><label>Chẩn đoán</label><p>{$bill.diagnosis|default:'—'}</p></div>
      {if $bill.bhyt_code}<div class="emr-section"><label>BHYT</label><p><span class="badge badge--success">{$bill.bhyt_code}</span></p></div>{/if}
    </div>
  </div>

  <div class="admin-card admin-card--lg">
    <div class="admin-card__header"><h3><i class="fa-solid fa-list"></i> Chi tiết dịch vụ & thuốc</h3></div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead><tr><th>Mô tả</th><th>Loại</th><th>Số lượng</th><th>Đơn giá</th><th>Thành tiền</th></tr></thead>
        <tbody>
          {foreach from=$bill.items item=item}
          <tr>
            <td>{$item.description}</td>
            <td><span class="badge badge--{if $item.type=='service'}blue{elseif $item.type=='drug'}orange{else}neutral{/if}">{if $item.type=='service'}Dịch vụ{elseif $item.type=='drug'}Thuốc{else}Khác{/if}</span></td>
            <td>{$item.qty}</td>
            <td>{$item.unit_price|number_format:0:',':'.'}đ</td>
            <td><strong>{$item.total|number_format:0:',':'.'}đ</strong></td>
          </tr>
          {foreachelse}<tr><td colspan="5" class="table-empty">Không có dịch vụ</td></tr>
          {/foreach}
        </tbody>
        <tfoot>
          <tr style="border-top:2px solid var(--admin-border)">
            <td colspan="4" style="text-align:right;padding:.75rem 1rem;font-weight:600">Tổng cộng:</td>
            <td style="padding:.75rem 1rem"><strong style="font-size:1.1rem;color:var(--admin-success)">{$bill.subtotal|number_format:0:',':'.'}đ</strong></td>
          </tr>
          {if $bill.bhyt_amount > 0}
          <tr>
            <td colspan="4" style="text-align:right;padding:.4rem 1rem;color:var(--admin-text-secondary)">BHYT chi trả:</td>
            <td style="padding:.4rem 1rem;color:var(--admin-success)">-{$bill.bhyt_amount|number_format:0:',':'.'}đ</td>
          </tr>
          {/if}
          {if $bill.discount > 0}
          <tr>
            <td colspan="4" style="text-align:right;padding:.4rem 1rem;color:var(--admin-text-secondary)">Giảm giá:</td>
            <td style="padding:.4rem 1rem;color:var(--admin-success)">-{$bill.discount|number_format:0:',':'.'}đ</td>
          </tr>
          {/if}
          <tr style="background:#f0fdf4">
            <td colspan="4" style="text-align:right;padding:.75rem 1rem;font-weight:700;font-size:15px">Số tiền cần thanh toán:</td>
            <td style="padding:.75rem 1rem"><strong style="font-size:1.3rem;color:var(--admin-success)">{$bill.total_amount|number_format:0:',':'.'}đ</strong></td>
          </tr>
        </tfoot>
      </table>
    </div>

    <div class="admin-card__footer">
      <form action="{$base_url}/" method="POST" class="appt-form">
        <input type="hidden" name="role" value="cashier">
        <input type="hidden" name="page" value="billing">
        <input type="hidden" name="action" value="pay">
        <input type="hidden" name="bill_id" value="{$bill._id}">
        <div class="form-row-2" style="margin-bottom:1rem">
          <div class="form-group">
            <label>Phương thức thanh toán <span class="required">*</span></label>
            <select name="payment_method" required>
              <option value="cash">Tiền mặt</option>
              <option value="transfer">Chuyển khoản</option>
              <option value="qr">QR Code (VietQR)</option>
            </select>
          </div>
          <div class="form-group">
            <label>Số tiền khách đưa</label>
            <input type="number" name="amount_received" placeholder="{$bill.total_amount}" step="1000">
          </div>
        </div>
        <div style="display:flex;gap:.75rem;flex-wrap:wrap">
          <button type="submit" class="btn-admin-primary"><i class="fa-solid fa-cash-register"></i> Xác nhận thanh toán & In hóa đơn</button>
          <a href="{$base_url}/?role=cashier&page=pending" class="btn-admin-ghost">Hủy</a>
        </div>
      </form>
    </div>
  </div>
</div>

{else}
<!-- Tìm kiếm hóa đơn -->
<div class="admin-card">
  <div class="admin-card__body">
    <form method="GET" action="{$base_url}/" class="appt-form">
      <input type="hidden" name="role" value="cashier"><input type="hidden" name="page" value="billing">
      <div class="form-group"><label>Tìm bệnh nhân / mã lịch hẹn</label>
        <div class="input-icon-wrap"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="q" value="{$search_q|default:''}" placeholder="Tên bệnh nhân, mã lịch, CCCD..."></div>
      </div>
      <button type="submit" class="btn-admin-primary"><i class="fa-solid fa-search"></i> Tìm kiếm</button>
    </form>
    {if $search_results}
    <div style="margin-top:1.5rem">
      <table class="admin-table">
        <thead><tr><th>Bệnh nhân</th><th>Bác sĩ</th><th>Tổng tiền</th><th>Trạng thái</th><th>Thao tác</th></tr></thead>
        <tbody>
          {foreach from=$search_results item=r}
          <tr>
            <td><strong>{$r.patient_name}</strong><br><small>{$r.patient_code}</small></td>
            <td>{$r.doctor_name}</td>
            <td><strong>{$r.total_amount|number_format:0:',':'.'}đ</strong></td>
            <td><span class="badge badge--warning">Chờ TT</span></td>
            <td><a href="{$base_url}/?role=cashier&page=billing&id={$r._id}" class="btn-admin-primary" style="font-size:12px;padding:.35rem .8rem"><i class="fa-solid fa-cash-register"></i> Thanh toán</a></td>
          </tr>
          {/foreach}
        </tbody>
      </table>
    </div>
    {/if}
  </div>
</div>
{/if}

{include file="layout/footer.tpl"}

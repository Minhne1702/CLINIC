{include file="layout/sidebar.tpl" page_title="Phát thuốc" active_page="dispensing"}

<div class="page-toolbar">
  <div class="page-toolbar__left"><h2 class="page-title"><i class="fa-solid fa-capsules"></i> Phát thuốc</h2><p class="page-subtitle">Kiểm tra đơn và bốc thuốc cho bệnh nhân</p></div>
  <div class="page-toolbar__right"><a href="{$BASE_URL}/?role=pharmacist&page=prescriptions" class="btn-admin-ghost"><i class="fa-solid fa-arrow-left"></i> Danh sách đơn</a></div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}
{if $error_message}<div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>{/if}

{if $prescription}
<div class="billing-layout">
  <div class="admin-card">
    <div class="admin-card__header"><h3><i class="fa-solid fa-hospital-user"></i> Bệnh nhân</h3></div>
    <div class="admin-card__body">
      <div class="emr-section"><label>Họ và tên</label><p><strong>{$prescription.patient_name}</strong></p></div>
      <div class="emr-section"><label>Mã BN</label><p>{$prescription.patient_code}</p></div>
      <div class="emr-section"><label>Bác sĩ kê</label><p>{$prescription.doctor_name}</p></div>
      <div class="emr-section"><label>Chẩn đoán</label><p>{$prescription.diagnosis|default:'—'}</p></div>
      {if $prescription.patient_drug_allergies}
      <div style="background:#fef2f2;border-left:3px solid var(--admin-danger);padding:.75rem;border-radius:8px">
        <strong style="font-size:12px;color:var(--admin-danger)"><i class="fa-solid fa-triangle-exclamation"></i> DỊ ỨNG</strong>
        <p style="font-size:13px;color:#991b1b;font-weight:500;margin-top:.25rem">{$prescription.patient_drug_allergies}</p>
      </div>
      {/if}
    </div>
  </div>

  <div class="admin-card admin-card--lg">
    <div class="admin-card__header"><h3><i class="fa-solid fa-pills"></i> Danh sách thuốc cần phát</h3></div>
    <div class="admin-card__body p-0">
      <table class="admin-table">
        <thead><tr><th>Tên thuốc</th><th>Hoạt chất</th><th>Hàm lượng</th><th>Số lượng</th><th>Đơn vị</th><th>Liều dùng</th><th>Tồn kho</th><th>Xác nhận</th></tr></thead>
        <tbody>
          {foreach from=$prescription.drugs item=drug}
          <tr>
            <td><strong>{$drug.name}</strong></td>
            <td class="text-muted">{$drug.active_ingredient|default:'—'}</td>
            <td>{$drug.concentration|default:'—'}</td>
            <td><strong>{$drug.qty}</strong></td>
            <td>{$drug.unit}</td>
            <td style="font-size:13px">{$drug.dosage}<br><small class="text-muted">{$drug.instruction}</small></td>
            <td>
              {if $drug.stock_qty <= 0}<span class="badge badge--danger">Hết hàng</span>
              {elseif $drug.stock_qty < $drug.qty}<span class="badge badge--warning">{$drug.stock_qty} còn</span>
              {else}<span class="badge badge--success">{$drug.stock_qty} còn</span>{/if}
            </td>
            <td>
              {if $drug.stock_qty >= $drug.qty}
              <label class="checkbox-label"><input type="checkbox" class="dispense-check" data-drug="{$drug._id}" checked> Đủ</label>
              {else}
              <span class="text-danger" style="font-size:12px">Không đủ</span>
              {/if}
            </td>
          </tr>
          {/foreach}
        </tbody>
      </table>
      {if $prescription.prescription_note}
      <div style="padding:.75rem 1.25rem;background:#f8fafc;border-top:1px solid var(--admin-border)">
        <strong style="font-size:12px">Lời dặn:</strong> <span style="font-size:13px">{$prescription.prescription_note}</span>
      </div>
      {/if}
    </div>
    <div class="admin-card__footer">
      <form action="{$BASE_URL}/" method="POST">
        <input type="hidden" name="role" value="pharmacist">
        <input type="hidden" name="page" value="dispensing">
        <input type="hidden" name="action" value="dispense">
        <input type="hidden" name="prescription_id" value="{$prescription._id}">
        <div style="display:flex;gap:.75rem;flex-wrap:wrap">
          <button type="submit" class="btn-admin-primary"><i class="fa-solid fa-circle-check"></i> Xác nhận đã phát thuốc & Gọi bệnh nhân</button>
          <button type="button" class="btn-admin-secondary" onclick="window.print()"><i class="fa-solid fa-print"></i> In nhãn thuốc</button>
        </div>
      </form>
    </div>
  </div>
</div>
{else}
<div class="empty-state admin-card" style="padding:3rem">
  <i class="fa-solid fa-prescription"></i><h3>Chưa chọn đơn thuốc</h3>
  <a href="{$BASE_URL}/?role=pharmacist&page=prescriptions" class="btn-admin-primary" style="margin-top:1rem">Xem danh sách đơn thuốc</a>
</div>
{/if}

{include file="layout/footer.tpl"}

{include file="layout/sidebar.tpl" page_title="Phát thuốc" active_page="dispensing"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-solid fa-capsules"></i> Phát thuốc</h2>
    <p class="page-subtitle">Kiểm tra đơn và bốc thuốc cho bệnh nhân</p>
  </div>
  <div class="page-toolbar__right">
    <a href="{$BASE_URL}/?role=pharmacist&page=prescriptions" class="btn-admin-ghost"><i class="fa-solid fa-arrow-left"></i> Danh sách đơn</a>
  </div>
</div>

{if $success_message}<div class="alert alert--success"><i class="fa-solid fa-circle-check"></i> {$success_message}</div>{/if}
{if $error_message}<div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>{/if}

{if $prescription}
{* Ép 2 cột bằng nhau và không để khoảng trống thừa *}
<div style="display: grid; grid-template-columns: 320px 1fr; gap: 24px; align-items: stretch;">
  
  <div class="admin-card" style="margin-bottom: 0; display: flex; flex-direction: column; height: 100%;">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-hospital-user"></i> Bệnh nhân</h3>
    </div>
    <div class="admin-card__body" style="flex-grow: 1;">
      <div class="emr-section">
        <label style="text-transform: uppercase; font-size: 11px; color: #94a3b8; font-weight: 600;">Họ và tên</label>
        <p style="font-weight: 700; color: #1e293b; margin-top: 4px;">{$prescription.patient_name}</p>
      </div>
      <div class="emr-section" style="margin-top: 15px;">
        <label style="text-transform: uppercase; font-size: 11px; color: #94a3b8; font-weight: 600;">Mã BN</label>
        <p style="color: #475569; margin-top: 4px;">{$prescription.patient_code}</p>
      </div>
      <div class="emr-section" style="margin-top: 15px;">
        <label style="text-transform: uppercase; font-size: 11px; color: #94a3b8; font-weight: 600;">Bác sĩ kê</label>
        <p style="color: #475569; margin-top: 4px;">{$prescription.doctor_name}</p>
      </div>
      <div class="emr-section" style="margin-top: 15px;">
        <label style="text-transform: uppercase; font-size: 11px; color: #94a3b8; font-weight: 600;">Chẩn đoán</label>
        <p style="color: #475569; margin-top: 4px;">{$prescription.diagnosis|default:'—'}</p>
      </div>

      {if !empty($prescription.patient_drug_allergies)}
      <div style="background: #fef2f2; border-left: 4px solid #ef4444; padding: 12px; border-radius: 8px; margin-top: 20px;">
        <strong style="font-size: 11px; color: #ef4444; display: block; margin-bottom: 4px;">
          <i class="fa-solid fa-triangle-exclamation"></i> DỊ ỨNG THUỐC
        </strong>
        <p style="font-size: 13px; color: #991b1b; font-weight: 600; margin: 0;">{$prescription.patient_drug_allergies}</p>
      </div>
      {/if}
    </div>
  </div>

  <div class="admin-card" style="margin-bottom: 0; display: flex; flex-direction: column; height: 100%;">
    <div class="admin-card__header">
      <h3><i class="fa-solid fa-pills"></i> Danh sách thuốc cần phát</h3>
    </div>
    <div class="admin-card__body p-0" style="flex-grow: 1;">
      <div class="table-responsive">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Tên thuốc</th>
              <th>Hoạt chất</th>
              <th>Hàm lượng</th>
              <th>Số lượng</th>
              <th>Đơn vị</th>
              <th>Liều dùng</th>
              <th>Tồn kho</th>
              <th>Xác nhận</th>
            </tr>
          </thead>
          <tbody>
            {foreach from=$prescription.drugs item=drug}
            <tr>
              <td><strong>{$drug.name}</strong></td>
              <td class="text-muted" style="font-size: 13px;">{$drug.active_ingredient|default:'—'}</td>
              <td>{$drug.concentration|default:'—'}</td>
              <td><strong style="font-size: 15px;">{$drug.qty}</strong></td>
              <td>{$drug.unit}</td>
              <td style="font-size: 12px; line-height: 1.4;">
                <span style="font-weight: 600;">{$drug.dosage}</span><br>
                <span class="text-muted">{$drug.instruction|default:''}</span>
              </td>
              <td>
                {if !isset($drug.stock_qty) || $drug.stock_qty <= 0}
                  <span class="badge badge--danger" style="font-size: 11px;">Hết hàng</span>
                {elseif $drug.stock_qty < $drug.qty}
                  <span class="badge badge--warning" style="font-size: 11px; background: #fef3c7; color: #92400e;">{$drug.stock_qty} còn</span>
                {else}
                  <span class="badge badge--success" style="font-size: 11px; background: #dcfce7; color: #166534;">{$drug.stock_qty} còn</span>
                {/if}
              </td>
              <td>
                {if isset($drug.stock_qty) && $drug.stock_qty >= $drug.qty}
                  <label style="display: flex; align-items: center; gap: 6px; color: #0891b2; font-weight: 700; cursor: pointer;">
                    <input type="checkbox" checked disabled style="accent-color: #0891b2; width: 16px; height: 16px;"> Đủ
                  </label>
                {else}
                  <span style="color: #ef4444; font-weight: 700; font-size: 13px;">
                    <i class="fa-solid fa-circle-xmark"></i> Thiếu
                  </span>
                {/if}
              </td>
            </tr>
            {/foreach}
          </tbody>
        </table>
      </div>
      
      {if $prescription.prescription_note}
      <div style="padding: 16px 20px; background: #f8fafc; border-top: 1px solid #e2e8f0;">
        <strong style="font-size: 12px; color: #475569; text-transform: uppercase;">Lời dặn của bác sĩ:</strong>
        <p style="font-size: 13px; color: #1e293b; margin-top: 6px; line-height: 1.5;">{$prescription.prescription_note}</p>
      </div>
      {/if}
    </div>
    
    <div class="admin-card__footer" style="padding: 20px; background: #fff; border-top: 1px solid #e2e8f0; border-bottom-left-radius: 12px; border-bottom-right-radius: 12px;">
      <form action="{$BASE_URL}/" method="POST">
        <input type="hidden" name="role" value="pharmacist">
        <input type="hidden" name="page" value="dispensing">
        <input type="hidden" name="action" value="dispense">
        <input type="hidden" name="prescription_id" value="{$prescription._id}">
        
        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
          <button type="submit" class="btn-admin-primary" style="padding: 12px 24px; font-weight: 700;">
            <i class="fa-solid fa-circle-check"></i> Xác nhận đã phát thuốc & Gọi số
          </button>
          <button type="button" class="btn-admin-secondary" onclick="window.print()" style="padding: 12px 20px;">
            <i class="fa-solid fa-print"></i> In nhãn thuốc
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{else}
<div class="empty-state admin-card" style="padding: 5rem 2rem; text-align: center;">
  <div style="font-size: 4rem; color: #cbd5e1; margin-bottom: 1.5rem;"><i class="fa-solid fa-prescription"></i></div>
  <h3 style="color: #1e293b; font-size: 1.5rem;">Chưa có đơn thuốc được chọn</h3>
  <p class="text-muted" style="margin-top: 0.5rem;">Vui lòng quay lại danh sách để chọn đơn thuốc cần bốc.</p>
  <a href="{$BASE_URL}/?role=pharmacist&page=prescriptions" class="btn-admin-primary" style="margin-top: 2rem; display: inline-block;">
    <i class="fa-solid fa-list-ul"></i> Xem danh sách đơn thuốc
  </a>
</div>
{/if}

{include file="layout/footer.tpl"}
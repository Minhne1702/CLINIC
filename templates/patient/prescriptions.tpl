{include file="layout/header.tpl" page_title="Đơn thuốc của tôi" active_page="prescriptions"}

<div class="page-toolbar" style="margin-top: 1.5rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
  <div class="page-toolbar__left">
    <h2 class="page-title" style="margin: 0; font-size: 1.8rem; color: #0f172a;"><i class="fa-solid fa-prescription-bottle-medical" style="color: #0284c7;"></i> Đơn thuốc của tôi</h2>
    <p class="page-subtitle" style="margin: 0.5rem 0 0 0; color: #64748b;">Quản lý lịch sử và chi tiết các đơn thuốc đã được kê</p>
  </div>
  {if isset($prescription) && $prescription}
  <div class="page-toolbar__right" style="display: flex; gap: 0.75rem;">
    <a href="{$BASE_URL}/?page=prescriptions" class="btn-outline" style="padding: 0.6rem 1rem; border: 1px solid #cbd5e1; border-radius: 6px; text-decoration: none; color: #475569; display: inline-flex; align-items: center; gap: 0.5rem; background: #fff;">
      <i class="fa-solid fa-arrow-left"></i> Quay lại
    </a>
    <button class="btn-primary" onclick="window.print()" style="padding: 0.6rem 1rem; border-radius: 6px; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;">
      <i class="fa-solid fa-print"></i> In đơn thuốc
    </button>
  </div>
  {/if}
</div>

{if isset($prescription) && $prescription}
{* ========== CHI TIẾT ĐƠN THUỐC (CHẾ ĐỘ XEM & IN) ========== *}
<div class="dashboard-card rx-print-area" style="padding: 2rem; max-width: 800px; margin: 0 auto; background: #fff;">
  <div class="dashboard-card__body p-0">

    <div class="rx-header" style="display: flex; justify-content: space-between; border-bottom: 2px solid #0284c7; padding-bottom: 1.5rem; margin-bottom: 1.5rem;">
      <div class="rx-header__clinic">
        <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:.5rem">
          <div class="logo-icon" style="width:36px;height:36px;font-size:16px;background:linear-gradient(135deg,#0891b2,#06b6d4);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff">
            <i class="fa-solid fa-heart-pulse"></i>
          </div>
          <strong style="font-size:1.2rem;color:#0284c7;text-transform:uppercase;">MediCare</strong>
        </div>
        <p style="font-size:13px;color:#475569;margin:0 0 0.2rem 0;">123 Nguyễn Thị Minh Khai, Q.1, TP.HCM</p>
        <p style="font-size:13px;color:#475569;margin:0;">Hotline: 1900 xxxx</p>
      </div>
      <div class="rx-header__title" style="text-align: right;">
        <h2 style="margin: 0 0 0.5rem 0; color: #0f172a; font-size: 1.8rem;">ĐƠN THUỐC</h2>
        <p style="margin: 0; color: #475569; font-size: 14px;">Mã đơn: <strong style="color: #0f172a;">{$prescription.code|default:'—'}</strong></p>
        <p style="margin: 0.2rem 0 0 0; color: #475569; font-size: 14px;">Ngày kê: <strong style="color: #0f172a;">{$prescription.date|date_format:"%d/%m/%Y"}</strong></p>
      </div>
    </div>

    <div class="rx-patient-info" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem; background: #f8fafc; padding: 1.25rem; border-radius: 8px;">
      <div class="rx-info-row" style="font-size: 14px;"><span style="color: #64748b; margin-right: 5px;">Họ và tên:</span><strong style="color: #0f172a; font-size: 15px;">{$prescription.patient_name}</strong></div>
      <div class="rx-info-row" style="font-size: 14px;"><span style="color: #64748b; margin-right: 5px;">Giới tính:</span><strong style="color: #0f172a;">{if $prescription.patient_gender == 'male'}Nam{elseif $prescription.patient_gender == 'female'}Nữ{else}—{/if}</strong></div>
      <div class="rx-info-row" style="font-size: 14px;"><span style="color: #64748b; margin-right: 5px;">Ngày sinh:</span><strong style="color: #0f172a;">{$prescription.patient_birthday|date_format:"%d/%m/%Y"|default:'—'}</strong></div>
      <div class="rx-info-row" style="font-size: 14px;"><span style="color: #64748b; margin-right: 5px;">Chẩn đoán:</span><strong style="color: #0f172a;">{$prescription.diagnosis|default:'—'}</strong></div>
    </div>

    <div style="overflow-x: auto;">
      <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
        <thead style="background: #f1f5f9; border-bottom: 2px solid #cbd5e1;">
          <tr>
            <th style="padding: 0.75rem; width: 40px; text-align: center;">STT</th>
            <th style="padding: 0.75rem;">Tên thuốc / Hoạt chất</th>
            <th style="padding: 0.75rem;">Hàm lượng</th>
            <th style="padding: 0.75rem; text-align: center;">Số lượng</th>
            <th style="padding: 0.75rem;">Cách dùng</th>
          </tr>
        </thead>
        <tbody>
          {if isset($prescription.drugs) && $prescription.drugs|@count > 0}
            {foreach from=$prescription.drugs item=drug name=dloop}
            <tr style="border-bottom: 1px solid #e2e8f0;">
              <td style="padding: 0.75rem; text-align: center;">{$smarty.foreach.dloop.iteration}</td>
              <td style="padding: 0.75rem;">
                <strong style="color: #0f172a; display: block; font-size: 15px;">{$drug.name}</strong>
                <span style="color: #64748b; font-size: 12px;">{$drug.active_ingredient|default:'—'}</span>
              </td>
              <td style="padding: 0.75rem;">{$drug.concentration|default:'—'}</td>
              <td style="padding: 0.75rem; text-align: center;"><strong style="color: #0284c7;">{$drug.qty} {$drug.unit}</strong></td>
              <td style="padding: 0.75rem;">
                <div style="margin-bottom: 0.2rem;">{$drug.dosage} (x {$drug.days} ngày)</div>
                <em style="color: #475569; font-size: 13px;">{$drug.instruction}</em>
              </td>
            </tr>
            {/foreach}
          {else}
            <tr><td colspan="5" style="padding: 2rem; text-align: center; color: #94a3b8;">Không có thuốc trong đơn này</td></tr>
          {/if}
        </tbody>
      </table>
    </div>

    {if isset($prescription.prescription_note) && $prescription.prescription_note}
    <div style="margin-top: 1.5rem; padding: 1rem 1.25rem; background: #f0f9ff; border-radius: 8px; border-left: 4px solid #0284c7;">
      <strong style="font-size: 14px; color: #0369a1;"><i class="fa-solid fa-user-doctor"></i> Lời dặn của bác sĩ:</strong>
      <p style="font-size: 14px; margin: 0.5rem 0 0 0; color: #334155; line-height: 1.5;">{$prescription.prescription_note}</p>
    </div>
    {/if}

    <div class="rx-footer" style="display: flex; justify-content: space-between; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px dashed #cbd5e1;">
      <div>
        <p style="font-size: 14px; color: #475569; margin: 0 0 0.5rem 0;">Tái khám sau: <strong style="color: #0f172a;">{$prescription.followup_days|default:'—'} ngày</strong></p>
        <p style="font-size: 14px; color: #475569; margin: 0;">Ngày tái khám: <strong style="color: #0f172a;">{$prescription.followup_date|date_format:"%d/%m/%Y"|default:'—'}</strong></p>
      </div>
      <div style="text-align: center; min-width: 200px;">
        <p style="font-size: 14px; color: #475569; margin: 0;">Bác sĩ điều trị</p>
        <p style="font-size: 12px; color: #94a3b8; margin: 0 0 4rem 0;">(Ký và ghi rõ họ tên)</p>
        <p style="margin: 0; font-weight: 600; font-size: 16px; color: #0f172a;">BS. {$prescription.doctor_name}</p>
        <p style="font-size: 13px; color: #64748b; margin: 0.2rem 0 0 0;">{$prescription.specialty}</p>
      </div>
    </div>

  </div>
</div>

{else}
{* ========== DANH SÁCH ĐƠN THUỐC ========== *}
<div class="dashboard-card">
  <div class="dashboard-card__body p-0">
    <div style="overflow-x: auto;">
      <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem;">
        <thead style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
          <tr>
            <th style="padding: 1rem; color: #475569; font-weight: 600;">Mã đơn</th>
            <th style="padding: 1rem; color: #475569; font-weight: 600;">Ngày kê</th>
            <th style="padding: 1rem; color: #475569; font-weight: 600;">Bác sĩ kê đơn</th>
            <th style="padding: 1rem; color: #475569; font-weight: 600;">Chẩn đoán</th>
            <th style="padding: 1rem; color: #475569; font-weight: 600; text-align: center;">Số lượng</th>
            <th style="padding: 1rem; color: #475569; font-weight: 600;">Trạng thái</th>
            <th style="padding: 1rem; color: #475569; font-weight: 600; text-align: center;">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          {if isset($prescriptions) && $prescriptions|@count > 0}
            {foreach from=$prescriptions item=rx}
            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
              <td style="padding: 1rem;"><code style="background:#f1f5f9; padding:4px 8px; border-radius:4px; font-weight: 600; color: #0f172a;">{$rx.code}</code></td>
              <td style="padding: 1rem;">{$rx.date|date_format:"%d/%m/%Y"}</td>
              <td style="padding: 1rem; font-weight: 500;">BS. {$rx.doctor_name}</td>
              <td style="padding: 1rem; color: #475569;">{$rx.diagnosis|default:'—'|truncate:40:'...'}</td>
              <td style="padding: 1rem; text-align: center;"><span class="badge badge--neutral">{$rx.drug_count|default:0} thuốc</span></td>
              <td style="padding: 1rem;">
                {if isset($rx.dispensed) && $rx.dispensed}
                  <span class="badge badge--success"><i class="fa-solid fa-check"></i> Đã phát</span>
                {else}
                  <span class="badge badge--warning">Chờ lấy thuốc</span>
                {/if}
              </td>
              <td style="padding: 1rem; text-align: center;">
                <a href="{$BASE_URL}/?page=prescriptions&id={$rx.id|default:$rx._id}" class="action-btn" title="Xem chi tiết" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 6px; background: #e0f2fe; color: #0284c7; text-decoration: none;">
                  <i class="fa-solid fa-eye"></i>
                </a>
              </td>
            </tr>
            {/foreach}
          {else}
            <tr>
              <td colspan="7" style="padding: 4rem 2rem; text-align: center;">
                <i class="fa-solid fa-prescription-bottle" style="font-size: 2.5rem; color: #cbd5e1; margin-bottom: 1rem; display: block;"></i>
                <p style="color: #64748b; margin: 0;">Bạn chưa có hồ sơ đơn thuốc nào.</p>
              </td>
            </tr>
          {/if}
        </tbody>
      </table>
    </div>
  </div>
</div>
{/if}

{include file="layout/footer.tpl"}

<style>
  @media print {
    /* Ẩn tất cả các thành phần UI không cần thiết */
    body * {
      visibility: hidden;
    }
    
    /* Chỉ hiển thị khu vực đơn thuốc */
    .rx-print-area, .rx-print-area * {
      visibility: visible;
    }
    
    /* Căn chỉnh lại vị trí khu vực in ra góc trái trên cùng */
    .rx-print-area {
      position: absolute;
      left: 0;
      top: 0;
      width: 100%;
      margin: 0 !important;
      padding: 0 !important;
      box-shadow: none !important;
      border: none !important;
    }

    /* Đảm bảo bảng in ra có viền rõ ràng */
    .rx-print-area table {
      border: 1px solid #000;
    }
    .rx-print-area th, .rx-print-area td {
      border: 1px solid #000 !important;
    }
  }
</style>
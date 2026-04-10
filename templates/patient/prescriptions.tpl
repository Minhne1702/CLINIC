{include file="layout/sidebar.tpl" page_title="Đơn thuốc của tôi" active_page="prescriptions"}

<style>
  /* --- BỐ CỤC CHUNG --- */
  .prescriptions-wrapper { max-width: 1000px; margin: 2rem auto 4rem auto; padding: 0 1.5rem; }
  
  .page-toolbar { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin-bottom: 2rem; }
  .page-title { margin: 0; font-size: 1.8rem; color: #0f172a; font-weight: 700; display: flex; align-items: center; gap: 10px; }
  .page-subtitle { margin: 0.5rem 0 0 0; color: #64748b; font-size: 0.95rem; }
  
  /* --- CARD & DANH SÁCH --- */
  .dashboard-card { background: #fff; border-radius: 16px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); border: 1px solid #e2e8f0; overflow: hidden; }
  .rx-table-wrapper { overflow-x: auto; }
  .rx-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem; }
  .rx-table th { padding: 1.25rem 1rem; color: #475569; font-weight: 600; background: #f8fafc; border-bottom: 2px solid #e2e8f0; white-space: nowrap; }
  .rx-table td { padding: 1.25rem 1rem; border-bottom: 1px solid #f1f5f9; vertical-align: middle; }
  .rx-table tr { transition: background 0.2s; }
  .rx-table tr:hover { background: #f8fafc; }
  
  .badge { padding: 5px 12px; border-radius: 6px; font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 4px; }
  .badge--neutral { background: #f1f5f9; color: #475569; }
  .badge--success { background: #dcfce7; color: #15803d; }
  .badge--warning { background: #fef3c7; color: #d97706; }
  
  .action-btn { display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; border-radius: 8px; background: #e0f2fe; color: #0284c7; text-decoration: none; transition: all 0.2s; }
  .action-btn:hover { background: #0284c7; color: #fff; transform: translateY(-2px); }

  /* --- CHI TIẾT ĐƠN THUỐC --- */
  .rx-print-area { max-width: 800px; margin: 0 auto; padding: 3rem; background: #fff; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.05); }
  .rx-header { display: flex; justify-content: space-between; border-bottom: 2px solid #0284c7; padding-bottom: 1.5rem; margin-bottom: 1.5rem; }
  .rx-patient-info { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem; background: #f8fafc; padding: 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0; }
  .rx-info-row { font-size: 0.95rem; }
  .rx-info-row span { color: #64748b; margin-right: 5px; }
  .rx-info-row strong { color: #0f172a; }
  
  /* --- NÚT BẤM --- */
  .btn-outline { padding: 0.75rem 1.25rem; border: 1px solid #cbd5e1; border-radius: 8px; text-decoration: none; color: #475569; display: inline-flex; align-items: center; gap: 0.5rem; background: #fff; font-weight: 600; transition: all 0.2s; }
  .btn-outline:hover { background: #f1f5f9; color: #0f172a; }
  .btn-primary { padding: 0.75rem 1.25rem; border-radius: 8px; background: #0284c7; color: #fff; border: none; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(2, 132, 199, 0.2); }
  .btn-primary:hover { background: #0369a1; transform: translateY(-2px); }

  /* --- CHẾ ĐỘ IN (Mực đen nền trắng, tự động giấu menu) --- */
  @media print {
    body { background: #fff !important; }
    .sidebar, .admin-topnav, .page-toolbar, .btn-outline, .btn-primary { display: none !important; }
    .admin-main { margin: 0 !important; padding: 0 !important; width: 100% !important; }
    .prescriptions-wrapper { padding: 0 !important; margin: 0 !important; max-width: 100% !important; }
    
    .rx-print-area { box-shadow: none !important; border: none !important; width: 100% !important; padding: 0 !important; }
    .rx-print-area table { border: 1px solid #000; }
    .rx-print-area th, .rx-print-area td { border: 1px solid #000 !important; padding: 8px !important; }
    .rx-patient-info { border: 1px solid #000 !important; background: transparent !important; }
  }
</style>

<div class="prescriptions-wrapper">

  <div class="page-toolbar">
    <div class="page-toolbar__left">
      <h2 class="page-title"><i class="fa-solid fa-prescription-bottle-medical" style="color: #0284c7;"></i> Đơn thuốc của tôi</h2>
      <p class="page-subtitle">Quản lý lịch sử và chi tiết các đơn thuốc đã được kê</p>
    </div>
    
    {if isset($prescription) && $prescription}
    <div class="page-toolbar__right" style="display: flex; gap: 1rem;">
      <a href="{$BASE_URL}/?page=prescriptions" class="btn-outline">
        <i class="fa-solid fa-arrow-left"></i> Quay lại
      </a>
      <button class="btn-primary" onclick="window.print()">
        <i class="fa-solid fa-print"></i> In đơn thuốc
      </button>
    </div>
    {/if}
  </div>

  {if isset($prescription) && $prescription}
  {* ==========================================================
     CHẾ ĐỘ XEM CHI TIẾT & IN ĐƠN THUỐC
     ========================================================== *}
  <div class="rx-print-area">
    
    <div class="rx-header">
      <div class="rx-header__clinic">
        <div style="display:flex;align-items:center;gap:.6rem;margin-bottom:.5rem">
          <div style="width:36px;height:36px;font-size:16px;background:linear-gradient(135deg,#0891b2,#06b6d4);border-radius:8px;display:flex;align-items:center;justify-content:center;color:#fff">
            <i class="fa-solid fa-heart-pulse"></i>
          </div>
          <strong style="font-size:1.3rem;color:#0284c7;text-transform:uppercase;">MediCare</strong>
        </div>
        <p style="font-size:13px;color:#475569;margin:0 0 0.2rem 0;">123 Đường ABC, Quận XYZ, Hà Nội</p>
        <p style="font-size:13px;color:#475569;margin:0;">Hotline: 1900 xxxx</p>
      </div>
      <div class="rx-header__title" style="text-align: right;">
        <h2 style="margin: 0 0 0.5rem 0; color: #0f172a; font-size: 1.8rem;">ĐƠN THUỐC</h2>
        <p style="margin: 0; color: #475569; font-size: 14px;">Mã đơn: <strong style="color: #0f172a;">{$prescription.code|default:'—'}</strong></p>
        <p style="margin: 0.2rem 0 0 0; color: #475569; font-size: 14px;">Ngày kê: <strong style="color: #0f172a;">{$prescription.date|date_format:"%d/%m/%Y"}</strong></p>
      </div>
    </div>

    <div class="rx-patient-info">
      <div class="rx-info-row"><span style="display:inline-block; width: 80px;">Họ và tên:</span><strong style="font-size: 16px; text-transform: uppercase;">{$prescription.patient_name}</strong></div>
      <div class="rx-info-row"><span style="display:inline-block; width: 80px;">Giới tính:</span><strong>{if $prescription.patient_gender == 'male'}Nam{elseif $prescription.patient_gender == 'female'}Nữ{else}—{/if}</strong></div>
      <div class="rx-info-row"><span style="display:inline-block; width: 80px;">Ngày sinh:</span><strong>{$prescription.patient_birthday|date_format:"%d/%m/%Y"|default:'—'}</strong></div>
      <div class="rx-info-row"><span style="display:inline-block; width: 80px;">Chẩn đoán:</span><strong>{$prescription.diagnosis|default:'—'}</strong></div>
    </div>

    <div style="margin-bottom: 2rem;">
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
              <td style="padding: 1rem 0.75rem; text-align: center; vertical-align: top;">{$smarty.foreach.dloop.iteration}</td>
              <td style="padding: 1rem 0.75rem; vertical-align: top;">
                <strong style="color: #0f172a; display: block; font-size: 15px; margin-bottom: 4px;">{$drug.name}</strong>
                <span style="color: #64748b; font-size: 12px;">{$drug.active_ingredient|default:'—'}</span>
              </td>
              <td style="padding: 1rem 0.75rem; vertical-align: top;">{$drug.concentration|default:'—'}</td>
              <td style="padding: 1rem 0.75rem; text-align: center; vertical-align: top;"><strong style="color: #0284c7; font-size: 15px;">{$drug.qty} {$drug.unit}</strong></td>
              <td style="padding: 1rem 0.75rem; vertical-align: top;">
                <div style="margin-bottom: 0.4rem; font-weight: 500;">{$drug.dosage} (x {$drug.days} ngày)</div>
                <em style="color: #475569; font-size: 13px; line-height: 1.4; display: block;">{$drug.instruction}</em>
              </td>
            </tr>
            {/foreach}
          {else}
            <tr><td colspan="5" style="padding: 3rem; text-align: center; color: #94a3b8; font-style: italic;">Không có thuốc trong đơn này</td></tr>
          {/if}
        </tbody>
      </table>
    </div>

    {if isset($prescription.prescription_note) && $prescription.prescription_note}
    <div style="margin-top: 1.5rem; padding: 1.25rem; background: #f0f9ff; border-radius: 8px; border-left: 4px solid #0284c7;">
      <strong style="font-size: 14px; color: #0369a1; display: flex; align-items: center; gap: 6px;"><i class="fa-solid fa-user-doctor"></i> Lời dặn của bác sĩ:</strong>
      <p style="font-size: 14px; margin: 0.5rem 0 0 0; color: #334155; line-height: 1.6;">{$prescription.prescription_note}</p>
    </div>
    {/if}

    <div class="rx-footer" style="display: flex; justify-content: space-between; margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px dashed #cbd5e1;">
      <div>
        <p style="font-size: 14px; color: #475569; margin: 0 0 0.5rem 0;">Tái khám sau: <strong style="color: #0f172a;">{$prescription.followup_days|default:'—'} ngày</strong></p>
        <p style="font-size: 14px; color: #475569; margin: 0;">Ngày tái khám: <strong style="color: #0f172a;">{$prescription.followup_date|date_format:"%d/%m/%Y"|default:'—'}</strong></p>
      </div>
      <div style="text-align: center; min-width: 250px;">
        <p style="font-size: 14px; color: #475569; margin: 0; font-weight: 600;">Bác sĩ điều trị</p>
        <p style="font-size: 12px; color: #94a3b8; margin: 0 0 5rem 0; font-style: italic;">(Ký và ghi rõ họ tên)</p>
        <p style="margin: 0; font-weight: 700; font-size: 16px; color: #0f172a;">BS. {$prescription.doctor_name}</p>
        <p style="font-size: 13px; color: #64748b; margin: 0.2rem 0 0 0;">Chuyên khoa {$prescription.specialty}</p>
      </div>
    </div>

  </div>

  {else}
  {* ==========================================================
     CHẾ ĐỘ XEM DANH SÁCH (LIST)
     ========================================================== *}
  <div class="dashboard-card">
    <div class="rx-table-wrapper">
      <table class="rx-table">
        <thead>
          <tr>
            <th style="padding-left: 1.5rem;">Mã đơn</th>
            <th>Ngày kê</th>
            <th>Bác sĩ điều trị</th>
            <th>Chẩn đoán</th>
            <th style="text-align: center;">Số lượng</th>
            <th>Trạng thái</th>
            <th style="text-align: center; padding-right: 1.5rem;">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          {if isset($prescriptions) && $prescriptions|@count > 0}
            {foreach from=$prescriptions item=rx}
            <tr>
              <td style="padding-left: 1.5rem;">
                <code style="background:#f1f5f9; padding:4px 8px; border-radius:6px; font-weight: 600; color: #0f172a; border: 1px solid #e2e8f0;">{$rx.code}</code>
              </td>
              <td><span style="font-weight: 500; color: #334155;">{$rx.date|date_format:"%d/%m/%Y"}</span></td>
              <td style="font-weight: 600; color: #0284c7;">BS. {$rx.doctor_name}</td>
              <td style="color: #475569;">{$rx.diagnosis|default:'Chưa cập nhật'|truncate:35:'...'}</td>
              <td style="text-align: center;"><span class="badge badge--neutral">{$rx.drug_count|default:0} loại</span></td>
              <td>
                {if isset($rx.dispensed) && $rx.dispensed}
                  <span class="badge badge--success"><i class="fa-solid fa-check-circle"></i> Đã lấy thuốc</span>
                {else}
                  <span class="badge badge--warning"><i class="fa-solid fa-clock"></i> Chờ lấy thuốc</span>
                {/if}
              </td>
              <td style="text-align: center; padding-right: 1.5rem;">
                <a href="{$BASE_URL}/?page=prescriptions&id={$rx.id|default:$rx._id}" class="action-btn" title="Xem chi tiết đơn thuốc">
                  <i class="fa-solid fa-eye"></i>
                </a>
              </td>
            </tr>
            {/foreach}
          {else}
            <tr>
              <td colspan="7" style="padding: 5rem 2rem; text-align: center;">
                <i class="fa-solid fa-prescription-bottle" style="font-size: 3rem; color: #cbd5e1; margin-bottom: 1.5rem; display: block;"></i>
                <h3 style="margin: 0 0 0.5rem 0; color: #0f172a; font-size: 1.25rem;">Hồ sơ trống</h3>
                <p style="color: #64748b; margin: 0;">Bạn chưa có hồ sơ đơn thuốc nào trong hệ thống.</p>
              </td>
            </tr>
          {/if}
        </tbody>
      </table>
    </div>
  </div>
  {/if}

</div>

{include file="layout/footer.tpl"}
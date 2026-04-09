{include file="layout/header.tpl" page_title="Tổng quan Bệnh nhân" active_page="dashboard"}

<style>
  /* Layout Welcome */
  .patient-welcome { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; background: linear-gradient(to right, #f0f9ff, #e0f2fe); padding: 1.5rem 2rem; border-radius: 12px; margin-top: 1.5rem; margin-bottom: 2rem; border: 1px solid #bae6fd; }
  .patient-welcome__text h2 { margin: 0 0 0.5rem 0; font-size: 1.8rem; color: #0f172a; }
  .patient-welcome__text p { margin: 0; color: #475569; font-size: 1rem; }
  
  /* Thẻ thống kê 4 ô - FIX ICON CENTER */
  .patient-stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
  .patient-stat-card { background: #fff; padding: 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0; display: flex; align-items: center; gap: 1.25rem; text-decoration: none; transition: all 0.2s; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
  .patient-stat-card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-color: #0284c7; }
  
  .patient-stat-icon { 
    font-size: 1.5rem; color: var(--c); background: #f8fafc; 
    width: 56px; height: 56px; 
    display: flex; align-items: center; justify-content: center; /* Quan trọng để căn giữa icon */
    border-radius: 50%; flex-shrink: 0; 
  }
  .patient-stat-text p { margin: 0; font-size: 0.9rem; color: #64748b; font-weight: 500; }
  .patient-stat-text strong { font-size: 1.5rem; color: #0f172a; display: block; margin-top: 0.25rem; }

  /* Grid chính - FIX LỖI LỆCH TRANG */
  .dashboard-main-grid {
    display: grid;
    grid-template-columns: 1fr; /* Mobile 1 cột */
    gap: 1.5rem;
    margin-bottom: 2rem;
  }
  @media (min-width: 992px) { 
      .dashboard-main-grid { grid-template-columns: 1fr 1fr; /* PC 2 cột bằng nhau */ } 
  }

  .full-height-card {
    background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1.5rem;
    display: flex; flex-direction: column; height: 100%; box-shadow: 0 1px 3px rgba(0,0,0,0.05);
  }
  
  .empty-placeholder {
    flex: 1; display: flex; align-items: center; justify-content: center;
    border: 1px dashed #e2e8f0; border-radius: 8px; min-height: 150px; text-align: center;
  }

  @media (max-width: 768px) {
      .patient-welcome__btn { margin-top: 1rem; width: 100%; justify-content: center; }
  }
</style>

<div class="patient-welcome">
  <div class="patient-welcome__text">
    <h2>Xin chào, <span style="color:#0284c7;">{$current_user_name|default:"Bạn"}</span> 👋</h2>
    <p>Hôm nay {$smarty.now|date_format:"%d/%m/%Y"} — Chúc bạn một ngày nhiều sức khỏe!</p>
  </div>
  <a href="{$BASE_URL}/?page=book" class="btn-primary patient-welcome__btn" style="padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 500; background-color: #0284c7; color: #fff;">
    <i class="fa-regular fa-calendar-plus"></i> Đặt lịch khám mới
  </a>
</div>

{if isset($today_visit) && $today_visit}
<div class="dashboard-alert" style="background: #eff6ff; border-left: 4px solid #3b82f6; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem;">
  <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
    <div>
      <h3 style="color: #1e3a8a; margin-bottom: 0.5rem; font-size: 1.2rem;"><i class="fa-solid fa-truck-medical"></i> Lịch khám hôm nay</h3>
      <p style="margin: 0; color: #1e40af;">Khoa: <strong>{$today_visit.specialty}</strong> | Bác sĩ: <strong>{$today_visit.doctor_name}</strong></p>
      <div style="margin-top: 0.75rem;">
        <span class="badge" style="padding: 0.4rem 0.8rem; background: #dbeafe; color: #1e40af; border-radius: 6px;">STT: <strong>{$today_visit.queue_number|default:'Chờ cấp'}</strong></span>
        <span class="badge" style="padding: 0.4rem 0.8rem; margin-left: 0.5rem; background: #fef3c7; color: #92400e; border-radius: 6px;">{$today_visit.status_text|default:'Đang chờ'}</span>
      </div>
    </div>
    <button onclick="showQRCode('{$today_visit.qr_code}')" style="padding: 0.75rem 1.25rem; background: #0284c7; color: #fff; border: none; border-radius: 8px; cursor: pointer; font-weight: 500;">
      <i class="fa-solid fa-qrcode"></i> Mã QR Check-in
    </button>
  </div>
</div>
{/if}
<div class="patient-stats">
  <a href="{$BASE_URL}/?page=appointments" class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#0284c7"><i class="fa-regular fa-calendar-check"></i></div>
    <div class="patient-stat-text"><p>Lịch hẹn sắp tới</p><strong>{$stats.upcoming|default:0}</strong></div>
  </a>
  <a href="{$BASE_URL}/?page=prescriptions" class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#10b981"><i class="fa-solid fa-prescription-bottle-medical"></i></div>
    <div class="patient-stat-text"><p>Đơn thuốc của tôi</p><strong>{$stats.prescriptions|default:0}</strong></div>
  </a>
  <a href="{$BASE_URL}/?page=test-results" class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#8b5cf6"><i class="fa-solid fa-microscope"></i></div>
    <div class="patient-stat-text"><p>Kết quả xét nghiệm</p><strong>{$stats.test_results|default:0}</strong></div>
  </a>
  <a href="{$BASE_URL}/?page=records" class="patient-stat-card">
    <div class="patient-stat-icon" style="--c:#f59e0b"><i class="fa-solid fa-folder-open"></i></div>
    <div class="patient-stat-text"><p>Hồ sơ bệnh án</p><strong>{$stats.records|default:0}</strong></div>
  </a>
</div>

<div class="dashboard-main-grid">
  <div class="full-height-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 1rem;">
      <h3 style="margin: 0; font-size: 1.1rem; color: #0f172a;"><i class="fa-regular fa-calendar-days" style="color: #0284c7; margin-right: 5px;"></i> Lịch hẹn sắp tới</h3>
      <a href="{$BASE_URL}/?page=appointments" style="color: #0284c7; text-decoration: none; font-size: 0.85rem;">Xem tất cả &rarr;</a>
    </div>
    
    <div class="card-content-area" style="flex:1">
      {if isset($upcoming_appointments) && $upcoming_appointments|@count > 0}
        {foreach from=$upcoming_appointments item=apt}
          <div style="display: flex; gap: 1rem; padding: 1rem; border-bottom: 1px solid #f1f5f9; align-items: center;">
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 0.5rem; text-align: center; min-width: 70px;">
              <strong style="display: block; font-size: 1.3rem; color: #0284c7;">{$apt.date|date_format:"%d"}</strong>
              <small>{$apt.date|date_format:"%m/%Y"}</small>
            </div>
            <div style="flex: 1;">
              <strong style="color: #0f172a;">BS. {$apt.doctor_name}</strong>
              <p style="margin: 0; color: #64748b; font-size: 0.85rem;">Khoa: {$apt.specialty}</p>
            </div>
          </div>
        {/foreach}
      {else}
        <div class="empty-placeholder"><p style="color: #94a3b8;">Bạn không có lịch hẹn nào sắp tới.</p></div>
      {/if}
    </div>
  </div>

  <div class="full-height-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-bottom: 1px solid #f1f5f9; padding-bottom: 1rem;">
      <h3 style="margin: 0; font-size: 1.1rem; color: #0f172a;"><i class="fa-solid fa-folder-open" style="color: #f59e0b; margin-right: 5px;"></i> Hồ sơ khám gần đây</h3>
      <a href="{$BASE_URL}/?page=records" style="color: #0284c7; text-decoration: none; font-size: 0.85rem;">Tất cả hồ sơ &rarr;</a>
    </div>
    
    <div class="card-content-area" style="flex:1">
      {if isset($recent_records) && $recent_records|@count > 0}
        {foreach from=$recent_records item=rec}
          <div style="display: flex; align-items: center; gap: 1rem; padding: 0.75rem 0; border-bottom: 1px solid #f1f5f9;">
            <div style="flex: 1;">
              <strong style="color: #0f172a;">{$rec.diagnosis|default:'Chẩn đoán tổng quát'|truncate:40}</strong>
              <p style="margin: 0; color: #64748b; font-size: 0.8rem;">Ngày khám: {$rec.date|date_format:"%d/%m/%Y"}</p>
            </div>
            <a href="{$BASE_URL}/?page=records&id={$rec.id|default:$rec._id}" style="color: #0284c7;"><i class="fa-solid fa-chevron-right"></i></a>
          </div>
        {/foreach}
      {else}
        <div class="empty-placeholder"><p style="color: #94a3b8;">Chưa có hồ sơ bệnh án.</p></div>
      {/if}
    </div>
  </div>
</div>

{if isset($notifications) && $notifications|@count > 0}
<div class="full-height-card" style="margin-bottom: 2rem;">
  <h3 style="margin: 0 0 1rem 0; font-size: 1.1rem; color: #0f172a;"><i class="fa-regular fa-bell" style="color: #f59e0b; margin-right: 5px;"></i> Thông báo hệ thống</h3>
  <div class="notif-list">
    {foreach from=$notifications item=notif}
      <div style="padding: 1rem; border-bottom: 1px solid #f1f5f9; {if !$notif.is_read}background-color: #f0f9ff;{/if} border-radius: 8px; margin-bottom: 5px;">
        <p style="margin: 0; font-size: 0.95rem; color: #1e293b;">{$notif.message}</p>
        <small style="color: #64748b;">{$notif.created_at|date_format:"%H:%M %d/%m/%Y"}</small>
      </div>
    {/foreach}
  </div>
</div>
{/if}

<div id="qrModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
  <div style="background: #fff; padding: 2rem; border-radius: 12px; width: 90%; max-width: 350px; text-align: center; position: relative;">
    <span style="position: absolute; top: 10px; right: 15px; font-size: 24px; cursor: pointer;" onclick="document.getElementById('qrModal').style.display='none'">&times;</span>
    <h3 style="margin-bottom: 1rem;">Mã QR Check-in</h3>
    <div id="qrCodeContainer"></div>
    <p style="font-size: 0.85rem; color: #64748b; margin-top: 1rem;">Quét mã này tại quầy lễ tân khi đến khám.</p>
  </div>
</div>

<script>
{literal}
  function showQRCode(qrData) {
    if(!qrData) { alert("Dữ liệu QR chưa sẵn sàng."); return; }
    const container = document.getElementById('qrCodeContainer');
    container.innerHTML = `<img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrData}" style="border: 1px solid #e2e8f0; padding: 10px; border-radius: 8px;"/>`;
    document.getElementById('qrModal').style.display = 'flex';
  }
{/literal}
</script>

{include file="layout/footer.tpl"}
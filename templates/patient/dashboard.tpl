{include file="layout/sidebar.tpl" page_title="Tổng quan Bệnh nhân" active_page="dashboard"}

<style>
  /* --- TỔNG THỂ DASHBOARD --- */
  .patient-dashboard {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    max-width: 1200px;
    margin: 0 auto;
    padding-bottom: 2rem;
  }

  /* --- WELCOME BANNER --- */
  .welcome-banner {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    background: #fff;
    padding: 1.5rem 2rem;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    gap: 1rem;
  }
  .welcome-banner__text h2 { margin: 0 0 0.25rem 0; font-size: 1.5rem; color: #0f172a; font-weight: 600; }
  .welcome-banner__text p { margin: 0; color: #64748b; font-size: 1rem; }

  /* --- VÉ KHÁM HÔM NAY (TICKET) --- */
  .today-ticket {
    background: linear-gradient(135deg, #eff6ff, #dbeafe);
    border-left: 6px solid #2563eb;
    padding: 1.5rem 2rem;
    border-radius: 12px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1.5rem;
    box-shadow: 0 4px 10px rgba(37, 99, 235, 0.1);
  }
  .today-ticket__info h3 { color: #1e3a8a; margin: 0 0 0.5rem 0; font-size: 1.3rem; display: flex; align-items: center; gap: 8px; }
  .today-ticket__info p { margin: 0 0 0.75rem 0; color: #1e40af; font-size: 1.05rem; }
  .today-ticket__tags { display: flex; gap: 0.75rem; flex-wrap: wrap; }
  .tag-stt { padding: 0.4rem 1rem; background: #bfdbfe; color: #1d4ed8; border-radius: 8px; font-weight: 600; font-size: 1rem; }
  .tag-status { padding: 0.4rem 1rem; background: #fef3c7; color: #b45309; border-radius: 8px; font-weight: 600; font-size: 1rem; }
  .btn-qr {
    background: #2563eb; color: #fff; border: none; padding: 1rem 1.5rem; border-radius: 12px; 
    font-size: 1.1rem; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 10px;
    box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2); transition: transform 0.2s;
  }
  .btn-qr:hover { transform: translateY(-3px); background: #1d4ed8; }

  /* --- THỐNG KÊ 4 Ô --- */
  .stat-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
  }
  .stat-card {
    background: #fff; padding: 1.5rem; border-radius: 16px; border: 1px solid #e2e8f0;
    display: flex; align-items: center; gap: 1.25rem; text-decoration: none; 
    transition: all 0.2s; box-shadow: 0 2px 4px rgba(0,0,0,0.02);
  }
  .stat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-color: var(--c); }
  .stat-icon {
    font-size: 1.6rem; color: var(--c); background: var(--bg); 
    width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; 
    border-radius: 16px; flex-shrink: 0;
  }
  .stat-text p { margin: 0; font-size: 0.95rem; color: #64748b; font-weight: 500; }
  .stat-text strong { font-size: 1.6rem; color: #0f172a; display: block; margin-top: 0.25rem; font-weight: 700; }

  /* --- GRID NỘI DUNG CHÍNH --- */
  .content-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }
  @media (min-width: 1024px) { .content-grid { grid-template-columns: 1fr 1fr; } }
  
  .content-card {
    background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; 
    display: flex; flex-direction: column; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.02);
  }
  .content-card__header {
    padding: 1.25rem 1.5rem; background: #f8fafc; border-bottom: 1px solid #e2e8f0;
    display: flex; justify-content: space-between; align-items: center;
  }
  .content-card__header h3 { margin: 0; font-size: 1.15rem; color: #0f172a; font-weight: 600; display: flex; align-items: center; gap: 8px; }
  .content-card__link { color: #0284c7; text-decoration: none; font-size: 0.9rem; font-weight: 500; }
  .content-card__link:hover { text-decoration: underline; }
  .content-card__body { padding: 1rem 1.5rem; flex: 1; }

  /* --- ITEM LIST (Lịch hẹn & Hồ sơ) --- */
  .list-item {
    display: flex; gap: 1.25rem; padding: 1rem 0; border-bottom: 1px solid #f1f5f9; align-items: center;
  }
  .list-item:last-child { border-bottom: none; }
  .date-box {
    background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 10px; padding: 0.5rem; 
    text-align: center; min-width: 65px; display: flex; flex-direction: column; justify-content: center;
  }
  .date-box strong { font-size: 1.4rem; color: #0284c7; line-height: 1; margin-bottom: 3px; }
  .date-box small { font-size: 0.8rem; color: #0369a1; font-weight: 500; }
  
  .empty-state { text-align: center; padding: 2rem; color: #94a3b8; font-style: italic; }

  /* --- THÔNG BÁO --- */
  .notif-item {
    padding: 1rem 1.25rem; border-left: 4px solid transparent; border-bottom: 1px solid #f1f5f9;
    transition: background 0.2s;
  }
  .notif-item.unread { background-color: #f8fafc; border-left-color: #0284c7; }
  .notif-item p { margin: 0 0 0.25rem 0; font-size: 1rem; color: #1e293b; }
  .notif-item small { color: #64748b; font-size: 0.85rem; }
</style>

<div class="patient-dashboard">

  <div class="welcome-banner">
    <div class="welcome-banner__text">
      <h2>Xin chào, <span style="color:#0284c7;">{$current_user_name|default:"Bạn"}</span> 👋</h2>
      <p>Hôm nay là {$smarty.now|date_format:"%d/%m/%Y"} — Chúc bạn một ngày nhiều sức khỏe!</p>
    </div>
    <a href="{$BASE_URL}/?page=book" class="btn-primary" style="padding: 0.85rem 1.5rem; border-radius: 10px; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; font-weight: 600; background-color: #0f172a; color: #fff;">
      <i class="fa-solid fa-plus"></i> Đăng ký khám mới
    </a>
  </div>

  {if isset($today_visit) && $today_visit}
  <div class="today-ticket">
    <div class="today-ticket__info">
      <h3><i class="fa-solid fa-truck-medical"></i> Bạn có lịch khám hôm nay!</h3>
      <p>Khoa: <strong>{$today_visit.specialty}</strong> &nbsp;|&nbsp; Bác sĩ: <strong>{$today_visit.doctor_name}</strong></p>
      <div class="today-ticket__tags">
        <span class="tag-stt">STT Khám: {$today_visit.queue_number|default:'Đang chờ cấp'}</span>
        <span class="tag-status">{$today_visit.status_text|default:'Đang chờ'}</span>
      </div>
    </div>
    <button onclick="showQRCode('{$today_visit.qr_code}')" class="btn-qr">
      <i class="fa-solid fa-qrcode" style="font-size: 1.5rem;"></i> Xuất trình mã QR
    </button>
  </div>
  {/if}

  <div class="stat-grid">
    <a href="{$BASE_URL}/?page=appointments" class="stat-card" style="--c:#0284c7; --bg:#f0f9ff;">
      <div class="stat-icon"><i class="fa-regular fa-calendar-check"></i></div>
      <div class="stat-text"><p>Lịch hẹn sắp tới</p><strong>{$stats.upcoming|default:0}</strong></div>
    </a>
    <a href="{$BASE_URL}/?page=prescriptions" class="stat-card" style="--c:#10b981; --bg:#ecfdf5;">
      <div class="stat-icon"><i class="fa-solid fa-prescription-bottle-medical"></i></div>
      <div class="stat-text"><p>Đơn thuốc của tôi</p><strong>{$stats.prescriptions|default:0}</strong></div>
    </a>
    <a href="{$BASE_URL}/?page=test-results" class="stat-card" style="--c:#8b5cf6; --bg:#f5f3ff;">
      <div class="stat-icon"><i class="fa-solid fa-microscope"></i></div>
      <div class="stat-text"><p>Kết quả xét nghiệm</p><strong>{$stats.test_results|default:0}</strong></div>
    </a>
    <a href="{$BASE_URL}/?page=records" class="stat-card" style="--c:#f59e0b; --bg:#fffbeb;">
      <div class="stat-icon"><i class="fa-solid fa-folder-open"></i></div>
      <div class="stat-text"><p>Hồ sơ bệnh án</p><strong>{$stats.records|default:0}</strong></div>
    </a>
  </div>

  <div class="content-grid">
    
    <div class="content-card">
      <div class="content-card__header">
        <h3><i class="fa-regular fa-calendar-days" style="color: #0284c7;"></i> Lịch hẹn sắp tới</h3>
        <a href="{$BASE_URL}/?page=appointments" class="content-card__link">Xem tất cả</a>
      </div>
      <div class="content-card__body">
        {if isset($upcoming_appointments) && $upcoming_appointments|@count > 0}
          {foreach from=$upcoming_appointments item=apt}
            <div class="list-item">
              <div class="date-box">
                <strong>{$apt.date|date_format:"%d"}</strong>
                <small>Thg {$apt.date|date_format:"%m"}</small>
              </div>
              <div style="flex: 1;">
                <strong style="color: #0f172a; font-size: 1.1rem; display: block; margin-bottom: 4px;">BS. {$apt.doctor_name}</strong>
                <span style="color: #64748b; font-size: 0.95rem; display: flex; gap: 10px;">
                  <span><i class="fa-solid fa-stethoscope"></i> Khoa {$apt.specialty}</span>
                  <span><i class="fa-regular fa-clock"></i> {$apt.time|default:'Sáng'}</span>
                </span>
              </div>
            </div>
          {/foreach}
        {else}
          <div class="empty-state">Bạn chưa có lịch hẹn nào sắp tới.</div>
        {/if}
      </div>
    </div>

    <div class="content-card">
      <div class="content-card__header">
        <h3><i class="fa-solid fa-notes-medical" style="color: #f59e0b;"></i> Hồ sơ khám gần đây</h3>
        <a href="{$BASE_URL}/?page=records" class="content-card__link">Tất cả hồ sơ</a>
      </div>
      <div class="content-card__body">
        {if isset($recent_records) && $recent_records|@count > 0}
          {foreach from=$recent_records item=rec}
            <a href="{$BASE_URL}/?page=records&id={$rec.id|default:$rec._id}" class="list-item" style="text-decoration: none; transition: background 0.2s; border-radius: 8px; padding: 1rem;">
              <div style="flex: 1;">
                <strong style="color: #0f172a; font-size: 1.05rem; display: block; margin-bottom: 4px;">{$rec.diagnosis|default:'Chẩn đoán tổng quát'|truncate:50}</strong>
                <span style="color: #64748b; font-size: 0.9rem;"><i class="fa-regular fa-calendar"></i> Ngày khám: {$rec.date|date_format:"%d/%m/%Y"}</span>
              </div>
              <div style="color: #0284c7; background: #f0f9ff; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-chevron-right"></i>
              </div>
            </a>
          {/foreach}
        {else}
          <div class="empty-state">Hệ thống chưa ghi nhận hồ sơ bệnh án nào.</div>
        {/if}
      </div>
    </div>

  </div>

  {if isset($notifications) && $notifications|@count > 0}
  <div class="content-card" style="margin-bottom: 2rem;">
    <div class="content-card__header">
      <h3><i class="fa-regular fa-bell" style="color: #ef4444;"></i> Thông báo mới</h3>
    </div>
    <div style="padding: 0;">
      {foreach from=$notifications item=notif}
        <div class="notif-item {if !$notif.is_read}unread{/if}">
          <p>{$notif.message}</p>
          <small><i class="fa-regular fa-clock"></i> {$notif.created_at|date_format:"%H:%M - %d/%m/%Y"}</small>
        </div>
      {/foreach}
    </div>
  </div>
  {/if}

</div> 

<div id="qrModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.7); align-items: center; justify-content: center; backdrop-filter: blur(4px);">
  <div style="background: #fff; padding: 2.5rem 2rem; border-radius: 20px; width: 90%; max-width: 360px; text-align: center; position: relative; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);">
    <span style="position: absolute; top: 15px; right: 20px; font-size: 28px; color: #64748b; cursor: pointer; transition: color 0.2s;" onclick="document.getElementById('qrModal').style.display='none'" onmouseover="this.style.color='#0f172a'" onmouseout="this.style.color='#64748b'">&times;</span>
    <h3 style="margin: 0 0 1.5rem 0; color: #0f172a; font-size: 1.4rem;">Mã QR Check-in</h3>
    <div id="qrCodeContainer" style="background: #f8fafc; padding: 1.5rem; border-radius: 16px; display: inline-block;"></div>
    <p style="font-size: 0.95rem; color: #475569; margin-top: 1.5rem; line-height: 1.5;">Vui lòng đưa mã này cho nhân viên lễ tân hoặc quét tại Kiosk khi bạn đến phòng khám.</p>
  </div>
</div>

<script>
{literal}
  function showQRCode(qrData) {
    if(!qrData) { alert("Dữ liệu QR chưa sẵn sàng. Vui lòng liên hệ lễ tân."); return; }
    const container = document.getElementById('qrCodeContainer');
    // Tăng kích thước ảnh QR lên một chút để dễ quét hơn
    container.innerHTML = `<img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=${encodeURIComponent(qrData)}" style="display: block; margin: 0 auto;"/>`;
    document.getElementById('qrModal').style.display = 'flex';
  }
  
  // Đóng modal khi click ra ngoài vùng trắng
  window.onclick = function(event) {
    let modal = document.getElementById('qrModal');
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
{/literal}
</script>

{include file="layout/footer.tpl"}
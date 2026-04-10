{include file="layout/sidebar.tpl" page_title="Quản lý lịch hẹn" active_page="appointments"}

<style>
  .booking-wrapper { max-width: 1000px; margin: 2rem auto 4rem auto; padding: 0 1.5rem; }
  
  /* Toolbar */
  .page-toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }
  .page-title { margin: 0; font-size: 1.5rem; color: #0f172a; display: flex; align-items: center; gap: 10px; }
  
  /* Tabs Filter */
  .tabs { margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; display: flex; gap: 2rem; overflow-x: auto; white-space: nowrap; padding-bottom: 1px; }
  .tabs a { padding: 0.75rem 0; font-weight: 500; text-decoration: none; color: #64748b; border-bottom: 2px solid transparent; transition: all 0.2s; }
  .tabs a:hover { color: #0284c7; }
  .tabs a.active { color: #0284c7; border-bottom-color: #0284c7; }

  /* Thẻ lịch hẹn */
  .appt-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 16px; padding: 1.5rem; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.02); transition: all 0.2s; }
  .appt-card:hover { border-color: #bae6fd; box-shadow: 0 6px 15px rgba(2, 132, 199, 0.08); transform: translateY(-2px); }
  .appt-info { display: flex; gap: 1.5rem; align-items: center; flex: 1; min-width: 280px; }
  .appt-date { background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 12px; padding: 0.75rem 1rem; text-align: center; min-width: 85px; }
  .appt-date strong { display: block; font-size: 1.8rem; color: #0284c7; line-height: 1; margin-bottom: 5px; font-weight: 700; }
  .appt-date span { font-size: 0.85rem; color: #0369a1; font-weight: 600; text-transform: uppercase; }
  .appt-details h4 { margin: 0 0 0.5rem 0; color: #0f172a; font-size: 1.2rem; }
  .appt-details p { margin: 0 0 0.35rem 0; color: #475569; font-size: 0.95rem; }
  .badge { padding: 4px 10px; border-radius: 6px; font-size: 0.8rem; font-weight: 600; display: inline-block; }

  /* Modal Chi tiết */
  .modal-detail { display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(15, 23, 42, 0.7); align-items: center; justify-content: center; backdrop-filter: blur(4px); }
  .modal-content { background: #fff; border-radius: 20px; width: 95%; max-width: 650px; max-height: 90vh; overflow-y: auto; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }
  .modal-header { padding: 1.5rem 2rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; background: #f8fafc; border-radius: 20px 20px 0 0; position: sticky; top: 0; z-index: 10; }
  .modal-body { padding: 2rem; }
  .close-btn { font-size: 1.8rem; color: #94a3b8; cursor: pointer; border: none; background: transparent; padding: 0; line-height: 1; }
  .close-btn:hover { color: #ef4444; }

  /* Mã QR */
  .qr-section { text-align: center; margin-bottom: 2.5rem; padding-bottom: 2rem; border-bottom: 1px dashed #cbd5e1; }
  .qr-box { display: inline-block; padding: 15px; background: #fff; border: 2px solid #e2e8f0; border-radius: 16px; margin-bottom: 1rem; }
  .qr-code { display: block; width: 180px; height: 180px; }

  /* Timeline Trạng thái (Tối ưu lướt ngang trên Mobile) */
  .timeline-container { overflow-x: auto; padding-bottom: 1rem; margin-bottom: 1.5rem; }
  .tracking-wrapper { position: relative; padding: 0 20px; min-width: 550px; /* Đảm bảo đủ rộng không vỡ trên mobile */ }
  .tracking-line { position: absolute; top: 22px; left: 50px; right: 50px; height: 4px; background: #f1f5f9; z-index: 1; border-radius: 2px; }
  .tracking-line-fill { position: absolute; top: 0; left: 0; height: 100%; background: #10b981; border-radius: 2px; transition: width 0.5s ease; }
  .tracking-steps { display: flex; justify-content: space-between; position: relative; z-index: 2; }
  .track-step { display: flex; flex-direction: column; align-items: center; width: 90px; }
  .track-icon { width: 48px; height: 48px; border-radius: 50%; background: #fff; border: 4px solid #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; color: #94a3b8; transition: all 0.3s; }
  .track-text { margin-top: 12px; font-size: 0.85rem; color: #64748b; font-weight: 500; text-align: center; line-height: 1.3; }
  
  .track-step.completed .track-icon { border-color: #10b981; background: #10b981; color: #fff; }
  .track-step.completed .track-text { color: #059669; }
  .track-step.active .track-icon { border-color: #0284c7; background: #fff; color: #0284c7; box-shadow: 0 0 0 5px #e0f2fe; }
  .track-step.active .track-text { color: #0284c7; font-weight: 600; }
</style>

<div class="booking-wrapper">
  <div class="page-toolbar">
    <div class="page-toolbar__left">
      <h2 class="page-title"><i class="fa-regular fa-calendar-check" style="color: #0284c7;"></i> Lịch hẹn của tôi</h2>
    </div>
    <div class="page-toolbar__right">
      <a href="{$BASE_URL|default:$base_url}/?page=book" class="btn-primary" style="background: linear-gradient(135deg, #0ea5e9, #0284c7); color: #fff; padding: 0.85rem 1.5rem; border-radius: 10px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 6px -1px rgba(2, 132, 199, 0.2);">
        <i class="fa-solid fa-plus"></i> Đặt lịch mới
      </a>
    </div>
  </div>

  <div class="tabs">
    <a href="?page=appointments&status=all" class="{if $filter.status|default:'all' == 'all'}active{/if}">Tất cả ({$count.all|default:0})</a>
    <a href="?page=appointments&status=pending" class="{if $filter.status|default:'all' == 'pending'}active{/if}">Chờ khám ({$count.pending|default:0})</a>
  </div>

  <div class="appointments-list">
    {if isset($appointments) && $appointments|@count > 0}
      {foreach from=$appointments item=apt}
      <div class="appt-card">
        <div class="appt-info">
          <div class="appt-date">
            <strong>{$apt.date|date_format:"%d"}</strong>
            <span>Thg {$apt.date|date_format:"%m"}</span>
          </div>
          <div class="appt-details">
            <h4>BS. {$apt.doctor_name}</h4>
            <p><i class="fa-solid fa-stethoscope" style="color: #94a3b8; width: 20px;"></i> Khoa {$apt.specialty}</p>
            <p><i class="fa-regular fa-clock" style="color: #94a3b8; width: 20px;"></i> {$apt.time} | Ngày {$apt.date|date_format:"%d/%m/%Y"}</p>
            <div style="margin-top: 0.75rem;">
                <span class="badge" style="
                    {if $apt.status == 'pending'}background: #fef3c7; color: #d97706;
                    {elseif $apt.status == 'completed'}background: #dcfce7; color: #15803d;
                    {else}background: #e0f2fe; color: #0369a1;{/if}">
                    <i class="fa-solid fa-circle-dot" style="font-size: 0.6rem; margin-right: 4px;"></i> {$apt.status_text}
                </span>
                <span class="badge" style="background:#f8fafc; color:#475569; border: 1px solid #e2e8f0; margin-left:8px;">Mã: {$apt.code}</span>
            </div>
          </div>
        </div>
        <div class="appt-actions">
          <button onclick="openDetailModal('{$apt.id}')" style="background: #f0f9ff; color: #0284c7; padding: 0.75rem 1.25rem; border-radius: 10px; border: 1px solid #bae6fd; cursor: pointer; display: flex; align-items: center; gap: 8px; font-weight: 600; transition: all 0.2s;">
            <i class="fa-solid fa-shoe-prints"></i> Theo dõi tiến trình
          </button>
        </div>
      </div>
      {/foreach}
    {else}
      <div class="empty-state" style="text-align: center; padding: 5rem 1rem; background: #fff; border-radius: 16px; border: 1px dashed #cbd5e1;">
        <i class="fa-regular fa-calendar-xmark" style="font-size: 3.5rem; color: #cbd5e1; margin-bottom: 1.5rem;"></i>
        <h3 style="color: #0f172a; margin-bottom: 0.5rem; font-size: 1.25rem;">Không tìm thấy lịch hẹn</h3>
        <p style="color: #64748b;">Bạn hiện tại chưa có lịch hẹn nào trong danh sách này.</p>
      </div>
    {/if}
  </div>

  <div id="detailModal" class="modal-detail">
    <div class="modal-content">
      <div class="modal-header">
        <div>
          <h3 style="margin: 0; color: #0f172a; font-size: 1.3rem;">Tiến trình khám bệnh</h3>
          <p style="margin: 5px 0 0 0; color: #64748b; font-size: 0.95rem;">Mã hồ sơ: <strong id="m_code" style="color: #0284c7;">—</strong></p>
        </div>
        <button class="close-btn" onclick="closeDetailModal()">&times;</button>
      </div>
      
      <div class="modal-body">
        <div class="qr-section">
          <div class="qr-box"><img id="m_qr_img" class="qr-code" src="" alt="QR Code"></div>
          <p style="margin: 0; color: #475569; font-size: 0.95rem; font-weight: 500;">Đưa mã này cho Lễ tân hoặc quét tại Kiosk</p>
        </div>

        <h4 style="margin: 0 0 1.5rem 0; color: #0f172a; font-size: 1.1rem;">Trạng thái hiện tại</h4>
        <div class="timeline-container">
          <div class="tracking-wrapper">
            <div class="tracking-line"><div id="m_progress_bar" class="tracking-line-fill"></div></div>
            <div class="tracking-steps">
              <div class="track-step" id="ts_pending"><div class="track-icon"><i class="fa-solid fa-file-signature"></i></div><div class="track-text">Xác nhận</div></div>
              <div class="track-step" id="ts_waiting"><div class="track-icon"><i class="fa-solid fa-hospital-user"></i></div><div class="track-text">Chờ khám</div></div>
              <div class="track-step" id="ts_consulting"><div class="track-icon"><i class="fa-solid fa-user-doctor"></i></div><div class="track-text">Đang khám</div></div>
              <div class="track-step" id="ts_billing"><div class="track-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div><div class="track-text">Thanh toán</div></div>
              <div class="track-step" id="ts_pharmacy"><div class="track-icon"><i class="fa-solid fa-pills"></i></div><div class="track-text">Lấy thuốc</div></div>
              <div class="track-step" id="ts_completed"><div class="track-icon"><i class="fa-solid fa-check-double"></i></div><div class="track-text">Hoàn thành</div></div>
            </div>
          </div>
        </div>

        <div style="background: #f8fafc; padding: 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0; margin-top: 1rem;">
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div>
              <small style="color: #64748b; display: block; margin-bottom: 4px;">Bác sĩ phụ trách</small>
              <strong id="m_doctor" style="color: #0f172a; font-size: 1.05rem;">—</strong>
            </div>
            <div>
              <small style="color: #64748b; display: block; margin-bottom: 4px;">Chuyên khoa</small>
              <strong id="m_specialty" style="color: #0f172a; font-size: 1.05rem;">—</strong>
            </div>
            <div style="grid-column: span 2;">
              <small style="color: #64748b; display: block; margin-bottom: 4px;">Thời gian hẹn</small>
              <strong id="m_datetime" style="color: #0284c7; font-size: 1.05rem;">—</strong>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

{include file="layout/footer.tpl"}

<script>
// Nhận dữ liệu JSON từ Controller
const appointmentsData = {$appointments_json|default:'[]'};

{literal}
function openDetailModal(apptId) {
    const appt = appointmentsData.find(a => a.id === apptId);
    if (!appt) return;

    // 1. Đổ dữ liệu Text
    document.getElementById('m_code').textContent = appt.code;
    document.getElementById('m_doctor').textContent = 'BS. ' + appt.doctor_name;
    document.getElementById('m_specialty').textContent = appt.specialty;
    
    // Xử lý hiển thị ngày tháng
    const d = new Date(appt.date);
    // Xử lý fallback nếu trình duyệt không parse được date chuẩn
    let dateStr = appt.date; 
    if(!isNaN(d)) {
        dateStr = d.toLocaleDateString('vi-VN');
    }
    document.getElementById('m_datetime').textContent = `${appt.time} | Ngày ${dateStr}`;

    // 2. Tạo mã QR (API QR Server)
    document.getElementById('m_qr_img').src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${appt.code}`;

    // 3. Logic Timeline
    const steps = ['pending', 'waiting', 'consulting', 'billing', 'pharmacy', 'completed'];
    let currentIndex = steps.indexOf(appt.status);
    if (currentIndex === -1) currentIndex = 0; 

    // Reset & Update class
    steps.forEach((step, index) => {
        const el = document.getElementById('ts_' + step);
        if(!el) return;
        el.classList.remove('completed', 'active');
        if (index < currentIndex) el.classList.add('completed');
        else if (index === currentIndex) el.classList.add('active');
    });

    // Cập nhật thanh ProgressBar ngang
    const progressPercent = (currentIndex / (steps.length - 1)) * 100;
    document.getElementById('m_progress_bar').style.width = progressPercent + '%';

    // Hiển thị Modal
    document.getElementById('detailModal').style.display = 'flex';
}

function closeDetailModal() {
    document.getElementById('detailModal').style.display = 'none';
}

// Đóng modal khi click ra ngoài vùng trắng
window.onclick = function(event) {
    const modal = document.getElementById('detailModal');
    if (event.target == modal) closeDetailModal();
}
{/literal}
</script>
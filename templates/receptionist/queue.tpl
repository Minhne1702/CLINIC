{include file="layout/sidebar.tpl" page_title="Hàng chờ khám" active_page="queue"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title">
      <i class="fa-solid fa-list-ol"></i> Hàng chờ khám 
      <span class="badge badge--success" style="font-size: 10px; margin-left: 10px; animation: pulse 2s infinite;">
        <i class="fa-solid fa-circle-dot"></i> Live Sync
      </span>
    </h2>
    <p class="page-subtitle">Theo dõi luồng bệnh nhân và phát thanh gọi số</p>
  </div>
  <div class="page-toolbar__right" style="display: flex; gap: 1rem; align-items: center;">
    
    <form method="GET" action="{$BASE_URL}/" id="roomFilterForm">
      <input type="hidden" name="role" value="receptionist">
      <input type="hidden" name="page" value="queue">
      <select name="room_id" class="form-control" onchange="document.getElementById('roomFilterForm').submit()" style="min-width: 200px;">
        <option value="">-- Tất cả phòng khám --</option>
        {foreach from=$rooms item=room}
          <option value="{$room._id}" {if $filter.room_id == $room._id}selected{/if}>{$room.name} ({$room.doctor_name})</option>
        {/foreach}
      </select>
    </form>

    <button class="btn-admin-primary" onclick="callNext()" style="background: #10b981; border: none;">
      <i class="fa-solid fa-bullhorn"></i> Gọi tiếp theo
    </button>
  </div>
</div>

<style>
  @keyframes pulse { 0% { opacity: 1; } 50% { opacity: 0.5; } 100% { opacity: 1; } }
  .queue-card { border-left: 4px solid #cbd5e1; transition: transform 0.2s; }
  .queue-card:hover { transform: translateX(4px); }
  .queue-card--emergency { border-left-color: #ef4444; background: #fef2f2; }
  .queue-card--elderly { border-left-color: #f59e0b; }
  .queue-card--child { border-left-color: #3b82f6; }
</style>

<div class="queue-board">
  
  <div class="queue-col">
    <div class="queue-col__header queue-col__header--waiting">
      <i class="fa-solid fa-clock"></i> Chờ khám <span class="tab-count tab-count--warning">{$count.waiting|default:0}</span>
    </div>
    <div class="queue-col__body" id="waiting-list">
      {foreach from=$queue item=q}
      {if $q.status == 'waiting'}
      <div class="queue-card queue-card--{$q.priority|default:'normal'}" data-no="{$q.queue_no}" data-name="{$q.patient_name}" data-room="{$q.room_name|default:'Phòng khám'}">
        <div class="queue-card__num" style="{if $q.priority=='emergency'}color:#ef4444;background:#fee2e2;{/if}">{$q.queue_no}</div>
        <div class="queue-card__info">
          <strong>{$q.patient_name}</strong>
          <p style="color: #64748b; font-size: 13px;">{$q.doctor_name}</p>
          <div style="margin-top: 4px;">
            {if $q.priority=='emergency'}<span class="badge badge--danger" style="font-size:10px;">Cấp cứu</span>
            {elseif $q.priority=='elderly'}<span class="badge badge--orange" style="font-size:10px;">> 65 tuổi</span>
            {elseif $q.priority=='child'}<span class="badge badge--blue" style="font-size:10px;">< 5 tuổi</span>
            {/if}
          </div>
        </div>
        <div class="queue-card__actions">
          <button onclick="callPatient('{$q.queue_no}', '{$q.patient_name}', '{$q.room_name|default:'Phòng khám'}')" class="btn-admin-secondary" style="font-size:12px; padding:.35rem .75rem; border-color: #cbd5e1;">
            <i class="fa-solid fa-volume-high"></i> Đọc tên
          </button>
        </div>
      </div>
      {/if}
      {foreachelse}
        <div class="empty-state" style="padding: 2rem; border: none;"><p>Trống</p></div>
      {/foreach}
    </div>
  </div>

  <div class="queue-col">
    <div class="queue-col__header queue-col__header--progress">
      <i class="fa-solid fa-stethoscope"></i> Đang khám <span class="tab-count tab-count--blue">{$count.in_progress|default:0}</span>
    </div>
    <div class="queue-col__body">
      {foreach from=$queue item=q}{if $q.status=='in_progress'}
      <div class="queue-card queue-card--active" style="border-left: 4px solid #0ea5e9;">
        <div class="queue-card__num" style="background:rgba(14,165,233,.15); color:#0369a1;">{$q.queue_no}</div>
        <div class="queue-card__info">
          <strong>{$q.patient_name}</strong>
          <p style="color: #64748b; font-size: 13px;">{$q.doctor_name}</p>
          <span class="badge badge--blue" style="font-size:10px; margin-top: 4px;">Trong phòng</span>
        </div>
      </div>
      {/if}{/foreach}
    </div>
  </div>

  <div class="queue-col">
    <div class="queue-col__header queue-col__header--done">
      <i class="fa-solid fa-circle-check"></i> Đã khám xong <span class="tab-count tab-count--success">{$count.done|default:0}</span>
    </div>
    <div class="queue-col__body">
      {foreach from=$queue item=q}{if $q.status=='done'}
      <div class="queue-card queue-card--done" style="opacity: 0.7;">
        <div class="queue-card__num" style="background:rgba(16,185,129,.1); color:var(--admin-success)">{$q.queue_no}</div>
        <div class="queue-card__info">
          <strong>{$q.patient_name}</strong>
          <p style="font-size:12px; color: #94a3b8;"><i class="fa-regular fa-clock"></i> Hoàn tất lúc: {$q.end_time|default:'--:--'}</p>
        </div>
      </div>
      {/if}{/foreach}
    </div>
  </div>

</div>

{include file="layout/footer.tpl"}

<script>
function speak(text) {
  if ('speechSynthesis' in window) {
    // Hủy các câu lệnh đang đọc dở để đọc câu mới ngay lập tức
    window.speechSynthesis.cancel(); 
    
    let msg = new SpeechSynthesisUtterance();
    msg.text = text;
    msg.lang = 'vi-VN'; 
    msg.rate = 0.9;     // Tốc độ đọc (1 là mặc định, 0.9 để đọc rõ hơn)
    msg.pitch = 1;      // Độ cao giọng
    
    window.speechSynthesis.speak(msg);
  } else {
    console.warn("Trình duyệt của bạn không hỗ trợ Text-to-Speech");
  }
}

// Gọi một bệnh nhân cụ thể
function callPatient(no, name, room) {
  // Tạo câu đọc tự nhiên
  const announcement = "Xin mời bệnh nhân số " + no + ", " + name + ", vui lòng vào " + room;
  
  // Phát âm thanh
  speak(announcement);
  
  // Vẫn giữ alert hoặc dùng Toast/Notification để Lễ tân biết hệ thống đang gọi
  // alert('Đang phát loa: ' + announcement);
}

// Tự động gọi người đầu tiên trong hàng chờ
function callNext() {
  // Lấy thẻ đầu tiên trong danh sách chờ (Vì backend đã sort đúng thứ tự ưu tiên rồi)
  const firstCard = document.querySelector('#waiting-list .queue-card');
  
  if (firstCard) { 
    const no = firstCard.getAttribute('data-no');
    const name = firstCard.getAttribute('data-name');
    const room = firstCard.getAttribute('data-room');
    
    callPatient(no, name, room); 
    
    // Đổi màu nền nhẹ để báo hiệu đang gọi thẻ này
    firstCard.style.backgroundColor = '#fef9c3'; 
    setTimeout(() => { firstCard.style.backgroundColor = ''; }, 3000);
  } else {
    alert('Không còn bệnh nhân trong hàng chờ.');
  }
}
</script>
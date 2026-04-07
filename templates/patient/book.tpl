{include file="layout/sidebar.tpl" page_title="Đặt lịch khám" active_page="book"}

<div class="page-toolbar">
  <div class="page-toolbar__left">
    <h2 class="page-title"><i class="fa-regular fa-calendar-plus"></i> Đặt lịch khám</h2>
    <p class="page-subtitle">Chọn chuyên khoa, bác sĩ và thời gian phù hợp với bạn</p>
  </div>
</div>

{if $success_message}
<div class="alert alert--success">
  <i class="fa-solid fa-circle-check"></i> {$success_message}
  <a href="{$base_url}/?page=appointments" style="font-weight:600;margin-left:.5rem">Xem lịch hẹn →</a>
</div>
{/if}
{if $error_message}
<div class="alert alert--danger"><i class="fa-solid fa-circle-exclamation"></i> {$error_message}</div>
{/if}

<div class="booking-steps">
  <div class="booking-step active" id="step-ind-1"><span>1</span> Hình thức & Chuyên khoa</div>
  <div class="booking-step-line"></div>
  <div class="booking-step" id="step-ind-2"><span>2</span> Chọn bác sĩ</div>
  <div class="booking-step-line"></div>
  <div class="booking-step" id="step-ind-3"><span>3</span> Ngày & Giờ</div>
  <div class="booking-step-line"></div>
  <div class="booking-step" id="step-ind-4"><span>4</span> Xác nhận</div>
</div>

<form action="{$base_url}/?page=book" method="POST" id="bookingForm">
  <input type="hidden" name="action" value="submit">

  <!-- STEP 1 -->
  <div class="booking-pane active" id="step-1">
    <div class="admin-card">
      <div class="admin-card__header"><h3>Bước 1: Hình thức khám & Chuyên khoa</h3></div>
      <div class="admin-card__body">
        <div class="form-group">
          <label style="font-size:14px;font-weight:600;margin-bottom:.75rem;display:block">Hình thức khám <span class="required">*</span></label>
          <div class="type-options">
            <label class="type-option">
              <input type="radio" name="type" value="offline" checked>
              <div class="type-option__card">
                <i class="fa-solid fa-hospital"></i>
                <strong>Khám trực tiếp</strong>
                <p>Đến phòng khám theo lịch hẹn</p>
              </div>
            </label>
            <label class="type-option">
              <input type="radio" name="type" value="online">
              <div class="type-option__card">
                <i class="fa-solid fa-video"></i>
                <strong>Khám từ xa</strong>
                <p>Tư vấn qua video call</p>
              </div>
            </label>
          </div>
        </div>

        <div class="form-group" style="margin-top:2rem">
          <label style="font-size:14px;font-weight:600;margin-bottom:.75rem;display:block">Chuyên khoa <span class="required">*</span></label>
          <div class="specialty-grid">
            {if $specialties}
              {foreach from=$specialties item=spec}
              <label class="specialty-option">
                <input type="radio" name="specialty_id" value="{$spec._id}" required>
                <div class="specialty-option__card">
                  <i class="{$spec.icon|default:'fa-solid fa-stethoscope'}"></i>
                  <span>{$spec.name}</span>
                </div>
              </label>
              {/foreach}
            {else}
              {foreach from=['Tim mạch','Nhi khoa','Da liễu','Nha khoa','Thần kinh','Tiêu hóa','Mắt','Tai Mũi Họng','Cơ xương khớp','Nội tiết','Phụ khoa','Sức khỏe tâm thần'] item=sname key=sidx}
              <label class="specialty-option">
                <input type="radio" name="specialty_id" value="{$sidx}">
                <div class="specialty-option__card">
                  <i class="fa-solid fa-stethoscope"></i>
                  <span>{$sname}</span>
                </div>
              </label>
              {/foreach}
            {/if}
          </div>
        </div>

        <div class="booking-nav">
          <span></span>
          <button type="button" class="btn-admin-primary" onclick="nextStep(1)">
            Tiếp theo <i class="fa-solid fa-arrow-right"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- STEP 2 -->
  <div class="booking-pane" id="step-2">
    <div class="admin-card">
      <div class="admin-card__header"><h3>Bước 2: Chọn bác sĩ</h3></div>
      <div class="admin-card__body">
        <div class="doctor-picker-grid">
          {if $doctors}
            {foreach from=$doctors item=doc}
            <label class="doctor-picker-card">
              <input type="radio" name="doctor_id" value="{$doc._id}">
              <div class="doctor-picker-card__inner">
                <div class="doctor-picker-card__avatar">
                  {if $doc.avatar}<img src="{$doc.avatar}" alt="">
                  {else}<i class="fa-solid fa-user-doctor"></i>{/if}
                </div>
                <div class="doctor-picker-card__info">
                  <strong>{$doc.full_name}</strong>
                  <p>{$doc.degree|default:'Bác sĩ'}</p>
                  <p class="text-muted" style="font-size:12px">{$doc.specialty}</p>
                  <span class="badge badge--warning" style="font-size:11px"><i class="fa-solid fa-star"></i> {$doc.rating|default:'5.0'} ({$doc.review_count|default:0})</span>
                </div>
              </div>
            </label>
            {/foreach}
          {else}
            <div class="empty-state" style="padding:2rem;grid-column:1/-1">
              <i class="fa-solid fa-user-doctor"></i>
              <p>Vui lòng chọn chuyên khoa ở bước 1 để xem danh sách bác sĩ</p>
            </div>
          {/if}
        </div>
        <div class="booking-nav">
          <button type="button" class="btn-admin-ghost" onclick="prevStep(2)"><i class="fa-solid fa-arrow-left"></i> Quay lại</button>
          <button type="button" class="btn-admin-primary" onclick="nextStep(2)">Tiếp theo <i class="fa-solid fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </div>

  <!-- STEP 3 -->
  <div class="booking-pane" id="step-3">
    <div class="admin-card">
      <div class="admin-card__header"><h3>Bước 3: Chọn ngày & giờ khám</h3></div>
      <div class="admin-card__body">
        <div class="form-row-2">
          <div class="form-group">
            <label>Ngày khám <span class="required">*</span></label>
            <input type="date" name="date" id="bookDate" required
              min="{$smarty.now|date_format:'%Y-%m-%d'}">
          </div>
          <div class="form-group">
            <label>Triệu chứng ban đầu <span class="text-muted" style="font-weight:400">(không bắt buộc)</span></label>
            <input type="text" name="note_brief" placeholder="VD: Đau đầu, sốt nhẹ 2 ngày...">
          </div>
        </div>

        <div class="form-group" style="margin-top:1rem">
          <label>Chọn khung giờ <span class="required">*</span></label>
          <div class="timeslot-grid">
            {foreach from=['07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30'] item=slot}
            <label class="timeslot">
              <input type="radio" name="time" value="{$slot}" required>
              <span>{$slot}</span>
            </label>
            {/foreach}
          </div>
        </div>

        <div class="booking-nav">
          <button type="button" class="btn-admin-ghost" onclick="prevStep(3)"><i class="fa-solid fa-arrow-left"></i> Quay lại</button>
          <button type="button" class="btn-admin-primary" onclick="nextStep(3)">Tiếp theo <i class="fa-solid fa-arrow-right"></i></button>
        </div>
      </div>
    </div>
  </div>

  <!-- STEP 4 -->
  <div class="booking-pane" id="step-4">
    <div class="admin-card">
      <div class="admin-card__header"><h3>Bước 4: Xác nhận thông tin đặt lịch</h3></div>
      <div class="admin-card__body">

        <div class="confirm-summary">
          <div class="confirm-row"><span>Hình thức:</span><strong id="conf-type">—</strong></div>
          <div class="confirm-row"><span>Chuyên khoa:</span><strong id="conf-specialty">—</strong></div>
          <div class="confirm-row"><span>Bác sĩ:</span><strong id="conf-doctor">—</strong></div>
          <div class="confirm-row"><span>Ngày khám:</span><strong id="conf-date">—</strong></div>
          <div class="confirm-row"><span>Giờ khám:</span><strong id="conf-time">—</strong></div>
        </div>

        <div class="form-group" style="margin-top:1.5rem">
          <label>Mô tả triệu chứng chi tiết</label>
          <textarea name="symptoms" rows="4" placeholder="Mô tả chi tiết triệu chứng để bác sĩ chuẩn bị trước (không bắt buộc)..."></textarea>
        </div>

        <div class="alert alert--warning" style="margin-top:1rem">
          <i class="fa-solid fa-triangle-exclamation"></i>
          Vui lòng đến trước giờ hẹn <strong>15 phút</strong>.
          Mang theo CCCD và thẻ BHYT (nếu có).
          Có thể hủy lịch trước <strong>2 tiếng</strong>.
        </div>

        <div class="booking-nav">
          <button type="button" class="btn-admin-ghost" onclick="prevStep(4)"><i class="fa-solid fa-arrow-left"></i> Quay lại</button>
          <button type="submit" class="btn-admin-primary">
            <i class="fa-solid fa-circle-check"></i> Xác nhận đặt lịch
          </button>
        </div>
      </div>
    </div>
  </div>

</form>

{include file="layout/footer.tpl"}

<script>
function nextStep(from) {
  if (from === 1 && !document.querySelector('input[name="specialty_id"]:checked')) {
    alert('Vui lòng chọn chuyên khoa'); return;
  }
  if (from === 2 && !document.querySelector('input[name="doctor_id"]:checked')) {
    alert('Vui lòng chọn bác sĩ'); return;
  }
  if (from === 3) {
    if (!document.getElementById('bookDate').value) { alert('Vui lòng chọn ngày khám'); return; }
    if (!document.querySelector('input[name="time"]:checked')) { alert('Vui lòng chọn giờ khám'); return; }
    updateSummary();
  }
  goToStep(from + 1);
}
function prevStep(from) { goToStep(from - 1); }
function goToStep(n) {
  document.querySelectorAll('.booking-pane').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.booking-step').forEach((s, i) => {
    s.classList.toggle('active', i + 1 === n);
    s.classList.toggle('done', i + 1 < n);
  });
  document.getElementById('step-' + n).classList.add('active');
  window.scrollTo({ top: 0, behavior: 'smooth' });
}
function updateSummary() {
  const type     = document.querySelector('input[name="type"]:checked');
  const spec     = document.querySelector('input[name="specialty_id"]:checked');
  const doc      = document.querySelector('input[name="doctor_id"]:checked');
  const date     = document.getElementById('bookDate');
  const time     = document.querySelector('input[name="time"]:checked');
  document.getElementById('conf-type').textContent      = type ? (type.value === 'online' ? 'Khám từ xa (Video)' : 'Khám trực tiếp') : '—';
  document.getElementById('conf-specialty').textContent = spec ? (spec.closest('label').querySelector('span')?.textContent || '—') : '—';
  document.getElementById('conf-doctor').textContent    = doc  ? (doc.closest('label').querySelector('strong')?.textContent || '—') : '—';
  document.getElementById('conf-date').textContent      = date.value || '—';
  document.getElementById('conf-time').textContent      = time ? time.value : '—';
}
document.querySelectorAll('.type-option input, .specialty-option input, .doctor-picker-card input, .timeslot input').forEach(input => {
  input.addEventListener('change', function() {
    document.querySelectorAll(`input[name="${this.name}"]`).forEach(i => i.closest('label').classList.remove('selected'));
    this.closest('label').classList.add('selected');
  });
});
</script>

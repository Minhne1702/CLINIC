{include file="layout/sidebar.tpl" page_title="Đặt lịch khám" active_page="book"}

<style>
  .booking-wrapper { max-width: 1000px; margin: 2rem auto 4rem auto; padding: 0 1.5rem; }

  /* --- Thanh quy trình 3 bước --- */
  .booking-steps { display: flex; align-items: center; justify-content: space-between; margin-bottom: 2.5rem; background: #fff; padding: 1.5rem; border-radius: 16px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); border: 1px solid #e2e8f0; }
  .booking-step { display: flex; flex-direction: column; align-items: center; gap: 0.5rem; color: #94a3b8; font-weight: 500; font-size: 0.95rem; flex: 1; text-align: center; position: relative; }
  .booking-step span { width: 36px; height: 36px; border-radius: 50%; background: #f8fafc; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 1.1rem; transition: all 0.3s; z-index: 2; border: 2px solid #e2e8f0; }
  .booking-step.active { color: #0284c7; }
  .booking-step.active span { background: #0284c7; color: #fff; border-color: #0284c7; box-shadow: 0 0 0 4px #e0f2fe; }
  .booking-step.done { color: #10b981; }
  .booking-step.done span { background: #10b981; color: #fff; border-color: #10b981; }
  .booking-step-line { height: 3px; background: #f1f5f9; flex: 2; margin: 0 10px; position: relative; top: -14px; z-index: 1; border-radius: 2px; }
  
  .booking-card { background: #fff; border-radius: 16px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); border: 1px solid #e2e8f0; padding: 2rem; margin-bottom: 2rem; }
  .booking-card__title { margin: 0 0 2rem 0; font-size: 1.25rem; color: #0f172a; border-bottom: 1px solid #f1f5f9; padding-bottom: 1rem; }

  /* --- CSS Bước 1 --- */
  .type-options { display: flex; gap: 1.5rem; align-items: stretch; flex-wrap: wrap; }
  .type-option { flex: 1; min-width: 200px; cursor: pointer; display: flex; flex-direction: column; }
  .type-option input { display: none; }
  .type-option__card { flex: 1; border: 2px solid #e2e8f0; border-radius: 12px; padding: 2rem; text-align: center; background: #fff; transition: all 0.2s; display: flex; flex-direction: column; justify-content: center; }
  .type-option__card i { font-size: 2.5rem; color: #94a3b8; margin-bottom: 1rem; transition: all 0.2s; }
  .type-option__card strong { display: block; font-size: 1.15rem; color: #334155; margin-bottom: 0.5rem; }
  .type-option__card p { margin: 0; color: #64748b; font-size: 0.9rem; }
  .type-option input:checked + .type-option__card { border-color: #0284c7; background: #f0f9ff; box-shadow: 0 4px 12px rgba(2, 132, 199, 0.1); transform: translateY(-2px); }
  .type-option input:checked + .type-option__card i, .type-option input:checked + .type-option__card strong { color: #0284c7; }

  .specialty-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1rem; }
  .specialty-option { cursor: pointer; display: flex; flex-direction: column; }
  .specialty-option input { display: none; }
  .specialty-option__card { flex: 1; border: 2px solid #e2e8f0; border-radius: 12px; padding: 1rem; display: flex; align-items: center; gap: 0.75rem; background: #fff; transition: all 0.2s; }
  .specialty-option__card i { color: #94a3b8; font-size: 1.2rem; flex-shrink: 0; width: 24px; text-align: center; }
  .specialty-option__card span { color: #475569; font-weight: 500; font-size: 0.95rem; }
  .specialty-option input:checked + .specialty-option__card { border-color: #0284c7; background: #f0f9ff; }
  .specialty-option input:checked + .specialty-option__card i, .specialty-option input:checked + .specialty-option__card span { color: #0284c7; }

  /* --- CSS Bước 2: THẺ BÁC SĨ --- */
  .bc-doctor-card { display: flex; flex-wrap: wrap; border: 1px solid #e2e8f0; border-radius: 16px; background: #fff; margin-bottom: 1.5rem; overflow: hidden; box-shadow: 0 2px 4px rgba(0,0,0,0.02); transition: all 0.2s; }
  .bc-doctor-card:hover { border-color: #bae6fd; box-shadow: 0 8px 15px -3px rgba(2, 132, 199, 0.1); }
  .bc-doctor-left { flex: 1; min-width: 300px; padding: 1.5rem; display: flex; gap: 1.5rem; border-right: 1px solid #f1f5f9; background: #f8fafc; }
  .bc-doctor-avatar { width: 90px; height: 90px; border-radius: 50%; overflow: hidden; border: 3px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); flex-shrink: 0; }
  .bc-doctor-avatar img { width: 100%; height: 100%; object-fit: cover; }
  .bc-doctor-info h4 { margin: 0 0 0.5rem 0; font-size: 1.15rem; color: #0284c7; }
  .bc-doctor-info p { margin: 0 0 0.4rem 0; font-size: 0.9rem; color: #475569; line-height: 1.5; }
  .bc-doctor-info .location { color: #64748b; font-size: 0.85rem; margin-top: 0.5rem; display: flex; align-items: center; gap: 5px; }

  .bc-doctor-right { flex: 1.5; min-width: 400px; padding: 1.5rem; }
  .bc-date-select { appearance: none; background: #f8fafc url('data:image/svg+xml;utf8,<svg viewBox="0 0 140 140" xmlns="http://www.w3.org/2000/svg"><polyline points="30 40 70 80 110 40" stroke="%23475569" stroke-width="12" fill="none" stroke-linecap="round" stroke-linejoin="round"/></svg>') no-repeat right 10px center/12px; padding: 10px 35px 10px 15px; border: 1px solid #cbd5e1; border-radius: 8px; font-weight: 600; color: #0f172a; cursor: pointer; outline: none; margin-bottom: 1rem; font-size: 0.95rem; transition: border-color 0.2s; }
  .bc-date-select:focus { border-color: #0284c7; box-shadow: 0 0 0 3px #e0f2fe; }
  .bc-schedule-heading { font-weight: 600; font-size: 0.9rem; color: #334155; margin-bottom: 1rem; display: flex; align-items: center; gap: 8px; text-transform: uppercase; }
  
  .bc-time-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(110px, 1fr)); gap: 10px; margin-bottom: 1rem; }
  .bc-time-slot { background: #f1f5f9; border: 1px solid #cbd5e1; color: #334155; padding: 8px 5px; text-align: center; font-size: 0.95rem; font-weight: 500; cursor: pointer; transition: all 0.2s; border-radius: 6px; }
  .bc-time-slot:hover { background: #e0f2fe; border-color: #38bdf8; color: #0284c7; transform: translateY(-1px); }
  
  .bc-hint { font-size: 0.85rem; color: #64748b; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 5px; }
  .bc-address-block { border-top: 1px dashed #e2e8f0; padding-top: 1.25rem; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 1rem; }
  .bc-address-info h5, .bc-price-info h5 { margin: 0 0 5px 0; font-size: 0.85rem; color: #64748b; font-weight: 600; text-transform: uppercase; }
  .bc-address-info p { margin: 0; font-size: 0.95rem; color: #0f172a; }
  .bc-price-info strong { color: #ef4444; font-size: 1.1rem; }

  @media (max-width: 768px) {
    .bc-doctor-left { border-right: none; border-bottom: 1px solid #e2e8f0; }
    .bc-doctor-right { min-width: 100%; }
    .type-options { flex-direction: column; }
  }
</style>

<div class="booking-wrapper">
  <div class="page-toolbar" style="margin-bottom: 2rem; text-align: center;">
    <h2 class="page-title" style="margin: 0; font-size: 2rem; color: #0f172a; font-weight: 700;">Đặt lịch khám</h2>
  </div>

  <div class="booking-steps">
    <div class="booking-step active" id="step-ind-1"><span>1</span> <div style="margin-top: 8px;">Dịch vụ</div></div>
    <div class="booking-step-line"></div>
    <div class="booking-step" id="step-ind-2"><span>2</span> <div style="margin-top: 8px;">Bác sĩ & Thời gian</div></div>
    <div class="booking-step-line"></div>
    <div class="booking-step" id="step-ind-3"><span>3</span> <div style="margin-top: 8px;">Xác nhận</div></div>
  </div>

  <form action="{$BASE_URL|default:$base_url}/?page=book" method="POST" id="bookingForm">
    <input type="hidden" name="action" value="submit">
    <input type="hidden" name="doctor_id" id="input_doctor_id">
    <input type="hidden" name="doctor_name" id="input_doctor_name">
    <input type="hidden" name="date" id="input_date">
    <input type="hidden" name="time" id="input_time">

    <div class="booking-pane active" id="step-1">
      <div class="booking-card">
        <h3 class="booking-card__title">Bước 1: Hình thức khám & Chuyên khoa</h3>
        
        <div class="form-group" style="margin-bottom: 2.5rem;">
          <label style="font-size:1rem; font-weight:600; margin-bottom:1rem; display:block; color: #0f172a;">Hình thức khám <span style="color:#ef4444">*</span></label>
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
                <p>Tư vấn trực tuyến qua Video</p>
              </div>
            </label>
          </div>
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
          <label style="font-size:1rem; font-weight:600; margin-bottom:1rem; display:block; color: #0f172a;">Chuyên khoa cần khám <span style="color:#ef4444">*</span></label>
          <div class="specialty-grid">
            {if isset($specialties) && $specialties|@count > 0}
              {foreach from=$specialties item=spec}
              <label class="specialty-option">
                <input type="radio" name="specialty_id" value="{$spec._id|default:$spec.id}" required>
                <div class="specialty-option__card">
                  <i class="{$spec.icon|default:'fa-solid fa-stethoscope'}"></i>
                  <span class="spec-name">{$spec.name}</span>
                </div>
              </label>
              {/foreach}
            {else}
              {foreach from=[
                ['id'=>'tm', 'name'=>'Tim mạch', 'icon'=>'fa-solid fa-heart-pulse'],
                ['id'=>'nk', 'name'=>'Nhi khoa', 'icon'=>'fa-solid fa-baby'],
                ['id'=>'dl', 'name'=>'Da liễu', 'icon'=>'fa-solid fa-hand-dots'],
                ['id'=>'nha', 'name'=>'Nha khoa', 'icon'=>'fa-solid fa-tooth'],
                ['id'=>'th', 'name'=>'Tiêu hóa', 'icon'=>'fa-solid fa-utensils'],
                ['id'=>'mat', 'name'=>'Mắt (Nhãn khoa)', 'icon'=>'fa-solid fa-eye'],
                ['id'=>'tk', 'name'=>'Thần kinh', 'icon'=>'fa-solid fa-brain'],
                ['id'=>'tmh', 'name'=>'Tai Mũi Họng', 'icon'=>'fa-solid fa-ear-listen'],
                ['id'=>'cxk', 'name'=>'Cơ xương khớp', 'icon'=>'fa-solid fa-bone']
              ] item=spec}
              <label class="specialty-option">
                <input type="radio" name="specialty_id" value="{$spec.id}" required>
                <div class="specialty-option__card">
                  <i class="{$spec.icon}"></i>
                  <span class="spec-name">{$spec.name}</span>
                </div>
              </label>
              {/foreach}
            {/if}
          </div>
        </div>

        <div style="text-align: right; margin-top: 2.5rem;">
          <button type="button" onclick="nextToStep2()" style="background: linear-gradient(135deg, #0ea5e9, #0284c7); color: #fff; padding: 0.85rem 2.5rem; border-radius: 8px; border: none; cursor: pointer; font-weight: 600; font-size: 1.05rem; box-shadow: 0 4px 6px -1px rgba(2, 132, 199, 0.3);">
            Tiếp theo <i class="fa-solid fa-arrow-right" style="margin-left: 5px;"></i>
          </button>
        </div>
      </div>
    </div>

    <div class="booking-pane" id="step-2" style="display: none;">
      <div style="margin-bottom: 1.5rem;">
        <button type="button" onclick="goToStep(1)" style="border:none; background:transparent; color:#64748b; padding:0; font-weight:600; cursor:pointer; font-size: 1rem; transition: color 0.2s;">
          <i class="fa-solid fa-arrow-left"></i> Quay lại chọn Chuyên khoa
        </button>
      </div>

      <div id="doctor-list-container">
        {if isset($doctors) && $doctors|@count > 0}
          {foreach from=$doctors item=doc}
          <div class="bc-doctor-card">
            <div class="bc-doctor-left">
              <div class="bc-doctor-avatar">
                <img src="{$doc.avatar|default:'https://ui-avatars.com/api/?name=Doctor'}" alt="Avatar">
              </div>
              <div class="bc-doctor-info">
                <h4>{$doc.degree|default:'Bác sĩ'} {$doc.full_name}</h4>
                <p>Chuyên khoa: <strong>{$doc.specialty}</strong></p>
                <p>Khám cho người lớn và trẻ em trên 5 tuổi.</p>
                <div class="location"><i class="fa-solid fa-location-dot"></i> Hà Nội</div>
              </div>
            </div>
            <div class="bc-doctor-right">
              <select class="bc-date-select" id="date_picker_{$doc._id|default:$doc.id}">
                <option value="{'today'|date_format:'%Y-%m-%d'}">Hôm nay - {'today'|date_format:'%d/%m'}</option>
                <option value="{'tomorrow'|date_format:'%Y-%m-%d'}">Ngày mai - {'tomorrow'|date_format:'%d/%m'}</option>
                <option value="{'+2 days'|date_format:'%Y-%m-%d'}">Ngày kia - {'+2 days'|date_format:'%d/%m'}</option>
              </select>

              <div class="bc-schedule-heading"><i class="fa-solid fa-calendar-days" style="color:#0284c7;"></i> GIỜ KHÁM</div>
              <div class="bc-time-grid">
                {foreach from=['08:00 - 08:30','09:00 - 09:30','10:00 - 10:30','13:30 - 14:00','14:30 - 15:00','15:30 - 16:00'] item=slot}
                <div class="bc-time-slot" onclick="selectTimeAndProceed('{$doc._id|default:$doc.id}', '{$doc.full_name}', '{$slot}')">{$slot}</div>
                {/foreach}
              </div>
              <p class="bc-hint"><i class="fa-solid fa-hand-pointer" style="color:#38bdf8;"></i> Chọn giờ khám để tiếp tục (Phí đặt lịch 0đ)</p>

              <div class="bc-address-block">
                <div class="bc-address-info">
                  <h5>ĐỊA CHỈ KHÁM</h5>
                  <p style="font-weight:600;">Phòng khám Đa khoa MediCare</p>
                  <p>123 Đường ABC, Quận XYZ, Hà Nội</p>
                </div>
                <div class="bc-price-info">
                  <h5>GIÁ KHÁM:</h5>
                  <strong>500.000đ</strong>
                </div>
              </div>
            </div>
          </div>
          {/foreach}
        {else}
          <div class="bc-doctor-card">
            <div class="bc-doctor-left">
              <div class="bc-doctor-avatar"><img src="https://ui-avatars.com/api/?name=Nguyen+Van+A&background=0284c7&color=fff" alt="Avatar"></div>
              <div class="bc-doctor-info">
                <h4>BS. Nguyễn Văn A (Bản Mẫu)</h4>
                <p>Bác sĩ chuyên khoa</p>
                <div class="location"><i class="fa-solid fa-location-dot"></i> Hà Nội</div>
              </div>
            </div>
            <div class="bc-doctor-right">
              <select class="bc-date-select" id="date_picker_doc_demo">
                <option value="{'today'|date_format:'%Y-%m-%d'}">Hôm nay - {'today'|date_format:'%d/%m'}</option>
                <option value="{'tomorrow'|date_format:'%Y-%m-%d'}">Ngày mai - {'tomorrow'|date_format:'%d/%m'}</option>
              </select>
              
              <div class="bc-schedule-heading"><i class="fa-solid fa-calendar-days" style="color:#0284c7;"></i> GIỜ KHÁM</div>
              <div class="bc-time-grid">
                <div class="bc-time-slot" onclick="selectTimeAndProceed('doc_demo', 'BS. Nguyễn Văn A', '08:00 - 08:30')">08:00 - 08:30</div>
                <div class="bc-time-slot" onclick="selectTimeAndProceed('doc_demo', 'BS. Nguyễn Văn A', '09:00 - 09:30')">09:00 - 09:30</div>
              </div>
            </div>
          </div>
        {/if}
      </div>
    </div>

    <div class="booking-pane" id="step-3" style="display: none;">
      <div class="booking-card">
        <h3 class="booking-card__title">Bước 3: Xác nhận thông tin</h3>
        
        <div style="background: #f8fafc; padding: 1.5rem; border-radius: 12px; border: 1px solid #e2e8f0; margin-bottom: 2rem;">
          <div style="display: flex; justify-content: space-between; margin-bottom: 12px; border-bottom: 1px dashed #cbd5e1; padding-bottom: 8px;">
              <span style="color: #64748b; font-weight: 500;">Hình thức:</span><strong id="conf-type" style="color: #0f172a;">—</strong>
          </div>
          <div style="display: flex; justify-content: space-between; margin-bottom: 12px; border-bottom: 1px dashed #cbd5e1; padding-bottom: 8px;">
              <span style="color: #64748b; font-weight: 500;">Chuyên khoa:</span><strong id="conf-specialty" style="color: #0f172a;">—</strong>
          </div>
          <div style="display: flex; justify-content: space-between; margin-bottom: 12px; border-bottom: 1px dashed #cbd5e1; padding-bottom: 8px;">
              <span style="color: #64748b; font-weight: 500;">Bác sĩ:</span><strong id="conf-doctor" style="color: #0284c7; font-size: 1.05rem;">—</strong>
          </div>
          <div style="display: flex; justify-content: space-between;">
              <span style="color: #64748b; font-weight: 500;">Thời gian khám:</span>
              <strong style="color: #10b981; font-size: 1.05rem;"><span id="conf-time"></span>, ngày <span id="conf-date"></span></strong>
          </div>
        </div>

        <div class="form-group" style="margin-bottom: 2rem;">
          <label style="font-weight:600; margin-bottom:8px; display:block; color: #0f172a;">Lý do khám (Triệu chứng của bạn)</label>
          <textarea name="symptoms" rows="4" placeholder="Ghi chú chi tiết để bác sĩ có thể chuẩn bị tốt nhất cho bạn..." style="width: 100%; padding: 1rem; border: 1px solid #cbd5e1; border-radius: 10px; font-family: inherit; resize: vertical; font-size: 0.95rem;"></textarea>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
          <button type="button" onclick="goToStep(2)" style="padding: 0.85rem 1.5rem; border-radius: 8px; border: 1px solid #cbd5e1; background: #fff; cursor: pointer; color: #475569; font-weight: 600; transition: all 0.2s;">
            <i class="fa-solid fa-arrow-left"></i> Chọn lại Giờ/Bác sĩ
          </button>
          <button type="submit" style="padding: 0.85rem 2.5rem; border-radius: 8px; background: #10b981; border: none; color: white; font-weight: 600; font-size: 1.05rem; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3); transition: all 0.2s;">
            Xác nhận Đặt lịch <i class="fa-solid fa-check" style="margin-left: 5px;"></i>
          </button>
        </div>
      </div>
    </div>

  </form>
</div>

{include file="layout/footer.tpl"}

<script>
{literal}
  function nextToStep2() {
    if (!document.querySelector('input[name="specialty_id"]:checked')) {
      alert('Vui lòng chọn Chuyên khoa để tiếp tục.');
      return;
    }
    goToStep(2);
  }

  function selectTimeAndProceed(doctorId, doctorName, timeStr) {
    const dateSelect = document.getElementById('date_picker_' + doctorId);
    if (!dateSelect) {
      console.error('Không tìm thấy picker cho ID: ' + doctorId);
      return;
    }
    
    const selectedDate = dateSelect.value;

    document.getElementById('input_doctor_id').value = doctorId;
    document.getElementById('input_doctor_name').value = doctorName;
    document.getElementById('input_date').value = selectedDate;
    document.getElementById('input_time').value = timeStr;

    // Lấy giá trị type
    const typeRadio = document.querySelector('input[name="type"]:checked');
    document.getElementById('conf-type').textContent = (typeRadio && typeRadio.value === 'online') ? 'Khám từ xa (Video)' : 'Khám trực tiếp';
    
    // Lấy tên chuyên khoa
    const specRadio = document.querySelector('input[name="specialty_id"]:checked');
    if (specRadio) {
        document.getElementById('conf-specialty').textContent = specRadio.nextElementSibling.querySelector('.spec-name').textContent;
    }
    
    // Tên bác sĩ
    document.getElementById('conf-doctor').textContent = doctorName;
    
    // Fix lỗi hiển thị ngày (Safari/iOS có thể lỗi nếu format date không chuẩn)
    let d = new Date(selectedDate);
    if (isNaN(d)) {
        let parts = selectedDate.split('-');
        d = new Date(parts[0], parts[1] - 1, parts[2]);
    }
    document.getElementById('conf-date').textContent = `${d.getDate().toString().padStart(2, '0')}/${(d.getMonth() + 1).toString().padStart(2, '0')}/${d.getFullYear()}`;
    document.getElementById('conf-time').textContent = timeStr;

    goToStep(3);
  }

  function goToStep(n) {
    document.querySelectorAll('.booking-pane').forEach(p => p.style.display = 'none');
    
    document.querySelectorAll('.booking-step').forEach((s, i) => {
      s.classList.toggle('active', i + 1 === n);
      s.classList.toggle('done', i + 1 < n); 
    }); 
    
    const targetPane = document.getElementById('step-' + n); 
    if(targetPane) {
      targetPane.style.display = 'block';
    }
    window.scrollTo({ top: 0, behavior: 'smooth' }); 
  } 
{/literal}
</script>
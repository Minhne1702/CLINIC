document.addEventListener("DOMContentLoaded", function () {
  const btnSend = document.getElementById("btn_send_otp");
  const btnResend = document.getElementById("btn_resend_otp");
  const otpGroup = document.getElementById("otp_group");
  const timerSpan = document.getElementById("timer");
  const emailInput = document.getElementById("email_reg");
  const phoneInput = document.querySelector('input[name="phone"]'); // Lấy input phone ở đây

  let countdown;

  function startTimer(duration) {
    let timer = duration;
    btnResend.disabled = true;
    btnResend.style.opacity = "0.5";

    countdown = setInterval(function () {
      timerSpan.textContent = `(${timer}s)`;
      if (--timer < 0) {
        clearInterval(countdown);
        timerSpan.textContent = "";
        btnResend.disabled = false;
        btnResend.style.opacity = "1";
      }
    }, 1000);
  }

  // Hàm validate số điện thoại
  function validatePhone(phone) {
    const phoneRegex = /^(0[3|5|7|8|9])[0-9]{8}$/;
    return phoneRegex.test(phone);
  }

  async function sendOTPAction() {
    // 1. Kiểm tra số điện thoại trước
    const phone = phoneInput.value.trim();
    if (!validatePhone(phone)) {
      alert("Số điện thoại không hợp lệ (phải có 10 số và đúng đầu số di động VN)!");
      phoneInput.focus();
      return; // Return ở đây là hợp lệ vì nằm trong function
    }

    // 2. Kiểm tra email
    const email = emailInput.value.trim();
    if (!email || !emailInput.checkValidity()) {
      alert("Vui lòng nhập email hợp lệ!");
      emailInput.focus();
      return;
    }

    btnSend.innerText = "Đang gửi...";
    btnSend.disabled = true;

    try {
      const response = await fetch(`index.php?page=send-otp-ajax&email=${encodeURIComponent(email)}`);
      if (!response.ok) throw new Error("Server response not ok");

      const result = await response.json();

      if (result.success) {
        otpGroup.style.display = "block";
        btnSend.innerText = "Đã gửi mã";
        startTimer(60);
      } else {
        alert(result.message || "Lỗi gửi mã!");
        btnSend.disabled = false;
        btnSend.innerText = "Gửi mã";
      }
    } catch (error) {
      console.error(error);
      alert("Lỗi kết nối! Kiểm tra Network trong F12 để xem chi tiết.");
      btnSend.disabled = false;
      btnSend.innerText = "Gửi mã";
    }
  }

  if (btnSend) btnSend.addEventListener("click", sendOTPAction);
  if (btnResend) btnResend.addEventListener("click", sendOTPAction);
});

// Hàm ẩn hiện mật khẩu giữ nguyên bên ngoài
function togglePw(id, btn) {
  const input = document.getElementById(id);
  const icon = btn.querySelector("i");
  if (input.type === "password") {
    input.type = "text";
    icon.className = "fa-regular fa-eye-slash";
  } else {
    input.type = "password";
    icon.className = "fa-regular fa-eye";
  }
}
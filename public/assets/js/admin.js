// admin.js — MediCare HMS Admin

// Sidebar toggle (desktop collapse)
const sidebar = document.getElementById('sidebar');
const adminMain = document.getElementById('adminMain');
const sidebarToggle = document.getElementById('sidebarToggle');

if (sidebarToggle) {
  sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    document.body.classList.toggle('sidebar-collapsed');
    const icon = sidebarToggle.querySelector('i');
    icon.className = sidebar.classList.contains('collapsed')
      ? 'fa-solid fa-chevron-right'
      : 'fa-solid fa-chevron-left';
    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
  });
  // Restore state
  if (localStorage.getItem('sidebarCollapsed') === 'true') {
    sidebar.classList.add('collapsed');
    document.body.classList.add('sidebar-collapsed');
    const icon = sidebarToggle.querySelector('i');
    if (icon) icon.className = 'fa-solid fa-chevron-right';
  }
}

// Mobile sidebar toggle
const mobileSidebarToggle = document.getElementById('mobileSidebarToggle');
if (mobileSidebarToggle) {
  mobileSidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('mobile-open');
  });
  document.addEventListener('click', (e) => {
    if (!sidebar.contains(e.target) && !mobileSidebarToggle.contains(e.target)) {
      sidebar.classList.remove('mobile-open');
    }
  });
}

// Modal open/close
function openModal(id) {
  const m = document.getElementById(id);
  if (m) m.classList.add('open');
}
function closeModal(id) {
  const m = document.getElementById(id);
  if (m) m.classList.remove('open');
}
// Close modal on overlay click
document.querySelectorAll('.modal-overlay').forEach(overlay => {
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) overlay.classList.remove('open');
  });
});

// Auto-dismiss alerts
document.querySelectorAll('.alert').forEach(alert => {
  setTimeout(() => {
    alert.style.transition = 'opacity .4s ease';
    alert.style.opacity = '0';
    setTimeout(() => alert.remove(), 400);
  }, 4000);
});

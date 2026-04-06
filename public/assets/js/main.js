// main.js — MediCare

// Scroll-triggered animations
const animateObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry, i) => {
    if (entry.isIntersecting) {
      const el = entry.target;
      const isStagger = el.dataset.animate === 'stagger';
      if (isStagger) {
        Array.from(el.children).forEach((child, idx) => {
          child.style.transitionDelay = `${idx * 80}ms`;
          child.style.opacity = '0';
          child.style.transform = 'translateY(20px)';
          child.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
          setTimeout(() => {
            child.style.opacity = '1';
            child.style.transform = 'none';
          }, idx * 80);
        });
        el.classList.add('visible');
      } else {
        el.classList.add('visible');
      }
      animateObserver.unobserve(el);
    }
  });
}, { threshold: 0.12 });

document.querySelectorAll('[data-animate]').forEach(el => {
  animateObserver.observe(el);
});

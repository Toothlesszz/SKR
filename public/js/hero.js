// js/hero.js
let currentSlide = 0;
let slides = [];
let dots = [];
let autoSlideInterval;

function initSlider() {
  slides = document.querySelectorAll('.slide');
  dots = document.querySelectorAll('.dot');
  
  if (slides.length === 0) return;

  // Gán sự kiện cho nút
  document.getElementById('prev').onclick = () => changeSlide(-1);
  document.getElementById('next').onclick = () => changeSlide(1);
  dots.forEach((dot, i) => {
    dot.onclick = () => goToSlide(i);
  });

  // Tự động chạy
  startAutoSlide();
}

function changeSlide(direction) {
  goToSlide((currentSlide + direction + slides.length) % slides.length);
}

function goToSlide(n) {
  slides[currentSlide].classList.remove('active');
  dots[currentSlide].classList.remove('active');
  
  currentSlide = n;
  
  slides[currentSlide].classList.add('active');
  dots[currentSlide].classList.add('active');
}

function startAutoSlide() {
  stopAutoSlide();
  autoSlideInterval = setInterval(() => changeSlide(1), 5000);
}

function stopAutoSlide() {
  if (autoSlideInterval) clearInterval(autoSlideInterval);
}

// Export để gọi từ index.html
window.initSlider = initSlider;
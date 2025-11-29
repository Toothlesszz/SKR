<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Xe Điện Sakura</title>


  <link rel="stylesheet" href="css/style.css" />

  <style>

    body.page-transition { opacity: 0; transition: opacity 0.4s ease; }
    body.page-transition.active { opacity: 1; }
    a{ text-decoration: none !important; }
.carousel {
    position: relative;
    width: 100%;
    max-width: 1000px; /* tùy chỉnh */
    height: 500px; /* tùy chỉnh */
    overflow: hidden;
    border-radius: 12px;
    margin: auto;
}

.carousel img {
    position: absolute;
    top: 0;
    left: 100%;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: left 0.5s ease;
    opacity: 0;
}

.carousel img.active {
    left: 0;
    opacity: 1;
}

.carousel img.prev-slide {
    left: -100%;
}

.carousel img.next-slide {
    left: 100%;
}
.carousel .btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.4);
    color: white;
    padding: 12px 16px;
    font-size: 24px;
    cursor: pointer;
    border-radius: 50%;
    user-select: none;
    z-index: 5;
    transition: 0.2s;
}

.carousel .btn:hover {
    background: rgba(0,0,0,0.6);
}

.carousel .btn.prev {
    left: 10px;
}

.carousel .btn.next {
    right: 10px;
}

/* ============================
   DOTS
============================= */
.carousel .dots {
    position: absolute;
    bottom: 10px;
    width: 100%;
    display: flex;
    gap: 6px;
    justify-content: center;
}

.carousel .dots span {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: rgba(255,255,255,0.5);
    cursor: pointer;
    transition: 0.2s;
}

.carousel .dots span.active {
    background: white;
    transform: scale(1.2);
}
  </style>
</head>
@include('header')
<body>
      <div class = "config-box">
        <div class="carousel" id="bannerCarousel">    
          @foreach($banner as $key => $b)
              <img src="{{ asset('storage/'.$b) }}"
                  class="{{ $key == 0 ? 'active' : '' }}">
          @endforeach
          <div class="btn prev">⟨</div>
          <div class="btn next">⟩</div>
          <div class="dots">
              @foreach($banner as $key => $img)
                  <span data-index="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></span>
              @endforeach
          </div>  
        </div>
      </div>

  <!-- DỊCH VỤ -->
  <section class="services-section">
    <div class="container center">
      <h1 class="section-title">Dịch Vụ Của Chúng Tôi</h1>
      <p class="section-sub">
        Cung cấp xe đạp điện chất lượng cao và các dịch vụ chăm sóc khách hàng toàn diện, 
        từ bán hàng đến bảo hành và sửa chữa.
      </p>
    </div>

    <div class="container">
      <div class="cards-grid" id="products-grid">
        <article class="card">
          <img src="images/banle_daily.jpg" alt="">
          <div class="card-body">
            <h3>Bán Lẻ & Đại Lý</h3>
            <p>Hệ thống phân phối rộng khắp cả nước với giá cả cạnh tranh và ưu đãi hấp dẫn.</p>
            <a class="link-more" href="products.html">Tìm Hiểu Thêm</a>
          </div>
        </article>

        <article class="card">
          <img src="images/baohanh_suachua.jpg" alt="">
          <div class="card-body">
            <h3>Bảo Hành & Sửa Chữa</h3>
            <p>Dịch vụ bảo hành chính hãng và sửa chữa chuyên nghiệp tại các trung tâm toàn quốc.</p>
            <a class="link-more" href="products">Tìm Hiểu Thêm</a>
          </div>
        </article>

        <article class="card">
          <img src="images/phutung_phukien.jpg" alt="">
          <div class="card-body">
            <h3>Phụ Tùng & Phụ Kiện</h3>
            <p>Cung cấp phụ tùng chính hãng và phụ kiện đa dạng cho mọi dòng xe.</p>
            <a class="link-more" href="index">Tìm Hiểu Thêm</a>
          </div>
        </article>
      </div>
    </div>
  </section>

  <!-- THỐNG KÊ -->
  <section class="stats-band">
    <div class="container stats-grid">
      <div class="stat">
        <div class="num">10+</div>
        <div class="label">Năm Kinh Nghiệm</div>
      </div>
      <div class="stat">
        <div class="num">5000+</div>
        <div class="label">Xe Đã Bán</div>
      </div>
      <div class="stat">
        <div class="num">10+</div>
        <div class="label">Đối Tác Chiến Lược</div>
      </div>
      <div class="stat">
        <div class="num">95%</div>
        <div class="label">Đại Lý Hài Lòng</div>
      </div>
    </div>
  </section>

  <!-- CTA -->
  <section class="cta">
    <div class="container center">
      <h3>Bạn Đang Tìm Nguồn Cung Xe Điện Uy Tín?</h3>
      <p>Hãy kết nối với chúng tôi để nhận tư vấn sản phẩm, chính sách giá sỉ và hỗ trợ kỹ thuật toàn diện.</p>
      <div class="cta-buttons">
        <button class="btn primary">Liên Hệ Tư Vấn</button>
        <button class="btn outline" ><a href="news">Xem Tin Tức</a></button>
      </div>
    </div>
  </section>

  <!-- Footer tự động load -->
   @include('footer')
  <div id="footer"></div>

  <script src="js/hero.js"></script>
  <script src="js/loadLayout.js"></script>

  <!-- Page Transition -->
  <script>
document.addEventListener("DOMContentLoaded", () => {
    const slider = document.getElementById("bannerCarousel");
    const slides = slider.querySelectorAll("img");
    const prevBtn = slider.querySelector(".prev");
    const nextBtn = slider.querySelector(".next");
    const dots = slider.querySelectorAll(".dots span");

    let index = 0;
    let autoPlay;

    function showSlide(i) {
        slides.forEach(s => s.classList.remove("active", "prev-slide", "next-slide"));
        dots.forEach(d => d.classList.remove("active"));

        slides[i].classList.add("active");
        dots[i].classList.add("active");
        index = i;
    }

    function nextSlide() {
        let next = index + 1;
        if (next >= slides.length) next = 0;
        showSlide(next);
    }

    function prevSlide() {
        let prev = index - 1;
        if (prev < 0) prev = slides.length - 1;
        showSlide(prev);
    }

    // Click nút chuyển
    prevBtn.addEventListener("click", prevSlide);
    nextBtn.addEventListener("click", nextSlide);

    // Click dot
    dots.forEach(dot => {
        dot.addEventListener("click", () => {
            const i = parseInt(dot.dataset.index);
            showSlide(i);
        });
    });

    // Auto play
    function startAutoPlay() {
        autoPlay = setInterval(nextSlide, 4000);
    }

    function stopAutoPlay() {
        clearInterval(autoPlay);
    }

    slider.addEventListener("mouseenter", stopAutoPlay);
    slider.addEventListener("mouseleave", startAutoPlay);

    showSlide(0);
    startAutoPlay();
});
  </script>
</body>
</html>
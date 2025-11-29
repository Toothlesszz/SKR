<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Chi Tiết Sản Phẩm | Xe Điện Sakura</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
  <style>
    /* --- Banner --- */
    .banner {
      background: linear-gradient(rgba(0, 128, 0, 0.6), rgba(0, 128, 0, 0.6)), 
                  url('images/banner-bike.jpg') center/cover no-repeat;
      color: #fff;
      text-align: center;
      padding: 60px 20px;
      border-radius: 0 0 30px 30px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    .banner h1 {
      font-size: 34px;
      font-weight: 700;
      margin-bottom: 10px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    .banner p {
      font-size: 17px;
      opacity: 0.95;
    }

    /* --- Gallery --- */
     .gallery {
      max-width: 1000px;
      margin: 50px auto;
      text-align: center;
    }
    .main-image {
      width: 90%;
      max-width: 900px;
      height: 500px;
      object-fit: cover; 
      border-radius: 16px;
      box-shadow: 0 6px 15px rgba(0,0,0,0.1);
      transition: opacity 0.3s ease;
    }
    .main-image:hover {
      transform: scale(1.02);
    }
    .thumbs {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 25px;
    }
    .thumbs img {
      width: 150px;
      height: 100px;
      object-fit: cover;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
      border: 3px solid transparent;
    }
    .thumbs img:hover,
    .thumbs img.active {
      border: 3px solid #00a844;
      transform: scale(1.05);
    }

    /* --- Chi tiết sản phẩm --- */
    .detail-section {
      max-width: 950px;
      margin: 70px auto;
      text-align: center;
      animation: fadeIn 0.6s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .detail-section img {
      width: 100%;
      max-width: 880px;
      border-radius: 18px;
      margin-bottom: 25px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }
    .detail-section h2 {
      
      font-size: 20px;
      margin-bottom: 12px;
      
    }
    .detail-section p {
      color: #555;
      line-height: 1.8;
      margin-bottom: 50px;
      font-size: 17px;
      padding: 0 10px;
    }

    /* --- CTA --- */
    .cta {
      background-color: #00a844;
      color: white;
      border-radius: 15px;
      text-align: center;
      padding: 40px 25px;
      max-width: 950px;
      margin: 60px auto 100px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    .cta h3 {
      font-size: 24px;
      margin-bottom: 10px;
      font-weight: 600;
    }
    .cta p {
      margin-bottom: 20px;
      opacity: 0.9;
      font-size: 16px;
    }
    .cta button {
      background: white;
      color: #00a844;
      border: none;
      padding: 12px 25px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      margin: 5px;
      font-size: 15px;
      transition: all 0.3s ease;
    }
    .cta button:hover {
      background: #e9e9e9;
      transform: scale(1.05);
    }
    .product-hero {
    width: 100%;
    height: 280px;
    background-size: cover;
    background-position: center;
    border-radius: 0 0 20px 20px;
    position: relative;
    color: white;
    padding: 40px;
    display: flex;
    align-items: center;
}

.product-hero::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 128, 0, 0.55);
    border-radius: 0 0 20px 20px;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 700px;
}

.back {
    color: #dfffe1;
    text-decoration: none;
    font-size: 14px;
}

.hero-content h1 {
    margin-top: 15px;
    font-size: 32px;
    font-weight: bold;
}

.desc {
    margin-top: 8px;
    opacity: 0.85;
}

/* ============ MAIN IMAGE SECTION ============ */
.product-main {
    width: 100%;
    max-width: 1100px;
    margin: 30px auto;
    text-align: center;
}

.big-img {
    width: 100%;
    max-height: 500px;
    object-fit: cover;
    border-radius: 20px;
    transition: 0.3s;
}

/* ============ THUMBNAILS ============ */
.thumb-list {
    margin-top: 16px;
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
}

.thumb {
    width: 140px;
    height: 90px;
    object-fit: cover;
    border-radius: 12px;
    cursor: pointer;
    transition: 0.3s;
    border: 4px solid transparent;
}

.thumb:hover {
    transform: scale(1.03);
}

.thumb.active {
    border-color: #00a84f;
}
  </style>
</head>
@include('header')
<body>
  <div id="header-placeholder"></div>

  <main>
    <div class="product-hero" id="productHero">
    <div class="hero-content">
        <a href="{{url('/products')}}" class="back">← Quay Lại Dòng Sản Phẩm</a>
        <h1>{{ $products->ten_sp }}</h1>
        <p class="desc">
           {{$products->mota}}
        </p>
    </div>
    </div>
      <div class="product-main">
        @php 
          $imgs = json_decode($products->hinhanh, true) ?: []; 
        @endphp 
      <img id="mainImage" src="{{ asset('storage/' . $imgs[0]) }}" class="big-img">
      <div class="thumb-list" id="thumbList">
          @foreach($imgs as $img)
              <img src="{{ asset('storage/' . $img) }}" class="thumb">
          @endforeach
      </div>
      <div style="text-align: center; margin-top: 8px;">
      <i>* Hình ảnh sản phẩm</i>
      </div>
      </div>
      <div id="productDetail">
        <section class="detail-section">
          @php
              $html = $products->mota_chitiet;
              $html = preg_replace('/<!DOCTYPE[^>]*>/i', '', $html);
              $html = preg_replace('/<\?xml[^>]*>/i', '', $html);
              if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $html, $matches)) {
                  $html = $matches[1];
              }
          @endphp
          <p id="detailTitle">{!! $html !!}</p>
        </section>
      </div>
      <div class="product-main">
         <div style="text-align: center; margin-top: 8px;">
      <h2>Hình ảnh thông số sản phẩm</h2>
      </div>
        @php 
          $imgs = json_decode($products->thongso, true) ?: []; 
        @endphp
        <img id="mainImage" src="{{ asset('storage/' . $imgs[0]) }}" class="big-img">
        <div class="thumb-list" id="thumbList">
            @foreach($imgs as $img)
                <img src="{{ asset('storage/' . $img) }}" class="thumb">
            @endforeach
        </div>
        
      </div>
    <div class="cta">
      <h3>Quan Tâm Đến Sản Phẩm Này?</h3>
      <p>Liên hệ để được tư vấn chi tiết, lái thử miễn phí và nhận ưu đãi đặc biệt.</p>
      <button>Đặt Lịch Lái Thử</button>
      <button>Tải Catalogue</button>
    </div>
  </main>
@include('footer')


  <script >
document.addEventListener("DOMContentLoaded", () => {
    const hero = document.getElementById("productHero");

    // lấy tất cả mainImage và thumbList
    const mainImages = document.querySelectorAll("#mainImage");
    const thumbLists = document.querySelectorAll("#thumbList");

    thumbLists.forEach((list, index) => {
        const mainImage = mainImages[index];
        const thumbs = list.querySelectorAll(".thumb");

        if (!mainImage || thumbs.length === 0) return;

        // Ảnh đầu tiên
        mainImage.src = thumbs[0].src;

        // Slider đầu tiên điều khiển hero background
        if (index === 0) {
            hero.style.backgroundImage = `url('${thumbs[0].src}')`;
        }

        thumbs.forEach(thumb => {
            thumb.addEventListener("click", () => {

                // đổi ảnh lớn
                mainImage.src = thumb.src;

                // chỉ slider đầu tiên đổi background hero
                if (index === 0) {
                    hero.style.backgroundImage = `url('${thumb.src}')`;
                }

                // active border
                thumbs.forEach(t => t.classList.remove("active"));
                thumb.classList.add("active");
            });
        });
    });
});
  </script>
</body>
</html>

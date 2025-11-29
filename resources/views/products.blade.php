<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sản Phẩm | Xe Điện Sakura</title>
  <link rel="stylesheet" href="css/style.css">
</head>
@include('header')
<body class="page-transition">
  <div id="header-placeholder"></div>

  <section class="product-section">
    <h2>Dòng Sản Phẩm Xe Đạp Điện</h2>
    <p>Khám phá các dòng xe đạp điện chất lượng cao của Sakura, được thiết kế để đáp ứng mọi nhu cầu di chuyển của bạn.</p>

    <div id="product-grid" class="product-grid">
      @if($products->isEmpty())
        <p>Không có sản phẩm nào để hiển thị.</p>
      @endif
      @foreach($products as $product)
      <div class="product-card">
        @php
            $images = json_decode($product->hinhanh, true);
        @endphp
              <img src="{{ asset('storage/' . $images[0]) }}">
              <h3>{{$product->ten_sp}}</h3>
              <p> </p>
              @php
                $features = json_decode($product->chitiet, true);
              @endphp
              @foreach($features as $feature)
              <ul>
                <li>{{ $feature }}</li>
              </ul>
              @endforeach
              <a href="{{ url('/product-detail/' . $product->id) }}">Xem Chi Tiết</a>
            </div>
        @endforeach
    </div>
  </section>

  <section class="cta">
    <h3>Cần Tư Vấn Chọn Xe?</h3>
    <p>Liên hệ với chúng tôi để được tư vấn và hỗ trợ chọn mẫu xe phù hợp nhất cho bạn!</p>
    <button>Liên Hệ Ngay</button>
  </section>
@include('footer')
  
  <script>
    document.body.classList.add('page-transition');
    window.addEventListener('load', () => {
      document.body.classList.add('active');
      window.scrollTo(0, 0);
    });

    document.querySelectorAll('a[href]').forEach(link => {
      const url = link.getAttribute('href');
      if (!url.startsWith('#') && !url.startsWith('http')) {
        link.addEventListener('click', e => {
          e.preventDefault();
          document.body.classList.remove('active');
          setTimeout(() => window.location.href = url, 400);
        });
      }
    });
  </script>
</body>
</html>
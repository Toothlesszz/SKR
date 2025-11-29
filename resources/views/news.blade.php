<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Tin Tức & Sự Kiện - GreenBike</title>
  <link rel="stylesheet" href="css/style.css">
<style>
    .container {
            max-width: 1300px;
            margin: 50px auto;
            padding: 0 20px;
        }

        h1 {
            text-align: center;
            font-size: 32px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .sub-title {
            text-align: center;
            color: #555;
            font-size: 17px;
            margin-bottom: 40px;
        }

        /* === News Grid === */
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
        }

        /* === News Card === */
        .news-card {
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.09);
            transition: 0.25s;
            display: flex;
            flex-direction: column;
        }

        .news-card:hover {
            transform: translateY(-4px);
        }

        .news-card img {
            width: 100%;
            height: 230px;
            object-fit: cover;
        }

        .tag {
            
            margin-top: 15px;
            background: #f0f5ff;
            color: #2c62f5;
            padding: 6px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
        }
        .tag-item{
            margin: 6px;
        }

        .news-content {
            padding: 20px 22px 30px;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .title {
            margin-top: 10px;
            font-size: 19px;
            font-weight: 700;
        }

        .desc {
            margin-top: 10px;
            color: #555;
            line-height: 1.5;
            overflow: hidden;
        }

        .date {
            margin-top: auto;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
            font-size: 14px;
        }

        .read-more {
            margin-top: 15px;
            color: #0a8e2a;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }

        /* Rút gọn mô tả */
        .truncate {
            display: -webkit-box;
            -webkit-line-clamp: 4; 
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
        .news-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    justify-content: center; /* cho thẻ nằm đẹp nếu ít */
}

.news-card {
    width: 350px;          /* thẻ LUÔN cố định chiều rộng */
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 8px 22px rgba(0, 0, 0, 0.09);
    display: flex;
    flex-direction: column;
    transition: 0.25s;
}
</style>
</head>
<body>
  @include('header')
  <div id="header-placeholder"></div>

  <div class="container">
        <h1>Tin Tức & Sự Kiện</h1>
        <p class="sub-title">Cập nhật những tin tức mới nhất về sản phẩm, khuyến mãi và hoạt động của GreenBike</p>
        <div class="news-grid">
          @foreach($news as $newsItem)
            <div class="news-card">
                <img src="{{ asset('storage/' . $newsItem->anhbia) }}" alt="">
                <div class="news-content">
                    <span class="tag">
                  @php
                  $tag = json_decode($newsItem->tag, true);
                  @endphp
                  @foreach($tag as $tag)
                    <span class="tag-item">{{ $tag }}</span>
                    
                  @endforeach
                  </span>
                    <h3 class="title">{{ $newsItem->tieude }}</h3>
                    <p class="desc truncate">
                      @php
                          $html = $newsItem->noidung;
                          $html = preg_replace('/<!DOCTYPE[^>]*>/i', '', $html);
                          $html = preg_replace('/<\?xml[^>]*>/i', '', $html);
                          if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $html, $matches)) {
                              $html = $matches[1];
                          }
                          $plain = strip_tags($html);
                          $short = Str::words($plain, 150, '...');
                      @endphp
                        {!! $short !!}
                    </p>
                    <div class="date">
                        <i class="fa-regular fa-calendar"></i> {{ date('d/m/Y', strtotime($newsItem->updated_at)) }}
                    </div>
                    <a class="read-more" href="{{ url('news-detail/' . $newsItem->id) }}">Xem Chi Tiết <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
          @endforeach
        </div>
  </div>

@include('footer')
  <div id="footer-placeholder"></div>

</body>
</html>
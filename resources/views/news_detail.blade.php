<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chi Tiết Tin Tức - GreenBike</title>

  <!-- Font + Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('css/style.css')}}" />

  <style>
    body {
      margin: 0;
      font-family: 'Inter', sans-serif;
      background: #f4f6f8;
      color: #333;
    }

    .container {
      max-width: 900px;
      margin: 40px auto;
      padding: 0 20px;
      animation: fadeIn 0.6s ease-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .back-btn {
      display: inline-flex;
      align-items: center;
      color: #1b5e20;
      font-weight: 600;
      text-decoration: none;
      margin-bottom: 20px;
      transition: color 0.2s;
    }

    .back-btn i { margin-right: 8px; }
    .back-btn:hover { color: #2e7d32; }

    .news-header {
      background: #fff;
      padding: 25px;
      border-radius: 16px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      margin-bottom: 25px;
    }

    .category {
      display: inline-block;
      background: #e8f5e9;
      color: #1b5e20;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .news-header h2 {
      font-size: 26px;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .news-meta {
      color: #777;
      font-size: 14px;
      display: flex;
      gap: 16px;
      align-items: center;
      flex-wrap: wrap;
    }

    .news-meta i {
      margin-right: 6px;
      color: #4caf50;
    }

    .news-meta .tags span {
      background: #eeeeee;
      padding: 4px 10px;
      border-radius: 12px;
      margin-right: 6px;
      font-size: 13px;
    }

    .news-image {
      width: 100%;
      border-radius: 16px;
      margin: 20px 0;
      object-fit: cover;
      height: 380px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .news-content {
      background: #fff;
      padding: 30px;
      border-radius: 16px;
      box-shadow: 0 3px 10px rgba(0,0,0,0.05);
      font-size: 16px;
      line-height: 1.7;
    }

    .news-content h3 {
      color: #1b5e20;
      font-size: 20px;
      margin-top: 25px;
      margin-bottom: 10px;
    }

    .news-content ul {
      padding-left: 20px;
      margin-bottom: 15px;
    }

    .news-content li {
      margin-bottom: 8px;
    }
  </style>

</head>
@include('header')
<body>
  <!-- HEADER -->
  <div id="header-placeholder"></div>

  <main>
    <div class="container">
      <a href="{{ url('news') }}" class="back-btn"><i class="fa fa-arrow-left"></i> Quay Lại Tin Tức</a>

      <div class="news-header">
        <!-- <span id="category" class="category"></span> -->
        <h2 id="title">{{ $news->tieude }}</h2>
        <div class="news-meta">
          <div><i class="fa fa-calendar"></i><span id="date">{{ date('d/m/Y', strtotime($news->updated_at)) }}</span></div>
          <div id="tags" class="tags">
            @php
              $tags = json_decode($news->tag, true);
            @endphp
            @foreach($tags as $tag)
              <span>{{ $tag }}</span>
            @endforeach
          </div>
        </div>
        <img id="cover" src="{{ asset('storage/' . $news->anhbia) }}" class="news-image" alt="Ảnh tin tức">
      </div>

      <div id="content" class="news-content">
        @php
            $html = $news->noidung;
            $html = preg_replace('/<!DOCTYPE[^>]*>/i', '', $html);
            $html = preg_replace('/<\?xml[^>]*>/i', '', $html);
            if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $html, $matches)) {
                $html = $matches[1];
            }
        @endphp
        {!! $html !!}
      </div>
    </div>
  </main>

  <!-- FOOTER -->
   @include('footer')
  <div id="footer-placeholder"></div>

</body>
</html>

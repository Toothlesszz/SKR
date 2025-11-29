<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý Tin tức</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">

  <style>
    body {
      font-family: "Segoe UI", sans-serif;
      margin: 0;
      background: #f9fafb;
      color: #111827;
    }

    header {
      background: #fff;
      border-bottom: 1px solid #e5e7eb;
      padding: 14px 28px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h2 {
      font-size: 1.3rem;
      font-weight: 600;
      color: #374151;
      margin: 0;
    }

    main {
      padding: 28px;
      max-width: 1100px;
      margin: 0 auto;
    }

    .filter-box {
      background: #fff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 1px 2px rgba(0,0,0,0.05);
      margin-bottom: 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .filter-title {
      font-weight: 600;
      margin-bottom: 12px;
    }

    .filter-row {
      display: flex;
      flex-wrap: wrap;
      gap: 16px;
      align-items: center;
    }

    .filter-row input,
    .filter-row select {
      flex: 1;
      padding: 10px 14px;
      border-radius: 8px;
      border: 1px solid #e5e7eb;
      background: #f9fafb;
      font-size: 1rem;
    }

    .btn-add {
      background: #8b9ce8;
      color: #fff;
      border: none;
      padding: 10px 16px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: 0.2s;
    }

    .btn-add:hover {
      background: #7b8edf;
    }
    .btn-search {
      background: #8b9ce8;
      color: #fff;
      border: none;
      padding: 10px 16px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: 0.2s;
    }

    .btn-search:hover {
      background: #7b8edf;
    }

    .news-list {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    .news-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.08);
      display: flex;
      overflow: hidden;
    }

    .news-image {
      margin-top:20px;
      margin-left:20px;
      width: 280px;
      flex: 0 0 280px;
      height: 180px;
      object-fit: cover;
    }

    .news-info {
      padding: 18px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .news-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 6px;
      margin: 6px 0;
    }

    .tag {
      padding: 4px 10px;
      font-size: 0.8rem;
      border-radius: 999px;
      font-weight: 600;
      color: white;
    }
/* 
    .tag.green { background: #10b981; }
    .tag.blue { background: #3b82f6; }
    .tag.gray { background: #6b7280; } */

    .news-title {
      font-size: 1.1rem;
      font-weight: 600;
      color: #111827;
      margin: 6px 0;
    }

    .news-desc {
      color: #6b7280;
      font-size: 0.95rem;
      margin-bottom: 8px;
      line-clamp: 2;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .news-date {
      display: flex;
      align-items: center;
      gap: 6px;
      color: #6b7280;
      font-size: 0.9rem;
      margin-bottom: 6px;
    }

    .news-offers {
      color: #4a5568;
      font-size: 0.9rem;
      margin-top: 6px;
    }

    .news-actions {
      display: flex;
      gap: 10px;
      justify-content: flex-end;
    }

    .icon-btn {
      cursor: pointer;
      color: #6b7280;
      transition: 0.2s;
    }

    .icon-btn:hover {
      color: #111827;
    }

    .no-news {
      text-align: center;
      color: #9ca3af;
      font-style: italic;
    }

    .modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .modal.show {
      display: flex;
    }

    .modal-content {
      background: #fff;
      border-radius: 12px;
      width: 90%;
      max-width: 500px;
      max-height: 80vh;
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      overflow-y: auto;
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 15px;
      border-bottom: 1px solid #e5e7eb;
    }

    .modal-header h3 {
      font-size: 1.4rem;
      color: #2d3748;
      font-weight: 600;
    }

    .close {
      font-size: 20px;
      color: #4a5568;
      cursor: pointer;
      transition: color 0.2s;
    }

    .close:hover {
      color: #c53030;
    }

    .modal-form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .form-group label {
      font-weight: 500;
      color: #2d3748;
      font-size: 0.95rem;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
      padding: 10px 12px;
      border-radius: 6px;
      border: 1px solid #e2e8f0;
      font-size: 0.95rem;
      background: #f7fafc;
      width: 100%;
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      border-color: #4299e1;
      outline: none;
      box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 80px;
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }

    .btn-save {
      background: #3182ce;
      color: #ffffff;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
    }

    .btn-save:hover {
      background: #2b6cb0;
    }

    .btn-cancel {
      background: #edf2f7;
      color: #2d3748;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s;
    }

    .btn-cancel:hover {
      background: #e2e8f0;
    }

    @media (max-width: 768px) {
      .news-card {
        flex-direction: column;
      }
      .news-image {
      
        width: 100%;
      }
      .filter-box {
        flex-direction: column;
        gap: 16px;
      }
      .modal-content {
        max-width: 90%;
      }
    }
    a{ text-decoration: none !important;}
    .toast-container {
  position: fixed;
  top: 18px;
  right: 18px;
  z-index: 99999;
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.toast {
  min-width: 260px;
  max-width: 360px;
  background: #2d8f44;
  color: #fff;
  padding: 12px 14px;
  border-radius: 8px;
  box-shadow: 0 8px 24px rgba(0,0,0,0.12);
  display: flex;
  align-items: center;
  gap: 10px;
  transform-origin: top right;
  animation: toast-in 260ms ease;
  font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
}
.toast--error { background: #c0392b; }
.toast .toast-msg { flex:1; font-size:14px; line-height:1.2; }
.toast .toast-close {
  background: rgba(255,255,255,0.12);
  border: none;
  color: #fff;
  width:28px;height:28px;border-radius:6px;cursor:pointer;font-weight:700;
  display:flex;align-items:center;justify-content:center;
}
@keyframes toast-in {
  from { opacity:0; transform: translateY(-8px) scale(.98); }
  to   { opacity:1; transform: translateY(0) scale(1); }
}
@keyframes toast-out {
  from { opacity:1; transform: translateY(0) scale(1); }
  to   { opacity:0; transform: translateY(-6px) scale(.98); }
}
.toast.closing {
  animation: toast-out 220ms ease forwards;
}

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
.logo-circle img {
    width: 100%;
    height: 100%;
    object-fit: contain; 
}
  </style>
</head>

<body>
  <header class="admin-header">
     <div class="logo">
      <div class="logo-circle"><img src="{{ asset('images/header_logo_removebg.png') }}" alt="Logo"></div>
      <span>XE ĐIỆN SAKURA</span>
    </div>
    <nav>
      <a href="{{url('/admin/dashboard')}}" >Dashboard</a>
      <a href="{{url('/admin/products')}}">Quản lý Sản phẩm</a>
      <a href="{{url('/admin/vendor')}}">Quản lý Dòng xe</a>
      <a href="{{url('/admin/news')}}"class="active">Quản lý Tin tức</a>
    </nav>
    <div class="social-icons">
      <i class="fa-brands fa-facebook"></i>
      <i class="fa-brands fa-instagram"></i>
      <i class="fa-brands fa-youtube"></i>
      <i class="fa-solid fa-phone"></i>
      <a href="{{ url('admin/logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
    </div>
  </header>

  <main>
    <!-- Bộ lọc -->
    <div class="filter-box">
      <div class="filter-title"><i class="fa-solid fa-filter"></i> Bộ lọc & Tìm kiếm</div>
      <div class="filter-row">
        <form action="{{ url('/admin/news') }}" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap; align-items: center;">
          @csrf
        <input type="text" id="searchInput" name="search" placeholder="Tìm theo tiêu đề, nội dung...">
        <select id="statusFilter" name="status">
          <option value="">Tất cả trạng thái</option>
          <option value="1">Hiển thị</option>
          <option value="0">Ẩn</option>
        </select>
        <button type="submit" class="btn-search">
        <i class="fa-solid fa-magnifying-glass"></i> Lọc
      </button>
        </form>
        <a href="{{url('/admin/news/insert')}}"><button class="btn-add" id="addNewsBtn">
          <i class="fa-solid fa-plus"></i> Thêm tin tức
        </button></a>
      </div>
    </div>

    <!-- Danh sách tin tức -->
    <div id="newsList" class="news-list">
    <div class="news-grid">
      @foreach($newsList as $item)
            <div class="news-card">
                <img src="{{ asset('storage/' . $item->anhbia) }}" alt="">
                <div class="news-content">
                    <span class="tag">
                      @php
                      $tags = json_decode($item->tag, true);
                      @endphp
                      @foreach($tags as $tag)
                        <span class="tag gray">{{ $tag }}</span>
                      @endforeach
                        </span>
                    <h3 class="title">{{$item->tieude}}</h3>
                    <p class="desc truncate">
                        @php
                        $html = $item->noidung;
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
                        <i class="fa-regular fa-calendar"></i> {{ date('d/m/Y', strtotime($item->updated_at)) }}
                    </div>
            <div class="news-actions">
              <a href="{{ route('news.getUpdate', ['id' => $item->id]) }}"><i class="fa-solid fa-pen-to-square icon-btn edit"></i></a>
              <form action="{{ route('news.delete', ['id' => $item->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tin tức này không?');">
                @csrf
                @method('DELETE')
                <button type="submit" style="background:none; border:none; padding:0; cursor:pointer;">
                  <i class="fa-solid fa-trash icon-btn delete"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
      @endforeach
          </div>
            </div>
  </main>


  <script >
    
// Thông báo chỉnh sửa thành công
(function () {
  function ensureContainer() {
    let c = document.querySelector('.toast-container');
    if (!c) {
      c = document.createElement('div');
      c.className = 'toast-container';
      document.body.appendChild(c);
    }
    return c;
  }

  window.showToast = function (message, type = 'success', timeout = 3500) {
    const container = ensureContainer();
    const t = document.createElement('div');
    t.className = 'toast' + (type === 'error' ? ' toast--error' : '');
    t.innerHTML = '<div class="toast-msg"></div><button class="toast-close" aria-label="Đóng">✕</button>';
    t.querySelector('.toast-msg').textContent = message;
    container.appendChild(t);

    const close = () => {
      if (t.classList.contains('closing')) return;
      t.classList.add('closing');
      t.addEventListener('animationend', () => t.remove());
    };

    t.querySelector('.toast-close').addEventListener('click', close);

    // auto dismiss
    if (timeout > 0) {
      setTimeout(close, timeout);
    }

    return t;
  };

  // helper to show blade session success (if present)
  document.addEventListener('DOMContentLoaded', function () {
    @if(session('success'))
      showToast({!! json_encode(session('success')) !!}, 'success', 3500);
    @endif

    @if(session('error'))
      showToast({!! json_encode(session('error')) !!}, 'error', 4500);
    @endif
  });
})();
  </script>
</body>
</html>
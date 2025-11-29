<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quản lý sản phẩm - GreenBike Admin</title>
  <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin/admin_products.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<style>
  a {
    text-decoration: none !important;
}
  .modal-content {
    width: 80%;
    max-height: 80vh;
    overflow-y: auto;
  }
  .modal-form {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
  }
  .full {
    grid-column: span 2;
  }
  .modal-form .form-actions {
    grid-column: span 2;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
  }
  .dropzone {
    border: 2px dashed #4caf50;
    padding: 20px;
    text-align: center;
    border-radius: 10px;
    cursor: pointer;
    transition: 0.2s;
  }
  .dropzone:hover {
    background: #f3fff3;
  }
  .dropzone.dragover {
    background: #e1ffe1;
    border-color: #2e7d32;
  }
  .preview-img {
    width: 100%;
    margin-top: 10px;
    border-radius: 10px;
    display: none;
  }
  /* Overlay mờ */
.overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

/* Hộp popup */
.popup {
    background: #fff;
    padding: 20px 25px;
    border-radius: 10px;
    width: 350px;
    text-align: center;
    animation: fadeIn 0.2s ease-in-out;
}

/* Nút */
.popup-actions {
    margin-top: 20px;
    display: flex;
    justify-content: space-between;
}

.btn-danger {
    background: #e74c3c;
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-cancel {
    background: #bdc3c7;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

/* Animation */
@keyframes fadeIn {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
.thumb.new { border: 2px solid #2b6cb0; }
.upload-bar {
    display: flex;
    gap: 12px;
    align-items: center;
    justify-content: center;
    width: 100%;
    padding: 14px 18px;
    border-radius: 10px;
    border: 1px dashed #d9d9de;
    background: #fff;
    color: #222;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    transition: background .15s, border-color .15s, box-shadow .15s, transform .06s;
    user-select: none;
}
.upload-bar .upload-icon { font-size: 20px; line-height: 1; }
.upload-bar:hover { background: #f7f8fa; border-color: #cfcfd6; transform: translateY(-1px); }
.upload-bar:active { transform: translateY(0); }
.upload-bar.dragover {
    background: #eff6ff;
    border-color: #1f6feb;
    box-shadow: 0 6px 18px rgba(31,111,235,0.08);
}
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
      <a href="{{url('/admin/products')}}" class="active">Quản lý Sản phẩm</a>
      <a href="{{url('/admin/vendor')}}">Quản lý Dòng xe</a>
      <a href="{{url('/admin/news')}}">Quản lý Tin tức</a>
    </nav>
    <div class="social-icons">
      <i class="fa-brands fa-facebook"></i>
      <i class="fa-brands fa-instagram"></i>
      <i class="fa-brands fa-youtube"></i>
      <i class="fa-solid fa-phone"></i>
      <a href="{{ url('admin/logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i></a>
    </div>
  </header>

  <main class="container">
    <section class="section">
      <div class="section-header">
        <div>
          <h2>Quản Lý Sản Phẩm</h2>
          <p>Quản lý sản phẩm, thêm mới hoặc chỉnh sửa thông tin xe.</p>
        </div>
        <a href="{{ route('products.create') }}"><button class="btn-add" id="">
          <i style="color: white" class="fa-solid fa-plus"></i> Thêm sản phẩm
        </button></a>
      </div>

      <div class="product-grid">
        @foreach($products as $product)
          <div class="product-card">
            <div class="image-wrapper">
              @php
                  $images = json_decode($product->hinhanh, true);
              @endphp
              <img src="{{ asset('storage/' . $images[0]) }}" />
              <div class="image-actions">
                <a href="{{ route('getUpdate', ['id' => $product->id]) }}" class="edit-btn-on-image"><i class="fa-solid fa-pen"></i></a>
                <form action="{{ route('products.delete', ['id' => $product->id]) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button class="delete-btn-on-image"><i class="fa-solid fa-trash"></i></button>
                </form>
              </div>
              
              @if($product->hienthi == 0)
                  <span class="status-badge-inactive">Ngừng hoạt động</span>
              @else
              <span class="status-badge">Hoạt động</span>
              @endif
              
            </div>
            <div class="card-body">
              <h4>{{ $product->ten_sp }}</h4>
              @php
              $mota = Str::limit($product->mota, 100, '...');
              @endphp
              <p>{{ $mota }}</p>
            </div>
          </div>
        @endforeach
      </div>
    </section>
  </main>

  <div id="productModal" class="modal hidden">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="modalTitle">Thêm sản phẩm mới</h3>
        <span class="close">&times;</span>
      </div>

      <form id="productForm" action="{{ route('products.insert') }}" method="POST" enctype="multipart/form-data" class="modal-form">
        @csrf
        <div class="form-group"><label>Tên sản phẩm *</label><input type="text" name="name" required /></div>
        <div class="form-group"><label>Mô tả ngắn *</label><input type="text" name="shortDetail" required /></div>
        <div class="form-group"><label>Feature 1</label><input type="text" name="feature1" /></div>
        <div class="form-group"><label>Feature 2</label><input type="text" name="feature2" /></div>
        <div class="form-group"><label>Feature 3</label><input type="text" name="feature3" /></div>
        <div class="form-group"><label>Feature 4</label><input type="text" name="feature4" /></div>
        <div class="form-group"><label>Tags</label><input type="text" name="tags" placeholder="Cách nhau bằng dấu phẩy" /></div>

        <div class="form-group full">
          <label>Main Image</label>
          <div class="dropzone" data-input="mainImage">Kéo thả hoặc bấm để chọn file</div>
          <input type="file" name="mainImage" accept="image/*" hidden />
          <img class="preview-img" id="preview-mainImage" />
        </div>

        <div class="form-group full">
          <label>Picture 1</label>
          <div class="dropzone" data-input="image1">Kéo thả hoặc bấm để chọn file</div>
          <input type="file" name="image1" accept="image/*" hidden />
          <img class="preview-img" id="preview-image1" />
        </div>

        <div class="form-group full">
          <label>Picture 2</label>
          <div class="dropzone" data-input="image2">Kéo thả hoặc bấm để chọn file</div>
          <input type="file" name="image2" accept="image/*" hidden />
          <img class="preview-img" id="preview-image2" />
        </div>

        <div class="form-group full">
          <label>Picture 3</label>
          <div class="dropzone" data-input="image3">Kéo thả hoặc bấm để chọn file</div>
          <input type="file" name="image3" accept="image/*" hidden />
          <img class="preview-img" id="preview-image3" />
        </div>

        <div class="form-group full">
          <label>Picture 4</label>
          <div class="dropzone" data-input="image4">Kéo thả hoặc bấm để chọn file</div>
          <input type="file" name="image4" accept="image/*" hidden />
          <img class="preview-img" id="preview-image4" />
        </div>

        <div class="form-actions">
          <button type="submit" class="btn-save">Lưu sản phẩm</button>
          <button type="button" class="btn-cancel">Hủy</button>
        </div>
      </form>
    </div>
  </div>
<div id="deleteConfirmOverlay" class="overlay">
    <div class="popup">
        <h3>Bạn có chắc muốn xóa sản phẩm?</h3>
        <p>Thao tác này không thể hoàn tác.</p>

        <div class="popup-actions">
            <button id="confirmDeleteBtn" class="btn-danger">Xóa</button>
            <button id="cancelDeleteBtn" class="btn-cancel">Hủy</button>
        </div>
    </div>
</div>
<script>

// Khi bấm nút xoá → mở popup
document.querySelectorAll('.delete-btn-on-image').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();   // Ngăn submit form

        deleteForm = this.closest("form"); // Lưu form bị bấm

        document.getElementById("deleteConfirmOverlay").style.display = "flex";
    });
});

// Nút XÓA trong popup → submit form thật
document.getElementById("confirmDeleteBtn").addEventListener("click", function() {
    if (deleteForm) deleteForm.submit();
});

// Nút HỦY → đóng popup
document.getElementById("cancelDeleteBtn").addEventListener("click", function() {
    document.getElementById("deleteConfirmOverlay").style.display = "none";
});
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

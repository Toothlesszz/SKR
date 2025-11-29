<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bảng điều khiển - GreenBike</title>
  <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
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
.carousel {
    position: relative;
    width: 100%;
    height: 400px;
    overflow: hidden;
}

.carousel img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
    opacity: 0;
    transition: opacity 1s ease-in-out;
}

.carousel img.active {
    opacity: 1;
}

.carousel .btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    padding: 8px;
    background: rgba(0,0,0,0.3);
    border-radius: 50%;
    cursor: pointer;
}
.carousel .prev { left: 20px; }
.carousel .next { right: 20px; }

.dots {
    position: absolute;
    bottom: 20px;
    width: 100%;
    text-align: center;
}
.dots span {
    width: 12px;
    height: 12px;
    margin: 3px;
    display: inline-block;
    background: #bbb;
    border-radius: 50%;
    cursor: pointer;
}
.dots .active {
    background: #fff;
}
.input-error {
    border: 1px solid red !important;
}

.error-text {
    color: red;
    font-size: 13px;
    margin-top: 4px;
}
.logo-circle img {
    width: 100%;
    height: 100%;
    object-fit: contain; 
}
  </style>
</head>
<body>

  <!-- Header -->
  <header class="admin-header">
    <div class="logo">
      <div class="logo-circle"><img src="{{ asset('images/header_logo_removebg.png') }}" alt="Logo"></div>
      <span>XE ĐIỆN SAKURA</span>
    </div>
    <nav>
      <a href="{{url('/admin/dashboard')}}" class="active">Dashboard</a>
      <a href="{{url('/admin/products')}}">Quản lý Sản phẩm</a>
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

  <!-- Main -->
  <main class="dashboard-container">
    <section class="system-section">
      <div class="section-header">
        <div class="title">
          <i class="fa-solid fa-gear"></i>
          <div>
            <h3>Cấu hình hệ thống</h3>
            <p>Quản lý các thiết lập chung của website</p>
          </div>
        </div>
      </div>
          
      <!-- Banner Slider -->
      <div class="config-box">
        <div class="mb-4">
          <div class="config-header">
            <h4>Banner Trang Chủ</h4>
            <a href="{{ route('get.banner') }}"><button class="edit-btn" id="editBannerBtn">
              <i class="fa-solid fa-pen"></i> Chỉnh sửa
            </button></a>
          </div>
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

      <!-- Contact Info -->
      <div class="config-box">
        <div style="margin-top: 20px;" class="config-header">
          <h4>Thông tin Liên hệ</h4>
          <button class="edit-btn" id="editContactBtn">
            <i class="fa-solid fa-pen"></i> Chỉnh sửa
          </button>
        </div>
        <table class="contact-table">
          <thead>
            <tr>
              <th>Loại</th>
              <th>Giá trị</th>
            </tr>
          </thead>
          <tbody id="contactBody">
            @php
                $information = App\Models\Information::first();
            @endphp
            <tr><td>Phone 1</td><td>{{$information->phone1}}</td></tr>
            <tr><td>Phone 2</td><td>{{$information->phone2}}</td></tr>
            <tr><td>Số điện thoại Zalo</td><td>{{$information->zalo}}</td></tr>
            <tr><td>Link Facebook</td><td>{{$information->facebook}}</td></tr>
            <tr><td>Link Instagram</td><td>{{$information->instagram}}</td></tr>
            <tr><td>Address 1</td><td>{{$information->address1}}</td></tr>
            <tr><td>Address 2</td><td>{{$information->address2}}</td></tr>
          </tbody>
        </table>
      </div>
    </section>
  </main>

  
 <!-- Modal Contact -->
  <div id="contactModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h3>Chỉnh sửa Thông tin Liên hệ</h3>
        <span class="close">×</span>
      </div>
      <form action="{{ route('update.information') }}" method="POST" id="contactForm">
        @csrf
        <div id="contactInputs">
            <input type="hidden" name="id" value="{{$information->id}}" />
            <label>Phone 1</label>
            <input type="text" id="phone1" placeholder="" name="phone1" value="{{$information->phone1}}"/>
            <label>Phone 2</label>
            <input type="text" id="phone2" placeholder="" name="phone2" value="{{$information->phone2}}" />
            <label>Phone zalo</label>
            <input type="text" id="zalo" placeholder="" name="zalo" value="{{$information->zalo}}" />
            <label>Link Facebook</label>
            <input type="text" id="facebook" placeholder="" name="facebook" value="{{$information->facebook}}" />
            <label>Link Instagram</label>
            <input type="text" id="instagram" placeholder="" name="instagram" value="{{$information->instagram}}" />
            <label>Address 1</label>
            <input type="text" id="address1" placeholder="" name="address1" value="{{$information->address1}}" />
            <label>Address 2</label>
            <input type="text" id="address2" placeholder="" name="address2" value="{{$information->address2}}" />
        </div>
        <div class="form-actions">
          <button type="submit" class="save-btn">Lưu</button>
          <button type="button" class="cancel-btn">Hủy</button>
        </div>
      </form>
    </div>
  </div>

  <!-- JS Logic -->
  <script>

/* ===== Contact Modal ===== */
const contactModal = document.getElementById("contactModal");
const contactForm  = document.getElementById("contactForm");

document.getElementById("editContactBtn").onclick = () => {
    contactModal.style.display = "flex";
};

/* ===== Đóng Contact Modal ===== */
document.querySelectorAll('#contactModal .close, #contactModal .cancel-btn')
    .forEach(btn => {
        btn.onclick = () => contactModal.style.display = "none";
    });

function validatePhone(input) {
    const value = input.value.trim();
    const errorId = input.id + "-error"; // phone1-error, phone2-error, zalo-error
    let errorBox = document.getElementById(errorId);

    if (!errorBox) {
        errorBox = document.createElement("div");
        errorBox.id = errorId;
        errorBox.className = "error-text";
        input.insertAdjacentElement("afterend", errorBox);
    }

    const regex = /^[0-9]{10}$/;

    if (value === "") {
        errorBox.textContent = "";
        input.classList.remove("input-error");
        return true;
    }

    if (!regex.test(value)) {
        errorBox.textContent = "Số điện thoại bao gồm 10 chữ số.";
        input.classList.add("input-error");
        return false;
    }

    // Hợp lệ
    errorBox.textContent = "";
    input.classList.remove("input-error");
    return true;
}
["phone1", "phone2", "zalo"].forEach(id => {
    const input = document.getElementById(id);
    if (input) {
        input.addEventListener("input", () => validatePhone(input));
    }
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
const carousel = document.getElementById("bannerCarousel");
const images = carousel.querySelectorAll("img");
const dots = carousel.querySelectorAll(".dots span");
const prevBtn = carousel.querySelector(".prev");
const nextBtn = carousel.querySelector(".next");

let index = 0;

function showSlide(i) {
    images.forEach(img => img.classList.remove("active"));
    dots.forEach(dot => dot.classList.remove("active"));

    images[i].classList.add("active");
    dots[i].classList.add("active");

    index = i;
}

nextBtn.onclick = () => {
    let newIndex = (index + 1) % images.length;
    showSlide(newIndex);
};

prevBtn.onclick = () => {
    let newIndex = (index - 1 + images.length) % images.length;
    showSlide(newIndex);
};

dots.forEach(dot => {
    dot.onclick = () => {
        showSlide(parseInt(dot.dataset.index));
    };
});

// Auto slide 5s
setInterval(() => {
    let newIndex = (index + 1) % images.length;
    showSlide(newIndex);
}, 5000);


  </script>

</body>
</html>

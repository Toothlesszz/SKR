<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bảng điều khiển - GreenBike</title>
  <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin/admin_products.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
        body {
            font-family: "Segoe UI", sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        header {
            background-color: #fff;
            padding: 10px 20px;
            border-bottom: 1px solid #ddd;
        }
        header img {
            height: 40px;
        }
        header nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header nav a {
            text-decoration: none;
            color: #333;
            margin: 0 10px;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }
        .form-group textarea {
            resize: none;
            height: 100px;
        }
        .upload-box {
            border: 2px dashed #ddd;
            padding: 20px;
            text-align: center;
            border-radius: 4px;
            background-color: #f9f9f9;
            cursor: pointer;
        }
        .upload-box p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }
        .uploaded-images {
            display: flex;
            flex-wrap: wrap;
            margin-top: 10px;
        }
        .uploaded-images img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .seo-section input {
            margin-bottom: 10px;
        }
        /* WYSIWYG Editor */
        .editor-toolbar {
            border: 1px solid #ddd;
            border-bottom: none;
            background: #f5f5f5;
            padding: 5px;
            border-radius: 4px 4px 0 0;
        }
        .editor-toolbar button {
            background: none;
            border: none;
            cursor: pointer;
            margin-right: 5px;
            font-size: 16px;
            padding: 5px;
        }
        .editor-content {
            border: 1px solid #ddd;
            border-radius: 0 0 4px 4px;
            min-height: 150px;
            padding: 10px;
            background: #fff;
        }
        .sub-title {
    color: #7a7a7a;
    font-size: 20px;
    margin-bottom: 18px;
}
.highlight-title {
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 4px;
}
.highlight-desc {
    color: #7a7a7a;
    margin-bottom: 10px;
}
.highlight-row {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
}
.highlight-input {
    flex: 1;
    padding: 16px;
    border: none;
    background: #f5f5f7;
    border-radius: 12px;
    font-size: 17px;
    margin-right: 10px;
    transition: background 0.2s;
}
.highlight-input:focus {
    outline: none;
    background: #e9e9eb;
}
.highlight-remove {
    cursor: pointer;
    font-size: 22px;
    color: #222;
    padding: 0 8px;
    border-radius: 50%;
    transition: background 0.2s;
}
.highlight-remove:hover {
    background: #eee;
}
.highlight-btn {
    background: #fff;
    color: #222;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 12px 22px;
    font-size: 18px;
    font-weight: 500;
    cursor: pointer;
    margin-top: 8px;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: background 0.2s;
}
.highlight-btn:hover {
    background: #f5f5f7;
}
.show-toggle-group {
    display: flex;
    align-items: center;
    margin-top: 10px;
}
.switch {
    position: relative;
    display: inline-block;
    width: 48px;
    height: 28px;
    margin-right: 12px;
}
.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}
.slider {
    position: absolute;
    cursor: pointer;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: #2046c7;
    border-radius: 28px;
    transition: .4s;
}
.slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 4px;
    bottom: 4px;
    background-color: #fff;
    border-radius: 50%;
    transition: .4s;
}
.switch input:checked + .slider {
    background-color: #2046c7;
}
.switch input:checked + .slider:before {
    transform: translateX(20px);
}
.show-label {
    font-size: 20px;
    font-weight: 600;
    color: #222;
}
.slider {
    position: absolute;
    cursor: pointer;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: #ccc; /* Màu khi tắt */
    border-radius: 28px;
    transition: .4s;
}
.switch input:checked + .slider {
    background-color: #2046c7; /* Màu khi bật */
}
.product-gallery { border: 1px dashed #e0e0e0; padding: 18px; border-radius: 8px; background:#fff; }
.gallery-list { display:flex; gap:18px; flex-wrap:wrap; min-height:120px; margin-bottom:12px; }
.thumb { position:relative; width:280px; height:160px; border-radius:10px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.06); background:#f6f6f6; display:flex; align-items:center; justify-content:center; }
.thumb img { width:100%; height:100%; object-fit:cover; display:block; }
.thumb-delete { position:absolute; top:10px; right:10px; background:#e83e6b; color:#fff; border:none; width:36px; height:36px; border-radius:8px; cursor:pointer; font-weight:700; }
.gallery-actions { display:flex; align-items:center; gap:12px; }
.add-images-btn { background:#fff; border:1px solid #ddd; padding:10px 16px; border-radius:8px; cursor:pointer; }
.add-images-btn:hover { background:#f5f5f7; }
/* preview for newly added images uses same .thumb class, mark them with .new */
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
    <!-- Header -->
  <header class="admin-header">
     <div class="logo">
      <div class="logo-circle"><img src="{{ asset('images/header_logo_removebg.png') }}" alt="Logo"></div>
      <span>XE ĐIỆN SAKURA</span>
    </div>
    <nav>
      <a href="{{url('/admin/dashboard')}}">Dashboard</a>
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
  <div class="container">
    <a href="{{url('/admin/dashboard')}}"><button class="btn-back" id="btnBack" aria-label="Quay lại" title="Quay lại">
  <span class="icon" aria-hidden="true">←</span>
  <span class="label">Quay lại</span>
</button></a>
    <h1>Quản lý Banner Trang Chủ</h1>
  <form id="productForm" action="" method="POST" enctype="multipart/form-data">
    @csrf

   <div id="product-gallery" class="product-gallery">
        <div class="gallery-list" id="gallery-list">
            <input type="hidden" name="information_id" value="{{ $information->id ?? '' }}">
            @if(isset($banner) && is_array($banner))
                @foreach($banner as $key => $b)
                    <div class="thumb existing" data-name="{{ $b }}">
                        <img src="{{ asset('storage/' . $b) }}" alt="">
                        <button type="button" class="thumb-delete" title="Xóa">✕</button>
                        <input type="hidden" name="banner_images[]" value="{{ $b }}"> <!-- unified name -->
                    </div>
                @endforeach
            @endif
        </div>
                    
        </div>

        <div class="gallery-actions">
        <label class="upload-bar" for="gallery-files-input" role="button" tabindex="0" aria-label="Thêm hình ảnh">
            <span class="upload-icon">📤</span>
            <span class="upload-text">Thêm hình ảnh</span>
        </label>
        <input type="file" id="gallery-files-input" name="banner-images[]" accept="image/*" multiple style="display:none">
        </div>

        <!-- input để gửi các ảnh đã bị xóa (tên file) về server -->
        <div id="deleted-images-inputs"></div>
    </div>

    <div class="form-actions">
          <button type="submit" class="btn-save">Lưu</button>
          <button type="button" class="btn-cancel">Hủy</button>
        </div>

</form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    function setFilesToInput(input, filesArray) {
        const dt = new DataTransfer();
        filesArray.forEach(f => dt.items.add(f));
        input.files = dt.files;
    }
    function fileKey(file) { return `${file.name}_${file.size}_${file.lastModified || 0}`; }

    /* PRODUCT GALLERY - unified name banner_images[] */
    const galleryList = document.getElementById('gallery-list');
    const galleryFileInput = document.getElementById('gallery-files-input');
    const deletedContainer = document.getElementById('deleted-images-inputs');
    const uploadBar = document.querySelector('.upload-bar');
    if (galleryFileInput) galleryFileInput.name = 'banner_images[]'; // set unified name

    const productImages = []; // { type:'existing', name } or { type:'file', file, key }

    if (galleryList && galleryFileInput) {
        // init existing from DOM (ensure hidden inputs in blade use banner_images[])
        document.querySelectorAll('#gallery-list .thumb.existing').forEach(el => {
            const name = el.dataset.name || el.dataset.existingName;
            if (name) productImages.push({ type: 'existing', name });
            const btn = el.querySelector('.thumb-delete');
            if (btn && !btn.dataset.bound) {
                btn.addEventListener('click', () => {
                    // remove server-hidden banner_images[] input
                    document.querySelectorAll('input[name="banner_images[]"]').forEach(i => { if (i.value === name) i.remove(); });
                    // add deleted marker
                    if (deletedContainer) {
                        const hid = document.createElement('input');
                        hid.type = 'hidden';
                        hid.name = 'deleted_banner_images[]';
                        hid.value = name;
                        deletedContainer.appendChild(hid);
                    }
                    // remove from array + DOM
                    for (let i = productImages.length-1;i>=0;i--) if (productImages[i].type==='existing' && productImages[i].name===name) productImages.splice(i,1);
                    el.remove();
                });
                btn.dataset.bound = '1';
            }
        });

        function makeThumb({ src, file=null, existingName=null }) {
            const wrap = document.createElement('div');
            wrap.className = 'thumb' + (existingName ? ' existing' : ' new');
            const img = document.createElement('img'); img.src = src; wrap.appendChild(img);
            const btn = document.createElement('button'); btn.type='button'; btn.className='thumb-delete'; btn.textContent='✕'; wrap.appendChild(btn);
            if (existingName) wrap.dataset.existingName = existingName;
            if (file) {
                wrap.dataset.fileName = file.name;
                wrap.dataset.fileSize = String(file.size);
                wrap.dataset.fileLM = String(file.lastModified || 0);
            }
            btn.addEventListener('click', () => {
                if (wrap.dataset.existingName) {
                    const val = wrap.dataset.existingName;
                    document.querySelectorAll('input[name="banner_images[]"]').forEach(i => { if (i.value === val) i.remove(); });
                    if (deletedContainer) {
                        const hid = document.createElement('input');
                        hid.type = 'hidden';
                        hid.name = 'deleted_banner_images[]';
                        hid.value = val;
                        deletedContainer.appendChild(hid);
                    }
                    for (let i = productImages.length-1;i>=0;i--) if (productImages[i].type==='existing' && productImages[i].name===val) productImages.splice(i,1);
                    wrap.remove();
                    return;
                }
                // new file remove
                const key = `${wrap.dataset.fileName}_${wrap.dataset.fileSize}_${wrap.dataset.fileLM}`;
                for (let i = productImages.length-1;i>=0;i--) if (productImages[i].type==='file' && productImages[i].key===key) productImages.splice(i,1);
                const filesForInput = productImages.filter(it => it.type==='file').map(it => it.file);
                setFilesToInput(galleryFileInput, filesForInput);
                wrap.remove();
            });
            return wrap;
        }

        function handleGalleryFiles(list) {
            if (!list || list.length===0) return;
            const toAdd = Array.from(list);
            toAdd.forEach(file => {
                if (!file.type.startsWith('image/')) return;
                const key = fileKey(file);
                if (productImages.some(it => it.type==='file' && it.key===key)) return;
                productImages.push({ type:'file', file, key });
                const reader = new FileReader();
                reader.onload = ev => {
                    const thumb = makeThumb({ src: ev.target.result, file });
                    galleryList.appendChild(thumb);
                };
                reader.readAsDataURL(file);
            });
            const filesForInput = productImages.filter(it => it.type==='file').map(it => it.file);
            setFilesToInput(galleryFileInput, filesForInput);
        }

        galleryList.addEventListener('dragover', e=>{ e.preventDefault(); galleryList.classList.add('dragover'); });
        galleryList.addEventListener('dragleave', e=>{ e.preventDefault(); galleryList.classList.remove('dragover'); });
        galleryList.addEventListener('drop', e=>{ e.preventDefault(); galleryList.classList.remove('dragover'); handleGalleryFiles(e.dataTransfer.files); });

        if (uploadBar) {
            uploadBar.addEventListener('dragover', e=>{ e.preventDefault(); uploadBar.classList.add('dragover'); });
            uploadBar.addEventListener('dragleave', e=>{ e.preventDefault(); uploadBar.classList.remove('dragover'); });
            uploadBar.addEventListener('drop', e=>{ e.preventDefault(); uploadBar.classList.remove('dragover'); handleGalleryFiles(e.dataTransfer.files); });
            uploadBar.addEventListener('keydown', e=>{ if (e.key==='Enter' || e.key===' ') { e.preventDefault(); galleryFileInput.click(); }});
        }

        if (!galleryFileInput.dataset.bound) {
            galleryFileInput.addEventListener('change', e => handleGalleryFiles(e.target.files));
            galleryFileInput.dataset.bound = '1';
        }
} // end product gallery
});   // Thông báo chỉnh sửa thành công
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

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm mới</title>
    <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin_products.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
  background: rgba(18, 98, 6, 0.12);
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
      <a href="{{url('/admin/products')}}"class="active">Quản lý Sản phẩm</a>
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
        <a href="{{url('/admin/products')}}"><button class="btn-back" id="btnBack" aria-label="Quay lại" title="Quay lại">
  <span class="icon" aria-hidden="true">←</span>
  <span class="label">Quay lại</span>
</button></a>
        <h1>Thêm sản phẩm mới</h1>
        <form action="{{ route('products.insert') }}" method="POST" enctype="multipart/form-data" >
    @csrf
        <div class="section">
            <h2>Thông tin cơ bản</h2>
            <div class="form-group">
                <label for="product-name">Tên sản phẩm</label>
                <input type="text" name="name" id="product-name" placeholder="Nhập tên sản phẩm">
            </div>
            <div class="form-group">
                <label for="slug">Slug (URL)</label>
                <input type="text" name="slug" id="slug" placeholder="Nhập slug">
            </div>
            <div class="form-group">
                <label for="mota">Mô tả</label>
                <input type="text" name="mota" id="mota" placeholder="Nhập mô tả ngắn về sản phẩm">
            </div>
            <div class="form-group">
                <label for="category">Dòng xe</label>
                <select name="category" id="category">
                    <option value="">Chọn dòng xe</option>
                    @foreach($vendors as $vendor)
                        <option value="{{ $vendor->id }}">{{ $vendor->ten_dongxe }}</option>
                    @endforeach
                </select>
            </div>
           <div class="form-group show-toggle-group">
            <label class="switch">
                <input type="checkbox" name="show_product" id="show-product" checked>
                <span class="slider"></span>
            </label>
            <span class="show-label">Hiển thị sản phẩm</span>
            </div>
        </div>
        <div class="section">
            <h2>Hình ảnh sản phẩm</h2>
            <div class="upload-box" id="upload-box">
                <p>Kéo ảnh vào đây hoặc nhấp để chọn</p>
                <p>Các định dạng được hỗ trợ: JPG, PNG, GIF</p>
            </div>
            <input type="file" name="product_images[]" id="upload-input" accept="image/*" multiple style="display:none">
            <div class="uploaded-images" id="uploaded-images"></div>
        </div>
        <div class="section">
        <h2>Mô tả chi tiết</h2>
    <div class="editor-toolbar">
        <button type ="button" onclick="format('undo')" title="Hoàn tác">&#8630;</button>
        <button type="button" onclick="format('redo')" title="Làm lại">&#8631;</button>
        <button type="button" onclick="setHeading('H1')" title="Tiêu đề lớn">H1</button>
        <button type="button" onclick="setHeading('H2')" title="Tiêu đề nhỏ">H2</button>
        <button type="button" onclick="setHeading('H3')" title="Đoạn văn">H3</button>
        <button type="button" onclick="format('bold')" title="Đậm"><b>B</b></button>
        <button type="button" onclick="format('italic')" title="Nghiêng"><i>I</i></button>
        <button type="button" onclick="format('underline')" title="Gạch chân"><u>U</u></button>
        <button type="button" onclick="format('insertOrderedList')" title="Danh sách số">&#35;</button>
        <button type="button" onclick="format('insertUnorderedList')" title="Danh sách chấm">&#8226;</button>
        <button type="button" onclick="format('justifyLeft')" title="Căn trái">&#8676;</button>
        <button type="button" onclick="format('justifyCenter')" title="Căn giữa">&#8596;</button>
        <button type="button" onclick="format('justifyRight')" title="Căn phải">&#8677;</button>
        <button type="button" onclick="format('createLink')" title="Chèn link">&#128279;</button>
        <button type="button" onclick="document.getElementById('editor-image-input').click()" title="Thêm ảnh">&#128247;</button>
        <input type="file" name="description_images[]" id="editor-image-input" accept="image/*" multiple style="display:none">
    </div>
    <div class="editor-content" id="editor" contenteditable="true" spellcheck="false" placeholder="Nhập mô tả chi tiết sản phẩm..."></div>
 
    <textarea name="detailed_description" id="editor-textarea" style="display:none;"></textarea>
        </div>
        
        <div class="section">
            <h2>Thông tin sản phẩm</h2>
            <p class="sub-title">Nhập các thông tin chi tiết của sản phẩm</p>
            <div class="form-group">
                <label class="highlight-title">Điểm nổi bật (gạch đầu dòng)</label>
                <p class="highlight-desc">Nhập các điểm nổi bật của sản phẩm</p>
                <div id="highlight-list">
                    <!-- Các input sẽ được thêm vào đây -->
                </div>
                <button type="button" id="add-highlight" class="highlight-btn">
                    <span style="font-size:20px;vertical-align:middle;">+</span> Thêm điểm nổi bật
                </button>
            </div>
            <div class="form-group">
                <label for="product-info">Ảnh thông số kĩ thuật</label>
            </div>
            <div class="upload-box" id="upload-box-info">
                <p>Kéo ảnh vào đây hoặc nhấp để chọn</p>
                <p>Các định dạng được hỗ trợ: JPG, PNG, GIF</p>
            </div>
            <input type="file" name="technical_spec_images[]" id="upload-input-info" accept="image/*" multiple style="display:none">
            <div class="uploaded-images" id="uploaded-images-info"></div>
        </div>
        <div class="section seo-section">
            <h2>Cấu hình SEO</h2>
            <div class="form-group">
                <label for="seo-title">Tiêu đề SEO</label>
                <input type="text" name="seo_title" id="seo-title" placeholder="Nhập tiêu đề SEO">
            </div>
            <div class="form-group">
                <label for="seo-description">Mã mô tả SEO</label>
                <input type="text" name="seo_description" id="seo-description" placeholder="Nhập mã mô tả SEO">
            </div>
        </div>
         <div class="form-actions">
          <button type="submit" class="btn-save">Lưu sản phẩm</button>
          <button type="button" class="btn-cancel">Hủy</button>
        </div>
</form>
    </div>
    <script>
    /* ------------------------------
        HÀM GÁN FILE KHÔNG GHI ĐÈ
    ------------------------------ */
    function setFilesToInput(input, files) {
        const dt = new DataTransfer();
        for (let i = 0; i < files.length; i++) {
            dt.items.add(files[i]);
        }
        input.files = dt.files;
    }

    /* ------------------------------
        PREVIEW ẢNH SẢN PHẨM
    ------------------------------ */

    const uploadBox = document.getElementById('upload-box');
    const uploadInput = document.getElementById('upload-input');
    const uploadedImages = document.getElementById('uploaded-images');

    uploadBox.addEventListener('click', () => uploadInput.click());
    uploadBox.addEventListener('dragover', e => { 
        e.preventDefault(); 
        uploadBox.style.background = "#e3e3e3"; 
    });
    uploadBox.addEventListener('dragleave', e => { 
        e.preventDefault(); 
        uploadBox.style.background = "#f9f9f9"; 
    });

    uploadBox.addEventListener('drop', e => {
        e.preventDefault();
        uploadBox.style.background = "#f9f9f9";

        setFilesToInput(uploadInput, e.dataTransfer.files);
        handleFiles(e.dataTransfer.files, uploadedImages);
    });

    uploadInput.addEventListener('change', e => {
        setFilesToInput(uploadInput, e.target.files);
        handleFiles(e.target.files, uploadedImages);
    });

    /* ------------------------------
        PREVIEW ẢNH THÔNG SỐ KỸ THUẬT
    ------------------------------ */

    const uploadBoxInfo = document.getElementById('upload-box-info');
    const uploadInputInfo = document.getElementById('upload-input-info');
    const uploadedImagesInfo = document.getElementById('uploaded-images-info');

    uploadBoxInfo.addEventListener('click', () => uploadInputInfo.click());
    uploadBoxInfo.addEventListener('dragover', e => { 
        e.preventDefault(); 
        uploadBoxInfo.style.background = "#e3e3e3"; 
    });
    uploadBoxInfo.addEventListener('dragleave', e => { 
        e.preventDefault(); 
        uploadBoxInfo.style.background = "#f9f9f9"; 
    });

    uploadBoxInfo.addEventListener('drop', e => {
        e.preventDefault();
        uploadBoxInfo.style.background = "#f9f9f9";

        setFilesToInput(uploadInputInfo, e.dataTransfer.files);
        handleFiles(e.dataTransfer.files, uploadedImagesInfo);
    });

    uploadInputInfo.addEventListener('change', e => {
        setFilesToInput(uploadInputInfo, e.target.files);
        handleFiles(e.target.files, uploadedImagesInfo);
    });

    /* ------------------------------
        HÀM XỬ LÝ PREVIEW ẢNH
    ------------------------------ */
    function handleFiles(files, container) {
        for (const file of files) {
            if (!file.type.startsWith('image/')) continue;
            
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }

    /* ------------------------------
        WYSIWYG
    ------------------------------ */
    function format(command) {
        if (command === 'createLink') {
            const url = prompt('Nhập URL:');
            if (url) document.execCommand(command, false, url);
        } else {
            document.execCommand(command, false, null);
        }
    }
    function setHeading(level) {
    document.execCommand('formatBlock', false, level);
    }

    /* ------------------------------
        ĐIỂM NỔI BẬT
    ------------------------------ */
    const highlightList = document.getElementById('highlight-list');
    const addHighlightBtn = document.getElementById('add-highlight');
    let highlightCount = 0;

    function createHighlightInput() {
        highlightCount++;
        const row = document.createElement('div');
        row.className = 'highlight-row';

        const input = document.createElement('input');
        input.type = 'text';
        input.className = 'highlight-input';
        input.placeholder = `Điểm nổi bật ${highlightCount}...`;
        input.name = `highlight_point_${highlightCount}`;

        const removeBtn = document.createElement('span');
        removeBtn.className = 'highlight-remove';
        removeBtn.innerHTML = '&times;';
        removeBtn.onclick = () => row.remove();

        row.appendChild(input);
        row.appendChild(removeBtn);

        return row;
    }

    highlightList.appendChild(createHighlightInput());
    highlightList.appendChild(createHighlightInput());
    highlightList.appendChild(createHighlightInput());

    addHighlightBtn.onclick = () => {
        highlightList.appendChild(createHighlightInput());
    };

    /* ------------------------------
        EDITOR DRAG & DROP IMAGE
    ------------------------------ */
    const editor = document.getElementById('editor');
    const editorTextarea = document.getElementById('editor-textarea');

    editor.addEventListener('dragover', e => e.preventDefault());
    editor.addEventListener('drop', e => {
        e.preventDefault();
        const files = e.dataTransfer.files;

        for (const file of files) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = ev => {
                    const img = document.createElement('img');
                    img.src = ev.target.result;
                    img.style.maxWidth = '300px';
                    img.style.margin = '10px 0';
                    editor.appendChild(img);

                    editorTextarea.value = editor.innerHTML;
                };
                reader.readAsDataURL(file);
            }
        }
    });

    editor.addEventListener('input', () => {
        editorTextarea.value = editor.innerHTML;
    });
    const editorImageInput = document.getElementById('editor-image-input');

if (editorImageInput) {
    editorImageInput.addEventListener('change', (e) => {
        const files = Array.from(e.target.files || []);
        files.forEach(file => {
            if (!file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = (ev) => {
                const img = document.createElement('img');
                img.src = ev.target.result;
                img.style.maxWidth = '300px';
                img.style.margin = '10px 0';
                // chèn ảnh vào editor ở vị trí cuối (nếu cần chèn tại con trỏ thì nâng cấp sau)
                editor.appendChild(img);
                // đồng bộ textarea
                if (editorTextarea) editorTextarea.value = editor.innerHTML;
            };
            reader.readAsDataURL(file);
        });
        // reset input để có thể chọn lại cùng file nếu cần
        e.target.value = '';
    });
}
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
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa tin tức</title>
    
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
.upload-bar {
    border: 2px dashed #bbb;
    padding: 16px;
    cursor: pointer;
    border-radius: 6px;
    text-align: center;
    transition: .2s;
}

.upload-bar.dragging {
    border-color: #4dabff;
    background: #eaf6ff;
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
      <a href="{{url('/admin/dashboard')}}">Dashboard</a>
      <a href="{{url('/admin/products')}}">Quản lý Sản phẩm</a>
      <a href="{{url('/admin/vendor')}}">Quản lý Dòng xe</a>
      <a href="{{url('/admin/news')}}" class="active">Quản lý Tin tức</a>
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
        <a href="{{url('/admin/news')}}"><button class="btn-back" id="btnBack" aria-label="Quay lại" title="Quay lại">
  <span class="icon" aria-hidden="true">←</span>
  <span class="label">Quay lại</span>
</button></a>
        <h1>Chỉnh sửa sản phẩm</h1>
        <form action="{{ route('news.update', [$news->id]) }}" method="POST" enctype="multipart/form-data" >
    @csrf
        <div class="section">
            <h2>Thông tin cơ bản</h2>
            <div class="form-group">
                <label for="news-title">Tiêu đề tin tức</label>
                <input type="text" name="title" id="news-title" value="{{ $news->tieude }}">
            </div>
            <div class="form-group">
                <label for="slug">Slug (URL)</label>
                <input type="text" name="slug" id="slug" value="{{ $news->slug_tintuc }}">
            </div>
           
           <div class="form-group show-toggle-group">
            <label class="switch">
                
              @if($news->hienthi == 0)
                <input type="checkbox" name="show_news" id="show-news" >
              @else
              <input type="checkbox" name="show_news" id="show-news" checked>
              @endif
                
                <span class="slider"></span>
            </label>
            <span class="show-label">Hiển thị tin tức</span>
            </div>
        </div>
        <div class="section">
    <h2>Ảnh bìa</h2>
    <div id="product-gallery" class="product-gallery">
    <div class="gallery-list" id="gallery-list">
        @if($news->anhbia)
        <div class="thumb existing" data-name="{{ $news->anhbia }}">
            <img src="{{ asset('storage/' . $news->anhbia) }}" alt="">
            <button type="button" class="thumb-delete">✕</button>
            <input type="hidden" name="cover_image_existing" value="{{ $news->anhbia }}">
        </div>
        @endif
    </div>

    <div class="gallery-actions">
        <label class="upload-bar" for="gallery-files-input">
            <span class="upload-icon">📤</span>
            <span class="upload-text">Chọn ảnh bìa</span>
        </label>
        <input type="file" id="gallery-files-input" name="cover_image_file" accept="image/*" style="display:none">
    </div>

    <input type="hidden" name="deleted_image" id="deleted_image">
</div>
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
        <input type="file" name="description_images[]" id="editor-image-input" accept="image/*" style="display:none">
    </div>
    @php
    $html = $news->noidung;
    $html = preg_replace('/<!DOCTYPE[^>]*>/i', '', $html);
    $html = preg_replace('/<\?xml[^>]*>/i', '', $html);
    if (preg_match('/<body[^>]*>(.*?)<\/body>/is', $html, $matches)) {
        $html = $matches[1];
    }
@endphp
    <!-- editor (visible) -->
    <div class="editor-content" id="editor" contenteditable="true" spellcheck="false" >{!! $html !!}</div>

    <!-- hidden textarea dùng để submit -->
    <textarea name="detailed_description" id="editor-textarea" hidden></textarea>
</div>

        <div class="section">
            
                <div class="form-group">
                <label class="highlight-title">Tags</label>
         

                <div id="highlight-list">
                @php
                    $tags = [];
                    if(isset($news) && $news->tag) {
                        $tags = json_decode($news->tag, true) ?: [];
                    }
                @endphp

                @if(count($tags) > 0)
                    @foreach($tags as $tag)
                    <div class="highlight-row">
                        <input type="text" class="highlight-input" value="{{ $tag }}" />
                        <button type="button" class="highlight-remove">✕</button>
                    </div>
                    @endforeach
            @endif
            </div>

                <div style="margin-top:8px; display:flex; gap:8px; align-items:center;">
                    <button type="button" id="add-highlight" class="highlight-btn">
                        <span style="font-size:20px;vertical-align:middle;">+</span> Thêm tag
                    </button>
                    <!-- hidden input lưu mảng JSON các điểm nổi bật khi submit -->
                    <input type="hidden" name="highlight_points" id="highlight-points-input" value="">
                </div>
            </div>
          <div class="section seo-section">
            <h2>Cấu hình SEO</h2>
            <div class="form-group">
                <label for="seo-title">Tiêu đề SEO</label>
                <input type="text" name="seo_title" id="seo-title" value="{{$news->seo_title}}">
            </div>
            <div class="form-group">
                <label for="seo-description">Mã mô tả SEO</label>
                <input type="text" name="seo_description" id="seo-description" value="{{$news->seo_description}}">
            </div>
        </div>
         <div class="form-actions">
          <button type="submit" class="btn-save">Lưu bài viết</button>
          <button type="button" class="btn-cancel">Hủy</button>
        </div>
</form>
    </div>
  <script>
   function setHeading(level) {
    document.execCommand('formatBlock', false, level);
    }
document.addEventListener('DOMContentLoaded', function () {
    /* ------------------------------
       Utility: set FileList without overwrite
    ------------------------------ */
    function setFilesToInput(input, filesArray) {
        const dt = new DataTransfer();
        filesArray.forEach(f => dt.items.add(f));
        input.files = dt.files;
    }


    /* ------------------------------
       WYSIWYG editor + image insert
       //Mô tả chi tiết
    ------------------------------ */
    function format(command) {
        if (command === 'createLink') {
            const url = prompt('Nhập URL:');
            if (url) document.execCommand(command, false, url);
        } else {
            document.execCommand(command, false, null);
        }
    }
    window.format = format; // keep global for onclick buttons

    const editor = document.getElementById('editor');
    const editorTextarea = document.getElementById('editor-textarea');
    const editorImageInput = document.getElementById('editor-image-input');

    if (editor) {
        // prevent default global drop behaviour
        editor.addEventListener('dragover', e => e.preventDefault());
        editor.addEventListener('drop', e => {
            e.preventDefault();
            const files = e.dataTransfer.files || [];
            Array.from(files).forEach(file => {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = ev => {
                    const img = document.createElement('img');
                    img.src = ev.target.result;
                    img.style.maxWidth = '100%';
                    img.style.margin = '10px 0';
                    editor.appendChild(img);
                    if (editorTextarea) editorTextarea.value = editor.innerHTML;
                };
                reader.readAsDataURL(file);
            });
        });

        editor.addEventListener('input', () => {
            if (editorTextarea) editorTextarea.value = editor.innerHTML;
        });
    }

    if (editorImageInput && editor) {
        editorImageInput.addEventListener('change', function (e) {
            const files = Array.from(e.target.files || []);
            files.forEach(file => {
                if (!file.type.startsWith('image/')) return;
                const reader = new FileReader();
                reader.onload = function (ev) {
                    const img = document.createElement('img');
                    img.src = ev.target.result;
                    img.style.maxWidth = '100%';
                    img.style.margin = '10px 0';
                    editor.appendChild(img);
                    if (editorTextarea) editorTextarea.value = editor.innerHTML;
                };
                reader.readAsDataURL(file);
            });
            editorImageInput.value = '';
        });
    }

    // ensure textarea initial sync
    if (editor && editorTextarea && editorTextarea.value.trim() === '') {
        editorTextarea.value = editor.innerHTML;
    }
    

});
/* ---------------------
   HIGHLIGHT (fix delete for server-rendered rows)
   // Điểm nổi bật
   --------------------- */
(function () {
    const highlightList = document.getElementById('highlight-list');
    const addHighlightBtn = document.getElementById('add-highlight');
    const hiddenHighlightInput = document.getElementById('highlight-points-input');

    if (!highlightList) return;

    function nextIndex() {
        return highlightList.querySelectorAll('.highlight-row').length + 1;
    }

    function createHighlightRow(value = '') {
    const idx = nextIndex();
    const row = document.createElement('div');
    row.className = 'highlight-row';

    const input = document.createElement('input');
    input.type = 'text';
    input.className = 'highlight-input';
    input.placeholder = `Điểm nổi bật ${idx}...`;
    input.value = value;
    // removed: input.name = `highlight_point_${idx}`;

    const removeBtn = document.createElement('button');
    removeBtn.type = 'button';
    removeBtn.className = 'highlight-remove';
    removeBtn.title = 'Xóa';
    removeBtn.innerHTML = '✕';
    removeBtn.addEventListener('click', () => {
        row.remove();
        renumberHighlights();
    });

    row.appendChild(input);
    row.appendChild(removeBtn);
    return row;
}

function renumberHighlights() {
    const rows = highlightList.querySelectorAll('.highlight-row');
    rows.forEach((row, i) => {
        const inp = row.querySelector('.highlight-input');
        if (inp) {
            const n = i + 1;
            inp.placeholder = `Điểm nổi bật ${n}...`;
            // removed: inp.name = `highlight_point_${n}`;
        }
    });
}

    // ensure server-rendered rows have .highlight-input class and bind remove handlers
    highlightList.querySelectorAll('.highlight-row').forEach(row => {
        const inp = row.querySelector('input');
        if (inp) inp.classList.add('highlight-input');

        const removeBtn = row.querySelector('.highlight-remove');
        if (removeBtn && !removeBtn.dataset.bound) {
            removeBtn.addEventListener('click', () => {
                // remove the closest row and renumber
                const r = removeBtn.closest('.highlight-row');
                if (r) {
                    r.remove();
                    renumberHighlights();
                }
            });
            removeBtn.dataset.bound = '1';
        }
    });

  

    // bind add button only once
    if (addHighlightBtn && !addHighlightBtn.dataset.bound) {
        addHighlightBtn.addEventListener('click', () => {
            highlightList.appendChild(createHighlightRow(''));
            highlightList.lastElementChild.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });
        addHighlightBtn.dataset.bound = '1';
    }

    // collect values before submit
    const form = highlightList.closest('form');
    if (form && !form.dataset.highlightsBound) {
        form.addEventListener('submit', () => {
            const values = Array.from(highlightList.querySelectorAll('.highlight-input'))
                .map(i => i.value.trim())
                .filter(v => v !== '');
            if (hiddenHighlightInput) hiddenHighlightInput.value = JSON.stringify(values);
        });
        form.dataset.highlightsBound = '1';
    }
    })();

document.addEventListener("DOMContentLoaded", function () {

    const galleryList = document.getElementById("gallery-list");
    const fileInput = document.getElementById("gallery-files-input");
    const deletedImageInput = document.getElementById("deleted_image");
    const uploadBar = document.querySelector(".upload-bar");
    const dropZones = [uploadBar, galleryList];

    function showError(msg) {
        alert(msg); 
    }

    function renderThumbnail(file, src) {

        const oldThumb = galleryList.querySelector(".thumb");
        if (oldThumb) oldThumb.remove();

        const existingInput = document.querySelector('input[name="cover_image_existing"]');
        if (existingInput) {
            deletedImageInput.value = existingInput.value;
            existingInput.remove();
        }

        const div = document.createElement("div");
        div.classList.add("thumb", "new");
        div.dataset.name = file.name;

        div.innerHTML = `
            <img src="${src}" alt="">
            <button type="button" class="thumb-delete" title="Xóa">✕</button>
        `;

        galleryList.appendChild(div);
    }

    galleryList.addEventListener("click", function (e) {
        if (!e.target.classList.contains("thumb-delete")) return;

        const thumb = e.target.closest(".thumb");

        if (thumb.classList.contains("existing")) {
            deletedImageInput.value = thumb.dataset.name;
        }

        thumb.remove();
        fileInput.value = "";
    });


    fileInput.addEventListener("change", function () {

 
        if (this.files.length > 1) {
            showError("Chỉ cho phép upload 1 ảnh bìa");
            this.value = "";
            return;
        }

        const file = this.files[0];
        if (!file) return;

        if (galleryList.querySelector(".thumb")) {
            showError("Chỉ cho phép upload 1 ảnh bìa");
            this.value = "";
            return;
        }

        const reader = new FileReader();
        reader.onload = (e) => renderThumbnail(file, e.target.result);
        reader.readAsDataURL(file);
    });

    dropZones.forEach(zone => {
        ["dragenter", "dragover"].forEach(evt => {
            zone.addEventListener(evt, (e) => {
                e.preventDefault();
                zone.classList.add("dragging");
            });
        });

        ["dragleave", "drop"].forEach(evt => {
            zone.addEventListener(evt, (e) => {
                e.preventDefault();
                zone.classList.remove("dragging");
            });
        });

        zone.addEventListener("drop", (e) => {
            const droppedFiles = e.dataTransfer.files;

          
            if (droppedFiles.length > 1) {
                showError("Chỉ cho phép upload 1 ảnh bìa");
                return;
            }

            const file = droppedFiles[0];
            if (!file) return;

          
            if (galleryList.querySelector(".thumb")) {
                showError("Chỉ cho phép upload 1 ảnh bìa");
                return;
            }

            // Set file vào input
            const dt = new DataTransfer();
            dt.items.add(file);
            fileInput.files = dt.files;

            const reader = new FileReader();
            reader.onload = (ev) => renderThumbnail(file, ev.target.result);
            reader.readAsDataURL(file);
        });
    });

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
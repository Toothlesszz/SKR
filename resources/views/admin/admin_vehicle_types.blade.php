<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Quản lý Dòng xe - GreenBike Admin</title>
  <link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
  <link rel="stylesheet" href="{{ asset('css/admin/admin_products.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    /* Modal và Form */
    .modal {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .modal.show {
      display: flex;
      animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    .modal-content {
      background: linear-gradient(135deg, #eef2f7 0%, #ffffff 100%);
      border-radius: 16px;
      width: 90%;
      max-width: 480px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      border: 1px solid #e2e8f0;
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      padding-bottom: 15px;
      border-bottom: 2px solid #e2e8f0;
    }

    .modal-header h3 {
      font-size: 1.6rem;
      color: #2d3748;
      font-weight: 700;
      text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .close {
      font-size: 22px;
      color: #718096;
      cursor: pointer;
      transition: color 0.2s, transform 0.2s;
    }
    .close:hover {
      color: #e53e3e;
      transform: scale(1.2);
    }

    .modal-form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .form-group label {
      font-weight: 600;
      color: #2d3748;
      font-size: 1rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .form-group input,
    .form-group textarea {
      border: 2px solid #edf2f7;
      border-radius: 8px;
      padding: 12px 15px;
      font-size: 1rem;
      background: #ffffff;
      box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-group input:focus,
    .form-group textarea:focus {
      border-color: #63b3ed;
      box-shadow: 0 0 0 4px rgba(99, 179, 237, 0.3);
      outline: none;
    }

    .form-group textarea {
      resize: vertical;
      min-height: 100px;
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 15px;
      margin-top: 20px;
    }

    .btn-save {
      background: linear-gradient(90deg, #48bb78 0%, #38a169 100%);
      color: #ffffff;
      padding: 12px 25px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      box-shadow: 0 4px 6px rgba(72, 187, 120, 0.3);
      transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-save:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(72, 187, 120, 0.4);
    }

    .btn-cancel {
      background: #edf2f7;
      color: #2d3748;
      padding: 12px 25px;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.2s, transform 0.2s;
    }
    .btn-cancel:hover {
      background: #e2e8f0;
      transform: translateY(-2px);
    }

    /* Bảng danh sách */
    .type-table {
      margin-top: 20px;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      overflow: hidden;
    }

    .type-table-header {
      background: #f9fafb;
      padding: 12px 20px;
      border-bottom: 1px solid #e5e7eb;
    }

    .type-table-header h2 {
      font-size: 1.5rem;
      color: #1e3a8a;
      margin: 0;
    }

    .type-table-header p {
      font-size: 0.9rem;
      color: #6b7280;
      margin: 5px 0 0;
    }

    .type-table-content {
      width: 100%;
      border-collapse: collapse;
    }

    .type-table-content th,
    .type-table-content td {
      padding: 12px 20px;
      text-align: left;
      border-bottom: 1px solid #e5e7eb;
    }

    .type-table-content th {
      background: #f9fafb;
      font-weight: 600;
      color: #374151;
    }

    .type-table-content td {
      color: #374151;
    }

    .type-table-content .actions {
      display: flex;
      gap: 10px;
    }

    .type-table-content .edit-btn,
    .type-table-content .delete-btn {
      background: none;
      border: none;
      cursor: pointer;
      font-size: 1rem;
      color: #6b7280;
      transition: color 0.2s;
    }

    .type-table-content .edit-btn:hover {
      color: #3b82f6;
    }

    .type-table-content .delete-btn:hover {
      color: #ef4444;
    }

    @media (max-width: 600px) {
      .type-table-content th,
      .type-table-content td {
        padding: 10px;
        font-size: 0.9rem;
      }
      .type-table-header h2 {
        font-size: 1.2rem;
      }
    }

    /* Header ngoài ô trắng */
    .section-header {
      margin-bottom: 20px;
    }

    .section-header .btn-add {
      background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
      color: #fff;
      padding: 8px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background 0.2s;
    }

    .section-header .btn-add:hover {
      background: linear-gradient(90deg, #2563eb 0%, #1d4ed8 100%);
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
  <!-- Header -->
  <header class="admin-header">
     <div class="logo">
      <div class="logo-circle"><img src="{{ asset('images/header_logo_removebg.png') }}" alt="Logo"></div>
      <span>XE ĐIỆN SAKURA</span>
    </div>
    <nav>
      <a href="{{url('/admin/dashboard')}}">Dashboard</a>
      <a href="{{url('/admin/products')}}">Quản lý Sản phẩm</a>
      <a href="{{url('/admin/vendor')}}" class="active">Quản lý Dòng xe</a>
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
  <main class="container">
    <section class="section">
      <div class="section-header">
        <div>
          <h2>Quản Lý Dòng Xe</h2>
          <p>Quản lý các loại dòng xe (tag) cho sản phẩm.</p>
        </div>
        <button class="btn-add" id="addVehicleTypeBtn">
          <i class="fa-solid fa-plus"></i> Thêm dòng xe
        </button>
      </div>
      <div class="type-table">
        <div class="type-table-header">
          <h2>Danh sách Dòng xe</h2>
         
          <p id="totalVehicles">Tổng cộng <span id="vehicleCount">{{ count($vendor) }}</span> dòng xe</p>
        </div>
        <table class="type-table-content" id="vehicleTypeList">
          <thead>
            <tr>
              <th>ID</th>
              <th>Tên dòng xe</th>
              <th>Mô tả</th>
              <th>Thao tác</th>
            </tr>
            @foreach ($vendor as $index => $type)
            <tr>
                <td>{{ $index + 1 }}</td>
              <td>{{ $type->ten_dongxe }}</td>
              <td>{{ $type->mota_dongxe ?? 'Chưa có mô tả' }}</td>
              <td>
                <button class="edit-btn" data-id="{{ $type->id }}"><i class="fa-solid fa-pencil"></i></button>
                <button class="delete-btn" data-id="{{ $type->id }}"><i class="fa-solid fa-trash"></i></button>
              </td>
            </tr>
            @endforeach
          </thead>
          <tbody></tbody>
        </table>
      </div>
    </section>
  </main>

  <div id="vehicleTypeModal" class="modal hidden">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="modalTitle">Thêm dòng xe mới</h3>
      </div>
      <form action="{{route ('vendor.insert')}}" method="POST" id="vehicleTypeForm" class="modal-form">
        @csrf
        <div class="form-group">
          <label>Tên dòng xe *</label>
          <input type="text" name="name" id="vehicleTypeName" required />
        </div>
        <div class="form-group">
          <label>Mô tả</label>
          <textarea name="description" id="vehicleTypeDescription" rows="3" placeholder="Nhập mô tả cho dòng xe..."></textarea>
        </div>
        <div class="form-actions">
          <button type="button" class="btn-cancel">Hủy</button>
          <button type="submit" class="btn-save">Lưu dòng xe</button>
        </div>
      </form>
    </div>
  </div>
  <!-- Modal Chỉnh sửa -->
<div id="editModal" class="modal hidden">
  <div class="modal-content">
    <h3>Chỉnh sửa dòng xe</h3>
    <form action="" method="POST" id="editForm">
      @csrf
      <input type="hidden" id="editId">

      <div class="form-group">
        <label>Tên dòng xe</label>
        <input type="text" name="name" id="editName" required>
      </div>

      <div class="form-group">
        <label>Mô tả</label>
        <textarea name="description" id="editDescription"></textarea>
      </div>

      <div class="form-actions">
        <button type="button" class="btn-cancel">Hủy</button>
        <button type="submit" class="btn-save">Lưu</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Xác nhận Xóa -->
<div id="deleteModal" class="modal hidden">
  <div class="modal-content">
    <h3>Bạn có chắc muốn xóa?</h3>
    <p>Dòng xe này sẽ bị xóa vĩnh viễn.</p>

    <div class="form-actions">
      <form action="" method="POST">
        @csrf
        @method('DELETE')
      <button id="confirmDelete" class="btn-save">Xóa</button>
      <button id="cancelDelete" class="btn-cancel">Hủy</button>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {

  /* ==== 1) MODAL THÊM ==== */
  const addModal = document.getElementById("vehicleTypeModal");
  const addBtn = document.getElementById("addVehicleTypeBtn");
  const addForm = document.getElementById("vehicleTypeForm");

  addBtn.onclick = () => {
    addForm.reset();
    addModal.classList.add("show");
  };

  addModal.querySelector(".btn-cancel").onclick = () => {
    addModal.classList.remove("show");
  };


  /* ==== 2) MODAL EDIT ==== */
  const editModal = document.getElementById("editModal");
  const editForm = document.getElementById("editForm");

  document.querySelectorAll(".edit-btn").forEach(btn => {
    btn.onclick = () => {
      const row = btn.closest("tr");

      // Lấy ID
      let id = btn.dataset.id;

      // Gán dữ liệu vào input
      document.getElementById("editId").value = id;
      document.getElementById("editName").value = row.children[1].textContent;
      document.getElementById("editDescription").value =
        row.children[2].textContent === "Chưa có mô tả"
          ? ""
          : row.children[2].textContent;

      // Gán action đúng ID
      editForm.action = "/admin/vendor/update/" + id;

      editModal.classList.add("show");
    };
  });

  editModal.querySelector(".btn-cancel").onclick = () => {
    editModal.classList.remove("show");
  };


  /* ==== 3) MODAL DELETE ==== */
  const deleteModal = document.getElementById("deleteModal");
  const confirmDeleteBtn = document.getElementById("confirmDelete");
  const cancelDeleteBtn = document.getElementById("cancelDelete");

  document.querySelectorAll(".delete-btn").forEach(btn => {
    btn.onclick = () => {
      let id = btn.dataset.id;

      // Gán action vào form xóa
      const deleteForm = deleteModal.querySelector("form");
      deleteForm.action = "/admin/vendor/delete/" + id;

      deleteModal.classList.add("show");
    };
  });

  cancelDeleteBtn.onclick = () => {
    deleteModal.classList.remove("show");
  };

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
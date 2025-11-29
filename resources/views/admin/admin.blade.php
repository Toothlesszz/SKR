<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng nhập Quản trị - GreenBike</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}" />

  <!-- Firebase -->
  <!-- <script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
    import { getAuth, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-auth.js";

    const firebaseConfig = {
      apiKey: "AIzaSyA_hQQQXDWZU7wh0AyK9ZqiMXWSqkZgeZM",
      authDomain: "greenbike-web.firebaseapp.com",
      projectId: "greenbike-web",
      storageBucket: "greenbike-web.firebasestorage.app",
      messagingSenderId: "338757518645",
      appId: "1:338757518645:web:06180450a02ade7829f87c",
      measurementId: "G-YXW03WHDY7"
    };

    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);

    document.addEventListener("DOMContentLoaded", () => {
      const form = document.getElementById("loginForm");
      form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const email = document.getElementById("username").value.trim();
        const password = document.getElementById("password").value.trim();

        if (!email || !password) {
          alert("Vui lòng nhập đầy đủ thông tin!");
          return;
        }

        try {
          const userCredential = await signInWithEmailAndPassword(auth, email, password);
          alert("Đăng nhập thành công!");
          localStorage.setItem("adminUser", userCredential.user.email);
          window.location.href = "dashboard.html";
        } catch (error) {
          let msg = "Sai tên đăng nhập hoặc mật khẩu!";
          if (error.code === "auth/user-not-found") msg = "Tài khoản không tồn tại!";
          if (error.code === "auth/wrong-password") msg = "Mật khẩu không đúng!";
          if (error.code === "auth/invalid-email") msg = "Email không hợp lệ!";
          if (error.code === "auth/too-many-requests") msg = "Quá nhiều lần thử. Vui lòng thử lại sau!";
          alert(msg);
        }
      });
    });
  </script> -->
</head>
<body>

  <div class="login-container">
    <div class="login-box">
      <div class="login-icon">
        <i class="fa-solid fa-shield-halved"></i>
      </div>

      <h2>Đăng nhập Quản trị</h2>
      <p>Nhập thông tin đăng nhập của bạn</p>

      <form id="loginForm" action="login" method="POST">
        @csrf
        <label for="username">Tên đăng nhập</label>
        <div class="input-group">
          <i class="fa-solid fa-user"></i>
          <input type="text" id="username" placeholder="admin" name="username" autocomplete="username" required />
        </div>

        <label for="password">Mật khẩu</label>
        <div class="input-group">
          <i class="fa-solid fa-lock"></i>
          <input type="password" id="password" placeholder="••••••" name="password" autocomplete="current-password" required />
        </div>

        <button type="submit">Tiếp tục</button>
      </form>

    </div>
  </div>

</body>
</html>
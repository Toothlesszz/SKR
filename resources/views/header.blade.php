<header class="header">
  <div class="container header-inner">
    <!-- Logo -->
    <div class="logo-wrap">
      <div class="logo-img"> <img src="{{ asset('images/header_logo_removebg.png') }}" alt="Logo"></div>
      <span class="logo-text">XE ĐIỆN SAKURA</span>
    </div>

    <!-- Nav -->
    <nav class="nav">
      <a href="{{url('/')}}">Trang Chủ</a>
      <a href="{{url('/about-us')}}">Về Chúng Tôi</a>
      <a href="{{url('/products')}}">Sản Phẩm</a>
      <a href="{{url('/news')}}">Tin Tức</a>
    </nav>

    <!-- Actions -->
    <div class="header-actions">
      <a href="{{$information->facebook}}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i></a>
      <a href="{{$information->instagram}}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-instagram"></i></a>
      <a href="{{$information->phone1}}"><i class="fa-solid fa-phone"></i></a>
      <a href="{{ url('admin/login') }}"><i class="fa-solid fa-lock"></i></a>
    </div>

    <!-- Mobile toggle -->
    <div class="menu-toggle"><i class="fa-solid fa-bars"></i></div>
  </div>
</header>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>
  * {box-sizing:border-box;}
  body {margin:0;font-family:'Poppins',sans-serif;}

  .header {
    background:#fff;
    box-shadow:0 2px 6px rgba(0,0,0,0.05);
    position:sticky;top:0;z-index:1000;
  }
  a{text-decoration:none;}
  .header-inner {
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:12px 40px;
    max-width:1200px;
    margin:auto;
  }

  /* LOGO */
  .logo-wrap {
    display:flex;
    align-items:center;
    gap:10px;
    white-space:nowrap;
  }
  .logo-text {
    color:#222;font-weight:600;font-size:16px;
  }
  .logo-img {

    width:80px;
    height:80px;
    display:flex;align-items:center;justify-content:center;
  }
.logo-img img {
    width: 100%;
    height: 100%;
    object-fit: contain; 
}

  /* NAV */
  .nav {
    display:flex;
    gap:24px;
    align-items:center;
  }
  .nav a {
    text-decoration:none;
    color:#333;
    font-weight:500;
    transition:.2s;
  }
  .nav a:hover,
  .nav a.active {
    color:#008a3e;
  }

  /* ACTION ICONS */
  .header-actions {
    display:flex;
    gap:12px;
  }
  .header-actions a {
    background:#008a3e;
    color:#fff;
    width:34px;height:34px;
    border-radius:50%;
    display:flex;align-items:center;justify-content:center;
    transition:.3s;
  }
  .header-actions a:hover {background:#00b451;}

  /* MOBILE */
  .menu-toggle {
    display:none;
    font-size:20px;
    color:#333;
    cursor:pointer;
  }
  @media(max-width:900px){
    .nav {
      display:none;
      position:absolute;
      top:60px;
      left:0;right:0;
      flex-direction:column;
      background:#fff;
      padding:20px 0;
      box-shadow:0 6px 12px rgba(0,0,0,0.1);
    }
    .nav.open {display:flex;}
    .menu-toggle {display:block;}
  }
</style>


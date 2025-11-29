<footer class="site-footer">
  <div class="container footer-grid">
    <div class="footer-col">
      <div class="footer-logo">
        <div class="logo-box"><img src="{{ asset('images/footer_logo_removebg.png') }}" alt="Logo"></div>     
      </div>
      <p>XE ĐIỆN SAKURA</p>
      <p>Công ty TNHH Thương Mại Quốc tế YATE</p>
    </div>

    <div class="footer-col">
      <h4>Liên Kết</h4>
      <ul>
        <li><a href="{{url('/about-us')}}">Về Chúng Tôi</a></li>
        <li><a href="{{url('/products')}}">Sản Phẩm & Dịch Vụ</a></li>
        <li><a href="{{url('/news')}}">Tin Tức</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Liên Hệ</h4>
      <ul>
        <li>Fanpage: <a href="{{$information->facebook}}">Xe điện Sakura</a></li>
        <li>Hợp tác: {{$information->zalo}}</li>
        <li>Địa chỉ: {{$information->address1}}</li>
      </ul>
 
    </div>
  </div>

  <div class="footer-bottom">
    <p>© 2025 Công ty TNHH Thương Mại Quốc tế YATE. Bảo lưu mọi quyền.</p>
  </div>
</footer>
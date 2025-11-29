<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Về Chúng Tôi - Xe Điện Sakura</title>
  <link rel="stylesheet" href="css/style.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
  <style>
.center-wrapper {
    max-width: 1100px;       /* độ rộng tối đa */
    margin: 0 auto;          /* CĂN GIỮA */
    padding: 20px;
}

.about-block {
    display: flex;
    align-items: center;
    justify-content: center;   /* căn giữa 2 thành phần */
    gap: 40px;
    padding: 20px 0;
}

.about-image img {
    width: 100%;
    max-width: 500px;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.about-content {
    max-width: 500px;
}

.about-content h3 {
    color: #0a7a3b;
    margin-bottom: 15px;
    font-size: 22px;
    font-weight: 700;
}

.about-content p {
    line-height: 1.6;
    color: #444;
}

/* Mobile */
@media (max-width: 768px) {
    .about-block {
        flex-direction: column;
        text-align: left;
    }
}
  </style>
</head>
@include('header')
<body>
  <div id="header-placeholder"></div>

  <main class="container about-section">
    <h1 id="about-title">Về Chúng Tôi</h1>
    <div id="about-sub" class="about-sub">Xe Điện Sakura - Sản Xuất & Phân Phối Xe Đạp Điện</div>
    <div id="about-container"></div>
  </main>
<div class="center-wrapper">
    <div class="about-block">
        <div class="about-image">
            <img src="{{asset('images/about_1.jpg')}}" alt="Ảnh mô tả">
        </div>

        <div class="about-content">
            <h3>Giới Thiệu Công Ty</h3>
            <p>
                Xe điện Sakura đã khẳng định vị thế là một trong những nhà sản xuất và phân phối xe đạp điện tại Việt Nam với hơn 15 năm kinh nghiệm trong ngành. Với đội ngũ hơn kỹ sư, công nhân lành nghề, chúng tôi tự hào đã sản xuất và phân phối hơn 5000+ xe đạp điện đến hàng ngàn gia đình Việt Nam, mang lại giải pháp di chuyển xanh, tiết kiệm và thân thiện với môi trường.
            </p>
        </div>
    </div>
</div>
<div class="center-wrapper">
    <div class="about-block">
        <div class="about-content">
            <h3>Sứ Mệnh & Tầm Nhìn</h3>
            <p>
                Sứ Mệnh Chúng tôi cam kết mang đến những sản phẩm xe đạp điện chất lượng cao, an toàn và thân thiện với môi trường, góp phần giảm thiểu ô nhiễm không khí và xây dựng một tương lai xanh - sạch - bền vững cho cộng đồng. Tầm Nhìn Chúng tôi không đặt mục tiêu trở thành lớn nhất, mà muốn trở thành một thương hiệu đáng tin cậy. Bằng sự nỗ lực mỗi ngày, chúng tôi hướng đến việc mang lại trải nghiệm xe điện an toàn, bền bỉ và phù hợp với mọi nhu cầu di chuyển. Giá Trị Cốt Lõi Chất lượng - Minh bạch - Khách hàng - Đổi mới. Đây là những giá trị mà chúng tôi luôn đề cao và thực hiện trong mọi hoạt động, từ sản xuất, phân phối đến dịch vụ chăm sóc khách hàng.
            </p>
        </div>
        <div class="about-image">
            <img src="{{asset('images/about_2.jpg')}}" alt="Ảnh mô tả">
        </div>
    </div>
</div>
<div class="center-wrapper">
    <div class="about-block">
        <div class="about-image">
            <img src="{{asset('images/about_3.jpg')}}" alt="Ảnh mô tả">
        </div>

        <div class="about-content">
            <h3>Quy Trình Sản Xuất & Kiểm Định</h3>
            <p>
                Mỗi chiếc xe đạp điện Sakura đều trải qua quy trình sản xuất nghiêm ngặt với 5 công đoạn chính: thiết kế, lắp ráp khung xe, lắp đặt hệ thống điện, kiểm tra chất lượng và thử nghiệm thực tế. Chúng tôi áp dụng hệ thống kiểm soát chất lượng theo tiêu chuẩn ISO 9001:2015, mỗi xe đều được kiểm tra 100% các thông số kỹ thuật, an toàn điện và độ bền trước khi đến tay khách hàng. Sau bán hàng, Sakura cung cấp chế độ bảo hành toàn diện trên các trung tâm bảo hành trên toàn quốc, đảm bảo khách hàng luôn được hỗ trợ nhanh chóng và chuyên nghiệp
            </p>
        </div>
    </div>
</div>
  <section class="stats-band">
    <div class="container stats-grid">
      <div class="stat"><div class="num">10+</div><div class="label">Năm Kinh Nghiệm</div></div>
      <div class="stat"><div class="num">5000+</div><div class="label">Xe Đã Bán</div></div>
      <div class="stat"><div class="num">10+</div><div class="label">Đối Tác Chiến Lược</div></div>
      <div class="stat"><div class="num">95%</div><div class="label">Khách Hàng Hài Lòng</div></div>
    </div>
  </section>

  <section class="cta">
    <h3>Hợp Tác Cùng Chúng Tôi</h3>
    <p>Hãy để Sakura đồng hành cùng bạn trong việc phát triển những sản phẩm xanh, an toàn và bền vững. Chúng tôi luôn sẵn sàng hợp tác để cùng mang lại giá trị tốt nhất.</p>
    <a href="{{ $information->facebook}}"><button class="btn primary">Liên Hệ Ngay</button></a>
  </section>
@include('footer')
  <div id="footer-placeholder"></div>


  
</body>
</html>
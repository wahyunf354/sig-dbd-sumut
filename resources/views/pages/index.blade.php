@extends('layouts.index')
@section('title', 'Beranda | DBD Sumut')
@section('description', 'Website ini sebagai media informasi kepada masyarakat tentang penyakit DBD dan kondisi Penyebaran Penyakit DBD di Sumatera Utara')
@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

  <div class="container">
    <div class="row">
      <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
        <h1>DBD Sumatera Utara</h1>
        <h2>Website ini sebagai media informasi kepada masyarakat tentang penyakit DBD dan kondisi Penyebaran Penyakit DBD di Sumatera Utara</h2>
        <div class="d-flex justify-content-center justify-content-lg-start">
          <a href="{{route("peta_sebaran")}}" class="btn-get-started scrollto">Peta Sebaran</a>
        </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
        <img src="assets/img/nyamuk.webp" class="img-fluid animated" alt="Nyamuk DBD">
      </div>
    </div>
  </div>

</section><!-- End Hero -->

<main id="main">


  <!-- ======= About Us Section ======= -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>About DBD</h2>
      </div>

      <div class="row content">
        <div class="col-lg-6">
          <p>
              Penyakit Demam Berdarah Dengue (DBD) adalah kondisi yang disebabkan oleh virus dan memiliki beberapa gejala klinis yang dapat dikenali, termasuk demam tinggi yang tiba-tiba dan terus-menerus selama 2-7 hari, serta tanda-tanda perdarahan seperti munculnya bintik-bintik merah di kulit (petekie dan purpura), perdarahan di mata (perdarahan konjungtiva), hidung (episkasis), dan juga munculnya memar dan darah dalam tinja atau urine. Selain itu, uji Tourniqet yang positif juga dapat menjadi indikator dari adanya DBD. Informasi ini penting untuk diketahui agar masyarakat dapat mengenali gejala DBD dengan lebih baik dan dapat mengambil langkah-langkah pencegahan yang tepat.
          </p>

        </div>
        <div class="col-lg-6 pt-4 pt-lg-0">
          <p>
            Berikut adalah indikator yang digunakan pada kasus DBD
          </p>
            <ul>
                <li><i class="ri-check-double-line"></i> Incidence Rate DBD</li>
                <li><i class="ri-check-double-line"></i> Case Fatality Rate (CFR) DBD</li>
                <li><i class="ri-check-double-line"></i> Angka bebas jentik</li>
            </ul>
          <a href="https://id.wikipedia.org/wiki/Demam_berdarah_dengue" target="_blank" class="btn-learn-more">Pelajari</a>
        </div>
      </div>

    </div>
  </section><!-- End About Us Section -->

  <!-- ======= Why Us Section ======= -->
  <section id="why-us" class="why-us section-bg">
    <div class="container-fluid" data-aos="fade-up">

      <div class="row">

        <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">

          <div class="content">
            <h3>Indikator <strong>Penyakit DBD</strong></h3>

          </div>

          <div class="accordion-list">
            <ul>
              <li>
                <a data-bs-toggle="collapse" class="collapse" data-bs-target="#accordion-list-1"><span>01</span> Incidence Rate DBD? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                  <p>
                      Incident Rate  DBD adalah jumlah kasus baru DBD yang terjadi dalam suatu populasi selama periode waktu tertentu, yang biasanya dihitung dalam satuan kasus per 100.000 orang
                  </p>
                </div>
              </li>

              <li>
                <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>02</span> Case Fatality Rate (CFR) DBD? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                  <p>
                      CFR adalah adalah rasio antara jumlah kematian akibat suatu penyakit dengan jumlah kasus penyakit yang terdiagnosis dalam suatu periode waktu tertentu, dan merupakan salah satu indikator tingkat keparahan suatu penyakit
                  </p>
                </div>
              </li>

              <li>
                <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>03</span> Angka bebas jentik? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                  <p>
                      Angka bebas jentik adalah persentase rumah atau bangunan di suatu daerah yang tidak memiliki jentik nyamuk Aedes aegypti dalam periode tertentu.
                  </p>
                </div>
              </li>

            </ul>
          </div>

        </div>

        <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("assets/img/why-us.png");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
      </div>

    </div>
  </section><!-- End Why Us Section -->


  <!-- ======= Frequently Asked Questions Section ======= -->
  <section id="faq" class="faq section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Frequently Asked Questions</h2>
        <p>Dalam pengambangan</p>
      </div>

      <div class="faq-list">
        <ul>
          <li data-aos="fade-up" data-aos-delay="100">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
              <p>
                Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="200">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Feugiat scelerisque varius morbi enim nunc? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
              <p>
                Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="300">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
              <p>
                Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="400">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
              <p>
                Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="500">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
              <p>
                Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
              </p>
            </div>
          </li>

        </ul>
      </div>

    </div>
  </section><!-- End Frequently Asked Questions Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Contact</h2>
        <p>Dalam Pengembangan</p>
      </div>

      <div class="row">

        <div class="col-lg-5 d-flex align-items-stretch">
          <div class="info">
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>Location:</h4>
              <p>Jl. Prof. H. M. Yamin No.41AA, Perintis, Kec. Medan Tim., Kota Medan, Sumatera Utara 20232</p>
            </div>

            <div class="email d-none">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p>info@example.com</p>
            </div>

            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>Call:</h4>
              <p>(061) 4524550</p>
            </div>

              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.9602586219644!2d98.68396925056655!3d3.596583051228614!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x303131bc34cdac49%3A0x9b4a361f45905f20!2sDinas%20Kesehatan%20Provinsi%20Sumatera%20Utara!5e0!3m2!1sid!2sid!4v1679525875156!5m2!1sid!2sid" frameborder="0" style="border:0; width: 100%; height: 290px;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>

        </div>

        <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="name">Your Name</label>
                <input type="text" name="name" class="form-control" id="name" required>
              </div>
              <div class="form-group col-md-6">
                <label for="name">Your Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
              </div>
            </div>
            <div class="form-group">
              <label for="name">Subject</label>
              <input type="text" class="form-control" name="subject" id="subject" required>
            </div>
            <div class="form-group">
              <label for="name">Message</label>
              <textarea class="form-control" name="message" rows="10" required></textarea>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

</main><!-- End #main -->

@endsection

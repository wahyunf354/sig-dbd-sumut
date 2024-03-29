@extends('layouts.index')
@section("title", "Peta Sebaran DBD | Dinas Kesehatan Sumatera Utara")

@section('content')

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 d-flex flex-column align-items-center justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
        <h1>Peta Sebaran DBD</h1>
        <h2 class="text-center">Sumatera Utara</h2>
      </div>
    </div>
  </div>

</section><!-- End Hero -->

<!-- ======= Data DBD Section ======= -->
<section id="data_dbd" class="data_dbd section-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Data Kasus DBD</h2>
      <p>{{$year}}</p>
    </div>

    <div class="row justify-content-center">
      <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
        <div class="icon-box">
          <div class="icon"><i class="bx bx-tired"></i></div>
          <h4>{{number_format($dataCards->IR, 2, ',', '.')}}</h4>
          <p><strong>Incident Rate DBD</strong>, jumlah kasus baru DBD per populasi, dikalikan dengan faktor, untuk
            mengetahui tingkat insiden DBD.</p>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
        <div class="icon-box">
          <div class="icon"><i class="bx bx-file"></i></div>
          <h4>{{number_format($dataCards->CFR, 2, ',', '.')}}%</h4>
          <p><strong>Case Fatality Rate (CFR)</strong> atau atau tingkat kematian kasus, persentase kasus yang
            berakhir dengan kematian dalam suatu populasi, dihitung dengan membagi jumlah kematian dengan jumlah
            kasus.</p>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
        <div class="icon-box">
          <div class="icon"><i class="bx bx-tachometer"></i></div>
          <h4>{{number_format($dataCards->ABJ, 2, ',', '.')}}%</h4>


          <p><strong>Angka Bebas Jentik (ABJ)</strong>, jumlah jentik nyamuk Aedes per liter air pada waktu tertentu,
            digunakan sebagai indikator kepadatan nyamuk dan risiko penyebaran penyakit.</p>
        </div>
      </div>


    </div>

  </div>
</section><!-- End Data DBD Section -->

<!-- ======= PetaSebaran Section ======= -->
<section id="portfolio" class="portfolio">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Peta Sebaran Transmisi Lokal dan Wilayah Terkonfirmasi</h2>
      <p></p>
    </div>

    {{-- <ul id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100"> --}}
    {{-- <li data-filter="*" class="d-none">All</li> --}}
    {{-- <li data-filter=".filter-app" class="filter-active">Incident Rate</li> --}}
    {{-- <li data-filter=".filter-card">CFR</li>--}}
    {{-- <li data-filter=".filter-web">Angka Bebas Jentik</li>--}}
    {{-- </ul> --}}

    <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

      <div class="col-lg-12 col-md-12 portfolio-item filter-app">
        @include('component.map_pam')

      </div>

    </div>

  </div>
</section><!-- End PetaSebaran Section -->

@endsection

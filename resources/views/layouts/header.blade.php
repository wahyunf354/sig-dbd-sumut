<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
  <div class="container d-flex align-items-center">

    <h1 class="logo me-auto"><a href="index.html">DBD Sumut</a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto {{ Request::is('/') ? 'active' : '' }}" href="{{route('beranda')}}">Beranda</a></li>
{{--        <li><a class="nav-link scrollto" href="#berita">Berita</a></li>--}}
        <li><a class="nav-link scrollto {{ Request::is('/peta_sebaran') ? '`active' : '' }}" href="{{route('peta_sebaran')}}">Sebaran</a></li>
        <li><a class="nav-link scrollto d-none" href="#contact_rs">Edukasi</a></li>
        <li><a class="nav-link scrollto" href="{{route('beranda')}}#faq">Tanya Jawab</a></li>
        <li><a class="nav-link scrollto" href="#contact">Pengaduan</a></li>
        <li><a class="nav-link scrollto d-none" href="#contact_rs">Kontak Rumah Sakit</a></li>
        <li><a class="nav-link scrollto" href="#about_as">Tetang Kami</a></li>  
{{--        <li><a class="nav-link scrollto" href="#team">Team</a></li>--}}
{{--        <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>--}}
{{--          <ul>--}}
{{--            <li><a href="#">Drop Down 1</a></li>--}}
{{--            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>--}}
{{--              <ul>--}}
{{--                <li><a href="#">Deep Drop Down 1</a></li>--}}
{{--                <li><a href="#">Deep Drop Down 2</a></li>--}}
{{--                <li><a href="#">Deep Drop Down 3</a></li>--}}
{{--                <li><a href="#">Deep Drop Down 4</a></li>--}}
{{--                <li><a href="#">Deep Drop Down 5</a></li>--}}
{{--              </ul>--}}
{{--            </li>--}}
{{--            <li><a href="#">Drop Down 2</a></li>--}}
{{--            <li><a href="#">Drop Down 3</a></li>--}}
{{--            <li><a href="#">Drop Down 4</a></li>--}}
{{--          </ul>--}}
{{--        </li>--}}
{{--        <li><a class="getstarted scrollto" href="#about">Get Started</a></li>--}}
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->

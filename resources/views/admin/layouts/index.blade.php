@include('admin.layouts.head')


<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    {{-- <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('assets')}}/img/logo/logo_sumut.png" alt="Sumut" height="60" width="60">
  </div> --}}
  @include('admin.layouts.header')
  @include('admin.layouts.sidebar')

  <div class="content-wrapper">
    @yield('content')
  </div>

  @include('admin.layouts.footer')
  </div>
  <!-- ./wrapper -->

  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
  @include('admin.layouts.js')
  @yield('script')
</body>
</html>

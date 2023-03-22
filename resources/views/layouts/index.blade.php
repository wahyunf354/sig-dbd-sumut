<!DOCTYPE html>
<html lang="en">
@include('layouts.head')

<body>

  @include('layouts.header')

  @yield('content')

  @include('layouts.footer')

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @include('layouts.js')
</body>

</html>

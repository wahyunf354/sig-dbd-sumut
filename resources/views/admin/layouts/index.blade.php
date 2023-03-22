<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.2
* @link https://coreui.io
* Copyright (c) 2022 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<!-- Breadcrumb-->
<html lang="en">
@include('admin.layouts.head')
<body>
  @include('admin.layouts.sidebar')
  <div class="wrapper d-flex flex-column min-vh-100 bg-light">
    @include('admin.layouts.header')

    <div class="body flex-grow-1 px-3">
      @yield('content')
    </div>

    @include('admin.layouts.footer')
  </div>
  @include('admin.layouts.js')
  @yield('script')
</body>
</html>

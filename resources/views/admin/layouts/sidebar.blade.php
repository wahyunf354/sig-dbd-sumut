  <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
      <img class="sidebar-brand-full" src="{{asset('admin')}}/assets/brand/logo_long.png" height="46" alt="Dinkes Logo">
      <img class="sidebar-brand-narrow" src="{{asset('admin')}}/assets/brand/logo_long.png" height="46" alt="Dinkes Logo">
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
      <li class="nav-item"><a class="nav-link" href="index.html">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
          </svg> Dashboard</a></li>
      <li class="nav-item"><a class="nav-link" href="{{route('admin.uploadLaporanDBD')}}">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-input"></use>
          </svg> Input Laporan DBD</a></li>
      <li class="nav-title">DBD</li>
      <li class="nav-item"><a class="nav-link" href="colors.html">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-drop"></use>
          </svg> Incident Rate<span class="badge badge-sm bg-info ms-auto">NEW</span></a></li>
      <li class="nav-item"><a class="nav-link" href="typography.html">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-x"></use>
          </svg> Angka Kematian</a></li>
      <li class="nav-item"><a class="nav-link" href="typography.html">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bug"></use>
          </svg> Angka Bebas Jentik</a></li>
      <li class="nav-title">Administrasi</li>
      <li class="nav-group d-none"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cursor"></use>
          </svg> Buttons</a>
        <ul class="nav-group-items">
          <li class="nav-item"><a class="nav-link" href="buttons/buttons.html"><span class="nav-icon"></span> Buttons</a></li>
          <li class="nav-item"><a class="nav-link" href="buttons/button-group.html"><span class="nav-icon"></span> Buttons Group</a></li>
          <li class="nav-item"><a class="nav-link" href="buttons/dropdowns.html"><span class="nav-icon"></span> Dropdowns</a></li>
        </ul>
      </li>
      <li class="nav-item"><a class="nav-link" href="charts.html">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
          </svg> Users</a></li>
      <li class="nav-group d-none"><a class="nav-link nav-group-toggle" href="#">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
          </svg> Notifications</a>
        <ul class="nav-group-items">
          <li class="nav-item"><a class="nav-link" href="notifications/alerts.html"><span class="nav-icon"></span> Alerts</a></li>
          <li class="nav-item"><a class="nav-link" href="notifications/badge.html"><span class="nav-icon"></span> Badge</a></li>
          <li class="nav-item"><a class="nav-link" href="notifications/modals.html"><span class="nav-icon"></span> Modals</a></li>
          <li class="nav-item"><a class="nav-link" href="notifications/toasts.html"><span class="nav-icon"></span> Toasts</a></li>
        </ul>
      </li>
      <li class="nav-item"><a class="nav-link" href="widgets.html">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bank"></use>
          </svg> Dinas Kabupaten Kota</a></li>
      <li class="nav-item"><a class="nav-link" href="widgets.html">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-medical-cross"></use>
          </svg> Puskesmas</a></li>
      <li class="nav-divider"></li>
      <li class="nav-title">Extras</li>
      <li class="nav-group"><a class="nav-link " href="#">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-hospital"></use>
          </svg> Kontak Rumah Sakit</a>
      </li>
      <li class="nav-group"><a class="nav-link " href="#">
          <svg class="nav-icon">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-file"></use>
          </svg> Dokumentasi</a>
      </li>
    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
  </div>

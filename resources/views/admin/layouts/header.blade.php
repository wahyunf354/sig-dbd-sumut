<header class="header header-sticky mb-4">
  <div class="container-fluid">
    <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
      <svg class="icon icon-lg">
        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
      </svg>
    </button><a class="header-brand d-md-none" href="#">
      <svg width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="assets/brand/coreui.svg#full"></use>
      </svg></a>
    <ul class="header-nav ms-auto">
      <li class="nav-item"><a class="nav-link" href="#">
          <svg class="icon icon-lg">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-bell"></use>
          </svg></a></li>
      <li class="nav-item"><a class="nav-link" href="#">
          <svg class="icon icon-lg">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-envelope-open"></use>
          </svg></a></li>
    </ul>
    <ul class="header-nav ">
      <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <svg class="icon icon-lg">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
          </svg>
        </a>
        <div class="dropdown-menu dropdown-menu-end pt-0">
          <div class="dropdown-header bg-light py-2">
            <div class="fw-semibold">Settings</div>
          </div>
          <a class="dropdown-item" href="#">
            <svg class="icon me-2">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
            </svg> 
            Profile
          </a>
          <a class="dropdown-item" href="#">
            <svg class="icon me-2">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
            </svg> 
            Settings
          </a>
          <div class="dropdown-divider"></div><a class="dropdown-item" href="#">
            <a class="dropdown-item" href="{{route('admin.logout')}}">
              <svg class="icon me-2">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-account-logout"></use>
              </svg> 
              Logout
            </a>
        </div>
      </li>
    </ul>
  </div>
  <div class="header-divider"></div>
  <div class="container-fluid">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb my-0 ms-2">
        <li class="breadcrumb-item">
          <!-- if breadcrumb is single--><span>Home</span>
        </li>
        <li class="breadcrumb-item active"><span>Dashboard</span></li>
      </ol>
    </nav>
  </div>
</header>

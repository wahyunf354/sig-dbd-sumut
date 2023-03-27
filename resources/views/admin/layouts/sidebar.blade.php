<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-navy elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{asset('assets')}}/img/logo/logo_sumut.png" alt="AdminLTE Logo"
         class="brand-image">
    <span class="brand-text font-weight-light">SIG DBD SUMUT</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('assets')}}/img/logo/blank_profil.png" class="img-circle img-fluid elevation-2"
             alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{\Illuminate\Support\Facades\Auth::user()->name}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{route('admin.dashboard')}}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.laporandbd.index')}}" class="nav-link">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Laporan DBD
            </p>
            <span class="right badge badge-danger">New</span>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{route('admin.uploadLaporanDBD')}}" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Upload Laporan DBD
            </p>
          </a>
        </li>
        <li class="nav-header text-uppercase">Ringkasan Deman Dengue</li>
        <li class="nav-item">
          <a href="{{route('admin.dbd.peta.sebaran')}}" class="nav-link">
            <i class="nav-icon far fa-map"></i>
            <p>
              Peta Sebaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/calendar.html" class="nav-link">
            <i class="nav-icon fas fa-percentage"></i>
            <p>
              Incident Rate
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/gallery.html" class="nav-link">
            <i class="nav-icon fas fa-skull-crossbones"></i>
            <p>
              CFR
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="pages/kanban.html" class="nav-link">
            <i class="nav-icon fas fa-bug"></i>
            <p>
              Angka Bebas Jentik
            </p>
          </a>
        </li>
        <li class="nav-header text-uppercase">Administrasi</li>
        <li class="nav-item">
          <a href="iframe.html" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>Akun</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="https://adminlte.io/docs/3.1/" class="nav-link">
            <i class="nav-icon fas fa-medkit  "></i>
            <p>Dinas Kabupaten Kota</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="https://adminlte.io/docs/3.1/" class="nav-link">
            <i class="nav-icon fas fa-stethoscope  "></i>
            <p>Puskesmas</p>
          </a>
        </li>
        <li class="nav-header text-uppercase">PELAYANAN MASYARAKAT</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-hospital nav-icon"></i>
            <p>Kotak Rumah Sakit</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-envelope-open-text nav-icon"></i>
            <p>Pengaduan</p>
          </a>
        </li>
        <li class="nav-header">INFORMASI</li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-address-card"></i>
            <p>About</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-book"></i>
            <p class="text">Dokumentasi</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-robot"></i>
            <p>Author</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

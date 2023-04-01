@extends('admin.layouts.index')

@section('title', 'Kabupaten Kota Sumatera Utara | SIG DBD SUMUT')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Profile Pengembang</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Profile Pengembang</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">

        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="{{asset('assets')}}/img/profile.png" alt="User profile picture">
            </div>
            <h3 class="profile-username text-center">Wahyu Nur Fadillah</h3>
            <p class="text-muted text-center">Mahasiswa Universitas Negeri Medan</p>
            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
          </div>
        </div>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">About Me</h3>
          </div>

          <div class="card-body">
            <strong><i class="fas fa-book mr-1"></i> Education</strong>
            <p class="text-muted">
              Ilmu Komputer di Universitas Negeri Medan
            </p>
            <hr>
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
            <p class="text-muted">Medan, Indonesia</p>
            <hr>
            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
            <p class="text-muted">
              <span class="tag tag-success">Coding</span>
              <span class="tag tag-info">Javascript</span>
              <span class="tag tag-warning">PHP</span>
              <span class="tag tag-primary">Node.js</span>
            </p>
            <hr>
            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
            <p class="text-muted">Jika ada pertanyaan, contact saya di wahyunurfadillah@gmail.com</p>
          </div>

        </div>
      </div>
    </div>
  </section>
@endsection

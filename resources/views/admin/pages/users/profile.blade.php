@extends('admin.layouts.index')
@section('title', 'Laporan DBD Sumatera Utara | SIG DBD SUMUT')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Profile</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Akun User</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4">
        @if(session('error'))
        <div class="alert alert-danger" role="alert">
          {{session('error')}}
        </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success" role="alert">
          {{session('success')}}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <div class="card card-primary card-outline">
          <div class="card-body box-profile">
            <h3 class="profile-username text-center">{{$profileUser->name}}</h3>
            <p class="text-muted text-center">{{$profileUser->kabkota?->nama}}</p>
            <ul class="list-group list-group-unbordered mb-3">
              <li class="list-group-item">
                <b>Username</b> <a class="float-right">{{$profileUser->username}}</a>
              </li>
              <li class="list-group-item">
                <b>Email</b> <a class="float-right">{{$profileUser->email}}</a>
              </li>
            </ul>
            <a href="#" class="btn btn-primary btn-block btn-sm"><b>Edit Data</b></a>
            <button type="button" class="btn btn-primary btn-block btn-sm" data-toggle="modal" data-target="#modelUbahPassword"><b>Ubah Password</b></button>
          </div>
        </div>
      </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="modelUbahPassword" tabindex="-1" role="dialog" aria-labelledby="modelUbahPasswordLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="modelUbahPasswordLabel">Ubah Password</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('user.changePassword')}}" method="POST">
        @method('put')
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="password_old">Password lama</label>
            <input type="password" class="form-control" id="password_old" name="password_old">
          </div>
          <div class="form-group">
            <label for="password">Password Baru</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="form-group">
            <label for="password_confirmation">Confirmasi Password Baru</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary">Ubah Password</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>

</script>
@endsection

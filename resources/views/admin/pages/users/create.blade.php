@extends('admin.layouts.index')
@section('title', 'Laporan DBD Sumatera Utara | SIG DBD SUMUT')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manajemen Akun User</h1>
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
        <div class="col-md-6">
        <div class="card">

          <div class="card-body">
          <!-- Di dalam view -->
          @if ($errors->any())
              <div class="alert alert-danger" role="alert">
                  <p><i class="fas fa-exclamation-triangle mr-2"></i>Perhatian</p>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <form action={{route('user.store')}} method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control" name="role" id="role">
                    <option value="">-- Pilih Role User --</option>
                    @foreach($roles as $role)
                      <option value="{{$role->id}}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" id="input-kab-kota">
                <label for="role">Kabupate/Kota</label>
                <select class="form-control" name="kabkota_id" id="kabkota_id">
                    <option value="">-- Pilih Kabupaten/Kota --</option>
                    @foreach($kabKotas as $kabKota)
                      <option value="{{$kabKota->id}}">{{ $kabKota->nama }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          </div>
        </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('script')
  <script>
    $(function () {
      $("#input-kab-kota").hide();
      $("#role").change(function() {
        if($(this).val() == '2'){
          $("#input-kab-kota").show();
        } else {
          $("#input-kab-kota").hide();
        }
      })
    });
  </script>
@endsection
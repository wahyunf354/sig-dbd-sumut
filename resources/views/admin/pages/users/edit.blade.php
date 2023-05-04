@extends('admin.layouts.index')
@section('title', 'Laporan DBD Sumatera Utara | SIG DBD SUMUT')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Laporan DBD Kabupaten Kota</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Laporan DBD</li>
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
          <form action={{route('user.update', $user->id)}} method="POST">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter name" value="{{$user['name']}}">
                <div class="invalid-feedback">
                  {{$errors->first("name")}}
                </div>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter username" value="{{$user['username']}}">
                <small>Username yang dimasukkan harus unik</small>
                <div class="invalid-feedback">
                  {{$errors->first("username")}}
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email" value="{{$user['email']}}">
                <small>Email yang dimasukkan harus unik</small>
                <div class="invalid-feedback">
                  {{$errors->first("email")}}
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                <small>Isi password jika ingin mengubah passwordnya</small>
                <div class="invalid-feedback">
                  {{$errors->first("password")}}
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" class="form-control  @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                <div class="invalid-feedback">
                  {{$errors->first("password_confirmation")}}
                </div>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">
                    <option value="">-- Pilih Role User --</option>
                    @foreach($roles as $role)
                      @if($role->id == $user['role_user_id'])
                        <option selected value="{{$role->id}}">{{ $role->name }}</option>
                      @else
                        <option value="{{$role->id}}">{{ $role->name }}</option>
                      @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">
                  {{$errors->first("role")}}
                </div>
            </div>
            <div class="form-group" id="input-kab-kota">
                <label for="role">Kabupate/Kota</label>
                <select class="form-control @error('kabkota_id') is-invalid @enderror" name="kabkota_id" id="kabkota_id">
                    <option value="">-- Pilih Kabupaten/Kota --</option>
                    @foreach($kabKotas as $kabKota)
                      @if($kabKota->id == $user['kabkota_id'])
                        <option selected value="{{$kabKota->id}}">{{ $kabKota->nama }}</option>
                      @else
                        <option value="{{$kabKota->id}}">{{ $kabKota->nama }}</option>
                      @endif
                    @endforeach
                </select>
                <div class="invalid-feedback">
                  {{$errors->first("kabkota_id")}}
                </div>
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
      if($('#role').val() == "1") {
        $("#input-kab-kota").hide();
      }
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
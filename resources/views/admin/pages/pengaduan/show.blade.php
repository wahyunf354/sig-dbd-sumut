@extends('admin.layouts.index')

@section('title', 'Detail Pengaduan | SIG DBD SUMUT')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pengaduan</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.pengaduan')}}">Pengaduan</a></li>
            <li class="breadcrumb-item active">Detail</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <div class="card mb-4 card-primary">
            <div class="card-header">
              <h3 class="card-title">Detail</h3>
            </div>
            <div class="card-body">
              <table>
                <tr>
                  <td>Nama</td>
                  <td>: {{ $pengaduan->name }}</td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>: {{ $pengaduan->email }}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;">Subject</td>
                  <td>: {{ $pengaduan->subject }}</td>
                </tr>
                <tr>
                  <td style="vertical-align: top;">Pesan</td>
                  <td>: {{ $pengaduan->message }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


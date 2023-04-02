@extends('admin.layouts.index')

@section('title', 'Kabupaten Kota Sumatera Utara | SIG DBD SUMUT')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Form Tambah Kabupaten Kota Sumatera Utara</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Kabupaten Kota Sumatera Utara</li>
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
        <div class="col-md-10">
          <div class="card">
              <form role="form" action="{{route('kabkota.store')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="card-body">
                  @if ($errors->any())
                      <div class="alert alert-danger">
                        <p>Error</p>
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif
                  <div class="form-group">
                    <label for="nama">Nama Kabupaten/Kota</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama kabupaten/kota">
                  </div>
                  <div class="form-group">
                    <label for="luas">Luas (km²)</label>
                    <input type="number" class="form-control" id="luas" name="luas" placeholder="Masukkan luas kabupaten/kota">
                  </div>
                  <div class="form-group">
                    <label for="penduduk">Jumlah Penduduk</label>
                    <input type="number" class="form-control" id="penduduk" name="jmlpddk" placeholder="Masukkan jumlah penduduk kabupaten/kota">
                  </div>
                  <div class="form-group">
                    <label for="geojson">File GeoJSON</label>
                    <input type="file" class="form-control-file" id="geojson" name="file_geojson">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@extends('admin.layouts.index')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Unggah File Laporan DBD</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-12 col-md-6">
          <div class="card">
            <div class="card-body">
              <form action="{{route('admin.post.uploadLaporanDBD')}}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <label for="kabkota_id">Kabupate atau Kota <span class="text-danger">*</span> </label>
                  <select class="form-control-sm form-control" name="kabkota_id" id="kabkota_id">
                    <option value="">-- Pilih Kabupaten Atau Kota --</option>
                    @foreach($kabKotas as $kabKota)
                      <option value="{{$kabKota->id}}">{{$kabKota->nama}}</option>
                    @endforeach
                  </select>
                </div>


                <div class="form-group">
                  <label for="tahun">Tahun <span class="text-danger">*</span> </label>
                  <select class="form-control form-control-sm" name="tahun" id="tahun">
                    @foreach($years as $year)
                      @if($year == $yearNow)
                        <option selected value="{{$year}}">{{$year}}</option>
                      @else
                        <option value="{{$year}}">{{$year}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="bulan">Bulan <span class="text-danger">*</span> </label>
                  <select class="form-control form-control-sm" name="bulan" id="bulan">
                    <option value="">-- Pilih Bulan --</option>
                    @foreach($mounts as $key => $mount)
                      <option value="{{$key+1}}">{{$mount}}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="custom-file-label">File Laporan <span class="text-danger">*</span> </label>

                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="laporan_dbd" name="laporan_dbd"
                           value="{{old("laporan_dbd")}}">
                    <label class="custom-file-label" for="laporan_dbd">Choose file</label>
                  </div>

                  <small>Form laporan harus sesuai</small>
                </div>
                <button class="btn btn-primary mb-3" type="submit">Unggah</button>
                @if($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection

@extends('admin.layouts.index')

@section('title', 'Upload Laporan DBD | SIG DBD SUMUT')

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
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin.laporandbd.index')}}">Laporan DBD</a></li>
          <li class="breadcrumb-item active">Upload Laporan DBD</li>
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
            <form action="{{route('admin.dataDBD.store')}}" method="post" enctype="multipart/form-data">
              @csrf

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
                <div class="">
                  <input type="file" class="" id="data_dbd" name="data_dbd" value="{{old("data_dbd")}}">
                </div>
                <small>Form data harus sesuai</small>
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

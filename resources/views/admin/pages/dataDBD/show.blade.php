@extends('admin.layouts.index')

@section('title', 'Upload Laporan DBD | SIG DBD SUMUT')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Data DBD</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin.dataDBD.index')}}">Data DBD</a></li>
          <li class="breadcrumb-item active">Detail Data DBD</li>
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
      <div class="col-12 col-md-8">
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered table-striped" id="table_laporan_dbd_file">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kabupaten Kota</th>
                  <th>Kasus Lk</th>
                  <th>Kasus Pr</th>
                  <th>Meninggal Lk</th>
                  <th>Meninggal Pr</th>
                  <th>Total Kasus</th>
                  <th>Total Meninggal</th>
                  <th>ABJ</th>
                </tr>
              </thead>
              <tbody>
                @if(count($dataDBD) == 0)

                <tr>
                  <td colspan="8" class="text-center">Belum ada Data DBD yang diupload</td>
                </tr>
                @else
                @foreach($dataDBD as $key => $row)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row->kabupatenOrKota->nama}}</td>
                  <td>{{$row->kasus_lk}}</td>
                  <td>{{$row->kasus_pr}}</td>
                  <td>{{$row->meninggal_lk}}</td>
                  <td>{{$row->meninggal_pr}}</td>
                  <td>{{$row->kasus_total}}</td>
                  <td>{{$row->meninggal_total}}</td>
                  <td>{{$row->abj}}</td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

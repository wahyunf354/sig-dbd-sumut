@extends('admin.layouts.index')
@section('title', 'SIG DBD SUMUT | Laporan DBD Sumatera Utara')

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
      <div class="row">
        <div class="card mb-4`">
          <div class="card-body">
            <table class="table table-bordered table-striped" id="table_laporan_dbd_file">
              <thead>
              <tr>
                <th>No</th>
                <th>Kabupaten</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>File</th>
                <th>Author</th>
                <th>Tanggal Upload</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @if(count($laporaDbds) == 0)
                <tr>
                  <td colspan="8" class="text-center">Belum ada laporan DBD yang diupload</td>
                </tr>
              @else
                @foreach($laporaDbds as $key => $row)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$row->kabupatenOrKotaSumut->nama}}</td>
                    <td>{{$row->bulan}}</td>
                    <td>{{$row->tahun}}</td>
                    <td>
                      <a href="{{asset('files')}}/laporanDBD/{{$row->laporan_file}}"
                         class="btn btn-sm btn-link">
                        <i class="fas fa-download"></i>
                      </a>
                    </td>
                    <td>{{$row->user->name}}</td>
                    <td>{{ \Carbon\Carbon::parse($row->created_at)->timezone('Asia/Jakarta')->format('d F Y, H:i')." WIB" }}
                    </td>
                    <td>
                      <button class="btn btn-danger btn-sm text-white">Hapus</button>
                      <button class="btn btn-info btn-sm text-white">Detail</button>
                    </td>
                  </tr>
                @endforeach
              @endif
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section("script")
  <script>
    $(function () {
      $("#table_laporan_dbd_file").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#table_laporan_dbd_file_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection

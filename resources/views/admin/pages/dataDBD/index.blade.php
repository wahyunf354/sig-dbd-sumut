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
          <li class="breadcrumb-item active">Data DBD</li>
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
      <div class="col-12 col-md-7">
        @if(session('success'))
        <div class="alert alert-success" role="alert">
          {{session('success')}}
        </div>
        @endif
        <div class="card">
          <div class="card-header">
            <a class="btn btn-outline-primary btn-sm" href="{{route('admin.dataDBD.create')}}">Unggah Data</a>

          </div>
          <div class="card-body">
            <table class="table table-bordered table-striped" id="table_laporan_dbd_file">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Bulan </th>
                  <th>Tahun</th>
                  <th>File</th>
                  <th>Tanggal Mengunggah</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @if(count($dataDbdFiles) == 0)

                <tr>
                  <td colspan="8" class="text-center">Belum ada Data DBD yang diupload</td>
                </tr>
                @else
                @foreach($dataDbdFiles as $key => $row)

                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$row->bulan}}</td>
                  <td>{{$row->tahun}}</td>
                  <td>
                    <a href="{{asset('files')}}/dataDBD/{{$row->file_url}}" class="btn btn-sm btn-link">
                      <i class="fas fa-download"></i>
                    </a>
                  </td>
                  <td>{{ \Carbon\Carbon::parse($row->created_at)->timezone('Asia/Jakarta')->format('d F Y, H:i')." WIB" }}
                  </td>
                  <td>
                    <form class="d-inline" action="{{route('admin.dataDBD.destroy', $row->id)}}" method="post">
                      @method('delete')
                      @csrf
                      <button class="btn btn-danger btn-sm text-white mr-2" type="submit">Hapus</button>
                    </form>

                    <a href="{{route('admin.dataDBD.show',  $row->id)}}" class="btn btn-info btn-sm text-white">Detail</a>

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
  </div>
</section>
@endsection

@section('script')
<script>
  $(function() {
    $("#table_laporan_dbd_file").DataTable({
      "responsive": true
      , "lengthChange": false
      , "autoWidth": false
    , });
  });

</script>
@endsection

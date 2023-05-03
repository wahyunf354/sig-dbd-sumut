@extends('admin.layouts.index')
@section('title', 'Pengaduan | SIG DBD SUMUT')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pengaduan Masyarakat</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pengaduan</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <section class="content">
    <div class="container-fluid">
      @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{session('success')}}
      </div>
      @endif
      <div class="row">
        <div class="col-12">
        <div class="card mb-4`">
          <div class="card-body">
            <table class="table table-bordered table-striped" id="table_pengaduan">
              <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @if(count($pengaduans) == 0)
                <tr>
                  <td colspan="8" class="text-center">Belum ada pengaduan yang di submit</td>
                </tr>
              @else
                @foreach($pengaduans as $key => $row)
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->subject}}</td>
                    <td>
                      <form class="d-inline" action="{{route("admin.pengaduan.destroy", $row->id)}}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm text-white">Hapus</button>
                      </form>
                      <a href="{{route('admin.pengaduan.show', ['id' => $row->id])}}"
                        class="btn btn-info btn-sm text-white">Detail</a>
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
@section("script")
  <script>
    $(function () {
      $("#table_pengaduan").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#table_pengaduan_file_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection

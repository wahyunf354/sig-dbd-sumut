@extends('admin.layouts.index')

@section('title', 'Kabupaten Kota Sumatera Utara | SIG DBD SUMUT')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Kabupaten Kota Sumatera Utara</h1>
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
            <div class="card-body">
              <a href="{{route('kabkota.create')}}" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-2"></i>Tambah Kabupate Kota</a>
              <table class="table table-bordered" id="table_kab_kota">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Luas</th>
                    <th>Jumlah Penduduk</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($regencyCities) <= 0)
                    
                    <tr>
                      <td colspan="5">Tidak ada data</td>
                    </tr>

                  @else

                    @foreach($regencyCities as $key => $row)
                      <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$row['nama']}}</td>
                        <td>{{number_format($row['luas'], 0, ',', '.')}}</td>
                        <td>{{number_format($row['jmlpddk'], 0, ',', '.')}}</td>
                        <td>
                          <a href="{{route('kabkota.edit', $row['id'])}}" class="btn btn-primary btn-sm" >Edit</a>
                          <form action="{{route('kabkota.destroy', $row['id'])}}" method="POST" class="d-inline" >
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus data?');" type="submit">Hapus</button>
                        </form>
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
      $(function () {
      $("#table_kab_kota").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
      });
    });
  </script>
@endsection
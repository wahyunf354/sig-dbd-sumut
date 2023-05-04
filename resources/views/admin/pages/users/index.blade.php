@extends('admin.layouts.index')

@section('title', 'Pengaturan Akun Sistem | SIG DBD SUMUT')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Pengaturan Akun Sistem</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Akun</li>
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
        <div class="col-lg-12 col-xxl-10 col-md-12 col-12">
        <div class="card">
          <div class="card-body">
            @if(Auth::user()->role_user_id == 1)
            <a href="{{route('user.create')}}" class="btn btn-sm btn-primary"><i class="fas fa-plus mr-2"></i> Tambah User</a>
            @endif
            <table class="table table-bordered table-striped" id="table_akun_user">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Kab/Kota</th>
                  @if(Auth::user()->role_user_id == 1)
                  <th>User Name</th>
                  <th>Email</th>
                  <th>Action</th>
                  @endif
                </tr>
              </thead>
            
              <tbody>
                @if(count($users) <= 0)
                  <tr>
                    <td class="text-center">Tidak ada data</td>
                  </tr>
                @else
                  @foreach($users as $key => $row)
                    
                    <tr>
                      <td>{{ $key + 1}}</td>
                      <td>{{ $row->name }}</td>
                      <td>
                        {!!$row->role_badge!!}
                      </td>
                      <td>{{ $row->kabKota?->nama }}</td>
                      @if(Auth::user()->role_user_id == 1)
                      <td>{{ $row->username }}</td>
                      <td>{{ $row->email }}</td>
                      <td>
                        <button class="btn btn-sm btn-warning">Edit</button>
                        <form action="{{route('user.destroy', $row->id)}}" method="POST" class="d-inline" onclick="return confirm('Apakah anda yakin akan menghapus?');>
                            @method('DELETE')
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin akan menghapus user?')" type="submit">Hapus</button>
                        </form>
                      </td>
                      @endif
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
      $("#table_akun_user").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
      })
    });
  </script>
@endsection
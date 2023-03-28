@extends('admin.layouts.index')

@section('title', 'Detail Laporan | SIG DBD SUMUT')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Laporan DBD {{ $laporanDbdFile->kabupatenOrKotaSumut->nama  }}</h1>
          <p class="text-secondary">{{$monthName}}, {{$laporanDbdFile->tahun}}</p>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.laporandbd.index')}}">Laporan DBD</a></li>
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
          <div class="card mb-4">
            <div class="card-body">
              <table class="table table-bordered table-striped" id="table_detail_laporan">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Kecamatan</th>
                  <th>Puskesmas</th>
                  <th>Desa Kelurahan</th>
                  <th>Incident Rate(IR)</th>
                  <th>Case Fatalitity Rate (CFR)</th>
                  <th>Angka Bebas Jentik(ABJ)</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @if(count($laporanDbdFile->laporanDbd) == 0)
                  <tr>
                    <td colspan="8" class="text-center">Tidak input data yang masuk</td>
                  </tr>
                @else
                  @foreach($laporanDbdFile->laporanDbd as $key => $row)
                    <tr>
                      <td class="text-center">{{$key+1}}</td>
                      <td>{{$row->kecamatan_dijumpai_dbd}}</td>
                      <td>{{$row->puskesmas_dijumpai_dbd}}</td>
                      <td>{{$row->desa_kelurahan_dijumpai_dbd}}</td>
                      <td>{{$row->ir_dbd}}</td>
                      <td>{{$row->crf_dbd}}</td>
                      <td>{{$row->abj}}</td>
                      <td class="text-center">
                        <button class="btn btn-primary btn-sm">
                          Info
                        </button>
                      </td>
                    </tr>
                  @endforeach
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-auto d-none">
          <div class="card">
            <div class="card-body">
              {{-- TODO: Tampilan detail all nilai dari baris tabel--}}
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
      $("#table_detail_laporan").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
      })
    });
  </script>
@endsection


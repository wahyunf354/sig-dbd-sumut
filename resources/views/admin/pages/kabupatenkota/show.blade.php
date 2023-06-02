@extends('admin.layouts.index')

@section('title', 'Kabupaten Kota Sumatera Utara | SIG DBD SUMUT')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">{{$kabKota->nama}}</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Kabupaten Kota Sumatera Utara</a></li>
          <li class="breadcrumb-item active">{{$kabKota->nama}}</li>
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
      <div class="col-md-3 col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{ number_format($dataCards->kasus_total, 0, ',', '.') }}</h3>
            <p>Jumlah Kasus <br>{{$minYear.'-'.$maxYear}}</p>
          </div>
          <div class="icon">
            <i class="fas fa-procedures"></i>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-perpule">
          <div class="inner">
            <h3>{{ number_format($dataCards->meninggal_total, 0, ',', '.') }}</h3>
            <p>Jumlah Kasus Meninggal <br>{{$minYear.'-'.$maxYear}}</p>
          </div>
          <div class="icon">
            <i class="far fa-heart"></i>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{number_format($dataCards->IR, 2, ',', '.')}}</h3>

            <p>Incident Rate <br>{{$minYear.'-'.$maxYear}}</p>

          </div>
          <div class="icon">
            <i class="fas fa-stethoscope"></i>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{number_format($dataCards->CFR, 2, ',', '.')}}<sup style="font-size: 20px">%</sup></h3>
            <p>Case Fatality Rate <br>{{$minYear.'-'.$maxYear}}</p>
          </div>
          <div class="icon">
            <i class="fas fa-heart"></i>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-primary">
          <div class="inner">
            <h3>{{number_format($dataCards->ABJ, 2, ',', '.')}}<sup style="font-size: 20px">%</sup></h3>
            <p>Angka Bebas Jentik <br>{{$minYear.'-'.$maxYear}}</p>
          </div>
          <div class="icon">
            <i class="fas fa-shield-virus"></i>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
          <div class="inner">
            <h3>{{number_format($dataCards->jmlpddk, 0, ',', '.')}}</h3>

            <p>Jumlah Penduduk <br>{{$minYear.'-'.$maxYear}}</p>
          </div>
          <div class="icon">
            <i class="fas fa-users"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class=" col-md-6 col-12">
        <!-- BAR CHART IR -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">
              Incident Rate
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="ir_grafik" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class=" col-md-6 col-12">
        <!-- BAR CHART  ABJ -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">
              Angka Bebas Jentik {{ date('Y')}}

            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="abj_grafik" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class=" col-md-6 col-12">
        <!-- BAR CHART CFR -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">
              Case Fatality Rate
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="cfr_grafik" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <div class=" col-md-6 col-12">
        <!-- BAR CHART  Kasus -->
        <div class="card card-success">
          <div class="card-header">
            <h3 class="card-title">
              Kasus DBD
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="chart">
              <canvas id="kasus_grafik" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
<div id="urlgrafikAbj" data-url="{{ url('/api/grafikByKabOfMonth?kab_kota_id='.$kabKota->id.'&year=') }}"></div>
<div id="urlGrafikCfrIr" data-url="{{ url('/api/grafikByKabOfYear?kab_kota_id='.$kabKota->id) }}"></div>

@endsection

@section('script')
<script src="{{asset('admin_assets')}}/dist/js/me/detailKabKota.js"></script>
@endsection

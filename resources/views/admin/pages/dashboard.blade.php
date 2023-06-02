@extends('admin.layouts.index')

@section('title', 'Dashboard | SIG DBD SUMUT')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{number_format($dataCards->IR, 2, ',', '.')}}</h3>
            <p>Incident Rate <br>{{$minYear.'-'.$maxYear}}</p>
          </div>
          <div class="icon">
            <i class="fas fa-stethoscope"></i>
          </div>
          <a href="#" class="small-box-footer d-none">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{number_format($dataCards->CFR, 2, ',', '.')}}<sup style="font-size: 20px">%</sup></h3>
            <p>Case Fatality Rate <br>{{$minYear.'-'.$maxYear}}</p>

          </div>
          <div class="icon">
            <i class="fas fa-heart"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{number_format($dataCards->ABJ, 2, ',', '.')}}<sup style="font-size: 20px">%</sup></h3>
            <p>Angka Bebas Jentik <br>{{$minYear.'-'.$maxYear}}</p>
          </div>
          <div class="icon">
            <i class="fas fa-shield-virus"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{number_format($dataCards->kasus_total, 0, ',', '.')}}</h3>
            <p>Jumlah Kasus <br>{{$minYear.'-'.$maxYear}}</p>
          </div>
          <div class="icon">
            <i class="fas fa-procedures"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{number_format($dataCards->meninggal_total, 0, ',', '.')}}</h3>
            <p>Jumlah Kasus Meninggal <br>{{$minYear.'-'.$maxYear}}</p>
          </div>
          <div class="icon">
            <i class="far fa-heart"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
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
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Custom tabs (Charts with tabs)-->
      <section class="col-lg-7 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-bar mr-1"></i>
              Kasus DBD Di Sumatera Utara pada {{$minYear.' - '.$maxYear}}
            </h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content p-0">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                <canvas id="el_grafik_kasus" height="300" style="height: 300px;"></canvas>
              </div>
            </div>
          </div><!-- /.card-body -->
        </div>
      </section>
    </div>

    <div class="row">
      <!-- Custom tabs (Charts with tabs)-->
      <section class="col-lg-7 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-bar mr-1"></i>
              Incident Rate DBD Di Sumatera Utara pada {{$minYear.' - '.$maxYear}}
            </h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content p-0">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                <canvas id="el_grafik_ir" height="300" style="height: 300px;"></canvas>
              </div>
            </div>
          </div><!-- /.card-body -->
        </div>
      </section>
    </div>


    <div class="row">
      <!-- Custom tabs (Charts with tabs)-->
      <section class="col-lg-7 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-bar mr-1"></i>
              Case Fatality Rate DBD Di Sumatera Utara pada {{$minYear.' - '.$maxYear}}
            </h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content p-0">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                <canvas id="el_grafik_cfr" height="300" style="height: 300px;"></canvas>
              </div>
            </div>
          </div><!-- /.card-body -->
        </div>
      </section>
    </div>

    <div class="row">
      <!-- Custom tabs (Charts with tabs)-->
      <section class="col-lg-7 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-chart-bar mr-1"></i>
              Angka Bebas Jentik DBD Di Sumatera Utara pada {{$minYear.' - '.$maxYear}}
            </h3>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content p-0">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                <canvas id="el_grafik_abj" height="300" style="height: 300px;"></canvas>
              </div>
            </div>
          </div><!-- /.card-body -->
        </div>
      </section>
    </div>



  </div>
  <!-- /.row (main row) -->
</section>
<!-- /.content -->
<div id="urlDataGrafikKasusPerKabKota" data-url="{{ url('/api/dataGrafikKasusPerKabKota') }}"></div>
<div id="urlDataGrafikIrPerKabKota" data-url="{{ url('/api/dataGrafikIrPerKabKota') }}"></div>
<div id="urlDataGrafikCfrPerKabKota" data-url="{{ url('/api/dataGrafikCfrPerKabKota') }}"></div>
<div id="urlDataGrafikAbjPerKabKota" data-url="{{ url('/api/dataGrafikAbjPerKabKota') }}"></div>

@endsection

@section('script')
<script src="{{asset('admin_assets')}}/dist/js/pages/dashboard.js"></script>
@endsection

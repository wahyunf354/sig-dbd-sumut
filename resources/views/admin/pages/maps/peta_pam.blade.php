@extends('admin.layouts.index')

@section('title', 'Peta Penyebaran DBD | SIG DBD SUMUT')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Peta Penyebaran DBD</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item active">Peta Sebaran DBD</li>
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
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            Peta berdasarkan data DBD pada
            <p>{{$minMonth}} {{$minYear}} - {{$maxMonth}} {{$maxYear}}</p>
          </div>
          <div class="card-body">
            @include('component.map_pam')
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Name Kabupaten</th>
                  <th>IR</th>
                  <th>CFR</th>
                  <th>ABJ</th>
                  <th>Jumlah Penduduk</th>
                </tr>
              </thead>
              <tbody>
                @foreach($dataDBD as $key => $row)
                <thead>
                  <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$row->name}}</td>
                    <td>{{$row->IR && $row->IR > 0  ? $row->IR : '-'}}</td>
                    <td>{{$row->CFR && $row->CFR > 0  ? $row->CFR : '-'}}</td>
                    <td>{{$row->ABJ && $row->ABJ > 0  ? $row->ABJ : '-'}}</td>
                    <td>{{number_format($row->jmlpddk)}}</td>
                  </tr>
                </thead>
                @endforeach
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
@endsection

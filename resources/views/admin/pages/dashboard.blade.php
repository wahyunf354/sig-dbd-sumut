@extends('admin.layouts.index')

@section('content')
<div class="container-lg">
  <div class="row">
    <div class="col-sm-6 col-lg-3">
      <div class="card mb-4 text-white bg-primary">
        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
          <div>
            <div class="fs-4 fw-semibold">26K <span class="fs-6 fw-normal">(-12.4%
                <svg class="icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                </svg>)</span>
            </div>
            <div>Incident Rate Sumatera Utara</div>
          </div>
          <div class="dropdown">
            <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <svg class="icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
              </svg>
            </button>
            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
          </div>
        </div>
        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
          <canvas class="chart" id="card-chart1" height="70"></canvas>
        </div>
      </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
      <div class="card mb-4 text-white bg-info">
        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
          <div>
            <div class="fs-4 fw-semibold">$6.200 <span class="fs-6 fw-normal">(40.9%
                <svg class="icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                </svg>)</span></div>
            <div>Angka Kematian Sumatera Utara</div>
          </div>
          <div class="dropdown">
            <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <svg class="icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
              </svg>
            </button>
            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
          </div>
        </div>
        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
          <canvas class="chart" id="card-chart2" height="70"></canvas>
        </div>
      </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
      <div class="card mb-4 text-white bg-warning">
        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
          <div>
            <div class="fs-4 fw-semibold">2.49% <span class="fs-6 fw-normal">(84.7%
                <svg class="icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-top"></use>
                </svg>)</span></div>
            <div>Angka Bebas Jentik</div>
          </div>
          <div class="dropdown">
            <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <svg class="icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
              </svg>
            </button>
            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
          </div>
        </div>
        <div class="c-chart-wrapper mt-3" style="height:70px;">
          <canvas class="chart" id="card-chart3" height="70"></canvas>
        </div>
      </div>
    </div>
    <!-- /.col-->
    <div class="col-sm-6 col-lg-3">
      <div class="card mb-4 text-white bg-danger">
        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
          <div>
            <div class="fs-4 fw-semibold">44K <span class="fs-6 fw-normal">(-23.6%
                <svg class="icon">
                  <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-arrow-bottom"></use>
                </svg>)</span></div>
            <div>Users</div>
          </div>
          <div class="dropdown">
            <button class="btn btn-transparent text-white p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <svg class="icon">
                <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
              </svg>
            </button>
            <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
          </div>
        </div>
        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
          <canvas class="chart" id="card-chart4" height="70"></canvas>
        </div>
      </div>
    </div>
    <!-- /.col-->
  </div>
  <!-- /.row-->
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between">
        <div>
          <h4 class="card-title mb-0">Traffic Kasus DBD</h4>
          <div class="small text-medium-emphasis">January - July 2022</div>
        </div>
        <div class="btn-toolbar d-none d-md-block" role="toolbar" aria-label="Toolbar with buttons">
          <div class="btn-group btn-group-toggle mx-3" data-coreui-toggle="buttons">
            <input class="btn-check" id="option1" type="radio" name="options" autocomplete="off">
            <label class="btn btn-outline-secondary"> Day</label>
            <input class="btn-check" id="option2" type="radio" name="options" autocomplete="off" checked="">
            <label class="btn btn-outline-secondary active"> Month</label>
            <input class="btn-check" id="option3" type="radio" name="options" autocomplete="off">
            <label class="btn btn-outline-secondary"> Year</label>
          </div>
          <button class="btn btn-primary" type="button">
            <svg class="icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cloud-download"></use>
            </svg>
          </button>
        </div>
      </div>
      <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
        <canvas class="chart" id="main-chart" height="300"></canvas>
      </div>
    </div>


  </div>
  <!-- /.card.mb-4-->
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-header">Activity</div>
        <div class="card-body">

          <!-- /.row--><br>
          <div class="table-responsive">
            <table class="table border mb-0">
              <thead class="table-light fw-semibold">
                <tr class="align-middle">
                  <th class="text-center">
                    <svg class="icon">
                      <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-people"></use>
                    </svg>
                  </th>
                  <th>User</th>
                  <th class="text-center">Country</th>
                  <th>Usage</th>
                  <th class="text-center">Payment Method</th>
                  <th>Activity</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <tr class="align-middle">
                  <td class="text-center">
                    <div class="avatar avatar-md"><img class="avatar-img" src="assets/img/avatars/1.jpg" alt="user@email.com"><span class="avatar-status bg-success"></span></div>
                  </td>
                  <td>
                    <div>Yiorgos Avraamu</div>
                    <div class="small text-medium-emphasis"><span>New</span> | Registered: Jan 1, 2020</div>
                  </td>
                  <td class="text-center">
                    <svg class="icon icon-xl">
                      <use xlink:href="vendors/@coreui/icons/svg/flag.svg#cif-us"></use>
                    </svg>
                  </td>
                  <td>
                    <div class="clearfix">
                      <div class="float-start">
                        <div class="fw-semibold">50%</div>
                      </div>
                      <div class="float-end"><small class="text-medium-emphasis">Jun 11, 2020 - Jul 10, 2020</small></div>
                    </div>
                    <div class="progress progress-thin">
                      <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </td>
                  <td class="text-center">
                    <svg class="icon icon-xl">
                      <use xlink:href="vendors/@coreui/icons/svg/brand.svg#cib-cc-mastercard"></use>
                    </svg>
                  </td>
                  <td>
                    <div class="small text-medium-emphasis">Last login</div>
                    <div class="fw-semibold">10 sec ago</div>
                  </td>
                  <td>
                    <div class="dropdown">
                      <button class="btn btn-transparent p-0" type="button" data-coreui-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-options"></use>
                        </svg>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#">Info</a><a class="dropdown-item" href="#">Edit</a><a class="dropdown-item text-danger" href="#">Delete</a></div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.col-->
  </div>
  <!-- /.row-->
</div>
@endsection

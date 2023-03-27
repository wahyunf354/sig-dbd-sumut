@extends('admin.layouts.index')

@section('content')
  <div class="container-lg">
    <div class="row">
      <div class="card mb-4">
        <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <h4 class="card-title mb-0">Laporan DBD</h4>
              <div class="small text-medium-emphasis"></div>
            </div>
          </div>
          <div class="c-chart-wrapper" style="height:300px;margin-top:40px;">
            <table class="table" id="table_laporan_dbd_file">
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
                         data-coreui-container="body"
                         class="btn btn-sm btn-link"
                         data-coreui-toggle="popover"
                         data-coreui-placement="bottom"
                         data-coreui-content="Download File"
                         data-coreui-trigger="hover focus">
                        <svg class="nav-icon" width="50" height="25">
                          <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-cloud-download"></use>
                        </svg>
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
  </div>
@endsection
@section("script")
  <script>
    $(document).ready(function () {
      $('#table_laporan_dbd_file').DataTable({
        "lengthChange": false,
        "language": {
          "search": "",
          "searchPlaceholder": "Search..."
        }
      });
    });
  </script>
@endsection

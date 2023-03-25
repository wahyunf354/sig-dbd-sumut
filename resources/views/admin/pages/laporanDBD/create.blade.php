@extends('admin.layouts.index')

@section('content')
  <div class="controller-lg">
    <div class="row">
      <div class="col-12 col-md-6">
        <div class="card">
          <div class="card-header">
            <h3>Unggah File Laporan DBD</h3>
          </div>
          <div class="card-body">
            <form action="{{route('admin.post.uploadLaporanDBD')}}" method="post" enctype="multipart/form-data">
              @csrf

              <div class="mb-3">
                <label for="kabkota_id">Kabupate atau Kota <span class="text-danger">*</span> </label>
                <select class="form-select form-select-sm" name="kabkota_id" id="kabkota_id">
                  <option value="">-- Pilih Kabupaten Atau Kota --</option>
                  @foreach($kabKotas as $kabKota)
                    <option value="{{$kabKota->id}}">{{$kabKota->nama}}</option>
                  @endforeach
                </select>
              </div>


              <div class="mb-3">
                <label for="tahun">Tahun <span class="text-danger">*</span> </label>
                <select class="form-select form-select-sm" name="tahun" id="tahun">
                  @foreach($years as $year)
                    @if($year == $yearNow)
                      <option selected value="{{$year}}">{{$year}}</option>
                    @else
                      <option value="{{$year}}">{{$year}}</option>
                    @endif
                  @endforeach
                </select>
              </div>

              <div class="mb-3">
                <label for="bulan">Bulan <span class="text-danger">*</span> </label>
                <select class="form-select form-select-sm" name="bulan" id="bulan">
                  <option value="">-- Pilih Bulan --</option>
                  @foreach($mounts as $key => $mount)
                    <option value="{{$key+1}}">{{$mount}}</option>
                  @endforeach
                </select>
              </div>

              <div class="mb-3">
                <label for="laporan_dbd">File Laporan <span class="text-danger">*</span> </label>
                <input class="form-control form-control-sm" type="file" id="laporan_dbd" name="laporan_dbd"
                       value="{{old("laporan_dbd")}}">
                <small>Form laporan harus sesuai</small>
              </div>
              <button class="btn btn-primary mb-3" type="submit">Unggah</button>
              @if($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

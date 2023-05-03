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
                  <th>Actions</th>
                  <th>Kecamatan</th>
                  <th>Puskesmas</th>
                  <th>Desa Kelurahan</th>
                  <th>Incident Rate(IR)</th>
                  <th>Case Fatalitity Rate (CFR)</th>
                  <th>Angka Bebas Jentik(ABJ)</th>
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
                      <td class="text-center">
                        <button class="btn btn-primary btn-sm btn-info"  data-id="{{$row->id}}">
                          Info
                        </button>
                      </td>
                      <td>{{$row->kecamatan_dijumpai_dbd}}</td>
                      <td>{{$row->puskesmas_dijumpai_dbd}}</td>
                      <td>{{$row->desa_kelurahan_dijumpai_dbd}}</td>
                      <td>{{$row->ir_dbd}}</td>
                      <td>{{$row->cfr_dbd}}</td>
                      <td>{{$row->abj}}</td>
                    </tr>
                  @endforeach
                @endif
                </tbody>
                <tfoot>
                  <th colspan="5">Rata-rata</th>
                  <th>{{$avg['ir']}}</th>
                  <th>{{ $avg['cfr'] }}</th>
                  <th>{{ $avg['abj'] }}</th>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-row card-primary">
            <div class="card-header">
              <h3 class="card-title">
              Info Detail
              </h3>
            </div>
            <div class="card-body card-container overflow-auto" style="max-height:75vh">
              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="card-title">Anda Belum Memilih Data</h5>
                </div>
              </div>
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
      $('.btn-info').click(function() {
        let id = $(this).data("id")
        console.log(id)

        $.ajax({
          url:"{{route('admin.laporandbdb.one.detail')}}",
          method: 'POST',
          data: {id:id, _token: "{{csrf_token()}}"},
          success: function(res) {
            let detailData = res

            // buat elemen card bootstrap dengan data yang diambil
            var card = $('<div class="card card-primary card-outline"></div>');
            var cardBody = $('<div class="card-body"></div>');
            var kecamatan = $('<h5></h5>').text('Kec. ' + detailData.kecamatan_dijumpai_dbd + ', Kel/Desa. ' + detailData.desa_kelurahan_dijumpai_dbd);
            var puskesmas = $('<h6 mb-2 text-muted"></h6>').text(detailData.puskesmas_dijumpai_dbd);
            var jumlahPenduduk = $('<p class="card-text"></p>').text('Jumlah Penduduk: ' + detailData.jumlah_penduduk_desa_kelurahan);
            var jumlahKasus = $('<p class="card-text"></p>').text('Jumlah Kasus: ' + detailData.jumlah_kasus_penderita);
            var jumlahMeninggal = $('<p class="card-text"></p>').text('Jumlah Meninggal: ' + detailData.jumlah_kasus_meninggal);

            let jumlahDesaKel = `
              <table class="table table-bordered mb-3">
                <tr>
                  <th>Keterangan</th>
                  <th>Jumlah Desa atau Kelurahan</th>
                </tr>
                <tr>
                  <th>Penyelidikan Epidemiologi</th>
                  <td>${detailData.jumlah_desakel_penyelidikan_epidemologi}</td>
                </tr>
                
                <tr>
                  <th>Pelaksanaan 3M+ Massal</th>
                  <td>${detailData.jumlah_desakel_penyelidikan_epidemologi}</td>
                </tr>

                <tr>
                  <th>PSN DBD, Penyuluhan</th>
                  <td>${detailData.jumlah_desakel_penyuluhan}</td>
                </tr>
                <tr>
                  <th></th>
                  <th>Jumlah Bangunan/Rumah</th>
                </tr>
                <tr>
                  <th>Larvasidasi/Abatisasi</th>
                  <td>${detailData.jumlah_rumah_bangunan_larvasidasi}</td>
                </tr>
                <tr>
                  <th></th>
                  <th>Jumlah</th>
                </tr>
                <tr>
                  <th>Pelaksanaan Fogging</th>
                  <td>${detailData.jumlah_pelaksanaan_fogging}</td>
                </tr>
                <tr>
                  <th>Rumah Fokus fogging</th>
                  <td>${detailData.jumlah_rumah_pelaksanaan_fogging}</td>
                </tr>
                <tr>
                  <th>Bangunan Fokus fogging</th>
                  <td>${detailData.jumlah_bangunan_pelaksanaan_fogging}</td>
                </tr>
                
              </table>
            `;



            let jumlahKasusBerdasarkanUmur = `
              <table class="table table-bordered">
                <tr>
                  <td rowspan="36" class="" >Jumlah Kasus <br> berdasarkan Umur</td>
                  <td rowspan="4" colspan="1"><1TH</td>
                  <td rowspan="2" colspan="1">Pr</td>
                  <td rowspan="1" colspan="1">P</td>                  
                  <td>${detailData.jumlah_kasus_u1_pr_p}</td>
                </tr>
                <tr>
                  <td rowspan="1" colspan="1">M</td>
                  <td>${detailData.jumlah_kasus_u1_pr_m}</td>
                </tr>
                <tr>
                  <td rowspan="2" colspan="1">Lk</td>
                  <td rowspan="1" colspan="1">P</td>
                  <td>${detailData.jumlah_kasus_u1_lk_p}</td>
                </tr>
                <tr>
                  <td rowspan="1" colspan="1">M</td>
                  <td>${detailData.jumlah_kasus_u1_lk_m}</td>
                </tr>
                <tr>
                  <td rowspan="4" colspan="1">1 - 4</td>
                  <td rowspan="2">Pr</td>
                  <td rowspan="1" colspan="1">P</td>
                  <td>${detailData.jumlah_kasus_u1_pr_p}</td>
                </tr>
                <tr>
                  <td rowspan="1" colspan="1">M</td>
                  <td>${detailData.jumlah_kasus_u1_pr_m}</td>
                </tr>
                <tr>
                  <td rowspan="2">Lk</td>
                  <td rowspan="1" colspan="1">P</td>
                  <td>${detailData.jumlah_kasus_u1_lk_p}</td>
                </tr>
                <tr>
                  <td rowspan="1" colspan="1">M</td>
                  <td>${detailData.jumlah_kasus_u1_lk_m}</td>
                </tr>
                <tr>
                  <td rowspan="4" colspan="1">5 - 9</td>
                  <td rowspan="2">Pr</td>
                  <td rowspan="1" colspan="1">P</td>
                  <td>${detailData.jumlah_kasus_u5sd9_pr_p}</td>
                </tr>
                <tr>
                  <td rowspan="1" colspan="1">M</td>
                  <td>${detailData.jumlah_kasus_u5sd9_pr_m}</td>
                </tr>
                <tr>
                  <td rowspan="2">Lk</td>
                  <td rowspan="1" colspan="1">P</td>
                  <td>${detailData.jumlah_kasus_u5sd9_lk_p}</td>
                </tr>
                <tr>
                  <td rowspan="1" colspan="1">M</td>
                  <td>${detailData.jumlah_kasus_u5sd9_lk_m}</td>
                </tr>
                <tr>
                  <td rowspan="4" colspan="1">10 - 14</td>
                  <td rowspan="2">Pr</td>
                  <td rowspan="1" colspan="1">P</td>
                  <td>${detailData.jumlah_kasus_u10sd14_pr_p}</td>
                </tr>
                <tr>
                  <td rowspan="1" colspan="1">M</td>
                  <td>${detailData.jumlah_kasus_u10sd14_pr_m}</td>
                </tr>
                <tr>
                  <td rowspan="2">Lk</td>
                  <td rowspan="1" colspan="1">P</td>
                  <td>${detailData.jumlah_kasus_u10sd14_lk_p}</td>
                </tr>
                <tr>
                  <td rowspan="1" colspan="1">M</td>
                  <td>${detailData.jumlah_kasus_u10sd14_lk_m}</td>
                </tr>
                <tr>
                  <td rowspan="4" colspan="1">15 - 44</td>
                  <td rowspan="2">Pr</td>
                  <td rowspan="1" colspan="1">P</td>
                  <td>${detailData.jumlah_kasus_u15sd44_pr_p}</td>
                </tr>
                <tr>
                  <td rowspan="1" colspan="1">M</td>
                  <td>${detailData.jumlah_kasus_u15sd44_pr_m}</td>
                </tr>
                <tr>
                  <td rowspan="2">Lk</td>
                  <td rowspan="1" colspan="1">P</td>
                  <td>${detailData.jumlah_kasus_u15sd44_lk_p}</td>
                </tr>
                <tr>
                  <td rowspan="1" colspan="1">M</td>
                  <td>${detailData.jumlah_kasus_u15sd44_lk_m}</td>
                </tr>
                <tr>
                  <td rowspan="4" colspan="1">>44</td>
                  <td rowspan="2">Pr</td>
                  <td rowspan="1" colspan="1">P</td>
                  <td>${detailData.jumlah_kasus_u44_pr_p}</td>
                </tr>
                <tr>
                  <td rowspan="1" colspan="1">M</td>
                  <td>${detailData.jumlah_kasus_u44_pr_m}</td>
                </tr>
                <tr>
                  <td rowspan="2">Lk</td>
                  <td rowspan="1" colspan="1">P</td>
                  <td>${detailData.jumlah_kasus_u44_lk_p}</td>
                </tr>
                <tr>
                  <td rowspan="1" colspan="1">M</td>
                  <td>${detailData.jumlah_kasus_u44_lk_m}</td>
                </tr>
                <tr>




                </tr>
              </table>
            `

            cardBody.append(kecamatan, puskesmas, jumlahPenduduk, jumlahKasus, jumlahMeninggal, jumlahDesaKel, jumlahKasusBerdasarkanUmur);
            card.append(cardBody);

            // tambahkan elemen card ke dalam container
            $('.card-container').html(card);
          }
        })
      })
    });
  </script>
@endsection


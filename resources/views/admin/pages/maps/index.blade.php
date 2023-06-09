@extends('admin.layouts.index')

@section('title', 'Peta Penyebaran DBD | SIG DBD SUMUT')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Peta Penyebaran DBD</h1>
          <p>Berdasarkan laporan bulan {{date('n')}} tahun {{date('Y')}}</p>
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
            <div class="card-body">
              <div class="w-100" style="height: 600px" id="map"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
  <script>
    var map = L.map('map').setView([2.5953371, 98.8685835], 8);
	var mapAccessToken = 'pk.eyJ1IjoibWVoYWtzYWNoZGV2YSIsImEiOiJjaXF2YTNvYWIwMDA1ZmttZzBsNTM1NXV1In0.-SA7eLZOeeYkVPG7Jek2ug';

    var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/light-v9/tiles/256/{z}/{x}/{y}?access_token='+mapAccessToken, {
      maxZoom: 19,
      id: 'mapbox.light',
      attribution: 'Mapbox'
    }).addTo(map);

    L.geoJson().addTo(map);

    let dataKabKota = JSON.parse('<?= $jsonDataKabKota ?>')
    extractGeoJsonAndDisplay(dataKabKota)

    function extractGeoJsonAndDisplay(data) {
      return new Promise(async (resolve, reject) => {
        try {
          let features = []
          data.forEach(async (data, i, arr) => {
            const styleGis = style(data);
            const res = await fetch("{{asset('assets')}}/geojson/" + data.file_geojson)
            const result = await res.json()

            Object.assign(result.features[0].properties, data)

            geoJson = L.geoJSON(result, {
              style: styleGis,
            }).addTo(map).bindPopup('<b>' + data.kabupaten + '</b><br/>Terkonfirmasi ' + (data.konfirmasi / data.jmlpddk * 100).toFixed(2) + '%' +
              '<br/>Meninggal ' + (data.meninggal / data.konfirmasi * 100).toFixed(2) + '%' +
              '<br/>Sembuh ' + (data.sembuh / data.konfirmasi * 100).toFixed(2) + '%')
            resolve("Success")
          })
        } catch (error) { 
          reject(error)
        }
      })
    }

    function getDBDColor(abj, cfr, ir) {
      let color = '';
      if (!abj || !cfr || !ir) {
        color = '#FFE8D5'; // Nilai kosong
      } else if (abj <  90 && cfr >= 1 && ir >= (10/100000)) {
        color = '#FF4D4D'; // Keparahan Tinggi (Merah)
      } else if ((abj >= 90 && abj < 95) && (cfr < 1 && cfr < 0) && (ir >= (5/100000) && (ir < 10/100000))) {
        color = '#F5DE51'; // Keparahan Sedang (Oranye)
      } else {
        color = '#31EB6A'; // Keparahan Rendah (Kuning)
      }
      return color;
    }

    function style(data) {
      return {
        'fillColor': getDBDColor(data['avg_abj'], data['avg_cfr'], data['avg_ir']),
        "color": "black",
        "weight": "1",
        "opacity": "0.4",
        "fillOpacity": "0.7"
      }
    }

  </script>
@endsection


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

    function getColor(data) {
      const colorMap = {
      "TIDAK TERDAMPAK": "#049B31",
      "TIDAK ADA KASUS": "#049B31",
      "RESIKO RENDAH": "#FFFF01",
      "RESIKO SEDANG": "#FF6600",
      "RESIKO TINGGI": "#FE0000"
      };
      return colorMap[data.keterangan] || "#000000";
    }

    function style(data) {
      return {
        'fillColor': '#049B31',
        "color": "black",
        "weight": "1",
        "opacity": "0.4",
        "fillOpacity": "0.7"
      }
    }

  </script>
@endsection


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
        <div class="col-md-6">
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

    var tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
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
      d = data.keterangan
      if (d == "TIDAK TERDAMPAK") {
        return '#049B31'
      } else if (d == "TIDAK ADA KASUS") {
        return '#049B31'
      } else if (d == "RESIKO RENDAH") {
        return '#FFFF01'
      } else if (d == "RESIKO SEDANG") {
        return '#FF6600'
        // return '#FFFF01'
      } else if (d == "RESIKO TINGGI") {
        return "#FE0000"
      }
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


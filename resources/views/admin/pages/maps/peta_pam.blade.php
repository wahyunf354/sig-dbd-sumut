@extends('admin.layouts.index')

@section('title', 'Peta Penyebaran DBD | SIG DBD SUMUT')

@section('content')
<style>
  .tooltip-map {
    background-color: transparent;
    border: none;
    box-shadow: none;
  }

</style>
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
            <div class="w-100" style="height: 600px" id="map"></div>
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
                @foreach($results as $key => $row)
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
<script>
  var map = L.map('map').setView([2.5953371, 98.8685835], 8);
  var mapAccessToken = 'pk.eyJ1IjoibWVoYWtzYWNoZGV2YSIsImEiOiJjaXF2YTNvYWIwMDA1ZmttZzBsNTM1NXV1In0.-SA7eLZOeeYkVPG7Jek2ug';

  var tiles = L.tileLayer('https://api.mapbox.com/styles/v1/mapbox/light-v9/tiles/256/{z}/{x}/{y}?access_token=' + mapAccessToken, {
    maxZoom: 19
    , id: 'mapbox.light'
    , attribution: 'Mapbox'
  }).addTo(map);

  L.geoJson().addTo(map);

  let dataKabKota = JSON.parse('<?= $jsonData ?>')

  function addColorClaster(data) {
    console.log(data)

    var uniqueClusters = [...new Set(data.map(item => item.cluster))]
    const result = []
    uniqueClusters.forEach((item) => result.push({
      cluster: item
    }))


    for (let i = 0; i < result.length; i++) {
      let cluster = result[i].cluster
      let sumIR = 0
      let sumCFR = 0
      let sumABJ = 0
      let countIR = 0
      let countCFR = 0
      let countABJ = 0
      for (let j = 0; j < data.length; j++) {
        if (cluster == data[j].cluster) {
          if (data[j].ABJ) {
            sumABJ += parseFloat(data[j].ABJ)
            countABJ += 1
          }
          if (data[j].IR) {
            sumIR += parseFloat(data[j].IR)
            countIR += 1
          }
          if (data[j].CFR) {
            sumCFR += parseFloat(data[j].CFR)
            countCFR += 1
          }
        }
      }
      result[i].avgABJ = sumABJ / countABJ || 0
      result[i].avgIR = sumIR / countIR || 0
      result[i].avgCFR = sumCFR / countCFR || 0
    }


    result.sort(function(a, b) {
      if (a.avgABJ !== b.avgABJ) {
        return a.avgABJ - b.avgABJ;
      } else if (a.avgIR !== b.avgIR) {
        return a.avgIR - b.avgIR;
      } else {
        return a.avgCFR - b.avgCFR;
      }
    });

    result.forEach(function(item, index) {
      const colorMap = ["#54B435", "#82CD47", "#F0FF42"]
      item.color = colorMap[index]
    });

    return result
  }

  const url = 'http://localhost:5000/pam';
  const data = dataKabKota

  let colorClaster = addColorClaster(dataKabKota)
  extractGeoJsonAndDisplay(dataKabKota, colorClaster)



  async function fetchClaster(url, data) {
    try {
      const response = await fetch(url, {
        method: 'POST'
        , headers: {
          'Content-Type': 'application/json'
        , }
        , body: JSON.stringify({
          data
        })
      , });

      if (!response.ok) {
        throw new Error('Error: ' + response.status);
      }

      const responseData = await response.json();
      return responseData;
    } catch (error) {
      console.error('Error:', error);
    }
  }

  function extractGeoJsonAndDisplay(data, colorClaster) {
    return new Promise(async (resolve, reject) => {
      try {
        let features = []
        data.forEach(async (data, i, arr) => {
          const styleGis = style(data, colorClaster);

          const res = await fetch("{{asset('assets')}}/geojson/" + data.file_geojson)
          const result = await res.json()

          Object.assign(result.features[0].properties, data)

          geoJson = L.geoJSON(result, {
            style: styleGis
          , }).addTo(map).bindPopup('<b>' + data.name +
            '</b><br />Incident Rate: ' + (data.IR && data.IR > 0 ? data.IR : '-') +
            '<br />Case Fatality Rate: ' + (data.CFR && data.CFR > 0 ? data.CFR : '-') +
            '<br />Angka Bebas Jentik: ' + (data.ABJ && data.ABJ > 0 ? data.ABJ : '-'))

          geoJson.bindTooltip(data.name, {
            permanent: true
            , direction: 'left'
            , className: 'tooltip-map'
          }).openTooltip();
          resolve("Success")

        })
      } catch (error) {
        reject(error)
      }
    })
  }

  function getColor(data, colorClaster) {
    let color = ""
    colorClaster.forEach(item => {
      if (data.cluster == item.cluster) {
        color = item.color
      }
    })
    return color
  }

  function style(data, colorClaster) {
    return {
      'fillColor': getColor(data, colorClaster)
      , "color": "#379237"
      , "weight": "1"
      , "opacity": "0.4"
      , "fillOpacity": "0.7"
    }
  }

</script>
@endsection

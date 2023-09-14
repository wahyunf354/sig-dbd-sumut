<style>
  .tooltip-map {
    background-color: transparent;
    border: none;
    box-shadow: none;
  }

</style>

<select class="custom-select" id="select-year">
  <option value="2023">2023</option>
  <option value="2022">2022</option>
  <option value="2021">2021</option>
</select>
<div class="w-100" style="height: 600px" id="map"></div>
<script src="{{asset('assets')}}/vendor/leaflet/leaflet.js"></script>

<script>
  const yearSelected = document.getElementById('select-year');
  if(window.location.pathname.split('/')[1] == 'admin') {
    yearSelected.classList.add('d-none')
  }
  const defaultYear = window.location.pathname.split('/')[2]
  yearSelected.value = defaultYear
  yearSelected.addEventListener('change', (e) => {
    window.location.href = '/peta_sebaran/' + e.target.value
  })

  var map = L.map("map").setView([2.5953371, 98.8685835], 8);
  var mapAccessToken =
    "pk.eyJ1IjoibWVoYWtzYWNoZGV2YSIsImEiOiJjaXF2YTNvYWIwMDA1ZmttZzBsNTM1NXV1In0.-SA7eLZOeeYkVPG7Jek2ug";

  var tiles = L.tileLayer(
    "https://api.mapbox.com/styles/v1/mapbox/light-v9/tiles/256/{z}/{x}/{y}?access_token=" +
    mapAccessToken, {
      maxZoom: 19
      , id: "mapbox.light"
      , attribution: "Mapbox"
    , }
  ).addTo(map);

  L.geoJson().addTo(map);

  let dataKabKota = JSON.parse('<?= $jsonData ?>');

  const url = "http://localhost:5000/pam";
  const data = dataKabKota;

  const dataWithColorNoCLuster = addColorNoCluster(dataKabKota);
  let colorClaster = addColorClaster(dataWithColorNoCLuster);
  extractGeoJsonAndDisplay(dataWithColorNoCLuster, colorClaster);

  function findMostFrequentValue(data) {
    const values = Object.values(data);
    const valueCount = {};

    // Menghitung berapa kali setiap nilai muncul
    values.forEach(value => {
      if (valueCount[value]) {
        valueCount[value]++;
      } else {
        valueCount[value] = 1;
      }
    });

    // Mencari jumlah kemunculan maksimum
    let maxCount = 0;

    for (const value in valueCount) {
      if (valueCount[value] > maxCount) {
        maxCount = valueCount[value];
      }
    }

    // Mengembalikan "Kuning" jika semua nilai muncul sama banyak
    if (maxCount === values.length) {
      return "Kuning";
    }

    // Mencari nilai yang paling sering muncul
    let mostFrequentValue = null;

    for (const value in valueCount) {
      if (valueCount[value] === maxCount) {
        mostFrequentValue = value;
      }
    }

    return mostFrequentValue;
  }

  function addColorNoCluster (data) {
    const dataWithColor = data.map(item => {
      let resultColors = {
        ir: ''
        , abj: ''
        , cfr: ''
      }
      const abj = parseFloat(item.ABJ)
      const cfr = parseFloat(item.CFR)
      const ir = parseFloat(item.IR)
      if (ir < 5) {
        resultColors.ir = 'Hijau'
      } else if (ir >= 5 && ir <= 10) {
        resultColors.ir = 'Kuning'
      } else {
        resultColors.ir = 'Merah'
      }
      if (cfr == 0) {
        resultColors.cfr = 'Hijau'
      } else if (cfr < 1) {
        resultColors.cfr = 'Kuning'
      } else {
        resultColors.cfr = 'Merah'
      }
      if (abj >= 95) {
        resultColors.abj = 'Hijau'
      } else if (abj >= 90 && abj < 95) {
        resultColors.abj = 'Kuning'
      } else {
        resultColors.abj = 'Merah'
      }
      const resultColor = findMostFrequentValue(resultColors)
      return {
        ...item
        , resultColor
        , abj
        , ir
        , cfr
      }
    })
    return dataWithColor
  }

  function addColorClaster(data) {
    var uniqueClusters = [...new Set(data.map((item) => item.cluster))];
    const result = [];
    uniqueClusters.forEach((item) =>
      result.push({
        cluster: item
      , })
    );

    for (let i = 0; i < result.length; i++) {
      let cluster = result[i].cluster;
      let sumIR = 0;
      let sumCFR = 0;
      let sumABJ = 0;
      let countIR = 0;
      let countCFR = 0;
      let countABJ = 0;
      for (let j = 0; j < data.length; j++) {
        if (cluster == data[j].cluster) {
          if (data[j].ABJ) {
            sumABJ += parseFloat(data[j].ABJ);
            countABJ += 1;
          }
          if (data[j].IR) {
            sumIR += parseFloat(data[j].IR);
            countIR += 1;
          }
          if (data[j].CFR) {
            sumCFR += parseFloat(data[j].CFR);
            countCFR += 1;
          }
        }
      }
      result[i].avgABJ = sumABJ / countABJ || 0;
      result[i].avgIR = sumIR / countIR || 0;
      result[i].avgCFR = sumCFR / countCFR || 0;
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
    // result.forEach(function(item, index) {
    //   const colorMap = ["#54B435", "#82CD47", "#F0FF42"];
    //   item.color = colorMap[index];
    // });
    return result;
  }

  function extractGeoJsonAndDisplay(data, colorClaster) {
    return new Promise(async (resolve, reject) => {
      try {
        let features = [];
        data.forEach(async (data, i, arr) => {
          const styleGis = style(data, colorClaster);

          const res = await fetch(
            "{{asset('assets')}}/geojson/" + data.file_geojson
          );
          const result = await res.json();

          Object.assign(result.features[0].properties, data);

          geoJson = L.geoJSON(result, {
              style: styleGis
            , })
            .addTo(map)
            .bindPopup(
              "<b>" +
              data.name +
              "</b><br />Incident Rate: " +
              (data.IR && data.IR > 0 ? data.IR : "-") +
              "<br />Case Fatality Rate: " +
              (data.CFR && data.CFR > 0 ? data.CFR : "-") +
              "<br />Angka Bebas Jentik: " +
              (data.ABJ && data.ABJ > 0 ? data.ABJ : "-")
            );

          geoJson
            .bindTooltip(data.name, {
              permanent: true
              , direction: "left"
              , className: "tooltip-map"
            , })
            .openTooltip();
          resolve("Success");
        });
      } catch (error) {
        reject(error);
      }
    });
  }

  function getColor(data, colorClaster) {
    let pilihanColor = [];
    if(data.resultColor == "Merah") {
      pilihanColor = ["#fa5500","#fc4000","#fd2b00"]
    } else if (data.resultColor == "Kuning") {
      pilihanColor = ["#ffff00","#fef406","#fce80c"]
    } else {
      pilihanColor = ["#b4ff00","#78ff00","#00ff00"]
    }
    let color = "";
    colorClaster.forEach((item) => {
      if (data.cluster == item.cluster) {
        color = pilihanColor[item.cluster]
      }
    });
    return color;
  }

  function style(data, colorClaster) {
    return {
      fillColor: getColor(data, colorClaster)
      , color: "white"
      , weight: 2,
      dashArray: '3'
      , opacity: "1"
      , fillOpacity: "0.7"
    , };
  }

</script>

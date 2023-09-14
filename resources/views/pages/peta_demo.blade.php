@extends('layouts.index')
@section("title", "Peta Sebaran DBD | Dinas Kesehatan Sumatera Utara")

@section('content')
<style>
  .tooltip-map {
    background-color: transparent;
    border: none;
    box-shadow: none;
  }

</style>


<div class="w-100" style="height: 100vh" id="map"></div>
<script src="{{asset('assets')}}/vendor/leaflet/leaflet.js"></script>

<script>

  const dataEuc = [
  {
    NO: 1,
    "Kab / Kota": "Medan",
    "Rata-rata IR": 0.437159,
    "Rata-rata CFR": -0.200179,
    "Rata-rata ABJ": 1.371171,
    C1: 2.343998144,
    C2: 2.879163821,
    C3: 0.745977225,
    Cluster: 3
  },
  {
    NO: 2,
    "Kab / Kota": "Pematang Siantar",
    "Rata-rata IR": 1.946397,
    "Rata-rata CFR": 2.250813,
    "Rata-rata ABJ": 1.304639,
    C1: 4.171431784,
    C2: 0,
    C3: 3.50102598,
    Cluster: 2
  },
  {
    NO: 3,
    "Kab / Kota": "Binjai",
    "Rata-rata IR": 0.588861,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.366639,
    C1: 2.382780509,
    C2: 3.047228898,
    C3: 0.842730638,
    Cluster: 3
  },
  {
    NO: 4,
    "Kab / Kota": "Tanjung Balai",
    "Rata-rata IR": 0.381608,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.33661,
    C1: 2.275609286,
    C2: 3.14458939,
    C3: 0.633439182,
    Cluster: 3
  },
  {
    NO: 5,
    "Kab / Kota": "Tebing Tinggi",
    "Rata-rata IR": 0.670848,
    "Rata-rata CFR": 0.046289,
    "Rata-rata ABJ": 1.281879,
    C1: 2.400312852,
    C2: 2.547051547,
    C3: 1.057632744,
    Cluster: 3
  },
  {
    NO: 6,
    "Kab / Kota": "Sibolga",
    "Rata-rata IR": 0.869833,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 1.27762085,
    C2: 3.607997649,
    C3: 2.351488379,
    Cluster: 1
  },
  {
    NO: 7,
    "Kab / Kota": "Padang Sidempuan",
    "Rata-rata IR": -0.537399,
    "Rata-rata CFR": -0.000026,
    "Rata-rata ABJ": -0.797694,
    C1: 0.493897771,
    C2: 3.956680164,
    C3: 2.14235247,
    Cluster: 1
  },
  {
    NO: 8,
    "Kab / Kota": "Deli Serdang",
    "Rata-rata IR": 0.196424,
    "Rata-rata CFR": -0.429219,
    "Rata-rata ABJ": -0.797694,
    C1: 0.606068366,
    C2: 3.829461732,
    C3: 2.116400488,
    Cluster: 1
  },
  {
    NO: 9,
    "Kab / Kota": "Langkat",
    "Rata-rata IR": -0.260413,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.147374737,
    C2: 4.090069402,
    C3: 2.06861522,
    Cluster: 1
  },
  {
    NO: 10,
    "Kab / Kota": "Karo",
    "Rata-rata IR": -0.54974,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.141952163,
    C2: 4.253158449,
    C3: 2.090412223,
    Cluster: 1
  },
  {
    NO: 11,
    "Kab / Kota": "Simalungun",
    "Rata-rata IR": 0.152267,
    "Rata-rata CFR": -0.071725,
    "Rata-rata ABJ": -0.797694,
    C1: 0.691083197,
    C2: 3.610108941,
    C3: 2.145577667,
    Cluster: 1
  },
  {
    NO: 12,
    "Kab / Kota": "Asahan",
    "Rata-rata IR": -0.472583,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.114322,
    C1: 1.913113297,
    C2: 3.650553417,
    C3: 0.273431863,
    Cluster: 3
  },
  {
    NO: 13,
    "Kab / Kota": "Labuhan Batu",
    "Rata-rata IR": -0.248412,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.270887,
    C1: 2.074710933,
    C2: 3.50102598,
    C3: 0,
    Cluster: 3
  },
  {
    NO: 14,
    "Kab / Kota": "Tapanuli Utara",
    "Rata-rata IR": -0.682505,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.292354,
    C1: 2.108024679,
    C2: 3.788157002,
    C3: 0.434623363,
    Cluster: 3
  },
  {
    NO: 15,
    "Kab / Kota": "Tapanuli Tengah",
    "Rata-rata IR": -0.448037,
    "Rata-rata CFR": -0.290628,
    "Rata-rata ABJ": 1.380992,
    C1: 2.186980033,
    C2: 3.492573304,
    C3: 0.294217452,
    Cluster: 3
  },
  {
    NO: 16,
    "Kab / Kota": "Tapanuli Selatan",
    "Rata-rata IR": -0.838646,
    "Rata-rata CFR": 4.09863,
    "Rata-rata ABJ": -0.797694,
    C1: 4.595485975,
    C2: 3.948504873,
    C3: 5.0557149,
    Cluster: 2
  },
  {
    NO: 17,
    "Kab / Kota": "Nias",
    "Rata-rata IR": 0.310717,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.718505049,
    C2: 3.812362171,
    C3: 2.142813752,
    Cluster: 1
  },
  {
    NO: 18,
    "Kab / Kota": "Dairi",
    "Rata-rata IR": -0.598853,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.191064752,
    C2: 4.28216678,
    C3: 2.09805464,
    Cluster: 1
  },
  {
    NO: 19,
    "Kab / Kota": "Toba",
    "Rata-rata IR": 0.037314,
    "Rata-rata CFR": 1.468993,
    "Rata-rata ABJ": 0.49269,
    C1: 2.37667689,
    C2: 2.217002154,
    C3: 2.114855959,
    Cluster: 3
  },
  {
    NO: 20,
    "Kab / Kota": "Mandailing Natal",
    "Rata-rata IR": -0.816673,
    "Rata-rata CFR": 1.811008,
    "Rata-rata ABJ": 1.303182,
    C1: 3.132742898,
    C2: 2.797854105,
    C3: 2.357366473,
    Cluster: 3
  },
  {
    NO: 21,
    "Kab / Kota": "Nias Selatan",
    "Rata-rata IR": -0.613566,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.205777888,
    C2: 4.29092834,
    C3: 2.100562282,
    Cluster: 1
  },
  {
    NO: 22,
    "Kab / Kota": "Pak-Pak Bharat",
    "Rata-rata IR": 1.108835,
    "Rata-rata CFR": -0.213668,
    "Rata-rata ABJ": -0.797694,
    C1: 1.539248282,
    C2: 3.345890092,
    C3: 2.488028473,
    Cluster: 1
  },
  {
    NO: 23,
    "Kab / Kota": "Humbahas",
    "Rata-rata IR": -0.853394,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.445606124,
    C2: 4.438185019,
    C3: 2.155232624,
    Cluster: 1
  },
  {
    NO: 24,
    "Kab / Kota": "Samosir",
    "Rata-rata IR": -0.407788,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0,
    C2: 4.171431784,
    C3: 2.074710933,
    Cluster: 1
  },
  {
    NO: 25,
    "Kab / Kota": "Serdang Bedagai",
    "Rata-rata IR": -0.703279,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.370416,
    C1: 2.188153002,
    C2: 3.803151798,
    C3: 0.465628009,
    Cluster: 3
  },
  {
    NO: 26,
    "Kab / Kota": "Batubara",
    "Rata-rata IR": -0.127566,
    "Rata-rata CFR": 0.192934,
    "Rata-rata ABJ": 1.068089,
    C1: 2.001990041,
    C2: 2.931235873,
    C3: 0.709947138,
    Cluster: 3
  },
  {
    NO: 27,
    "Kab / Kota": "Padang Lawas",
    "Rata-rata IR": -0.322938,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.084850132,
    C2: 4.124140746,
    C3: 2.069922448,
    Cluster: 1
  },
  {
    NO: 28,
    "Kab / Kota": "Padang Lawas Utara",
    "Rata-rata IR": -0.66561,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.257822525,
    C2: 4.322179927,
    C3: 2.110232,
    Cluster: 1
  },
  {
    NO: 29,
    "Kab / Kota": "Labuhan Batu Selatan",
    "Rata-rata IR": -0.793494,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.385705883,
    C2: 4.400642908,
    C3: 2.139191112,
    Cluster: 1
  },
  {
    NO: 30,
    "Kab / Kota": "Labuhan Batu Utara",
    "Rata-rata IR": -0.517554,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.109765835,
    C2: 4.234348803,
    C3: 2.086015811,
    Cluster: 1
  },
  {
    NO: 31,
    "Kab / Kota": "Nias Utara",
    "Rata-rata IR": -0.108114,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.299674346,
    C2: 4.009946418,
    C3: 2.073332747,
    Cluster: 1
  },
  {
    NO: 32,
    "Kab / Kota": "Nias Barat",
    "Rata-rata IR": -0.50409,
    "Rata-rata CFR": 0.869046,
    "Rata-rata ABJ": -0.797694,
    C1: 1.349101405,
    C2: 3.51197504,
    C3: 2.480966864,
    Cluster: 1
  },
  {
    NO: 33,
    "Kab / Kota": "Gunungsitoli",
    "Rata-rata IR": 4.370392,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 4.778180229,
    C2: 4.21122441,
    C3: 5.060867727,
    Cluster: 2
  }
]
</script>

<script>
  const dataManhattan = [
  {
    NO: 1,
    "Kab / Kota": "Medan",
    "Rata-rata IR": 0.437159,
    "Rata-rata CFR": -0.200179,
    "Rata-rata ABJ": 1.371171,
    C1: 3.290247205,
    C2: 4.026761676,
    C3: 1.062291308,
    Cluster: 3
  },
  {
    NO: 2,
    "Kab / Kota": "Pematang Siantar",
    "Rata-rata IR": 1.946397,
    "Rata-rata CFR": 2.250813,
    "Rata-rata ABJ": 1.304639,
    C1: 7.183943725,
    C2: 0,
    C3: 4.955987827,
    Cluster: 2
  },
  {
    NO: 3,
    "Kab / Kota": "Binjai",
    "Rata-rata IR": 0.588861,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.366639,
    C1: 3.160981029,
    C2: 4.146962587,
    C3: 0.933025131,
    Cluster: 3
  },
  {
    NO: 4,
    "Kab / Kota": "Tanjung Balai",
    "Rata-rata IR": 0.381608,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.33661,
    C1: 2.923699442,
    C2: 4.324186785,
    C3: 0.695743544,
    Cluster: 3
  },
  {
    NO: 5,
    "Kab / Kota": "Tebing Tinggi",
    "Rata-rata IR": 0.670848,
    "Rata-rata CFR": 0.046289,
    "Rata-rata ABJ": 1.281879,
    C1: 3.681109963,
    C2: 3.502833762,
    C3: 1.453154065,
    Cluster: 3
  },
  {
    NO: 6,
    "Kab / Kota": "Sibolga",
    "Rata-rata IR": 0.869833,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 1.27762085,
    C2: 5.906322875,
    C3: 3.186825771,
    Cluster: 1
  },
  {
    NO: 7,
    "Kab / Kota": "Padang Sidempuan",
    "Rata-rata IR": -0.537399,
    "Rata-rata CFR": -0.000026,
    "Rata-rata ABJ": -0.797694,
    C1: 0.606198887,
    C2: 6.836966888,
    C3: 2.834154785,
    Cluster: 1
  },
  {
    NO: 8,
    "Kab / Kota": "Deli Serdang",
    "Rata-rata IR": 0.196424,
    "Rata-rata CFR": -0.429219,
    "Rata-rata ABJ": -0.797694,
    C1: 0.651606813,
    C2: 6.532336912,
    C3: 2.560811734,
    Cluster: 1
  },
  {
    NO: 9,
    "Kab / Kota": "Langkat",
    "Rata-rata IR": -0.260413,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.147374737,
    C2: 7.036568988,
    C3: 2.08058116,
    Cluster: 1
  },
  {
    NO: 10,
    "Kab / Kota": "Karo",
    "Rata-rata IR": -0.54974,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.141952163,
    C2: 7.325895888,
    C3: 2.369908061,
    Cluster: 1
  },
  {
    NO: 11,
    "Kab / Kota": "Simalungun",
    "Rata-rata IR": 0.152267,
    "Rata-rata CFR": -0.071725,
    "Rata-rata ABJ": -0.797694,
    C1: 0.964943303,
    C2: 6.219000423,
    C3: 2.874148224,
    Cluster: 1
  },
  {
    NO: 12,
    "Kab / Kota": "Asahan",
    "Rata-rata IR": -0.472583,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.114322,
    C1: 1.976810867,
    C2: 5.336723173,
    C3: 0.380735345,
    Cluster: 3
  },
  {
    NO: 13,
    "Kab / Kota": "Labuhan Batu",
    "Rata-rata IR": -0.248412,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.270887,
    C1: 2.227955898,
    C2: 4.955987827,
    C3: 0,
    Cluster: 3
  },
  {
    NO: 14,
    "Kab / Kota": "Tapanuli Utara",
    "Rata-rata IR": -0.682505,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.292354,
    C1: 2.364764861,
    C2: 5.368613659,
    C3: 0.45555994,
    Cluster: 3
  },
  {
    NO: 15,
    "Kab / Kota": "Tapanuli Tengah",
    "Rata-rata IR": -0.448037,
    "Rata-rata CFR": -0.290628,
    "Rata-rata ABJ": 1.380992,
    C1: 2.404920644,
    C2: 5.012228679,
    C3: 0.495715723,
    Cluster: 3
  },
  {
    NO: 16,
    "Kab / Kota": "Tapanuli Selatan",
    "Rata-rata IR": -0.838646,
    "Rata-rata CFR": 4.09863,
    "Rata-rata ABJ": -0.797694,
    C1: 5.006101289,
    C2: 6.735191811,
    C3: 7.234057186,
    Cluster: 1
  },
  {
    NO: 17,
    "Kab / Kota": "Nias",
    "Rata-rata IR": 0.310717,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.718505049,
    C2: 6.465438676,
    C3: 2.62770997,
    Cluster: 1
  },
  {
    NO: 18,
    "Kab / Kota": "Dairi",
    "Rata-rata IR": -0.598853,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.191064752,
    C2: 7.375008477,
    C3: 2.41902065,
    Cluster: 1
  },
  {
    NO: 19,
    "Kab / Kota": "Toba",
    "Rata-rata IR": 0.037314,
    "Rata-rata CFR": 1.468993,
    "Rata-rata ABJ": 0.49269,
    C1: 3.681093075,
    C2: 3.50285065,
    C3: 3.009530051,
    Cluster: 3
  },
  {
    NO: 20,
    "Kab / Kota": "Mandailing Natal",
    "Rata-rata IR": -0.816673,
    "Rata-rata CFR": 1.811008,
    "Rata-rata ABJ": 1.303182,
    C1: 4.797382613,
    C2: 3.20433202,
    C3: 2.888177692,
    Cluster: 3
  },
  {
    NO: 21,
    "Kab / Kota": "Nias Selatan",
    "Rata-rata IR": -0.613566,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.205777888,
    C2: 7.389721613,
    C3: 2.433733786,
    Cluster: 1
  },
  {
    NO: 22,
    "Kab / Kota": "Pak-Pak Bharat",
    "Rata-rata IR": 1.108835,
    "Rata-rata CFR": -0.213668,
    "Rata-rata ABJ": -0.797694,
    C1: 1.779567981,
    C2: 5.404375744,
    C3: 3.688772902,
    Cluster: 1
  },
  {
    NO: 23,
    "Kab / Kota": "Humbahas",
    "Rata-rata IR": -0.853394,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.445606124,
    C2: 7.629549849,
    C3: 2.673562022,
    Cluster: 1
  },
  {
    NO: 24,
    "Kab / Kota": "Samosir",
    "Rata-rata IR": -0.407788,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0,
    C2: 7.183943725,
    C3: 2.227955898,
    Cluster: 1
  },
  {
    NO: 25,
    "Kab / Kota": "Serdang Bedagai",
    "Rata-rata IR": -0.703279,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.370416,
    C1: 2.463600351,
    C2: 5.442879401,
    C3: 0.55439543,
    Cluster: 3
  },
  {
    NO: 26,
    "Kab / Kota": "Batubara",
    "Rata-rata IR": -0.127566,
    "Rata-rata CFR": 0.192934,
    "Rata-rata ABJ": 1.068089,
    C1: 2.815552343,
    C2: 4.368391382,
    C3: 0.993191559,
    Cluster: 3
  },
  {
    NO: 27,
    "Kab / Kota": "Padang Lawas",
    "Rata-rata IR": -0.322938,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.084850132,
    C2: 7.099093593,
    C3: 2.143105765,
    Cluster: 1
  },
  {
    NO: 28,
    "Kab / Kota": "Padang Lawas Utara",
    "Rata-rata IR": -0.66561,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.257822525,
    C2: 7.44176625,
    C3: 2.485778423,
    Cluster: 1
  },
  {
    NO: 29,
    "Kab / Kota": "Labuhan Batu Selatan",
    "Rata-rata IR": -0.793494,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.385705883,
    C2: 7.569649608,
    C3: 2.613661781,
    Cluster: 1
  },
  {
    NO: 30,
    "Kab / Kota": "Labuhan Batu Utara",
    "Rata-rata IR": -0.517554,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.109765835,
    C2: 7.29370956,
    C3: 2.337721733,
    Cluster: 1
  },
  {
    NO: 31,
    "Kab / Kota": "Nias Utara",
    "Rata-rata IR": -0.108114,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.299674346,
    C2: 6.884269379,
    C3: 2.208879267,
    Cluster: 1
  },
  {
    NO: 32,
    "Kab / Kota": "Nias Barat",
    "Rata-rata IR": -0.50409,
    "Rata-rata CFR": 0.869046,
    "Rata-rata ABJ": -0.797694,
    C1: 1.441962371,
    C2: 5.934586402,
    C3: 3.669918269,
    Cluster: 1
  },
  {
    NO: 33,
    "Kab / Kota": "Gunungsitoli",
    "Rata-rata IR": 4.370392,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 4.778180229,
    C2: 7.253754382,
    C3: 6.68738515,
    Cluster: 1
  }
]
</script>

<script>
  const dataMinc = [
  {
    NO: 1,
    "Kab / Kota": "Medan",
    "Rata-rata IR": 0.437159,
    "Rata-rata CFR": -0.200179,
    "Rata-rata ABJ": 1.371171,
    C1: 2.212235464,
    C2: 2.628581178,
    C3: 0.700922225,
    Cluster: 3
  },
  {
    NO: 2,
    "Kab / Kota": "Pematang Siantar",
    "Rata-rata IR": 1.946397,
    "Rata-rata CFR": 2.250813,
    "Rata-rata ABJ": 1.304639,
    C1: 3.493270183,
    C2: 0,
    C3: 3.136704879,
    Cluster: 2
  },
  {
    NO: 3,
    "Kab / Kota": "Binjai",
    "Rata-rata IR": 0.588861,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.366639,
    C1: 2.232602329,
    C2: 2.835225912,
    C3: 0.837690482,
    Cluster: 3
  },
  {
    NO: 4,
    "Kab / Kota": "Tanjung Balai",
    "Rata-rata IR": 0.381608,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.33661,
    C1: 2.16970874,
    C2: 2.889316718,
    C3: 0.630258685,
    Cluster: 3
  },
  {
    NO: 5,
    "Kab / Kota": "Tebing Tinggi",
    "Rata-rata IR": 0.670848,
    "Rata-rata CFR": 0.046289,
    "Rata-rata ABJ": 1.281879,
    C1: 2.182175437,
    C2: 2.33855571,
    C3: 0.972514154,
    Cluster: 3
  },
  {
    NO: 6,
    "Kab / Kota": "Sibolga",
    "Rata-rata IR": 0.869833,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 1.27762085,
    C2: 3.135578697,
    C3: 2.172229609,
    Cluster: 1
  },
  {
    NO: 7,
    "Kab / Kota": "Padang Sidempuan",
    "Rata-rata IR": -0.537399,
    "Rata-rata CFR": -0.000026,
    "Rata-rata ABJ": -0.797694,
    C1: 0.479762026,
    C2: 3.302489573,
    C3: 2.078842084,
    Cluster: 1
  },
  {
    NO: 8,
    "Kab / Kota": "Deli Serdang",
    "Rata-rata IR": 0.196424,
    "Rata-rata CFR": -0.429219,
    "Rata-rata ABJ": -0.797694,
    C1: 0.604309596,
    C2: 3.236449716,
    C3: 2.075423078,
    Cluster: 1
  },
  {
    NO: 9,
    "Kab / Kota": "Langkat",
    "Rata-rata IR": -0.260413,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.147374737,
    C2: 3.429274689,
    C3: 2.068580544,
    Cluster: 1
  },
  {
    NO: 10,
    "Kab / Kota": "Karo",
    "Rata-rata IR": -0.54974,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.141952163,
    C2: 3.560407313,
    C3: 2.070709548,
    Cluster: 1
  },
  {
    NO: 11,
    "Kab / Kota": "Simalungun",
    "Rata-rata IR": 0.152267,
    "Rata-rata CFR": -0.071725,
    "Rata-rata ABJ": -0.797694,
    C1: 0.623204619,
    C2: 3.021884944,
    C3: 2.078712298,
    Cluster: 1
  },
  {
    NO: 12,
    "Kab / Kota": "Asahan",
    "Rata-rata IR": -0.472583,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.114322,
    C1: 1.912040513,
    C2: 3.253854226,
    C3: 0.247183992,
    Cluster: 3
  },
  {
    NO: 13,
    "Kab / Kota": "Labuhan Batu",
    "Rata-rata IR": -0.248412,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.270887,
    C1: 2.068895715,
    C2: 3.136704879,
    C3: 0,
    Cluster: 3
  },
  {
    NO: 14,
    "Kab / Kota": "Tapanuli Utara",
    "Rata-rata IR": -0.682505,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.292354,
    C1: 2.091628334,
    C2: 3.375417014,
    C3: 0.434110385,
    Cluster: 3
  },
  {
    NO: 15,
    "Kab / Kota": "Tapanuli Tengah",
    "Rata-rata IR": -0.448037,
    "Rata-rata CFR": -0.290628,
    "Rata-rata ABJ": 1.380992,
    C1: 2.179141884,
    C2: 3.11217772,
    C3: 0.250522957,
    Cluster: 3
  },
  {
    NO: 16,
    "Kab / Kota": "Tapanuli Selatan",
    "Rata-rata IR": -0.838646,
    "Rata-rata CFR": 4.09863,
    "Rata-rata ABJ": -0.797694,
    C1: 4.576516781,
    C2: 3.338310939,
    C3: 4.715146976,
    Cluster: 2
  },
  {
    NO: 17,
    "Kab / Kota": "Nias",
    "Rata-rata IR": 0.310717,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.718505049,
    C2: 3.238245535,
    C3: 2.082108428,
    Cluster: 1
  },
  {
    NO: 18,
    "Kab / Kota": "Dairi",
    "Rata-rata IR": -0.598853,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.191064752,
    C2: 3.584856718,
    C3: 2.071927545,
    Cluster: 1
  },
  {
    NO: 19,
    "Kab / Kota": "Toba",
    "Rata-rata IR": 0.037314,
    "Rata-rata CFR": 1.468993,
    "Rata-rata ABJ": 0.49269,
    C1: 2.125439786,
    C2: 1.997580558,
    C3: 1.988219763,
    Cluster: 3
  },
  {
    NO: 20,
    "Kab / Kota": "Mandailing Natal",
    "Rata-rata IR": -0.816673,
    "Rata-rata CFR": 1.811008,
    "Rata-rata ABJ": 1.303182,
    C1: 2.772544566,
    C2: 2.766779541,
    C3: 2.29925301,
    Cluster: 3
  },
  {
    NO: 21,
    "Kab / Kota": "Nias Selatan",
    "Rata-rata IR": -0.613566,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.205777888,
    C2: 3.592301105,
    C3: 2.072366276,
    Cluster: 1
  },
  {
    NO: 22,
    "Kab / Kota": "Pak-Pak Bharat",
    "Rata-rata IR": 1.108835,
    "Rata-rata CFR": -0.213668,
    "Rata-rata ABJ": -0.797694,
    C1: 1.519253013,
    C2: 2.918075582,
    C3: 2.248634613,
    Cluster: 1
  },
  {
    NO: 23,
    "Kab / Kota": "Humbahas",
    "Rata-rata IR": -0.853394,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.445606124,
    C2: 3.721181338,
    C3: 2.085687408,
    Cluster: 1
  },
  {
    NO: 24,
    "Kab / Kota": "Samosir",
    "Rata-rata IR": -0.407788,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0,
    C2: 3.493270183,
    C3: 2.068895715,
    Cluster: 1
  },
  {
    NO: 25,
    "Kab / Kota": "Serdang Bedagai",
    "Rata-rata IR": -0.703279,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.370416,
    C1: 2.169937503,
    C2: 3.388078513,
    C3: 0.456449252,
    Cluster: 3
  },
  {
    NO: 26,
    "Kab / Kota": "Batubara",
    "Rata-rata IR": -0.127566,
    "Rata-rata CFR": 0.192934,
    "Rata-rata ABJ": 1.068089,
    C1: 1.896134385,
    C2: 2.603587775,
    C3: 0.676978889,
    Cluster: 3
  },
  {
    NO: 27,
    "Kab / Kota": "Padang Lawas",
    "Rata-rata IR": -0.322938,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.084850132,
    C2: 3.455703654,
    C3: 2.068612653,
    Cluster: 1
  },
  {
    NO: 28,
    "Kab / Kota": "Padang Lawas Utara",
    "Rata-rata IR": -0.66561,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.257822525,
    C2: 3.619072111,
    C3: 2.074221678,
    Cluster: 1
  },
  {
    NO: 29,
    "Kab / Kota": "Labuhan Batu Selatan",
    "Rata-rata IR": -0.793494,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.385705883,
    C2: 3.687691903,
    C3: 2.081120132,
    Cluster: 1
  },
  {
    NO: 30,
    "Kab / Kota": "Labuhan Batu Utara",
    "Rata-rata IR": -0.517554,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.109765835,
    C2: 3.544721335,
    C3: 2.070098007,
    Cluster: 1
  },
  {
    NO: 31,
    "Kab / Kota": "Nias Utara",
    "Rata-rata IR": -0.108114,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.299674346,
    C2: 3.369418375,
    C3: 2.068795515,
    Cluster: 1
  },
  {
    NO: 32,
    "Kab / Kota": "Nias Barat",
    "Rata-rata IR": -0.50409,
    "Rata-rata CFR": 0.869046,
    "Rata-rata ABJ": -0.797694,
    C1: 1.345824234,
    C2: 2.986792751,
    C3: 2.244344149,
    Cluster: 1
  },
  {
    NO: 33,
    "Kab / Kota": "Gunungsitoli",
    "Rata-rata IR": 4.370392,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 4.778180229,
    C2: 3.525624863,
    C3: 4.753163081,
    Cluster: 2
  }
]
</script>

<script>
  const dataChe = [
  {
    NO: 1,
    "Kab / Kota": "Medan",
    "Rata-rata IR": 0.437159,
    "Rata-rata CFR": -0.200179,
    "Rata-rata ABJ": 1.371171,
    C1: 2.168864916,
    C2: 2.450991642,
    C3: 0.685571842,
    Cluster: 3
  },
  {
    NO: 2,
    "Kab / Kota": "Pematang Siantar",
    "Rata-rata IR": 1.946397,
    "Rata-rata CFR": 2.250813,
    "Rata-rata ABJ": 1.304639,
    C1: 2.727426601,
    C2: 0,
    C3: 2.727426601,
    Cluster: 2
  },
  {
    NO: 3,
    "Kab / Kota": "Binjai",
    "Rata-rata IR": 0.588861,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.366639,
    C1: 2.164332283,
    C2: 2.727426601,
    C3: 0.837273257,
    Cluster: 3
  },
  {
    NO: 4,
    "Kab / Kota": "Tanjung Balai",
    "Rata-rata IR": 0.381608,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.33661,
    C1: 2.134303589,
    C2: 2.727426601,
    C3: 0.630020365,
    Cluster: 3
  },
  {
    NO: 5,
    "Kab / Kota": "Tebing Tinggi",
    "Rata-rata IR": 0.670848,
    "Rata-rata CFR": 0.046289,
    "Rata-rata ABJ": 1.281879,
    C1: 2.079572045,
    C2: 2.204524558,
    C3: 0.919260387,
    Cluster: 3
  },
  {
    NO: 6,
    "Kab / Kota": "Sibolga",
    "Rata-rata IR": 0.869833,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 1.27762085,
    C2: 2.727426601,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 7,
    "Kab / Kota": "Padang Sidempuan",
    "Rata-rata IR": -0.537399,
    "Rata-rata CFR": -0.000026,
    "Rata-rata ABJ": -0.797694,
    C1: 0.476587862,
    C2: 2.483795811,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 8,
    "Kab / Kota": "Deli Serdang",
    "Rata-rata IR": 0.196424,
    "Rata-rata CFR": -0.429219,
    "Rata-rata ABJ": -0.797694,
    C1: 0.604212408,
    C2: 2.680032196,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 9,
    "Kab / Kota": "Langkat",
    "Rata-rata IR": -0.260413,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.147374737,
    C2: 2.727426601,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 10,
    "Kab / Kota": "Karo",
    "Rata-rata IR": -0.54974,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.141952163,
    C2: 2.727426601,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 11,
    "Kab / Kota": "Simalungun",
    "Rata-rata IR": 0.152267,
    "Rata-rata CFR": -0.071725,
    "Rata-rata ABJ": -0.797694,
    C1: 0.560054499,
    C2: 2.322537798,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 12,
    "Kab / Kota": "Asahan",
    "Rata-rata IR": -0.472583,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.114322,
    C1: 1.912015709,
    C2: 2.727426601,
    C3: 0.224170645,
    Cluster: 3
  },
  {
    NO: 13,
    "Kab / Kota": "Labuhan Batu",
    "Rata-rata IR": -0.248412,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.270887,
    C1: 2.068580409,
    C2: 2.727426601,
    C3: 0,
    Cluster: 3
  },
  {
    NO: 14,
    "Kab / Kota": "Tapanuli Utara",
    "Rata-rata IR": -0.682505,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.292354,
    C1: 2.090047463,
    C2: 2.727426601,
    C3: 0.434092886,
    Cluster: 3
  },
  {
    NO: 15,
    "Kab / Kota": "Tapanuli Tengah",
    "Rata-rata IR": -0.448037,
    "Rata-rata CFR": -0.290628,
    "Rata-rata ABJ": 1.380992,
    C1: 2.178685621,
    C2: 2.541441094,
    C3: 0.199625005,
    Cluster: 3
  },
  {
    NO: 16,
    "Kab / Kota": "Tapanuli Selatan",
    "Rata-rata IR": -0.838646,
    "Rata-rata CFR": 4.09863,
    "Rata-rata ABJ": -0.797694,
    C1: 4.575243479,
    C2: 2.785042596,
    C3: 4.575243479,
    Cluster: 2
  },
  {
    NO: 17,
    "Kab / Kota": "Nias",
    "Rata-rata IR": 0.310717,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.718505049,
    C2: 2.727426601,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 18,
    "Kab / Kota": "Dairi",
    "Rata-rata IR": -0.598853,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.191064752,
    C2: 2.727426601,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 19,
    "Kab / Kota": "Toba",
    "Rata-rata IR": 0.037314,
    "Rata-rata CFR": 1.468993,
    "Rata-rata ABJ": 0.49269,
    C1: 1.945606921,
    C2: 1.909082605,
    C3: 1.945606921,
    Cluster: 2
  },
  {
    NO: 20,
    "Kab / Kota": "Mandailing Natal",
    "Rata-rata IR": -0.816673,
    "Rata-rata CFR": 1.811008,
    "Rata-rata ABJ": 1.303182,
    C1: 2.287621739,
    C2: 2.76307024,
    C3: 2.287621739,
    Cluster: 1
  },
  {
    NO: 21,
    "Kab / Kota": "Nias Selatan",
    "Rata-rata IR": -0.613566,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.205777888,
    C2: 2.727426601,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 22,
    "Kab / Kota": "Pak-Pak Bharat",
    "Rata-rata IR": 1.108835,
    "Rata-rata CFR": -0.213668,
    "Rata-rata ABJ": -0.797694,
    C1: 1.516622954,
    C2: 2.464481574,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 23,
    "Kab / Kota": "Humbahas",
    "Rata-rata IR": -0.853394,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.445606124,
    C2: 2.79979091,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 24,
    "Kab / Kota": "Samosir",
    "Rata-rata IR": -0.407788,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0,
    C2: 2.727426601,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 25,
    "Kab / Kota": "Serdang Bedagai",
    "Rata-rata IR": -0.703279,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": 1.370416,
    C1: 2.168109477,
    C2: 2.727426601,
    C3: 0.454866362,
    Cluster: 3
  },
  {
    NO: 26,
    "Kab / Kota": "Batubara",
    "Rata-rata IR": -0.127566,
    "Rata-rata CFR": 0.192934,
    "Rata-rata ABJ": 1.068089,
    C1: 1.865782852,
    C2: 2.073963122,
    C3: 0.669547826,
    Cluster: 3
  },
  {
    NO: 27,
    "Kab / Kota": "Padang Lawas",
    "Rata-rata IR": -0.322938,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.084850132,
    C2: 2.727426601,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 28,
    "Kab / Kota": "Padang Lawas Utara",
    "Rata-rata IR": -0.66561,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.257822525,
    C2: 2.727426601,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 29,
    "Kab / Kota": "Labuhan Batu Selatan",
    "Rata-rata IR": -0.793494,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.385705883,
    C2: 2.739890669,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 30,
    "Kab / Kota": "Labuhan Batu Utara",
    "Rata-rata IR": -0.517554,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.109765835,
    C2: 2.727426601,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 31,
    "Kab / Kota": "Nias Utara",
    "Rata-rata IR": -0.108114,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 0.299674346,
    C2: 2.727426601,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 32,
    "Kab / Kota": "Nias Barat",
    "Rata-rata IR": -0.50409,
    "Rata-rata CFR": 0.869046,
    "Rata-rata ABJ": -0.797694,
    C1: 1.345659847,
    C2: 2.45048731,
    C3: 2.068580409,
    Cluster: 1
  },
  {
    NO: 33,
    "Kab / Kota": "Gunungsitoli",
    "Rata-rata IR": 4.370392,
    "Rata-rata CFR": -0.476613,
    "Rata-rata ABJ": -0.797694,
    C1: 4.778180229,
    C2: 2.727426601,
    C3: 4.618804741,
    Cluster: 2
  }
]
</script>
<script>
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
  console.log(dataKabKota)

  dataKabKota = dataKabKota.map(item => {
    const result = dataMinc.filter(element => item.kab_kota_id == element.NO)[0]
    return {...item, cluster: result.Cluster}
  })

  console.log(dataKabKota)

  const url = "http://localhost:5000/pam";
  const data = dataKabKota;

  let colorClaster = addColorClaster(dataKabKota);
  console.log(colorClaster)
  extractGeoJsonAndDisplay(dataKabKota, colorClaster);

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
    result.forEach(function(item, index) {
      // const colorMap = ["#54B435", "#82CD47", "#F0FF42"];
      const colorMap = ["#54B435", "#F0FF42", "#FF7F4F"];
      item.color = colorMap[index];
    });
    return result;
  }

  function extractGeoJsonAndDisplay(data, colorClaster) {
    return new Promise(async (resolve, reject) => {
      try {
        let features = [];
        let cluster = [0,0,0,0]
        data.forEach(async (data, i, arr) => {
          const styleGis = style(data, colorClaster);
          cluster[data.cluster]++
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
              (data.ABJ && data.ABJ > 0 ? data.ABJ : "-") +
              "<br/>Cluster: " + data.cluster
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
        console.log(cluster
        )
      } catch (error) {
        reject(error);
      }
    });
  }

  function getColor(data, colorClaster) {
    let color = "";
    colorClaster.forEach((item) => {
      if (data.cluster == item.cluster) {
        color = item.color;
      }
    });
    return color;
  }

  function style(data, colorClaster) {
    return {
      fillColor: getColor(data, colorClaster)
      , color: "#379237"
      , weight: "1"
      , opacity: "0.4"
      , fillOpacity: "0.7"
    , };
  }

</script>



@endsection

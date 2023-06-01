fetchdataGrafikIfCfr();

fetchdataGrafikAbj(new Date().getFullYear());

function fetchdataGrafikIfCfr() {
  fetch(document.getElementById("urlGrafikCfrIr").getAttribute("data-url"))
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      displayGrafik({
        label: ["Incident Rate (Kasus DBD/Jumlah Penduduk x 100.000)"],
        data: {
          labels: data.labels,
          data: [data.ir],
        },
        elSelect: "#ir_grafik",
        backgroundColor: ["rgba(54, 162, 235, 0.5)"],
        borderColor: ["rgba(54, 162, 235, 1)"],
      });

      displayGrafik({
        label: ["Case Fatality Rate (%)"],
        data: {
          labels: data.labels,
          data: [data.cfr],
        },
        elSelect: "#cfr_grafik",
        backgroundColor: ["rgba(219, 0, 91, 0.5)"],
        borderColor: ["rgba(219, 0, 91,1)"],
      });

      displayGrafik({
        label: ["Kasus DBD", "Kasus Meninggal DBD"],
        data: {
          labels: data.labels,
          data: [data.kasus_total, data.meniggal_total],
        },
        elSelect: "#kasus_grafik",
        backgroundColor: ["rgba(255, 229, 105, 0.5)", "rgba(183, 4, 4, 0.5)"],
        borderColor: ["rgba(255, 229, 105, 1)", "rgba(183, 4, 4,1)"],
      });
    })
    .catch((error) => console.log(error));
}

function fetchdataGrafikAbj(tahun) {
  fetch(
    document.getElementById("urlgrafikAbj").getAttribute("data-url") + tahun
  )
    .then((response) => response.json())
    .then((data) => {
      displayGrafik({
        label: ["Angka Bebas Jentik"],
        data: {
          labels: data.labels,
          data: [data.abj],
        },
        elSelect: "#abj_grafik",
        backgroundColor: ["rgba(232, 170, 66, 0.5)"],
        borderColor: ["rgba(232, 170, 66, 1)"],
      });
    })
    .catch((error) => console.log(error));
}

function displayGrafik({
  data,
  elSelect,
  backgroundColor,
  borderColor,
  label,
}) {
  const el = $(elSelect).get(0).getContext("2d");
  const barChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    datasetFill: false,
  };
  dataSets = [];
  for (let o = 0; o < data.data.length; o++) {
    const element = data.data[o];
    dataSets.push({
      label: label[o],
      data: data.data[o],
      backgroundColor: backgroundColor[o],
      borderColor: borderColor[o],
      borderWidth: 1,
    });
  }
  const irGrafik = new Chart(el, {
    type: "bar",
    data: {
      labels: data.labels,
      datasets: dataSets,
    },
    options: barChartOptions,
  });
}

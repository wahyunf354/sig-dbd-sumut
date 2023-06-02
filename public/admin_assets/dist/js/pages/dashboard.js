document.addEventListener("DOMContentLoaded", () => {
  // Grafik Kasus per kab
  fetch(
    document
      .getElementById("urlDataGrafikKasusPerKabKota")
      .getAttribute("data-url")
  )
    .then((res) => res.json())
    .then((data) => {
      displayGrafik({
        label: ["Kasus DBD"],
        data: {
          labels: data.labels,
          data: [data.kasus],
        },
        elSelect: "#el_grafik_kasus",
        backgroundColor: ["rgb(0, 121, 255, 0.5)"],
        borderColor: ["rgb(0, 121, 255,1)"],
      });
    });

  // Grafik IR per kab
  fetch(
    document
      .getElementById("urlDataGrafikIrPerKabKota")
      .getAttribute("data-url")
  )
    .then((res) => res.json())
    .then((data) => {
      displayGrafik({
        label: ["Incident Rate DBD"],
        data: {
          labels: data.labels,
          data: [data.data],
        },
        elSelect: "#el_grafik_ir",
        backgroundColor: ["rgb(0, 121, 255, 0.5)"],
        borderColor: ["rgb(0, 121, 255,1)"],
      });
    });

  // Grafik CFR per kab
  fetch(
    document
      .getElementById("urlDataGrafikCfrPerKabKota")
      .getAttribute("data-url")
  )
    .then((res) => res.json())
    .then((data) => {
      displayGrafik({
        label: ["Case Fatality Rate DBD"],
        data: {
          labels: data.labels,
          data: [data.data],
        },
        elSelect: "#el_grafik_cfr",
        backgroundColor: ["rgb(255, 0, 96, 0.5)"],
        borderColor: ["rgb(255, 0, 96, 1)"],
      });
    });

  // Grafik ABJ per kab
  fetch(
    document
      .getElementById("urlDataGrafikAbjPerKabKota")
      .getAttribute("data-url")
  )
    .then((res) => res.json())
    .then((data) => {
      displayGrafik({
        label: ["Angka Bebas Jentik DBD"],
        data: {
          labels: data.labels,
          data: [data.data],
        },
        elSelect: "#el_grafik_abj",
        backgroundColor: ["rgb(0, 223, 162, 0.5)"],
        borderColor: ["rgb(0, 223, 162)"],
      });
    });
});

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

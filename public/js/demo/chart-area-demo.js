// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}
//test multiline
var datasets = [];
for (var i = 0; i < dataArray.length; i++) {
  datasets.push({
    label: "Total",
    lineTension: 0,
    backgroundColor: "rgba(78, 115, 223, 0.05)",
    borderColor: "rgba(78, 115, 223, 1)",
    pointRadius: 3,
    pointBackgroundColor: "rgba(78, 115, 223, 1)",
    pointBorderColor: "rgba(78, 115, 223, 1)",
    pointHoverRadius: 3,
    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
    pointHitRadius: 10,
    pointBorderWidth: 2,
    data: dataArray[i]
  });
}


// Area Chart Ramalan

var ctx = document.getElementById("myAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: chartDataGrafik.label, //.concat(chartDataGrafikBaru.label),
    datasets: [
                {
                  label: "Total",
                  lineTension: 0, // mengatur kelengkungan garis
                  backgroundColor: "rgba(78, 115, 223, 0.05)",
                  borderColor: "rgba(78, 115, 223, 1)",
                  pointRadius: 3,
                  pointBackgroundColor: "rgba(78, 115, 223, 1)",
                  pointBorderColor: "rgba(78, 115, 223, 1)",
                  pointHoverRadius: 3,
                  pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                  pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                  pointHitRadius: 10,
                  pointBorderWidth: 2,
                  data: chartDataGrafik.data, //.concat(chartDataGrafikBaru.data),
                }
            ],
},
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7,
          autoSkip: false
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'stok ' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' stok';
        }
      }
    }
  }
});


// Area Chart Keuangan

var ctx = document.getElementById("chartKeuangan");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: chartDataGrafik.label, //.concat(chartDataGrafikBaru.label),
    datasets: [{
      label: "Total",
      lineTension: 0, // mengatur kelengkungan garis
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: chartDataGrafik.data, //.concat(chartDataGrafikBaru.data),
    }],
},
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7,
          autoSkip: false
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return 'stok ' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel) + ' stok';
        }
      }
    }
  }
});






// //-------------------------------------//
// // Mengambil data dari beberapa label
// var labels = myLineChart.data.labels;

// // Membuat variabel untuk menampung elemen HTML
// var labelList = "";

// // Menambahkan elemen HTML ke dalam variabel labelList menggunakan forEach()
// labels.forEach(function(label) {
//   labelList += "<li>" + label + "</li>";
// });

// // Menambahkan labelList ke dalam elemen HTML dengan id "label-list"
// document.getElementById("label-list").innerHTML = labelList;

// // Ambil elemen HTML dengan id "data-chart"
// const dataChart = document.getElementById("data-chart");

// // Ambil nilai data dari chart
// const chartData = myLineChart.data.datasets[0].data;

// // Tambahkan nilai data ke dalam elemen HTML
// dataChart.innerHTML = chartData.join(", ");



// //-----------------------------------------//
// // get the current date
// var currentDate = new Date();

// // get the date, month, and year from the current date
// var date = currentDate.getDate();
// var month = currentDate.getMonth() + 1;
// var year = currentDate.getFullYear();

// // display the date, month, and year in the input fields
// document.getElementById("date").value = date;
// document.getElementById("month").value = month;
// document.getElementById("year").value = year;
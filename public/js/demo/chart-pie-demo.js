// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx1 = document.getElementById("pieChartDate");
var ctx2 = document.getElementById("pieChartMonth");
var ctx3 = document.getElementById("pieChartYear");

function pieChartShow(_ctx) {
    var myPieChart = new Chart(_ctx, {
    //   type: 'doughnut',
      type: 'pie',
      data: {
        labels: ["Online", "Walk-in"],
        datasets: [{
          data: [55, 30],
          backgroundColor: ['#4e73df', '#1cc88a'],
          hoverBackgroundColor: ['#2e59d9', '#17a673'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: true,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 10,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 0,
      },
    });
}

pieChartShow(ctx1)
pieChartShow(ctx2)
pieChartShow(ctx3)

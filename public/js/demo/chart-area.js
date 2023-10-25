// Set new default font family and font color to mimic Bootstrap's default styling
(Chart.defaults.global.defaultFontFamily = "Kanit");
Chart.defaults.global.defaultFontColor = "#858796";

function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');
    // *     return: '1 234,56'
    number = (number + "").replace(",", "").replace(" ", "");
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = typeof thousands_sep === "undefined" ? "," : thousands_sep,
        dec = typeof dec_point === "undefined" ? "." : dec_point,
        s = "",
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return "" + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : "" + Math.round(n)).split(".");
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || "").length < prec) {
        s[1] = s[1] || "";
        s[1] += new Array(prec - s[1].length + 1).join("0");
    }
    return s.join(dec);
}

const roomsData = JSON.parse(document.getElementById("data").getAttribute("roomsData"));
const bookingsData = JSON.parse(document.getElementById("data").getAttribute("bookingsData"));
const mouthNumbers = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];

let bar1 = document.getElementById("barChartDate");
let bar2 = document.getElementById("barChartMonth");
let pie1 = document.getElementById("pieChartDate");
let pie2 = document.getElementById("pieChartMonth");

let barDatasets1 = roomsData.map((room) => {
    return {
        label: `${room.name}`,
        data: mouthNumbers.map((month, ind) => {
            let tt = 0;
            for (let book of bookingsData) {
                if (room.id === book.room_id && month === book.month.toString()) {
                    tt += 1;
                }
            }
            return tt
        }),
        backgroundColor: `${room.color_code}`,
        borderWidth: 1,
        borderRadius: 10,
    };
});

let barDatasets2 = roomsData.map((room) => {
    return {
        label: `${room.name}`,
        data: mouthNumbers.map((month, ind) => {
            let tt = 0;
            for (let book of bookingsData) {
                if (room.id === book.room_id && month === book.month.toString()) {
                    tt += book.price;
                }
            }
            return tt
        }),
        backgroundColor: `${room.color_code}`,
        borderWidth: 1,
        borderRadius: 10,
    };
});

let pieDatasets1 = roomsData.map((room) => {

});

let pieDatasets2 = roomsData.map((room) => {
    return {
        label: `${room.name}`,
        data: mouthNumbers.map((month, ind) => {
            let tt = 0;
            for (let book of bookingsData) {
                if (room.id === book.room_id && month === book.month.toString()) {
                    tt += 1;
                }
            }
            return tt
        }),
        backgroundColor: `${room.color_code}`,
        borderWidth: 1,
        borderRadius: 10,
    };
});

let labelMonths = mouthNumbers.map(item => {
    return dayjs(`${item}`, { locale: "th" }).format("MMMM");
});

let labelRooms = roomsData.map(item => {
    return item.name;
});

let pieBgColor = roomsData.map(item => {
    return item.color_code;
});
console.log(pieBgColor)

let barChart1 = new Chart(bar1, {
    type: "bar",
    data: {
        labels: labelMonths,
        datasets: barDatasets1,
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0,
            },
        },
        scales: {
            xAxes: [
                {
                    time: {
                        unit: "date",
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        // maxTicksLimit: 12, //max labels
                    },
                },
            ],
            yAxes: [
                {
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return number_format(value) + " ครั้ง";
                        },
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2],
                    },
                },
            ],
        },
        legend: {
            display: true,
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: "#6e707e",
            titleFontSize: 14,
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: "index",
            caretPadding: 10,
            callbacks: {
                label: function (tooltipItem, chart) {
                    let datasetLabel =
                        chart.datasets[tooltipItem.datasetIndex].label ||
                        "";
                    return (
                        datasetLabel +
                        " " +
                        number_format(tooltipItem.yLabel) +
                        " ครั้ง"
                    );
                },
            },
        },
    },
});

let barChart2 = new Chart(bar2, {
    type: "bar",
    data: {
        labels: labelMonths,
        datasets: barDatasets2,
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0,
            },
        },
        scales: {
            xAxes: [
                {
                    time: {
                        unit: "date",
                    },
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        // maxTicksLimit: 12, //max labels
                    },
                },
            ],
            yAxes: [
                {
                    ticks: {
                        maxTicksLimit: 5,
                        padding: 10,
                        // Include a dollar sign in the ticks
                        callback: function (value, index, values) {
                            return number_format(value) + " บาท";
                        },
                    },
                    gridLines: {
                        color: "rgb(234, 236, 244)",
                        zeroLineColor: "rgb(234, 236, 244)",
                        drawBorder: false,
                        borderDash: [2],
                        zeroLineBorderDash: [2],
                    },
                },
            ],
        },
        legend: {
            display: true,
        },
        tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: "#6e707e",
            titleFontSize: 14,
            borderColor: "#dddfeb",
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: "index",
            caretPadding: 10,
            callbacks: {
                label: function (tooltipItem, chart) {
                    var datasetLabel =
                        chart.datasets[tooltipItem.datasetIndex].label ||
                        "";
                    return (
                        datasetLabel +
                        " " +
                        number_format(tooltipItem.yLabel) +
                        " บาท"
                    );
                },
            },
        },
    },
});

const pieChart1 = new Chart(pie1, {
    type: 'pie',
    data: {
      labels: labelRooms,
      datasets: [{
        data: [55, 30, 30],
        backgroundColor: pieBgColor,
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

  const pieChart2 = new Chart(pie2, {
    type: 'pie',
    data: {
      labels: labelRooms,
      datasets: [{
        data: [55, 30, 20],
        backgroundColor: pieBgColor,
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

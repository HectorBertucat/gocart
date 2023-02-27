// chart options
var chartOptions = {
  maintainAspectRatio: false,
  scales: {
      y: {
        stacked: true,
        grid: {
          display: true,
          color: "rgba(255,99,132,0.2)"
        }
      },
      x: {
        grid: {
          display: false
        }
      }
  }
};

var sellsDayOptions = {
  maintainAspectRatio: false,
  scales: {
      y: {
        stacked: true,
        grid: {
          display: true,
          color: "rgba(255,99,132,0.2)"
        }
      },
      x: {
        grid: {
          display: false
        }
      }
  },
  onClick: function(event, elements) {
    if (elements.length > 0) {
      const index = elements[0].index;
      // day = the monday of the selected date on the datepicker + the index of the selected bar
      day = new Date($("#datepicker").val());
      day.setDate(day.getDate() - day.getDay() + index + 1);
      // format date to yyyy-mm-dd
      day = day.getFullYear() + '-' + (day.getMonth() + 1 < 10 ? '0' + (day.getMonth() + 1) : day.getMonth() + 1) + '-' + (day.getDate() < 10 ? '0' + day.getDate() : day.getDate());
      getItemsSoldDay(day);
      $("#datepicker").val(day);

      const selectedElement = elements[0];
      const dataset = this.data.datasets[selectedElement.datasetIndex];
      const backgroundColor = dataset.backgroundColor;
      const selectedBackgroundColor = 'red';
      backgroundColor[selectedElement.index] = "rgba(0,99,132,0.8)";
      this.update();
    }
  }
};

function updateChart(chart, data) {
  chart.data = data;
  chart.update();
}

// ------------ creation of charts ------------

sells_day = new Chart('sells_day', {
  type: 'bar',
  options: sellsDayOptions,
  data: null,
});

sells_hour = new Chart('sells_hour', {
  type: 'bar',
  options: chartOptions,
  data: null
});

dataHours = Array(21).fill(0);
dataDays = Array(7).fill(0);

hoursLabels = ["8H", "9H", "10H", "11H", "12H", "13H", "13H", "14H", "15H", "16H", "17H", "18H", "19H", "20H", "21H"];
daysLabels = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];

// update amount sold per hour of selected day
function getItemsSoldDay(day) {
    var url = "index.php?controller=admin_dashboard&chart=items_sold_day&day=" + day;
    $.ajax({
        url: url,
        type: "GET",
        async: false,
        dataType: "json",
        success: function(data) {
            dataHours = [];
            data.forEach(element => {
                dataHours[element.hour-8] = element.amount;
            });
            var dataChartHours = {
                labels: hoursLabels,
                datasets: [{
                  label: "Ventes du jour",
                  backgroundColor: "rgba(34,139,34,0.2)",
                  borderColor: "rgba(0,100,0)",
                  borderWidth: 2,
                  hoverBackgroundColor: "rgba(34,139,34,0.2)",
                  hoverBorderColor: "rgba(0,100,0)",
                  data: dataHours,
                }]
              };

              updateChart(sells_hour, dataChartHours);
        }
        
    });
}

// update amount sold per day of selected week
function getItemsSoldWeek(day) {
    var url = "index.php?controller=admin_dashboard&chart=items_sold_week&day=" + day;
    $.ajax({
        url: url,
        type: "GET",
        async: false,
        dataType: "json",
        success: function(data) {
            dataDays = [];
            data.forEach(element => {
                dataDays[element.day] = element.amount;
            });
            var dataChartDays = {
                labels: daysLabels,
                datasets: [{
                    label: "Ventes de la semaine",
                    backgroundColor: "rgba(34,139,34,0.2)",
                    borderColor: "rgba(0,100,0)",
                    borderWidth: 2,
                    hoverBackgroundColor: "rgba(34,139,34,0.2)",
                    hoverBorderColor: "rgba(0,100,0)",
                    data: dataDays,
                }]
            };

            updateChart(sells_day, dataChartDays);
            
        }

    });
}

// on element with id datepicker change, update charts
$("#datepicker").change(function() {
    getItemsSoldDay($(this).val());
    getItemsSoldWeek($(this).val());
});

$(document).ready(function () {
  // get current date
  const today = new Date();
  // format date to yyyy-mm-dd
  const date = today.getFullYear() + '-' + (today.getMonth() + 1 < 10 ? '0' + (today.getMonth() + 1) : today.getMonth() + 1) + '-' + (today.getDate() < 10 ? '0' + today.getDate() : today.getDate());

  // set input "#datepicker" to today's date
  $("#datepicker").val(date);

  getItemsSoldDay(date);
  getItemsSoldWeek(date);
});
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
      day.setDate(day.getDate() - ((day.getDay() + 6) % 7) + index);
      // format date to yyyy-mm-dd
      day = day.getFullYear() + '-' + (day.getMonth() + 1 < 10 ? '0' + (day.getMonth() + 1) : day.getMonth() + 1) + '-' + (day.getDate() < 10 ? '0' + day.getDate() : day.getDate());
      getItemsSoldDayAmount(day);
      getItemsSoldDayQuantity(day);
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

// ------------ creation of charts instances ------------
sells_day_amount= new Chart('sells_day_amount', {
  type: 'bar',
  options: sellsDayOptions,
  data: null,
});

sells_hour_amount = new Chart('sells_hour_amount', {
  type: 'bar',
  options: chartOptions,
  data: null
});

sells_day_quantity= new Chart('sells_day_quantity', {
  type: 'bar',
  options: sellsDayOptions,
  data: null,
});

sells_hour_quantity = new Chart('sells_hour_quantity', {
  type: 'bar',
  options: chartOptions,
  data: null
});

// ------------ data for charts ------------
var dataHoursAmount = Array(21).fill(0);
var dataDaysAmount = Array(7).fill(0);
var dataHoursQuantity = Array(21).fill(0);
var dataDaysQuantity = Array(7).fill(0);
var nbCarts = 0;
var turnover = 0;

// ------------ data for auto update ------------
var lastDataHoursAmount = null;
var lastDataDaysAmount = null;
var lastDataHoursQuantity = null;
var lastDataDaysQuantity = null;
var lastNbCarts = null;
var lastTurnover = null;

var emptyHours = Array(21).fill(0);
var emptyDays = Array(7).fill(0);

// ------------ data for labels ------------
hoursLabels = ["8H", "9H", "10H", "11H", "12H", "13H", "13H", "14H", "15H", "16H", "17H", "18H", "19H", "20H", "21H"];
daysLabels = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];

// ------------ ajax requests ------------

// update amount sold per hour of selected day
function getItemsSoldDayAmount(day, article_type = 0, cart_id = 0) {
    var url = "index.php?controller=admin_dashboard&chart=items_sold_day_amount&day=" + day + "&article_type_id=" + article_type + "&cart_id=" + cart_id;
    $.ajax({
        url: url,
        type: "GET",
        async: false,
        dataType: "json",
        success: function(data) {
            // reset dataHoursAmount
            dataHoursAmount = emptyHours.slice();

            data.forEach(element => {
                dataHoursAmount[element.hour - 8] = element.amount;
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
                    data: dataHoursAmount,
                }]
            };

            // only update chart if data has changed
            if (JSON.stringify(dataHoursAmount) !== JSON.stringify(lastDataHoursAmount)) {
                updateChart(sells_hour_amount, dataChartHours);
                lastDataHoursAmount = dataHoursAmount.slice(); // make a copy of the array
            }
        }
    });
}

// update amount sold per day of selected week
function getItemsSoldWeekAmount(day, article_type = 0, cart_id = 0) {
    var url = "index.php?controller=admin_dashboard&chart=items_sold_week_amount&day=" + day + "&article_type_id=" + article_type + "&cart_id=" + cart_id;
    $.ajax({
        url: url,
        type: "GET",
        async: false,
        dataType: "json",
        success: function(data) {
            // reset dataDaysAmount
            dataDaysAmount = emptyDays.slice();

            data.forEach(element => {
              dataDaysAmount[element.day] = element.amount;
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
                    data: dataDaysAmount,
                }]
            };

            // if dataDaysAmount is empty, copy emptyDays to dataDaysAmount
            if (dataDaysAmount.every((val, i, arr) => val === arr[0])) {
                dataDaysAmount = emptyDays.slice(); // make a copy of the array
            }

            // only update chart if data has changed
            if (JSON.stringify(dataDaysAmount) !== JSON.stringify(lastDataDaysAmount)) {
                updateChart(sells_day_amount, dataChartDays);
                lastDataDaysAmount = dataDaysAmount.slice(); // make a copy of the array
            }
        }

    });
}

// update quantity sold per hour of selected day
function getItemsSoldDayQuantity(day, article_type = 0, cart_id = 0) {
  var url = "index.php?controller=admin_dashboard&chart=items_sold_day_quantity&day=" + day + "&article_type_id=" + article_type + "&cart_id=" + cart_id;
  $.ajax({
      url: url,
      type: "GET",
      async: false,
      dataType: "json",
      success: function(data) {
          // reset dataHoursQuantity
          dataHoursQuantity = emptyHours.slice();

          data.forEach(element => {
            dataHoursQuantity[element.hour-8] = element.quantity;
          });
          var dataChartHours = {
              labels: hoursLabels,
              datasets: [{
                label: "Nombre de ventes du jour",
                backgroundColor: "rgba(34,139,34,0.2)",
                borderColor: "rgba(0,100,0)",
                borderWidth: 2,
                hoverBackgroundColor: "rgba(34,139,34,0.2)",
                hoverBorderColor: "rgba(0,100,0)",
                data: dataHoursQuantity,
              }]
            };

          // if dataHoursQuantity is empty, copy emptyHours to dataHoursQuantity
          if (dataHoursQuantity.every((val, i, arr) => val === arr[0])) {
              dataHoursQuantity = emptyHours.slice(); // make a copy of the array
          }

          // only update chart if data has changed
          if (JSON.stringify(dataHoursQuantity) !== JSON.stringify(lastDataHoursQuantity)) {
              updateChart(sells_hour_quantity, dataChartHours);
              lastDataHoursQuantity = dataHoursQuantity.slice(); // make a copy of the array
          }
      }
      
  });
}

// update quantity sold per day of selected week
function getItemsSoldWeekQuantity(day, article_type = 0, cart_id = 0) {
  var url = "index.php?controller=admin_dashboard&chart=items_sold_week_quantity&day=" + day + "&article_type_id=" + article_type + "&cart_id=" + cart_id;
  $.ajax({
      url: url,
      type: "GET",
      async: false,
      dataType: "json",
      success: function(data) {
          // reset dataDaysQuantity
          dataDaysQuantity = emptyDays.slice();

          data.forEach(element => {
            dataDaysQuantity[element.day] = element.quantity;
          });
          var dataChartDays = {
              labels: daysLabels,
              datasets: [{
                  label: "Nombre de ventes de la semaine",
                  backgroundColor: "rgba(34,139,34,0.2)",
                  borderColor: "rgba(0,100,0)",
                  borderWidth: 2,
                  hoverBackgroundColor: "rgba(34,139,34,0.2)",
                  hoverBorderColor: "rgba(0,100,0)",
                  data: dataDaysQuantity,
              }]
          };

          // if dataDaysQuantity is empty, copy emptyDays to dataDaysQuantity
          if (dataDaysQuantity.every((val, i, arr) => val === arr[0])) {
              dataDaysQuantity = emptyDays.slice(); // make a copy of the array
          }

          // only update chart if data has changed
          if (JSON.stringify(dataDaysQuantity) !== JSON.stringify(lastDataDaysQuantity)) {
              updateChart(sells_day_quantity, dataChartDays);
              lastDataDaysQuantity = dataDaysQuantity.slice(); // make a copy of the array
          }
      }
  });
}

// get total turnover of selected period
function getTurnover() {
    let start = $("#datepickerTurnoverStart").val();
    let end = $("#datepickerTurnoverEnd").val();

    var url = "index.php?controller=admin_dashboard&chart=turnover&start=" + start + "&end=" + end;
    $.ajax({
        url: url,
        type: "GET",
        async: false,
        dataType: "json",
        success: function(data) {
            // round turnover to 2 decimals
            if (data[0][0] != null) {
                turnover = Math.round(data[0][0] * 100) / 100;
            } else {
                turnover = 0.00;
            }

            if (turnover != lastTurnover) {
                lastTurnover = turnover;
                $("#turnover").html(turnover + " €");
            }
        }});
}

// get total number of carts of selected status
function getNbCartsWithStatus() {
    let status = $("#cartStatus").val();

    var url = "index.php?controller=admin_dashboard&chart=nb_carts_with_status&status_id=" + status;
    $.ajax({
        url: url,
        type: "GET",
        async: false,
        dataType: "json",
        success: function(data) {
            nbCarts = data[0][0];

            if (nbCarts != lastNbCarts) {
                lastNbCarts = nbCarts;
                $("#nbCarts").html(nbCarts);
            }
        }});
}

// update all charts
function updateItemsSold() {
    let date = $("#datepicker").val();
    let article_type = $("#article_type").val();
    let cart_id = $("#carts").val();
    getItemsSoldDayAmount(date, article_type, cart_id);
    getItemsSoldWeekAmount(date, article_type, cart_id);
    getItemsSoldDayQuantity(date, article_type, cart_id);
    getItemsSoldWeekQuantity(date, article_type, cart_id);
}

// update all charts, turnover and number of carts with status
function updateAll() {
    updateItemsSold();
    getTurnover();
    getNbCartsWithStatus();
}

// ------------ JQuery on elements change ------------
$("#datepicker").change(function() {
    updateItemsSold();
});

$("#datepickerTurnoverStart").change(function() {
    getTurnover();
});

$("#datepickerTurnoverEnd").change(function() {
    getTurnover();
});

// on select change, update charts
$("#article_type").change(function() {
  updateItemsSold();
});

// on select change, update charts
$("#carts").change(function() {
  updateItemsSold();
});

// on status carts change, update number of carts with status
$("#cartStatus").change(function() {
    getNbCartsWithStatus();
});

$(document).ready(function () {
    // get current date
    const today = new Date();
    // format date to yyyy-mm-dd
    const date = today.getFullYear() + '-' + (today.getMonth() + 1 < 10 ? '0' + (today.getMonth() + 1) : today.getMonth() + 1) + '-' + (today.getDate() < 10 ? '0' + today.getDate() : today.getDate());

    // set input "#datepicker" to today's date
    $("#datepicker").val(date);
    $("#datepickerTurnoverStart").val(date);
    $("#datepickerTurnoverEnd").val(date);

    // set cart status to 3 (current)
    $("#cartStatus").val(3);

    // update all charts
    updateAll();
});

var autoRefresh = window.setInterval(function(){
    // update all charts every 10 seconds
    updateAll();
}, 10000);
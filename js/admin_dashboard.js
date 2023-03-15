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
      getItemsSoldDayAmount(day);
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

dataHoursAmount = Array(21).fill(0);
dataDaysAmount = Array(7).fill(0);

dataHoursQuantity = Array(21).fill(0);
dataDaysQuantity = Array(7).fill(0);

hoursLabels = ["8H", "9H", "10H", "11H", "12H", "13H", "13H", "14H", "15H", "16H", "17H", "18H", "19H", "20H", "21H"];
daysLabels = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"];

// update amount sold per hour of selected day
function getItemsSoldDayAmount(day, article_type = 0, cart_id = 0) {
    var url = "index.php?controller=admin_dashboard&chart=items_sold_day_amount&day=" + day + "&article_type_id=" + article_type + "&cart_id=" + cart_id;
    $.ajax({
        url: url,
        type: "GET",
        async: false,
        dataType: "json",
        success: function(data) {
          dataHoursAmount = [];
            data.forEach(element => {
              dataHoursAmount[element.hour-8] = element.amount;
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

              updateChart(sells_hour_amount, dataChartHours);
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
            dataDaysAmount = [];
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

            updateChart(sells_day_amount, dataChartDays);
            
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
        dataHoursQuantity = [];
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

            updateChart(sells_hour_quantity, dataChartHours);
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
          dataDaysQuantity = [];
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

          updateChart(sells_day_quantity, dataChartDays);
          
      }

  });
}

function getTurnover(start, end) {
  var url = "index.php?controller=admin_dashboard&chart=turnover&start=" + start + "&end=" + end;
  $.ajax({
      url: url,
      type: "GET",
      async: false,
      dataType: "json",
      success: function(data) {
        // round turnover to 2 decimals
        turnover = Math.round(data[0][0] * 100) / 100;

        // change element with turnover id to turnover
        $("#turnover").html(turnover + " €");
      }});
}

function getNbCartsWithStatus(status) {
    var url = "index.php?controller=admin_dashboard&chart=nb_carts_with_status&status_id=" + status;
    $.ajax({
        url: url,
        type: "GET",
        async: false,
        dataType: "json",
        success: function(data) {
            // change element with status id to status
            $("#nbCarts").html(data[0][0]);
        }});
}

function updateItemsSold(date, article_type = 0, cart_id = 0) {
    getItemsSoldDayAmount(date, article_type, cart_id);
    getItemsSoldWeekAmount(date, article_type, cart_id);
    getItemsSoldDayQuantity(date, article_type, cart_id);
    getItemsSoldWeekQuantity(date, article_type, cart_id);
}

// on element with id datepicker change, update charts
$("#datepicker").change(function() {
    getItemsSoldDayAmount($(this).val());
    getItemsSoldWeekAmount($(this).val());
    getItemsSoldDayQuantity($(this).val());
    getItemsSoldWeekQuantity($(this).val());
});

$("#datepickerTurnoverStart").change(function() {
    getTurnover($(this).val(), $("#datepickerTurnoverEnd").val());
});

$("#datepickerTurnoverEnd").change(function() {
    getTurnover($("#datepickerTurnoverStart").val(), $(this).val());
});

// on select change, update charts
$("#article_type").change(function() {
  article_type = $(this).val();
  cart_id = $("#carts").val();

  updateItemsSold($("#datepicker").val(), article_type, cart_id);
});

// on select change, update charts
$("#carts").change(function() {
  let article_type = $("#article_type").val();
  let cart_id = $(this).val();

  updateItemsSold($("#datepicker").val(), article_type, cart_id);
});

// on status carts change, update number of carts with status
$("#cartStatus").change(function() {
    let cart_status = $(this).val();
    getNbCartsWithStatus(cart_status);
});

$(document).ready(function () {
  // get current date
  const today = new Date();
  // format date to yyyy-mm-dd
  const date = today.getFullYear() + '-' + (today.getMonth() + 1 < 10 ? '0' + (today.getMonth() + 1) : today.getMonth() + 1) + '-' + (today.getDate() < 10 ? '0' + today.getDate() : today.getDate());
  let cart_status = $("#cartStatus").val();

  // set input "#datepicker" to today's date
  $("#datepicker").val(date);
  $("#datepickerTurnoverStart").val(date);
  $("#datepickerTurnoverEnd").val(date);

  updateItemsSold(date);
  getTurnover(date, date);
  getNbCartsWithStatus(cart_status);

});
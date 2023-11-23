<?php
$session_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$total_coins_lr_data = array();

for ($month = 1; $month <= 12; $month++) {
  $total_coins_query = "SELECT CASE WHEN SUM( gd.game_coins ) IS NULL THEN 0 ELSE SUM( gd.game_coins )  END AS total_coins_lr  FROM gamedata gd JOIN ( SELECT username, MAX( update_at ) AS last_update  FROM gamedata  WHERE YEAR ( update_at ) = 2023  AND MONTH ( update_at ) = $month  AND username = '" . $username . "' GROUP BY username  ) last_updates ON gd.username = last_updates.username  AND gd.update_at = last_updates.last_update";

  $select_student = mysqli_query($connection, $total_coins_query);
  $row = mysqli_fetch_assoc($select_student);
  $total_coins_lr = $row ? $row['total_coins_lr'] : 0;

  $total_coins_lr_data[] = $total_coins_lr;
} 
?>

<div class="col-lg-12 col-md-12 col-sm-6">
  <div class="card card-chart">
    <div class="card-header ">
      <div class="row">
        <div class="col-sm-6 text-left">
          <h5>Recruit Chart</h5>
          <h2 class="card-title">Performance</h2>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="chart-area">
        <canvas id="chartLinePurple"></canvas>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  type = ["primary", "info", "success", "warning", "danger"];

  demo = {

    initDocChart: function() {
      chartColor = "#FFFFFF";

      // General configuration for the charts with Line gradientStroke
      gradientChartOptionsConfiguration = {
        maintainAspectRatio: false,
        legend: {
          display: false,
        },
        tooltips: {
          bodySpacing: 4,
          mode: "nearest",
          intersect: 0,
          position: "nearest",
          xPadding: 10,
          yPadding: 10,
          caretPadding: 10,
        },
        responsive: true,
        scales: {
          yAxes: [{
            display: 0,
            gridLines: 0,
            ticks: {
              display: false,
            },
            gridLines: {
              zeroLineColor: "transparent",
              drawTicks: false,
              display: false,
              drawBorder: false,
            },
          }, ],
          xAxes: [{
            display: 0,
            gridLines: 0,
            ticks: {
              display: false,
            },
            gridLines: {
              zeroLineColor: "transparent",
              drawTicks: false,
              display: false,
              drawBorder: false,
            },
          }, ],
        },
        layout: {
          padding: {
            left: 0,
            right: 0,
            top: 15,
            bottom: 15,
          },
        },
      };

      ctx = document.getElementById("lineChartExample").getContext("2d");

      gradientStroke = ctx.createLinearGradient(500, 0, 100, 0);
      gradientStroke.addColorStop(0, "#80b6f4");
      gradientStroke.addColorStop(1, chartColor);

      gradientFill = ctx.createLinearGradient(0, 170, 0, 50);
      gradientFill.addColorStop(0, "rgba(128, 182, 244, 0)");
      gradientFill.addColorStop(1, "rgba(249, 99, 59, 0.40)");

    },

    initDashboardPageCharts: function(game) {
      let datagame = game == "1" ? <?php echo json_encode($total_coins_lr_data); ?> : <?php echo json_encode(['0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0']); ?>;
      gradientChartOptionsConfigurationWithTooltipPurple = {
        maintainAspectRatio: false,
        legend: {
          display: false,
        },

        tooltips: {
          backgroundColor: "#f5f5f5",
          titleFontColor: "#333",
          bodyFontColor: "#666",
          bodySpacing: 4,
          xPadding: 12,
          mode: "nearest",
          intersect: 0,
          position: "nearest",
        },
        responsive: true,
        scales: {
          yAxes: [{
            barPercentage: 1.6,
            gridLines: {
              drawBorder: false,
              color: "rgba(29,140,248,0.0)",
              zeroLineColor: "transparent",
            },
            ticks: {
              suggestedMin: 0,
              suggestedMax: 20,
              padding: 20,
              fontColor: "#9a9a9a",
            },
          }, ],

          xAxes: [{
            barPercentage: 1.6,
            gridLines: {
              drawBorder: false,
              color: "rgba(225,78,202,0.1)",
              zeroLineColor: "transparent",
            },
            ticks: {
              padding: 20,
              fontColor: "#9a9a9a",
            },
          }, ],
        },
      };


      gradientBarChartConfiguration = {
        maintainAspectRatio: false,
        legend: {
          display: false,
        },

        tooltips: {
          backgroundColor: "#f5f5f5",
          titleFontColor: "#333",
          bodyFontColor: "#666",
          bodySpacing: 4,
          xPadding: 12,
          mode: "nearest",
          intersect: 0,
          position: "nearest",
        },
        responsive: true,
        scales: {
          yAxes: [{
            gridLines: {
              drawBorder: false,
              color: "rgba(29,140,248,0.1)",
              zeroLineColor: "transparent",
            },
            ticks: {
              suggestedMin: 60,
              suggestedMax: 120,
              padding: 20,
              fontColor: "#9e9e9e",
            },
          }, ],

          xAxes: [{
            gridLines: {
              drawBorder: false,
              color: "rgba(29,140,248,0.1)",
              zeroLineColor: "transparent",
            },
            ticks: {
              padding: 20,
              fontColor: "#9e9e9e",
            },
          }, ],
        },
      };

      var ctx = document.getElementById("chartLinePurple").getContext("2d");

      var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

      gradientStroke.addColorStop(1, "rgba(72,72,176,0.2)");
      gradientStroke.addColorStop(0.2, "rgba(72,72,176,0.0)");
      gradientStroke.addColorStop(0, "rgba(119,52,169,0)"); //purple colors

      var data = {
        labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
        datasets: [{
          label: "Data",
          fill: true,
          backgroundColor: gradientStroke,
          borderColor: "#d048b6",
          borderWidth: 2,
          borderDash: [],
          borderDashOffset: 0.0,
          pointBackgroundColor: "#d048b6",
          pointBorderColor: "rgba(255,255,255,0)",
          pointHoverBackgroundColor: "#d048b6",
          pointBorderWidth: 20,
          pointHoverRadius: 4,
          pointHoverBorderWidth: 15,
          pointRadius: 4,
          data: <?php echo json_encode(newRecruitsByMonth()); ?>,
        }, ],
      };





      var myChart = new Chart(ctx, {
        type: "line",
        data: data,
        options: gradientChartOptionsConfigurationWithTooltipPurple,
      });

      // var ctxGreen = document.getElementById("chartLineGreen").getContext("2d");

      // var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

      // gradientStroke.addColorStop(1, "rgba(66,134,121,0.15)");
      // gradientStroke.addColorStop(0.4, "rgba(66,134,121,0.0)"); //green colors
      // gradientStroke.addColorStop(0, "rgba(66,134,121,0)"); //green colors

      // var data = {
      //   labels: ["JUL", "AUG", "SEP", "OCT", "NOV"],
      //   datasets: [{
      //     label: "My First dataset",
      //     fill: true,
      //     backgroundColor: gradientStroke,
      //     borderColor: "#00d6b4",
      //     borderWidth: 2,
      //     borderDash: [],
      //     borderDashOffset: 0.0,
      //     pointBackgroundColor: "#00d6b4",
      //     pointBorderColor: "rgba(255,255,255,0)",
      //     pointHoverBackgroundColor: "#00d6b4",
      //     pointBorderWidth: 20,
      //     pointHoverRadius: 4,
      //     pointHoverBorderWidth: 15,
      //     pointRadius: 4,
      //     data: [90, 27, 60, 12, 80],
      //   }, ],
      // };

      // var myChart = new Chart(ctxGreen, {
      //   type: "line",
      //   data: data,
      //   options: gradientChartOptionsConfigurationWithTooltipGreen,
      // });

      // var chart_labels = [
      //   "JAN",
      //   "FEB",
      //   "MAR",
      //   "APR",
      //   "MAY",
      //   "JUN",
      //   "JUL",
      //   "AUG",
      //   "SEP",
      //   "OCT",
      //   "NOV",
      //   "DEC",
      // ];
      // var chart_data = [100, 70, 90, 70, 85, 60, 75, 60, 90, 80, 110, 100];

      // var ctx = document.getElementById("chartBig1").getContext("2d");

      // var gradientStroke = ctx.createLinearGradient(0, 230, 0, 50);

      // gradientStroke.addColorStop(1, "rgba(72,72,176,0.1)");
      // gradientStroke.addColorStop(0.4, "rgba(72,72,176,0.0)");
      // gradientStroke.addColorStop(0, "rgba(119,52,169,0)"); //purple colors
      // var config = {
      //   type: "line",
      //   data: {
      //     labels: chart_labels,
      //     datasets: [{
      //       label: "My First dataset",
      //       fill: true,
      //       backgroundColor: gradientStroke,
      //       borderColor: "#d346b1",
      //       borderWidth: 2,
      //       borderDash: [],
      //       borderDashOffset: 0.0,
      //       pointBackgroundColor: "#d346b1",
      //       pointBorderColor: "rgba(255,255,255,0)",
      //       pointHoverBackgroundColor: "#d346b1",
      //       pointBorderWidth: 20,
      //       pointHoverRadius: 4,
      //       pointHoverBorderWidth: 15,
      //       pointRadius: 4,
      //       data: chart_data,
      //     }, ],
      //   },
      //   options: gradientChartOptionsConfigurationWithTooltipPurple,
      // };
      // var myChartData = new Chart(ctx, config);
      // $("#0").click(function() {
      //   console.log(1);
      //   var data = myChartData.config.data;
      //   data.datasets[0].data = chart_data;
      //   data.labels = chart_labels;
      //   myChartData.update();
      // });
      // $("#1").click(function() {
      //   console.log(2);
      //   var chart_data = [80, 120, 105, 110, 95, 105, 90, 100, 80, 95, 70, 120];
      //   var data = myChartData.config.data;
      //   data.datasets[0].data = chart_data;
      //   data.labels = chart_labels;
      //   myChartData.update();
      // });

      // $("#2").click(function() {
      //   console.log(3);
      //   var chart_data = [60, 80, 65, 130, 80, 105, 90, 130, 70, 115, 60, 130];
      //   var data = myChartData.config.data;
      //   data.datasets[0].data = chart_data;
      //   data.labels = chart_labels;
      //   myChartData.update();
      // });

    },
  };
</script>
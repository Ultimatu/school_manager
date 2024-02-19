
$(function(){
  'use strict'

  var ctxLabel = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
  var ctxData1 = [20, 60, 50, 45, 50, 60, 70, 40, 45, 35, 25, 30];
  var ctxData2 = [10, 40, 30, 40, 60, 55, 45, 35, 30, 20, 15, 20];
  var ctxColor1 = '#506fd9';
  var ctxColor2 = '#DBDFFD';

  // Bar chart
  var ctx1 = document.getElementById('chartBar1').getContext('2d');
  var chartBar = new Chart(ctx1, {
    type: 'bar',
    data: {
      labels: ctxLabel,
      datasets: [{
        data: ctxData1,
        backgroundColor: ctxColor1,
        barPercentage: 0.5
      }, {
        data: ctxData2,
        backgroundColor: ctxColor2,
        barPercentage: 0.5
      }]
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero:true,
          max: 80
        }
      }
    }
  });

  // Horizontal bar chart
  var ctx2 = document.getElementById('chartBar2').getContext('2d');
  var chartBar2 = new Chart(ctx2, {
    type: 'bar',
    data: {
      labels: ctxLabel,
      datasets: [{
        data: ctxData1,
        backgroundColor: ctxColor1,
        barPercentage: 0.75
      }, {
        data: ctxData2,
        backgroundColor: ctxColor2,
        barPercentage: 0.75
      }]
    },
    options: {
      indexAxis: 'y',
      maintainAspectRatio: false,
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        x: {
          beginAtZero:true,
          max: 80
        }
      }
    }
  });

  // Stacked chart
  var ctx3 = document.getElementById('chartBar3').getContext('2d');
  var chartBar3 = new Chart(ctx3, {
    type: 'bar',
    data: {
      labels: ctxLabel,
      datasets: [{
        data: ctxData1,
        backgroundColor: ctxColor1,
        barPercentage: 0.5
      }, {
        data: ctxData2,
        backgroundColor: ctxColor2,
        barPercentage: 0.5
      }]
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero:true,
          stacked: true
        },
        x: {
          stacked: true
        }
      }
    }
  });

  // Line chart
  var ctx4 = document.getElementById('chartLine1');
  var chartLine = new Chart(ctx4, {
    type: 'line',
    data: {
      labels: ctxLabel,
      datasets: [{
        data: ctxData1,
        borderColor: ctxColor1,
        backgroundColor: ctxColor1,
        borderWidth: 1
      }, {
        data: ctxData2,
        borderColor: ctxColor2,
        backgroundColor: ctxColor2,
        borderWidth: 1
      }]
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero:true,
          max: 80
        }
      }
    }
  });

  // Area chart
  var ctx5 = document.getElementById('chartArea1');
  var chartArea = new Chart(ctx5, {
    type: 'line',
    data: {
      labels: ctxLabel,
      datasets: [{
        data: [5, 40, 25, 10, 25, 35, 45, 25, 10, 10, 20, 15],
        borderColor: ctxColor1,
        backgroundColor: ctxColor1,
        borderWidth: 1,
        fill: true
      }, {
        data: [20, 60, 50, 45, 50, 60, 70, 40, 45, 35, 25, 30],
        borderColor: ctxColor2,
        backgroundColor: ctxColor2,
        borderWidth: 1,
        fill: true
      }]
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero:true,
          max: 80
        }
      }
    }
  });

  // With transparency
  var ctx6 = document.getElementById('chartBar4').getContext('2d');
  var chartBar4 = new Chart(ctx6, {
    type: 'bar',
    data: {
      labels: ctxLabel,
      datasets: [{
        data: ctxData1,
        backgroundColor: 'rgba(80,111,217, .5)',
        barPercentage: 0.5
      }, {
        data: ctxData2,
        backgroundColor: 'rgba(219,223,253, .5)',
        barPercentage: 0.5
      }]
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero:true,
          max: 80
        }
      }
    }
  });

  // With gradient
  var ctx7 = document.getElementById('chartBar5').getContext('2d');

  var gradient1 = ctx7.createLinearGradient(0, 350, 0, 0);
  gradient1.addColorStop(0, '#506fd9');
  gradient1.addColorStop(1, '#ba50d9');

  var gradient2 = ctx7.createLinearGradient(0, 400, 0, 0);
  gradient2.addColorStop(0, '#dbdffd');
  gradient2.addColorStop(1, '#fddbdf');

  var chartBar5 = new Chart(ctx7, {
    type: 'bar',
    data: {
      labels: ctxLabel,
      datasets: [{
        data: ctxData1,
        backgroundColor: gradient1,
        barPercentage: 0.5
      }, {
        data: ctxData2,
        backgroundColor: gradient2,
        barPercentage: 0.5
      }]
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero:true,
          max: 80
        }
      }
    }
  });

  /** PIE CHART **/
  var datapie = {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
    datasets: [{
      data: [20,20,30,5,25],
      backgroundColor: ['#ab85e8', '#80bdff','#80e6e6','#e5eff1','#baee80']
    }]
  };

  var optionpie = {
    maintainAspectRatio: false,
    responsive: true,
    plugins: {
      legend: {
        display: false
      }
    },
    animation: {
      animateScale: true,
      animateRotate: true
    }
  };

  // For a doughnut chart
  var ctx8 = document.getElementById('chartPie');
  var myPieChart = new Chart(ctx8, {
    type: 'doughnut',
    data: datapie,
    options: optionpie
  });

  // For a pie chart
  var ctx9 = document.getElementById('chartDonut');
  var myDonutChart = new Chart(ctx9, {
    type: 'pie',
    data: datapie,
    options: optionpie
  });

  // Dark Skin
  var isDark = localStorage.getItem('skin-mode');
  if(isDark) {
    chartBar.options.scales['x'].grid.color = 'rgba(255,255,255,.06)';
    chartBar.options.scales['y'].grid.color = 'rgba(255,255,255,.06)';
    chartBar.options.scales['x'].ticks.color = 'rgba(255,255,255,.65)';
    chartBar.options.scales['y'].ticks.color = 'rgba(255,255,255,.65)';
    chartBar.update();

    chartBar2.options.scales['x'].grid.color = 'rgba(255,255,255,.06)';
    chartBar2.options.scales['y'].grid.color = 'rgba(255,255,255,.06)';
    chartBar2.options.scales['x'].ticks.color = 'rgba(255,255,255,.65)';
    chartBar2.options.scales['y'].ticks.color = 'rgba(255,255,255,.65)';
    chartBar2.update();

    chartBar3.options.scales['x'].grid.color = 'rgba(255,255,255,.06)';
    chartBar3.options.scales['y'].grid.color = 'rgba(255,255,255,.06)';
    chartBar3.options.scales['x'].ticks.color = 'rgba(255,255,255,.65)';
    chartBar3.options.scales['y'].ticks.color = 'rgba(255,255,255,.65)';
    chartBar3.update();

    chartBar4.options.scales['x'].grid.color = 'rgba(255,255,255,.06)';
    chartBar4.options.scales['y'].grid.color = 'rgba(255,255,255,.06)';
    chartBar4.options.scales['x'].ticks.color = 'rgba(255,255,255,.65)';
    chartBar4.options.scales['y'].ticks.color = 'rgba(255,255,255,.65)';
    chartBar4.update();

    chartBar5.options.scales['x'].grid.color = 'rgba(255,255,255,.06)';
    chartBar5.options.scales['y'].grid.color = 'rgba(255,255,255,.06)';
    chartBar5.options.scales['x'].ticks.color = 'rgba(255,255,255,.65)';
    chartBar5.options.scales['y'].ticks.color = 'rgba(255,255,255,.65)';
    chartBar5.update();

    chartLine.options.scales['x'].grid.color = 'rgba(255,255,255,.06)';
    chartLine.options.scales['y'].grid.color = 'rgba(255,255,255,.06)';
    chartLine.options.scales['x'].ticks.color = 'rgba(255,255,255,.65)';
    chartLine.options.scales['y'].ticks.color = 'rgba(255,255,255,.65)';
    chartLine.update();

    chartArea.options.scales['x'].grid.color = 'rgba(255,255,255,.06)';
    chartArea.options.scales['y'].grid.color = 'rgba(255,255,255,.06)';
    chartArea.options.scales['x'].ticks.color = 'rgba(255,255,255,.65)';
    chartArea.options.scales['y'].ticks.color = 'rgba(255,255,255,.65)';
    chartArea.update();
  }

})

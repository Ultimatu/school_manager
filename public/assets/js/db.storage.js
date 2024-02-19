'use strict'

var states = {
  hover: {
    filter: {
      type: 'none'
    }
  },
  active: {
    filter: {
      type: 'none'
    }
  }
};

var optionOne = {
  series: [{
    data: [[13,1400],[14,1800],[15,1500]]
  },{
    data: [[0,800],[1,600],[2,500],[3,400],[4,600],[5,500],[6,800],[7,1000],[8,900],[9,1100],[10,1500],[11,1200],[12,1000],[13,0],[14,0],[15,0],[16,1200],[17,1000],[18,1100],[19,800],[20,500],[21,300],[22,500],[23,600],[24,500],[25,600],[26,800],[27,1000],[28,900],[29,800],[30,500]]
  }],
  chart: {
    type: 'bar',
    height: 200,
    parentHeightOffset: 0,
    stacked: true,
    toolbar: { show: false }
  },
  grid: {
    borderColor: 'rgba(72,94,144, 0.07)',
    padding: {
      top: -20,
      left: 0,
      right: 0,
      bottom: 0
    },
    yaxis: {
      lines: { show: false }
    }
  },
  colors: ['#506fd9','#c8ccd4'],
  plotOptions: {
    bar: { columnWidth: '45%' }
  },
  stroke: {
    curve: 'straight',
    lineCap: 'square',
    width: 0
  },
  xaxis: {
    min: 0,
    type: 'numeric',
    tickAmount: 6,
    decimalsInFloat: 0,
    labels: {
      style: { fontSize: '11px' }
    }
  },
  yaxis: {
    show: false,
    max: 2000
  },
  states: states,
  dataLabels: { enabled: false },
  tooltip: { enabled: false },
  fill: { opacity: 1 },
  legend: { show: false }
};

var chartOne = new ApexCharts(document.querySelector('#apexChart1'), optionOne);
chartOne.render();

//--------------------------------------------

var optionTwo = {
  series: [{
    data: [
      [0,50],[1,50],[2,60],[3,50],[4,45],[5,55],[6,55],[7,45],[8,60],[9,25],
      [10,55],[11,60],[12,55],[13,55],[14,55],[15,55],[16,65],[17,55],[18,75],[19,35],
      [20,50],[21,65],[22,35],[23,45],[24,45],[25,45],[26,55],[27,50],[28,55],[29,55],
      [30,55],[31,65],[32,45],[33,40],[34,45],[35,45],[36,55],[37,75],[38,65],[39,65],
      [40,70]
    ]
  },{
    data: [
      [0,50],[1,50],[2,60],[3,50],[4,45],[5,55],[6,55],[7,45],[8,60],[9,25],
      [10,55],[11,60],[12,55],[13,55],[14,55],[15,55],[16,65],[17,55],[18,75],[19,35],
      [20,50],[21,65],[22,35],[23,45],[24,45]
    ]
  }],
  chart: {
    type: 'area',
    height: '100%',
    parentHeightOffset: 0,
    toolbar: { show: false }
  },
  grid: {
    borderColor: 'rgba(72,94,144, 0.07)',
    padding: {
      top: -20,
      left: 0,
      right: 0,
      bottom: 0
    },
    yaxis: {
      lines: { show: false }
    }
  },
  colors: ['#c8ccd4','#506fd9'],
  stroke: {
    curve: 'straight',
    lineCap: 'square',
    width: 1.5
  },
  xaxis: {
    min: 0,
    max: 40,
    type: 'numeric',
    tickAmount: 6,
    decimalsInFloat: 0,
    labels: {
      style: { fontSize: '11px' }
    }
  },
  yaxis: {
    show: false,
    min: 0,
    max: 140
  },
  states: states,
  dataLabels: { enabled: false },
  tooltip: { enabled: false },
  fill: { opacity: 1 },
  legend: { show: false }
};

var chartTwo = new ApexCharts(document.querySelector('#apexChart2'), optionTwo);
chartTwo.render();

//----------------------------------------------

var optionThree = {
  series: [{
    type: 'area',
    data: [
      [0,45000],[1,45000],[2,55000],[3,45000],[4,40000],[5,50000],[6,50000],[7,40000],[8,45000],[9,20000],
      [10,40000],[11,55000],[12,50000],[13,50000],[14,50000],[15,50000],[16,60000],[17,35000],[18,50000],[19,20000],
      [20,40000],[21,55000],[22,20000],[23,40000],[24,40000],[25,40000],[26,45000],[27,45000],[28,50000],[29,40000],
      [30,50000],[31,55000],[32,40000],[33,35000],[34,40000],[35,40000],[36,50000],[37,60000],[38,55000],[39,60000],
      [40,60000],[41,50000],[42,45000],[43,40000],[44,45000],[45,40000],[46,42000],[47,30000],[48,40000],[49,40000],
      [50,45000],[51,45000],[52,45000],[53,40000],[54,50000],[55,50000]
    ]
  }, {
    type: 'column',
    data: [
      [0,10000],[1,8000],[2,20000],[3,10000],[4,15000],[5,5000],[6,12000],[7,5000],[8,10000],[9,5000],
      [10,15000],[11,10000],[12,5000],[13,7000],[14,5000],[15,15000],[16,20000],[17,15000],[18,10000],[19,5000],
      [20,5000],[21,15000],[22,10000],[23,5000],[24,10000],[25,5000],[26,5000],[27,2000],[28,3000],[29,10000],
      [30,5000],[31,2000],[32,2000],[33,5000],[34,8000],[35,10000],[36,10000],[37,12000],[38,10000],[39,15000],
      [40,5000],[41,25000],[42,12000],[43,5000],[44,10000],[45,15000],[46,10000],[47,20000],[48,10000],[49,8000],
      [50,5000],[51,5000],[52,2000],[53,10000],[54,3000],[55,1000]
    ]
  }],
  chart: {
    height: '100%',
    parentHeightOffset: 0,
    stacked: true,
    toolbar: { show: false }
  },
  grid: {
    borderColor: 'rgba(72,94,144, 0.07)',
    padding: {
      top: -20,
      left: 0,
      right: 0,
      bottom: 0
    },
    yaxis: {
      lines: { show: false }
    }
  },
  colors: ['#85b6ff','#506fd9'],
  plotOptions: {
    bar: { columnWidth: '50%' }
  },
  stroke: {
    curve: 'straight',
    lineCap: 'square',
    width: [2,0]
  },
  xaxis: {
    overwriteCategories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
    tickAmount: 11,
    decimalsInFloat: 0,
    labels: {
      style: { fontSize: '11px' }
    }
  },
  fill: {
    opacity: [0.2, 1, 1],
    gradient: {
      inverseColors: false,
      shade: 'light',
      type: "vertical",
      opacityFrom: 0.85,
      opacityTo: 0
    }
  },
  states: states,
  dataLabels: { enabled: false },
  tooltip: { enabled: false },
  legend: { show: false }
};

var chartThree = new ApexCharts(document.querySelector('#apexChart3'), optionThree);
chartThree.render();

//------------------------------------------------

// Total Space/Used Space
var ctx1 = document.getElementById('chartDonut');
var myDonutChart = new Chart(ctx1, {
  type: 'doughnut',
  data: {
    labels: ['Used Space','System Space', 'Available Space'],
    datasets: [{
      data: [45,55],
      backgroundColor: ['#506fd9','#d3dbf6']
    },{
      data: [40,60],
      backgroundColor: ['#6e7985','#dbdde1']
    }]
  },
  options: {
    maintainAspectRatio: false,
    responsive: true,
    plugins: {
      legend: {
        display: false,
      }
    },
    animation: {
      animateScale: true,
      animateRotate: true
    }
  }
});

// Network In/Out
var ctx2 = document.getElementById('chartPolar');
var myPolarChart = new Chart(ctx2, {
  type: 'polarArea',
  data: {
    datasets: [{
      data: [50,25,60,80,20],
      backgroundColor: ['#506fd9','#85b6ff','#d3dbf6','#6e7985','#dbdde1']
    }]
  },
  options: {
    maintainAspectRatio: false,
    responsive: true,
    plugins: {
      legend: {
        display: false,
      }
    },
    animation: {
      animateScale: true,
      animateRotate: true
    }
  }
});

// Volume Read/Write Ops
var ctx3 = document.getElementById('chartRadar');
var myRadarChart = new Chart(ctx3, {
  type: 'radar',
  data: {
    labels: ['January','February','March','April','May','June','July'],
    datasets: [{
      data: [65, 59, 90, 81, 56, 55, 40],
      fill: true,
      backgroundColor: 'rgba(80, 111, 217, 0.2)',
      borderColor: '#506fd9',
      borderWidth: 1.5,
      pointBackgroundColor: '#506fd9',
      pointBorderColor: '#fff',
      pointHoverBackgroundColor: '#fff',
      pointHoverBorderColor: '#506fd9'
    },{
      data: [28, 48, 40, 19, 96, 27, 100],
      fill: true,
      backgroundColor: 'rgba(133, 182, 255, 0.2)',
      borderColor: '#85b6ff',
      borderWidth: 1.5,
      pointBackgroundColor: '#85b6ff',
      pointBorderColor: '#fff',
      pointHoverBackgroundColor: '#fff',
      pointHoverBorderColor: '#85b6ff'
    }]
  },
  options: {
    maintainAspectRatio: false,
    responsive: true,
    plugins: {
      legend: {
        display: false,
      }
    },
    animation: {
      animateScale: true,
      animateRotate: true
    }
  }
});

// CPU Utilization
var ctx4 = document.getElementById('chartLine');
var myLineChart = new Chart(ctx4, {
  type: 'line',
  data: {
    labels: ['1H', '12H', '24H', '1W', '1M', '1Y'],
    datasets: [{
      data: [50,25,60,80,20,30],
      borderColor: '#506fd9',
      borderWidth: 1.5,
      stepped: true
    }]
  },
  options: {
    maintainAspectRatio: false,
    responsive: true,
    plugins: {
      legend: {
        display: false,
      }
    },
    animation: {
      animateScale: true,
      animateRotate: true
    },
    scales: {
      y: {
        beginAtZero:true,
        max: 100,
        ticks: {
          color: '#a1aab3',
          font: {
            size: 10
          }
        },
        grid: {
          borderColor: '#e2e5ec',
          borderWidth: 1.5,
          color: 'rgba(65,80,95,.08)'
        }
      },
      x: {
        grid: {
          color: 'rgba(65,80,95,.08)'
        },
        ticks: {
          color: '#6e7985',
          font: {
            size: 10,
            weight: '500'
          }
        }
      }
    }
  }
});



// Dark skin integration
function switchDark(enabled) {
  if(enabled) {
    $('.btn-white').addClass('btn-outline-primary').removeClass('btn-white');
  } else {
    $('.btn-outline-primary').addClass('btn-white').removeClass('btn-outline-primary');
  }
}

if(skinMode) { switchDark(true); }

// Switch between light and dark
$('#skinMode .nav-link').bind('click', function(e){
  var mode = $(this).text().toLowerCase();
  if(mode == 'dark') {
    switchDark(true);
  } else {
    switchDark(false);
  }
});

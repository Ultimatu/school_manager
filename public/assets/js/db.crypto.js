'use strict'

var chart = {
  height: 100,
  parentHeightOffset: 0,
  type: 'area',
  toolbar: { show: false },
  stacked: true
};

var grid = {
  borderColor: 'rgba(72,94,144, 0.07)',
  padding: {
    top: -20,
    left: -20,
    right: -20,
    bottom: 0
  },
  yaxis: {
    lines: { show: false }
  }
};

var stroke = {
  curve: 'straight',
  width: 1.5
};

var fill = {
  type: 'gradient',
  gradient: {
    opacityFrom: 0.5,
    opacityTo: 0,
  }
};

var yaxis = {
  min: 0,
  max: 80,
  show: false
}

// Bitcoin
var optionOne = {
  series: [{
    data: dp3
  }],
  chart: chart,
  colors: ['#fd7e14'],
  grid: grid,
  stroke: stroke,
  xaxis: {
    type: 'numeric',
    tickAmount: 6,
    min: 5,
    max: 55,
    decimalsInFloat: 0,
    axisBorder: { show: false },
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '9px'
      }
    },
  },
  yaxis: yaxis,
  fill: fill,
  dataLabels: { enabled: false },
  legend: { show: false },
  tooltip: { enabled: false }
};

var chartOne = new ApexCharts(document.querySelector('#apexChart1'), optionOne);
chartOne.render();

// Etherium
var optionTwo = {
  series: [{
    data: dp3
  }],
  chart: chart,
  colors: ['#1c96e9'],
  grid: grid,
  stroke: stroke,
  xaxis: {
    type: 'numeric',
    tickAmount: 6,
    min: 45,
    max: 95,
    decimalsInFloat: 0,
    axisBorder: { show: false },
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '9px'
      }
    },
  },
  yaxis: yaxis,
  fill: fill,
  dataLabels: { enabled: false },
  legend: { show: false },
  tooltip: { enabled: false }
};

var chartTwo = new ApexCharts(document.querySelector('#apexChart2'), optionTwo);
chartTwo.render();

// Bitcoin Cash
var optionThree = {
  series: [{
    data: dp3
  }],
  chart: chart,
  colors: ['#0cb785'],
  grid: grid,
  stroke: stroke,
  xaxis: {
    type: 'numeric',
    tickAmount: 6,
    min: 15,
    max: 75,
    decimalsInFloat: 0,
    axisBorder: { show: false },
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '9px'
      }
    },
  },
  yaxis: yaxis,
  fill: fill,
  dataLabels: { enabled: false },
  legend: { show: false },
  tooltip: { enabled: false }
};

var chartThree = new ApexCharts(document.querySelector('#apexChart3'), optionThree);
chartThree.render();

// Dash
var optionFour = {
  series: [{
    data: dp3
  }],
  chart: chart,
  colors: ['#506fd9'],
  grid: grid,
  stroke: stroke,
  xaxis: {
    type: 'numeric',
    tickAmount: 6,
    min: 35,
    max: 85,
    decimalsInFloat: 0,
    axisBorder: { show: false },
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '9px'
      }
    },
  },
  yaxis: yaxis,
  fill: fill,
  dataLabels: { enabled: false },
  legend: { show: false },
  tooltip: { enabled: false }
};

var chartFour = new ApexCharts(document.querySelector('#apexChart4'), optionFour);
chartFour.render();

//----------------------------------------------------

var optionFive = {
  series: [{
    name: 'series1',
    data: dp3
  },{
    name: 'series2',
    data: dp3
  },{
    name: 'series3',
    data: dp3
  }],
  chart: {
    height: 290,
    parentHeightOffset: 0,
    stacked: true,
    type: 'area',
    toolbar: { show: false }
  },
  colors: ['#0dcaf0', '#85b6fe','#506fd9'],
  grid: {
    borderColor: 'rgba(72, 94, 144, .1)',
    padding: {
      top: -20
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight',
    width: 1.5
  },
  xaxis: {
    type: 'numeric',
    tickAmount: 6,
    axisBorder: {
      show: false
    },
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '11px'
      }
    }
  },
  yaxis: {
    min: 0,
    max: 140,
    tickAmount: 6,
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '11px'
      }
    }
  },
  fill: {
    type: 'gradient',
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0,
    }
  },
  legend: {
    show: false
  },
  tooltip: {
    enabled: false
  }
};

var chartFive = new ApexCharts(document.querySelector('#apexChart5'), optionFive);
chartFive.render();

//---------------------------------------------------------

var optionSix = {
  series: [{
    name: 'series1',
    data: dp2
  },{
    name: 'series2',
    data: dp1
  },],
  chart: {
    height: 195,
    parentHeightOffset: 0,
    type: 'area',
    toolbar: { show: false },
    sparkline: { enabled: true }
  },
  colors: ['#85b6ff', '#506fd9'],
  grid: {
    borderColor: 'rgba(72, 94, 144, .1)',
    padding: {
      top: -20,
      left: 0
    },
    yaxis: {
      lines: { show: false }
    }
  },
  dataLabels: { enabled: false },
  stroke: {
    curve: 'straight',
    width: 1.5
  },
  xaxis: {
    type: 'numeric',
    min: 5,
    max: 90,
    tickAmount: 6,
    axisBorder: { show: false },
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '11px'
      }
    }
  },
  yaxis: {
    max: 180
  },
  fill: {
    type: 'gradient',
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0,
    }
  },
  legend: { show: false },
  tooltip: { enabled: false }
};

var chartSix = new ApexCharts(document.querySelector('#apexChart6'), optionSix);
chartSix.render();

//----------------------------------------------------

// Volume By Currency
var datapie = {
  labels: ['USD', 'EUR', 'CNY', 'GBP', 'JPY', 'KRW', 'SGD'],
  datasets: [{
    data: [25,15,10,12,9,13,16],
    backgroundColor: ['#506fd9', '#85b6ff','#33d685','#0dcaf0','#1c96e9','#6e7985','#ccd2da']
  }]
};

var optionpie = {
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
};

var ctx2 = document.getElementById('chartDonut');
var myDonutChart = new Chart(ctx2, {
  type: 'doughnut',
  data: datapie,
  options: optionpie
});

// Dark skin integration
function switchDark(enabled) {
  if(enabled) {
    $('.btn-white').addClass('btn-outline-primary').removeClass('btn-white');
    $('.bg-gray-300').addClass('bg-ui-03').removeClass('bg-gray-300');
  } else {
    $('.btn-outline-primary').addClass('btn-white').removeClass('btn-outline-primary');
    $('.bg-ui-03').addClass('bg-gray-300').removeClass('bg-ui-03');
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

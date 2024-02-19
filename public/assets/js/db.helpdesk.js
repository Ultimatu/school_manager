'use strict'

// Complaints Received
var optionOne = {
  series: [{
    data: dp3
  }],
  chart: {
    height: 280,
    parentHeightOffset: 0,
    type: 'area',
    toolbar: {
      show: false
    },
    stacked: true,
    sparkline: {
      enabled: true
    }
  },
  colors: ['#506fd9'],
  stroke: {
    curve: 'straight',
    width: 2
  },
  xaxis: {
    max: 40
  },
  yaxis: {
    min: 0,
    max: 80
  },
  fill: {
    type: 'solid',
    opacity: 0.2
  },
  tooltip: {
    enabled: false
  }
};

var chartOne = new ApexCharts(document.querySelector('#apexChart1'), optionOne);
chartOne.render();

//--------------------------------------------

var optionDonut1 = {
  series: [86, 14],
  chart: {
    type: 'donut',
    width: '160',
    height: '160',
    parentHeightOffset: 0
  },
  colors: ['#506fd9', '#e5e9f2'],
  dataLabels: {
    enabled: false
  },
  legend: {
    show: false
  }
};

var chartDonut1 = new ApexCharts(document.querySelector('#chartDonut1'), optionDonut1);
chartDonut1.render();

var optionDonut2 = {
  series: [68, 32],
  chart: {
    type: 'donut',
    width: '160',
    height: '160',
    parentHeightOffset: 0
  },
  colors: ['#4c5366', '#e5e9f2'],
  dataLabels: {
    enabled: false
  },
  legend: {
    show: false
  }
};

var chartDonut2 = new ApexCharts(document.querySelector('#chartDonut2'), optionDonut2);
chartDonut2.render();

//-------------------------------------------

var optionTwo = {
  series: [{
    name: 'series1',
    data: dp3
  }],
  chart: {
    height: 200,
    parentHeightOffset: 0,
    type: 'area',
    toolbar: {
      show: false
    },
    stacked: true
  },
  colors: ['#4f6fd9'],
  grid: {
    borderColor: 'rgba(72,94,144, 0.08)',
    padding: {
      top: -20,
      left: 0,
      right: -8
    },
    yaxis: {
      lines: {
        show: false
      }
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
    overwriteCategories: ['','JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC',''],
    tickAmount: 13,
    axisBorder: {
      show: false
    },
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '10px'
      }
    },
  },
  yaxis: {
    min: 0,
    max: 50,
    show: false
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

var chartTwo = new ApexCharts(document.querySelector('#apexChart2'), optionTwo);
chartTwo.render();

// Current Ticket Status
var ctx1 = document.getElementById('chartJS1').getContext('2d');
var chart1 = new Chart(ctx1, {
  type: 'bar',
  data: {
    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    datasets: [{
      data: [20, 60, 50, 45, 50, 60, 70, 40, 45, 35, 25, 30],
      backgroundColor: '#506fd9',
      barPercentage: 0.5
    }, {
      data: [10, 40, 30, 40, 60, 55, 45, 35, 30, 20, 15, 20],
      backgroundColor: '#85b6ff',
      barPercentage: 0.5
    }, {
      data: [8, 30, 40, 35, 40, 45, 35, 30, 25, 10, 20, 15],
      backgroundColor: '#e2e5ec',
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
        max: 80,
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
        ticks: {
          color: '#313c47'
        },
        grid: {
          color: 'rgba(65,80,95,.08)'
        }
      }
    }
  }
});

// Tickets By Request Type
var ctx2 = document.getElementById('chartJS2').getContext('2d');
var chart2 = new Chart(ctx2, {
  type: 'bar',
  data: {
    labels: ['Modification', 'Code Request', 'Feature Request', 'Bug Fix', 'Integration', 'Production'],
    datasets: [{
      data: [20, 60, 50, 45, 50, 75],
      backgroundColor: ['#506fd9', '#85b6ff', '#33d685', '#ffc107', '#0dcaf0', '#ea4c89'],
      barPercentage: 0.5
    }, {
      data: [10, 40, 30, 40, 60, 55],
      backgroundColor: '#e2e5ec',
      barPercentage: 0.5
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
        max: 100,
        grid: {
          borderColor: '#e2e5ec',
          color: '#f3f5f9'
        },
        ticks: {
          font: {
            size: 11
          }
        }
      },
      y: {
        grid: {
          borderWidth: 0,
          color: '#f3f5f9'
        },
        ticks: {
          color: '#465463',
          font: {
            size: 13
          }
        }
      }
    }
  }
});

// Dark skin integration
function switchDark(enabled) {
  if(enabled) {
    chart1.options.scales['y'].grid.borderColor = '#222b41';
    chart1.options.scales['x'].ticks.color = 'rgba(255,255,255,.65)';

    chart2.options.scales['x'].grid.color = '#222b41';
    chart2.options.scales['x'].ticks.color = 'rgba(255,255,255,.65)';
    chart2.options.scales['x'].grid.borderColor = '#222b41';
    chart2.options.scales['y'].grid.color = '#222b41';
    chart2.options.scales['y'].ticks.color = 'rgba(255,255,255,.65)';

    chart2.data.datasets[1].backgroundColor = '#222b41';

    $('.btn-white').addClass('btn-outline-primary').removeClass('btn-white');

  } else {
    chart1.options.scales['y'].grid.borderColor = '#e2e5ec';
    chart1.options.scales['x'].ticks.color = '#313c47';

    chart2.options.scales['x'].grid.color = '#edeff6';
    chart2.options.scales['x'].ticks.color = '#42484e';
    chart2.options.scales['x'].grid.borderColor = '#edeff6';
    chart2.options.scales['y'].grid.color = '#edeff6';
    chart2.options.scales['y'].ticks.color = '#42484e';

    chart2.data.datasets[1].backgroundColor = '#e2e5ec';

    $('.btn-outline-primary').addClass('btn-white').removeClass('btn-outline-primary');
  }

  chart1.update();
  chart2.update();
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

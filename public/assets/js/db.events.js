'use strict'

var d1 = [[0,38],[1,32],[2,31],[3,33],[4,34],[5,35],[6,38],[7,37],[8,39],[9,34],[10,33],[11,32],[12,34],[13,38],[14,42],[15,43],[16,45],[17,43],[18,45],[19,48],[20,45],[21,46],[22,44],[23,42],[24,46],[25,48],[26,55],[27,54],[28,58],[29,69]];
var d2 = [[0,12],[1,11],[2,9],[3,10],[4,15],[5,9],[6,11],[7,12],[8,7],[9,16],[10,18],[11,24],[12,16],[13,10],[14,9],[15,16],[16,15],[17,28],[18,20],[19,15],[20,20],[21,12],[22,15],[23,12],[24,10],[25,12],[26,14],[27,18],[28,20],[29,21],];

// Tickets Earnings
var optionOne = {
  series: [{
    name: 'series1',
    data: d1
  },{
    name: 'series2',
    data: d2
  }],
  chart: {
    height: 390,
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
  colors: ['#85b6fe', '#506fd9'],
  stroke: {
    curve: 'straight',
    width: 2
  },
  yaxis: {
    min: 0,
    max: 150,
    show: false
  },
  fill: {
    type: 'gradient',
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0,
    }
  },
  tooltip: {
    enabled: false
  }
};

var chartOne = new ApexCharts(document.querySelector('#apexChart1'), optionOne);
chartOne.render();

//-----------------------------------------------------

// Tickets Available
var optionTwo = {
  series: [{
    type: 'column',
    data: [[0,1],[1,2],[2,5],[3,6],[4,8],[5,10],[6,15],[7,18],[8,13],[9,11],[10,13],[11,15],[12,13],[13,7],[14,5],[15,8],[16,11],[17,7],[18,5],[19,5],[20,6],[21,6],[22,5],[23,5],[24,6],[25,2],[26,1]]
  }, {
    type: 'column',
    data: [[0,2],[1,3],[2,4],[3,8],[4,4],[5,12],[6,4],[7,6],[8,5],[9,10],[10,4],[11,5],[12,10],[13,2],[14,6],[15,16],[16,5],[17,17],[18,14],[19,6],[20,5],[21,2],[22,12],[23,4],[24,7],[25,1],[26,2],[27,1],[28,2],[29,2],[30,1],[31,.2],[32,.2],[33,.2],[34,.2],[35,.2],[36,.2],[37,.2],[38,.2],[39,.2],[40,.2],[41,.2],[42,.2],[43,.2],[44,.2],[45,.2],[46,.2],[47,.2],[48,.2],[49,.2]]
  }],
  chart: {
    width: '100%',
    height: 170,
    stacked: true,
    type: 'line',
    sparkline: {
      enabled: true
    }
  },
  states: {
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
  },
  colors: ['#506fd9', '#e5e9f2'],
  grid: {
    padding: {
      bottom: 10,
      left: 0,
      right: 0
    }
  },
  plotOptions: {
    bar: {
      columnWidth: '40%',
      endingShape: 'rounded'
    },
  },
  stroke: {
    curve: 'straight',
    lineCap: 'square'
  },
  yaxis: {
    min: 0,
    max: 30
  },
  tooltip: {
    enabled: false
  }
};

var chartTwo = new ApexCharts(document.querySelector('#apexChart2'), optionTwo);
chartTwo.render();

//-------------------------------------------

// Tickets Sold
var optionThree = {
  series: [{
    name: 'series1',
    data: d1
  }],
  chart: {
    height: 210,
    parentHeightOffset: 0,
    type: 'area',
    toolbar: {
      show: false
    },
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
    max: 20
  },
  yaxis: {
    min: 0,
    max: 160,
    show: false
  },
  fill: {
    type: 'gradient',
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0,
    }
  },
  tooltip: {
    enabled: false
  }
};

var chartThree = new ApexCharts(document.querySelector('#apexChart3'), optionThree);
chartThree.render();

//-------------------------------------------

// Tickets Unsold
var optionFour = {
  series: [{
    name: 'series1',
    data: d1
  }],
  chart: {
    height: 210,
    parentHeightOffset: 0,
    type: 'area',
    toolbar: {
      show: false
    },
    sparkline: {
      enabled: true
    }
  },
  colors: ['#85b6ff'],
  stroke: {
    curve: 'straight',
    width: 2
  },
  xaxis: {
    min: 3,
    max: 25
  },
  yaxis: {
    min: 0,
    max: 160,
    show: false
  },
  fill: {
    type: 'gradient',
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0,
    }
  },
  tooltip: {
    enabled: false
  }
};

var chartFour = new ApexCharts(document.querySelector('#apexChart4'), optionFour);
chartFour.render();

//---------------------------------------------

// Performance Reached
var optionFive = {
  series: [{
    type: 'column',
    data: [[0,0],[1,40],[2,55],[3,40],[4,30],[5,20],[6,34],[7,45],[8,35],[9,20],[10,40],[11,20],[12,35],[13,30],[14,35],[15,50],[16,30],[17,25],[18,15],[19,20],[20,32],[21,40],[22,55],[23,40],[24,30],[25,20],[26,34],[27,45],[28,35],[29,20],[30,40],[31,20],[32,35],[33,30],[34,35],[35,50],[36,30],[37,25],[38,15],[39,20],[40,32]]
  }, {
    type: 'area',
    data: [[0,82],[1,80],[2,85],[3,80],[4,76],[5,70],[6,74],[7,75],[8,75],[9,70],[10,71],[11,72],[12,75],[13,80],[14,85],[15,80],[16,70],[17,95],[18,95],[19,90],[20,92],[21,90],[22,95],[23,90],[24,90],[25,90],[26,84],[27,85],[28,85],[29,80],[30,70],[31,70],[32,75],[33,70],[34,75],[35,80],[36,75],[37,85],[38,78],[39,70],[40,82]]
  }],
  chart: {
    height: 200,
    parentHeightOffset: 0,
    type: 'line',
    toolbar: {
      show: false
    }
  },
  states: {
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
  },
  colors: ['#3a59c4', '#e5e9f2'],
  plotOptions: {
    bar: {
      columnWidth: '45%'
    },
  },
  grid: {
    borderColor: 'rgba(33,43,48,0.07)',
    padding: {
      top: -20,
      bottom: -5
    },
    yaxis: {
      lines: {
        show: false
      }
    }
  },
  fill: {
    type: ['solid', 'gradient'],
    gradient: {
      type: 'vertical',
      opacityFrom: 0.35,
      opacityTo: 0.2,
      gradientToColors: ['#f3f5fc']
    }
  },
  stroke: {
    width: [0, 2]
  },
  xaxis: {
    type: 'numeric',
    tickAmount: 8,
    decimalsInFloat: 0,
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '9px'
      }
    },
    axisBorder: {
      show: false
    }
  },
  yaxis: {
    show: false,
    min: 0,
    max: 100
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

//-----------------------------------------------------

// Events Categories
var ctx1 = document.getElementById('chartJS1').getContext('2d');
var chart1 = new Chart(ctx1, {
  type: 'bar',
  data: {
    labels: ['Performing Arts', 'Festivals', 'Conferences', 'Sports', 'Community', 'Concerts', 'Politics'],
    datasets: [{
      data: [20, 60, 50, 45, 50, 75, 40],
      backgroundColor: '#506fd9',
      barPercentage: 0.45
    }, {
      data: [10, 40, 30, 40, 60, 55, 50],
      backgroundColor: '#85b6ff',
      barPercentage: 0.45
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
        max: 80,
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
          color: '#212830',
          font: {
            size: 14
          }
        }
      }
    }
  }
});

//-----------------------------------------------------

// Events By Category
var ctx2 = document.getElementById('chartDonut');
var myDonutChart = new Chart(ctx2, {
  type: 'doughnut',
  data: {
    labels: ['Festivals', 'Sports', 'Concerts', 'Performing Arts'],
    datasets: [{
      data: [40,25,20,15],
      backgroundColor: ['#506fd9', '#85b6ff','#50586d','#b9bdc9']
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


// Dark skin integration
function switchDark(enabled) {

  if(enabled) {
    chart1.options.scales['x'].grid.color = '#222b41';
    chart1.options.scales['x'].ticks.color = 'rgba(255,255,255,.65)';
    chart1.options.scales['x'].grid.borderColor = '#222b41';
    chart1.options.scales['y'].grid.color = '#222b41';
    chart1.options.scales['y'].ticks.color = 'rgba(255,255,255,.65)';

    $('.btn-white').addClass('btn-outline-primary').removeClass('btn-white');
    $('.text-primary-dark').addClass('text-primary');

  } else {

    chart1.options.scales['x'].grid.color = '#edeff6';
    chart1.options.scales['x'].ticks.color = '#42484e';
    chart1.options.scales['x'].grid.borderColor = '#edeff6';
    chart1.options.scales['y'].grid.color = '#edeff6';
    chart1.options.scales['y'].ticks.color = '#42484e';

    $('.btn-outline-primary').addClass('btn-white').removeClass('btn-outline-primary');
    $('.text-primary-dark').removeClass('text-primary');
  }

  chart1.update();
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

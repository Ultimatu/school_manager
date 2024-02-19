'use strict'

var optionOne = {
  series: [{
    name: 'series1',
    data: dp3
  },{
    name: 'series2',
    data: dp3
  }],
  chart: {
    height: 430,
    parentHeightOffset: 0,
    type: 'area',
    toolbar: {
      show: false
    },
    stacked: true
  },
  colors: ['#4f6fd9', '#506fd9'],
  grid: {
    borderColor: 'rgba(72,94,144, 0.08)',
    padding: {
      top: -20
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
    width: [2,0]
  },
  xaxis: {
    type: 'numeric',
    tickAmount: 13,
    axisBorder: {
      show: false
    },
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '11px'
      }
    },
  },
  yaxis: {
    min: 0,
    max: 100,
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

var chartOne = new ApexCharts(document.querySelector('#apexChart1'), optionOne);
chartOne.render();

//--------------------------------------------

var optionTwo = {
  series: [{
    type: 'column',
    data: [[0,10],[1,20],[2,35],[3,30],[4,35],[5,50],[6,30],[7,25],[8,15],[9,20],[10,32],[11,40],[12,55],[13,40],[14,30],[15,20],[16,34],[17,45],[18,35],[19,20],[20,40],[21,20],[22,35],[23,30],[24,35],[25,50],[26,30],[27,25],[28,15],[29,20],[30,32],[31,40],[32,55],[33,40],[34,30],[35,20],[36,34],[37,45],[38,35],[39,20],[40,40]]
  }, {
    type: 'area',
    data: [[0,70],[1,71],[2,70],[3,70],[4,78],[5,79],[6,75],[7,70],[8,75],[9,72],[10,74],[11,76],[12,80],[13,81],[14,80],[15,78],[16,80],[17,82],[18,87],[19,80],[20,81],[21,80],[22,70],[23,70],[24,71],[25,75],[26,74],[27,76],[28,80],[29,80],[30,80],[31,76],[32,75],[33,80],[34,81],[35,80],[36,79],[37,78],[38,80],[39,81],[40,80]]
  }],
  chart: {
    height: 100,
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
  colors: ['#c1ccf1', '#506fd9'],
  grid: {
    borderColor: 'rgba(72,94,144, 0.07)',
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
    width: [0, 1.5]
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

var chartTwo = new ApexCharts(document.querySelector('#apexChart2'), optionTwo);
chartTwo.render();

//---------------------------------------------------

var optionThree = {
  series: [{
    type: 'column',
    data: [[0,32],[1,40],[2,55],[3,40],[4,30],[5,20],[6,34],[7,45],[8,35],[9,20],[10,40],[11,20],[12,35],[13,30],[14,35],[15,50],[16,30],[17,25],[18,15],[19,20],[20,32],[21,40],[22,55],[23,40],[24,30],[25,20],[26,34],[27,45],[28,35],[29,20],[30,40],[31,20],[32,35],[33,30],[34,35],[35,50],[36,30],[37,25],[38,15],[39,20],[40,32]]
  }, {
    type: 'area',
    data: [[0,82],[1,80],[2,85],[3,80],[4,76],[5,70],[6,74],[7,75],[8,75],[9,70],[10,71],[11,72],[12,75],[13,80],[14,85],[15,80],[16,70],[17,95],[18,95],[19,90],[20,92],[21,90],[22,95],[23,90],[24,90],[25,90],[26,84],[27,85],[28,85],[29,80],[30,70],[31,70],[32,75],[33,70],[34,75],[35,80],[36,75],[37,85],[38,78],[39,70],[40,82]]
  }],
  chart: {
    height: 100,
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
  colors: ['#cde1ff', '#85b6ff'],
  grid: {
    borderColor: 'rgba(72,94,144, 0.07)',
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
    width: [0, 1.5]
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

var chartThree = new ApexCharts(document.querySelector('#apexChart3'), optionThree);
chartThree.render();

//-------------------------------------------------

var optionFour = {
  series: [{
    type: 'column',
    data: [[0,0],[1,0],[2,5],[3,6],[4,8],[5,10],[6,15],[7,18],[8,13],[9,11],[10,13],[11,15],[12,13],[13,7],[14,5],[15,8],[16,11],[17,7],[18,5],[19,5],[20,6],[21,6],[22,5],[23,5],[24,6]]
  }, {
    type: 'column',
    data: [[0,9],[1,7],[2,4],[3,8],[4,4],[5,12],[6,4],[7,6],[8,5],[9,10],[10,4],[11,5],[12,10],[13,2],[14,6],[15,16],[16,5],[17,17],[18,14],[19,6],[20,5],[21,2],[22,12],[23,4],[24,7]]
  }],
  chart: {
    height: 120,
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
      left: -6,
      right: -5
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

var chartFour = new ApexCharts(document.querySelector('#apexChart4'), optionFour);
chartFour.render();

//------------------------------------------------

var optionFive = {
  series: [{
    type: 'column',
    data: [[0,2],[1,3],[2,5],[3,7],[4,12],[5,17],[6,10],[7,14],[8,15],[9,12],[10,8],[11,6],[12,9],[13,12],[14,5],[15,10],[16,12],[17,16],[18,13],[19,7],[20,4],[21,2],[22,2],[23,2],[24,5]]
  }, {
    type: 'column',
    data: [[0,12],[1,7],[2,4],[3,5],[4,8],[5,10],[6,4],[7,7],[8,11],[9,9],[10,5],[11,3],[12,4],[13,6],[14,6],[15,10],[16,5],[17,7],[18,4],[19,16],[20,15],[21,11],[22,12],[23,4],[24,7]]
  }],
  chart: {
    height: 120,
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
  colors: ['#85b6ff', '#e5e9f2'],
  grid: {
    padding: {
      bottom: 10,
      left: -6,
      right: -5
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

var chartFive = new ApexCharts(document.querySelector('#apexChart5'), optionFive);
chartFive.render();

//----------------------------------------------

var optionSix = {
  series: [{
    name: 'series1',
    data: dp3
  },{
    name: 'series2',
    data: dp3
  }],
  chart: {
    height: '100%',
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
  colors: ['#506fd9', '#85b6ff'],
  stroke: {
    curve: 'straight',
    width: [0,0]
  },
  yaxis: {
    min: 0,
    max: 60,
    show: false
  },
  xaxis: {
    min: 20,
    max: 30
  },
  fill: {
    type: 'gradient',
    gradient: {
      opacityFrom: 0.75,
      opacityTo: 0.25,
    }
  },
  legend: {
    show: false
  },
  tooltip: {
    enabled: false
  }
};

var chartSix = new ApexCharts(document.querySelector('#apexChart6'), optionSix);
chartSix.render();

//-------------------------------------------------

var optionSeven = {
  series: [{
    data: [10, 12, 18, 25, 15, 30, 40, 10, 20, 12, 16, 60, 20, 15, 10, 60, 50, 40, 80, 100, 30, 40, 10, 20, 12, 16, 60, 20, 15, 60, 20, 15, 10, 60, 50, 40, 30, 40, 10, 20, 16, 60, 20, 15, 60, 20, 15, 10, 60, 50, 40, 30, 40, 10, 20]
  },{
    data: [-10, -12, -18, -25, -15, -30, -40, -10, -20, -12, -16, -60, -20, -15, -10, -60, -50, -40, -80, -40, -30, -40, -10, -20, -12, -16, -60, -20, -15, -60, -20, -15, -10, -60, -50, -40, -30, -40, -10, -20, -40, -10, -20, -12, -16, -60, -20, -15, -60, -20, -15, -10, -60, -50, -40]
  }],
  chart: {
    type: 'bar',
    height: 200,
    parentHeightOffset: 0,
    stacked: true,
    toolbar: {
      show: false
    }
  },
  colors: ['#506fd9', '#85b6ff'],
  grid: {
    borderColor: 'rgba(72,94,144, 0.07)',
    padding: {
      top: -20,
      left: 0,
      bottom: -5
    }
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '60%',
      endingShape: 'rounded'
    },
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent']
  },
  yaxis: {
    max: 130,
    tickAmount: 5,
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '10px'
      }
    }
  },
  xaxis: {
    type: 'numeric',
    tickAmount: 10,
    decimalsInFloat: 0,
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '10px',
        fontWeight: 'bold'
      }
    },
    axisBorder: {
      show: false
    }
  },
  fill: {
    opacity: 1
  },
  legend: {
    show: false
  },
  tooltip: {
    enabled: false
  }
};

var chartSeven = new ApexCharts(document.querySelector('#apexChart7'), optionSeven);
chartSeven.render();

//--------------------------------------------------

var optionEight = {
  series: [{
    type: 'column',
    data: [[0,2],[1,3],[2,5],[3,7],[4,12],[5,17],[6,10],[7,14],[8,15],[9,12],[10,8]]
  }, {
    type: 'column',
    data: [[0,12],[1,7],[2,4],[3,5],[4,8],[5,10],[6,4],[7,7],[8,11],[9,9],[10,5]]
  }],
  chart: {
    height: '100%',
    parentHeightOffset: 0,
    stacked: true,
    type: 'line',
    toolbar: {
      show: false
    }
  },
  grid: {
    borderColor: 'rgba(72,94,144, 0.07)',
    padding: {
      top: -20,
      left: 5,
      bottom: -15
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
  plotOptions: {
    bar: {
      columnWidth: '40%',
      endingShape: 'rounded'
    },
  },
  stroke: {
    curve: 'straight',
    lineCap: 'square',
    width: 0
  },
  yaxis: {
    min: 0,
    max: 30,
    tickAmount: 5
  },
  xaxis: {
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '10px',
        fontWeight: '500'
      }
    },
  },
  tooltip: {
    enabled: false
  },
  legend: {
    show: false
  }
};

var chartEight = new ApexCharts(document.querySelector('#apexChart8'), optionEight);
chartEight.render();

//------------------------------------------------

var optionDonut = {
  series: [35, 20, 20, 15],
  chart: {
    type: 'donut',
    height: 'auto',
    parentHeightOffset: 0
  },
  colors: ['#506fd9', '#85b6ff', '#51596d', '#eff1f5'],
  dataLabels: {
    enabled: false
  },
  grid: {
    padding: {
      top: 0,
      bottom: 0
    }
  },
  legend: {
    show: false
  }
};

var chartDonut = new ApexCharts(document.querySelector('#chartDonut'), optionDonut);
chartDonut.render();

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

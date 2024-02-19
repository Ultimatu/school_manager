'use strict'

var data = [[0,9],[1,7],[2,4],[3,8],[4,4],[5,12],[6,4],[7,6],[8,5],[9,10],[10,4],[11,5],[12,10],[13,2],[14,6]];

var chart = {
  width: '100%',
  height: 70,
  parentHeightOffset: 0,
  stacked: true,
  sparkline: {
    enabled: true
  }
};

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

var plotOptions = {
  bar: {
    columnWidth: '60%'
  },
};

var stroke = {
  curve: 'straight',
  lineCap: 'square'
};

// Click Through
var optionOne = {
  series: [{
    type: 'column',
    data: [[0,0],[1,0],[2,5],[3,10],[4,6],[5,10],[6,15],[7,18],[8,7],[9,11],[10,13],[11,15],[12,13],[13,7],[14,5]]
  }, {
    type: 'column',
    data: data
  }],
  chart: chart,
  states: states,
  colors: ['#506fd9', '#e5e9f2'],
  plotOptions: plotOptions,
  stroke: stroke,
  tooltip: {
    enabled: false
  }
};

var chartOne = new ApexCharts(document.querySelector('#apexChart1'), optionOne);
chartOne.render();

// View Through
var optionTwo = {
  series: [{
    type: 'column',
    data: [[0,3],[1,4],[2,12],[3,6],[4,16],[5,5],[6,8],[7,4],[8,3],[9,6],[10,4],[11,10],[12,3],[13,7],[14,10]]
  }, {
    type: 'column',
    data: data
  }],
  chart: chart,
  states: states,
  colors: ['#85b6fe', '#e5e9f2'],
  plotOptions: plotOptions,
  stroke: stroke,
  tooltip: {
    enabled: false
  }
};

var chartTwo = new ApexCharts(document.querySelector('#apexChart2'), optionTwo);
chartTwo.render();

// Total Conversions
var optionThree = {
  series: [{
    type: 'column',
    data: [[0,5],[1,10],[2,20],[3,15],[4,6],[5,10],[6,15],[7,18],[8,7],[9,11],[10,13],[11,15],[12,13],[13,7],[14,5]]
  }, {
    type: 'column',
    data: data
  }],
  chart: chart,
  states: states,
  colors: ['#0dcaf0', '#e5e9f2'],
  plotOptions: plotOptions,
  stroke: stroke,
  tooltip: {
    enabled: false
  }
};

var chartThree = new ApexCharts(document.querySelector('#apexChart3'), optionThree);
chartThree.render();

// Organic Visits & Conversions
var optionFour = {
  series: [{
    data: [[0,1000],[1,600],[2,500],[3,400],[4,600],[5,500],[6,800],[7,1000],[8,900],[9,1100],[10,1500],[11,1700],[12,1400],[13,1300],[14,1500],[15,1300],[16,1200],[17,1000],[18,1100],[19,800],[20,500],[21,300],[22,500],[23,600],[24,500],[25,600],[26,800],[27,1000],[28,900],[29,800],[30,500]]
  }, {
    data: [[0,30],[1,30],[2,30],[3,30],[4,30],[5,30],[6,30],[7,30],[8,30],[9,30],[10,30],[11,30],[12,30],[13,30],[14,30],[15,30],[16,30],[17,30],[18,30],[19,30],[20,30],[21,30],[22,30],[23,30],[24,30],[25,30],[26,30],[27,30],[28,30],[29,30],[30,30]]
  }, {
    data: [[0,800],[1,600],[2,500],[3,400],[4,600],[5,500],[6,800],[7,1000],[8,900],[9,1100],[10,1500],[11,1700],[12,1400],[13,1300],[14,1500],[15,1300],[16,1200],[17,1000],[18,1100],[19,800],[20,500],[21,300],[22,500],[23,600],[24,500],[25,600],[26,800],[27,1000],[28,900],[29,800],[30,500]]
  }],
  chart: {
    type: 'bar',
    height: 300,
    parentHeightOffset: 0,
    stacked: true,
    toolbar: {
      show: false
    }
  },
  dataLabels: {
    enabled: false
  },
  grid: {
    borderColor: 'rgba(72,94,144, 0.07)',
    padding: {
      top: -20,
      left: 5
    }
  },
  states: states,
  colors: ['#506fd9','#fff', '#85b6fe'],
  plotOptions: {
    bar: {
      columnWidth: '35%'
    },
  },
  stroke: {
    curve: 'straight',
    lineCap: 'square',
    width: 0
  },
  tooltip: {
    enabled: false
  },
  fill: {
    opacity: 1
  },
  legend: {
    show: false
  },
  xaxis: {
    type: 'numeric',
    tickAmount: 6,
    decimalsInFloat: 0,
    labels: {
      style: {
        fontSize: '11px'
      }
    }
  },
  yaxis: {
    max: 4000,
    tickAmount: 8,
    labels: {
      style: {
        colors: ['#a2abb5'],
        fontSize: '11px'
      }
    }
  }
};

var chartFour = new ApexCharts(document.querySelector('#apexChart4'), optionFour);
chartFour.render();

// Acquisition
var optionFive = {
  series: [{
    name: 'Growth',
    data: dp1
  },{
    name: 'Actual',
    data: dp2
  }],
  chart: {
    type: 'area',
    height: 140,
    parentHeightOffset: 0,
    stacked: true,
    toolbar: {
      show: false
    }
  },
  colors: ['#9dc3fc', '#506fd9'],
  dataLabels: {
    enabled: false
  },
  grid: {
    borderColor: 'rgba(72,94,144, 0.07)',
    padding: {
      top: -20,
      bottom: 0,
      left: 20
    },
    yaxis: {
      lines: {
        show: false
      }
    }
  },
  stroke: {
    curve: 'smooth',
    width: 1.5
  },
  fill: {
    colors: ['#fff','#81adee'],
    type: ['solid', 'gradient'],
    opacity: 1,
    gradient: {
      opacityFrom: 0.35,
      opacityTo: 0.65,
    }
  },
  legend: {
    show: false
  },
  tooltip: {
    enabled: false
  },
  yaxis: {
    max: 200,
    tickAmount: 6,
    show: false
  },
  xaxis: {
    type: 'numeric',
    tickAmount: 11,
    labels: {
      style: {
        colors: '#6e7985',
        fontSize: '11px'
      }
    },
    axisBorder: {
      show: false
    }
  },
};

var chartFive = new ApexCharts(document.querySelector('#apexChart5'), optionFive);
chartFive.render();

// Sessions By Location
$('#vmap').vectorMap({
  map: 'world_en',
  backgroundColor: '#fff',
  borderColor: '#fff',
  color: '#d9dde7',
  colors: {
    'us': '#1c96e9',
    'in': '#6984de',
    'au': '#33d685',
    'br': '#fd7e14',
    'cn': '#dc3545',
    'jp': '#0dcaf0',
    'sa': '#ffc107'
  },
  hoverColor: null,
  hoverOpacity: 0.8,
  enableZoom: false,
  showTooltip: true,
  multiSelectRegion: true
});


// Dark skin integration
function switchDark(enabled) {
  if(enabled) {
    $('#vmap').vectorMap('set', 'backgroundColor', '#192030');
    $('.btn-white').addClass('btn-outline-primary').removeClass('btn-white');
  } else {
    $('#vmap').vectorMap('set', 'backgroundColor', '#fff');
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

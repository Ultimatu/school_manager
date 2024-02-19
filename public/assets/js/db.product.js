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
    data: [[0,1000],[1,600],[2,500],[3,400],[4,600],[5,500],[6,800],[7,1000],[8,900],[9,1100],[10,1500],[11,1700],[12,1400],[13,1300],[14,1500],[15,1300],[16,1200],[17,1000],[18,1100],[19,800],[20,500],[21,300],[22,500],[23,600],[24,500],[25,600],[26,800],[27,1000],[28,900],[29,800],[30,500]]
  }, {
    data: [[0,30],[1,30],[2,30],[3,30],[4,30],[5,30],[6,30],[7,30],[8,30],[9,30],[10,30],[11,30],[12,30],[13,30],[14,30],[15,30],[16,30],[17,30],[18,30],[19,30],[20,30],[21,30],[22,30],[23,30],[24,30],[25,30],[26,30],[27,30],[28,30],[29,30],[30,30]]
  }, {
    data: [[0,800],[1,600],[2,500],[3,400],[4,600],[5,500],[6,800],[7,1000],[8,900],[9,1100],[10,1500],[11,1700],[12,1400],[13,1300],[14,1500],[15,1300],[16,1200],[17,1000],[18,1100],[19,800],[20,500],[21,300],[22,500],[23,600],[24,500],[25,600],[26,800],[27,1000],[28,900],[29,800],[30,500]]
  }],
  chart: {
    type: 'bar',
    height: 310,
    parentHeightOffset: 0,
    stacked: true,
    toolbar: { show: false }
  },
  dataLabels: { enabled: false },
  grid: {
    borderColor: 'rgba(72,94,144, 0.07)',
    padding: {
      top: -20,
      left: 5
    }
  },
  states: states,
  colors: ['#506fd9','#fff', '#c8ccd4'],
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
  tooltip: { enabled: false },
  fill: { opacity: 1 },
  legend: { show: false },
  xaxis: {
    type: 'numeric',
    tickAmount: 11,
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

var chartOne = new ApexCharts(document.querySelector('#apexChart1'), optionOne);
chartOne.render();

//------------------------------------------

var optionTwo = {
  series: [{
    data: [[9,20],[10,15]]
  },{
    data: [[0,10],[1,6],[2,5],[3,4],[4,6],[5,5],[6,8],[7,10],[8,9],[9,0],[10,0],[11,17],[12,11],[13,15],[14,10],[15,13],[16,12],[17,10],[18,11],[19,8]]
  }],
  chart: {
    type: 'bar',
    height: 180,
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
      bottom: -2
    },
    yaxis: {
      lines: { show: false }
    }
  },
  colors: ['#506fd9','#d9dde7'],
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
    tickAmount: 9,
    decimalsInFloat: 0,
    labels: {
      style: {
        fontSize: '10px',
        fontClor: '#ccc'
      }
    }
  },
  yaxis: {
    show: false,
    max: 38
  },
  states: states,
  dataLabels: { enabled: false },
  tooltip: { enabled: false },
  fill: { opacity: 1 },
  legend: { show: false }
};

var chartTwo = new ApexCharts(document.querySelector('#apexChart2'), optionTwo);
chartTwo.render();

//------------------------------------------------

var optionThree = {
  series: [{
    data: [[9,21]]
  },{
    data: [[0,5],[1,7],[2,10],[3,9],[4,11],[5,14],[6,12],[7,15],[8,16],[9,0],[10,15],[11,17],[12,11],[13,15],[14,10],[15,13],[16,12],[17,10],[18,11],[19,8]]
  }],
  chart: {
    type: 'bar',
    height: 180,
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
      bottom: -2
    },
    yaxis: {
      lines: { show: false }
    }
  },
  colors: ['#4c5366','#d9dde7'],
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
    tickAmount: 9,
    decimalsInFloat: 0,
    labels: {
      style: {
        fontSize: '10px',
        fontClor: '#ccc'
      }
    }
  },
  yaxis: {
    show: false,
    max: 38
  },
  states: states,
  dataLabels: { enabled: false },
  tooltip: { enabled: false },
  fill: { opacity: 1 },
  legend: { show: false }
};

var chartThree = new ApexCharts(document.querySelector('#apexChart3'), optionThree);
chartThree.render();

//------------------------------------------------------

var optionFour = {
  series: [{
    data: [[9,20],[10,10]]
  },{
    data: [[0,3],[1,2],[2,3],[3,4],[4,6],[5,5],[6,8],[7,15],[8,17],[9,0],[10,0],[11,15],[12,11],[13,10],[14,7],[15,8],[16,6],[17,5],[18,3],[19,4]]
  }],
  chart: {
    type: 'bar',
    height: 180,
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
      bottom: -2
    },
    yaxis: {
      lines: { show: false }
    }
  },
  colors: ['#85b6ff','#d9dde7'],
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
    tickAmount: 9,
    decimalsInFloat: 0,
    labels: {
      style: {
        fontSize: '10px',
        fontClor: '#ccc'
      }
    }
  },
  yaxis: {
    show: false,
    max: 38
  },
  states: states,
  dataLabels: { enabled: false },
  tooltip: { enabled: false },
  fill: { opacity: 1 },
  legend: { show: false }
};

var chartFour = new ApexCharts(document.querySelector('#apexChart4'), optionFour);
chartFour.render();

//------------------------------------------------

var optionFive = {
  series: [{
    name: 'Growth',
    data: [
      [0,20],[1,25],[2,20],[3,24],[4,15],[5,16],[6,20],[7,30],[8,40],[9,40],
      [10,40],[11,50],[12,45],[13,35],[14,45],[15,45],[16,50],[17,55],[18,65],[19,45],
      [20,50],[21,65],[22,65],[23,60],[24,70],[25,85],[26,90],[27,100],[28,60],[29,45],
      [30,10],[31,10],[32,15],[33,25],[34,30],[35,45],[36,55],[37,50],[38,60],[39,65],
      [40,80],[41,85],[42,80],[43,90],[44,85],[45,80],[46,100]
    ]
  },{
    name: 'Actual',
    data: [
      [0,60],[1,55],[2,62],[3,54],[4,65],[5,66],[6,60],[7,70],[8,60],[9,70],
      [10,65],[11,75],[12,70],[13,65],[14,85],[15,95],[16,95],[17,105],[18,115],[19,110],
      [20,130],[21,140],[22,165],[23,155],[24,120],[25,110],[26,140],[27,150],[28,170],[29,155],
      [30,165],[31,160],[32,110],[33,140],[34,140],[35,115],[36,105],[37,110],[38,100],[39,110],
      [40,140],[41,130],[42,140],[43,150],[44,180],[45,190],[46,220]
    ]
  }],
  chart: {
    type: 'area',
    height: 328,
    parentHeightOffset: 0,
    stacked: true,
    toolbar: {
      show: false
    }
  },
  colors: ['#4c5366', '#506fd9'],
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
    max: 480,
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
  }
};

var chartFive = new ApexCharts(document.querySelector('#apexChart5'), optionFive);
chartFive.render();

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

'use strict'

// Bar Chart
var optionBar = {
  series: [{
    data: [400, 430, 448, 470, 540, 580, 690, 1100, 1200, 1380]
  }],
  chart: {
    type: 'bar',
    height: 300
  },
  colors: ['#506fd9'],
  plotOptions: {
    bar: {
      borderRadius: 2,
      horizontal: true
    }
  },
  dataLabels: {
    enabled: false
  },
  xaxis: {
    categories: ['South Korea', 'Canada', 'United Kingdom', 'Netherlands', 'Italy', 'France', 'Japan',
    'United States', 'China', 'Germany'
    ],
  }
};

var chartBar = new ApexCharts(document.querySelector('#chartBar'), optionBar);
chartBar.render();


// Column Chart
var optionColumn = {
  series: [{
    name: 'Net Profit',
    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
  }, {
    name: 'Revenue',
    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
  }, {
    name: 'Free Cash Flow',
    data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
  }],
  chart: {
    type: 'bar',
    height: 300
  },
  colors: ['#506fd9', '#85b6ff', '#a8b5c3'],
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '55%',
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
  xaxis: {
    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
  },
  fill: {
    opacity: 1
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return '$ ' + val + ' thousands'
      }
    }
  }
};

var chartColumn = new ApexCharts(document.querySelector('#chartColumn'), optionColumn);
chartColumn.render();

// Stacked Column
var optionStacked = {
  series: [{
    name: 'PRODUCT A',
    data: [44, 55, 41, 67, 22, 43]
  }, {
    name: 'PRODUCT B',
    data: [13, 23, 20, 8, 13, 27]
  }, {
    name: 'PRODUCT C',
    data: [11, 17, 15, 15, 21, 14]
  }, {
    name: 'PRODUCT D',
    data: [21, 7, 25, 13, 22, 8]
  }],
  chart: {
    type: 'bar',
    height: 350,
    stacked: true,
    toolbar: {
      show: false
    },
    zoom: {
      enabled: true
    }
  },
  colors: ['#506fd9', '#85b6ff', '#a8b5c3', '#e5e9f2'],
  responsive: [{
    breakpoint: 480,
    options: {
      legend: {
        position: 'bottom',
        offsetX: -10,
        offsetY: 0
      }
    }
  }],
  plotOptions: {
    bar: {
      horizontal: false,
      dataLabels: {
        total: {
          enabled: true,
          style: {
            fontSize: '13px',
            fontWeight: 900
          }
        }
      }
    },
  },
  xaxis: {
    type: 'datetime',
    categories: ['01/01/2011 GMT', '01/02/2011 GMT', '01/03/2011 GMT', '01/04/2011 GMT',
      '01/05/2011 GMT', '01/06/2011 GMT'
    ],
  },
  legend: {
    show: 'false'
  },
  fill: {
    opacity: 1
  }
};

var chartStacked = new ApexCharts(document.querySelector('#chartStacked'), optionStacked);
chartStacked.render();

// Line Chart
var optionLine = {
  series: [{
    name: 'Desktops',
    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
  }],
  chart: {
    height: 350,
    type: 'line',
    zoom: {
      enabled: false
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight',
    width: 2
  },
  title: {
    text: 'Product Trends by Month',
    align: 'left'
  },
  grid: {
    row: {
      colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
      opacity: 0.5
    },
  },
  xaxis: {
    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
  }
};

var chartLine = new ApexCharts(document.querySelector('#chartLine'), optionLine);
chartLine.render();

// Area Chart
var optionArea = {
  series: [{
    name: 'STOCK ABC',
    data: [
      8107.85,
      8128.0,
      8122.9,
      8165.5,
      8340.7,
      8423.7,
      8423.5,
      8514.3,
      8481.85,
      8487.7,
      8506.9,
      8626.2,
      8668.95,
      8602.3,
      8607.55,
      8512.9,
      8496.25,
      8600.65,
      8881.1,
      9340.85
    ]
  }],
  chart: {
    type: 'area',
    height: 350,
    zoom: {
      enabled: false
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight',
    width: 2
  },
  labels: [
    '13 Nov 2017',
    '14 Nov 2017',
    '15 Nov 2017',
    '16 Nov 2017',
    '17 Nov 2017',
    '20 Nov 2017',
    '21 Nov 2017',
    '22 Nov 2017',
    '23 Nov 2017',
    '24 Nov 2017',
    '27 Nov 2017',
    '28 Nov 2017',
    '29 Nov 2017',
    '30 Nov 2017',
    '01 Dec 2017',
    '04 Dec 2017',
    '05 Dec 2017',
    '06 Dec 2017',
    '07 Dec 2017',
    '08 Dec 2017'
  ],
  xaxis: {
    type: 'datetime',
  },
  yaxis: {
    opposite: true
  },
  legend: {
    horizontalAlign: 'left'
  }
};

var chartArea = new ApexCharts(document.querySelector('#chartArea'), optionArea);
chartArea.render();

// With Radius Chart
var optionRadius = {
  series: [{
    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
  }],
  chart: {
    type: 'bar',
    height: 300,
    toolbar: {
      show: false
    }
  },
  fill: {
    opacity: 0.4
  },
  colors: ['#506fd9'],
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '45%',
      endingShape: 'rounded',
      borderRadius: 12
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    show: true,
    width: 2,
    colors: ['transparent']
  },
  xaxis: {
    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
  },
  fill: {
    opacity: 1
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return '$ ' + val + ' thousands'
      }
    }
  }
};

var chartRadius = new ApexCharts(document.querySelector('#chartRadius'), optionRadius);
chartRadius.render();

// Chart with gradient
var optionGradient = {
  series: [{
    name: 'STOCK ABC',
    data: [
      8107.85,
      8128.0,
      8122.9,
      8165.5,
      8340.7,
      8423.7,
      8423.5,
      8514.3,
      8481.85,
      8487.7,
      8506.9,
      8626.2,
      8668.95,
      8602.3,
      8607.55,
      8512.9,
      8496.25,
      8600.65,
      8881.1,
      9340.85
    ]
  }],
  chart: {
    type: 'area',
    height: 350,
    zoom: {
      enabled: false
    },
    toolbar: {
      show: false
    }
  },
  fill: {
    type: 'gradient',
    gradient: {
      opacityFrom: 0,
      opacityTo: 0.35,
    }
  },
  dataLabels: {
    enabled: false
  },
  stroke: {
    curve: 'straight',
    width: 2
  },
  labels: [
    '13 Nov 2017',
    '14 Nov 2017',
    '15 Nov 2017',
    '16 Nov 2017',
    '17 Nov 2017',
    '20 Nov 2017',
    '21 Nov 2017',
    '22 Nov 2017',
    '23 Nov 2017',
    '24 Nov 2017',
    '27 Nov 2017',
    '28 Nov 2017',
    '29 Nov 2017',
    '30 Nov 2017',
    '01 Dec 2017',
    '04 Dec 2017',
    '05 Dec 2017',
    '06 Dec 2017',
    '07 Dec 2017',
    '08 Dec 2017'
  ],
  xaxis: {
    type: 'datetime'
  },
  yaxis: {
    show: false
  }
};

var chartGradient = new ApexCharts(document.querySelector('#chartGradient'), optionGradient);
chartGradient.render();


// Pie Chart
var optionPie = {
  series: [44, 55, 13, 43, 22],
  chart: {
    width: 380,
    type: 'pie',
  },
  labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 200
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
};

var chartPie = new ApexCharts(document.querySelector('#chartPie'), optionPie);
chartPie.render();

// Donut Chart
var optionDonut = {
  series: [44, 55, 41, 17, 15],
  chart: {
    type: 'donut',
  },
  responsive: [{
    breakpoint: 480,
    options: {
      chart: {
        width: 200
      },
      legend: {
        position: 'bottom'
      }
    }
  }]
};

var chartDonut = new ApexCharts(document.querySelector('#chartDonut'), optionDonut);
chartDonut.render();

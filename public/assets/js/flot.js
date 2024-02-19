$(function(){
  'use strict'

  // Bar Chart
  var flotBar = $.plot('#flotBar', [{
    data: flotSampleData1,
    color: '#506fd9'
  }], {
    series: {
      bars: {
        show: true,
        lineWidth: 0,
        barWidth: .5,
        fill: 1
      }
    },
    grid: {
      borderWidth: 1,
      borderColor: '#edeff6'
    },
    yaxis: {
      max: 60,
      tickColor: '#edeff6',
      ticks: 4,
      font: {
        color: '#001737',
        size: 10
      }
    },
    xaxis: {
      max: 30,
      tickColor: '#edeff6',
      font: {
        color: '#001737',
        size: 10
      }
    }
  });

  // Stacked Chart
  var flotStack = $.plot('#flotStack', [{
    data: flotSampleData1,
    color: '#506fd9'
  },{
    data: flotSampleData2,
    color: '#a8b5c3'
  }], {
    series: {
      stack: 0,
      bars: {
        show: true,
        lineWidth: 0,
        barWidth: .5,
        fill: 1
      }
    },
    grid: {
      borderWidth: 1,
      borderColor: '#edeff6'
    },
    yaxis: {
      max: 120,
      tickColor: '#edeff6',
      ticks: 6,
      font: {
        color: '#001737',
        size: 10
      }
    },
    xaxis: {
      min: 0,
      max: 30,
      tickColor: '#edeff6',
      font: {
        color: '#001737',
        size: 10
      }
    }
  });

  // Line Chart
  var flotLine = $.plot('#flotLine', [{
    data: flotSampleData1,
    color: '#85b6ff'
  },{
    data: flotSampleData2,
    color: '#506fd9'
  }],{
    series: {
      lines: {
        show: true,
        lineWidth: 2
      },
      shadowSize: 0
    },
    grid: {
      hoverable: true,
      clickable: true,
      borderColor: '#ddd',
      borderWidth: 0,
      labelMargin: 5
    },
    yaxis: {
      max: 80,
      tickColor: '#edeff6',
      ticks: 6,
      font: {
        color: '#001737',
        size: 10
      }
    },
    xaxis: {
      min: 0,
      max: 60,
      tickColor: '#edeff6',
      font: {
        color: '#001737',
        size: 10
      }
    }
  });

  // Area Chart
  var flotArea = $.plot('#flotArea', [{
    data: flotSampleData1,
    color: '#506fd9'
  },{
    data: flotSampleData2,
    color: '#85b6ff'
  }],{
    series: {
      stack: 0,
      lines: {
        show: true,
        lineWidth: 0,
        fill: 1
      },
      shadowSize: 0
    },
    grid: {
      hoverable: true,
      clickable: true,
      borderColor: '#ddd',
      borderWidth: 0,
      labelMargin: 5
    },
    yaxis: {
      max: 120,
      tickColor: '#edeff6',
      ticks: 6,
      font: {
        color: '#001737',
        size: 10
      }
    },
    xaxis: {
      min: 0,
      max: 100,
      tickColor: '#edeff6',
      font: {
        color: '#001737',
        size: 10
      }
    }
  });

  // Thresholds
  var flotThreshold = $.plot('#flotThresholds', [{
    data: flotSampleData3,
    color: '#506fd9'
  }], {
    series: {
      threshold: {
        below: 0,
        color: '#a8b5c3'
      },
      bars: {
        show: true,
        lineWidth: 0,
        barWidth: .5,
        fill: 1
      }
    },
    grid: {
      borderWidth: 1,
      borderColor: '#edeff6'
    },
    yaxis: {
      tickColor: '#edeff6',
      ticks: 6,
      font: {
        color: '#001737',
        size: 10
      }
    },
    xaxis: {
      min: 0,
      max: 40,
      tickColor: '#edeff6',
      font: {
        color: '#001737',
        size: 10
      }
    }
  });

  // Percentiles
  var dataset = [{
      label: 'Female mean',
      data: females['mean'],
      lines: {
        show: true
      },
      color: '#506fd9'
    },
    {
      id: 'f15%',
      data: females['15%'],
      lines: {
        show: true,
        lineWidth: 0,
        fill: false
      },
      color: '#0168fa'
    },
    {
      id: 'f25%',
      data: females['25%'],
      lines: {
        show: true,
        lineWidth: 0,
        fill: 0.2
      },
      color: '#0168fa',
      fillBetween: 'f15%'
    },
    {
      id: 'f50%',
      data: females['50%'],
      lines: {
        show: true,
        lineWidth: 0.5,
        fill: 0.4,
        shadowSize: 0
      },
      color: '#0168fa',
      fillBetween: 'f25%'
    },
    {
      id: 'f75%',
      data: females['75%'],
      lines: {
        show: true,
        lineWidth: 0,
        fill: 0.4
      },
      color: '#0168fa',
      fillBetween: 'f50%'
    },
    {
      id: 'f85%',
      data: females['85%'],
      lines: {
        show: true,
        lineWidth: 0,
        fill: 0.2
      },
      color: '#0168fa',
      fillBetween: 'f75%'
    },

    {
      label: 'Male mean',
      data: males['mean'],
      lines: {
        show: true
      },
      color: '#1ce1ac'
    },
    {
      id: 'm15%',
      data: males['15%'],
      lines: {
        show: true,
        lineWidth: 0,
        fill: false
      },
      color: '#1ce1ac'
    },
    {
      id: 'm25%',
      data: males['25%'],
      lines: {
        show: true,
        lineWidth: 0,
        fill: 0.2
      },
      color: '#1ce1ac',
      fillBetween: 'm15%'
    },
    {
      id: 'm50%',
      data: males['50%'],
      lines: {
        show: true,
        lineWidth: 0.5,
        fill: 0.4,
        shadowSize: 0
      },
      color: '#1ce1ac',
      fillBetween: 'm25%'
    },
    {
      id: 'm75%',
      data: males['75%'],
      lines: {
        show: true,
        lineWidth: 0,
        fill: 0.4
      },
      color: '#1ce1ac',
      fillBetween: 'm50%'
    },
    {
      id: 'm85%',
      data: males['85%'],
      lines: {
        show: true,
        lineWidth: 0,
        fill: 0.2
      },
      color: '#1ce1ac',
      fillBetween: 'm75%'
    }
  ];

  var flotPercentile = $.plot('#flotPercentiles', dataset, {
    grid: {
      borderWidth: 1,
      borderColor: '#edeff6'
    },
    legend: { show: false },
    xaxis: {
      tickDecimals: 0,
      tickColor: '#edeff6',
      font: {
        color: '#001737',
        size: 10
      }
    },
    yaxis: {
      font: {
        color: '#001737',
        size: 10
      },
      tickColor: '#edeff6'
    }
  });


  // With crosshair
  var flotCrosshair = $.plot('#flotCrosshair', [{
    data: flotSampleData2,
    color: '#506fd9'
  }],{
    series: {
      lines: {
        show: true,
        lineWidth: 2
      },
      shadowSize: 0
    },
    crosshair: {
      mode: 'xy'
    },
    grid: {
      hoverable: true,
      clickable: true,
      borderColor: '#ddd',
      borderWidth: 0,
      labelMargin: 5
    },
    yaxis: {
      max: 120,
      tickColor: '#edeff6',
      ticks: 6,
      font: {
        color: '#001737',
        size: 10
      }
    },
    xaxis: {
      min: 0,
      max: 100,
      tickColor: '#edeff6',
      font: {
        color: '#001737',
        size: 10
      }
    }
  });


  // Pie Chart
  $.plot('#flotPie', pieData1, {
    series: {
      pie: {
        show: true
      }
    }
  });

  // Donut Chart
  $.plot('#flotDonut', pieData1, {
    series: {
      pie: {
        innerRadius: 0.5,
        show: true
      }
    }
  });

  var isDark = localStorage.getItem('skin-mode');
  if(isDark) {

    // Bar Chart
    var f1 = flotBar.getOptions();
    f1.xaxes[0].tickColor = 'rgba(255,255,255,.05)';
    f1.yaxes[0].tickColor = 'rgba(255,255,255,.05)';
    f1.grid.borderColor = 'rgba(255,255,255,.05)';
    flotBar.setupGrid();
    flotBar.draw();

    // Stacked Bar Chart
    var f2 = flotStack.getOptions();
    f2.xaxes[0].tickColor = 'rgba(255,255,255,.05)';
    f2.yaxes[0].tickColor = 'rgba(255,255,255,.05)';
    f2.grid.borderColor = 'rgba(255,255,255,.05)';
    flotStack.setupGrid();
    flotStack.draw();

    // Line Chart
    var f3 = flotLine.getOptions();
    f3.xaxes[0].tickColor = 'rgba(255,255,255,.05)';
    f3.yaxes[0].tickColor = 'rgba(255,255,255,.05)';
    f3.grid.borderColor = 'rgba(255,255,255,.05)';
    flotLine.setupGrid();
    flotLine.draw();

    // Area Chart
    var f4 = flotArea.getOptions();
    f4.xaxes[0].tickColor = 'rgba(255,255,255,.05)';
    f4.yaxes[0].tickColor = 'rgba(255,255,255,.05)';
    f4.grid.borderColor = 'rgba(255,255,255,.05)';
    flotArea.setupGrid();
    flotArea.draw();

    // Threshold Chart
    var f5 = flotThreshold.getOptions();
    f5.xaxes[0].tickColor = 'rgba(255,255,255,.05)';
    f5.yaxes[0].tickColor = 'rgba(255,255,255,.05)';
    f5.grid.borderColor = 'rgba(255,255,255,.05)';
    flotThreshold.setupGrid();
    flotThreshold.draw();

    // Percentile Chart
    var f6 = flotPercentile.getOptions();
    f6.xaxes[0].tickColor = 'rgba(255,255,255,.05)';
    f6.yaxes[0].tickColor = 'rgba(255,255,255,.05)';
    f6.grid.borderColor = 'rgba(255,255,255,.05)';
    flotPercentile.setupGrid();
    flotPercentile.draw();

    // Crosshair Chart
    var f7 = flotCrosshair.getOptions();
    f7.xaxes[0].tickColor = 'rgba(255,255,255,.05)';
    f7.yaxes[0].tickColor = 'rgba(255,255,255,.05)';
    f7.grid.borderColor = 'rgba(255,255,255,.05)';
    flotCrosshair.setupGrid();
    flotCrosshair.draw();
  }

});

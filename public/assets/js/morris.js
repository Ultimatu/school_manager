$(function(){
  'use strict';

  var morrisData = [
    { y: '2006', a: 100, b: 90 },
    { y: '2007', a: 75,  b: 65 },
    { y: '2008', a: 50,  b: 40 },
    { y: '2009', a: 75,  b: 65 },
    { y: '2010', a: 50,  b: 40 },
    { y: '2011', a: 80, b: 90 },
    { y: '2012', a: 75,  b: 65 },
    { y: '2013', a: 50,  b: 70 }
  ];

  var morrisData2 = [
    { y: '2006', a: 100, b: 90, c: 80 },
    { y: '2007', a: 75,  b: 65, c: 75 },
    { y: '2008', a: 50,  b: 40, c: 45 },
    { y: '2009', a: 75,  b: 65, c: 85 },
    { y: '2010', a: 100, b: 90, c: 80 },
    { y: '2011', a: 75,  b: 65, c: 75 },
    { y: '2012', a: 50,  b: 40, c: 45 },
    { y: '2013', a: 75,  b: 65, c: 85 }
  ];

  var morrisBar = new Morris.Bar({
    element: 'morrisBar',
    data: morrisData2,
    xkey: 'y',
    ykeys: ['a', 'b', 'c'],
    labels: ['Series A', 'Series B', 'Series C'],
    barColors: ['#5774da', '#C4DDFF','#a8b5c3'],
    gridLineColor: '#e5e9f2',
    gridStrokeWidth: 1,
    gridTextSize: 11,
    hideHover: 'auto',
    resize: true
  });

  var morrisStacked = new Morris.Bar({
    element: 'morrisStacked',
    data: morrisData2,
    xkey: 'y',
    ykeys: ['a', 'b', 'c'],
    labels: ['Series A', 'Series B', 'Series C'],
    barColors: ['#5774da', '#C4DDFF','#a8b5c3'],
    stacked: true,
    gridLineColor: '#e5e9f2',
    gridStrokeWidth: 1,
    gridTextSize: 11,
    hideHover: 'auto',
    resize: true
  });


  var morrisLine = Morris.Line({
    element: 'morrisLine',
    data: [
      { y: '2006', a: 20, b: 10, c: 40 },
      { y: '2007', a: 30, b: 15, c: 45 },
      { y: '2008', a: 50, b: 40, c: 65 },
      { y: '2009', a: 40, b: 25, c: 55 },
      { y: '2010', a: 30, b: 15, c: 45 },
      { y: '2011', a: 45, b: 20, c: 65 },
      { y: '2012', a: 60, b: 40, c: 70 }
    ],
    xkey: 'y',
    ykeys: ['a', 'b', 'c'],
    labels: ['Series A', 'Series B', 'Series C'],
    lineColors: ['#5774da', '#C4DDFF','#a8b5c3'],
    lineWidth: 1,
    ymax: 'auto 100',
    gridLineColor: '#e5e9f2',
    gridStrokeWidth: 1,
    gridTextSize: 11,
    hideHover: 'auto',
    resize: true
  });


  var morrisArea = new Morris.Area({
    element: 'morrisArea',
    data: [
      { y: '2006', a: 20, b: 10, c: 40 },
      { y: '2007', a: 30, b: 15, c: 45 },
      { y: '2008', a: 50, b: 40, c: 65 },
      { y: '2009', a: 40, b: 25, c: 55 },
      { y: '2010', a: 30, b: 15, c: 45 },
      { y: '2011', a: 45, b: 20, c: 65 },
      { y: '2012', a: 60, b: 40, c: 70 }
    ],
    xkey: 'y',
    ykeys: ['a', 'b', 'c'],
    labels: ['Series A', 'Series B', 'Series C'],
    lineColors: ['#5774da', '#C4DDFF','#a8b5c3'],
    lineWidth: 1,
    fillOpacity: 0.9,
    gridLineColor: '#e5e9f2',
    gridStrokeWidth: 1,
    gridTextSize: 11,
    hideHover: 'auto',
    resize: true
  });


  new Morris.Donut({
    element: 'morrisDonut',
    data: [
      {label: 'Men', value: 12},
      {label: 'Women', value: 30},
      {label: 'Kids', value: 20},
      {label: 'Infant', value: 25}
    ],
    colors: ['#5774da', '#C4DDFF','#a8b5c3','#41505f'],
    resize: true,
  });

  // Dark Skin
  var isDark = localStorage.getItem('skin-mode');
  if(isDark) {
    morrisBar.options.gridLineColor = 'rgba(255,255,255,0.06)';
    morrisBar.options.gridTextColor = 'rgba(255,255,255,0.65)';
    morrisBar.redraw();

    morrisStacked.options.gridLineColor = 'rgba(255,255,255,0.06)';
    morrisStacked.options.gridTextColor = 'rgba(255,255,255,0.65)';
    morrisStacked.redraw();

    morrisLine.options.gridLineColor = 'rgba(255,255,255,0.06)';
    morrisLine.options.gridTextColor = 'rgba(255,255,255,0.65)';
    morrisLine.redraw();

    morrisArea.options.gridLineColor = 'rgba(255,255,255,0.06)';
    morrisArea.options.gridTextColor = 'rgba(255,255,255,0.65)';
    morrisArea.redraw();
  }

});

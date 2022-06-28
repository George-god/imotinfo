function drawChart() {
// Set Data
var data = google.visualization.arrayToDataTable([
  ['Месец', 'Цена'],
  [1,95],[2,120],[3,150],[4,120],[5,115],
  [6,115],[7,110],[8,110],
  [9,300],[10,250],[11,250]
]);
// Set Options
var options = {
  title: ' Средни ренти на имоти vs. Месеци',
  hAxis: {title: 'Месеци'},
  vAxis: {title: 'Цени'},
  legend: 'none',
  width:660,
  height:400
};
// Draw
var chart = new google.visualization.LineChart(document.getElementById('backchart'));
//var chart = new google.visualization.ScatterChart(document.getElementById('backchart'));
chart.draw(data, options);
}


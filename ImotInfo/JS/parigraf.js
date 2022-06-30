function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Имоти', 'Доходи'],
          ['Апартамент Дружба',     1350],
          ['Хотел Албена',      24000],
          ['Магазин Играчки',  4500]
        ]);

        var options = {
          title: 'Главните имоти с доходи',
          pieHole: 0.4,
          width:660,
          height:400
        };

        var chart = new google.visualization.PieChart(document.getElementById('pchart'));
        chart.draw(data, options);
  }
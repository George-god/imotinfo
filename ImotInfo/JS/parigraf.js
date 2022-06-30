function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Имоти', 'Доходи'],
          ['Apartament Drujba',     1350],
          ['Hotel Albena',      24000],
          ['Magazin Igrachki',  4500]
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
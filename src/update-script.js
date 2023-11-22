const arroserElement = document.getElementById("arroser");
const ouvrirElement = document.getElementById("ouvrir");
const temperatureElement = document.getElementById("temperature");

    arroserElement.addEventListener("click", function() {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "../php/updateArrosage.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
      var dataArrosage = "updateArrosage";
  
      xhr.onreadystatechange = function() {
          if (xhr.readyState == 4 && xhr.status == 200) {
              console.log(xhr.responseText);
          }
      };
  
      xhr.send(dataArrosage);
  })
  ouvrirElement.addEventListener("click", function() {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/updateOuverture.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    var dataOuverture = "updateValue=true";

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };

    xhr.send(dataOuverture);
});

//Chart

  // Get the canvas element
  var ctx = document.getElementById('temperatureChart').getContext('2d');

  var temperatureChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        
      ],  // Time labels
      datasets: [{
        label: 'Temperature',
        data: [],   // Temperature data
        borderColor: 'red',
        fill: false
      }]
    },
    options: {
    scales: {
      x: [{
        type: 'linear',
        position: 'bottom'
      }]
    }
  }
});

  function updateChart() {
    $.ajax({
      url: '../php/update_chart_temperature.php',
      method: 'GET',
      dataType: 'json',
      success: function (data) {

        temperatureChart.data.labels = data.time;
        temperatureChart.data.datasets[0].data = data.temperature;

        temperatureChart.update();
        setTimeout(updateChart, 5000); 
      },
      error: function (error) {
        console.error('Error fetching data:', error);
      }
    });
  }

  updateChart();

  var checkbox = document.getElementById('cb1');
        var chartContainer = document.querySelector('.chart-container');
        var isChartVisible = false; 

        document.getElementById('temperature').addEventListener('click', function () {
            isChartVisible = !isChartVisible;

    chartContainer.style.display = isChartVisible ? 'inline-block' : 'none';
        
        });
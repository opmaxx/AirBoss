const waterElement = document.getElementById("water");
const openElement = document.getElementById("open");
const temperatureElement = document.getElementById("temperature");
const humidityElement = document.getElementById("humidity");

waterElement.addEventListener("click", function(){
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../php/update-water.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
  var dataArrosage = "update-water";
  
  xhr.onreadystatechange = function(){
    if (xhr.readyState == 4 && xhr.status == 200){
      console.log(xhr.responseText);
    }
  };
  
  xhr.send(dataArrosage);
});

openElement.addEventListener("click", function(){
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "../php/update-open.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  var dataOuverture = "updateValue=true";

  xhr.onreadystatechange = function(){
    if (xhr.readyState == 4 && xhr.status == 200){
      console.log(xhr.responseText);
    }
  };

  xhr.send(dataOuverture);
});

//Chart

// Get the canvas element for Temperature
var ctx_temperature = document.getElementById('temperatureChart').getContext('2d');
var temperatureChart = new Chart(ctx_temperature,{
  type: 'line',
  data:{
    labels:[],
    datasets: [{
      label: 'Temperature in °C',
      data: [], // Temperature data
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

function updateTemperatureChart(){
  $.ajax({
    url: '../php/update-chart-temperature.php',
    method: 'GET',
    dataType: 'json',
    success: function (data){
      temperatureChart.data.labels = data.time;
      temperatureChart.data.datasets[0].data = data.temperature;
      temperatureChart.update();
      setTimeout(updateTemperatureChart, 5000); 
    },
    error: function (error){
      console.error('Error fetching data:', error);
    }
  });
};

updateTemperatureChart();

var checkboxTemperature = document.getElementById('cb1');
var chartContainerTemperature = document.querySelector('.chart-container-temperature');
var isChartVisibleTemperature = false; 

document.getElementById('temperature').addEventListener('click', function (){
  isChartVisibleTemperature = !isChartVisibleTemperature;
  chartContainerTemperature.style.display = isChartVisibleTemperature ? 'inline-block' : 'none';
});

// Get the canvas element for humidity
var ctx_humidity = document.getElementById('humidityChart').getContext('2d');

var humidityChart = new Chart(ctx_humidity,{
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'Humidity in %',
        data: [],
        borderColor: 'blue',
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

function updateHumidityChart() {
  $.ajax({
    url: '../php/update-chart-humidity.php',
    method: 'GET',
    dataType: 'json',
    success: function (data) {
      humidityChart.data.labels = data.time;
      humidityChart.data.datasets[0].data = data.humidity;
      humidityChart.update();
      setTimeout(updateHumidityChart, 5000); 
    },
    error: function (error) {
      console.error('Error fetching data:', error);
    }
  });
}

updateHumidityChart();

var checkboxHumidity = document.getElementById('cb2');
var chartContainerHumidity = document.querySelector('.chart-container-humidity');
var isChartVisibleHumidity = false; 

document.getElementById('humidity').addEventListener('click', function (){
  isChartVisibleHumidity = !isChartVisibleHumidity;
  chartContainerHumidity.style.display = isChartVisibleHumidity ? 'inline-block' : 'none';
});
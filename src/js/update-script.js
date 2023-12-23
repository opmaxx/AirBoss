// Get references to DOM elements for control buttons
const waterElement = document.getElementById("water");
const openElement = document.getElementById("open");
const temperatureElement = document.getElementById("temperature");
const humidityElement = document.getElementById("humidity");

// Add event listener for the water button
waterElement.addEventListener("click", function(){
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/update-water.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
    // Define the data to be sent
    var dataArrosage = "update-water";
  
    // Define the callback function to handle the response
    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200){
            console.log(xhr.responseText);
        }
    };
  
    // Send the request with the data
    xhr.send(dataArrosage);
});

// Add event listener for the open button
openElement.addEventListener("click", function(){
    // Create a new XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../php/update-open.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Define the data to be sent
    var dataOuverture = "updateValue=true";

    // Define the callback function to handle the response
    xhr.onreadystatechange = function(){
        if (xhr.readyState == 4 && xhr.status == 200){
            console.log(xhr.responseText);
        }
    };

    // Send the request with the data
    xhr.send(dataOuverture);
});

// Chart setup for Temperature
var ctx_temperature = document.getElementById('temperatureChart').getContext('2d');
var temperatureChart = new Chart(ctx_temperature, {
    type: 'line',
    data: {
        labels: [],
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

// Function to update Temperature chart data
function updateTemperatureChart() {
    $.ajax({
        url: '../php/update-chart-temperature.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            temperatureChart.data.labels = data.time.reverse();
            temperatureChart.data.datasets[0].data = data.temperature.reverse();
            temperatureChart.update();
            setTimeout(updateTemperatureChart, 5000); // Update every 5 seconds
        },
        error: function (error) {
            console.error('Error fetching temperature data:', error);
        }
    });
}

// Initial call to start updating Temperature chart
updateTemperatureChart();

// Toggle visibility of Temperature chart container
var checkboxTemperature = document.getElementById('cb1');
var chartContainerTemperature = document.querySelector('.chart-container-temperature');
var isChartVisibleTemperature = false; 

document.getElementById('temperature').addEventListener('click', function (){
    isChartVisibleTemperature = !isChartVisibleTemperature;
    chartContainerTemperature.style.display = isChartVisibleTemperature ? 'inline-block' : 'none';
});

// Chart setup for Humidity
var ctx_humidity = document.getElementById('humidityChart').getContext('2d');
var humidityChart = new Chart(ctx_humidity, {
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

// Function to update Humidity chart data
function updateHumidityChart() {
    $.ajax({
        url: '../php/update-chart-humidity.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            humidityChart.data.labels = data.time.reverse();
            humidityChart.data.datasets[0].data = data.humidity.reverse();
            humidityChart.update();
            setTimeout(updateHumidityChart, 5000); // Update every 5 seconds
        },
        error: function (error) {
            console.error('Error fetching humidity data:', error);
        }
    });
}

// Initial call to start updating Humidity chart
updateHumidityChart();

// Toggle visibility of Humidity chart container
var checkboxHumidity = document.getElementById('cb2');
var chartContainerHumidity = document.querySelector('.chart-container-humidity');
var isChartVisibleHumidity = false; 

document.getElementById('humidity').addEventListener('click', function (){
    isChartVisibleHumidity = !isChartVisibleHumidity;
    chartContainerHumidity.style.display = isChartVisibleHumidity ? 'inline-block' : 'none';
});
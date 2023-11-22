<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AirBoss - Control Panel</title>
    <link href="../css/style-page.css" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
</head>

<?php
            include("../php/config.inc.php");
             $sql1 = "SELECT temperature, `timestamp`, humidity, battery FROM `parameters`  ";
             $res1 = mysqli_query($con,$sql1);
             while($data1= mysqli_fetch_assoc($res1)){
                 $temperature = $data1['temperature'];
                 $humidity = $data1['humidity'];
                 $battery = $data1['battery'];
             }
?>

<body class="body-control-panel">
<div class="chart-container">
<canvas id="temperatureChart" ></canvas>
</div>
    <section>
        <a href="./index.html">
            <img src="../../assets/logo.png" alt="Logo">
        </a>
        
        <div class="control">
        
            <!-- Température -->
            <div>
                <input type="checkbox" id="cb1" hidden>
                <label for="cb1" id="temperature">
                    <ion-icon name="thermometer-outline"></ion-icon>
                    <?php echo $temperature ?>
                </label>
            </div>

            <div>
                <!-- Humidité -->
                <input type="checkbox" id="cb2" hidden>
                <label for="cb2">
                    <ion-icon id="humidity" name="water-outline"></ion-icon>
                    <?php echo $humidity ?>
                </label>
            </div>

            <div class="warning">
                <!-- warning -->
                <input type="checkbox" id="cb3" hidden>
                <label for="cb3">
                    <ion-icon name="warning-outline"></ion-icon>
                </label>
            </div>

            <div>
                <!-- Batterie -->
                <input type="checkbox" id="cb4" hidden>
                <label for="cb4">
                    <ion-icon id="battery" name="battery-charging-outline"></ion-icon>
                    <?php echo $battery ?>
                </label>
            </div>
            
            <div >
                <!-- Arrosage -->
                <input type="checkbox" id="cb5" hidden>
                <label for="cb5" id="arroser">
                    <ion-icon name="color-fill-outline"></ion-icon>
                </label>
            </div>
             
            <div>
                <!-- Ouverture -->
                <input type="checkbox" id="cb6" hidden>
                <label for="cb6" id="ouvrir">
                    <ion-icon name="push-outline"></ion-icon>
                </label>
            </div>
        </div>
    </section>
    <script src="../js/update-script.js"></script>

</body>
</html>
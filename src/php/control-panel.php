<!DOCTYPE html>
<html lang="en">

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

    // Start session for 10 minutes
    session_start();

    // Check if user is logged in, redirect to login page if not
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        echo "<script>
            alert('Votre session a expiré. Veuillez vous reconnecter.');
            window.location.href = '../html/login.html';
         </script>";
        exit();
    }

    // Check if user is logged in, redirect to login page if not
    $inactivity_timeout = 600;

    // Check for inactivity and logout if exceeded
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactivity_timeout)) {
        session_unset();
        session_destroy();
        echo "<script>
                alert('Votre session a expiré. Veuillez vous reconnecter');
                window.location.href = '../html/login.html';
             </script>";
        exit();
    }

    // Update last activity timestamp
    $_SESSION['last_activity'] = time();

    // Retrieve latest parameters from the database
    $sql1 = "SELECT temperature, `timestamp`, humidity, battery FROM `parameters` ORDER BY `timestamp` DESC LIMIT 1";
    $res1 = mysqli_query($con, $sql1);
    
    // Set default values
    $temperature = 0;
    $humidity = 0;
    $battery = 0;
    
    // Fetch data from the database result
    while ($data1 = mysqli_fetch_assoc($res1)) {
        $temperature = !empty($data1['temperature']) ? $data1['temperature'] : $temperature;
        $humidity = !empty($data1['humidity']) ? $data1['humidity'] : $humidity;
        $battery = !empty($data1['battery']) ? $data1['battery'] : $battery;
    }
?>

<body class="body-control-panel">

    <div class="chart-container-temperature">
        <canvas id="temperatureChart" ></canvas>
    </div>

    <div class="chart-container-humidity">
        <canvas id="humidityChart" ></canvas>
    </div>

    <section>

        <a href="./index.html">
            <img src="../../assets/logo.png" alt="Logo">
        </a>
        
        <div class="control">
        
            <!-- Temperature -->
            <div class="temperature">
                <input type="checkbox" id="cb1" hidden>
                <label for="cb1" id="temperature">
                    <ion-icon name="thermometer-outline"></ion-icon>
                    <?php echo $temperature, "°C"; ?>
                </label>
            </div>

            <!-- Humidity -->
            <div class="humidity">
                <input type="checkbox" id="cb2" hidden>
                <label for="cb2" id="humidity">
                    <ion-icon id="humidity" name="water-outline"></ion-icon>
                    <?php echo $humidity, "%"; ?>
                </label>
            </div>

            <!-- Battery -->
            <div class="battery">
                <input type="checkbox" id="cb3" hidden>
                <label for="cb3">
                    <ion-icon id="battery" name="battery-charging-outline"></ion-icon>
                    <?php echo $battery, "%"; ?>
                </label>
            </div>

            <!-- Warning -->
            <div class="warning">
                <input type="checkbox" id="cb4" hidden>
                <label for="cb4">
                    <ion-icon name="warning-outline"></ion-icon>
                </label>
            </div>
            
            <!-- Water -->
            <div class="water">
                <input type="checkbox" id="cb5" hidden>
                <label for="cb5" id="water">
                    <ion-icon name="color-fill-outline"></ion-icon>
                </label>
            </div>
             
            <!-- Open -->
            <div class="open">
                <input type="checkbox" id="cb6" hidden>
                <label for="cb6" id="open">
                    <ion-icon name="push-outline"></ion-icon>
                </label>
            </div>

        </div>

    </section>
    
    <script src="../js/update-script.js"></script>

</body>
</html>
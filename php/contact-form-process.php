<?php
include("config.inc.php");

if ($con->connect_error) {
  die('Connection failed: ' . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($con, $_POST['Name']);
    $email = mysqli_real_escape_string($con, $_POST['Email']);
    $message = mysqli_real_escape_string($con, $_POST['Message']);

    $sql = "INSERT INTO user_request (email, request) VALUES ('$email', '$message')";

    if ($con->query($sql) === TRUE) {
        $responseMessage = "FRequest send successfully!";
    } else {
        $responseMessage = "Error: " . $sql . "<br>" . $con->error;
    }
    echo "<script>
            alert('$responseMessage');
          </script>";
}

$con->close();
?>

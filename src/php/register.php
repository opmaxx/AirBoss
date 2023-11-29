<?php

require 'config.inc.php';

$username =  $_POST['new-username'];
$email =  $_POST['email'];
$password =  $_POST['new-password'];

if (isset($email) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_verif = true;
} else {
    $email_verif = false;
}

if ($email_verif && isset($username) && isset($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $con->prepare("INSERT INTO user_data (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        // Insert a new row into the 'commands' table with default values or update existing row
        $insertcommandsQuery = "INSERT INTO commands (id, water, open, warning) VALUES (1, 0, 0, 0) ON DUPLICATE KEY UPDATE water=0, open=0, warning=0";
        
        if ($con->query($insertcommandsQuery) === TRUE) {
            echo "<script> 
                var userResponse = confirm('Successfully registered');
                if(userResponse){
                    window.location.href = '../html/login.html';
                }
                </script>";
        } else {
            echo "Error inserting/updating values into 'commands' table: " . $con->error;
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Invalid data. Please fill in all fields correctly";
}

?>

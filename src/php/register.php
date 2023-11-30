<?php
require 'config.inc.php';

// Retrieve user registration information from the POST request
$username =  $_POST['new-username'];
$email =  $_POST['email'];
$password =  $_POST['new-password'];

// Validate email format
if (isset($email) && !empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_verif = true;
} else {
    $email_verif = false;
}

// Check if email, username, and password are provided and in valid format
if ($email_verif && isset($username) && isset($password)) {
    // Hash the password using the default algorithm
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute a SQL query to insert user data into the 'user_data' table
    $stmt = $con->prepare("INSERT INTO user_data (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        // Insert a new row into the 'commands' table with default values or update existing row
        $insertcommandsQuery = "INSERT INTO commands (id, water, open, warning) VALUES (1, 0, 0, 0) ON DUPLICATE KEY UPDATE water=0, open=0, warning=0";
        
        // Check if the 'commands' table insertion/update was successful
        if ($con->query($insertcommandsQuery) === TRUE) {
            echo "<script> 
                var userResponse = confirm('Successfully registered');
                if(userResponse){
                    window.location.href = '../html/login.html';
                }
                </script>";
        } else {
            // Display an error message if there is an issue with 'commands' table insertion/update
            echo "Error inserting/updating values into 'commands' table: " . $con->error;
        }
    } else {
        // Display an error message if there is an issue with 'user_data' table insertion
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Invalid data. Please fill in all fields correctly";
}
?>
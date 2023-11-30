<?php
require 'config.inc.php';

// Retrieve username and password from the POST request
$username = $_POST['current-username'];
$password = $_POST['current-password'];

// Prepare and execute a SQL query to retrieve hashed password based on the provided username
$sql_query = "SELECT password FROM user_data WHERE username = ?";
$stmt = mysqli_prepare($con, $sql_query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $hashed_password);

// Fetch the hashed password from the query result
if (mysqli_stmt_fetch($stmt)) {
    
    // Verify the provided password with the hashed password
    if (password_verify($password, $hashed_password)) {
        // Start a new session
        session_start();

        // Store user information in the session
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['last_activity'] = time();

        // Set a cookie to identify the user
        $cookie_name = "user";
        $cookie_value = $username;
        setcookie($cookie_name, $cookie_value, time() + 600, "/"); // Expires in 10 minutes

        // Redirect to the control panel after successful login
        header("Location: ../php/control-panel.php");
        exit();
    } else {
        // Display an alert and redirect to the login page if the username or password is incorrect
        echo "<script>alert('Username or password is incorrect');</script>";
        header("Location: ../html/login.html");
    }
} else {
    // Display an alert and redirect to the login page if the username is not found
    echo "<script>alert('Username not found');</script>";
    header("Location: ../html/login.html");
}

mysqli_stmt_close($stmt);
?>
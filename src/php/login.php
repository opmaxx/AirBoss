<?php
require 'config.inc.php';

$username = $_POST['current-username'];
$password = $_POST['current-password'];

$sql_query = "SELECT password FROM user_data WHERE username = ?";
$stmt = mysqli_prepare($con, $sql_query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $hashed_password);

if (mysqli_stmt_fetch($stmt)) {
    
    if (password_verify($password, $hashed_password)) {
        echo "<script> alert('Login successful: Username - $username, Password - $password') </script>";
        header("Location: ../html/control-panel.html");
    } else {
        echo "<script>alert('Username or password is incorrect');</script>";
        header("Location: ../html/login.html");
    }
} else {
    echo "<script>alert('Username not found');</script>";
    header("Location: ../html/login.html");
}

mysqli_stmt_close($stmt);

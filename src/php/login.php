<?php
// login.php

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
        session_start();

        // Stocker des informations de l'utilisateur dans la session
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['last_activity'] = time();

        // Définir un cookie pour identifier l'utilisateur
        $cookie_name = "user";
        $cookie_value = $username;
        setcookie($cookie_name, $cookie_value, time() + 600, "/"); // expire dans 10 minutes
        header("Location: ../php/control-panel.php");
        exit();
    } else {
        echo "<script>alert('Username or password is incorrect');</script>";
        header("Location: ../html/login.html");
    }
} else {
    echo "<script>alert('Username not found');</script>";
    header("Location: ../html/login.html");
}

mysqli_stmt_close($stmt);
?>
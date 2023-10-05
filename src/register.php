<?php

require 'config.inc.php';

//Recupération des données
$username =  $_POST['new-username'];
$email =  $_POST['email'];
$password =  $_POST['new-password'];

//Vérification de l'email
if(isset($email) == true && empty($email) == false)
{
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == true)
    {
        $email_verif = true;
    }
    else
    {
        $email_verif = false;
    }
}

if ($email_verif == TRUE && isset($username) && isset($password)) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    // Envoie des données dans la BDD
    $stmt = $con->prepare("INSERT INTO user_data (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "<script> 
            var userResponse = confirm('Enregistré avec succès!');
            if(userResponse){
                window.location.href = 'login.html';
            }
            </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Invalid data. Please fill in all fields correctly.";
}



?>

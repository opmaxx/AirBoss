<?php

$db_host =  "localhost";
$db_user = "root";
$db_password = ""; // Be careful it can be also "admin"
$db_name = "greenhouse";
    
$con = mysqli_connect($db_host,$db_user,$db_password,$db_name);

// if (!$con) {
//     die("An error occured during the connexion : " . mysqli_connect_error());
// } else {
//     echo "Succesfully connected";
// }

?>
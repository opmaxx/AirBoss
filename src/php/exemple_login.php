<?php
    
    require 'config.inc.php';
    
    /* Variables */
    $id = $_POST['identifiant'];
    $mdp = $_POST['mdp'];
    
    /* Connexion */
    $sql_query = "select * from informations where identifiant like '$id' and droit like '3' and mot_de_passe like '$mdp';";
    $result = mysqli_query($con,$sql_query);
    
    if(mysqli_num_rows($result)>0)
    {
        echo file_get_contents("../site/joueurs/accueil.html");
    }
    else
    {
        echo file_get_contents("../site/joueurs/connexion.html");
        echo "<script> alert('Identifiant ou mot de passe incorrect') </script>";
    }

?>

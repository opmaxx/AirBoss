<?php

require 'config.inc.php';

//Recupération des données
$identifiant =  $_POST['identifiant'];
$email =  $_POST['email'];
$masse =  $_POST['masse'];
$taille =  $_POST['taille'];
$date_naissance = $_POST['naissance'];
$droit = '3';


//Création d'un mdp aléatoire
$pass = "";
$longueur = '12';
$tpass =array();
$rg = 0;
    
for($i = 48 ; $i < 58 ; $i++) $tpass[$rg++]=chr($i);
for($i = 65 ; $i < 91 ; $i++) $tpass[$rg++]=chr($i);
for($i = 97 ; $i < 123 ; $i++) $tpass[$rg++]=chr($i);
for($i = 0; $i < $longueur; $i++)
{
    $pass .= $tpass[rand(0, $rg-1)];
}

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

if(empty($identifiant) == false && empty($masse) == false && empty($taille) == false && empty($date_naissance) == false && $email_verif == TRUE)
    {
        //Envoie des données dans la BDD
        $sql_query = "insert into informations values('$identifiant','$email','$pass','$masse','$taille','$date_naissance','$droit');";
        
        //Envoie d'un mail avec l'identifiant et le mot de passe aléatoire
        $to = $email;
        $subject = 'Identifiant ADA Basket Blois';
        $message = '<h4>Voici les informations relatives à votre compte</h4><br>'.
                "identifiant : $identifiant<br>".
        		"Mot de passe : $pass\n";
        
        $email_from = 'mathias.amichaud@gmail.com';
        $headers = "From : ADA Basket Blois $email_from \r\n";
        $headers .= "Reply-to : $email\r\n";
        $headers .= "Content-type : text/html\r\n";
        
        mail($to,$subject,$message,$headers);
        
        $result = mysqli_query($con,$sql_query);
        if($result>0)
        {
           echo file_get_contents("../site/coachs/accueil.html"); 
           echo "<script> alert('Compte crée avec succès') </script>";
        }
        else
        {
            // Si problème de connexion
            echo file_get_contents("../site/coachs/inscription_joueur.html");
            echo "<script> alert('Une erreur est survenue') </script>";
        }
    }
else
    {   
        echo file_get_contents("../site/coachs/inscription_joueur.html");
        echo "<script> alert('Veuillez remplir tous les champs correctement') </script>";
    }


?>
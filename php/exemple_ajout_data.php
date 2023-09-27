<?php
require 'config.inc.php';

$servername =  $db_host;
$username = $db_user;
$password = $db_password;
$database = $db_name;
    
try {   //Connexion BDD
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "<strong>Connected successfully</strong></br>"; 
    } catch(PDOException $e) {    
    //echo "Connection failed: " . $e->getMessage();
    echo file_get_contents("../site/joueurs/notes_entrainements.html");
    echo "<script> alert('Une erreur est survenue') </script>";
    }
    
//Vérifiaction données
$con = mysqli_connect($servername,$username,$password,$database);

$identifiant=$_POST['identifiant'];
$sql_right = "select * from informations where identifiant = '$identifiant' and droit = '3'";
$result_right =  mysqli_query($con,$sql_right);

if(mysqli_num_rows($result_right) > 0)
{
    //Insertion BDD note_joueur
    $req = $conn->prepare('INSERT INTO notes_joueurs(identifiant, motivation, effort, sommeil, humeur, douleurs_physiques) VALUES(:identifiant, :motivation, :effort, :sommeil, :humeur, :douleurs_physiques)');
    
    $identifiant=$_POST['identifiant'];
    //$date_jour=$_POST['date_jour'];
    $motivation=$_POST['motivation'];
    $effort=$_POST['effort'];
    $sommeil=$_POST['sommeil'];
    $humeur=$_POST['humeur'];
    $douleurs_physiques=$_POST['douleurs_physiques'];
    $req->execute(array(
        'identifiant' => $identifiant,
    	//'date_jour' => $date_jour,
    	'motivation' => $motivation,
    	'effort' => $effort,
    	'sommeil' => $sommeil,
    	'humeur' => $humeur,
    	'douleurs_physiques' => $douleurs_physiques,
    	));
    
    //echo 'Les notes ont bien été ajoutées !';
    echo file_get_contents("../site/joueurs/accueil.html");
    echo "<script> alert('Les notes ont bien été ajoutées !') </script>";
    $req->closeCursor();
}
else
{
    //echo 'Erreur';
    echo file_get_contents("../site/joueurs/notes_entrainements.html");
    echo "<script> alert('Une erreur est survenue') </script>";
}

?>

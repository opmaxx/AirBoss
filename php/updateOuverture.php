<?php
include("config.inc.php");

$sqlSelect = "SELECT ouvrir FROM commandes";
$result = $con->query($sqlSelect);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentValue = $row["ouvrir"];

    $newValue = ($currentValue == 1) ? 0 : 1;

    $sqlUpdate = "UPDATE commandes SET ouvrir = '$newValue'";

    if ($con->query($sqlUpdate) === TRUE) {
        echo "ouvrir set to $newValue!";
    } else {
        echo "Error updating ouvrir: " . $con->error;
    }
} else {
    echo "Error fetching current ouvrir value: " . $con->error;
}
?>

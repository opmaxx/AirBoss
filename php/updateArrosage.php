<?php
include("config.inc.php");

$sqlSelect = "SELECT arroser FROM commandes";
$result = $con->query($sqlSelect);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $currentValue = $row["arroser"];

    $newValue = ($currentValue == 1) ? 0 : 1;

    $sqlUpdate = "UPDATE commandes SET arroser = '$newValue'";

    if ($con->query($sqlUpdate) === TRUE) {
        echo "Arrosage set to $newValue!";
    } else {
        echo "Error updating arrosage: " . $con->error;
    }
} else {
    echo "Error fetching current arrosage value: " . $con->error;
}
?>

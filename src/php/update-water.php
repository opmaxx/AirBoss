<?php
include("config.inc.php");

$sqlSelect = "SELECT water FROM commands";
$result = $con->query($sqlSelect);

if ($result === false) {
    echo "Error executing query: " . $con->error;
} else {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentValue = $row["water"];

        $newValue = ($currentValue == 1) ? 0 : 1;

        $sqlUpdate = "UPDATE commands SET water = '$newValue'";

        if ($con->query($sqlUpdate) === TRUE) {
            echo "Arrosage set to $newValue!";
        } else {
            echo "Error updating arrosage: " . $con->error;
        }
    } else {
        echo "No rows found in the 'commands' table.";
    }
}
?>

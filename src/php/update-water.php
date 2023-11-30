<?php
include("config.inc.php");

// SQL query to select the 'water' value from the 'commands' table
$sqlSelect = "SELECT water FROM commands";
$result = $con->query($sqlSelect);

// Check for errors in query execution
if ($result === false) {
    echo "Error executing query: " . $con->error;
} else {
    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        // Fetch the current 'water' value
        $row = $result->fetch_assoc();
        $currentValue = $row["water"];

        // Toggle the value between 0 and 1
        $newValue = ($currentValue == 1) ? 0 : 1;

        // SQL query to update the 'water' value in the 'commands' table
        $sqlUpdate = "UPDATE commands SET water = '$newValue'";

        // Check if the update was successful
        if ($con->query($sqlUpdate) === TRUE) {
            echo "Arrosage set to $newValue!";
        } else {
            echo "Error updating arrosage: " . $con->error;
        }
    } else {
        // Display a message if no rows are found in the 'commands' table
        echo "No rows found in the 'commands' table.";
    }
}
?>
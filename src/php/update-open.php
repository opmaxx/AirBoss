<?php
include("config.inc.php");

// SQL query to select the 'open' value from the 'commands' table
$sqlSelect = "SELECT open FROM commands";
$result = $con->query($sqlSelect);

// Check for errors in query execution
if ($result === false) {
    echo "Error executing query: " . $con->error;
} else {
    // Check if there are rows in the result
    if ($result->num_rows > 0) {
        // Fetch the current 'open' value
        $row = $result->fetch_assoc();
        $currentValue = $row["open"];
        
        // Toggle the value between 0 and 1
        $newValue = ($currentValue == 1) ? 0 : 1;

        // SQL query to update the 'open' value in the 'commands' table
        $sqlUpdate = "UPDATE commands SET open = '$newValue'";

        // Check if the update was successful
        if ($con->query($sqlUpdate) === TRUE) {
            echo "open set to $newValue!";
        } else {
            echo "Error updating open: " . $con->error;
        }
    } else {
        // Display a message if no rows are found in the 'commands' table
        echo "No rows found in the 'commands' table.";
    }
}
?>
<?php
include("config.inc.php");

// Check database connection
if ($con->connect_error) {
  die('Connection failed: ' . $con->connect_error);
}

// SQL query to retrieve timestamp and temperature data from the 'parameters' table
$sql = 'SELECT `timestamp`, temperature FROM parameters ORDER BY `timestamp`';
$result = $con->query($sql);

// Check for errors in query execution
if (!$result) {
  die('Error executing query: ' . $con->error);
}

// Initialize arrays to store timestamp and temperature data
$data = array('time' => array(), 'temperature' => array());

// Fetch data from the query result and format the timestamp
while ($row = $result->fetch_assoc()) {
  $formattedTimestamp = date('H:i', strtotime($row['timestamp']));

  // Populate the arrays with timestamp and temperature values
  $data['time'][] = $formattedTimestamp;
  $data['temperature'][] = $row['temperature'];
}

// Reverse the arrays to display data in chronological order
$data['time'] = array_reverse($data['time']);
$data['temperature'] = array_reverse($data['temperature']);

// Set the response content type to JSON
header('Content-Type: application/json');

// Convert the data array to JSON and echo the result
echo json_encode($data);
?>
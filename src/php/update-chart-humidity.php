<?php
include("config.inc.php");

// Check database connection
if ($con->connect_error) {
  die('Connection failed: ' . $con->connect_error);
}

// SQL query to retrieve timestamp and humidity data from the 'parameters' table
$sql = 'SELECT `timestamp`, humidity FROM parameters ORDER BY `timestamp`';
$result = $con->query($sql);

// Check for errors in query execution
if (!$result) {
  die('Error executing query: ' . $con->error);
}

// Initialize arrays to store timestamp and humidity data
$data = array('time' => array(), 'humidity' => array());

// Fetch data from the query result and format the timestamp
while ($row = $result->fetch_assoc()) {
  $formattedTimestamp = date('H:i', strtotime($row['timestamp']));

  // Populate the arrays with timestamp and humidity values
  $data['time'][] = $formattedTimestamp;
  $data['humidity'][] = $row['humidity'];
}

// Reverse the arrays to display data in chronological order
$data['time'] = array_reverse($data['time']);
$data['humidity'] = array_reverse($data['humidity']);

// Set the response content type to JSON
header('Content-Type: application/json');

// Convert the data array to JSON and echo the result
echo json_encode($data);
?>
<?php
include("config.inc.php");

if ($con->connect_error) {
  die('Connection failed: ' . $con->connect_error);
}

$sql = 'SELECT `timestamp`, temperature FROM parameters ORDER BY `timestamp`';
$result = $con->query($sql);

if (!$result) {
    die('Error executing query: ' . $con->error);
}
$data = array('time' => array(), 'temperature' => array());

while ($row = $result->fetch_assoc()) {
  $formattedTimestamp = date('H:i', strtotime($row['timestamp']));

  $data['time'][] = $formattedTimestamp;
  $data['temperature'][] = $row['temperature'];
}

$data['time'] = array_reverse($data['time']);
$data['temperature'] = array_reverse($data['temperature']);

header('Content-Type: application/json');
echo json_encode($data);
?>
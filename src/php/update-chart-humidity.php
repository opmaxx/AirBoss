<?php
include("config.inc.php");

if ($con->connect_error) {
  die('Connection failed: ' . $con->connect_error);
}

$sql = 'SELECT `timestamp`, humidity FROM parameters ORDER BY `timestamp`';
$result = $con->query($sql);

if (!$result) {
    die('Error executing query: ' . $con->error);
}
$data = array('time' => array(), 'humidity' => array());

while ($row = $result->fetch_assoc()) {
  $formattedTimestamp = date('H:i', strtotime($row['timestamp']));

  $data['time'][] = $formattedTimestamp;
  $data['humidity'][] = $row['humidity'];
}

$data['time'] = array_reverse($data['time']);
$data['humidity'] = array_reverse($data['humidity']);

header('Content-Type: application/json');
echo json_encode($data);
?>
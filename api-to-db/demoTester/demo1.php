<?php
$json1 = '{"id": "GD01", "name": "Garrett Davidson", "position": "System Administrator", "location": "New York"}';
$json2 = '{"id": "DW02", "name": "Donna Winters", "position": "Senior Programmer", "location": "Seattle"}';

// decode json to array
$array[] = json_decode($json1, true);
$array[] = json_decode($json2, true);

// encode array to json
$result = json_encode($array);

// print merged json
header('Content-type: text/javascript');
echo $result;
?>
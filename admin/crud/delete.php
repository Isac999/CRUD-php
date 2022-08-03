<?php 
include('./connect.php');
//header('Location: ./admin.php');

$data = file_get_contents('php://input');
$data = str_replace(['{', '}', '"', ':', 'id'], "", $data);
$arrayData = explode("-", $data);
print_r($arrayData);

$exec = "DELETE FROM `$arrayData[1]` WHERE id = '$arrayData[0]'";
$query = $mysqli->query($exec);

?>
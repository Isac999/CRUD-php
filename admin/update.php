<?php 
include('./connect.php');
//header('Location: ./admin.php');
/*
$option = $_POST['option'];

$id_target = $_POST['id-target'];
$select_opt = $_POST['select-opt'];
$new_value = $_POST['new-value'];

$value = $mysqli->real_escape_string($new_value);

$exec = "UPDATE `$option` SET `$select_opt` = '$value' WHERE `$option`.`id` = '$id_target'";
$query = $mysqli->query($exec) or die('Falha ao executar update!');
*/
echo "antes";
$data = file_get_contents('php://input');
echo $data;
echo "apos";
?>
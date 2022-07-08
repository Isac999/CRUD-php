<?php 
include('./connect.php');
header('Location: ./admin.php');

$id_target = $_POST['id-target'];
$select_opt = $_POST['select-opt'];
$new_value = $_POST['new-value'];

$value = $mysqli->real_escape_string($new_value);

$exec = "UPDATE `books` SET `$select_opt` = '$value' WHERE `books`.`id` = '$id_target'";
$query = $mysqli->query($exec) or die('Falha ao executar update!');

?>
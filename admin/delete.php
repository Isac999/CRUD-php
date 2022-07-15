<?php 

include('./connect.php');
header('Location: ./admin.php');

$option = $_POST['select-delete'];
$id_del = $_POST['id-del'];

$exec = "DELETE FROM `$option` WHERE id = '$id_del'";
$query = $mysqli->query($exec);
?>
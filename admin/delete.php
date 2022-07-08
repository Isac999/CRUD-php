<?php 

include('./connect.php');
header('Location: ./admin.php');

$id_del = $_POST['id-del'];

$exec = "DELETE FROM books WHERE id = '$id_del'";
$query = $mysqli->query($exec);
?>
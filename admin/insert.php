<?php 
include('./connect.php');
header('Location: ./admin.php');

$name = $_POST['name'];
$genre = $_POST['genre'];
$author = $_POST['author'];
$library_id = $_POST['library_id'];

$exec = "INSERT INTO books (`name`, `genre`, `author`, `library_id`) VALUES ('$name', '$genre', '$author', '$library_id')";
$query = $mysqli->query($exec) or die('Falha ao executar inserção!'); 

?>
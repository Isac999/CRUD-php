<?php 
include('./connect.php');
header('Location: ./admin.php');

$id = $_POST['id'];
$name = $_POST['name'];
$genre = $_POST['genre'];
$author = $_POST['author'];
$library_id = $_POST['library_id'];

$exec = "INSERT INTO books (`id`, `name`, `genre`, `author`, `library_id`) VALUES ('$id', '$name', '$genre', '$author', '$library_id')";
$query = $mysqli->query($exec) or die('Falha ao executar inserção!'); 

?>
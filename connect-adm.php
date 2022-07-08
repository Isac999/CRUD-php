<?php 
$usuario = 'root';
$senha = '';
$database = 'admin';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if ($mysqli->error) {
    die('Falha ao conectar! erro: '.$mysqli->error);
}
?>
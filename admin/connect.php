<?php 
$usuario = 'root';
$senha = '';
$database = 'library';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if ($mysqli->error) {
    die('Falha ao conectar! erro: '.$mysqli->error);
}
?>
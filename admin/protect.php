<?php 

if (!isset($_SESSION)) {
    session_start();
} 
if (!isset($_SESSION['id'])) {
    die("Você não tem acesso a está página! Faça login <a href='./../login.php'>clicando aqui</a>");
}

?>
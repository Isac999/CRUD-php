<?php 
include('connect-adm.php');

if (isset($_POST['email']) && isset($_POST['password'])) {

    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['password']);

    $exec = "SELECT * FROM login WHERE email = '$email' AND senha = '$senha'";
    $query = $mysqli->query($exec) or die('Falha ao executar consulta! mensagem: '.$mysqli->error);

    $numRows = $query->num_rows;

    if (!empty($numRows)) {
        $login = $query->fetch_assoc();
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['id'] = $login['id'];

        header('Location: ./admin/admin.php');

    } else {
        echo 'Incorrect email or password!';
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
</head>
<body>
    <form action="" method="post" id="form">
        <div>
            <label for="email"> Email: </label>
            <input type="email" name="email" placeholder="Enter your e-mail here" required> <br>
            <label for="password"> Password: </label>
            <input type="password" name="password" placeholder="Enter your password here" required> <br>
        </div>
        <input type="submit" value="login">
    </form>
</body>
</html>
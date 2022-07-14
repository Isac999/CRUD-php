<?php 
include('protect.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin </title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <h1> Welcome to the admin panel! </h1>
    <a href='logout.php'> To end your session click here </a> <br> <br>
    <fieldset>
    <legend><h2> Register data </h2></legend>
        <select name="select-table-create" id="select-table-create">
            <option value="books">Books</option>
            <option value="customers">Customers</option>
            <option value="books_rentals">Books Rentals</option>
            <option value="requests_to_suppliers">Requests to Suppliers</option>
            <option value="suppliers">Suppliers</option>
            <option value="libraries">Libraries</option>
        </select>
        <form action="insert.php" method="post">
            <div>
                <label for="name">Name: </label>
                <input type="text" name="name" placeholder="Type here"> <br>
                <label for="genre">Genre: </label>
                <input type="text" name="genre" placeholder="Type here"> <br>
                <label for="author">Author: </label>
                <input type="text" name="author" placeholder="Type here"> <br>
                <label for="library_id">Library id: </label>
                <input type="number" name="library_id" placeholder="Type here"> <br>
                <input type="text" name="option" value="books" class="option-class" hidden>
                <input type="submit" value="send">
            </div>
        </form>
    </fieldset>
    <fieldset>
        <legend><h2> Update data </h2></legend>
        <select name="select-table-update" id="select-table-update">
            <option value="books">Books</option>
            <option value="customers">Customers</option>
            <option value="books_rentals">Books Rentals</option>
            <option value="requests_to_suppliers">Requests to Suppliers</option>
            <option value="suppliers">Suppliers</option>
            <option value="libraries">Libraries</option>
        </select>
        <form action="update.php" method="post">
            <div>
                <label for="id-target">Id: </label>
                <input type="number" name="id-target" placeholder="Id target" required> <br>
                <label for="select-opt"> Attribute you want to change: </label>
                <select name="select-opt" id="select-css">
                    <option value="name">Name</option>
                    <option value="genre">Genre</option>
                    <option value="author">Author</option>
                    <option value="library_id">Library id</option>
                </select> <br>
                <label for="new-value" required>Enter the new value: </label> 
                <input type="text" name="new-value" placeholder="new attribute value"> <br>
                <input type="text" name="option" value="books" class="option-class" hidden>
            </div>
            <input type="submit" value="change">
        </form>
    </fieldset>
    <fieldset>
    <legend><h2> Delete data </h2></legend>
        <select name="select-table-delete" id="select-table-delete">
            <option value="books">Books</option>
            <option value="customers">Customers</option>
            <option value="books_rentals">Books Rentals</option>
            <option value="requests_to_suppliers">Requests to Suppliers</option>
            <option value="suppliers">Suppliers</option>
            <option value="libraries">Libraries</option>
        </select>
        <form action="delete.php" method="post" id="delete-form">
            <div>
                <label for="id-del">Id: </label>
                <input type="number" name="id-del" placeholder="Target of deletion" required> <br>
            </div>
            <input type="submit" value="delete">
        </form>
    </fieldset>

    <script src="../js/admin.js"></script>
    
    <fieldset>
        <legend><h2> Query field </h2></legend>
        <form action="" method="post">
            <input type="text" placeholder="Enter the table name" name="table_name">
            <input type="submit" value="search" id="submit">
        </form> <br>
        <table id="table">
        <?php
            include('./connect.php');
            $table_name = $_POST['table_name'];

            $table = $mysqli->real_escape_string($table_name);
            $exec = "SELECT * FROM $table";
            $query = $mysqli->query($exec) or die('Falha ao executar consulta!'); 
            
            $columns = array();
            $exec_columns = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'library' AND TABLE_NAME = '$table'";
            $selectColumns = $mysqli->query($exec_columns) or die('Erro ao consultar colunas');
            while ($column = $selectColumns->fetch_assoc()) {
                array_push($columns, $column['COLUMN_NAME']);
            }
            //Cabeçalho (nome das colunas)
            echo "<tr>";
            foreach ($columns as $column) {
                echo "<th>".$column."</th>";
            }
            echo "</tr>";
            //Dados da consulta
            while ($data = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                foreach ($columns as $column) {
                    echo "<td>".$data[$column]."</td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
        <br>
    </fieldset> <br>
</body>
</html>
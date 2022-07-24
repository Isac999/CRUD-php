<?php include('protect.php'); ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin </title>
    <link rel="icon" type="image/x-icon" href="https://cdn-icons-png.flaticon.com/512/174/174854.png">
    <link  rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"  crossorigin="anonymous">
    <style>
        input {
            max-width: 85%;
        }
        .no-replace {
            display: flex;
        }
        body {
            background-color: #3b8abb29;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen',
    'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue',
    sans-serif;
        } 
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand text-white font-weight-bold"> Admin Control</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse row justify-content-around" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                <a class="nav-link text-white" id="books" href="?page=books&pagina=1">Books</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" id="customers" href="?page=customers&pagina=1">Customers</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" id="books_rentals" href="?page=books_rentals&pagina=1">Books Rentals</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" id="requests_to_suppliers" href="?page=requests_to_suppliers&pagina=1">Requests to Suppliers</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" id="suppliers" href="?page=suppliers&pagina=1">Suppliers</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" id="libraries" href="?page=libraries&pagina=1">Libraries</a>
                </li>
            </ul>
        </div>
        <a class="navbar-brand text-white font-weight-bold" href="logout.php">Logout</a>
    </div>
    </nav>
    <br> <br>
    <div class="container mt-4 mb-4"><br>
        <div class="text-center">
            <h1 class="mt-1"> Welcome to the admin panel! </h1>
            <p>Create, update, delete and read data quickly!</p> 
        </div>
        <div class="row justify-content-center">
            <table class="table table-striped">
                <thead class="text-white font-weight-bold" style="background-color: #146176">
                    <tr>
                        <?php 
                            include('./connect.php');
                            $table_name = $_GET['page'];
                            $number_page = $_GET['pagina'];

                            if (empty($table_name)) {
                                $table_name = 'books';
                            }
                            if (!$number_page) {
                                $number_page = 1;
                            }
                            
                            $per_page = 10;
                            $inicio = $number_page - 1;
                            $inicio = $inicio * $per_page;
                            
                            $table = $mysqli->real_escape_string($table_name);
                            $exec = "SELECT * FROM $table";
                            
                            $limite = "$exec LIMIT $inicio, $per_page";

                            $query = $mysqli->query($exec) or die('Falha ao executar consulta!'); 
                            $query_limite = $mysqli->query($limite) or die('Falha ao executar consulta!'); 

                            $columns = array();
                            $exec_columns = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'library' AND TABLE_NAME = '$table'";
                            $selectColumns = $mysqli->query($exec_columns) or die('Erro ao consultar colunas');
                            while ($column = $selectColumns->fetch_assoc()) {
                                array_push($columns, $column['COLUMN_NAME']);
                            }
                            //Cabeçalho (nome das colunas)
                            foreach ($columns as $column) {
                                echo "<th class='text-capitalize align-middle'>".$column."</th>";
                            }
                            echo "<th colspan='2'>Action <button type='button' class='btn btn-success ml-2' onclick='createBtn(".count($columns).")'>Add</button></th>";
                        ?>
                    </tr>
                </thead>
                <?php 
                    //Dados da consulta
                    while ($data = mysqli_fetch_assoc($query_limite)) {
                        echo '<br>';
                        echo "<tr>";
                        foreach ($columns as $column) {
                            echo "<td>".$data[$column]."</td>";
                        }
                        echo "<td class='no-replace'>";
                        echo "<button onclick='change(this.parentElement)' class='btn btn-info' id='".$table_name."'>Edit</button>";
                        echo "<button onclick='del(this.id, this.parentElement)' class='btn btn-danger ml-1' id='".$data["id"]."-".$table_name."'>Delete</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    $total_registros = $query->num_rows;
                    $total_pages = $total_registros / $per_page;

                    $anterior = $number_page - 1;
                    $proximo = $number_page + 1; 
                    if ($number_page > 1) {
                        echo " <a href='?page=$table_name&pagina=$anterior'><- Anterior</a> ";
                    }

                    if ($number_page < $total_pages) {
                        echo " <a href='?page=$table_name&pagina=$proximo'>Próxima -></a>";
                    }
                    
                ?>
            </table>
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-secondary">
        <div class="text-white mb-3 mb-md-0">
        Copyright © 2022. All rights reserved to Isac.
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"  integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"  crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"  integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"  crossorigin="anonymous"></script>
    <script src="../js/admin.js"></script>
</body>
</html>
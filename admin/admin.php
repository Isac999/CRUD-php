<?php include('protect.php'); ?>

<!DOCTYPE html>
<html lang="pt0br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin </title>
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
        } 
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand text-white font-weight-bold" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item active">
            <a class="nav-link text-white" href="#">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white" href="#">About</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white" href="#">Services</a>
            </li>
            <li class="nav-item">
            <a class="nav-link text-white" href="#">Contact</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>
    <br> <br>
    <div class="container mt-4">
        <div class="text-center">
            <h1 class="mt-1"> Welcome to the admin panel! </h1>
            <a href='logout.php'> To end your session click here </a> <br> <br>
            <form action="" method="POST">
                <div class="mb-3">
                    <select autofocus name="table-name" id="option-query" class="form-control mb-2 font-weight-bold w-25 d-inline">
                            <option value="books" hidden>Choose the table</option>
                            <option value="books">Books</option>
                            <option value="customers">Customers</option>
                            <option value="books_rentals">Books Rentals</option>
                            <option value="requests_to_suppliers">Requests to Suppliers</option>
                            <option value="suppliers">Suppliers</option>
                            <option value="libraries">Libraries</option>
                    </select>
                    <input type="submit" class="btn btn-info" value="Search">
                </div>
            </form>
        </div>
        <div class="row justify-content-center">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <?php 
                            include('./connect.php');
                            $table_name = $_POST['table-name'];
                            if (empty($table_name)) {
                                $table_name = 'books';
                            }
    
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
                            //echo "<tr>";
                            foreach ($columns as $column) {
                                echo "<th class='text-capitalize align-middle'>".$column."</th>";
                            }
                            //echo "</tr>";
                            echo "<th colspan='2'>Action <button type='button' class='btn btn-success ml-2' onclick='createBtn(".count($columns).")'>Add</button></th>";
                        ?>
                    </tr>
                </thead>
                <?php 
                    //Dados da consulta
                    while ($data = mysqli_fetch_assoc($query)) {
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
                ?>
            </table>
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-secondary">
        <div class="text-white mb-3 mb-md-0">
        Copyright © 2022. All rights reserved.
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"  integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"  crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"  integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"  crossorigin="anonymous"></script>
    <script src="../js/admin.js"></script>
</body>
</html>
<?php include('protect.php'); ?>

<!DOCTYPE html>
<html lang="pt0br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin </title>
    <link  rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"  integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"  crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="text-center">
            <h1> Welcome to the admin panel! </h1>
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
            <script src="../js/admin.js"></script>
        </div>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
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
                                echo "<th class='text-capitalize'>".$column."</th>";
                            }
                            //echo "</tr>";
                        ?>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php 
                    //Dados da consulta
                    while ($data = mysqli_fetch_assoc($query)) {
                        echo "<tr>";
                        foreach ($columns as $column) {
                            echo "<td>".$data[$column]."</td>";
                        }
                        echo "<td>";
                        echo "<button class='btn btn-info' id='info-".$data["id"]."'>Edit</button>";
                        echo "<button class='btn btn-danger ml-1' id='danger-".$data["id"]."'>Delete</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </div>
    <script  src="https://code.jquery.com/jquery-3.3.1.slim.min.js"  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"  crossorigin="anonymous"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"  integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"  crossorigin="anonymous"></script>
    <script  src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"  integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"  crossorigin="anonymous"></script>
</body>
</html>
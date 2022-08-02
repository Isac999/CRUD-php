<?php 
require_once('../Connect.php');
class Render extends Connect {

    public function paginacao($table_name, $number_page) {
        if (empty($table_name)) {
            $table_name = 'books';
        }
        if (!$number_page) {
            $number_page = 1;
        }
        
        $per_page = 10;
        $inicio = $number_page - 1;
        $inicio = $inicio * $per_page;

        $exec = "SELECT * FROM $table_name";
        $limite = "$exec LIMIT $inicio, $per_page";
        
        $query = $this->mysqli->query($exec) or die('Falha ao executar consulta!'); 
        $query_limite = $this->mysqli->query($limite) or die('Falha ao executar consulta!'); 

        $this->headerRender($table_name);
    }

    public function headerRender($table) {
        $columns = array();
        $exec_columns = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$this->getDatabase()."' AND TABLE_NAME = '$table'";
        $selectColumns = $this->mysqli->query($exec_columns) or die('Erro ao consultar colunas');
        echo "tudo ok";
        while ($column = $selectColumns->fetch_assoc()) {
            array_push($columns, $column['COLUMN_NAME']);
        }

        //Cabeçalho (nome das colunas)
        foreach ($columns as $column) {
            echo "<th class='text-capitalize align-middle'>".$column."</th>";
        }
        echo "<th colspan='2'>Action <button type='button' class='btn btn-success ml-2' onclick='createBtn(".count($columns).")'>Add</button></th>";
    }
}

?>
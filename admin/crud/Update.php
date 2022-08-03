<?php 
require_once('../../Connect.php');

class Update extends Connect {
    private $listData;
    private $table_name;

    public function transformData($json) {
        $data = $json;
        $data = str_replace([":", "table", "}", "{"], "", $data);
        $list = explode("arrayValues", $data);

        $table_name = str_replace(['"', ','], "", $list[0]);
        $listData = str_replace(['"', '[', ']'], "", $list[1]);
        $listData = explode(',', $listData);

        $this->table_name = $table_name;
        $this->listData = $listData;
        echo $this->table_name;
        print_r($this->listData);

        $this->sendData($this->table_name, $this->listData);
    }

    public function sendData($table_name, $listData) {
        $columns = array();
        $exec_columns = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'library' AND TABLE_NAME = '$table_name'";
        $selectColumns = $this->mysqli->query($exec_columns) or die('Erro ao consultar colunas');
        
        while ($column = $selectColumns->fetch_assoc()) {
            array_push($columns, $column['COLUMN_NAME']);
        }

        print_r($columns);

        for ($index = 0; $index != count($columns); $index++) {
            $exec = "UPDATE `$table_name` SET `$columns[$index]` = '$listData[$index]' WHERE `$table_name`.`id` = '$listData[0]'";
            $query = $this->mysqli->query($exec) or die('Falha ao executar update!');
        }
    }
}

$update = new Update('');
$update->setDatabase('library');
$update->connectMysqli();

$json = file_get_contents('php://input');
$update->transformData($json);
?>
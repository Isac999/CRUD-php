<?php 
include('./connect.php');
//header('Location: ./admin.php');

$data = file_get_contents('php://input');
$data = str_replace([":", "table", "}", "{"], "", $data);
$list = explode("arrayValues", $data);

$table_name = str_replace(['"', ','], "", $list[0]);
$listData = str_replace(['"', '[', ']'], "", $list[1]);
$listData = explode(',', $listData);

echo $table_name;
print_r($listData);

$columns = array();
$exec_columns = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'library' AND TABLE_NAME = '$table_name'";
$selectColumns = $mysqli->query($exec_columns) or die('Erro ao consultar colunas');
while ($column = $selectColumns->fetch_assoc()) {
    array_push($columns, $column['COLUMN_NAME']);
}

print_r($columns);

for ($index = 0; $index != count($columns); $index++) {
    $exec = "UPDATE `$table_name` SET `$columns[$index]` = '$listData[$index]' WHERE `$table_name`.`id` = '$listData[0]'";
    $query = $mysqli->query($exec) or die('Falha ao executar update!');
}

?>
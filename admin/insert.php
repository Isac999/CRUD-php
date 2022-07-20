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

switch($table_name) {
    case 'books':
        $exec = "INSERT INTO `books` (`id`, `name`, `genre`, `author`, `library_id`) VALUES ('$listData[0]', '$listData[1]', '$listData[2]', '$listData[3]', '$listData[4]')";
        $query = $mysqli->query($exec) or die('Falha ao executar inserção!');
        break;
    case 'customers':
        $exec = "INSERT INTO `customers` (`id`, `name`, `birth`, `city`) VALUES ('$listData[0]', '$listData[1]', '$listData[2]', '$listData[3]')";
        $query = $mysqli->query($exec) or die('Falha ao executar inserção!');
        break;
    case 'books_rentals':
        $exec = "INSERT INTO `books_rentals` (`id`, `book_id`, `customer_id`, `date`) VALUES ('$listData[0]', '$listData[1]', '$listData[2]', '$listData[3]')";
        $query = $mysqli->query($exec) or die('Falha ao executar inserção!');
        break;
    case 'requests_to_suppliers':
        $exec = "INSERT INTO `requests_to_suppliers` (`id`, `book_id`, `request_date`, `delivery_confirmation`, `corporate_id`) VALUES ('$listData[0]', '$listData[1]', '$listData[2]', '$listData[3]', '$listData[4]')";
        $query = $mysqli->query($exec) or die('Falha ao executar inserção!');
        break;
    case 'suppliers':
        $exec = "INSERT INTO `suppliers` (`id`, `corporate_name`, `localization`) VALUES ('$listData[0]', '$listData[1]', '$listData[2]')";
        $query = $mysqli->query($exec) or die('Falha ao executar inserção!');
        break;
    case 'libraries':
        $exec = "INSERT INTO `libraries` (`id`, `localization`) VALUES ('$listData[0]', '$listData[1]')";
        $query = $mysqli->query($exec) or die('Falha ao executar inserção!');
        break;
    default: 
        echo 'Falha no switch';
}
?>
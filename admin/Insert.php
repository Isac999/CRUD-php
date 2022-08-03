<?php 
require_once('../Connect.php');

class Insert extends Connect {
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
        switch($table_name) {
            case 'books':
                $exec = "INSERT INTO `books` (`id`, `name`, `genre`, `author`, `library_id`) VALUES ('$listData[0]', '$listData[1]', '$listData[2]', '$listData[3]', '$listData[4]')";
                $query = $this->mysqli->query($exec) or die('Falha ao executar inserção!');
                break;
            case 'customers':
                $exec = "INSERT INTO `customers` (`id`, `name`, `birth`, `city`) VALUES ('$listData[0]', '$listData[1]', '$listData[2]', '$listData[3]')";
                $query = $this->mysqli->query($exec) or die('Falha ao executar inserção!');
                break;
            case 'books_rentals':
                $exec = "INSERT INTO `books_rentals` (`id`, `book_id`, `customer_id`, `date`) VALUES ('$listData[0]', '$listData[1]', '$listData[2]', '$listData[3]')";
                $query = $this->mysqli->query($exec) or die('Falha ao executar inserção!');
                break;
            case 'requests_to_suppliers':
                $exec = "INSERT INTO `requests_to_suppliers` (`id`, `book_id`, `request_date`, `delivery_confirmation`, `corporate_id`) VALUES ('$listData[0]', '$listData[1]', '$listData[2]', '$listData[3]', '$listData[4]')";
                $query = $this->mysqli->query($exec) or die('Falha ao executar inserção!');
                break;
            case 'suppliers':
                $exec = "INSERT INTO `suppliers` (`id`, `corporate_name`, `localization`) VALUES ('$listData[0]', '$listData[1]', '$listData[2]')";
                $query = $this->mysqli->query($exec) or die('Falha ao executar inserção!');
                break;
            case 'libraries':
                $exec = "INSERT INTO `libraries` (`id`, `localization`) VALUES ('$listData[0]', '$listData[1]')";
                $query = $this->mysqli->query($exec) or die('Falha ao executar inserção!');
                break;
            default: 
                echo 'Falha no switch';
        }
    }
}


$insert = new Insert('');
$insert->setDatabase('library');
$insert->connectMysqli();

$json = file_get_contents('php://input');
$insert->transformData($json);
?>
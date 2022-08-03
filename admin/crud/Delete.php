<?php 
require_once('../../Connect.php');

class Delete extends Connect {
    private $arrayData;

    public function transformData($json) {
        $data = $json;
        $data = str_replace(['{', '}', '"', ':', 'id'], "", $data);
        $arrayData = explode("-", $data);

        $this->arrayData = $arrayData;
        print_r($this->arrayData);

        $this->sendData($this->arrayData);
    }

    public function sendData($arrayData) {
        $exec = "DELETE FROM `$arrayData[1]` WHERE id = '$arrayData[0]'";
        $query = $this->mysqli->query($exec);
    }
}

$delete = new Delete('');
$delete->setDatabase('library');
$delete->connectMysqli();

$json = file_get_contents('php://input');
$delete->transformData($json);
?>
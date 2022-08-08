<?php 
namespace models\crud;

require_once('./Connect.php');
use \models\connect\Connect;

class Delete extends Connect {
    private array $arrayData;

    public function transformData($json) : void
    {
        $data = $json;
        $data = str_replace(['{', '}', '"', ':', 'id'], "", $data);
        $arrayData = explode("-", $data);

        $this->arrayData = $arrayData;
        print_r($this->arrayData);

        $this->sendData($this->arrayData);
    }

    public function sendData($arrayData) : bool
    {
        $exec = "DELETE FROM `$arrayData[1]` WHERE id = '$arrayData[0]'";
        $query = $this->mysqli->query($exec) or die("Falha na deleção");
        return true;
    }
}

$delete = new Delete('');
$delete->setDatabase('library');
$delete->connectMysqli();

$json = file_get_contents('php://input');
$delete->transformData($json);
?>
<?php 
namespace models\crud;

if (!isset($_SESSION)) {
    session_start();
} 
if (!isset($_SESSION['id'])) {
    header("Location: ./login");
    die("Você não tem acesso a está página! Faça login <a href='./login.php'>clicando aqui</a>");
}


require_once('./src/Models/Connect.php');
use \models\connect\Connect;

class Read extends Connect {
    private string $table; 
    private array $columns; 
    private object $query; 
    private object $query_limite; 
    public int $per_page = 10; 
    public int $number_page; 
    public int $anterior; 
    public int $proximo;
    public float $total_pages;

    public function __construct($database) {
        parent::__construct($database);
    }
    
    public function paginacao($table_name, $number_page) : void
    {
        if (empty($table_name)) {
            $this->table = 'books';
        } else {
            $this->table = $table_name;
        }
        if (!$number_page) {
            $this->number_page = 1;
        } else {
            $this->number_page = $number_page;
        }

        $this->per_page = 10;
        $inicio = $this->number_page - 1;
        $inicio = $inicio * $this->per_page;

        $exec = "SELECT * FROM $this->table";
        $limite = "$exec LIMIT $inicio, $this->per_page";

        $this->query = $this->mysqli->query($exec) or die('Falha ao executar consulta!'); 
        $this->query_limite = $this->mysqli->query($limite) or die('Falha ao executar consulta!'); 

        $this->headerRender($this->table);
    }

    public function headerRender($table) : void
    {
        $this->columns = array();
        $exec_columns = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = '".$this->getDatabase()."' AND TABLE_NAME = '$table'";
        $selectColumns = $this->mysqli->query($exec_columns) or die('Erro ao consultar colunas');
        
        while ($column = $selectColumns->fetch_assoc()) {
            array_push($this->columns, $column['COLUMN_NAME']);
        }

        //Cabeçalho (nome das colunas)
        foreach ($this->columns as $column) {
            echo "<th class='text-capitalize align-middle'>".$column."</th>";
        }
        echo "<th colspan='2'>Action <button type='button' class='btn btn-success ml-2' onclick='createBtn(".count($this->columns).")'>Add</button></th>";
    }

    public function rowsRender() : void
    {
        //Dados da consulta
        while ($data = mysqli_fetch_assoc($this->query_limite)) {
            echo "<tr>";
            foreach ($this->columns as $column) {
                echo "<td>".$data[$column]."</td>";
            }
            echo "<td class='no-replace'>";
            echo "<button onclick='change(this.parentElement)' class='btn btn-info' id='".$this->table."'>Edit</button>";
            echo "<button onclick='del(this.id, this.parentElement)' class='btn btn-danger ml-1' id='".$data["id"]."-".$this->table."'>Delete</button>";
            echo "</td>";
            echo "</tr>";
        }
        $total_registros = $this->query->num_rows;
        $this->total_pages = $total_registros / $this->per_page;

        $this->anterior = $this->number_page - 1;
        $this->proximo = $this->number_page + 1; 
    }
    
    public function paginacaoRender() : void
    {
        if ($this->number_page > 1) {
            echo "<a href='?page=$this->table&pagina=$this->anterior' class='border rounded p-2' style='color: black; background-color: #299bc0;'> <- Previous Page </a> ";
        }

        if ($this->number_page < $this->total_pages) {
            echo "<a href='?page=$this->table&pagina=$this->proximo' class='rounded p-2 ml-2' style='color: black; background-color: #299bc0;'> Next Page -> </a>";
        }
    }
}

?>
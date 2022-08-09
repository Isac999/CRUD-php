<?php 
namespace models\connect;
use mysqli;

class Connect {
    protected string $usuario;
    private string $senha;
    protected string $database;
    protected string $host;
    protected object $mysqli;

    public function __construct(string $database)
    {
        $this->usuario = 'root';
        $this->senha = '';
        $this->database = empty($database) ? 'admin' : $this->setDatabase($database);
        $this->host = 'localhost';

        $this->connectMysqli();
    }

    public function connectMysqli() : bool
    {
        $this->mysqli = new mysqli(
            $this->getHost(),
            $this->getUsuario(), 
            $this->getSenha(), 
            $this->getDatabase()
        );

        if ($this->mysqli->error) {
            die('Falha ao conectar! erro: '.$this->mysqli->error);
            return false;
        }
        return true;
    }

    public function queryLogin($emailPost, $passwordPost) : void
    {
        $email = $this->mysqli->real_escape_string($emailPost);
        $senha = $this->mysqli->real_escape_string($passwordPost);

        $exec = "SELECT * FROM login WHERE email = '$email' AND senha = '$senha'";
        $query = $this->mysqli->query($exec) or die('Falha ao executar consulta! mensagem: '.$this->mysqli->error);
        $numRows = $query->num_rows;

        if (!empty($numRows)) {
            $login = $query->fetch_assoc();
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id'] = $login['id'];
            header('Location: ./index');
    
        } else {
            echo '<script>alert("Incorrect email or password!")</script>';
        }
    }

    public function getUsuario() : string
    {
        return $this->usuario;
    }
    private function getSenha() : string 
    {
        return $this->senha;
    }
    public function getDatabase() : string
    {
        return $this->database;
    }
    public function getHost() : string 
    {
        return $this->host;
    }
    protected function getMysqli() : object
    {
        return $this->mysqli;
    }

    public function setUsuario($new) : void 
    {
        $this->usuario = $new;
    }
    private function setSenha($new) : void
    {
        $this->senha = $new;
    }
    public function setDatabase($new) : void
    {
        $this->database = $new;
    }
    public function setHost($new) : void
    {
        $this->host = $new;
    }
    
}
?>
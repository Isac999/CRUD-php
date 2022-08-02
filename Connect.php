<?php 

class Connect {
    protected $usuario;
    private $senha;
    protected $database;
    protected $host;
    private $mysqli;

    public function __construct($pass) {
        $this->usuario = 'root';
        $this->setSenha($pass);
        $this->database = 'admin';
        $this->host = 'localhost';
    }

    public function connectMysqli() {
        $this->mysqli = new mysqli(
            $this->getHost(),
            $this->getUsuario(), 
            $this->getSenha(), 
            $this->getDatabase()
        );

        if ($this->mysqli->error) {
            die('Falha ao conectar! erro: '.$this->mysqli->error);
        }
    }

    public function queryLogin($emailPost, $passwordPost) {
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
            header('Location: ./admin/admin.php');
    
        } else {
            echo '<script>alert("Incorrect email or password!")</script>';
        }
    }

    public function getUsuario() {
        return $this->usuario;
    }
    private function getSenha() {
        return $this->senha;
    }
    public function getDatabase() {
        return $this->database;
    }
    public function getHost() {
        return $this->host;
    }

    public function setUsuario($new) {
        $this->usuario = $new;
    }
    private function setSenha($new) {
        $this->senha = $new;
    }
    public function setDatabase($new) {
        $this->database = $new;
    }
    public function setHost($new) {
        $this->host = $new;
    }
    
}
?>
<?php 

class Connect {
    protected $usuario;
    private $senha;
    protected $database;
    protected $host;

    public function __construct($pass) {
        $this->usuario = 'root';
        $this->setSenha($pass);
        $this->database = 'admin';
        $this->host = 'localhost';
    }
    public function connectMysqli() {
        $mysqli = new mysqli(
            $this->getHost(),
            $this->getUsuario(), 
            $this->getSenha(), 
            $this->getDatabase()
        );

        if ($mysqli->error) {
            die('Falha ao conectar! erro: '.$mysqli->error);
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
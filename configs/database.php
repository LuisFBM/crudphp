<?php

class Database {
    private $host = '127.0.0.1';
    private $banco = "senac";
    private $usuario = "root";
    private $senha = "";
    public $con;

    public function conectar(){
        $this->con = null;

        try {
            $this->con = new PDO("mysql:host=$this->host;dbname=$this->banco",$this->usuario,$this->senha); // essa linha faz a conexão com o banco;
        } catch (PDOException $e) {
            echo "Erro ao Conectar: " . $e->getMessage();
        }

        return $this->con;

    }

}

?>
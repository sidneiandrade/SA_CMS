<?php

class Database{
   
    // credenciais do banco de dados
    private $host       = "localhost";
    private $db_name    = "sa_db_system";
    private $username   = "root";
    private $password   = "";
    public $conn;
   
    // conexao com o banco
    public function getConnection(){
   
        $this->conn = null;
   
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            //Comentar quando fizer a publicação
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Erro de conexão: " . $e->getMessage();
        }
   
        return $this->conn;
    }
}
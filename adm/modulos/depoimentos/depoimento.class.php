<?php

class Depoimentos{

    // conexao com o banco
    private $conn;
    private $tabela = "clientes";
  
    // propriedades do objeto
    public $id;
    public $nome;
    public $empresa;
    public $texto;
  
    public function __construct($pdo){
        $this->conn = $pdo;
    }

    function insert(){
  
        $query = "INSERT INTO
                    " . $this->tabela . "
                SET
                    nome=:nome, empresa=:empresa, texto=:texto";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->empresa=htmlspecialchars(strip_tags($this->empresa));
        $this->texto=htmlspecialchars(strip_tags($this->texto));
  
        // bind values 
        $stmt->bindParam(":nome", $this->nome);
        $stmt->bindParam(":empresa", $this->empresa);
        $stmt->bindParam(":texto", $this->texto);
  
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }

    function readAll($from_record_num, $records_per_page){
  
        $query = "SELECT
                    dep_id, dep_nome, dep_empresa, dep_texto
                FROM
                    " . $this->tabela . "
                ORDER BY
                    dep_nome ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";
      
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
      
        return $stmt;
    }

    function update(){
  
        $query = "UPDATE
                    " . $this->tabela . "
                SET
                    dep_nome = :nome,
                    dep_empresa = :empresa,
                    dep_texto = :texto,
                WHERE
                    dep_id = :id";
      
        $stmt = $this->conn->prepare($query);
      
        // posted values
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->empresa=htmlspecialchars(strip_tags($this->empresa));
        $this->texto=htmlspecialchars(strip_tags($this->texto));
        $this->id=htmlspecialchars(strip_tags($this->id));
      
        // bind parameters
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':empresa', $this->empresa);
        $stmt->bindParam(':texto', $this->texto);
        $stmt->bindParam(':id', $this->id);
      
        // execute the query
        if($stmt->execute()){
            return true;
        }
      
        return false;
          
    }

    function delete(){
  
        $query = "DELETE FROM " . $this->tabela . " WHERE dep_id = ?";
          
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
      
        if($result = $stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

}
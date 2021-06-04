<?php

class FabricaConexao extends PDO {
    private $dbn = "pgsql:host=localhost;port=5432;dbname=LojaRoupa";
    private $usr = "postgres";
    private $pwd = "masterkey";
    public $handle = null; 

    //Construtor do objeto de conexão 
    function __construct(){
        try{
            //retorna o PDO em si, acessando o construtor da classe PDO
            if($this->handle == null){
                $dbh = parent::__construct($this->dbn, $this->usr , $this->pwd);
                $this->handle = $dbh;
                return $this->handle;
            }
        }
        catch(PDOException $e){
            echo "Conexão falhou. Erro: " . $e->getMessage() . "\n";
            return false;
        }
    }

    //Destructor do objeto de conexão
    function __destruct(){
        $this->handle = NULL;
    }
}

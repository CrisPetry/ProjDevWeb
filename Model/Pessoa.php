<?php

class Pessoa{
    private $id;
    private $nome;
    private $numsoc;
    private $endereco;
    private $telefone;
    private $cidade;
   
    public function __set($propriedade, $valor){
        $this->$propriedade = $valor;
    }

    public function __get($propriedade){
        return $this->$propriedade;
    }

}

?>
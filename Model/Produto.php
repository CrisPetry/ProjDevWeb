<?php

class Produto{
    private $codproduto;
    private $nome;
    private $preco;
    private $estoque;
 
   
    public function __set($propriedade, $valor){
        $this->$propriedade = $valor;
    }

    public function __get($propriedade){
        return $this->$propriedade;
    }

}

?>
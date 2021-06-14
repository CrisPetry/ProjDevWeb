<?php

class Vendas{
    private $idvenda; 
    private $data;
    private $valortotal;
    private $username;
    private $idpessoa;
    private $idproduto;
    

    public function _set($propriedade, $valor){
        $this->$propriedade = $valor;
    }

    public function _get($propriedade){
        return $this->$propriedade;
    }

}

?>
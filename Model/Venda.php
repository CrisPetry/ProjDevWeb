<?php

class Venda {
  private $codvenda;
  private $data;
  private $valortotal;
  private $codpessoa;
  private $codproduto;
  private $codusuario;

    public function __set($propriedade, $valor){
        $this->$propriedade = $valor;
    }

    public function __get($propriedade){
        return $this->$propriedade;
    }
}

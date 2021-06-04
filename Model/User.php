<?php

class User{
    private $apelido;
    private $senha;
    private $id;

    public function __construct(){}

    public function __set($propriedade, $valor){
        $this->$propriedade = $valor;
    }

    public function __get($propriedade){
        return $this->$propriedade;
    }
}

?>
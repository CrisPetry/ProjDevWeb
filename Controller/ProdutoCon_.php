<?php
require_once("../Model/FabricaConexao.php");
require_once("../Model/Produto.php");
require_once("../Model/ProdutoDAO.php");

class Controller {

 public function controlaInsercao()
  {
    if(isset($_POST["nome"]) && isset($_POST["estoque"]) && isset($_POST["preco"]))
    {

    $nome = $_POST["nome"];
    $estoque  = $_POST["estoque"];
    $preco = $_POST["preco"];

      $DAO  = new ProdutoDAO();
      $prod = new Produto();
      $prod->nome = $nome;
      $prod->estoque = $estoque;
      $prod->preco = $preco;

      if($DAO->Inserir($prod))
      {
        print "<script>";
        print "alert('PRODUTO CADASTRADO COM SUCESSO!');";
        print "window.location = '../View/insereproduto.php';";
        print "</script>";
      }
      else
      {
        print "<script>";
        print "alert('Registro NÃO CADASTRADO! ERRO: $DAO->erro');";
        print "document.getElementById('nome').value = '$prod->nome';";
        print "document.getElementById('preco').value = '$prod->estoque';";
        print "document.getElementById('estoque').value = '$prod->preco';";
        print "</script>";
      }
    
      unset($prod);
    }
  }
}
<?php
require_once("../model/FabricaConexao.php");
require_once("../model/Pessoa.php");
require_once("../model/PessoaDAO.php");

class PessoaCon {

  public function consultaLista($op)
  {
    $DAO = new PessoaDAO();
    $lista = array();
    $numCol = 6;

    switch ($op) {
      case 1:
        $lista = $DAO->ConsultarList();
        break;
    }

    if (count($lista) > 0) {
      for ($i = 0; $i < count($lista); $i++) {
        $id         = $lista[$i]->id;
        $nome       = $lista[$i]->nome;
        $numsoc    = $lista[$i]->numsoc;
        $endereco  = $lista[$i]->endereco;
        $telefone = $lista[$i]->telefone;
        $cidade = $lista[$i]->cidade;




        echo "<tr>";

        if ($id)
          echo "<td style=\"text-align: center;\">$id</td>";
        if ($nome)
          echo "<td style=\"text-align: left;\">$nome</td>";
        if ($numsoc)
          echo "<td style=\"text-align: right;\">$numsoc</td>";
        if ($endereco)
          echo "<td style=\"text-align: right;\">$endereco</td>";
        if ($telefone)
          echo "<td style=\"text-align: right;\">$telefone</td>";
        if ($cidade)
          echo "<td style=\"text-align: right;\">$cidade</td>";
        echo "</tr>";
      }
    } else {
      echo "<tr>";
      echo "<td colspan=\"$numCol\">Nenhum registro encontrado!</td>";
      echo "</tr>";
    }
  }

  public function controlaConsulta($op)
  {
    $DAO = new PessoaDAO();
    $lista = array();
    $lista = $DAO->Consultar($op, "", "");

    if ($op != 1)
      $numCol = 6;
   
    if (count($lista) > 0) {
      for ($i = 0; $i < count($lista); $i++) {
        $id   = $lista[$i]->id;
        $nome = $lista[$i]->nome;
        $numsoc  = $lista[$i]->numsoc;
        $endereco = $lista[$i]->endereco;
        $telefone = $lista[$i]->telefone;
        $cidade = $lista[$i]->cidade;

        print "<tr>";

        if ($id)
          print "<td style='text-align: center;'>$id</td>";
        if ($nome)
          print "<td style='text-align: left;'>$nome</td>";
        if ($numsoc)
          print "<td style='text-align: center;'>$numsoc</td>";
        if ($endereco)
          print "<td style='text-align: center;'>$endereco</td>";
        if ($telefone)
        print "<td style='text-align: center;'>$telefone</td>";
        if ($cidade)
          print "<td style='text-align: center;'>$cidade</td>";

        print "</tr>";
      }
    } else {
      print "<tr>";
      print "<td colspan='$numCol'>Nenhum registro encontrado!</td>";
      print "</tr>";
    }
  }

  private function buscaDados($id, $modo)
  {
    $DAO = new PessoaDAO();

    $pessoa = $DAO->Consultar(6, "id", $id);

    if (count($pessoa) == 1) {
      $nome = $pessoa[0]->nome;
      $numsoc  = $pessoa[0]->numsoc;
      $endereco = $pessoa[0]->endereco;
      $telefone = $pessoa[0]->telefone;
      $cidade = $pessoa[0]->cidade;
      

      if ($modo == 0)
        chamaFormAlterar($id, $nome, $numsoc, $endereco, $telefone, $cidade);
      else
        chamaFormExcluir($id, $nome, $numsoc, $endereco, $telefone, $cidade);

      print "<script>";
      print "document.formBuscar.buscaId.value = '$id';";
      print "document.formBuscar.buscaId.disabled = true;";
      print "document.formBuscar.button2.disabled  = true;";
      print "</script>";
    } else {
      print "<script>";
      print "alert('PRODUTO NÃO ENCONTRADO! Por favor, tente novamente...');";
      print "</script>";
    }

    unset($pessoa);
  }

  private function preparaDados()
  {
    $pessoa = new Pessoa();

    $nome = $_POST["nome"];
    $numsoc  = $_POST["numsoc"];
    $endereco = $_POST["endereco"];
    $telefone = $_POST["telefone"];
    $cidade = $_POST["cidade"];
    

    $pessoa->nome = $nome;
    $pessoa->numsoc = $numsoc;
    $pessoa->endereco = $endereco;
    $pessoa->telefone = $telefone;
    $pessoa->cidade = $cidade;

    return $pessoa;
  }

  public function controlaInsercao()
  {
    if (isset($_POST["nome"]) && isset($_POST["numsoc"]) && isset($_POST["endereco"]) && isset($_POST["telefone"]) && isset($_POST["cidade"])) {
      $DAO  = new PessoaDAO();
      $pessoa = $this->preparaDados();

      if ($DAO->Inserir($pessoa)) {
        print "<script>";
        print "alert('PESSOA CADASTRADO COM SUCESSO!');";
        print "window.location = '../view/inserepessoa.php';";
        print "</script>";
      } else {
        print "<script>";
        print "alert('Registro NÃO CADASTRADO! ERRO: $DAO->erro');";
        print "document.getElementById('nome').value = '$pessoa->nome';";
        print "document.getElementById('numsoc').value = '$pessoa->numsoc';";
        print "document.getElementById('endereco').value = '$pessoa->endereco';";
        print "document.getElementById('telefone').value = '$pessoa->telefone';";
        print "document.getElementById('cidade').value = '$pessoa->cidade';";
        print "</script>";
      }

      unset($pessoa);
    }
  }

  public function controlaAlteracao()
  {
    if (isset($_POST["nome"]) && isset($_POST["numsoc"]) && isset($_POST["endereco"]) && isset($_POST["telefone"]) && isset($_POST["cidade"])) {
      $DAO  = new PessoaDAO();
      $pessoa = $this->preparaDados();

      $id = $_POST["selId"];
      $pessoa->id = $id;

      if ($DAO->Alterar($pessoa)) {
        print "<script>";
        print "alert('PESSOA ALTERADO COM SUCESSO!');";
        print "document.formBuscar.buscaId.disabled = false;";
        print "document.formBuscar.button2.disabled  = false;";
        print "window.location = '../view/editapessoa.php';";
        print "</script>";
      } else {
        print "<script>";
        print "alert('Registro NÃO ALTERADO! ERRO: $DAO->erro');";
        print "document.getElementById('buscaId').value = '$id';";
        print "document.getElementById('formBuscar').submit();";
        print "</script>";
      }

      unset($pessoa);
    } else if (isset($_POST["buscaId"])) {
      $id = $_POST["buscaId"];
      $this->buscaDados($id, 0);
    }
  }
  public function controlaExclusao()
  {
    if(isset($_POST["selId"]))
    {
      $DAO  = new PessoaDAO();
      $pessoa = new Pessoa();

      $id = $_POST["selId"];
      $pessoa->id = $id;

      if($DAO->Excluir($pessoa))
      {
        print "<script>";
        print "alert('PESSOA EXCLUÍDA COM SUCESSO!');";
        print "document.formBuscar.buscaId.disabled = false;";
        print "document.formBuscar.button2.disabled  = false;";
        print "window.location = '../View/deletapessoa.php';";
        print "</script>";
      }
      else
      {
        print "<script>";
        print "alert('Registro NÃO EXCLUÍDO! ERRO: $DAO->erro');";
        print "document.getElementById('buscaId').value = '$id';";
        print "document.getElementById('formBuscar').submit();";
        print "</script>";
      }
    
      unset($pessoa);
    }
    else if(isset($_POST["buscaId"]))
    {
      $id = $_POST["buscaId"];
      $this->buscaDados($id, 1);
    }
  }
}
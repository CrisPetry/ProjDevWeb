<?php
require_once("../Model/FabricaConexao.php");
require_once("../Model/Pessoa.php");
require_once("../Model/PessoaDAO.php");
require_once("../Model/Venda.php");
require_once("../Model/VendaDAO.php");
require_once("../Model/Produto.php");
require_once("../Model/ProdutoDAO.php");
require_once("../Model/User.php");
require_once("../Model/UserDAO.php");

class VendaCon
{

  public function listaPessoasFK($selectedIndex = -1)
  {
    $DAO = new PessoaDAO();
    $lista = array();
    $lista = $DAO->ConsultarList();
    $resultOptions = "";

    if ($selectedIndex != -1)
      $selectedIndex--;

    if (count($lista) > 0) {
      for ($i = 0; $i < count($lista); $i++) {
        if ($i != $selectedIndex) {

          $resultOptions .= "<option value=\"" . $lista[$i]->id . "\">" . $lista[$i]->nome . "</option>" . "\n";
        } else {
          $resultOptions .= "<option selected value=\"" . $lista[$i]->id . "\">" . $lista[$i]->nome . "</option>" . "\n";
        }
      }
    } else {
      $resultOptions .= "<option value=''></option>\n";
    }

    return $resultOptions;
  }

  public function listaProdutosFK($selectedIndex = -1)
  {
    $DAO = new ProdutoDAO();
    $lista = array();
    $lista = $DAO->Consultar();
    $resultOptions = "";

    if ($selectedIndex != -1)
      $selectedIndex--;

    if (count($lista) > 0) {
      for ($i = 0; $i < count($lista); $i++) {
        if ($i != $selectedIndex) {

          $resultOptions .= "<option value=\"" . $lista[$i]->codproduto . "\">" . $lista[$i]->descricao . "</option>" . "\n";
        } else {

          $resultOptions .= "<option selected value=\"" . $lista[$i]->codproduto . "\">" . $lista[$i]->descricao . "</option>" . "\n";
          $selectedIndex++;
        }
      }
    } else {

      $resultOptions .= "<option value=''></option>\n";
    }
    return $resultOptions;
  }

  public function listaUsuariosFK($selectedIndex = -1)
  {
    $DAO = new UserDAO();
    $lista = array();
    $lista = $DAO->ConsultarList();
    $resultOptions = "";

    if ($selectedIndex != -1)
      $selectedIndex--;

    if (count($lista) > 0) {
      for ($i = 0; $i < count($lista); $i++) {
        if ($i != $selectedIndex) {

          $resultOptions .= "<option value=\"" . $lista[$i]->id . "\">" . $lista[$i]->apelido . "</option>" . "\n";
        } else {

          $resultOptions .= "<option selected value=\"" . $lista[$i]->id . "\">" . $lista[$i]->apelido . "</option>" . "\n";
        }
      }
    } else {

      $resultOptions .= "<option value=''></option>\n";
    }

    return $resultOptions;
  }

  private function buscaDados($codvenda, $modo)
  {
    $DAO = new VendaDAO();

    $venda = $DAO->ConsultarP(6, "codvenda", $codvenda);

    if (count($venda) == 1) {
      $codvenda = $venda[0]->codvenda;
      $data = $venda[0]->data;
      $valortotal  = $venda[0]->valortotal;
      $cliente   = $venda[0]->codpessoa;
      $produto = $venda[0]->codproduto;
      $vendedor = $venda[0]->id;


      if ($modo == 0)
        chamaFormAlterar($codvenda, $data, $valortotal, $cliente, $produto, $vendedor);
      else
        chamaFormExcluir($codvenda, $data, $valortotal, $cliente, $produto, $vendedor);

      print "<script>";
      print "document.formBuscar.buscaCod.value = '$codvenda';";
      print "document.formBuscar.buscaCod.disabled = true;";
      print "document.formBuscar.button2.disabled  = true;";
      print "</script>";
    } else {
      print "<script>";
      print "alert('PESSOA NÃO ENCONTRADA! Por favor, tente novamente...');";
      print "</script>";
    }

    unset($venda);
  }

  public function controlaInsercao()
  {
    if (
      isset($_POST["data"]) && isset($_POST["valortotal"]) && isset($_POST["cliente"])
      && isset($_POST["produto"]) && isset($_POST["vendedor"])
    ) {
      $erros = array();
      $data = $_POST["data"];
      $valortotal = $_POST["valortotal"];
      $cliente = $_POST["cliente"];
      $produto = $_POST["produto"];
      $vendedor = $_POST["vendedor"];

      if (count($erros) == 0) {
        $DAO = new VendaDAO();
        $venda = new Venda();
        $venda->data = $data;
        $venda->valortotal  = $valortotal;
        $venda->codpessoa = $cliente;
        $venda->codproduto = $produto;
        $venda->id = $vendedor;

        if ($DAO->Inserir($venda)) {
          $res = "CARRO CADASTRADO COM SUCESSO!";
          header("Location: ../view/inserecarro.php?result=$res");
        } else {
          $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
          $err = serialize($erros);
        }

        unset($venda);
      } else {
        $err = serialize($erros);
        header("Location: ../view/inserevenda.php?error=$err&data=$data&valortotal=$valortotal&cliente=$cliente
          &produto=$produto&vendedor=$vendedor");
      }
    }
  }

  public function controlaConsulta($op)
  {
    $DAO = new VendaDAO();
    $lista = array();
    $numCol = 6;

    switch ($op) {
      case 1:
        $lista = $DAO->Consultar(1);
        break;
    }

    if (count($lista) > 0) {
      for ($i = 0; $i < count($lista); $i++) {
        $codvenda = $lista[$i]->codvenda;
        $data = $lista[$i]->data;
        $valortotal  = $lista[$i]->valortotal;
        $cliente   = $lista[$i]->codpessoa;
        $produto = $lista[$i]->codproduto;
        $vendedor = $lista[$i]->id;

        echo "<tr>";

        if ($codvenda)
          echo "<td style=\"text-align: center;\">$codvenda</td>";
        if ($data)
          echo "<td style=\"text-align: left;\">$data</td>";
        if ($valortotal)
          echo "<td style=\"text-align: left;\">$valortotal</td>";
        if ($cliente)
          echo "<td style=\"text-align: left;\">$cliente</td>";
        if ($produto)
          echo "<td style=\"text-align: left;\">$produto</td>";
        if ($vendedor)
          echo "<td style=\"text-align: left;\">$vendedor</td>";

        echo "</tr>";
      }
    } else {
      echo "<tr>";
      echo "<td colspan=\"$numCol\">Nenhum registro encontrado!</td>";
      echo "</tr>";
    }
  }

  public function controlaAlteracao()
  {
    if (
      isset($_POST["data"]) && isset($_POST["valortotal"]) && isset($_POST["cliente"])
      && isset($_POST["produto"]) && isset($_POST["vendedor"]) && isset($_POST["selCod"])
    ) {
      $erros = array();
      $data = $_POST["data"];
      $valortotal = $_POST["valortotal"];
      $cliente = $_POST["cliente"];
      $produto = $_POST["produto"];
      $vendedor = $_POST["vendedor"];
      $codvenda = $_POST["selCod"];


      if (count($erros) == 0) {
        $DAO = new VendaDAO();
        $venda = new Venda();
        $venda->data = $data;
        $venda->valortotal  = $valortotal;
        $venda->codpessoa = $cliente;
        $venda->codproduto = $produto;
        $venda->id = $vendedor;
        $venda->codvenda = $codvenda;

        if ($DAO->Alterar($venda)) {
          $res = "VENDA ALTERADA COM SUCESSO!";
          header("Location: ../view/alteravenda.php?resultMode=$res");
        } else {
          $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
          $err = serialize($erros);
          header("Location: ../view/alteravenda.php?errorMode=$err&codvenda=$codvenda");
        }

        unset($venda);
      } else {
        $err = serialize($erros);  // Caso tenha erro no preenchimento do formulário
        header("Location: ../view/alteravenda.php?errorMode=$err&codvenda=$codvenda");
      }
    } else if (isset($_POST["buscaCod"])) {
      $codvenda = $_POST["buscaCod"];
      $this->buscaDados($codvenda, 0);  // chamaFormAlterar
    }
  }

  public function controlaExclusao()
  {
    if (isset($_POST["selCod"])) {
      $DAO = new VendaDAO();
      $venda  = new Venda();

      $codvenda = $_POST["selCod"];
      $venda->codvenda = $codvenda;

      if ($DAO->Excluir($venda)) {
        $res = "VENDA EXCLUÍDO COM SUCESSO!";
      } else {
        $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
        $err = serialize($erros);
        header("Location: ../view/deletavenda.php?errorMode=$err&codvenda=$codvenda");
      }

      unset($venda);
    } else if (isset($_POST["buscaCod"])) {
      $id = $_POST["buscaCod"];
      $this->buscaDados($id, 1);  // chamaFormExcluir
    }
  }
}
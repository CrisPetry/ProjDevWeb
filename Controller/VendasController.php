<?php
require_once("../Model/FabricaConexao.php");
require_once("../Model/User.php");
require_once("../Model/Pessoa.php");
require_once("../Model/Produto.php");
require_once("../Model/Vendas.php");
require_once("../Model/UserDAO.php");
require_once("../Model/PessoaDAO.php");
require_once("../Model/ProdutoDAO.php");
require_once("../Model/VendasDAO.php");

class VendasController {

  public function listaPessoasFK($selectedIndex=-1) {
    $DAO = new PessoaDAO();
    $lista = array();
    $lista = $DAO->Consultar();
    $resultOptions = "";

    if($selectedIndex != -1)
      $selectedIndex--;  // índice de seleção começa em zero
  
    if(count($lista) > 0) {
      // Populando a lista de opções
      for($i = 0; $i < count($lista); $i++) {
        if($i != $selectedIndex)
        {
          // Para casos de inserção ou consulta
          $resultOptions .= "<option value=\"" . $lista[$i]->codigo . "\">" . $lista[$i]->nome . "</option>" . "\n";
        }
        else {
          // Para casos de alteração ou exclusão, deve existir só um item selecionado
          $resultOptions .= "<option selected value=\"" . $lista[$i]->codigo . "\">" . $lista[$i]->nome . "</option>" . "\n";
        }
      }
    }
    else {
      // Cria uma option vazia
      $resultOptions .= "<option value=''></option>\n";
    }
    // Retorna os resultados considerando a chamada php dentro de um <select>
    return $resultOptions;
  }

    public function listaUsuariosFK($selectedIndex = -1)
    {
        $DAO = new UserDAO();
        $lista = array();
        $lista = $DAO->ConsultarList();
        $resultOptions = "";

        if ($selectedIndex != -1)
            $selectedIndex--;  // índice de seleção começa em zero

        if (count($lista) > 0) {
            // Populando a lista de opções
            for ($i = 0; $i < count($lista); $i++) {
                if ($i != $selectedIndex) {
                    // Para casos de inserção ou consulta
                    $resultOptions .= "<option value=\"" . $lista[$i]->codigo . "\">" . $lista[$i]->nome . "</option>" . "\n";
                } else {
                    // Para casos de alteração ou exclusão, deve existir só um item selecionado
                    $resultOptions .= "<option selected value=\"" . $lista[$i]->codigo . "\">" . $lista[$i]->nome . "</option>" . "\n";
                }
            }
        } else {
            // Cria uma option vazia
            $resultOptions .= "<option value=''></option>\n";
        }
        // Retorna os resultados considerando a chamada php dentro de um <select>
        return $resultOptions;
    }

    public function listaProdutosFK($selectedIndex = -1)
    {
        $DAO = new ProdutoDAO();
        $lista = array();
        $lista = $DAO->Consultar();
        $resultOptions = "";

        if ($selectedIndex != -1)
        $selectedIndex--;  // índice de seleção começa em zero

        if (count($lista) > 0) {
            // Populando a lista de opções
            for ($i = 0; $i < count($lista); $i++) {
                if ($i != $selectedIndex) {
                    // Para casos de inserção ou consulta
                    $resultOptions .= "<option value=\"" . $lista[$i]->codigo . "\">" . $lista[$i]->nome . "</option>" . "\n";
                } else {
                    // Para casos de alteração ou exclusão, deve existir só um item selecionado
                    $resultOptions .= "<option selected value=\"" . $lista[$i]->codigo . "\">" . $lista[$i]->nome . "</option>" . "\n";
                }
            }
        } else {
            // Cria uma option vazia
            $resultOptions .= "<option value=''></option>\n";
        }
        // Retorna os resultados considerando a chamada php dentro de um <select>
        return $resultOptions;
    }

  private function buscaDados($idvenda, $modo)
  {
    $DAO = new VendasDAO();
  
    $vendas = $DAO->Consultar(2, $idvenda);
  
    if(count($vendas) == 1)
    {
      $data = $vendas[0]->data;
      $valortotal  = $vendas[0]->valortotal;
      $username = $vendas[0]->username;
      $idpessoa = $vendas[0]->idpessoa;
      $idproduto = $vendas[0]->idproduto;

      if($modo == 0)
        chamaFormAlterar($idvenda, $data, $valortotal, $username, $idpessoa, $idproduto);
      else
        chamaFormExcluir($idvenda, $data, $valortotal, $username, $idpessoa, $idproduto);
  
      print "<script>";
      print "document.formBuscar.buscaCod.value = '$idvenda';";
      print "document.formBuscar.buscaCod.disabled = true;";
      print "document.formBuscar.buttonbuscar.disabled  = true;";
      print "</script>";
    }
    else
    {
      print "<script>";
      print "alert('VENDA NÃO ENCONTRADA! Por favor, tente novamente...');";
      print "</script>";          
    }
  
    unset($vendas);
  }  
  
  public function controlaInsercao() {
    if(isset($_POST["data"]) && isset($_POST["valortotal"]) && isset($_POST["username"]) && isset($_POST["idpessoa"])) {
      $erros = array();
      $data = $_POST["data"];
      $valortotal = $_POST["valortotal"];
      $usuario = $_POST["username"];
      $nomepessoa = $_POST["idpessoa"];
      $nomeproduto = $_POST["idproduto"];

      
     
      if(count($erros) == 0) {
        $DAO = new VendasDAO();
        $vendas = new Vendas();
        $vendas->data = $data;
        $vendas->valortotal  = $valortotal;
        $vendas->apelido = $usuario;
        $vendas->idpessoa = $nomepessoa;
        $vendas->idproduto = $nomeproduto;

        if($DAO->Inserir($vendas)) {
          $res = "CARRO CADASTRADO COM SUCESSO!";
          header("Location: ../view/inserecarro.php?result=$res");
        }
        else {
          $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
          $err = serialize($erros);
        }
        
        unset($vendas);
      }
      else {
        $err = serialize($erros);
      }
    }
  }
  
  public function conConsulta($op) {
    $DAO = new VendasDAO();
    $lista = array();
    $numCol = 6;
    
    switch($op) {
      case 1:
        $lista = $DAO->Consultar(1);
        break;
    }
    
    if(count($lista) >= 0) {
      for($i = 0; $i < count($lista); $i++) {
        $idvenda = $lista[$i]->idvenda;
        $data = $lista[$i]->data;
        $valortotal = $lista[$i]->valortotal;
        $usuario   = $lista[$i]->username;
        $nomepessoa   = $lista[$i]->idpessoa;
        $nomeproduto   = $lista[$i]->idproduto;
      
        echo "<tr>";
          
        if($idvenda)
          echo "<td style=\"text-align: center;\">$idvenda</td>";
        if($data)
          echo "<td style=\"text-align: left;\">$data</td>";
        if($valortotal)
          echo "<td style=\"text-align: left;\">$valortotal</td>";
        if($usuario)
          echo "<td style=\"text-align: left;\">$usuario</td>";
        if ($nomepessoa)
          echo "<td style=\"text-align: left;\">$nomepessoa</td>";
        if ($nomeproduto)
          echo "<td style=\"text-align: center;\">$nomeproduto</td>";  

        echo "</tr>";
      }
    }
    else {
      echo "<tr>";
      echo "<td colspan=\"$numCol\">Nenhum registro encontrado!</td>";
      echo "</tr>";
    }
  }

  public function controlaAlteracao()
  {
    if(isset($_POST["data"]) && isset($_POST["valortotal"]) && isset($_POST["username"]) && isset($_POST["idpessoa"]) 
    && isset($_POST["idproduto"]) && isset($_POST["selCod"])) {
      $erros = array();
      $data = $_POST["data"];
      $valortotal = $_POST["valortotal"];
      $usuario = $_POST["username"];
      $nomepessoa = $_POST["idpessoa"];
      $nomeproduto = $_POST["idproduto"];
      $idvenda = $_POST["selCod"];      
     
      
      if(count($erros) == 0) {
        $DAO = new VendasDAO();
        $vendas = new Vendas();
        $vendas->data = $data;
        $vendas->valortotal  = $valortotal;
        $vendas->username = $usuario;
        $vendas->idpessoa = $nomepessoa;
        $vendas->idproduto = $nomeproduto;
        $vendas->idvenda = $idvenda;        

        if($DAO->Alterar($vendas)) {
          $res = "VENDA ALTERADA COM SUCESSO!";
          header("Location: ../view/alteravenda.php?resultMode=$res");
        }
        else
        {
          $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
          $err = serialize($erros);
          header("Location: ../view/alteravenda.php?errorMode=$err&idvenda=$idvenda");          
        }
      
        unset($vendas);
      }
      else {
        $err = serialize($erros);  // Caso tenha erro no preenchimento do formulário
        header("Location: ../view/alteravenda.php?errorMode=$err&idvenda=$idvenda");
      }
    }
    else if(isset($_POST["buscaCod"]))
    {
      $idvenda = $_POST["buscaCod"];
      $this->buscaDados($idvenda, 0);  // chamaFormAlterar
    }
  }
  
  public function controlaExclusao()
  {
    if(isset($_POST["selCod"]))
    {
      $DAO = new VendasDAO();
      $vendas = new Vendas();

      $idvendas = $_POST["selCod"];
      $vendas->idvendas = $idvendas;

      if($DAO->Excluir($vendas)) {
        $res = "CARRO EXCLUÍDO COM SUCESSO!";
        header("Location: ../view/excluivenda.php?resultMode=$res");
      }
      else
      {
        $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
        $err = serialize($erros);
        header("Location: ../view/excluivenda.php?errorMode=$err&idvendas=$idvendas");          
      }
      
      unset($vendas);
    }
    else if(isset($_POST["buscaCod"]))
    {
      $idvendas = $_POST["buscaCod"];
      $this->buscaDados($idvendas, 1);  // chamaFormExcluir
    }
  }

}
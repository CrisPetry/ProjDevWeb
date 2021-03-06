<?php
require_once("../Model/FabricaConexao.php");
require_once("../Model/Produto.php");
require_once("../Model/ProdutoDAO.php");



class ProdutoCon{
    public function consultaLista($op)
    {
        $DAO = new ProdutoDAO();
        $lista = array();
        $numCol = 3;

        switch ($op) {
            case 1:
                $lista = $DAO->Consultar();
                break;
        }

        if (count($lista) > 0) {
            for ($i = 0; $i < count($lista); $i++) {
                $codproduto      = $lista[$i]->codproduto;
                $descricao       = $lista[$i]->descricao;
                $estoque         = $lista[$i]->estoque;

                echo "<tr>";
                if ($codproduto)
                    echo "<td style=\"text-align: center;\">$codproduto</td>";
                if ($descricao)
                    echo "<td style=\"text-align: left;\">$descricao</td>";
                if ($estoque)
                    echo "<td style=\"text-align: right;\">$estoque</td>";
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
        $DAO = new ProdutoDAO();
        $lista = array();
        $lista = $DAO->ConsultaProd($op, "", "");

        if ($op != 1)
            $numCol = 3;

        if (count($lista) > 0) {
            for ($i = 0; $i < count($lista); $i++) {
                $codproduto   = $lista[$i]->codproduto;
                $descricao = $lista[$i]->descricao;
                $estoque = $lista[$i]->estoque;
                
                print "<tr>";
                if ($codproduto)
                    print "<td style='text-align: center;'>$codproduto</td>";
                if ($descricao)
                    print "<td style='text-align: left;'>$descricao</td>";
                if ($estoque)
                    print "<td style='text-align: center;'>$estoque</td>";
                print "</tr>";
            }
        } else {
            print "<tr>";
            print "<td colspan='$numCol'>Nenhum registro encontrado!</td>";
            print "</tr>";
        }
    }

    private function buscaDados($codproduto, $modo)
    {
        $DAO = new ProdutoDAO();

        $produto = $DAO->ConsultaProd(3, "codproduto", $codproduto);

        if (count($produto) == 1) {
            $descricao = $produto[0]->descricao;
            $estoque = $produto[0]->estoque;
            

            if ($modo == 0)
                chamaFormAlterar($codproduto, $descricao, $estoque);
            else
                chamaFormExcluir($codproduto, $descricao, $estoque);

            print "<script>";
            print "document.formBuscar.buscaCod.value = '$codproduto';";
            print "document.formBuscar.buscaCod.disabled = true;";
            print "document.formBuscar.button2.disabled  = true;";
            print "</script>";
        } else {
            print "<script>";
            print "alert('PRODUTO N??O ENCONTRADO! Por favor, tente novamente...');";
            print "</script>";
        }

        unset($produto);
    }

    private function preparaDados()
    {
        $produto = new Produto();

        $descricao = $_POST["descricao"];
        $estoque = $_POST["estoque"];

        $produto->descricao = $descricao;
        $produto->estoque = $estoque;

        return $produto;
    }

    public function controlaInsercao()
    {
        if (isset($_POST["descricao"]) && isset($_POST["estoque"])) {
            $DAO  = new ProdutoDAO();
            $produto = $this->preparaDados();

            if ($DAO->Inserir($produto)) {
                print "<script>";
                print "window.location = '../view/insereproduto.php';";
                print "</script>";
            } else {
                print "<script>";
                print "alert('Registro N??O CADASTRADO! ERRO: $DAO->erro');";
                print "document.getElementById('descricao').value = '$produto->descricao';";
                print "document.getElementById('estoque').value = '$produto->estoque';";
                print "</script>";
            }

            unset($produto);
        }
    }

    public function controlaAlteracao()
    {
        if (isset($_POST["descricao"]) && isset($_POST["estoque"])) {
            $DAO  = new ProdutoDAO();
            $produto = $this->preparaDados();

            $codproduto = $_POST["selCod"];
            $produto->codproduto = $codproduto;

            if ($DAO->Alterar($produto)) {
                print "<script>";
                print "document.formBuscar.buscaCod.disabled = false;";
                print "document.formBuscar.button2.disabled  = false;";
                print "window.location = '../view/editaproduto.php';";
                print "</script>";
            } else {
                print "<script>";
                print "alert('Registro N??O ALTERADO! ERRO: $DAO->erro');";
                print "document.getElementById('buscaCod').value = '$codproduto';";
                print "document.getElementById('formBuscar').submit();";
                print "</script>";
            }

            unset($produto);
        } else if (isset($_POST["buscaCod"])) {
            $codproduto = $_POST["buscaCod"];
            $this->buscaDados($codproduto, 0);
        }
    }
    public function controlaExclusao()
    {
        if (isset($_POST["selCod"])) {
            $DAO  = new ProdutoDAO();
            $produto = new Produto();

            $codproduto = $_POST["selCod"];
            $produto->codproduto = $codproduto;

            if ($DAO->Excluir($produto)) {
                print "<script>";
                print "document.formBuscar.buscaCod.disabled = false;";
                print "document.formBuscar.button2.disabled  = false;";
                print "window.location = '../View/deletaproduto.php';";
                print "</script>";
            } else {
                print "<script>";
                print "alert('Registro N??O EXCLU??DO! ERRO: $DAO->erro');";
                print "document.getElementById('buscaCod').value = '$codproduto';";
                print "document.getElementById('formBuscar').submit();";
                print "</script>";
            }

            unset($produto);
        } else if (isset($_POST["buscaCod"])) {
            $codproduto = $_POST["buscaCod"];
            $this->buscaDados($codproduto, 1);
        }
    }
}
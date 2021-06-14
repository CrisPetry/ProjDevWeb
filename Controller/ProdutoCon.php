<?php
require_once("../Model/FabricaConexao.php");
require_once("../Model/Produto.php");
require_once("../Model/ProdutoDAO.php");



class ProdutoCon{
    public function conConsulta($op){
        $DAO = new ProdutoDAO();
        $lista = array();
        $numCol = 4;

        switch($op){
            case 1:
                $lista = $DAO->Consultar();
            break;
        }

        if(count($lista)>0){
            for($i=0; $i<count($lista); $i++){
                $codproduto = $lista[$i]->codproduto;
                $nome       = $lista[$i]->nome;
                $preco      = $lista[$i]->preco;
                $estoque    = $lista[$i]->estoque;
                            

                echo "<tr>";

                if($codproduto)
                    echo "<td style=\"text-align: center;\">$codproduto</td>";
                if ($nome)
                echo "<td style=\"text-align: left;\">$nome</td>";
                if ($preco)
                    echo "<td style=\"text-align: right;\">$preco</td>";
                if ($estoque)
                echo "<td style=\"text-align: left;\">$estoque</td>";

                echo "</tr>";
            }
        }
        else{
            echo "<tr>";
            echo "<td colspan=\"$numCol\">Nenhum registro encontrado!</td>";
            echo "</tr>";
        }
    }

    private function buscaDados($codproduto, $modo)
    {
        $DAO = new ProdutoDAO();

        $produto = $DAO->Consultar(4, "codproduto", $codproduto);

        if (count($produto) == 1) {
            $nome = $produto[0]->nome;
            $preco  = $produto[0]->preco;
            $estoque = $produto[0]->estoque;
            


            if ($modo == 0)
                chamaFormAlterar($codproduto, $nome, $preco, $estoque);
            else
                chamaFormExcluir($codproduto, $nome, $preco, $estoque);

            print "<script>";
            print "document.formBuscar.buscaCod.value = '$codproduto';";
            print "document.formBuscar.buscaCod.disabled = true;";
            print "document.formBuscar.button2.disabled  = true;";
            print "</script>";
        } else {
            print "<script>";
            print "alert('PRODUTO NÃO ENCONTRADO! Por favor, tente novamente...');";
            print "</script>";
        }

        unset($produto);
    }

    private function preparaDados()
    {
        $produto = new Produto();

        $nome = $_POST["nome"];
        $preco  = $_POST["preco"];
        $estoque = $_POST["estoque"];

        $produto->nome = $nome;
        $produto->preco = $preco;
        $produto->estoque = $estoque;
    
        return $produto;
    }

    public function controlaInsercao()
    {
        if (isset($_POST["nome"]) && isset($_POST["preco"]) && isset($_POST["estoque"])) {
            $DAO  = new ProdutoDAO();
            $produto = $this->preparaDados();

            if ($DAO->Inserir($produto)) {
                print "<script>";
                print "alert('PRODUTO CADASTRADO COM SUCESSO!');";
                print "window.location = '../view/insereproduto.php';";
                print "</script>";
            } else {
                print "<script>";
                print "alert('Registro NÃO CADASTRADO! ERRO: $DAO->erro');";
                print "document.getElementById('nome').value = '$produto->nome';";
                print "document.getElementById('preco').value = '$produto->preco';";
                print "document.getElementById('estoque').value = '$produto->estoque';";
                print "</script>";
            }

            unset($produto);
        }
    }

    public function controlaAlteracao()
    {
        if (isset($_POST["nome"]) && isset($_POST["preco"]) && isset($_POST["estoque"])) {
            $DAO  = new ProdutoDAO();
            $produto = $this->preparaDados();

            $codproduto = $_POST["selcod"];
            $produto->codproduto = $codproduto;

            if ($DAO->Alterar($produto)) {
                print "<script>";
                print "alert('PRODUTO ALTERADO COM SUCESSO!');";
                print "document.formBuscar.buscaCod.disabled = false;";
                print "document.formBuscar.button2.disabled  = false;";
                print "window.location = '../view/editaproduto.php';";
                print "</script>";
            } else {
                print "<script>";
                print "alert('Registro NÃO ALTERADO! ERRO: $DAO->erro');";
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
        if (isset($_POST["selcod"])) {
            $DAO  = new ProdutoDAO();
            $produto = new Produto();

            $codproduto = $_POST["selcod"];
            $produto->codproduto = $codproduto;

            if ($DAO->Excluir($produto)) {
                print "<script>";
                print "alert('PRODUTO EXCLUÍDO COM SUCESSO!');";
                print "document.formBuscar.buscaCod.disabled = false;";
                print "document.formBuscar.button2.disabled  = false;";
                print "window.location = '../View/deletaproduto.php';";
                print "</script>";
            } else {
                print "<script>";
                print "alert('Registro NÃO EXCLUÍDO! ERRO: $DAO->erro');";
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
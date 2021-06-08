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
    public function controlaInsercao()
    {
        if (isset($_POST["nome"]) && isset($_POST["preco"]) && isset($_POST["estoque"])) {
            $erros     = array();
            $nome      = $_POST["nome"];
            $preco     = $_POST["preco"];
            $estoque   = $_POST["estoque"];
            

        if (count($erros) == 0) {        
            $DAO  = new ProdutoDAO();
            $produto = new Produto();
            $produto->nome    = $nome;
            $produto->preco   = $preco;
            $produto->estoque = $estoque;

           
                if ($DAO->Inserir($produto)) {
                    $res = "PRODUTO CADASTRADA COM SUCESSO!";
                    header("Location: ../View/insereproduto.php?result=$res");
                } else {
                    $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
                    $err = serialize($erros);
                    
                }

                unset($produto);
            } else {
                $err = serialize($erros);
                header("Location: ../view/insereproduto.php?error=$err&nome=$nome&preco=$preco");
            }
        }
    }

    public function Excluir($produto){
        
            if(isset($_POST["add"])){
                echo 'achou';
            }
            return true;
    }
}
?>
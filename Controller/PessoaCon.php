<?php
require_once("../Model/FabricaConexao.php");
require_once("../Model/Pessoa.php");
require_once("../Model/PessoaDAO.php");
require_once("../Include/PessoaValidate.php");


class PessoaCon{
    public function conConsulta($op){
        $DAO = new PessoaDAO();
        $lista = array();
        $numCol = 6;

        switch($op){
            case 1:
                $lista = $DAO->Consultar();
            break;
        }

        if(count($lista)>0){
            for($i=0; $i<count($lista); $i++){
                $id         = $lista[$i]->id;
                $nome       = $lista[$i]->nome;
                $numsoc     = $lista[$i]->numsoc;
                $endereco   = $lista[$i]->endereco;
                $telefone   = $lista[$i]->telefone;
                $cidade     = $lista[$i]->cidade;
                

                echo "<tr>";

                if($id)
                    echo "<td style=\"text-align: center;\">$id</td>";
                if ($nome)
                echo "<td style=\"text-align: left;\">$nome</td>";
                if ($numsoc)
                    echo "<td style=\"text-align: right;\">$numsoc</td>";
                if ($endereco)
                echo "<td style=\"text-align: left;\">$endereco</td>";
                if ($telefone)
                echo "<td style=\"text-align: left;\" width='3rem'>$telefone</td>";
                if ($cidade)
                    echo "<td style=\"text-align: right;\">$cidade</td>";
                echo "<td style=\"text-align: right;\"><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#pessoaModal'><i class='fa-plus fa' aria-hidden='true'></i></button>&nbsp;
                <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#pessoaModal' ><i class='fa-edit fa' aria-hidden='true'></i></button>&nbsp;<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#pessoaModal'><i class='fa-trash fa' aria-hidden='true'></i></button></td>";
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
        if (isset($_POST["nome"]) && isset($_POST["numsoc"]) && isset($_POST["endereco"]) && isset($_POST["telefone"])
            && isset($_POST["cidade"]) ) {
            $erros = array();
            $nome = $_POST["nome"];
            $numsoc = $_POST["numsoc"];
            $endereco = $_POST["endereco"];
            $telefone = $_POST["telefone"];
            $cidade = $_POST["cidade"];

            if (!PessoaValidate::testarNome($_POST["nome"]))
                $erros[] = "Nome inválido";

            if (count($erros) == 0) {
                $DAO  = new PessoaDAO();
                $pessoa = new Pessoa();
                $pessoa->nome = $nome;
                $pessoa->numsoc = $numsoc;
                $pessoa->endereco = $endereco;
                $pessoa->telefone = $telefone;
                $pessoa->cidade = $cidade;


                if ($DAO->Inserir($pessoa)) {
                    $res = "PESSOA CADASTRADA COM SUCESSO!";
                    header("Location: ../view/inserepessoa.php?result=$res");
                } else {
                    $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
                    $err = serialize($erros);
                    header("Location: ../view/inserepessoa.php?error=$err&nome=$nome&numsoc=$numsoc");
                }

                unset($pessoa);
            } else {
                $err = serialize($erros);
                header("Location: ../view/inserepessoa.php?error=$err&nome=$nome&numsoc=$numsoc");
            }
        }
    }
}
?>
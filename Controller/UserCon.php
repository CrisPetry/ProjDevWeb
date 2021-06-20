<?php
require_once("../Model/FabricaConexao.php");
require_once("../Model/User.php");
require_once("../Model/UserDAO.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>



</head>

<?php
    class UserCon
    {

        public function conConsulta()
        {
            if (!empty($_POST['user']) && !empty($_POST['pwd'])) {
                $user = new User();
                $user->apelido = $_POST['user'];
                $user->senha = md5($_POST['pwd']);

                $DAO = new UserDAO();
                $result = $DAO->ConsultUser($user);

                if ($result) { /* Testa se a consulta retornou algum registro */
                    if ($result == -2) {
                        echo "<p align=center>USUÁRIO NÃO ENCONTRADO!</p>";
                        echo "<a href=\"../View/UserLogin.php\"><br><img id='warning' src='../Imagens/exclamation.png'><br>  
                    <button><i class='fa-arrow-left fa' aria-hidden='true'></i>&nbsp;Voltar</button></a><br>";
                    } else if ($result == -1) {
                        echo "<p>SENHA INCORRETA!</p>";
                        echo "<a href=\"../View/UserLogin.php\"><br><img id='warning' src='../Imagens/exclamation.png'><br>
                    <button><i class='fa-arrow-left fa' aria-hidden='true'></i>&nbsp;Voltar</button></a><br>";
                    } else { /* Tudo certo - registrando as variáveis de sessão */
                        session_start();
                        $_SESSION["nome_usuario"] = $user->apelido;
                        $_SESSION["senha_usuario"] = $user->senha;
                        header("location: ../View/dashboard.php");  /* Direciona para a página inicial */
                    }
                }
            }
        }

    public function consultaLista($op)
    {
        $DAO = new UserDAO();
        $lista = array();
        $numCol = 3;

        switch ($op) {
            case 1:
                $lista = $DAO->ConsultarList();
                break;
        }

        if (count($lista) > 0) {
            for ($i = 0; $i < count($lista); $i++) {
                $id         = $lista[$i]->id;
                $apelido       = $lista[$i]->apelido;
                $senha    = $lista[$i]->senha;



                echo "<tr>";

                if ($id)
                    echo "<td style=\"text-align: center;\">$id</td>";
                if ($apelido)
                    echo "<td style=\"text-align: left;\">$apelido</td>";
                if ($senha)
                    echo "<td style=\"text-align: right;\">$senha</td>";
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
        $DAO = new UserDAO();
        $lista = array();
        $lista = $DAO->Consultar($op, "", "");

        if ($op != 1)
        $numCol = 3;

        if (count($lista) > 0) {
            for ($i = 0; $i < count($lista); $i++) {
                $id   = $lista[$i]->id;
                $apelido = $lista[$i]->apelido;
                $senha  = $lista[$i]->senha;
                

                print "<tr>";

                if ($id)
                    print "<td style='text-align: center;'>$id</td>";
                if ($apelido)
                    print "<td style='text-align: left;'>$apelido</td>";
                if ($senha)
                    print "<td style='text-align: center;'>$senha</td>";
                
                print "</tr>";
            }
        } else {
            print "<tr>";
            print "<td colspan='$numCol'>Nenhum registro encontrado!</td>";
            print "</tr>";
        }
    }

    private function buscaDados($id, $modo) {
        $DAO = new UserDAO();

        $user = $DAO->Consultar(3, "id", $id);

        if (count($user) == 1) {
            $id = $user[0]->id;
            $apelido  = $user[0]->apelido;
            $senha = $user[0]->senha;


            if ($modo == 0)
            chamaFormAlterar($id, $apelido, $senha);
            else
                chamaFormExcluir($id, $apelido, $senha);

            print "<script>";
            print "document.formBuscar.buscaId.value = '$id';";
            print "document.formBuscar.buscaId.disabled = true;";
            print "document.formBuscar.button2.disabled  = true;";
            print "</script>";
        } else {
            print "<script>";
            print "alert('USUÁRIO NÃO ENCONTRADO! Por favor, tente novamente...');";
            print "</script>";
        }

        unset($user);
    }

        private function preparaDados(){
        $user = new User();

        $apelido = $_POST["apelido"];
        $senha  = $_POST["senha"];


        $user->apelido = $apelido;
        $user->senha = $senha;


        return $user;
    }

        public function controlaInsercao()
        {

            if (isset($_POST["user"]) && isset($_POST["pwd"])) {
                $erros = array();
                $user = new User();
                $user->apelido = $_POST['user'];
                $user->senha = md5($_POST['pwd']);

                $DAO = new UserDAO();
                $result = $DAO->Inserir($user);
                if ($result == 1) {
                    $res ="Usuário Adicionado";
                   header("Location: ../view/cadastro.php?result=$res");
                } else if ($result == -1) {
                    $erros[] = "Usuário já cadastrado!";
                    $err = serialize($erros);
                    header("Location: ../view/cadastro.php?error=$err");
                } else {
                    $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
                    $err = serialize($erros);
                    header("Location: ../view/cadastro.php?error$err");
                }
                unset($user);
            }
        }

    public function controlaCreate()
    {

        if (isset($_POST["user"]) && isset($_POST["pwd"])) {
            $erros = array();
            $user = new User();
            $user->apelido = $_POST['user'];
            $user->senha = md5($_POST['pwd']);

            $DAO = new UserDAO();
            $result = $DAO->Inserir($user);
            
            if ($result == -1) {
                $erros[] = "Usuário já cadastrado!";
                $err = serialize($erros);
                header("Location: ../view/createUser.php?error=$err");
            } 
            unset($user);
        }
    }

    public function controlaAlteracao()
    {
        if (isset($_POST["apelido"]) && isset($_POST["senha"])) {
            $DAO  = new UserDAO();
            $user = $this->preparaDados();

            $id = $_POST["selId"];
            $user->id = $id;

            if ($DAO->Alterar($user)) {
                print "<script>";
                print "document.formBuscar.buscaId.disabled = false;";
                print "document.formBuscar.button2.disabled  = false;";
                print "window.location = '../view/editauser.php';";
                print "</script>";
            } else {
                print "<script>";
                print "alert('Registro NÃO ALTERADO! ERRO: $DAO->erro');";
                print "document.getElementById('buscaId').value = '$id';";
                print "document.getElementById('formBuscar').submit();";
                print "</script>";
            }

            unset($user);
        } else if (isset($_POST["buscaId"])) {
            $id = $_POST["buscaId"];
            $this->buscaDados($id, 0);
        }
    }
    public function controlaExclusao()
    {
        if (isset($_POST["selId"])) {
            $DAO  = new UserDAO();
            $user = new User();

            $id = $_POST["selId"];
            $user->id = $id;

            if ($DAO->Excluir($user)) {
                print "<script>";
                print "document.formBuscar.buscaId.disabled = false;";
                print "document.formBuscar.button2.disabled  = false;";
                print "window.location = '../View/deletaUser.php';";
                print "</script>";
            } else {
                print "<script>";
                print "alert('Registro NÃO EXCLUÍDO! ERRO: $DAO->erro');";
                print "document.getElementById('buscaId').value = '$id';";
                print "document.getElementById('formBuscar').submit();";
                print "</script>";
            }

            unset($user);
        } else if (isset($_POST["buscaId"])) {
            $id = $_POST["buscaId"];
            $this->buscaDados($id, 1);
        }
    }
}
?>
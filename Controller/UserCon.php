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
                $result = $DAO->Consultar($user);

                if ($result) { /* Testa se a consulta retornou algum registro */
                    if ($result == -2) {
                        echo "<p align=center>USUÁRIO NÃO ENCONTRADO!</p>";
                        echo "<a href=\"../View/UserLogin.php\"><br><img id='warning' src='../Include/exclamation.png'><br>  
                    <button><i class='fa-arrow-left fa' aria-hidden='true'></i>&nbsp;Voltar</button></a><br>";
                    } else if ($result == -1) {
                        echo "<p>SENHA INCORRETA!</p>";
                        echo "<a href=\"../View/UserLogin.php\"><br><img id='warning' src='../Include/exclamation.png'><br>
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

        public function consultaLista($op){
        $DAO = new UserDAO();
        $lista = array();
        $numCol = 4;

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
                

                echo "<td>
                        <button type='submit'  name='add' class='add'>
                            <i class='fa-plus fa'></i>
                        </button>&nbsp;
                        <button type='submit' name='delete' value='del' class='delete'>
                            <i class='fa-trash fa'></i>&nbsp;
                        </button>
                        <button type='submit' name='editar' value='editar' class='edit'>
                            <i class='fa-edit fa'></i>
                        </button>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr>";
            echo "<td colspan=\"$numCol\">Nenhum registro encontrado!</td>";
            echo "</tr>";
        }
    
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
            if ($result == 1) {
                $res = "Usuário Adicionado";
                header("Location: ../view/createUser.php?result=$res");
            } else if ($result == -1) {
                $erros[] = "Usuário já cadastrado!";
                $err = serialize($erros);
                header("Location: ../view/createUser.php?error=$err");
            } else {
                $erros[] = "ERRO NO BANCO DE DADOS: $DAO->erro";
                $err = serialize($erros);
                header("Location: ../view/createUser.php?error$err");
            }
            unset($user);
        }
    }
    }

    ?>
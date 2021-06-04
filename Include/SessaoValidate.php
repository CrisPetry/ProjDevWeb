<?php
require_once("../Model/FabricaConexao.php");
require_once("../Model/User.php");
require_once("../Model/UserDAO.php");

/* Arquivo de autenticação:
     Verifica se o valor das variáveis de sessão realmente existem e se contém as informações corretas.
     Assim, evita-se o acesso a uma página diretamente pelo endereço URL, sem passar pelo login. */

session_start(); /* restaurando os dados da sessão atual */

if (isset($_SESSION["nome_usuario"]))
    $nome_usuario = $_SESSION["nome_usuario"];

if (isset($_SESSION["senha_usuario"]))
    $senha_usuario = $_SESSION["senha_usuario"];

if (!empty($nome_usuario) || !empty($senha_usuario)) {
    $user = new User();
    $user->id = $nome_usuario;
    $user->senha = $senha_usuario;

    $DAO = new UserDAO();
    $result = $DAO->Consultar($user);

    if ($result < 1) { // Pode ter injetado um usuário existente, mas a senha não conferirá devido ao hash
        unset($_SESSION["nome_usuario"]);
        unset($_SESSION["senha_usuario"]);
        echo "<script>";
        echo "document.getElementById(\"idLogin\").innerHTML = 'Logado como $nome_usuario'";
        echo "</script>";
    }
} else { // Se um dos campos for vazio
    echo "<script>";
    echo "alert(\"Você não efetuou o Login!\");";
    echo "location = \"../View/UserLogin.php\";</script>";  /* Direciona para a página de login */
    echo "</script>";
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <head>
        <meta charset="UTF-8">
        <title>Cadastrar Usuários</title>
        <!-- Links de Estilo -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"
            id="bootstrap-css" />
        <link href="../Include/estilosCadastro.css" rel="stylesheet" />
        <link rel="icon" type="imagem/png" href="../Include/logo.png" />

        <!-- Scripts -->
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

        <style>
        body>div.main>div>div>form>a {
            text-decoration: none;
            color: white;
        }

        a.btn.btn-black:hover {
            text-decoration: none;
            color: #fff !important;
        }
        </style>
    </head>

<body>
    <div class="sidenav">
        <div class="login-main-text">
            <h2>ROUPEX</h2>
            <p>CADASTRO DE USUÁRIOS</p>
        </div>
    </div>
    <div class="main">
        <div class="col-md-6 col-sm-12">
            <div class="login-form">
                <form id="formInserir" name="formInserir" method="post" action="cadastro.php">
                    <div class="form-group">
                        <label>Usuário
                            <input type="text" name="user" id="user" class="form-control"
                                placeholder="Informe seu usuário" required />
                        </label>
                    </div>
                    <div class="form-group">
                        <label>Senha
                            <input type="password" name="pwd" id="pwd" class="form-control"
                                placeholder="Informe sua senha" required />
                        </label>
                    </div>
                    <conteiner-fluid>
                        <button type="submit" name="button" id="button" class="btn btn-black">
                            <i class="fa-spinner fa" aria-hidden="true"></i>
                            Registrar</button>
                        <a href="../index.php" class="btn btn-black">
                            <i class="fa-arrow-left fa" aria-hidden="true"></i>
                            Voltar</a>
                    </conteiner-fluid>
                </form>
            </div>
        </div>
    </div>
    <?php
    include_once("../Include/UserResult.php");
    include_once("../Controller/UserCon.php");
    $obj = new UserCon();
    $obj->controlaInsercao();
    ?>
</body>

</html>
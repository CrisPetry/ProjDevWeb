<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inserir Produtos</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../CSS/estiloproduto.css">
    <link rel="icon" type="imagem/png" href="../Imagens/logo.png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
    table {
        border-radius: 12rem !important;
    }

    table,
    td,
    th {
        border: 1px solid black;
    }

    th {
        text-align: center;
        font-weight: bold;
    }

    td {
        width: 12rem;
        text-align: center !important;
    }

    table {
        margin: 0 auto;
        border-collapse: collapse;
    }

    a {
        text-decoration: none;
    }

    .navbar {
        width: 100%;
        background-color: lightblue !important;
    }

    .content {
        margin-top: 1rem;
    }

    #idLogin {
        font-family: 'Permanent Marker', cursive;
        font-size: medium;
        font-weight: 500;
    }

    .dropdown {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .dropdown:hover .dropdown-content {
        display: block;
        cursor: pointer;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    body>div>div>div.content>table>tbody>tr>td>button {
        border: none;
        color: #000;
        cursor: pointer;
        font-size: large;
        background-color: transparent;
    }

    body>div>div>div.content>table>tbody>tr>td>button:hover {
        text-decoration: none;
        background-color: transparent;
        color: black;
    }

    .fa-edit fa {
        align-content: right;
    }

    .conteiner {
        border: 0.1rem solid transparent;
        text-align: center;
        width: 100%;
        margin: auto 0;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand"><img src="../Imagens/logo.png" alt="roupex" height="60" width="60"></a>
            <form class="d-flex">
                <i class="fa fa-user fa-lg">&nbsp;</i>
                <div class="dropdown">
                    <h5 id="idLogin" style="text-align: right"></h5>
                    <div class="dropdown-content">
                        <a href="../View/logout.php" class="btn btn-black">
                            <i class="fa-power-off fa" aria-hidden="true"></i>
                            Sair</a>
                    </div>
                </div>
            </form>
        </div>
    </nav>
    <?php
    include("../Include/SessaoValidate.php");
    ?>

    <div class="conteiner">
        <div class="form-group">
            <h3 style="text-align: center;">EDITAR PRODUTO</h3>
        </div>
        <form id="formBuscar" name="formBuscar" method="post" action="editaproduto.php">

            <div class="form-group">
                <div class="   col-md-6 offset-md-3">
                    <label>BUSCAR:
                        <input type="text" name="buscaCod" id="buscaCod" required placeholder="insira o código">
                    </label>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-search"></i></button>

                </div>
            </div>
        </form>
        <?php
        function  chamaFormAlterar($codproduto, $nome, $preco, $estoque)
        {
        ?>

        <form id="formAlterar" name="formAlterar" method="post" action="editaproduto.php"
            onsubmit="return confirm('Deseja alterar este produto?');">

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <input type="hidden" name="selCod" id="selCod" value="<?php print $codproduto; ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <label>NOME: </label>
                    <input type="text" name="nome" id="nome" value="<?php print $nome; ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <label>PREÇO: </label>
                    <input type="text" name="preco" id="preco" value="<?php print $preco; ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <label>ESTOQUE: </label>
                    <input type="text" name="estoque" id="estoque" value="<?php print $estoque; ?>">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-check"></i> Confirmar</button>
                    </a>
                </div>
            </div>
        </form>
        <?php
        }
        include_once("../Controller/ProdutoCon.php");
        $obj = new ProdutoCon();
        $obj->controlaAlteracao();
        ?>
        <a href="../View/listaproduto.php">
            <button type="button" class="btn btn-info"><i class="fa fa-arrow-left"> Voltar</i></button>
    </div>
</body>

</html>
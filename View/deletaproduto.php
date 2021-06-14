<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Deletar Pessoas</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../CSS/estilodelete.css">
    <link rel="icon" type="imagem/png" href="../Imagens/logo.png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
    a {
        text-decoration: none;
    }

    #navbar {
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

    .fa-edit fa {
        align-content: right;
    }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-light bg-light" id="navbar">
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
    include("../Include/SessaoValidate.php");  // Faz a autenticação	
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body class="jumbotron jumbotron-fluid">
        <div class="container">
            <form id="formBuscar" name="formBuscar" method="post" action="deletaproduto.php">
                <h3>Deleção de Produtos</h3>
                <div class="card">
                    <label>Informe o Código:
                        <input type="text" name="selcod" id="selcod" required>
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                        <a href="../View/listaproduto.php">
                            <button type="button" class="btn btn-success"><i class="fa fa-arrow-left"></i></button>
                        </a>
                    </label>
                </div>

            </form>

            <?php
            /* abrindo o bloco da função que mantém oculto "formExcluir"... */
            function  chamaFormExcluir($codproduto, $nome, $preco, $estoque)
            {
            ?>

            <form id="formExcluir" name="formExcluir" method="post" action="deletaproduto.php"
                onsubmit="return confirm('Você tem certeza que deseja excluir esta pessoa?');">
                <input type="hidden" name="buscaCod" id="buscaCod" value="<?php print $codproduto; ?>">
                <p>
                    <label>Nome do produto:
                        <input type="text" name="nome" id="nome" value="<?php print $nome; ?>" readonly>
                    </label>
                </p>
                <p>
                    <label>Preço:
                        <input type="text" name="preco" id="preco" value="<?php print $preco; ?>" readonly>
                    </label>
                </p>
                <p>
                    <label>Estoque:
                        <input type="text" name="estoque" id="estoque" value="<?php print $estoque; ?>" readonly>
                    </label>
                </p>
                <p>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash"></i> Confirma exclusão?
                    </button>
                </p>
            </form>


            <?php
                /* fechando o bloco da função... */
            }
            include_once("../Controller/ProdutoCon.php");
            $obj = new ProdutoCon();
            $obj->controlaExclusao();
            ?>

            <br>

        </div>
    </body>

</html>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Produtos</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Include/estiloprodutos.css">
    <link rel="icon" type="imagem/png" href="../Include/logo.png" />
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
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand"><img src="../Include/logo.png" alt="roupex" height="60" width="60"></a>
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
    include_once("../controller/UserCon.php");
    $obj = new UserCon();
    $obj->conConsulta(1);
    ?>

<section>
    <div class="container">
    <h3>Inserção de um novo produto</h3>
    <form id="formInserir" name="formInserir" method="post" action="insereproduto.php">
      <p>
        <label>Descrição do Produto:
          <input type="text" name="nome" id="nome" size="50" required class="form-control">
        </label>
      </p>
      <p>
        <label>Preço R$:
          <input type="text" name="preco" id="preco" class="form-control">
        </label>
      </p>
      <p>
        <label>Quantidade:
          <input type="number" name="estoque" id="estoque" step="0" min="0" required class="form-control"> (somente números inteiros)
        </label>
      </p>
      <p>
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-plus"></i> Inserir
        </button>
      </p>
    </form>
    <br>
    <a href="../View/dashboard.php">
      <button type="button" class="btn btn-success"><i class="fa fa-arrow-left"></i> Retornar para o Dashboard</button>
    </a>
  </div>

  <?php
    include_once("../Controller/ProdutoCon.php");
    $obj = new ProdutoCon();
    $obj->controlaInsercao();
  ?>
  </section>
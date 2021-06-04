<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Usuários</title>
    <!-- Links de Estilo -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="imagem/png" href="../Include/logo.png" />
    <style>
    body {
        margin: 0;
    }

    table,
    td,
    th {
        border: 1px solid black;
    }

    th {
        font-weight: bold;
    }

    table {
        border-collapse: collapse !important;
    }

    a {
        text-decoration: none;
    }

    #headir {
        background-color: lightblue !important;
        width: 100%;
    }

    .table {
        width: 63%;
        display: block;
        margin-left: auto;
        margin-right: auto;
        border: 0.1rem solid transparent;
        padding-bottom: 1rem;
    }

    button {
        background-color: #000;
        color: #fff;
        cursor: pointer;
        border-radius: 0.25rem;
        white-space: nowrap;
        font-size: 1rem;
        display: inline-block;
        border: 0.25rem solid transparent;
        text-align: center;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light justify-content-between" id="headir">
        <img src="../Include/logo.png" alt="roupex" height="90" width="90">
        </form>
    </nav>

    <h5 id="idLogin" style="text-align: right"></h5>
    <conteiner-fluid class="table">
        <h3>Usuários</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
            </tr>
            <?php
            include("../include/SessaoValidate.php");  // Faz a autenticação
            include_once("../controller/UserCon.php");
            $obj = new UserCon();
            $obj->conConsulta(1);
            ?>
        </table>
        <br>
        <a href="../index.php">
            <button type="button"><i class='fa-arrow-left fa' aria-hidden='true'></i>&nbsp;Voltar</button></a><br>
        </a>
    </conteiner-fluid>

</body>

</html>
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

        .navbar {
            width: 100%;
            display: flex;
            background-color: lightblue !important;
        }

        #idLogin {
            margin: auto;
            padding-right: 1.2rem;
            font-family: monospace;
            font-size: large;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand"><img src="../Include/logo.png" alt="roupex" height="60" width="60"></a>
            <form class="d-flex">
            </form>
        </div>
    </nav>

    <h5 id="idLogin" style="text-align: right"></h5>
    <conteiner-fluid class="table">
        <h3>Usuários</h3>
        <table>
            <tr>
                <th>Usuário</th>
                <th>Senha</th>
                <th>ID</th>
            </tr>
            <?php
            include_once("../Model/FabricaConexao.php");
            include_once("../controller/UserCon.php");

            $obj = new UserCon();
            $obj->conConsulta(1);

            $user = $_POST['apelido'];

            $dados = $conn->prepare('SELECT senha, id FROM usuario WHERE apelido = ?');
            $dados->bindParam('CrisPetry', $user);

            $dados->execute();

            if($dados->rowCount()>0){
                $linha = $dados->dba_fetch(PDO::FETCH_OBJ);
                echo 'Usuario: ' . $linha->apelido;
            }
            ?>
        </table>
        <br>
        <a href="../View/dashboard.php">
            <button type="button"><i class='fa-arrow-left fa' aria-hidden='true'></i>&nbsp;Voltar</button></a><br>
        </a><br>
        
    </conteiner-fluid>

</body>

</html>
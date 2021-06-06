<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Status de Login</title>

    <!-- Links de Estilo -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
    <link href="../Include/estilosLogin.css" rel="stylesheet" />
    <link rel="icon" type="imagem/png" href="../Include/logo.png" />
    <style>
        * {
            text-align: center;
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

        .nav {
            width: 40%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            padding-top: 1rem;

        }

        p {
            font-weight: bold;
            color: red;
            padding-top: 0.5rem;
        }

        h3 {
            padding-top: 1rem;
        }

        #headir {
            background-color: lightblue !important;
        }

        #warning {
            padding-bottom: 2rem;
        }

        .navbar {
            width: 100%;
            display: flex;
            background-color: lightblue !important;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand"><img src="../Include/logo.png" alt="roupex" height="60" width="60"></a>
        </div>
    </nav>


    <h3 style="text-align: center">Status do Login</h3>
    <conteiner-fluid class="nav" style="text-align: center">
        <?php
        include_once("../controller/UserCon.php");
        $obj = new UserCon();
        $obj->conConsulta();
        ?>
    </conteiner-fluid>
</body>

</html>
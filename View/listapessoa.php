<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Pessoas</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Include/estilopessoa.css">
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

        .fa-edit fa {
            align-content: right;
        }

        .content>table>tbody>tr>td>button {
            border: none;
            color: #000;
            cursor: pointer;
            font-size: large;
            background-color: transparent;
        }

        .card {
            padding-bottom: 2rem;
        }

        .rTable{
            margin-bottom: 1rem;
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
    <div class="card-body">
        <div class="jumbotron">
            <div class="card">
                <h3>REGISTROS</h3>
                <div class="content">
                    <table class="rTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>CPF/CNPJ</th>
                                <th>Endereço</th>
                                <th>Telefone</th>
                                <th>Cidade</th>
                            </tr>
                        </thead>

                        <?php
                        include("../include/SessaoValidate.php");  // Faz a autenticação
                        include_once("../controller/PessoaCon.php");
                        $obj = new PessoaCon();
                        $obj->conConsulta(1);
                        ?>
                    </table>
                    <div class='conteiner-button'>
                        <button type="button" id="add" name="add" class="btn btn-success btn-floating">
                            <i class="fa-plus fa"></i>
                        </button>
                        <button type="button" id="delete" name="delete" class="btn btn-success btn-floating">
                            <i class="fa-trash fa"></i>
                        </button>
                        <button type="button" class="btn btn-danger btn-floating">
                            <i class="fa-edit fa"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js" integrity="sha512-d4KkQohk+HswGs6A1d6Gak6Bb9rMWtxjOa0IiY49Q3TeFd5xAzjWXDCBW9RS7m86FQ4RzM2BdHmdJnnKRYknxw==" crossorigin="anonymous"></script>
    </div>

    <script>
        $('#add').click(function() {
            window.location.href = 'inserepessoa.php';
        })
    </script>



</body>

</html>
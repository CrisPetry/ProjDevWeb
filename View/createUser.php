<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inserir Usuários</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../CSS/estiloUser.css">
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
    include_once("../controller/UserCon.php");
    $obj = new UserCon();
    $obj->controlaCreate();
    ?>

    <div class="conteiner">
        <div class="form-group">
            <h3 style="text-align: center;">CADASTRAR USUÁRIO</h3>
        </div>

        <form id="formInserir" name="formInserir" method="POST" action="createUser.php">

            <div class="form-group">
                <div class="   col-md-6 offset-md-3">
                    <label>USUÁRIO</label>
                    <input type="text" name="user" id="user" class="form-control" placeholder="Informe seu usuário"
                        required />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <label>SENHA</label>
                    <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Informe sua senha"
                        required />
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <input type="submit" value="Inserir" class="btn btn-primary" name="button" id="button">
                    <a href="../View/listarUsers.php">
                        <input type="button" value="Voltar" class="btn btn-success" name="voltar" id="voltar"></a>
                </div>
            </div>
    </div>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"
        integrity="sha512-d4KkQohk+HswGs6A1d6Gak6Bb9rMWtxjOa0IiY49Q3TeFd5xAzjWXDCBW9RS7m86FQ4RzM2BdHmdJnnKRYknxw=="
        crossorigin="anonymous"></script>
    </div>

    <script>
    document.querySelector('#formInserir').addEventListener('submit', function(e) {
        var form = this;
        e.preventDefault();
        Swal.fire({
            title: "Adicionar usuário?",
            icon: "danger",
            showCancelButton: true,
            showConfirmButton: true,
            confirmButtonColor: "#218838",
            cancelButtonColor: "#f94848",
        }).then(function(isConfirm) {
            if (isConfirm) {
                Swal.fire({
                    title: 'Usuário Adicionado!',
                    icon: 'success',
                    showConfirmButton: true,
                    confirmButtonColor: "#218838",
                }).then(function() {
                    form.submit();
                });
            };
        });
    });
    </script>
</body>

</html>
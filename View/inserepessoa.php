<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inserir Pessoas</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../CSS/estilocadastrar.css">
    <link rel="icon" type="imagem/png" href="../Imagens/logo.png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
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
    include("../Include/SessaoValidate.php");  // Faz a autenticação
    include_once("../Controller/PessoaCon.php");
    $obj = new PessoaCon();
    $obj->controlaInsercao();
    ?>

    <div class="conteiner">
        <div class="form-group">
            <h3 style="text-align: center;">CADASTRAR PESSOA</h3>
        </div>

        <form id="formInserir" name="formInserir" method="POST" action="inserepessoa.php">

            <div class="form-group">
                <div class="   col-md-6 offset-md-3">
                    <label>NOME</label>
                    <input type="text" name="nome" id="nome" class="form-control " required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <label>CPF/CNPJ</label>
                    <input type="text" name="numsoc" id="numsoc" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <label>ENDEREÇO</label>
                    <input type="text" name="endereco" id="endereco" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <label>TELEFONE</label>
                    <input type="text" name="telefone" id="telefone" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <label>CIDADE</label>
                    <input type="text" name="cidade" id="cidade" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 offset-md-3">
                    <input type="submit" value="Enviar" class="btn btn-primary" name="button" id="button">
                    <a href="../View/listapessoa.php">
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"
        integrity="sha512-d4KkQohk+HswGs6A1d6Gak6Bb9rMWtxjOa0IiY49Q3TeFd5xAzjWXDCBW9RS7m86FQ4RzM2BdHmdJnnKRYknxw=="
        crossorigin="anonymous"></script>
    </div>



    <script>
    $(document).ready(function() {
        $("#telefone").mask("(99)99999-9999");
    });
    </script>

    <script>
    var tamanho = $("#numsoc").val().length;
    if (tamanho < 11) {
        $("#numsoc").mask("999.999.999-99");
    } else {
        $("#numsoc").mask("99.999.999/9999-99");
    }
    </script>

    <script>
    document.querySelector('#formInserir').addEventListener('submit', function(e) {
        var form = this;

        e.preventDefault();

        swal({
            title: "Salvar registro?",
            icon: "warning",
            buttons: [
                'Não',
                'Sim'
            ],
            dangerMode: true,
        }).then(function(isConfirm) {
            if (isConfirm) {
                swal({
                    title: 'Pessoa Adicionado!',
                    icon: 'success'
                }).then(function() {
                    form.submit();
                });
            }
        });
    });
    </script>

</body>

</html>
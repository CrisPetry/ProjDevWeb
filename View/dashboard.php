<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dash</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Include/estilodash.css">
    <link rel="icon" type="imagem/png" href="../Include/logo.png" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<style>
        .btn-black {
            font-family: 'Merienda One', cursive;
            background-color: #000 !important;
            color: #fff;
        }

        .btn-black:hover {
            text-decoration: none;
            color: white;
        }

        body>section>div>div>div:nth-child(4)>a {
            text-decoration: none;
            color: black;
        }

        body>section>div>div>div:nth-child(3)>a {
            text-decoration: none;
            color: black;
        }

        body>section>div>div>div:nth-child(2)>a {
            text-decoration: none;
            color: black;
        }

        body>section>div>div>div:nth-child(1)>a {
            text-decoration: none;
            color: black;
        }

        .navbar {
            width: 100%;
            display: flex;
            background-color: lightblue !important;
        }

        #idLogin {
            padding-right: 1.2rem;
            font-family: 'Permanent Marker', cursive;
            font-size: medium;
            font-weight: 500;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
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
            <div class="row mbr-justify-content-center">
                <div class="col-lg-6 mbr-col-md-10">
                    <a href="login.html">
                        <div class="wrap">
                            <div class="ico-wrap">
                                <span class="mbr-iconfont fa-dollar fa"></span>
                            </div>
                            <div class="text-wrap vcenter">
                                <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">
                                    <span>Vendas</span>
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 mbr-col-md-10">
                    <a href="../View/listapessoa.php">
                        <div class="wrap">
                            <div class="ico-wrap">
                                <span class="mbr-iconfont fa-users fa"></span>
                            </div>
                            <div class=" text-wrap vcenter">
                                <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">
                                    <span>Pessoas</span>
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 mbr-col-md-10">
                    <a href="listaProduto.php">
                        <div class="wrap">
                            <div class="ico-wrap">
                                <span class="mbr-iconfont fa-search fa"></span>
                            </div>
                            <div class="text-wrap vcenter">
                                <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5">
                                    <span>Produtos</span>
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6 mbr-col-md-10">
                    <a href="cadastroUser.php">
                        <div class="wrap">
                            <div class="ico-wrap">
                                <span class="mbr-iconfont fa-user-circle fa"></span>
                            </div>
                            <div class="text-wrap vcenter">
                                <h2 class="mbr-fonts-style mbr-bold mbr-section-title3 display-5"> <span>Produto Venda</span>
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <footer class="mt-auto">Inovação é o nosso lema.</footer>
</body>

</html>
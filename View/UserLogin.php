<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Página de Login</title>

  <!-- Links de Estilo -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
  <link href="../Include/estilosLogin.css" rel="stylesheet" />
  <link rel="icon" type="imagem/png" href="../Include/logo.png" />

  <!-- Scripts -->
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

  <style>
    body>div.main>div>div>form>a {
      text-decoration: none;
      color: white;
    }

    a.btn.btn-black:hover {
      text-decoration: none;
      color: #fff !important;
    }
  </style>
</head>

<body>
  <form id="form1" style="text-align: center" name="form1" method="post" action="../View/login.php">
    <div class="sidenav">
      <div class="login-main-text">
        <h2>ROUPEX</h2>
        <p>ACESSO AO SISTEMA</p>
      </div>
    </div>
    <div class="main">
      <div class="col-md-6 col-sm-12">
        <div class="login-form">
          <form>
            <div class="form-group">
              <label>Usuário</label>
              <input type="text" name="user" id="user" class="form-control" placeholder="Informe seu usuário" required />
            </div>
            <div class="form-group">
              <label>Senha</label>
              <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Informe sua senha" required />
            </div>
            <button type="submit" name="enviar" id="enviar" class="btn btn-black">
              <i class="fa-spinner fa" aria-hidden="true"></i>
              Entrar</button>
            <a href="../index.php" class="btn btn-black">
              <i class="fa-arrow-left fa" aria-hidden="true"></i>
              Voltar</a>
          </form>
        </div>
      </div>
    </div>


</body>

</html>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="utf-8">
    <title>Exercício Prático PHP+MySQL</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="jumbotron jumbotron-fluid">
    <div class="container">
        <h3>Editar Pessoa</h3>
        <form id="formBuscar" name="formBuscar" method="post" action="editaUser.php">
            <label>Informe o ID do usuário:
                <input type="text" name="buscaId" id="buscaId" required>
            </label>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search"></i> Buscar
            </button>
        </form>
        <?php
        /* abrindo o bloco da função que mantém oculto "formExcluir"... */
        function  chamaFormAlterar($id, $apelido, $senha)
        {
        ?>

        <form id="formAlterar" name="formAlterar" method="post" action="editaUser.php"
            onsubmit="return confirm('Você tem certeza que deseja alterar esta pessoa?');">
            <input type="hidden" name="selId" id="selId" value="<?php print $id; ?>">
            <p>
                <label>Nome de Usuário:
                    <input type="text" name="apelido" id="apelido" value="<?php print $apelido; ?>">
                </label>
            </p>
            <p>
                <label>Senha:
                    <input type="text" name="senha" id="senha" value="<?php print $senha; ?>">
                </label>
            </p>
           
            <p>
                <button type="submit" class="btn btn-warning">
                    <i class="fa fa-edit"></i> Confirma alteração?
                </button>
            </p>
        </form>


        <?php
            /* fechando o bloco da função... */
        }
        include_once("../Controller/UserCon.php");
        $obj = new UserCon();
        $obj->controlaAlteracao();
        ?>

        <br>
        <a href="../View/listarUsers.php">
            <button type="button" class="btn btn-success"><i class="fa fa-arrow-left"></i> Retornar para a página
                principal</button>
        </a>
    </div>
</body>

</html>
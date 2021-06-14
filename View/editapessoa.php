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
        <h3>Alteração de dados de um produto</h3>
        <form id="formBuscar" name="formBuscar" method="post" action="editapessoa.php">
            <label>Informe o código do produto:
                <input type="text" name="buscaId" id="buscaId" required>
            </label>
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search"></i> Buscar
            </button>
        </form>
        <?php
        /* abrindo o bloco da função que mantém oculto "formExcluir"... */
        function  chamaFormAlterar($id, $nome, $numsoc, $endereco, $telefone, $cidade)
        {
        ?>

            <form id="formAlterar" name="formAlterar" method="post" action="editapessoa.php" onsubmit="return confirm('Você tem certeza que deseja alterar esta pessoa?');">
                <input type="hidden" name="selId" id="selId" value="<?php print $id; ?>">
                <p>
                    <label>Nome da pessoa:
                        <input type="text" name="nome" id="nome" value="<?php print $nome; ?>" readonly>
                    </label>
                </p>
                <p>
                    <label>CPF/CNPJ:
                        <input type="text" name="numsoc" id="numsoc" value="<?php print $numsoc; ?>" readonly>
                    </label>
                </p>
                <p>
                    <label>Endereço:
                        <input type="text" name="endereco" id="endereco" value="<?php print $endereco; ?>" readonly>
                    </label>
                </p>
                <p>
                    <label>Telefone:
                        <input type="text" name="telefone" id="telefone" value="<?php print $telefone; ?>" readonly>
                    </label>
                </p>
                <p>
                    <label>Endereço:
                        <input type="text" name="cidade" id="cidade" value="<?php print $cidade; ?>" readonly>
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
        include_once("../Controller/PessoaCon.php");
        $obj = new PessoaCon();
        $obj->controlaAlteracao();
        ?>

        <br>
        <a href="../View/listapessoa.php">
            <button type="button" class="btn btn-success"><i class="fa fa-arrow-left"></i> Retornar para a página
                principal</button>
        </a>
    </div>
</body>

</html>
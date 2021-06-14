<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Exemplo completo PHP+MySQL+Session+Login: Consultar</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
        }

        th {
            font-weight: bold;
        }

        table {
            border-collapse: collapse;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <h5 id="idLogin" style="text-align: right"></h5>
    <h3>Exibindo registros da tabela Carros</h3>
    <table>
        <tr>
            <th>Código</th>
            <th>Data</th>
            <th>Valor Total</th>
            <th>Usuário</th>
            <th>Nome Pessoa</th>
            <th>Nome Produto</th>
        </tr>
        <?php
        include("../include/SessaoValidate.php");  // Faz a autenticação
        include_once("../Controller/VendasController.php");
        $obj = new VendasController();
        $obj->conConsulta(1);
        ?>
    </table>
    <br>
    <a href="/View/dashboard.php">
        <button type="button">Retornar para a página principal</button>
    </a>
</body>

</html>
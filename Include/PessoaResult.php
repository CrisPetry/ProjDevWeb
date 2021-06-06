<?php
    if(isset($_GET["result"])) {
      $res = htmlspecialchars($_GET["result"]);
      echo "<script>alert(\"$res\");";
      echo "</script>";
    }
  
    if(isset($_GET["error"])) {
      $err = array();
      $err = unserialize($_GET['error']);
      $nome = htmlspecialchars($_GET['nome']);
      $razaoSoc = htmlspecialchars($_GET['razaoSoc']);
      $cpf = htmlspecialchars($_GET['cpf']);
      $cnpj = htmlspecialchars($_GET['cnpj']);
      $endereco = htmlspecialchars($_GET['endereco']);
      $email = htmlspecialchars($_GET['email']);
      $telefone = htmlspecialchars($_GET['telefone']);
      $cidade = htmlspecialchars($_GET['cidade']);
      $uf = htmlspecialchars($_GET['uf']);
      $cep = htmlspecialchars($_GET['cep']);
       $str = ":: ";
    
    foreach ($err as $e)
      $str .= $e . " :: ";
    
    echo "<script>alert(\"$str\");";
    echo "document.getElementById('nome').value = \"$nome\";";
    echo "document.getElementById('razaoSoc').value = \"$razaoSoc\";";
    echo "document.getElementById('cpf').value = \"$cpf\";";
    echo "document.getElementById('cnpj').value = \"$cnpj\";";
    echo "document.getElementById('endereco').value = \"$endereco\";";
    echo "document.getElementById('email').value = \"$email\";";
    echo "document.getElementById('telefone').value = \"$telefone\";";
    echo "document.getElementById('cidade').value = \"$cidade\";";
    echo "document.getElementById('uf').value = \"$uf\";";
    echo "document.getElementById('cep').value = \"$cep\";";
    echo "</script>";
  }
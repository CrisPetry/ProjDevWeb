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
      $numsoc = htmlspecialchars($_GET['numsoc']);
      $endereco = htmlspecialchars($_GET['endereco']);
      $telefone = htmlspecialchars($_GET['telefone']);
      $cidade = htmlspecialchars($_GET['cidade']);
       $str = ":: ";
    
    foreach ($err as $e)
      $str .= $e . " :: ";
    
    echo "<script>alert(\"$str\");";
    echo "document.getElementById('nome').value = \"$nome\";";
    echo "document.getElementById('numsoc').value = \"$numsoc\";";
    echo "document.getElementById('endereco').value = \"$endereco\";";
    echo "document.getElementById('telefone').value = \"$telefone\";";
    echo "document.getElementById('cidade').value = \"$cidade\";";
    echo "</script>";
  }
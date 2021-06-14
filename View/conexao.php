<?php
     $servidor = "localhost";
     $porta = 5432;
     $bancoDeDados = "LojaRoupa";
     $usr = "postgres";
     $pwd = "masterkey";

     $conexao = pg_connect("host=$servidor port=$porta dbname=$bancoDeDados user=$usr password=$pwd");
     if(!$conexao) {
         die("Não foi possível se conectar ao banco de dados.");
     }

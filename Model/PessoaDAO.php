<?php

class PessoaDAO{
    public $p = null;
    public $erro = null;

    public function __construct(){
        $this->p = new FabricaConexao();
    }

  function ConsultarList($query = null)
  {
    try {
      $items = array();

      if ($query != null)
        $stmt = $this->p->query($query);
      else
        $stmt = $this->p->query("SELECT * FROM pessoa ORDER BY id asc");

      while ($registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        $p = new Pessoa();

        if (isset($registro["id"]))
          $p->id = $registro["id"];
        if (isset($registro["nome"]))
          $p->nome = $registro["nome"];
        if (isset($registro["numsoc"]))
          $p->numsoc = $registro["numsoc"];
        if (isset($registro["endereco"]))
          $p->endereco = $registro["endereco"];
        if (isset($registro["telefone"]))
          $p->telefone = $registro["telefone"];
        if (isset($registro["cidade"]))
          $p->cidade = $registro["cidade"];


        // Ao final, adiciona o registro como um item do array de retorno
        $items[] = $p;
      }
      // Fecha a conexão
      unset($this->p);

      return $items;
    }
    // Em caso de erro, retorna a mensagem:
    catch (PDOException $e) {
      echo "Erro: " . $e->getMessage();
    }
  }

    public function Inserir($pessoa){
        try{
            $sql = "INSERT INTO pessoa (nome, numsoc, endereco, telefone, cidade) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->p->prepare($sql);

            $this->p->beginTransaction();
            $stmt->bindValue(1, $pessoa->nome);
            $stmt->bindValue(2, $pessoa->numsoc);
            $stmt->bindValue(3, $pessoa->endereco);
            $stmt->bindValue(4, $pessoa->telefone);
            $stmt->bindValue(5, $pessoa->cidade);


            $stmt->execute();

            $this->p->commit(); 
            
            unset($this->p);

            return true;

        }
         catch (PDOException $e) {
            $this->erro = "ERRO: " . $e->getMessage();
               return false;
            }  
    }


    public function Alterar($pessoa)
    {
        try {
            $stmt = $this->p->prepare("UPDATE pessoa SET nome=?, numsoc=?, endereco=?, telefone=?, cidade=? WHERE id=?");
            // Inicia a transação
            $this->p->beginTransaction();
            // Vincula um valor a um parâmetro da sentença SQL, na ordem
            $stmt->bindValue(1, $pessoa->nome);
            $stmt->bindValue(2, $pessoa->numsoc);
            $stmt->bindValue(3, $pessoa->endereco);
            $stmt->bindValue(4, $pessoa->telefone);
            $stmt->bindValue(5, $pessoa->cidade);
            $stmt->bindValue(6, $pessoa->id);

            // Executa a query
            $stmt->execute();

            // Grava a transação
            $this->p->commit();

            // Fecha a conexão DAO
            $this->p = null;

            return true;
        }
        // Em caso de erro, retorna a mensagem:
        catch (PDOException $e) {
            $this->erro = "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function Excluir($pessoa)
    {
        try {
            $stmt = $this->p->prepare("DELETE FROM pessoa WHERE id=?");
            // Inicia a transação
            $this->p->beginTransaction();
            // Vincula um valor a um parâmetro da sentença SQL, na ordem
            $stmt->bindValue(1, $pessoa->id);

            // Executa a query
            $stmt->execute();

            // Grava a transação
            $this->p->commit();

            // Fecha a conexão DAO
            $this->p = null;

            return true;
        }
        // Em caso de erro, retorna a mensagem:
        catch (PDOException $e) {
            $this->erro = "Erro: " . $e->getMessage();
            return false;
        }
    }

  public function Consultar($op, $param, $value)
  {
    $query="";
    try {
      $items = array();

      switch ($op) {
        default:
          $query = "SELECT * FROM pessoa WHERE $param = $value";
      }

      if ($query != null)
        $stmt = $this->p->query($query);
      else
        $stmt = $this->p->query("SELECT * FROM pessoa");

      // Fecha a conexão DAO
      $this->p = null;

      // Busca a próxima linha de um conjunto de resultados
      while ($registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        $p = new Pessoa();

        // Sempre verifica se a query SQL retornou a respectiva coluna
        if (isset($registro["id"]))
          $p->id = $registro["id"];
        if (isset($registro["nome"]))
          $p->nome = $registro["nome"];
        if (isset($registro["numsoc"]))
          $p->numsoc = $registro["numsoc"];
        if (isset($registro["endereco"]))
          $p->endereco = $registro["endereco"];
        if (isset($registro["telefone"]))
        $p->telefone = $registro["telefone"];
        if (isset($registro["cidade"]))
        $p->cidade = $registro["cidade"];

        // Ao final, adiciona o registro como um item do array de retorno
        $items[] = $p;
      }

      return $items;
    }
    // Em caso de erro, retorna a mensagem:
    catch (PDOException $e) {
      echo "Erro: " . $e->getMessage();
    }
  }
}
?>
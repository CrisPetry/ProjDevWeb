<?php
class VendaDAO {
  // Recebe a conexão
  public $p = null;
  public $erro = null;
  
  // construtor
  public function __construct() {
    $this->p = new FabricaConexao();
  }

  // inserção
  public function Inserir($venda)
  {
    try {
      $stmt = $this->p->prepare("INSERT INTO venda (data, valortotal, codpessoa, codproduto, apelido) VALUES (?, ?, ?, ?, ?)");

      // Inicia a transação
      $this->p->beginTransaction();
      $stmt->bindValue(1, $venda->data);
      $stmt->bindValue(2, $venda->valortotal);
      $stmt->bindValue(3, $venda->codpessoa);
      $stmt->bindValue(4, $venda->codproduto);
      $stmt->bindValue(5, $venda->id);

      
      // Executa a query
      $stmt->execute();
      
      // Grava a transação
      $this->p->commit();

      print_r($stmt);
      // Fecha a conexão
      unset($this->p);

      return true;
    }
    // Em caso de erro, retorna a mensagem:
    catch (PDOException $e) {
      $this->erro = "Erro: " . $e->getMessage();
      return false;
    }
  }
  
  // alteração
  public function Alterar($venda) {
    try {
      $stmt = $this->p->prepare("UPDATE venda SET data=?, valortotal=?, codpessoa=?, codproduto=?, id=? WHERE codvenda=?");
     
      $this->p->beginTransaction();
      $stmt->bindValue(1, $venda->data);
      $stmt->bindValue(2, $venda->valortotal);
      $stmt->bindValue(3, $venda->codpessoa);
      $stmt->bindValue(4, $venda->codproduto);
      $stmt->bindValue(5, $venda->id);
      $stmt->bindValue(6, $venda->codvenda);
    
      // Executa a query
      $stmt->execute();
  
      // Grava a transação
      $this->p->commit();
    
      // Fecha a conexão
      unset($this->p);

      return true;
    }
    // Em caso de erro, retorna a mensagem:
    catch(PDOException $e) {
      $this->erro = "Erro: " . $e->getMessage();
    return false;
    }
  }

  // exclusão
  public function Excluir($venda) {
    try {
      $stmt = $this->p->prepare("DELETE FROM venda WHERE codvenda=?");
      // Inicia a transação
      $this->p->beginTransaction();
      // Vincula um valor a um parâmetro da sentença SQL, na ordem
      $stmt->bindValue(1, $venda->codvenda);
    
      // Executa a query
      $stmt->execute();
      
      // Grava a transação
      $this->p->commit();
      
      // Fecha a conexão
      unset($this->p);

      return true;
    }
    // Em caso de erro, retorna a mensagem:
    catch(PDOException $e) {
      $this->erro = "Erro: " . $e->getMessage();
      return false;
    }
  }
  

  // consulta
  public function Consultar($op, $param=null) {
    try {
      $items = array();

      switch ($op) {
        case 1:
          $sql = "SELECT venda.codvenda, venda.data, venda.valortotal, pessoa.nome, produto.descricao, usuario.apelido
          FROM venda, pessoa, produto, usuario
		      WHERE venda.codpessoa = pessoa.id AND venda.codproduto = produto.codproduto 
		      AND venda.codusuario = usuario.id";
          break;
        case 2:
          $sql = "SELECT * FROM venda WHERE codvenda = $param";  // volta só um registro
          break;
      }

      $stmt = $this->p->query($sql);

      while ($registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        $p = new Venda();

        // Sempre verifica se a query SQL retornou a respectiva coluna
        if (isset($registro["codvenda"]))
        $p->codvenda = $registro["codvenda"];
        if (isset($registro["data"]))
        $p->data = $registro["data"];
        if (isset($registro["valortotal"]))
          $p->valortotal = $registro["valortotal"];

        if ($op == 1) {
          if (isset($registro["nome"]))
            $p->codpessoa = $registro["nome"];
          if (isset($registro["descricao"]))
          $p->codproduto = $registro["descricao"];
          if (isset($registro["apelido"]))
          $p->id = $registro["apelido"];
        } else {  // $op == 2
          if (isset($registro["descricao"]))
          $p->codproduto = $registro["descricao"];
        }

        
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

  public function ConsultarP($op, $param, $value)
  {
    $query = "";
    try {
      $items = array();

      switch ($op) {
        default:
          $query = "SELECT * FROM venda WHERE $param = $value";
      }

      if ($query != null)
        $stmt = $this->p->query($query);
      else
        $stmt = $this->p->query("SELECT * FROM venda");

      // Fecha a conexão DAO
      $this->p = null;

      // Busca a próxima linha de um conjunto de resultados
      while ($registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        $p = new Venda();

        // Sempre verifica se a query SQL retornou a respectiva coluna
        if (isset($registro["codvenda"]))
        $p->codvenda = $registro["codvenda"];
        if (isset($registro["data"]))
        $p->data = $registro["data"];
        if (isset($registro["valortotal"]))
        $p->valortotal = $registro["valortotal"];
        if (isset($registro["nome"]))
          $p->codpessoa = $registro["nome"];
        if (isset($registro["descricao"]))
        $p->codproduto = $registro["descricao"];
        if (isset($registro["apelido"]))
        $p->id = $registro["apelido"];

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
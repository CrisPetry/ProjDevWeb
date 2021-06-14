<?php
class VendasDAO {
  // Recebe a conexão
  public $p = null;
  public $erro = null;
  
  // construtor
  public function __construct() {
    $this->p = new FabricaConexao();
  }
  
  // inserção
  public function Inserir($vendas) {
    try {
      $stmt = $this->p->prepare("INSERT INTO vendas (idvendas, data, valtotal, username, idpessoa, idproduto) VALUES (?, ?, ?, ?, ?, ?)");
      
      // Inicia a transação
      $this->p->beginTransaction();
      $stmt->bindValue(1, $vendas->data);
      $stmt->bindValue(2, $vendas->valtotal);
      $stmt->bindValue(3, $vendas->username);
      $stmt->bindValue(4, $vendas->idpessoa);
      $stmt->bindValue(5, $vendas->idproduto);
    
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
  
  // alteração
  public function Alterar($vendas) {
    try {
      $stmt = $this->p->prepare("UPDATE vendas SET data=?, valtotal=?, username=?, idpessoa=?, idproduto WHERE idvendas=?");
      // Inicia a transação
      $this->p->beginTransaction();
      // Vincula um valor a um parâmetro da sentença SQL, na ordem
      $stmt->bindValue(1, $vendas->data);
      $stmt->bindValue(2, $vendas->valtotal);
      $stmt->bindValue(3, $vendas->username);
      $stmt->bindValue(4, $vendas->idpessoa);
      $stmt->bindValue(5, $vendas->idproduto);
      $stmt->bindValue(6, $vendas->idvendas);
    
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
  public function Excluir($vendas) {
    try {
      $stmt = $this->p->prepare("DELETE FROM vendas WHERE idvendas=?");
      // Inicia a transação
      $this->p->beginTransaction();
      // Vincula um valor a um parâmetro da sentença SQL, na ordem
      $stmt->bindValue(1, $vendas->idvendas);
    
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
          $sql = "SELECT vendas.idvenda, vendas.data, vendas.valortotal, produto.id
          FROM 'vendas', `pessoa` WHERE vendas.idproduto = produto.id";
          break;
        case 2:
          $sql = "SELECT * FROM carros WHERE codigo = $param";  // volta só um registro
          break;
      }

      $stmt = $this->p->query($sql);
              
      while($registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
      {
        $p = new Vendas();
      
        // Sempre verifica se a query SQL retornou a respectiva coluna
        if(isset($registro["idvendas"]))
          $p->idvendas = $registro["idvendas"];
        if(isset($registro["data"]))
          $p->data = $registro["data"];
        if(isset($registro["valortotal"]))
          $p->valortotal = $registro["valortotal"];
        
        if($op == 1) {
        if(isset($registro["username"])){
            $p->apelido = $registro["username"];
        }else if(isset($registro["nome"])){
            $p->idpessoa = $registro["nome"];
        }else if(isset($registro["nome"])){
            $p->idproduto = $registro["nome"];
        }else {  // $op == 2
          if(isset($registro["username"])){
            $p->apelido = $registro["username"];          
        }else if(isset($registro["nome"])){
            $p->idpessoa = $registro["nome"];
        }else if(isset($registro["nome"]))
            $p->idproduto = $registro["nome"];
        }
    }
        // Ao final, adiciona o registro como um item do array de retorno
        $items[] = $p;
      }

      // Fecha a conexão
      unset($this->p);
    
      return $items;
    }
    // Em caso de erro, retorna a mensagem:
    catch(PDOException $e) {
      echo "Erro: ". $e->getMessage();
    }
  }
}
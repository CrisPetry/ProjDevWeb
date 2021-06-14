<?php
class UserDAO {
  // Recebe a conexão
  public $p = null;
  public $erro = null;
  
  // construtor
  public function __construct() {
    $this->p = new FabricaConexao();
  }
  
  // inserção
  public function Inserir($obj) {
    try {
      /* Primeiro, testa se o usuário informado já existe no BD.
       Se sim, retorna para tratamento no UserController */
      $stmt = $this->p->query("SELECT * FROM usuario WHERE apelido = '$obj->apelido'");
      if($stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
        return -1;
  
      /* A partir daqui, o usuário é novo e será salvo no BD */
      $stmt = $this->p->prepare("INSERT INTO usuario (apelido, senha) VALUES (?, ?)");

      // Inicia a transação
      $this->p->beginTransaction();
      $stmt->bindValue(1, $obj->apelido);
      $stmt->bindValue(2, $obj->senha);
    
      // Executa a query
      $stmt->execute();

      // Grava a transação
      $this->p->commit();      
      
      // Fecha a conexão
      unset($this->p);
      
      return 1;
    }
    // Em caso de erro, retorna a mensagem:
    catch(PDOException $e) {
      $this->erro = "Erro: " . $e->getMessage();
      return 0;
    }
  }
  
  // consulta
  public function Consultar($obj) {
    try {
      /* Busca pelo registro... se existir, deve trazer só uma linha,
      pois a coluna apelido é chave primária */
      $stmt = $this->p->query("SELECT * FROM usuario WHERE apelido = '$obj->apelido'");
      $registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

      // Fecha a conexão
      unset($this->p);

      if(!$registro) {
        // Não encontrou o usuário
        return -2;
      }
      else {
        if (strcmp($registro["senha"], $obj->senha) !== 0) {
          // Senha não confere
          return -1;
        }
        else {
          // Tudo certo!
          return 1;
        }
      }
    }
    // Em caso de erro, retorna a mensagem:
    catch(PDOException $e) {
      echo "Erro: ". $e->getMessage();
      return 0;
    }
  }

  function ConsultarList($query = null)
  {
    try {
      $items = array();

      if ($query != null)
        $stmt = $this->p->query($query);
      else
        $stmt = $this->p->query("SELECT * FROM usuario");

      while ($registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) {
        $p = new User();

        if (isset($registro["id"]))
        $p->id = $registro["id"];
        if (isset($registro["apelido"]))
        $p->apelido = $registro["apelido"];
        if (isset($registro["senha"]))
        $p->senha = $registro["senha"];
        
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

  public function Alterar($user)
  {
    try {
      $stmt = $this->p->prepare("UPDATE usuario SET apelido=? WHERE id=?");
      // Inicia a transação
      $this->p->beginTransaction();
      // Vincula um valor a um parâmetro da sentença SQL, na ordem
      $stmt->bindValue(1, $user->apelido);
      $stmt->bindValue(2, $user->senha);
      $stmt->bindValue(6, $user->id);

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

  public function Excluir($user)
  {
    try {
      $stmt = $this->p->prepare("DELETE FROM usuario WHERE id=?");
      // Inicia a transação
      $this->p->beginTransaction();
      // Vincula um valor a um parâmetro da sentença SQL, na ordem
      $stmt->bindValue(1, $user->id);

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
}
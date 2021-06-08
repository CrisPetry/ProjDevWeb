<?php

class ProdutoDAO{
    public $p = null;
    public $erro = null;

    public function __construct(){
        $this->p = new FabricaConexao();
    }

    public function Inserir($produto){
        try{
            $sql = "INSERT INTO produto (nome, preco, estoque) VALUES (?, ?, ?)";
            $stmt = $this->p->prepare($sql);

            $this->p->beginTransaction();
            $stmt->bindValue(1, $produto->nome);
            $stmt->bindValue(2, $produto->preco);
            $stmt->bindValue(3, $produto->estoque);


            $stmt->execute();
            $this->p->commit();
            unset($this->p);

            return true;
        } catch (PDOException $e) {
            $this->erro = "ERRO: " . $e->getMessage();
            return false;
        }
    }

    public function Alterar($produto){
        try{
            $stmt = $this->p->prepare("UPDATE produto SET nome=?, preco=?, estoque=? WHERE id=?");
            $this->p->beginTransaction();
            $stmt->bindValue(1, $produto->nome);
            $stmt->bindValue(2, $produto->preco);
            $stmt->bindValue(3, $produto->estoque);
            $stmt->bindValue(3, $produto->id);

            $stmt->execute();
            $this->p->commit();
            unset($this->p);
            return true;
        }
        catch(PDOException $e){
            $this->erro = "ERRO: " . $e->getMessage();
        return false;
        }
    }

    public function Excluir($produto){
        try{
            $stmt = $this->p->prepare("DELETE FROM produto WHERE id=?");
            $this->p->beginTransaction();
            $stmt->bindValue(1, $produto->id);
            $stmt->execute();
            $this->p->commit();
            unset($this->p);
            return true;
        }
        catch(PDOException $e){
            $this->erro = "ERRO: " . $e->getMessage();
            return false;
        }
    }

    public function Consultar($query=null){
        try{
            $items = array();

            if($query != null)
                $stmt = $this->p->query($query);
            else
                $stmt = $this->p->query("SELECT * FROM produto");

            while($registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){
                $p = new Produto();

                if (isset($registro["id"]))
                    $p->id = $registro["id"];
                if (isset($registro["nome"]))
                    $p->nome = $registro["nome"];
                if (isset($registro["preco"]))
                    $p->numsoc = $registro["preco"];
                if (isset($registro["eestoque"]))
                    $p->endereco = $registro["estoque"];
                                
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
}
?>
<?php

class PessoaDAO{
    public $p = null;
    public $erro = null;

    public function __construct(){
        $this->p = new FabricaConexao();
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


    function Alterar($pessoa){
        try{
            $stmt = $this->p->prepare("UPDATE pessoa SET nome, numsoc, endereco, telefone, cidade) VALUES (?, ?, ?, ?, ?)");
            $this->p->beginTransaction();
            $stmt->bindValue(1, $pessoa->nome);
            $stmt->bindValue(2, $pessoa->numsoc);
            $stmt->bindValue(3, $pessoa->endereco);
            $stmt->bindValue(4, $pessoa->telefone);
            $stmt->bindValue(5, $pessoa->cidade);
            $stmt->bindValue(6, $pessoa->id);

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

    public function Excluir($pessoa){
        try{
            $stmt = $this->p->prepare("DELETE FROM pessoa WHERE id=?");
            $this->p->beginTransaction();
            $stmt->bindValue(1, $pessoa->id);
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

    function Consultar($query=null){
        try{
            $items = array();

            if($query != null)
                $stmt = $this->p->query($query);
            else
                $stmt = $this->p->query("SELECT * FROM pessoa");

            while($registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)){
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
}
?>
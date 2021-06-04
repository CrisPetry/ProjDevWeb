<?php
class UserDAO
{
    //Recebe a conexão
    public $p = null;
    public $error = null;

    //Construtor
    public function __construct()
    {
        $this->p = new FabricaConexao();
        
    }

    //inserção
    public function Inserir($obj)
    {
        try {
            /* Primeiro, testa se o usuário informado já existe no BD.
                Se sim, retorna para tratamento no UserController */
            $stmt = $this->p->query("SELECT * FROM usuario WHERE apelido = '$obj->apelido'");
            if ($stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT))
                return -1;

            /* A partir daqui, o usuário é novo e será salvo no BD */
            $stmt = $this->p->prepare("INSERT INTO usuario (apelido, senha, id) VALUES(?, ?, ?)");

            //Inicia transação
            $this->p->beginTransaction();
            $stmt->bindValue(1, $obj->apelido);
            $stmt->bindValue(2, $obj->senha);
            $stmt->bindValue(3, $obj->id);

            //Executa a query
            $stmt->execute();

            //Grava a transmissão
            $this->p->commit();

            //Fecha a conexão
            unset($this->p);

            return 1;
        }

        //Em caso de erro retorna a mensagem:
        catch (PDOException $e) {
            $this->error = "ERRO: " . $e->getMessage();
            return 0;
        }
    }

    // Consulta 
    public function Consultar($obj)
    {
        try {
            /* Busca pelo registro... se existir, deve trazer só uma linha,
            pois a coluna apelido é chave primária */
            $stmt = $this->p->query("SELECT * FROM usuario WHERE apelido = '$obj->apelido'");
            $registro = $stmt->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

            //fecha conexão 
            unset($this->p);

            if (!$registro) {
                //não encontrou usuário
                return -2;
            } else {
                if (strcmp($registro["senha"], $obj->senha) !== 0) {
                    //senha não confere
                    return -1;
                } else {
                    //OK!
                    return 1;
                }
            }
        }
        //Em caso de erro, retorna a mensagem:
        catch (PDOException $e) {
            echo "ERRO: " . $e->getMessage();
            return 0;
        }
    }
}

?>

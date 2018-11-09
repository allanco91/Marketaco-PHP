<?php

namespace Marketaco;

class DALOperador
{
    /**
     * PDO object
     * @var \PDO
     */
    private $pdo;
 
    /**
     * Initialize the object with a specified PDO object
     * @param \PDO $pdo
     */
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Realiza o login no site 
     * @param string $login
     * @param string $senha
     * @return bool
     */
    public function Logar($login, $senha){
        //Query statement SQL para selecionar todos os pedidos no banco de dados
        $sql = 'SELECT * '
        . 'FROM public."Operador" '
        . 'WHERE "Login" = :login AND "Senha" = :senha';

        $stmt = $this->pdo->prepare($sql);
        //Bind nos valores no statement
        $stmt->bindValue(':login', $login);
        $stmt->bindValue(':senha', $senha);
        
        // execute the statement
        $stmt->execute();

		if ($stmt->rowCount() == 1):
			$logar = $stmt->fetch(\PDO::FETCH_OBJ);
			$_SESSION['operador'] = $logar->Nome;
			$_SESSION['logado'] = true;
			return true;
		else:
			return false;
		endif;
    }

    /**Realiza o loggout no sistema
     * 
     */
	public static function Deslogar() {
		if(isset($_SESSION['logado'])):
            unset($_SESSION['logado']);
            unset($_SESSION['operador']);
			session_destroy();
		endif;
	}
}
<?php

namespace Marketaco;

class DALLogs
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

    public function addLog($Data, $Operador, $Acao)
    {
        //Query statement SQL para selecionar todos os pedidos no banco de dados
        $sql = 'INSERT INTO public."Logs"('
        . '"Data", "Operador", "Acao") '
        . 'VALUES ('
        . ':data, '
        . ':operador, '
        . ':acao)';

        $stmt = $this->pdo->prepare($sql);
        //Bind nos valores no statement
        $stmt->bindValue(':data', $Data);
        $stmt->bindValue(':operador', $Operador);
        $stmt->bindValue(':acao', $Acao);
        // execute the statement
        $stmt->execute();

        // return generated id
        return $this->pdo->lastInsertId('"Logs_LogsID_seq"');
    }
}
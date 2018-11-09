<?php

namespace Marketaco;

class DALPedido
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
     * Find Pedido by PedidoID
     * @param int $PedidoID
     * @return a Pedido object
     */
    public function achaPedido($PedidoID) {
        //Query statement SQL para selecionar o pedido no banco de dados pelo id
        $sql = 'SELECT "PedidoID", "Data", "DataEntrega", "DataSaida", "ValorTotal", "FormaPag", "Desconto", "ValorFinal", "ValorPago", "Saldo", "Troco", "Pago", "ClienteID", "EnderecoID", "StatusPedidoID" '
        . 'FROM public."Pedido" '
        . 'WHERE "PedidoID" = :id';

        $stmt = $this->pdo->prepare($sql);
        // bind value to the :id parameter
        $stmt->bindValue(':id', $PedidoID);

        // execute the statement
        $stmt->execute();
 
        // return the result set as an object
        return $stmt->fetchObject();
    }

    /**
     * Return all rows in the stocks table
     * @param int $Status
     * @return array
     */
    public function listaPedidos($Status) {
        
        //Query statement SQL para selecionar todos os pedidos no banco de dados
        $sql = 'SELECT "PedidoID", "DataEntrega", "ValorFinal" '
        . 'FROM public."Pedido" '
        . 'WHERE "StatusPedidoID" = :status';
        
        $stmt = $this->pdo->prepare($sql);
        //Bind nos valores no statement
        $stmt->bindValue(':status', $Status);
        
        // execute the statement
        $stmt->execute();
        
        $pedidos = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $pedidos[] = [
                'PedidoID' => $row['PedidoID'],
                'DataEntrega' => $row['DataEntrega'],
                'ValorFinal' => $row['ValorFinal']
            ];
        }
        return $pedidos;
    }

    /**
     * Update Pedido based on the specified PedidoID
     * @param int $PedidoID
     * @param date $Data
     * @param int $Status
     * @return int
     */
    public function updatePedido($PedidoID , $Data, $Status)
    {
        //Query statement SQL para atualizar a linha no banco de dados
        $sql = 'UPDATE public."Pedido" '
        . 'SET "DataSaida" = :dsaida, '
        . '"StatusPedidoID" = :status '
        . 'WHERE "PedidoID" = :id';

        $stmt = $this->pdo->prepare($sql);

        //Bind nos valores no statement
        $stmt->bindValue(':dsaida', $Data);
        $stmt->bindValue(':status', $Status);
        $stmt->bindValue(':id', $PedidoID);
        //Atualiza a tabela Pedido
        $stmt->execute();

        //Retorna o número de linhas afetadas
        return $stmt->rowCount();
    }

    public function finalizaPedido($PedidoID , $Saldo, $ValorPago, $Troco, $Pago, $Status)
    {
        //Query statement SQL para atualizar a linha no banco de dados
        $sql = 'UPDATE public."Pedido" '
        . 'SET "Saldo" = :saldo, '
        . '"ValorPago" = :valorpago, '
        . '"Troco" = :troco, '
        . '"Pago" = :pago, '
        . '"StatusPedidoID" = :status '
        . 'WHERE "PedidoID" = :id';

        $stmt = $this->pdo->prepare($sql);

        //Bind nos valores no statement
        $stmt->bindValue(':saldo', $Saldo);
        $stmt->bindValue(':valorpago', $ValorPago);
        $stmt->bindValue(':troco', $Troco);
        $stmt->bindValue(':pago', $Pago);
        $stmt->bindValue(':status', $Status);
        $stmt->bindValue(':id', $PedidoID);
        //Atualiza a tabela Pedido
        $stmt->execute();

        //Retorna o número de linhas afetadas
        return $stmt->rowCount();
    }
}
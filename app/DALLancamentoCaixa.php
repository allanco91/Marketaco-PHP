<?php

namespace Marketaco;

class DALLancamentoCaixa
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
     * Return all rows in the stocks table
     * @param int $PedidoID
     * @return array
     */
    public function listaPagamentos($PedidoID)
    {    
        //Query statement SQL para selecionar todos os pedidos no banco de dados
        $sql = 'SELECT "Data", "Entrada", "FormaPagamentoID", "PedidoID" '
        . 'FROM public."LancamentoCaixa" '
        . 'WHERE "PedidoID" = :pedidoid';
        
        $stmt = $this->pdo->prepare($sql);
        //Bind nos valores no statement
        $stmt->bindValue(':pedidoid', $PedidoID);
        
        // execute the statement
        $stmt->execute();
        
        $forma;
        $pagamentos = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            switch ($row['FormaPagamentoID']) {
                case 1:
                    $forma = 'Dinheiro';
                    break;
                case 2:
                    $forma = 'Débito';
                    break;
                case 3:
                    $forma = 'Crédito';
                    break;
            }
            $pagamentos[] = [
                'Valor' => $row['Entrada'],
                'FormaPagamento' => $forma,
                'FormaPagamentoID' => $row['FormaPagamentoID'],
                'PedidoID' => $row['PedidoID'],
                'Apagar' => 0
            ];
        }
        $jsonData = json_encode($pagamentos);
        file_put_contents('pagamentos.json', $jsonData);
    }

    public function addPagamento($Data, $Descricao, $Entrada, $Saida, $Observacao, $Excluir, $CaixaID, $FormaPagamentoID, $PedidoID)
    {
        //Query statement SQL para selecionar todos os pedidos no banco de dados
        $sql = 'INSERT INTO public."LancamentoCaixa"('
        . '"Data", "Descricao", "Entrada", "Saida", "Observacao", "Excluir", "CaixaID", "FormaPagamentoID", "PedidoID") '
        . 'VALUES ('
        . ':data, '
        . ':descricao, '
        . ':entrada, '
        . ':saida, '
        . ':observacao, '
        . ':excluir, '
        . ':caixaid, '
        . ':formapagamentoid, '
        . ':pedidoid)';

        $stmt = $this->pdo->prepare($sql);
        //Bind nos valores no statement
        $stmt->bindValue(':data', $Data);
        $stmt->bindValue(':descricao', $Descricao);
        $stmt->bindValue(':entrada', $Entrada);
        $stmt->bindValue(':saida', $Saida);
        $stmt->bindValue(':observacao', $Observacao);
        $stmt->bindValue(':excluir', $Excluir);
        $stmt->bindValue(':caixaid', $CaixaID);
        $stmt->bindValue(':formapagamentoid', $FormaPagamentoID);
        $stmt->bindValue(':pedidoid', $PedidoID);
        // execute the statement
        $stmt->execute();

        // return generated id
        return $this->pdo->lastInsertId('"LancamentoCaixa_LancamentoCaixaID_seq"');
    }

    public function addPagamentoJSON($Pagamento)
    {
        $pagamentos = [];

        $pag = file_get_contents('pagamentos.json');
        $tempArray = json_decode($pag, false);

        foreach ($tempArray as $item)
        {
            $pagamentos[] = [
                'Valor' => $item->Valor,
                'FormaPagamento' => $item->FormaPagamento,
                'FormaPagamentoID' => $item->FormaPagamentoID,
                'PedidoID' => $item->PedidoID,
                'Apagar' => $item->Apagar
            ];
        }

        array_push($pagamentos, $Pagamento);
        $jsonData = json_encode($pagamentos);
        file_put_contents('pagamentos.json', $jsonData);
    }

    public function delPagamentoJSON($Pos)
    {
        $pag = file_get_contents('pagamentos.json');
        $tempArray = json_decode($pag, false);
        unset($tempArray[$Pos]);
        $pagamentos = [];

        foreach ($tempArray as $item)
        {
            $pagamentos[] = [
                'Valor' => $item->Valor,
                'FormaPagamento' => $item->FormaPagamento,
                'FormaPagamentoID' => $item->FormaPagamentoID,
                'PedidoID' => $item->PedidoID,
                'Apagar' => $item->Apagar
            ];
        }

        $jsonData = json_encode($pagamentos);
        file_put_contents('pagamentos.json', $jsonData);
    }

    public function somaEntrada($FormaPagamento, $CaixaID)
    {
        //Query statement SQL para selecionar todos os pedidos no banco de dados
        $sql = 'SELECT SUM("Entrada") '
        . 'FROM public."LancamentoCaixa" '
        . 'WHERE "FormaPagamentoID" = :formapag '
        . 'AND "CaixaID" = :id';

        $stmt = $this->pdo->prepare($sql);
        // bind values to the parameters
        $stmt->bindValue(':formapag', $FormaPagamento);
        $stmt->bindValue(':id', $CaixaID);
        // execute the statement
        $stmt->execute();
        
        $soma = 0;
        while ($row = $stmt->fetch(\PDO::FETCH_NUM))
        {
            $soma = $row[0];
        }
        //retorna a soma
        return $soma;
    }

    public function somaSaida($FormaPagamento, $CaixaID)
    {
        //Query statement SQL para selecionar todos os pedidos no banco de dados
        $sql = 'SELECT SUM("Saida") '
        . 'FROM public."LancamentoCaixa" '
        . 'WHERE "FormaPagamentoID" = :formapag '
        . 'AND "CaixaID" = :id';

        $stmt = $this->pdo->prepare($sql);
        // bind values to the parameters
        $stmt->bindValue(':formapag', $FormaPagamento);
        $stmt->bindValue(':id', $CaixaID);
        // execute the statement
        $stmt->execute();
        
        $soma = 0;
        while ($row = $stmt->fetch(\PDO::FETCH_NUM))
        {
            $soma = $row[0];
        }
        //retorna a soma
        return $soma;
    }
}
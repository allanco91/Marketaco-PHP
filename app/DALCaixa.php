<?php

namespace Marketaco;

class DALCaixa
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

    public function verificaCaixa()
    {    
        //Query statement SQL para selecionar todos os pedidos no banco de dados
        $sql = 'SELECT "CaixaID", "Data_Abertura", "Data_Fechamento", "SaldoInicial", "SaldoFinal", "E_Dinheiro", "C_Debito", "C_Credito", "E_Cheque", "SaldoDinheiro", "S_Dinheiro", "S_Cheque", "Observacao", "Status" '
        . 'FROM public."Caixa" '
        . 'ORDER BY "CaixaID" DESC LIMIT 1';
        
        $stmt = $this->pdo->prepare($sql);
        // execute the statement
        $stmt->execute();
        // retorna o caixa como um objeto
        return $stmt->fetchObject();
    }

    public function atualizaCaixa($CaixaID, $e_dinheiro, $c_debito, $c_credito, $e_cheque, $s_dinheiro, $s_cheque, $saldo_dinheiro, $saldo_final)
    {
        //Query statement SQL para selecionar todos os pedidos no banco de dados
        $sql = 'UPDATE public."Caixa" '
        . 'SET "E_Dinheiro"= :e_dinheiro, '
        . '"C_Debito"= :c_debito, '
        . '"C_Credito"= :c_credito, '
        . '"E_Cheque"= :e_cheque, '
        . '"S_Dinheiro"= :s_dinheiro, '
        . '"S_Cheque"= :s_cheque, '
        . '"SaldoDinheiro"= :saldo_dinheiro, '
        . '"SaldoFinal"= :saldo_final '
        . 'WHERE "CaixaID"= :id';

        $stmt = $this->pdo->prepare($sql);
        // bind values to the parameters
        $stmt->bindValue(':e_dinheiro', $e_dinheiro);
        $stmt->bindValue(':c_debito', $c_debito);
        $stmt->bindValue(':c_credito', $c_credito);
        $stmt->bindValue(':e_cheque', $e_cheque);
        $stmt->bindValue(':s_dinheiro', $s_dinheiro);
        $stmt->bindValue(':s_cheque', $s_cheque);
        $stmt->bindValue(':saldo_dinheiro', $saldo_dinheiro);
        $stmt->bindValue(':saldo_final', $saldo_final);
        $stmt->bindValue(':id', $CaixaID);
        // execute the statement
        $stmt->execute();
        //Retorna o número de linhas afetadas
        return $stmt->rowCount();
    }
}
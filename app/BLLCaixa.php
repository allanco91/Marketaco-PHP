<?php
    
    namespace Marketaco;

    require 'vendor/autoload.php';
    use Marketaco\Conexao as Conexao;
    use Marketaco\DALCaixa as DALCaixa;

class BLLCaixa
{
    public function verificaCaixa()
    {
        try
        {
            $pdo = Conexao::get()->connect();
            //
            $DALCaixa = new DALCaixa($pdo);
            //Pega o ultimo caixa do sistema
            $caixa = $DALCaixa->verificaCaixa();
            //
            return $caixa;
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }   
    }

    public function atualizaCaixa($CaixaID, $e_dinheiro, $c_debito, $c_credito, $e_cheque, $s_dinheiro, $s_cheque, $saldo_dinheiro, $saldo_final)
    {
        try
        {
            $pdo = Conexao::get()->connect();
            //
            $DALCaixa = new DALCaixa($pdo);
            //Atualiza o caixa de acordo com os parametros passados
            $caixa = $DALCaixa->atualizaCaixa($CaixaID, $e_dinheiro, $c_debito, $c_credito, $e_cheque, $s_dinheiro, $s_cheque, $saldo_dinheiro, $saldo_final);
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}
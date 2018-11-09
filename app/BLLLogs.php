<?php
    
    namespace Marketaco;

    require 'vendor/autoload.php';
    use Marketaco\Conexao as Conexao;
    use Marketaco\DALLogs as DALLogs;

class BLLLogs
{
    public function addLog($Data, $Operador, $Acao)
    {
        try
        {
            $pdo = Conexao::get()->connect();
            //
            $DALLogs = new DALLogs($pdo);
            //grava o log e retorna a id inserida
            $Log = $DALLogs->addLog($Data, $Operador, $Acao);

            return $Log;
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}
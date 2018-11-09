<?php
    
    namespace Marketaco;

    require 'vendor/autoload.php';
    use Marketaco\Conexao as Conexao;
    use Marketaco\DALOperador as DALOperador;

class BLLOperador
{
    public function Logar($login, $senha)
    {
        try
        {
            $pdo = Conexao::get()->connect();
            //
            $DALOperador = new DALOperador($pdo);
            //verifica o operador pelo login e senha e retorna bool
            $Operador = $DALOperador->Logar($login, $senha);

            return $Operador;
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public static function Deslogar()
    {
        DALOperador::Deslogar();
        header("Location: index.php");
    }
}
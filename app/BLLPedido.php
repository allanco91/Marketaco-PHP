<?php
    
    namespace Marketaco;

    require 'vendor/autoload.php';
    use Marketaco\Conexao as Conexao;
    use Marketaco\DALPedido as DALPedido;

class BLLPedido
{
    public function achaPedido($PedidoID)
    {
        try
        {
            $pdo = Conexao::get()->connect();
            //
            $DALPedido = new DALPedido($pdo);
            //pega o pedido pela id
            $Pedido = $DALPedido->achaPedido($PedidoID);

            return $Pedido;
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function listaPedidos($Status)
    {
        try
        {
            $pdo = Conexao::get()->connect();
            //
            $DALPedido = new DAlPedido($pdo);
            //seleciona todos os pedidos pelo status
            $Pedidos = $DALPedido->listaPedidos($Status);

            return $Pedidos;
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function updatePedido($PedidoID , $Data, $Status)
    {
        try
        {
            $pdo = Conexao::get()->connect();
            //
            $DALPedido = new DALPedido($pdo);
            //Atualiza o pedido
            $Pedido = $DALPedido->updatePedido($PedidoID, $Data, $Status);

            return $Pedido;
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function finalizaPedido($PedidoID , $Saldo, $ValorPago, $Troco, $Pago, $Status)
    {
        try
        {
            $pdo = Conexao::get()->connect();
            //
            $DALPedido = new DALPedido($pdo);
            //Atualiza o pedido
            $Pedido = $DALPedido->finalizaPedido($PedidoID , $Saldo, $ValorPago, $Troco, $Pago, $Status);

            return $Pedido;
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}


<?php
    
    namespace Marketaco;

    require 'vendor/autoload.php';
    use Marketaco\Conexao as Conexao;
    use Marketaco\DALLancamentoCaixa as DALLancamentoCaixa;

class BLLLancamentoCaixa
{
    public function addPagamento($Data, $Descricao, $Entrada, $Saida, $Observacao, $Excluir, $CaixaID, $FormaPagamentoID, $PedidoID)
    {
        try
        {
            $pdo = Conexao::get()->connect();
            //
            $DALLancamentoCaixa = new DALLancamentoCaixa($pdo);
            //Pega os pagamentos pelo PedidoID e gera o arquivo json
            $lancamento = $DALLancamentoCaixa->addPagamento($Data, $Descricao, $Entrada, $Saida, $Observacao, $Excluir, $CaixaID, $FormaPagamentoID, $PedidoID);
            //Retorna a ID do pagamento lancado
            return $lancamento;
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function somaEntrada($FormaPagamento, $CaixaID)
    {
        try
        {
            $pdo = Conexao::get()->connect();
            //
            $DALLancamentoCaixa = new DALLancamentoCaixa($pdo);
            //Pega a soma das entradas dos pagamentos pela forma de pagamento e caixa
            $soma = $DALLancamentoCaixa->somaEntrada($FormaPagamento, $CaixaID);
            //Retorna a soma da forma de pagamento e caixa informado
            return $soma;
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function somaSaida($FormaPagamento, $CaixaID)
    {
        try
        {
            $pdo = Conexao::get()->connect();
            //
            $DALLancamentoCaixa = new DALLancamentoCaixa($pdo);
            //Pega a soma das saidas dos pagamentos pela forma de pagamento e caixa
            $soma = $DALLancamentoCaixa->somaSaida($FormaPagamento, $CaixaID);
            //Retorna a soma da forma de pagamento e caixa informado
            return $soma;
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function listaPagamentos($PedidoID)
    {
        try
        {
            $pdo = Conexao::get()->connect();
            //
            $DALLancamentoCaixa = new DALLancamentoCaixa($pdo);
            //Pega os pagamentos pelo PedidoID e gera o arquivo json
            $Pagamentos = $DALLancamentoCaixa->listaPagamentos($PedidoID);
            //$grid = $DALLancamentoCaixa->montaGrid($Pagamentos);
        }
        catch(\PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function addPagamentoJSON($valor, $formaPagamento, $formaPagamentoID, $pedidoID, $apagar)
    {
        try
        {
            $pdo = Conexao::get()->connect();
            //
            $DALLancamentoCaixa = new DALLancamentoCaixa($pdo);
            //Adiciona pagamento no arquivo json
            $pagamento = array(
                'Valor' => $valor,
                'FormaPagamento' => $formaPagamento,
                'FormaPagamentoID' => $formaPagamentoID,
                'PedidoID' => $pedidoID,
                'Apagar' => $apagar
            );
            //adiciona
            $Add = $DALLancamentoCaixa->addPagamentoJSON($pagamento);
            
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function delPagamentoJSON($Pos)
    {
        try
        {
            $pdo = Conexao::get()->connect();
            //
            $DALLancamentoCaixa = new DALLancamentoCaixa($pdo);
            //Remove
            $Del = $DALLancamentoCaixa->delPagamentoJSON($Pos);
            
        }
        catch(\Exception $e)
        {
            echo $e->getMessage();
        }
    }

    public function montaGrid()
    {
        $pag = file_get_contents('pagamentos.json');
        $obj = json_decode($pag, false);
        $pagamentos = [];
         //foreach element in $arr
            /*echo 'Data: ' . $item->Data;
            echo '<br>Valor: ' . $item->Valor;
            echo '<br>FormaPagamento: ' . $item->FormaPagamento;
            echo '<br>FormaPagamentoID: ' . $item->FormaPagamentoID;
            echo '<br>PedidoID: ' . $item->PedidoID;
            echo '<br>Apagar: ' . $item->Apagar;
            echo '<br>';*/
        foreach ($obj as $item)
        {
            $pagamentos[] = [
                'Valor' => $item->Valor,
                'FormaPagamento' => $item->FormaPagamento,
                'FormaPagamentoID' => $item->FormaPagamentoID,
                'PedidoID' => $item->PedidoID,
                'Apagar' => $item->Apagar
            ];
        }

        return $pagamentos;
    }
}
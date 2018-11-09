<?php
session_start();

require 'vendor/autoload.php';

use Marketaco\BLLCaixa as BLLCaixa;
use Marketaco\BLLPedido as BLLPedido;
use Marketaco\BLLLancamentoCaixa as BLLLancamentoCaixa;
use Marketaco\BLLLogs as BLLLogs;

if(!isset($_SESSION['logado'])):
    header("Location: index.php");
  else:
$BLLCaixa = new BLLCaixa();
$BLLPedido = new BLLPedido();
$BLLLancamentoCaixa = new BLLLancamentoCaixa();
$BLLPedido = new BLLPedido();
$BLLLogs = new BLLLogs();

function converterDecimal($valor)
{
    $Inteiro = substr($valor, 2, -2);
    $Decimal = substr($valor, -2);
    return number_format(sprintf('%d.%u', $Inteiro, $Decimal), 2, '.', ',');
}

//Pegar os dados recebidos pelo form
date_default_timezone_set('America/Sao_Paulo');
$id = $_POST['id_pedido'];
$hoje = date('Y-m-d H:i:s');
$valorPago = $_POST['valorPago'];
$saldo = $_POST['saldo'];
$troco = $_POST['troco'];
$pgDinheiro = 0;
//Pega dados do pedido pelo id
$pedido = $BLLPedido->achaPedido($id);
//Pega o ultimo caixa
$caixa = $BLLCaixa->verificaCaixa();

foreach ($BLLLancamentoCaixa->montaGrid() as $pagamento):
    if ($pagamento['FormaPagamentoID'] == 1 and $pagamento['Apagar']):
        $pgDinheiro += converterDecimal($pagamento['Valor']);
    elseif ($pagamento['FormaPagamentoID'] > 1 and $pagamento['Apagar']):
        $BLLLancamentoCaixa->addPagamento(
        $hoje,
        'Pedido nº: ' . $id,
        number_format(converterDecimal($pagamento['Valor']), 2, ',', '.'),
        0,
        $saldo == 0 ? "Pago" : "Pg Parcial - Ped nº: " . $id,
        0,
        $caixa->CaixaID,
        $pagamento['FormaPagamentoID'],
        $id);
    endif;
endforeach;

if ($pgDinheiro > 0):
    $BLLLancamentoCaixa->addPagamento(
        $hoje,
        'Pedido nº: ' . $id,
        //
        number_format($pgDinheiro - floatval($troco), 2, ',', '.'),
        //
        0,
        $saldo == 0 ? "Pago" : "Pg Parcial - Ped nº: " . $id,
        0,
        $caixa->CaixaID,
        1,
        $id
    );
endif;

$CaixaID = $caixa->CaixaID;
$e_dinhei = converterDecimal($BLLLancamentoCaixa->somaEntrada(1, $CaixaID) ?? 0);
$c_debito = converterDecimal($BLLLancamentoCaixa->somaEntrada(2, $CaixaID) ?? 0);
$c_credit = converterDecimal($BLLLancamentoCaixa->somaEntrada(3, $CaixaID) ?? 0);
$e_cheque = converterDecimal($BLLLancamentoCaixa->somaEntrada(4, $CaixaID) ?? 0);

$s_dinhei = converterDecimal($BLLLancamentoCaixa->somaSaida(1, $CaixaID) ?? 0);
$s_cheque = converterDecimal($BLLLancamentoCaixa->somaSaida(4, $CaixaID) ?? 0);

$saldo_dinhe = (converterDecimal($caixa->SaldoInicial) + $e_dinhei) - $s_dinhei;
$saldo_final = ($saldo_dinhe + $c_debito + $c_credit + $e_cheque) - $s_cheque;
echo '<br><br>CaixaID: ' . $CaixaID;
echo '<br>E_Dinheiro: ' . $e_dinhei;
echo '<br>C_Debito: ' . $c_debito;
echo '<br>C_Credito: ' . $c_credit;
echo '<br>E_Cheque: ' . $e_cheque;
echo '<br>S_Dinheiro: ' . $s_dinhei;
echo '<br>S_Cheque: ' . $s_cheque;
echo '<br>Saldo_Dinheiro: ' . $saldo_dinhe;
echo '<br>Saldo_Final: ' . $saldo_final;

$BLLCaixa->atualizaCaixa($CaixaID,
number_format($e_dinhei, 2, ',', '.'),
number_format($c_debito, 2, ',', '.'),
number_format($c_credit, 2, ',', '.'),
number_format($e_cheque, 2, ',', '.'),
number_format($s_dinhei, 2, ',', '.'),
number_format($s_cheque, 2, ',', '.'),
number_format($saldo_dinhe, 2, ',', '.'),
number_format($saldo_final, 2, ',', '.'));

echo '<br><br>Ped ID: ' . $id;
echo '<br>Saldo: ' . $saldo;
echo '<br>Valor pago: ' . $valorPago;
echo '<br>Troco: ' . $troco;
$BLLPedido->finalizaPedido($id , $saldo, number_format($valorPago, 2, ',', '.') , number_format($troco, 2, ',', '.'), $saldo == 0 ? true : 0, 4);
$BLLLogs->addLog($hoje, $_SESSION['operador'], "Finalizou o pedido nº" . $id);
header('Location: listaentrega.php');
endif;
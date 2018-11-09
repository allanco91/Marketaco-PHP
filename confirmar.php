<?php
session_start();

require 'vendor/autoload.php';

use Marketaco\BLLCaixa as BLLCaixa;
use Marketaco\BLLPedido as BLLPedido;
use Marketaco\BLLLancamentoCaixa as BLLLancamentoCaixa;

if(!isset($_SESSION['logado'])):
  header("Location: index.php");
else:
$BLLCaixa = new BLLCaixa();
$BLLPedido = new BLLPedido();
$BLLLancamentoCaixa = new BLLLancamentoCaixa();

function converterDecimal($valor)
{
    $Inteiro = substr($valor, 2, -2);
    $Decimal = substr($valor, -2);
    return number_format(sprintf('%d.%u', $Inteiro, $Decimal), 2, '.', ',');
}

//Pegar os pagamentos
$id = $_POST['id_pedido'];
$lanc = $_POST['lanc'];

//Pega dados do pedido pelo id
$pedido = $BLLPedido->achaPedido($id);
//se $lanc == 1 pega os pagamentos já lançados no caixa
if ($lanc == 1)
{    
    $BLLLancamentoCaixa->listaPagamentos($id);
    $lanc = 0;
}

//Apertar botão adicionar pagamento
if(isset($_POST['adicionar']))
{
    date_default_timezone_set('America/Sao_Paulo');
    $id = $_POST['id_pedido'];
    $hoje = date('d-m-Y H:i:s');
    $vlr = str_replace(",",".", $_POST['valor']);
    $valor = 'R$' . number_format($vlr, 2, ',', '.');
    $formaid = $_POST['forma'];
    $saldoa = $_POST['saldoa'];

    switch ($formaid) {
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
    //$valor, $formaPagamento, $formaPagamentoID, $pedidoID, $apagar)
    if ($saldoa >= $vlr and $formaid > 1):
      $BLLLancamentoCaixa->addPagamentoJSON($valor, $forma, $formaid, $id, true);
    elseif ($formaid == 1):
      $BLLLancamentoCaixa->addPagamentoJSON($valor, $forma, $formaid, $id, true);
    else:
      include('alerta.php');
    endif;
}
//Apertar botão deletar pagamento
if(isset($_POST['deletar']))
{
      $apagarid = $_POST['apagar'];
      //apaga o pagamento no json
      $BLLLancamentoCaixa->delPagamentoJSON($apagarid);
}

//teste
$pagid = 0;
$valorPago = 0;
$pgDinheiro = 0;
$saldo = 0;
$troco = 0;

foreach ($BLLLancamentoCaixa->montaGrid() as $pagamento):
  $valorPago += converterDecimal($pagamento['Valor']);
  $pgDinheiro += intval($pagamento['FormaPagamentoID']) == 1 ? converterDecimal($pagamento['Valor']) : 0;
endforeach;

$saldo = (converterDecimal($pedido->ValorFinal) - $valorPago) > 0 ? converterDecimal($pedido->ValorFinal) - $valorPago : 0;
$troco = ($pgDinheiro - converterDecimal($pedido->ValorFinal)) < 0 ? 0 : $pgDinheiro - converterDecimal($pedido->ValorFinal);
?>

<!DOCTYPE html>
<html>
<title>Controle de Entregas</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="css/estilo.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://use.fontawesome.com/a739b1b443.js"></script>

<body>


<!-- Sidebar -->
<?php 
include ('menu_lateral.php');
?>
<!-- Page Content -->
<div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="overlay_menu"></div>
<div>
	<nav class="navbar-desiree">
  		<button class="w3-button w3-firebrick w3-xxlarge" onclick="w3_open()">&#9776;</button>
  		Confirmar Pagamento<a href="listaentrega.php" class="w3-button w3-firebrick w3-xxlarge" style="float: right;"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
  	</nav>
  <div class="w3-container conteudo_confirmar">
    <table class="table table-bordered">
      <br>
      <thead>
        <tr>
          <th style="font-size: 20px;">Valor Pago: <?php echo number_format($valorPago, 2, ',', '.');?></th>
          <th style="font-size: 20px;">Falta: <?php echo number_format($saldo, 2, ',', '.');?></th>
          <?php 
          if ($troco > 0)
          {
            echo '<th style="font-size: 20px;">Troco: ' . number_format($troco, 2, ',', '.');'</th>';
          }
          ?>
        </tr>
      </thead>
    </table>
  	<label for="id">N° do Pedido:</label>
  	<input type="text" name="id" class="form-desiree" value="<?php echo $id ?>" disabled></input>
  	<label for="valor_total">Valor Total:</label>
  	<input type="text" name="valor_total" class="form-desiree" value="<?php echo $pedido->ValorFinal ?>" disabled></input>

  	<div class="informar-pagamentos">
    <?php if ($saldo > 0){ ?>
  		<form action="#" method="post">
  		<label for="valor">Valor do pagamento:</label>
  		<input type="tel" id="valor" name="valor" class="form-control" autocomplete="off" required>

  		<label for="forma">Forma do pagamento:</label>
  		<select name="forma" class="form-control" required>
		  <option value="">Selecione uma opção</option>
		  <option value="1">Dinheiro</option>
		  <option value="3">Crédito</option>
		  <option value="2">Débito</option>
		</select><br>
    <input type='hidden' name='id_pedido' value='<?php echo $id ?>'>
    <input type='hidden' name='lanc' value='0'>
    <input type='hidden' name='saldoa' value='<?php echo $saldo ?>'>
		<button class="btn btn-success form-control" name="adicionar"><i class="fa fa-plus"></i> <strong>Adicionar pagamento</strong></button>
		</form>
<?php } ?>
  	</div>
  	<label>Pagamentos:</label>
  	 	<table class="table table-bordered">
	    <thead>    	
	      <tr>
	        <th>Forma do Pagamento</th>
	        <th>Valor</th>
	        <th>Deletar</th>   
	      </tr>
	    </thead>
	    <tbody>
      <?php
      foreach ($BLLLancamentoCaixa->montaGrid() as $pagamento):
      ?>
      <form action='#' method='POST'>
      <tr>
		        <td><?php echo htmlspecialchars($pagamento['FormaPagamento']) ?></td>
		        <td><strong><?php echo htmlspecialchars($pagamento['Valor']) ?></strong></td>
		        <td>
            <input type='hidden' name='id_pedido' value='<?php echo htmlspecialchars($pagamento['PedidoID']) ?>'>
            <input type='hidden' name='lanc' value='0'>
            <input type='hidden' name='apagar' value='<?php echo $pagid; ?>'>
            <?php
              if ($pagamento['Apagar'])
              {
                echo "<input type='submit' value='' class='deletar' name='deletar'></input>";
              }
              $pagid++;
            ?>
            </td>
      </tr>
      </form>
      <?php endforeach; ?>
	    </tbody>
		</table>
    </form>
    <form action='finalizar.php' method='POST'>
    <?php

      echo "<input type='hidden' name='id_pedido' value='$id'>";
      echo "<input type='hidden' name='valorPago' value='$valorPago'>";
      echo "<input type='hidden' name='saldo' value='$saldo'>";
      echo "<input type='hidden' name='troco' value='$troco'>";
    if ($saldo == 0) {
      echo '<button class="btn btn-success form-control" name="confirmar"><i class="fa fa-check-circle"></i> <strong>Confirmar</strong></button>';
    }
    else{
      echo '<button class="btn btn-danger form-control" name="confirmar"><i class="fa fa-exclamation-triangle"></i> <strong>Concluir com pagamentos pendentes.</strong></button>';
    }
    ?>
    </form>
  </div>
</div>

<script>
function w3_open() {
    document.getElementById("menu_lateral").style.display = "block";
    document.getElementById("overlay_menu").style.display = "block";
}
function w3_close() {
    document.getElementById("menu_lateral").style.display = "none";
    document.getElementById("overlay_menu").style.display = "none";
}
</script>
<script>
function on() {
    document.getElementById("overlay").style.display = "block";
}

function off() {
    document.getElementById("overlay").style.display = "none";
}
</script>
        
</body>
</html>
<?php endif; ?>

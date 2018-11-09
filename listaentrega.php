<?php
session_start();

require 'vendor/autoload.php';

use Marketaco\BLLPedido as BLLPedido;

if(!isset($_SESSION['logado'])):
  header("Location: index.php");
else:
$BLLPedido = new BLLPedido();

$pedidos = $BLLPedido->listaPedidos(3);

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
  		Concluir entregas<a href="" class="w3-button w3-firebrick w3-xxlarge" style="float: right;"><i class="fa fa-refresh" aria-hidden="true"></i></a>
  	</nav>
  <div class="w3-container conteudo">
<table class="table table-bordered">
<thead>    	
      <tr>
        <th>N° Pedido</th>
        <th>Valor Total</th>
        <th>Confirmar</th>      
      </tr>
    </thead>
    <tbody>
<?php foreach  ($pedidos as $pedido): ?>
<form action='confirmar.php' method='POST'>
        <tr>
		        <td><?php echo htmlspecialchars($pedido['PedidoID']) ?></td>
		        <td><?php echo htmlspecialchars($pedido['ValorFinal']) ?></td>
		        <td>
		            <input type='hidden' name='id_pedido' value='<?php echo htmlspecialchars($pedido['PedidoID']) ?>'>
                <input type='hidden' name='lanc' value='1'>
		            <input type='submit' value='' class='confirmar' name='confirmar'>
		            </input>                  
                </td>
		      </tr>
          </form>
<?php endforeach; ?>
</tbody>
</table>
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
        
</body>
</html>
<?php endif; ?>
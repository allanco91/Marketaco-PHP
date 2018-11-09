<?php
require 'vendor/autoload.php';

use Marketaco\BLLOperador as BLLOperador;

if(isset($_GET['logout'])):
  if($_GET['logout'] == 'confirmar'):
    BLLOperador::deslogar();
  endif;
endif; 

?>
<div class="w3-sidebar w3-bar-block w3-animate-left navbar-desiree" style="display:none;z-index:5" id="menu_lateral">
  <div class="line"><img src="img/desiree.png" width="100%"></div>
  <div class="line">Olá, <strong><?php echo $_SESSION['operador']; ?></strong></div>
  
  <a href="listapedido.php" class="w3-bar-item w3-button">Pedidos em Produção</a>
  <a href="listaentrega.php" class="w3-bar-item w3-button">Concluir Entregas</a>
  <a href="?logout=confirmar" class="w3-bar-item w3-button">Sair</a>
  <!--<button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Fechar &times;</button>-->
</div>
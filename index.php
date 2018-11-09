<?php
session_start();

require 'vendor/autoload.php';

use Marketaco\BLLOperador as BLLOperador;

if (isset($_POST['logar'])):

  $login = strtoupper(filter_input(INPUT_POST, "login", FILTER_SANITIZE_MAGIC_QUOTES));
  $senha = strtoupper(filter_input(INPUT_POST, "senha", FILTER_SANITIZE_MAGIC_QUOTES));

  $l = new BLLOperador();

  if($l->Logar($login, $senha)):
    echo '<br><center><strong>Logado com sucesso.</strong></center>';
  else:
    $erro = '<div class="text-center" style="color: white; font-weight: bold;"><i class="fa fa-times-circle fa-2x" aria-hidden="true"></i> <br>Login/Senha inválidos</div>';
  endif;
endif;

if(isset($_SESSION['logado'])):
  header("Location: listapedido.php");
else:
?>
<!DOCTYPE html>
<html>
<head>
  <title>Controle de Entregas - Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" type="text/css" href="css/estilo.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://use.fontawesome.com/a739b1b443.js"></script>
  <link rel="icon" href="favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
</head>
<body id="index">
  <div class="w3-container">
    <div class="logotipo">
      <img src="img/desiree.png">
    </div>
    <form class="logar" action="#" method="post">
    <div class="form-group">
    <label for="usuario"></label>
      <input class="form-control" type="text" name="login" placeholder="Login" autocomplete="off" autofocus required>

      <label for="usuario"></label>
      <input class="form-control" type="password" name="senha" placeholder="Senha" autocomplete="off" required>   
    </div>
    <div class="form-group">
      <button class="btn" name="logar">Entrar</button>
    </div>
    </form>
    <?php echo isset($erro) ? $erro : ''; ?>
  </div>
</body>
</html>
<?php endif; ?>
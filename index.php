<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8">
	<title>SEDGE</title>
	<link rel="stylesheet" type="text/css" href="css/cadastro.css">
	
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>
<body>
    <?php
        unset($_SESSION['nome_user'],
              $_SESSION['id_user'], 
              $_SESSION['email_user'], 
              $_SESSION['senha_user'], 
              $_SESSION['tipo_user']);
    ?>
<div class="wrapper" style="background-color: ">
    <!-- Page Content  -->
    <div id="content">
      <h1 style="text-align: center;">LOGIN</h1>
      <br>
      <br>
      <form class="form" action="logar.php" method="POST">
        <div class="row">
            <div class="col-lg-10">
                <label>Email</label>
                <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <label>Senha</label>
                <div class="form-group">
                    <input type="password" name="senha" id="inputPassword" class="form-control"required>
                </div>
            </div>
        </div>   
        <div class="row">
            <div class="col-lg-10">
                <button class="btn btn-lg btn-block" type="submit"><font style="color: #FFFFFF;">ENTRAR</font></button>
            </div>
        </div>
        <br>
        <p class="text-center text-danger">
            <?php 
                if (isset($_SESSION['loginerro'])) {
                    echo $_SESSION['loginerro'];
                    unset($_SESSION['loginerro']);
                }
            ?>
        </p>
        <br>
        <div class="row">
            <div class="col-lg-5" style="text-align: center;">
                Esqueceu sua senha? <a href="recuperar_senha.php">Clique aqui</a>
            </div>
            <div class="col-lg-5"style="text-align: center;">
                Não tenho cadastro? <a href="cadastro_de_usuarios.php">Clique aqui</a>
            </div>
        </div>
        </form>
        <br>
        <?php 
            include_once 'includes/footer.php';
        ?> 
    </div>  
  </div>   
</body>
</body>
</html>
<?php 
session_start();
ob_start();
$bntRecuperar = filter_input(INPUT_POST, 'recuperar', FILTER_SANITIZE_STRING);

if($bntRecuperar){
    include_once 'conexao.php';
    $cpf_inserido = $_POST['cpf_recuperar'];
    $email_inserido = $_POST['email_recuperar'];

    $procurar_usuario = "SELECT id_usuario FROM usuarios WHERE cpf_usuario = '$cpf_inserido' AND
    email_usuario = '$email_inserido'";
    $resultado = mysqli_query($conexao, $procurar_usuario);
    if(empty($result = mysqli_fetch_assoc($resultado))){
        $_SESSION['erroNovaSenha'] = "<div class='alert alert-danger text-center' role='alert'>Os dados informados não estão cadastrados no sistema</div>";
    }else{
        $id_user = $result['id_usuario'];
        header("Location: nova_senha.php?id=$id_user");   
    }
}
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
<div class="wrapper" style="background-color: ">
    <!-- Page Content  -->
    <div id="content">
      <h1 style="text-align: center;">RECUPERAR SENHA</h1>
      <br>
      <br>
      <form class="form" action="" method="POST">
        <div class="row">
            <div class="col-lg-10">
                <label>Email</label>
                <div class="form-group">
                    <input type="email" name="email_recuperar" id="email_recuperar" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <label>CPF</label>
                <div class="form-group">
                    <input type="number" name="cpf_recuperar" id="cpf_recuperar" class="form-control"required>
                </div>
            </div>
        </div>   
        <div class="row">
            <div class="col-lg-10">
                <input type="submit" name="recuperar" value="ENVIAR" class="btn btn-lg btn-block" style="color: #FFFFFF;">
            </div>
        </div>
        <br>
        <p>
            <?php 
                if (isset($_SESSION['erroNovaSenha'])) {
                    echo $_SESSION['erroNovaSenha'];
                    unset($_SESSION['erroNovaSenha']);
                }
            ?>

        </p>
        </form>
        <br>
        <?php 
            include_once 'includes/footer.php';
        ?> 
    </div>  
  </div>   
</body>
</html>
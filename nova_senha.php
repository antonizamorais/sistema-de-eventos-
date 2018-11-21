<?php 
session_start();
ob_start();
$cod_usuario = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$bntNovaSenha = filter_input(INPUT_POST, 'novasenha', FILTER_SANITIZE_STRING);

if($bntNovaSenha){
    include_once 'conexao.php';
    $novaSenha = $_POST['nova_senha'];
    $confirmaNovaSenha = $_POST['confirmar_nova_senha'];

    if((strlen($novaSenha)) > 10){
        $_SESSION['ErroNovaSenha'] = "<div class='alert alert-danger text-center' role='alert'>A senha deve ter no máximo 10 caracteres</div>";
    }elseif((strlen($novaSenha)) < 6){
        $_SESSION['ErroNovaSenha'] = "<div class='alert alert-danger text-center' role='alert'>A senha deve ter no mínimo 6 caracteres</div>";
    }elseif ($novaSenha != $confirmaNovaSenha) {
        $_SESSION['ErroNovaSenha'] = "<div class='alert alert-danger text-center' role='alert'>As senhas devem ser iguais</div>";
    }else{
        $atualizarSenha = "UPDATE usuarios SET senha_usuario = '$novaSenha', confirmar_senha_usuario = '$confirmaNovaSenha' WHERE id_usuario ='$cod_usuario'";
        $cadastraNovaSenha = mysqli_query($conexao, $atualizarSenha);
        if($cadastraNovaSenha){
            echo "<script>alert('Nova Senha Cadastrada com Sucesso !');window.location.href='login.php'</script>";     
        }else{
            echo "<script>alert('Erro ao Cadastrar Nova Senha !');window.location.href='rescuperar_senha.php'</script>";            
        }
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
      <h1 style="text-align: center;">NOVA SENHA</h1>
      <br>
      <br>
      <form class="form" action="" method="POST">
        <div class="row">
            <div class="col-lg-10">
                <label>Nova Senha</label>
                <div class="form-group">
                    <input type="number" name="nova_senha" id="nova_senha" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-10">
                <label>Repetir Nova Senha</label>
                <div class="form-group">
                    <input type="number" name="confirmar_nova_senha" id="confirmar_nova_senha" class="form-control" required>
                </div>
            </div>
        </div>   
        <div class="row">
            <div class="col-lg-10">
                <input type="submit" name="novasenha" value="SALVAR" class="btn btn-lg btn-block" style="color: #FFFFFF;">
            </div>
        </div>
        <br>
        <p>
            <?php 
                if (isset($_SESSION['ErroNovaSenha'])) {
                    echo $_SESSION['ErroNovaSenha'];
                    unset($_SESSION['ErroNovaSenha']);
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
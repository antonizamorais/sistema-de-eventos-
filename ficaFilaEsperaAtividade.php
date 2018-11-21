<?php
session_start();
$cod_evento = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT);
$idUsuario = $_SESSION['id_user'];
ob_start();
$btnSim = filter_input(INPUT_POST, 'btnSim', FILTER_SANITIZE_STRING);
$btnNao = filter_input(INPUT_POST, 'btnNao', FILTER_SANITIZE_STRING);
if($btnSim){  
  include_once("conexao.php");
  $cadastrar_inscricao = "INSERT INTO inscricaoatividade(codAtividade, situacao, codUsuario) VALUES (' $cod_evento', 'Fila de espera', '$idUsuario')";
  $resultado_cadastrar = mysqli_query($conexao, $cadastrar_inscricao);

  if ($resultado_cadastrar) {
    echo "<script>alert('Usuário inscrito na atividade com sucesso!');window.location.href='page_user.php'</script>";
  }else{
    echo "erro";
    echo $cadastrar_inscricao;
  }
}
if($btnNao){  
  header("Location: page_user.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SEDGE</title>
  <link rel="stylesheet" type="text/css" href="css/cria_eventos.css">
  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script>
</head>
<body>
<div class="wrapper">
  <?php
    include_once("includes/sidebar.php");
  ?>
  <!-- Page Content  -->
  <div id="content">
    <?php
      include_once("includes/navbar.php");
    ?>
    <br>
    <form method="POST">
      <p style="text-align: center;">
        Infelismente a atividade em que você tentou se increver já atingiu o limite máximo de participantes. Porém você pode aguarda por uma vaga, caso algum usuário inscrito desista participar da atividade.

        Deseja ficar na lista de espera?
      </p>
      <div class="row">
        <div class="col-lg-5">
            <input type="submit" name="btnSim" value="SIM" class="btn btn-lg btn-block" style="color: #FFFFFF;"><br><br>
        </div>
        <div class="col-lg-5">
            <input type="submit"  name="btnNao" value="NÃO"class="btn btn-lg btn-block" style="color: #FFFFFF;"><br><br>
        </div>
      </div>
    </form>
    <?php 
      include_once 'includes/footer.php';
    ?> 
  </div>
<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
    });
  });
</script>
</body>
</html>
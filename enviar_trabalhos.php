<?php
  session_start();
  include_once("conexao.php");
  include_once("seguranca.php");
  $id_participante = $_SESSION['id_user'];
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
    <h1 style="text-align: center;">Enviar Novo Trabalho</h1>
    <br>
      <form class="form" action="enviar_trabalho_banco.php" method="POST" enctype="multipart/form-data">
        <div class="row">
          <div class="col-lg-10">
            <label>Titulo:</label>
            <div class="form-group">
              <input type="text" name="titulo_trabalho" id="titulo_trabalho" class="form-control"required="">
            </div>
          </div> 
        </div>
        <div class="row">
          <div class="col-lg-10">
            <label>Resumo:</label>
            <div class="form-group">
              <textarea name="resumo_trabalho" rows="8" cols="85" required="">
              </textarea>
            </div>
          </div> 
        </div>
        <div class="row">
          <div class="col-lg-10">
            <label>Arquivo:</label>
            <div class="form-group">
              <input type="file" name="arquivo" required>
            </div>
          </div> 
        </div>
        <br>
        <p class="text-center">Selecione o evento para qual quer enviar seu trabalho.</p>
        <div class="row">
          <div class="col-lg-5">
            <div class="form-group">
              <label>Evento:</label>
              <select class="form-control" name="evento">
                <option>selecione</option>
                <?php 
                  $result_eventos= "SELECT * FROM evento, inscricao_evento WHERE cod_usuario = $id_participante AND cod_evento = id_evento";
                  $resultado = mysqli_query($conexao, $result_eventos);
                  if (empty($resultado)) {
                    echo "Você não está inscrito em nenhum evento";
                  }else{
                    while ($rows_even = mysqli_fetch_array($resultado)) { 
                      $id_evento = $rows_even['id_evento'];
                      $_SESSION['id_do_evento'] = $id_evento;
                      $nome_evento = $rows_even['nome_evento'];
                      echo "<option id='$id_evento' value = '$id_evento'>
                      $nome_evento</option>";
                    }
                  }
                ?>
              </select>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-10">
            <button class="btn btn-lg btn-block" type="submit"><font style="color: #FFFFFF ">ENVIAR</font></button>
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
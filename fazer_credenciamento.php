<?php
  session_start();
  include_once("conexao.php");
  include_once("seguranca.php");

  $cod_e = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $_SESSION['idEvento'] = $cod_e;
  $usuario = $_SESSION['id_user'];
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
    <?php
      $buscar_participantes= "SELECT * FROM usuarios_cadastrados, inscricao_evento WHERE cod_evento = $cod_e AND cod_usuario = id";
      $resultado = mysqli_query($conexao, $buscar_participantes);

    ?>
    <h1 style="text-align: center;">Lista de Participantes</h1>
    <br>
    <form class="form" action="salvar_credenciamentos.php" 
    method="POST">
      <table class="table table-bordered">
      <thead class="thead-dark">
        <th>Nome</th>
        <th></th>
      </thead>
      <tbody>
        <?php 
          while($rows_participantes= mysqli_fetch_array($resultado)){
            $num_inscricao_evento = $rows_participantes['num_inscricao'];
            $_SESSION['numIncricaoEvento'] = $num_inscricao_evento;
            $id_participante = $rows_participantes['id'];
            $_SESSION['id_participante'] = $id_participante;
            $nome_participante = $rows_participantes['nome'];
            echo "<tr>";
            echo "<td>".$nome_participante."</td>";
            echo "<td><label class='checkbox-inline'><input type='checkbox' value='true' name='presente'> PRESENTE</label>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
    <div class="col-lg-5">
        <button class="btn btn-lg btn-block" type="submit">SALVAR</button>
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
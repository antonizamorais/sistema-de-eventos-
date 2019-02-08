<?php
  session_start();
  include_once("conexao.php");
  include_once("seguranca.php");
  $id_usuario = $_SESSION['id_user'];
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
    //buscar eventos em que o usuário logado esta inscrito
      $buscar_eventos = "SELECT DISTINCT * FROM eventos, trabalhos WHERE cod_evento = id_evento AND cod_usuario = $id_usuario";
      $resultado = mysqli_query($conexao, $buscar_eventos);

    ?>
    <h1 style="text-align: center;">Meus Trabalhos</h1>
    <br>
    <table class="table table-hover" style="text-align: center;">
      <thead class="thead-dark">
        <th scope="col">Evento</th>
        <th scope="col">Número</th>
        <th scope="col">Título</th>
        <th scope="col">Data</th>
        <th scope="col">Situação</th>
      </thead>
      <tbody>
        <?php 
          while($rows = mysqli_fetch_array($resultado)){
            $numero = $rows['numero'];
            $nomeEvento = $rows['nome_evento'];
            $titulo = $rows['titulo'];
            $data = $rows['data'];
            $situacao = $rows['situacao'];
            echo "<tr>";
            echo "<td>".$nomeEvento."</td>";
            echo "<td>".$numero."</td>";
            echo "<td>".$titulo."</td>";
            echo "<td>".date('d/m/Y', strtotime($data))."</td>";
            echo "<td>".$situacao."</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
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
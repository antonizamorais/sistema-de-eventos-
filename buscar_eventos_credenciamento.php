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
    //buscar eventos em que o usuário logado seja o coordenador do evento
      $buscar_eventos = "SELECT DISTINCT * FROM eventos WHERE cod_coordenador = $id_usuario";
      $resultado = mysqli_query($conexao, $buscar_eventos);

    ?>
    <h1 style="text-align: center;">Eventos</h1>
    <br>
    <table class="table table-bordered">
      <thead class="thead-dark">
        <th scope="col">Nome</th>
        <th scope="col">Data de inicio</th>
        <th scope="col">Data de termino</th>
        <th scope="col">Local</th>
        <th><em class="fa fa-cog"></em></th>
      </thead>
      <tbody>
        <?php 
          while($rows_evento = mysqli_fetch_array($resultado)){
            $id_e = $rows_evento['id_evento'];
            $_SESSION['id_ev'] = $id_e;
            $nome_e = $rows_evento['nome_evento'];
            $data_1e = $rows_evento['data_inicio'];
            $data_2e= $rows_evento['data_fim'];
            $local_e = $rows_evento['local'];
            echo "<tr>";
            echo "<td>".$nome_e."</td>";
            echo "<td>".$data_1e."</td>";
            echo "<td>".$data_2e."</td>";
            echo "<td>".$local_e."</td>";
            echo "<td><a class ='btn' href ='fazer_credenciamento.php?id=$id_e'>FAZER CREDENCIAMENTO</a></td>";
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
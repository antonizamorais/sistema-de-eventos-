<?php
  session_start();
  include_once("conexao.php");
  include_once("seguranca.php");
  $id_usuario = $_SESSION['id_user'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
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
      $buscar_eventos = "SELECT DISTINCT * FROM eventos, inscricaoevento, atividades WHERE cod_evento = id_evento AND cod_usuario = $id_usuario AND codEvento = id_evento";
      $resultado = mysqli_query($conexao, $buscar_eventos);

    ?>
    <h1 style="text-align: center;">BEM VINDO AO SISTEMA DE GERENCIAMENTO DE EVENTOS DO IFCE - TAUÁ</h1>
    <br>
    <div class="container">
      <div class="row">
        <div class="col">
          Calendário de Eventos e Atividades
          <table class="table table-hover" style="text-align: center;">
            <thead class="thead-dark">
              <th scope="col">Data</th>
              <th scope="col">Horário</th>
              <th scope="col">Evento</th>
              <th scope="col">Local</th>
              <th scope="col">Atividades</th>
            </thead>
            <tbody>
            <?php 
              while($rows_evento = mysqli_fetch_array($resultado)){
                $idEvento = $rows_evento['id_evento'];
                $nomeEvento = $rows_evento['nome_evento'];
                $dataInicio = $rows_evento['dataInicio_evento'];
                $dataFim= $rows_evento['dataFinal_evento'];
                $horaInicio = $rows_evento['horaInicio_evento'];
                $horaFim= $rows_evento['horaFinal_evento'];
                $local = $rows_evento['local_evento'];
                $atividades = $rows_evento['nome_atividade'];
                echo "<tr>";
                echo "<td>".date('d/m/Y', strtotime($dataInicio))." á ".date('d/m/Y', strtotime($dataFim))."</td>";
                echo "<td>".$horaInicio."h ás ".$horaFim."h"."</td>";
                echo "<td>".$nomeEvento."</td>";
                echo "<td>".$local."</td>";
                echo "<td>".$atividades."</td>";
                echo "</tr>";
              }
            ?>
            </tbody>
          </table>
        </div>
      </div>
      <br>
      <h4>O que deseja fazer hoje ?</h4>
      <br>
      <div class="row">
        <div class="col">
          <a href="inscricao_evento.php">Inscreve-se em eventos</a>
        </div>
        <div class="col">
          <a href="meus_eventos.php">Inscreve-se em atividades</a>
        </div>
        <div class="col">
          emitir certificados
        </div>
      </div>
    </div>
    
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
<?php
  session_start();
  include_once("conexao.php");
  include_once 'seguranca.php';
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
    //DATA ATUAL
     $dataAtual = date('Y-m-d'); 
    //BUSCAR TODOS OS EVENTOS E USUÁRIOS COORDENADORES
      $buscar_eventos = "SELECT * FROM eventos, usuarios WHERE id_usuario = cod_coordenador";
      $resultado = mysqli_query($conexao, $buscar_eventos);
    ?>
    <h1 style="text-align: center;">Lista de Eventos</h1>
    <br>
    <table class="table table-hover" style="text-align: center;">
      <thead class="thead-dark">
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Coordenador</th>
        <th scope="col">Período de inscrição</th>
        <th scope="col">Duração</th>
        <th scope="col">Limite de Participantes</th>
        <th scope="col">Local</th>
        <th scope="col">Situação da Inscrição</th>
        <th scope="col">Situação do Evento</th>
      </thead>
      <tbody>
        <?php 
          while($rows_evento = mysqli_fetch_array($resultado)){
            $idEvento = $rows_evento['id_evento'];
            $nomeEvento = $rows_evento['nome_evento'];
            $coordenadorEvento = $rows_evento['nome_usuario'];
            $dataInicialEvento = $rows_evento['dataInicio_evento'];
            $dataFinalEvento = $rows_evento['dataFinal_evento'];
            $local = $rows_evento['local_evento'];
            $dataInicalInscricao = $rows_evento['inicioInscricao_evento'];
            $dataFinalInscricao = $rows_evento['fimInscricao_evento'];
            $numParticipantes = $rows_evento['numeroMax_participantes'];
            echo "<tr>";
            echo "<td>".$idEvento."</td>";
            echo "<td>".$nomeEvento."</td>";
            echo "<td>".$coordenadorEvento."</td>";
            echo "<td>".date('d/m/Y', strtotime($dataInicalInscricao))." à ".date('d/m/Y', strtotime($dataFinalInscricao))."</td>";
            echo "<td>".date('d/m/Y', strtotime($dataInicialEvento))." à ".date('d/m/Y', strtotime($dataFinalEvento))."</td>";
            echo "<td>".$numParticipantes."</td>";
            echo "<td>".$local."</td>";
            if (($dataInicalInscricao <= $dataAtual) & ($dataFinalInscricao >= $dataAtual)) {
              echo "<td><p class = 'text-success'>Abertas</p></td>";
            }elseif($dataFinalInscricao <= $dataAtual){
              echo "<td><p class = 'text-danger'>Encerradas</p></td>";
            }else{
              echo "<td><p class = 'text-warning'>Não iniciada</p></td>";
            }
            if ($dataInicialEvento <= $dataAtual && $dataFinalEvento >= $dataAtual) {
              echo "<td><p class = 'text-success'>Em Andamento</p></td>";
            }elseif($dataFinalEvento <= $dataAtual){
              echo "<td><p class = 'text-danger'>Encerrado</p></td>";
            }else{
              echo "<td><p class = 'text-warning'>Não iniciado</p></td>";
            }
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
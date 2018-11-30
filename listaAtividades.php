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
    //BUSCAR TODOS AS ATIVIDADES, USUÁRIOS FACILITADORES, EVENTOS A QUAL PERTENCEM E AMBIENTE
      $buscar_atividades = "SELECT * FROM atividades, usuarios, eventos, ambientes WHERE codFacilitador_atividade = id_usuario AND codEvento = id_evento AND codLocal_atividade = cod_ambiente";
      $resultado = mysqli_query($conexao, $buscar_atividades);
    ?>
    <h1 style="text-align: center;">Lista de Atividades</h1>
    <br>
    <table class="table table-hover" style="text-align: center;">
      <thead class="thead-dark">
        <th scope="col">ID</th>
        <th scope="col">Nome</th>
        <th scope="col">Facilitador</th>
        <th scope="col">Evento</th>
        <th scope="col">Período de inscrição</th>
        <th scope="col">Duração</th>
        <th scope="col">Limite de Participantes</th>
        <th scope="col">Local</th>
        <th scope="col">Situação da Inscrição</th>
        <th scope="col">Situação da Atividade</th>
      </thead>
      <tbody>
        <?php 
          while($rows = mysqli_fetch_array($resultado)){
            $idAtividade = $rows['id_atividade'];
            $nomeAtividade = $rows['nome_atividade'];
            $facilitadorAtividade = $rows['nome_usuario'];
            $nomeEvento = $rows['nome_evento'];
            $dataInicalInscricao = $rows['dataInicio_inscricao'];
            $dataFinalInscricao = $rows['dataFinal_inscricao'];
            $dataInicialAtividade = $rows['dataInicio_atividade'];
            $numParticipantes = $rows['numMax_participantes'];
            $dataFinalAtividade = $rows['dataFinal_atividade'];
            $local = "Sala: ".$rows['sala'].", Andar: ". $rows['andar'].", Bloco: ". $rows['bloco'];
            echo "<tr>";
            echo "<td>".$idAtividade."</td>";
            echo "<td>".$nomeAtividade."</td>";
            echo "<td>".$facilitadorAtividade."</td>";
            echo "<td>".$nomeEvento."</td>";
            echo "<td>".date('d/m/Y', strtotime($dataInicalInscricao))." à ".date('d/m/Y', strtotime($dataFinalInscricao))."</td>";
            echo "<td>".date('d/m/Y', strtotime($dataInicialAtividade))." à ".date('d/m/Y', strtotime($dataFinalAtividade))."</td>";
            echo "<td>".$numParticipantes."</td>";
            echo "<td>".$local."</td>";
            if (($dataInicalInscricao <= $dataAtual) & ($dataFinalInscricao >= $dataAtual)) {
              echo "<td><p class = 'text-success'>Abertas</p></td>";
            }elseif($dataFinalInscricao <= $dataAtual){
              echo "<td><p class = 'text-danger'>Encerradas</p></td>";
            }else{
              echo "<td><p class = 'text-warning'>Não iniciada</p></td>";
            }
            if ($dataInicialAtividade <= $dataAtual && $dataFinalAtividade >= $dataAtual) {
              echo "<td><p class = 'text-success'>Em Andamento</p></td>";
            }elseif($dataFinalAtividade <= $dataAtual){
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
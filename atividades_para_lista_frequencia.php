<?php
  session_start();
  include_once("conexao.php");
  include_once("seguranca.php");

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
    $dataAtual = date('Y-m-d'); 
    // BUSCAR ATIVIDADES EM QUE O USUÁRIO LOGADO DO TIPO FACILITADOR ESTA RESPONSÁVEL
      $buscar_atividades = "SELECT DISTINCT * FROM atividades WHERE codFacilitador_atividade = $usuario";
      $resultado = mysqli_query($conexao, $buscar_atividades);

    ?>
    <h1 style="text-align: center;">Atividades</h1>
    <br>
    <table class="table table-hover" style="text-align: center;">
      <thead class="thead-dark">
        <th scope="col">Nome</th>
        <th scope="col">Datas de duração</th>
        <th scope="col">Datas de inscrição</th>
        <th scope="col">Tipo de Atividade</th>
        <th><em class="fa fa-cog"></em></th>
      </thead>
      <tbody>
        <?php 
          while($rows_atividade= mysqli_fetch_array($resultado)){
            $idAtividade = $rows_atividade['id_atividade'];
            $nomeAtividade = $rows_atividade['nome_atividade'];
            $dataInicio = $rows_atividade['dataInicio_atividade'];
            $dataFinal= $rows_atividade['dataFinal_atividade'];
            $tipoAtividade = $rows_atividade['tipo_atividade'];
            $cod_evento = $rows_atividade['codEvento'];
            $dataInicalInscricao = $rows_atividade['dataInicio_inscricao'];
            $dataFinalInscricao = $rows_atividade['dataFinal_inscricao'];
            echo "<tr>";
            echo "<td>".$nomeAtividade."</td>";
            echo "<td>".date('d/m/Y', strtotime($dataInicio))." á ".date('d/m/Y', strtotime($dataFinal))."</td>";
            echo "<td>".date('d/m/Y', strtotime($dataInicalInscricao))." á ".date('d/m/Y', strtotime($dataFinalInscricao))."</td>";
            echo "<td>".$tipoAtividade."</td>";
             if($dataFinalInscricao <= $dataAtual){
              echo "<td><p class = 'text-danger'>Inscrições Encerradas</p></td>";
            }else{
              echo "<td><a class ='btn' href ='lista_alunos_atividade.php?id=$idAtividade&cod=$cod_evento'>FREQUÊNCIA</a></td>";
            }
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
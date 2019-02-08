<?php
  session_start();
  include_once("conexao.php");
  include_once 'seguranca.php';
  $usuario = $_SESSION['id_user'];
  $codEvento = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $_SESSION['evento'] = $codEvento;
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
    //buscar todos as inscrições no evento escolhido em que os participantes fizeram o credenciamento e situação é de inscrito
      $buscar_eventos = "SELECT * FROM inscricaoevento, usuarios WHERE cod_evento = $codEvento AND cod_usuario = id_usuario AND situacao = 'Inscrito'";
      $resultado = mysqli_query($conexao, $buscar_eventos);
    ?>
    <h1 style="text-align: center;">Gerar Certificado</h1>
    <p>Passo 1: Lista de Participantes Credenciados neste Evento</p>
    <br>
    <table class="table table-hover" style="text-align: center;">
      <thead class="thead-dark">
        <th scope="col">Numéro de inscrição</th>
        <th scope="col">Nome</th>
        <th scope="col">CPF</th>
        <th scope="col">Data de Nascimento</th>
        <th scope="col">Situação</th>
        <th><em class="fa fa-cog"></em></th>
      </thead>
      <tbody>
        <?php 
          while($rows_inscricao = mysqli_fetch_array($resultado)){
            $numeroInscricao = $rows_inscricao['id_inscricao'];
            $codParticipante = $rows_inscricao['cod_usuario'];
            $nomeParticipante = $rows_inscricao['nome_usuario'];
            $cpfParticipante = $rows_inscricao['cpf_usuario'];
            $dataNascimento = $rows_inscricao['data_nascimento_usuario'];
            $situacao = $rows_inscricao['situacao'];
            $certificado = $rows_inscricao['numeroCertificado'];
            echo "<tr>";
            echo "<td>".$numeroInscricao."</td>";
            echo "<td>".$nomeParticipante."</td>";
            echo "<td>".$cpfParticipante."</td>";
            echo "<td>".date('d/m/Y', strtotime($dataNascimento))."</td>";
            echo "<td>".$situacao."</td>";
            if (is_null($certificado)) {
              echo "<td><a href='criar_certificadosEventos_Dados.php?ni=$numeroInscricao&iu=$codParticipante&ie=$codEvento'><i class='fa fa-certificate'></i></a></td>";
            }else{
              echo "<td><p text-danger>Já tem certificado<p/></td>";
            }
            echo "</tr>";
          }
        ?>
      </tbody>
    </table> 
    <br>
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
<?php
  session_start();
  include_once("conexao.php");
  include_once("seguranca.php");
  $cod_e = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

  $usuario = $_SESSION['id_user'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
      $buscar_atividades = "SELECT * FROM inscricao_evento, atividade, usuarios_cadastrados WHERE cod3_evento = $cod_e AND cod_usuario = $usuario AND cod_evento = $cod_e AND id = cod_facilitador";
      $resultado = mysqli_query($conexao, $buscar_atividades);
    ?>
    <h1 style="text-align: center;">Atividades do Evento</h1>
    <br>
    <table class="table table-bordered">
      <thead class="thead-dark">
        <th scope="col">Nome da atividade</th>
        <th scope="col">Facilitador</th>
        <th scope="col">Data de início</th>
        <th scope="col">Data de término</th>
        <th><em class="fa fa-cog"></em></th>
      </thead>
      <tbody>
        <?php 
          while($rows_atividades = mysqli_fetch_array($resultado)){
            $id_ativ = $rows_atividades['id_atividade'];
            $_SESSION['id_ativi'] = $id_ativ;
            $nome_a = $rows_atividades['nome_atividade'];
            $facilitador_a = $rows_atividades['nome'];
            $data_1a = $rows_atividades['data_inicio'];
            $data_2a= $rows_atividades['data_final'];
            echo "<tr>";
            echo "<td>".$nome_a."</td>";
            echo "<td>".$facilitador_a."</td>";
            echo "<td>".$data_1a."</td>";
            echo "<td>".$data_2a."</td>";
            echo "<td><a class ='btn' href ='cadastrar_inscricao_atividade.php?id=$id_ativ'>INSCREVE-SE</a></td>";
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
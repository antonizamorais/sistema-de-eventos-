<?php
  session_start();
  include_once("conexao.php");
  include_once("seguranca.php");
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
    // SELECIONAR OS TRABALHOS QUANDO O USUÁRIO LOGADO FOR O RESPONSÁVEL
      $buscar_trabalhos = "SELECT * FROM trabalhos, eventos, usuarios WHERE cod_evento = id_evento AND cod_usuario = id_usuario AND cod_coordenador = $usuario";
      $resultado = mysqli_query($conexao, $buscar_trabalhos);
    ?>
    <h1 style="text-align: center;">Avaliar Trabalhos</h1>
    <br>
    <table class="table table-hover" style="text-align: center;">
      <thead class="thead-dark">
        <th scope="col">Título</th>
        <th scope="col">Evento</th>
        <th scope="col">Autor</th>
        <th scope="col">Data</th>
        <th scope="col">Situação</th>
        <th scope="col">Resposta</th>
        <th><em class="fa fa-cog"></em></th>
      </thead>
      <tbody>
        <?php 
          while($rows = mysqli_fetch_array($resultado)){
            $numeroTrabalho = $rows['numero'];
            $Evento = $rows['nome_evento'];
            $Autor = $rows['nome_usuario'];
            $Data = $rows['data'];
            $Situacao = $rows['situacao'];
            echo "<tr>";
            echo "<td>".$numeroTrabalho."</td>";
            echo "<td>".$Evento."</td>";
            echo "<td>".$Autor."</td>";
            echo "<td>".date('d/m/Y', strtotime($Data))."</td>";
            echo "<td>".$Situacao."</td>";
            if ($Situacao == 'Aguardando Resposta') {
               echo "<td>".
              "<select name='resposta' class='form-control' id='resposta' required>
                <option>Aprovado</option>
                <option>Reprovado</option>
                <option>Solicito Correção</option>
              </select>"
               ."</td>";
            }else{
              echo "<td>".
              "<select name='resposta' class='form-control' id='resposta' disabled>
                <option>Deferido</option>
                <option>Indeferido</option>
              </select>"
               ."</td>";
            }
            echo "<td><a href=''><i class='fas fa-save'></i></a> <a href=''><i class='fas fa-eye'></i></a></td>";
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
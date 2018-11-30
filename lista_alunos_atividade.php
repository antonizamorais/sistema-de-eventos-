<?php
  session_start();
  include_once("conexao.php");
  include_once("seguranca.php");

  $cod_atividade = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $cod_evento = filter_input(INPUT_GET, 'cod', FILTER_SANITIZE_NUMBER_INT);
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
      $buscar_alunos= "SELECT ia.id_inscricao, u.id_usuario, u.nome_usuario, u.data_nascimento_usuario, e.nome_evento, a.nome_atividade FROM usuarios as u, inscricaoatividade as ia, atividades as a, eventos as e WHERE ia.codUsuario = u.id_usuario and ia.codAtividade = a.id_atividade and a.codEvento = e.id_evento and ia.codAtividade =  $cod_atividade and e.id_evento =  $cod_evento order by u.nome_usuario;";
      $resultado = mysqli_query($conexao, $buscar_alunos);

    ?>
    <h1 style="text-align: center;">Lista de Alunos</h1>
    <br>
    <form class="form" action="salvar_frequencia.php" 
    method="POST">
      <table class="tabletable-hover" style="text-align: center;">
      <thead class="thead-dark">
        <th>Nome</th>
        <th>Data de Nascimento</th>
        <th>Evento</th>
        <th>Atividade</th>
        <th>Presente</th>
      </thead>
      <tbody>
        <?php 
          while($rows_atividade= mysqli_fetch_array($resultado)){
            $num_inscricao = $rows_atividade['id_inscricao'];
            $idAluno = $rows_atividade['id_usuario'];
            $nome_aluno = $rows_atividade['nome_usuario'];
            $dataNasc = $rows_atividade['data_nascimento_usuario'];
            $nome_atividade = $rows_atividade['nome_atividade'];
            $nome_evento = $rows_atividade['nome_evento'];
            echo "<tr>";
            echo "<td>".$nome_aluno."</td>";
            echo "<td>".date('d/m/Y', strtotime($dataNasc))."</td>";
            echo "<td>".$nome_atividade."</td>";
            echo "<td>".$nome_evento."</td>";
            echo "<td><label class='checkbox-inline'><input type='checkbox' value='true' name='presente'>SIM</label>";
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
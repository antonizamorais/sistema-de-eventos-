<?php
  session_start();
  include_once("conexao.php");
  include_once("seguranca.php");
  $idUsuarioLogado = $_SESSION['id_user'];
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
      // SELECIONAR OS EVENTOS EM QUE A DATA FINAL DE INSCRIÇÃO É MAIOR QUE A DATA ATUAL DE ACESSO.
      $buscar_eventos = "SELECT id_evento, nome_evento, dataInicio_evento, dataFinal_evento, local_evento, numeroMax_participantes FROM eventos WHERE fimInscricao_evento > '$dataAtual' ";
      $resultado = mysqli_query($conexao, $buscar_eventos);
    ?>
    <h1 style="text-align: center;">Eventos Disponíveis</h1>
    <br>
    <table class="table table-hover" style="text-align: center;">
      <thead class="thead-dark">
        <th scope="col">Nome</th>
        <th scope="col">Data de início</th>
        <th scope="col">Data de término</th>
        <th scope="col">Local</th>
        <th><em class="fa fa-cog"></em></th>
      </thead>
      <tbody>
        <?php 
          while($rows_evento = mysqli_fetch_array($resultado)){
            $idEvento = $rows_evento['id_evento'];
            $nomeEvento = $rows_evento['nome_evento'];
            $dataInicioEvento = $rows_evento['dataInicio_evento'];
            $dataFinalEvento= $rows_evento['dataFinal_evento'];
            $localEvento = $rows_evento['local_evento'];
            $limiteInscritos = $rows_evento['numeroMax_participantes'];
            echo "<tr>";
            echo "<td>".$nomeEvento."</td>";
            echo "<td>".date('d/m/Y', strtotime($dataInicioEvento))."</td>";
            echo "<td>".date('d/m/Y', strtotime($dataFinalEvento))."</td>";
            echo "<td>".$localEvento."</td>";
            // VERIFICAR SE O USUÁRIO LOGADO JÁ ESTÁ INSCRITOS NO EVENTO
            $buscar_inscricao = "SELECT id_inscricao FROM inscricaoevento WHERE cod_evento = $idEvento AND cod_usuario = $idUsuarioLogado";
            $resultado_inscricao = mysqli_query($conexao, $buscar_inscricao);
            $linha = mysqli_fetch_array($resultado_inscricao);
            // SE LINHAS FOR MENOR OU IGUAL A ZERO SIGINIFICA QUE ELE NÃO ESTÁ INSCRITO, PODENDO FAZER UMA INSCRIÇÃO
            if ($linha <= 0) {
               echo "<td><a class ='btn' href ='cadastrar_inscricao_evento.php?id=$idEvento&limite=$limiteInscritos'>INSCREVA-SE</a></td>";
            }else{
              echo "<td><p class = 'text-danger'>Você já está inscrito</p></td>";
            }
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
    <?php          
      // VERIFICAR SE A CONSULTA RETORNA VAZIO
       if (($num_results = mysqli_num_rows($resultado)) == 0){ 
        echo "<div class='alert alert-danger text-center' role='alert'>Não há eventos disponíveis do momento</div>";
      }
    ?>
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
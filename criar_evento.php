<?php 
  session_start();
  include_once 'conexao.php';
  $id =  $_SESSION['id_user'];
  $cont = "SELECT * FROM usuarios where id_usuario = '$id'";
  $result = mysqli_query($conexao,$cont);
  $linhas = mysqli_num_rows($result);
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
      <h1 style="text-align: center;">Criar Novo Evento</h1>
      <p>Campos com * são obrigatórios</p>
      <form class="form" action="cadastrar_evento.php" method="POST">
        <div class="row">
          <legend>Dados do Coordenador do Evento</legend>
          <div class="col-lg-10">
            <table class="table table-bordered">
              <thead>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">Email</th>
              </thead>
              <tbody>
                <?php 
                  while($linhas = mysqli_fetch_assoc($result)){
                    $nomeCoordenador = $linhas['nome_usuario'];
                    $idCoordenador = $linhas['id_usuario'];
                    $cpfCoordenador = $linhas['cpf_usuario'];
                    $emailCoordenador = $linhas['email_usuario'];
                    echo "<tr>";
                    echo "<td>".$nomeCoordenador."</td>";
                    echo "<td>".$cpfCoordenador."</td>";
                    echo "<td>".$emailCoordenador."</td>";
                    echo "</tr>";
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div> 
        <div class="row">
          <legend>Dados do evento</legend>
          <div class="col-lg-10">
            <label>* Nome do evento:</label>
            <div class="form-group">
              <input type="text" name="nome_evento" id="nome_evento" class="form-control"required="">
            </div>
          </div> 
        </div>
        <div class="row">
          <div class="col-lg-5">
            <div class="form-group">
              <span>* Data de início:</span>
              <input type="date" name="data_inicio" id="data_inicio" class="form-control"required="">
            </div>
          </div>
          <div class="col-lg-5">
            <div class="form-group">
              <span>* Data final:</span>
              <input type="date" name="data_fim" id="data_fim" class="form-control"required="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-5">
            <div class="form-group">
              <span>* Horário de ínicio:</span>
              <input type="time" name="hora_inicio_evento" id="hora_inicio_evento" class="form-control"required="">
            </div>
          </div>
          <div class="col-lg-5">
            <div class="form-group">
              <span>* Horário final:</span>
              <input type="time" name="hora_fim_evento" id="hora_fim_evento" class="form-control"required="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-10">
            <label>* Local:</label>
            <div class="form-group">
              <input type="text" name="local_evento" id="local_evento" class="form-control"required="">
            </div>
          </div> 
        </div>
        <br>
        <div class="row">
          <div class="col-lg-4">
            <label>Número máximo de participantes:</label>
            <div class="form-group">
              <input type="number" name="numParticipantes" id="numParticipantes" class="form-control">
            </div>
          </div>  
          <div class="col-lg-3">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="defaultUnchecked" name="cert_atividade" value="true">
              <label class="custom-control-label" for="defaultUnchecked">Gerar certificado</label>
            </div>
          </div> 
          <div class="col-lg-3">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="defaultUnchecked2" name="insc_ativ" value="true">
              <label class="custom-control-label" for="defaultUnchecked2">Permitir inscrições de atividade fora do período de duração deste evento</label>
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <legend>Período de inscrição</legend>
          <div class="col-lg-5">
            <div class="form-group">
              <span>* Data de início:</span>
              <input type="date" name="data_inicio_ins" id="data_inicio_ins" class="form-control"required="">
            </div>
          </div>
          <div class="col-lg-5">
            <div class="form-group">
              <span>* Data final:</span>
              <input type="date" name="data_fim_ins" id="data_fim_ins" class="form-control"required="">
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-lg-10">
            <button class="btn btn-lg btn-block" type="submit"><font style="color: #FFFFFF ">CRIAR EVENTO</font></button>
          </div>
        </div>
      </form>
      <?php 
        include_once 'includes/footer.php';
      ?> 
    </div>  
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
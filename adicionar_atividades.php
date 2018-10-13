<?php 
ini_set('default_charset','UTF-8');
  session_start();
  include_once 'conexao.php';
  include_once 'seguranca.php';
  $cod_event = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $_SESSION['cod'] = $cod_event;
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
      <h1 style="text-align: center;">Adicionar Atividades</h1>
      <p>Passo 2: Adicionar Atividades do Evento</p>
      <br>
      <form class="form" action="cadastrar_atividade.php?id=$id_amb" method="POST">
        <P style="text-align: center;">
          DADOS DA ATIVIDADE
        </P>
        <div class="row">
          <div class="col-lg-10">
            <label>Nome da Atividade:</label>
            <div class="form-group">
              <input type="text" name="nome_atividade" id="nome_atividade" class="form-control"required="">
            </div>
          </div> 
        </div>
        <div class="row">
          <div class="col-lg-10">
            <label>Nome do Facilitador:</label>
            <div class="form-group">
              <input type="text" name="nome_fac" id="nome_fac" class="form-control"required="">
            </div>
          </div> 
        </div>
        <div class="row">
          <div class="col-lg-5">
            <div class="form-group">
              <span>Data 1:</span>
              <input type="date" name="data_1" id="data_1" class="form-control"required="">
            </div>
          </div>
          <div class="col-lg-5">
            <div class="form-group">
              <span>Data 2:</span>
              <input type="date" name="data_2" id="data_2" class="form-control">
            </div>
            <p>Data 2: somente se a avidade for desenvolvida em mais de um dia</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-5">
            <div class="form-group">
              <span>Horário de inicio:</span>
              <input type="time" name="hora_inicio_atividade" id="hora_inicio_atividade" class="form-control"required="">
            </div>
          </div>
          <div class="col-lg-5">
            <div class="form-group">
              <span>Horário final:</span>
              <input type="time" name="hora_fim_atividade" id="hora_fim_atividade" class="form-control"required="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-5">
            <div class="form-group">
              <label>Tipo de Atividade</label>
              <select class="form-control" name="tipo_atividade">
                <option>Oficina</option>
                <option>Minicurso</option>
                <option>Mesa-Redonda</option>
                <option>Palestra</option>
                <option>Simpósio</option>
                <option>Painéis</option>
              </select>
            </div>
          </div> 
          <div class="col-lg-5">
            <div class="form-group">
              <label>Local da atividade:</label>
              <select class="form-control" name="local">
                <option>selecione</option>
                <?php 
                  $result_ambientes = "SELECT * FROM ambiente";
                  $resultado_amb = mysqli_query($conexao, $result_ambientes);
                  while ($rows_amb = mysqli_fetch_array($resultado_amb)) { 
                    $id_amb = $rows_amb['id_ambiente'];
                    $sala = $rows_amb['sala'];
                    $andar = $rows_amb['andar'];
                    $bloco = $rows_amb['bloco'];
                    echo "<option id='$id_amb' value = '$id_amb'>Sala: $sala, Andar: $andar, Bloco: $bloco</option>";
                  }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-10">
            <label>Número máximo de participantes:</label>
            <div class="form-group">
              <input type="number" name="max_participantes" id="max_participantes" class="form-control"required="">
            </div>
          </div> 
        </div>
        <div class="row">
          <div class="col-lg-5">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="defaultUnchecked" name="cert_atividade" value="true">
              <label class="custom-control-label" for="defaultUnchecked">Gerar certificado</label>
            </div>
          </div>  
        </div>
        <br>
        <br>
        <div class="row">
          <div class="col-lg-10">
            <button class="btn btn-lg btn-block" type="submit"><font style="color: #FFFFFF ">ADICIONAR ATIVIDADE</font></button>
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
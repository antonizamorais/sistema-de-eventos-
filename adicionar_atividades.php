<?php 
  session_start();
  include_once 'conexao.php';
  include_once 'seguranca.php';
  $cod_evento = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  $_SESSION['evento'] = $cod_evento;
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
      <p>Compos com * são obrigatórios</p>
      <br>
      <form class="form" action="cadastrar_atividade.php" method="POST">
        <legend style="text-align: center;">
          DADOS DA ATIVIDADE
        </legend>
        <div class="row">
          <div class="col-lg-10">
            <label>* Nome da atividade:</label>
            <div class="form-group">
              <input type="text" name="nome_atividade" id="nome_atividade" class="form-control"required="">
            </div>
          </div> 
        </div>
        <div class="row">
          <div class="col-lg-10">
            <div class="form-group">
              <label>* Facilitador:</label>
              <select class="form-control" name="facilitador">
                <option>selecione</option>
                <?php 
                  $buscarFacilitadores = "SELECT * FROM usuarios WHERE tipo_usuario = 'Facilitador'";
                  $resultado = mysqli_query($conexao, $buscarFacilitadores);
                  while ($rows_amb = mysqli_fetch_array($resultado)) { 
                    $idFacilitador = $rows_amb['id_usuario'];
                    $_SESSION['facilitador'] = $idFacilitador;
                    $nomeFacilitador = $rows_amb['nome_usuario'];
                    echo "<option id='$idFacilitador' value = '$idFacilitador'>$nomeFacilitador</option>";
                  }
                ?>
              </select>
            </div>
            <a href="cadastraUsuario.php">Deseja cadastrar um novo facilitador?</a>
          </div>    
        </div>
        <div class="row">
          <div class="col-lg-5">
            <div class="form-group">
              <span>* Data de início:</span>
              <input type="date" name="dataInicio" id="dataInicio" class="form-control"required="">
            </div>
          </div>
          <div class="col-lg-5">
            <div class="form-group">
              <span>* Data de término:</span>
              <input type="date" name="dataFinal" id="dataFinal" class="form-control">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-5">
            <div class="form-group">
              <span>* Horário de início:</span>
              <input type="time" name="hora_inicio_atividade" id="hora_inicio_atividade" class="form-control"required="">
            </div>
          </div>
          <div class="col-lg-5">
            <div class="form-group">
              <span>* Horário final:</span>
              <input type="time" name="hora_fim_atividade" id="hora_fim_atividade" class="form-control"required="">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-5">
            <div class="form-group">
              <label>* Tipo de atividade</label>
              <select class="form-control" name="tipo_atividade">
                <option>Oficina</option>
                <option>Minicurso</option>
                <option>Mesa-Redonda</option>
                <option>Palestra</option>
                <option>Simpósio</option>
                <option>Painéis</option>
                <option>Outro</option>
              </select>
            </div>
          </div> 
          <div class="col-lg-5">
            <div class="form-group">
              <label>* Local da atividade:</label>
              <select class="form-control" name="local">
                <option>selecione</option>
                <?php 
                  $result_ambientes = "SELECT * FROM ambientes";
                  $resultado_amb = mysqli_query($conexao, $result_ambientes);
                  while ($rows_amb = mysqli_fetch_array($resultado_amb)) { 
                    $id_ambiente = $rows_amb['cod_ambiente'];
                    $_SESSION['ambiente'] = $id_ambiente;
                    $sala = $rows_amb['sala'];
                    $andar = $rows_amb['andar'];
                    $bloco = $rows_amb['bloco'];
                    echo "<option id='$id_ambiente' value = '$id_ambiente'>Sala: $sala, Andar: $andar, Bloco: $bloco</option>";
                  }
                ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-5">
            <label>Número máximo de participantes:</label>
            <div class="form-group">
              <input type="number" name="max_participantes" id="max_participantes" class="form-control">
            </div>
          </div> 
          <div class="col-lg-5">
            <div class="form-group">
              <label>* Certificado</label>
              <select class="form-control" name="certificado_atividade">
                <option>Com Certificado</option>
                <option>Sem Certificado</option>
              </select>
            </div>
          </div>  
        </div>
        <br>
        <?php
        // VERIFICAR SE O EVENTO PERMITIR INSCRIÇÕES EM SUAS ATIVIDADES ANTES DO INÍCIO DO EVENTO
        $verificarEvento = "SELECT permitiInscricaoAtividade FROM eventos WHERE id_evento = $cod_evento";
        $resultado = mysqli_query($conexao, $verificarEvento); 
        while ($rows = mysqli_fetch_array($resultado)) { 
          $permitir = $rows['permitiInscricaoAtividade'];
          if ($permitir != 0) {
            echo "
              <legend style='text-align: center;'>
                PERÍODO DE INSCRIÇÃO
              </legend>
              <div class='row'>
                <div class='col-lg-5'>
                  <div class='form-group'>
                    <span>* Data de início:</span>
                    <input type='date' name='data_inicioInscricao' id='data_inicioInscricao' class='form-control'required>
                  </div>
                </div>
              <div class='col-lg-5'>
                <div class='form-group'>
                  <span>* Data final:</span>
                  <input type='date' name='data_fimInscricao' id='data_fimIncricao' class='form-control' required>
                </div>
              </div>
            </div>
            ";
          }
        }
        ?>
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
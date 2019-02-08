<?php
  session_start();
  include_once("conexao.php");
  include_once 'seguranca.php';

  $codusuario = filter_input(INPUT_GET, 'iu', FILTER_SANITIZE_NUMBER_INT);
  $codevento = filter_input(INPUT_GET, 'ie', FILTER_SANITIZE_NUMBER_INT);
  $codinscricao = filter_input(INPUT_GET, 'ni', FILTER_SANITIZE_NUMBER_INT);
?>
<?php
ob_start();
$btnCertificacao = filter_input(INPUT_POST, 'btnCertificado', FILTER_SANITIZE_STRING);
if($btnCertificacao){

  $dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT); 
  $erro = false; 
  $dados_st = array_map('strip_tags', $dados_rc);
  $dados = array_map('trim', $dados_st);

  // criar texto do certificado a pati do que o usuário informou    
  $text = "Certificamos que ".$dados['nome_usuario'].", inscrito no CPF n° ".$dados['cpf']." participou ".$dados['termo']." ".$dados['nome_evento'].", evento promovido ".$dados['termo2']." ".$dados['instituicao'].", realizado no ".$dados['termo3']." ".$dados['datas']." ".$dados['termo5']." ".$dados['local'].", perfazendo uma carga horária de ".$dados['cargaHoraria']." horas "; 
  $_SESSION['texto'] = $text;

  // Criar código do certificado usando data atual, codigo de inscrição, código do evento e código do perticipante
  $data = date('dmY');
  $codigoCertificado = "".$data."".$codusuario."".$codinscricao."".$codevento;
  $_SESSION['codigo'] = $codigoCertificado;
  $_SESSION['Evento'] = $codevento;
  //pegar extensão dos arquivos
  $extensaolayout = strtolower(substr($_FILES['layout']['name'], -4));
  /*$_UP['extensoes'] = array('jpg', 'png');

  // Faz a verificação da extensão do arquivo -. NÂO ESTÀ FUNCIONANDO
 if (array_search($extensaolayout, $_UP['extensoes']) === false) {
    $_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'>Arquivo em formato inválido, por favor enviar um arquivo em png ou jpg</div>";
    $erro = true;
  }else{*/
    // defini nome do arquivo
    $novo_nomelayout = md5(time()).$extensaolayout;
    $_SESSION['layout'] = $novo_nomelayout;

    // definir diretorio para onde enviaremos o arquivo
    $diretorio = "upload/";
    
    // efetua o upload
    move_uploaded_file($_FILES['layout']['tmp_name'], $diretorio.$novo_nomelayout);

    $atualizar_Certificado= "UPDATE inscricaoevento SET numeroCertificado = $codigoCertificado WHERE id_inscricao = $codinscricao AND cod_evento = $codevento AND cod_usuario = $codusuario";
    $resultado = mysqli_query($conexao, $atualizar_Certificado);

  if ($resultado) {
    header('Location: salva_DadosCertificado.php'); 
  }else{
    echo "erro";
    echo $atualizar_Certificado;
  }

    
}
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
    //BUSCAR DADOS PARA COLOCAR NO CERTIFICADO
      $buscar_usuario = "SELECT * FROM inscricaoevento, usuarios, eventos WHERE cod_evento = id_evento AND cod_usuario = id_usuario AND id_inscricao = $codinscricao AND id_usuario = $codusuario AND id_evento = $codevento";
      $resultado = mysqli_query($conexao, $buscar_usuario);
    ?>
    <h1 style="text-align: center;">Texto do Certificado</h1>
    <?php 
      while($rows = mysqli_fetch_array($resultado)){
        $idUsuario = $rows['id_usuario'];
        $nomeUsuario = $rows['nome_usuario'];
        $cpf = $rows['cpf_usuario'];
        $tipoUsuario = $rows['tipo_usuario'];
        $idEvento = $rows['id_evento'];
        $nomeEvento = $rows['nome_evento'];
        $inicioEvento = $rows['dataInicio_evento'];
        $fimEvento = $rows['dataFinal_evento'];
        $localEvento = $rows['local_evento'];
      }
    ?>
    <form class="form" action="" method="POST" enctype="multipart/form-data">
      <p>
        <?php
          if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
          }
        ?>
      </p>
      <div class="row">
        <div class="col-lg-10">
          <div class="form-group">
            <h6 style="text-align: justify;">Certificamos que <input type="text" name="nome_usuario" id="nome_usuario" value="<?php echo $nomeUsuario ?>">, inscrito no CPF n°  <input type="text" name="cpf" value="<?php echo $cpf ?>" >participou <input type="text" name="termo" value="<?php echo "do / da" ?>"> <input type="text" name="nome_evento" value="<?php echo $nomeEvento ?>">, evento promovido <input type="text" name="termo2" value="<?php echo "pelo/pela/pelos/pelas" ?>"> <input type="text" name="instituicao" value="<?php echo "Nome de Quem Promoveu o Evento" ?>">, realizado no <input type="text" name="termo3" value="<?php echo "dia/período de" ?>"> <input type="text" name="datas" value="<?php echo date('d/m/Y', strtotime($inicioEvento))." á ".date('d/m/Y', strtotime($fimEvento)) ?>">  <input type="text" name="termo5" value="<?php echo "no / na" ?>">  <input type="text" name="local" value="<?php echo $localEvento ?>">, perfazendo uma carga horária de <input type="text" name="cargaHoraria" value="<?php echo "Quantidade" ?>">horas. </h6>
          </div>
        </div>
      </div>
      <div class="row">
        <p>Inserir layout do certificado</p>
        <div class="col-lg-10">
            <div class="form-group">
              <input type="file" name="layout" required>
            </div>
        </div> 
      </div>
      <div class="row">
        <div class="col-lg-10">
          <div class="form-group">
               <input type="submit" name="btnCertificado" value="CONFIRMAR" class="btn btn-lg btn-block" style="color: #FFFFFF;">
            </div>
        </div>
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
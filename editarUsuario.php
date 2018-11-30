<?php
  session_start();
  include_once("conexao.php");
  include_once 'seguranca.php';
  $cod_usuario = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>
<?php
ob_start();
$btnAtualUsuario = filter_input(INPUT_POST, 'btnAtualizaUsuario', FILTER_SANITIZE_STRING);
if($btnAtualUsuario){
  $dados_rc = filter_input_array(INPUT_POST, FILTER_DEFAULT); 
  $erro = false; 
  $dados_st = array_map('strip_tags', $dados_rc);
  $dados = array_map('trim', $dados_st);

 function isCPFValido($valor){
    $valor = str_replace(array('.','-','/'), "", $valor);
    $cpf = str_pad(preg_replace('[^0-9]', '', $valor), 11, '0', STR_PAD_LEFT);
    
    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999'):
      return false;
    else: 
      for ($t = 9; $t < 11; $t++):
        for ($d = 0, $c = 0; $c < $t; $c++) :
          $d += $cpf{$c} * (($t + 1) - $c);
        endfor;
        $d = ((10 * $d) % 11) % 10;
        if ($cpf{$c} != $d):
          return false;
        endif;
      endfor;
      return true;
    endif;
  }

  function validarData($data) {
    $array = explode("-", $data);
    $ano = $array[0];
    $mes = $array[1];
    $dia = $array[2];
    $dataAtual = date('Y-m-d'); 
    $anoMax = $dataAtual - 12;
    $anoMin = $dataAtual - 70;
    if(strtotime($dataAtual) > strtotime($data)){
      return true; 
    }elseif ($ano >= $anoMax) {
      return false;
    }elseif ($ano < $anoMin) {
      return false;
    } 
  }
    
  if (!isCPFValido($dados['cpf'])) {
    $erro = true;
    $_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'>CPF inválido</div>";
  }elseif (!validarData($dados['datanasc'])) {
    $erro = true;
    $_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'>Data inválida</div>";
  }elseif (!preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $dados['cep'])) {
    $erro = true;
    $_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'>CEP inválido</div>";
  }
    
  if(!$erro){
    $atualizar_usuario = "UPDATE usuarios SET nome_usuario = '" .$dados['nome']. "', sexo_usuario = '" .$dados['sexo']. "', data_nascimento_usuario = '" .$dados['datanasc']. "', cpf_usuario = '" .$dados['cpf']. "', endereco_usuario = '" .$dados['endereco']. "', cidade_usuario = '" .$dados['cidade']. "', cep_usuario = '" .$dados['cep']. "', estado_usuario = '" .$dados['estado']. "', email_usuario = '" .$dados['email']. "', tipo_usuario = '".$dados['tipo']."' WHERE id_usuario = $cod_usuario";
      $resultado_usario = mysqli_query($conexao, $atualizar_usuario);
    if($resultado_usario){
      echo "<script>alert('Usuário Atualizado com Sucesso !');window.location.href='page_user.php'</script>";
    }else{
      $_SESSION['msg'] = "Erro ao cadastrar o usuário";
      echo $atualizar_usuario;
    }
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
    //BUSCAR O USUÁRIO ESCOLHIDO
      $buscar_usuario = "SELECT * FROM usuarios WHERE id_usuario = $cod_usuario";
      $resultado = mysqli_query($conexao, $buscar_usuario);
    ?>
    <h1 style="text-align: center;">Editar Dados do Usuário</h1>
    <br>
    <?php 
      while($rows = mysqli_fetch_array($resultado)){
        $idUsuario = $rows['id_usuario'];
        $nomeUsuario = $rows['nome_usuario'];
        $dataNascimento = $rows['data_nascimento_usuario'];
        $sexo = $rows['sexo_usuario'];
        $cpf = $rows['cpf_usuario'];
        $endereco = $rows['endereco_usuario'];
        $cidade = $rows['cidade_usuario'];
        $cep = $rows['cep_usuario'];
        $estado = $rows['estado_usuario'];
        $email = $rows['email_usuario'];
        $tipoUsuario = $rows['tipo_usuario'];
      }
    ?>
    <form class="form" action="" method="POST">
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
          <label>Nome</label>
            <div class="form-group">
              <input type="text" name="nome" id="nome" class="form-control" minlength="12" required value="<?php echo $nomeUsuario ?>">
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3">
          <label>Sexo</label>
          <div class="form-group">
            <select name="sexo" size="1" class="form-control" id="sexo" required value="<?php echo $sexo ?>">
              <option>Feminino</option>
              <option>Masculino</option>
            </select>
          </div>
        </div>
        <div class="col-lg-3">
          <label>Data de Nascimento</label>
            <div class="form-group">
                <input type="date" name="datanasc" id="datanasc" class="form-control" required value="<?php echo $dataNascimento ?>">
              </div>
        </div>
        <div class="col-lg-4">
            <label>CPF</label>
            <div class="form-group">
              <input type="number" name="cpf" id="cpf" class="form-control" required value="<?php echo $cpf ?>">
            </div>
          </div>
      </div>
      <div class="row">   
        <div class="col-lg-6">
          <label>Endereço</label>
          <div class="form-group">
            <input type="text" name="endereco" id="endereco" class="form-control" required value="<?php echo $endereco ?>">
          </div>
        </div>
        <div class="col-lg-4">
          <label>Cidade</label>
            <div class="form-group">
              <input type="text" name="cidade" id="cidade" class="form-control" required value="<?php echo $cidade ?>">
            </div>
        </div>
      </div>
      <div class="row"> 
        <div class="col-lg-6">
          <label>CEP</label>
          <div class="form-group">
            <input type="number" name="cep" id="cep" class="form-control" required value="<?php echo $cep ?>">
          </div>
        </div>
        <div class="col-lg-4">
          <label>Estado</label>
          <div class="form-group">
            <input type="text" name="estado" id="estado" class="form-control" required value="<?php echo $estado ?>">
          </div>
          <span style="color: red">Colocar apenas as Siglas</span>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-10">
          <label>Email</label>
          <div class="form-group">
            <input type="email" name="email" id="email" class="form-control" required value="<?php echo $email ?>">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-5">
          <label>Tipo de usuário</label>
          <div class="form-group">
            <input type="text" name="tipo" id="tipo" class="form-control" required value="<?php echo $tipoUsuario ?>">
          </div>
        </div>
         <span style="color: red"> Tipo de usuários são "Participante, Auxiliar de Coordenação, Facilitador e Coordenador"</span>
      </div>
      <br>   
      <div class="row">
        <div class="col-lg-5">
          <input type="submit" name="btnAtualizaUsuario" value="CADASTRAR" class="btn btn-lg btn-block" style="color: #FFFFFF;">
        </div>
        <div class="col-lg-5">
          <a href="javascript:history.back()"><input name="btnAtualizaUsuario" value="CANCELAR" class="btn btn-lg btn-block btn-danger" style="color: #FFFFFF;"></a>
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
<?php
session_start();
ob_start();
$btnCadUsuario = filter_input(INPUT_POST, 'btnCadUsuario', FILTER_SANITIZE_STRING);
if($btnCadUsuario){
  include_once 'conexao.php';
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
    
  if((strlen($dados['senha'])) > 10){
    $erro = true;
    $_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'>A senha deve ter no máximo 10 caracteres</div>";
  }elseif (!isCPFValido($dados['cpf'])) {
    $erro = true;
    $_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'>CPF inválido</div>";
  }elseif (!validarData($dados['datanasc'])) {
    $erro = true;
    $_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'>Data inválida</div>";
  }elseif (!preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $dados['cep'])) {
    $erro = true;
    $_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'>CEP inválido</div>";
  }elseif ($dados['senha'] != $dados['conf_senha']) {
    $erro = true;
    $_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'>As senhas devem ser iguais</div>";
  }else{  
    $result_usuario = "SELECT id_usuario FROM usuarios WHERE email_usuario ='". $dados['email'] ."'";
    $resultado_usuario = mysqli_query($conexao, $result_usuario);
    if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
      $erro = true;
      $_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'>Este e-mail já está cadastrado</div>";
    }
    $result_usuario = "SELECT id_usuario FROM usuarios WHERE cpf_usuario ='". $dados['cpf'] ."'";
    $resultado_usuario = mysqli_query($conexao, $result_usuario);
    if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
      $erro = true;
      $_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'>Este cpf já está cadastrado</div>";
    }
  }
    
  if(!$erro){
    $senha = $dados['senha'];
    $confirmar = $dados['conf_senha'];

    $senhacriptografada = password_hash($senha, PASSWORD_DEFAULT);
    $confirmarsenhacriptografada = password_hash($confirmar, PASSWORD_DEFAULT);

    $result_usuario = "INSERT INTO usuarios (nome_usuario, sexo_usuario, data_nascimento_usuario, cpf_usuario, endereco_usuario, cidade_usuario, cep_usuario, estado_usuario, email_usuario, senha_usuario, confirmar_senha_usuario, tipo_usuario) VALUES ('" .$dados['nome']. "','" .$dados['sexo']. "','" .$dados['datanasc']. "','" .$dados['cpf']. "','" .$dados['endereco']. "','" .$dados['cidade']. "', '" .$dados['cep']. "', '" .$dados['estado']. "', '" .$dados['email']. "', '$senhacriptografada', '$confirmarsenhacriptografada', '".$dados['tipo']."')";
      $resultado_usario = mysqli_query($conexao, $result_usuario);
    if($resultado_usario){
      echo "<script>alert('Usuário Cadastrado com Sucesso !');window.location.href='lista_de_coordenadores.php'</script>";
    }else{
      $_SESSION['msg'] = "Erro ao cadastrar o usuário";
      echo $result_usuario;
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
    <h1 style="text-align: center;">Cadastrar Novo Usuário</h1>  
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
              <input type="text" name="nome" id="nome" class="form-control" placeholder="nome completo" minlength="12" required>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3">
          <label>Sexo</label>
          <div class="form-group">
            <select name="sexo" size="1" class="form-control" id="sexo" required>
              <option>Feminino</option>
              <option>Masculino</option>
            </select>
          </div>
        </div>
        <div class="col-lg-3">
          <label>Data de Nascimento</label>
            <div class="form-group">
                <input type="date" name="datanasc" id="datanasc" class="form-control" required>
              </div>
        </div>
        <div class="col-lg-4">
            <label>CPF</label>
            <div class="form-group">
              <input type="number" name="cpf" id="cpf" class="form-control" required>
            </div>
          </div>
      </div>
      <div class="row">   
        <div class="col-lg-6">
          <label>Endereço</label>
          <div class="form-group">
            <input type="text" name="endereco" id="endereco" class="form-control" placeholder="rua, numero, bairro" required>
          </div>
        </div>
        <div class="col-lg-4">
          <label>Cidade</label>
            <div class="form-group">
              <input type="text" name="cidade" id="cidade" class="form-control" required>
            </div>
        </div>
      </div>
      <div class="row"> 
        <div class="col-lg-6">
          <label>CEP</label>
          <div class="form-group">
            <input type="number" name="cep" id="cep" class="form-control" required>
          </div>
        </div>
        <div class="col-lg-4">
          <label>Estado</label>
          <div class="form-group">
            <select name="estado" class="form-control" required>
              <option value="AC">AC</option> 
              <option value="AL">AL</option> 
              <option value="AM">AM</option> 
              <option value="AP">AP</option> 
              <option value="BA">BA</option> 
              <option value="CE">CE</option> 
              <option value="DF">DF</option> 
              <option value="ES">ES</option> 
              <option value="GO">GO</option> 
              <option value="MA">MA</option> 
              <option value="MT">MT</option> 
              <option value="MS">MS</option> 
              <option value="MG">MG</option> 
              <option value="PA">PA</option> 
              <option value="PB">PB</option> 
              <option value="PR">PR</option> 
              <option value="PE">PE</option> 
              <option value="PI">PI</option> 
              <option value="RJ">RJ</option> 
              <option value="RN">RN</option> 
              <option value="RO">RO</option> 
              <option value="RS">RS</option> 
              <option value="RR">RR</option> 
              <option value="SC">SC</option> 
              <option value="SE">SE</option> 
              <option value="SP">SP</option> 
              <option value="TO">TO</option>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-10">
          <label>Email</label>
          <div class="form-group">
            <input type="email" name="email" id="email" class="form-control" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-5">
          <label>Senha</label>
          <div class="form-group">
            <input type="password" name="senha" id="inputPassword" class="form-control" required  minlength ="6">
          </div>
        </div>
        <div class="col-lg-5">
          <label>Confirmar Senha</label>
          <div class="form-group">
            <input type="password" name="conf_senha" id="conf_senha" class="form-control" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <label>Tipo de usuário</label>
          <div class="form-group">
            <select name="tipo" size="1" class="form-control" id="tipo" required>
              <option>Participante</option>
              <option>Auxiliar de Coordenação</option>
              <option>Facilitador</option>
              <option>Coordenador</option>
            </select>
          </div>
        </div>
      </div>
      <br>   
      <div class="row">
        <div class="col-lg-10">
          <input type="submit" name="btnCadUsuario" value="CADASTRAR" class="btn btn-lg btn-block" style="color: #FFFFFF;">
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
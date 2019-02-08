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

        echo $data;
        echo $dia;
        echo $mes;
        echo $ano; 
        echo $dataAtual; 
        echo $dataMax; 
        echo $dataMin ; 
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

        // Variável com a senha guardada
        $senha = $dados['senha'];
        $confirmar = $dados['conf_senha'];

        $resto = password_hash($senha, PASSWORD_DEFAULT);
        $restoConfirmar = password_hash($confirmar, PASSWORD_DEFAULT);

        $result_usuario = "INSERT INTO usuarios (nome_usuario, sexo_usuario, data_nascimento_usuario, cpf_usuario, endereco_usuario, cidade_usuario, cep_usuario, estado_usuario, email_usuario, senha_usuario, confirmar_senha_usuario, tipo_usuario) VALUES ('" .$dados['nome']. "','" .$dados['sexo']. "','" .$dados['datanasc']. "','" .$dados['cpf']. "','" .$dados['endereco']. "','" .$dados['cidade']. "', '" .$dados['cep']. "', '" .$dados['estado']. "', '" .$dados['email']. "', '$resto' , '$restoConfirmar', 'Participante')";
        $resultado_usario = mysqli_query($conexao, $result_usuario);
        if($resultado_usario){
            echo "<script>alert('Usuário Cadastrado com Sucesso !');window.location.href='index.php'</script>";
        }else{
            $_SESSION['msg'] = "Erro ao cadastrar o usuário";
            echo $result_usuario;
        }
    }
    
}
?>
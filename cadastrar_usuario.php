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
    
    if(in_array('',$dados)){
        $erro = true;
        $_SESSION['msg'] = "Necessário preencher todos os campos";
    }elseif((strlen($dados['senha'])) > 10){
        $erro = true;
        $_SESSION['msg'] = "A senha deve ter no máximo 10 caracteres";
    }elseif(stristr($dados['senha'], "'")) {
        $erro = true;
        $_SESSION['msg'] = "Caracter ( ' ) utilizado na senha é inválido";
    }elseif (!isCPFValido($dados['cpf'])) {
    	$erro = true;
        $_SESSION['msg'] = "CPF inválido";
    }elseif (!preg_match('/[0-9]{5,5}([-]?[0-9]{3})?$/', $dados['cep'])) {
    	$erro = true;
        $_SESSION['msg'] = "CEP inválido";
    }elseif ($dados['senha'] != $dados['conf_senha']) {
    	$erro = true;
        $_SESSION['msg'] = "As senhas devem ser iguais";
    }else{  
        $result_usuario = "SELECT id FROM usuarios_cadastrados WHERE email='". $dados['email'] ."'";
        $resultado_usuario = mysqli_query($conexao, $result_usuario);
        if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
            $erro = true;
            $_SESSION['msg'] = "Este e-mail já está cadastrado";
        }

        $result_usuario = "SELECT id FROM usuarios_cadastrados WHERE cpf='". $dados['cpf'] ."'";
        $resultado_usuario = mysqli_query($conexao, $result_usuario);
        if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
            $erro = true;
            $_SESSION['msg'] = "Este cpf já está cadastrado";
        }
    }
    
    if(!$erro){

        $result_usuario = "INSERT INTO usuarios_cadastrados(nome, sexo, datanasc, cpf, endereco, cidade, cep, estado, email, senha, conf_senha, tipo_usuarios) VALUES ('" .$dados['nome']. "','" .$dados['sexo']. "','" .$dados['datanasc']. "','" .$dados['cpf']. "','" .$dados['endereco']. "','" .$dados['cidade']. "', '" .$dados['cep']. "', '" .$dados['estado']. "', '" .$dados['email']. "', '" .$dados['senha']. "', '" .$dados['conf_senha']. "', 'Participante')";
        $resultado_usario = mysqli_query($conexao, $result_usuario);
        if(mysqli_insert_id($conexao)){
            $_SESSION['msgcad'] = "Usuário cadastrado com sucesso";
            header("Location: login.php");
        }else{
            $_SESSION['msg'] = "Erro ao cadastrar o usuário";
            echo $result_usuario;
        }
    }
    
}
?>
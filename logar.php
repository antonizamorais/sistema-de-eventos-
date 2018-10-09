<?php
	session_start();
	$emailt = $_POST['email'];
	$senhat = $_POST['senha'];
	
	include_once ("conexao.php");

	$logando = "SELECT * FROM usuarios_cadastrados WHERE email = '$emailt' AND senha = '$senhat' ";

	$result = mysqli_query($conexao,$logando);

	if (empty($resultado = mysqli_fetch_assoc($result))) {
		$_SESSION['loginerro'] = 'email ou senha inválido';
		header("Location:login.php");
	}else{
		$_SESSION['nome_user'] = $resultado['nome'];
		$_SESSION['id_user'] = $resultado['id'];
		$_SESSION['email_user'] = $resultado['email'];
		$_SESSION['senha_user'] = $resultado['senha'];
		$_SESSION['tipo_user'] = $resultado['tipo_usuarios'];
		header("Location: page_user.php");
	}

?>




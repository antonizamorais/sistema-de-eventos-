<?php
	session_start();
	$emailt = $_POST['email'];
	$senhat = $_POST['senha'];
	
	include_once ("conexao.php");

	$logando = "SELECT * FROM usuarios WHERE email_usuario = '$emailt' AND senha_usuario = '$senhat' ";

	$result = mysqli_query($conexao,$logando);

	if (empty($resultado = mysqli_fetch_assoc($result))) {
		$_SESSION['loginerro'] = '<div class="alert alert-danger text-center" role="alert">Email ou senha inválido!</div>';
		header("Location:login.php");
	}else{
		$_SESSION['nome_user'] = $resultado['nome_usuario'];
		$_SESSION['id_user'] = $resultado['id_usuario'];
		$_SESSION['email_user'] = $resultado['email_usuario'];
		$_SESSION['senha_user'] = $resultado['senha_usuario'];
		$_SESSION['tipo_user'] = $resultado['tipo_usuario'];
		header("Location: page_user.php");
	}

?>




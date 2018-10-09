<?php
	session_start();

	// Verifica se o POST tem algum valor
	if ( !isset( $_POST ) || empty( $_POST ) ) {
		$erro = 'Nada foi postado.';
	}

	include_once 'conexao.php';
  	$cod_event = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  	$_SESSION['cod'] = $cod_event;

  	$cod_user = $_SESSION['id_user'];

	$cadastrar = "INSERT INTO inscricao_evento(cod_evento, situacao, cod_usuario) VALUES (' $cod_event', 'inscrito', '$cod_user')";

	$resultado_cadastrar = mysqli_query($conexao, $cadastrar);
	$receber = mysqli_commit($conexao);

	if ($resultado_cadastrar) {
		echo " você esta inscrito no evento";
	}else{
		echo "erro";
		echo $cadastrar;
	}
	// Close connection
	mysqli_close($conexao);
?>
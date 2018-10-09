<?php
	session_start();

	// Verifica se o POST tem algum valor
	if ( !isset( $_POST ) || empty( $_POST ) ) {
		$erro = 'Nada foi postado.';
	}

	include_once 'conexao.php';
  	$cod_atividade = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  	$_SESSION['cod'] = $cod_atividade;

  	$cod_user = $_SESSION['id_user'];

	$cadastrar = "INSERT INTO inscricao_atividade(cod_atividade, cod2_usuario) VALUES ('$cod_atividade','$cod_user')";

	$resultado_inscricao = mysqli_query($conexao, $cadastrar);
	$receber = mysqli_commit($conexao);

	if ($resultado_inscricao) {
		echo " você esta inscrito na atividade";
	}else{
		echo "erro";
		echo $cadastrar;
	}
	// Close connection
	mysqli_close($conexao);
?>
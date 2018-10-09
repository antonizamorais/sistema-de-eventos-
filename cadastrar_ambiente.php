<?php
	if ( !isset( $_POST ) || empty( $_POST ) ) {
		$erro = 'Nada foi postado.';
	}
	include_once('conexao.php');
	$sala_ = $_POST['sala'];
	$andar_ = $_POST['andar'];
	$bloco_ = $_POST['bloco'];

	$cadastrar_amb = "INSERT INTO ambiente(sala, andar, bloco) VALUES ('$sala_','$andar_','$bloco_')";

	$resultado_ambiente = mysqli_query($conexao, $cadastrar_amb);

	$receber = mysqli_commit($conexao);
	if ($resultado_ambiente) {
		echo "cadastro com sucesso";
	}else{
		echo "erro";
		echo $cadastrar_amb;
	}
?>
<?php 
	session_start();
	$presente = true;
	$nao_presente = true;
	$num_atividade =  $_SESSION['idAtividade']; 
	$num_participante = $_SESSION['numIncricao'];

	if ( !isset( $_POST ) || empty( $_POST ) ) {
		$erro = 'Nada foi postado.';
	}
	include_once('conexao.php');

	if (empty($_POST['presente']) ) {
		$presente = 0;
	}
	if (empty($_POST['nao_presente']) ) {
		$nao_presente = 0;
	}
	
	$cadastrar_presenca = "UPDATE inscricao_atividade SET 
	lista_presenca = '$presente' WHERE n_ins_a = '$num_participante' AND cod_atividade = '$num_atividade'";

	$resultado_presenca= mysqli_query($conexao, $cadastrar_presenca);
	
	$receber = mysqli_commit($conexao);

	if ($resultado_presenca) {
		echo "lista de presenca salva";
		echo $cadastrar_presenca;
	}else{
		echo "erro";
		echo $cadastrar_presenca;
	}
?>
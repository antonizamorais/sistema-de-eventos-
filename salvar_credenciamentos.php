<?php 
	session_start();
	$presente = true;

	$num_evento =  $_SESSION['idEvento']; 
	$num_inscricao_participante = $_SESSION['numIncricaoEvento'];
	$id_participante = $_SESSION['id_participante'];

	if ( !isset( $_POST ) || empty( $_POST ) ) {
		$erro = 'Nada foi postado.';
	}
	include_once('conexao.php');

	if (empty($_POST['presente']) ) {
		$presente = 0;
	}
	
	$cadastrar_credenciamento = "INSERT INTO credenciamento 
	(num_inscricao_evento, codigo_evento, codigo_usuario) 
	VALUES ('$num_inscricao_participante', '$num_evento', '$id_participante');";

	$resultado= mysqli_query($conexao, $cadastrar_credenciamento);
	
	$receber = mysqli_commit($conexao);

	if ($resultado) {
		echo "credenciamento realizado";
		echo $cadastrar_credenciamento;
	}else{
		echo "erro";
		echo $cadastrar_credenciamento;
	}
?>
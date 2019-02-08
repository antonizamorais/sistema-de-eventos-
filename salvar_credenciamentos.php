<?php 
	session_start();
	include 'conexao.php';
	
	$codParticipante = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	$numeroInscricao = filter_input(INPUT_GET, 'numIns', FILTER_SANITIZE_NUMBER_INT);
	$codEvento = filter_input(INPUT_GET, 'codevento', FILTER_SANITIZE_NUMBER_INT);

	$cadastrar_credenciamento = "UPDATE inscricaoevento SET credenciamento = 'Presente' WHERE id_inscricao = $numeroInscricao AND cod_evento = $codEvento AND cod_usuario = $codParticipante";

	$resultado= mysqli_query($conexao, $cadastrar_credenciamento);
	if ($resultado) {
		$volta = $_SERVER['HTTP_REFERER'];
		header('Location: ' . $volta); 
	}else{
		echo "erro";
		echo $cadastrar_credenciamento;
	}
?>
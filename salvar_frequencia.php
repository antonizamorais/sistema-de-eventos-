<?php 
	session_start();

	$num_participante = filter_input(INPUT_GET, 'num', FILTER_SANITIZE_NUMBER_INT);
	$id_participante = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

	include_once('conexao.php');
	
	$cadastrar_presenca = "UPDATE inscricaoatividade SET presenca = 'Presente' WHERE id_inscricao = '$num_participante' AND codUsuario = '$id_participante'";

	$resultado_presenca= mysqli_query($conexao, $cadastrar_presenca);
	
	$receber = mysqli_commit($conexao);

	if ($resultado_presenca) {
		$volta = $_SERVER['HTTP_REFERER'];
		header('Location: ' . $volta); 
	}else{
		echo "erro";
		echo $cadastrar_presenca;
	}
?>
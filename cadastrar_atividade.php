<?php
	session_start();
	$cert_atividade = true;
	// Verifica se o POST tem algum valor
	if ( !isset( $_POST ) || empty( $_POST ) ) {
		$erro = 'Nada foi postado.';
	}
	include_once('conexao.php');
	$nome_atividade = $_POST['nome_atividade'];
	$nome_f = $_POST['nome_fac'];
	$data_1 = $_POST['data_1'];
	$data_2 = $_POST['data_2'];
	$hora_inicio = $_POST['hora_inicio_atividade'];
	$hora_fim = $_POST['hora_fim_atividade'];
	$tipo_ativ = $_POST['tipo_atividade'];
	if (empty($_POST['cert_atividade']) ) {
		$cert_atividade = 0;
	}
	$cod_evento = $_SESSION['cod'];
	$ambiente = $_POST['local'];
	$numero_participante = $_POST['max_participantes'];

	$cadastrar_ativ = "INSERT INTO atividade(nome_atividade, facilitador, data_inicio, data_final, hora_inicio, hora_final, tipo, certificado, cod3_evento, cod_ambiente, max_participantes) VALUES ('$nome_atividade','$nome_f','$data_1','$data_2','$hora_inicio','$hora_fim','$tipo_ativ','$cert_atividade','$cod_evento','$ambiente','$numero_participante')"; 

	$resultado_atividade = mysqli_query($conexao, $cadastrar_ativ);

	$receber = mysqli_commit($conexao);
	if ($resultado_atividade) {
		echo "cadastro com sucesso";
	}else{
		echo "erro";
		echo $cadastrar_ativ;

	}
	// Close connection
	mysqli_close($conexao);
?>
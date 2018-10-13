<?php
	session_start();
	// variável que terá os dados do erro
	$erro = false;
	$cert_evento = true;
	$insc_ativade = true;
	// Verifica se o POST tem algum valor
	if ( !isset( $_POST ) || empty( $_POST ) ) {
		$erro = 'Nada foi postado.';
	}
	include_once('conexao.php');

	$nome_evento = $_POST['nome_evento'];
	$data_fim = $_POST['data_fim'];
	$data_inicio = $_POST['data_inicio'];
	$hora_fim = $_POST['hora_fim_evento'];
	$hora_inicio = $_POST['hora_inicio_evento'];
	$local_evento = $_POST['local_evento'];
	if (empty($_POST['cert_evento']) ) {
		$cert_evento = 0;
	}
	if (empty($_POST['insc_ativ']) ) {
		$insc_ativade = 0;
	}
	$id_coo =  $_SESSION['idCoo'] ;
	$data1_insc = $_POST['data_inicio_ins'];
	$data2_insc = $_POST['data_fim_ins'];

	$cadastrar = "INSERT INTO evento(nome_evento, cod_coordenador, data_inicio, data_fim, hora_inicio, hora_final, local, certificado, insc_ativ, data_inicio_inscricao, data_final_inscricao) VALUES ('$nome_evento','$id_coo','$data_inicio','$data_fim','$hora_inicio','$hora_fim', '$local_evento', '$cert_evento', '$insc_ativade', '$data1_insc','$data2_insc')";
	$resultado_cadastrar = mysqli_query($conexao, $cadastrar);
	$receber = mysqli_commit($conexao);

	if ($resultado_cadastrar) {
		echo "cadastro de evento realizado com sucesso";
	}else{
		echo "erro";
		echo "<br>";
		echo $cadastrar;
		//echo "<script>alert('Infome os dados corretamente'); window.location='criar_evento.php';</script>";
	}
	// Close connection
	mysqli_close($conexao);
?>
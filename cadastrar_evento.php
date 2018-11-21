<?php
	session_start();
	// VARIÁVEL RESPONSÁVEL POR VERIFICAR ERROS
	$erro = false;

	// VARIÁVEIS DO CHEKBOX
	$cert_evento = true;
	$insc_atividade = true;

	include_once('conexao.php');

	// ATRIBUIR VALORES DO POST AS VARIÁVEIS
	$nome_evento = $_POST['nome_evento'];
	$dataFinal = $_POST['data_fim'];
	$dataInicio = $_POST['data_inicio'];
	$horaFinal = $_POST['hora_fim_evento'];
	$horaInicio = $_POST['hora_inicio_evento'];
	$localEvento = $_POST['local_evento'];
	if (empty($_POST['cert_evento']) ) {
		$cert_evento = 0;
	}
	if (empty($_POST['insc_ativ']) ) {
		$insc_ativade = 0;
	}
	$idCoordenador =  $_SESSION['id_user'];
	$dataInicioinscricao = $_POST['data_inicio_ins'];
	$dataFinalinscricao = $_POST['data_fim_ins'];
	$numMaximoparticipantes = $_POST['numParticipantes'];

	// VERIFICAR SE AS DATAS FORAM DIGITADAS CORRETAMENTE
	if (strtotime($dataFinalinscricao) > strtotime($dataFinal)) {
		$erro = true;
		echo "<script> alert('A data final do período de inscrição não pode ser maior que a data final de duração do evento'); window.history.go(-1); </SCRIPT>\n";
	}elseif (strtotime($dataInicioinscricao) > strtotime($dataFinalinscricao)) {
		$erro = true;
		echo "<script> alert('A data final do período de inscrição não pode ser menor que a data de inicio de inscrição do evento); window.history.go(-1); </SCRIPT>\n";
	}elseif (strtotime($dataInicio) > strtotime($dataFinal)) {
		$erro = true;
		echo "<script> alert('A data final da duração do evento não pode ser menor que a data de inicio da duração do evento'); window.history.go(-1); </SCRIPT>\n";
	}

	// SE NÃO HOUVER ERROS 
	if (!$erro) {
		// VERIFICAR SE O EVENTO CRIADO TEM UM LIMITE DE PARTICIPANTES
		if (empty($numMaximoparticipantes)) {
			$cadastrar = "INSERT INTO eventos (nome_evento, cod_coordenador, dataInicio_evento, dataFinal_evento, horaInicio_evento, horaFinal_evento, local_evento, geraCertificado_evento, permitiInscricaoAtividade, inicioInscricao_evento, fimInscricao_evento) VALUES ('$nome_evento','$idCoordenador','$dataInicio','$dataFinal','$horaInicio','$horaFinal', '$localEvento', '$cert_evento', '$insc_ativade', '$dataInicioinscricao','$dataFinalinscricao')";
		}else{
			$cadastrar = "INSERT INTO eventos (nome_evento, cod_coordenador, dataInicio_evento, dataFinal_evento, horaInicio_evento, horaFinal_evento, local_evento, geraCertificado_evento, permitiInscricaoAtividade, inicioInscricao_evento, fimInscricao_evento, numeroMax_participantes) VALUES ('$nome_evento','$idCoordenador','$dataInicio','$dataFinal','$horaInicio','$horaFinal', '$localEvento', '$cert_evento', '$insc_ativade', '$dataInicioinscricao','$dataFinalinscricao', '$numMaximoparticipantes')";
		}
	
		$resultado_cadastrar = mysqli_query($conexao, $cadastrar);
		$receber = mysqli_commit($conexao);

		if ($resultado_cadastrar) {
			echo "<script>alert('cadastro de evento realizado com sucesso!');window.location.href='page_user.php'</script>";
		}else{
			echo "erro";
			echo "<br>";
			echo $cadastrar;
		}
	}
	
?>
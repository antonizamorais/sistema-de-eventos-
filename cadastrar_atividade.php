<?php
	session_start();
  	$cod_evento = $_SESSION['evento'];
  	$cod_ambiente =  $_SESSION['ambiente'];
  	$cod_facilitador = $_SESSION['facilitador'];
	include_once('conexao.php');
	$nome_atividade = $_POST['nome_atividade'];
	$dataInicio = $_POST['dataInicio'];
	$dataFinal = $_POST['dataFinal'];
	$hora_inicio = $_POST['hora_inicio_atividade'];
	$hora_fim = $_POST['hora_fim_atividade'];
	$tipo_atividade = $_POST['tipo_atividade'];
	$certificado = $_POST['certificado_atividade'];
	$numero_participante = $_POST['max_participantes'];

	// VERIFICAR SE O EVENTO PERMITIR INSCRIÇÕES EM SUAS ATIVIDADES ANTES DO INÍCIO DO EVENTO
    $verificarEvento = "SELECT permitiInscricaoAtividade, inicioInscricao_evento, fimInscricao_evento FROM eventos WHERE id_evento = $cod_evento";
    $resultado = mysqli_query($conexao, $verificarEvento); 
    while ($rows = mysqli_fetch_array($resultado)) { 
        $permitir = $rows['permitiInscricaoAtividade'];
        $inicioInscrição_evento = $rows['inicioInscricao_evento'];
        $fimInscrição_evento = $rows['fimInscricao_evento'];
        if ($permitir != 0) {
            $inicioInscricao_atividade = $_POST['data_inicioInscricao'];
			$fimInscricao_atividade = $_POST['data_fimInscricao'];

			$cadastrar_atividade = "INSERT INTO atividades(nome_atividade, codEvento, codFacilitador_atividade, codLocal_atividade, dataInicio_atividade, dataFinal_atividade, dataInicio_inscricao, dataFinal_inscricao, horarioInicio_atividade, horarioFinal_atividade, tipo_atividade, numMax_participantes, geraCertificado_atividade) VALUES ('$nome_atividade','$cod_evento','$cod_facilitador', '$cod_ambiente', '$dataInicio', '$dataFinal', '$inicioInscricao_atividade', '$fimInscricao_atividade', '$hora_inicio', '$hora_fim', '$tipo_atividade', '$numero_participante', '$certificado')"; 
			$resultado_atividade = mysqli_query($conexao, $cadastrar_atividade);

			if ($resultado_atividade) {
				echo "<script>alert('cadastro de atividade realizado com sucesso!');window.location.href='page_user.php'</script>";
			}else{
				echo "erro";
				echo $cadastrar_atividade;

			}
        }else{
        	$cadastrar_atividade = "INSERT INTO atividades(nome_atividade, codEvento, codFacilitador_atividade, codLocal_atividade, dataInicio_atividade, dataFinal_atividade, dataInicio_inscricao, dataFinal_inscricao, horarioInicio_atividade, horarioFinal_atividade, tipo_atividade, numMax_participantes, geraCertificado_atividade) VALUES ('$nome_atividade','$cod_evento','$cod_facilitador', '$cod_ambiente', '$dataInicio', '$dataFinal', '$inicioInscricao_evento', '$fimInscricao_evento', '$hora_inicio', '$hora_fim', '$tipo_atividade', '$numero_participante', '$certificado')"; 
			$resultado_atividade = mysqli_query($conexao, $cadastrar_atividade);

			if ($resultado_atividade) {
				echo "<script>alert('cadastro de atividade realizado com sucesso!');window.location.href='page_user.php'</script>";
			}else{
				echo "erro";
				echo $cadastrar_atividade;

			}
        }
    }
	
?>
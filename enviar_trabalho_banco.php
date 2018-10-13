<?php
	session_start();
	include_once('conexao.php');

	if (isset($_FILES['arquivo'])) {
		//pegar extensão
		$extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
		// defini nome do arquivo
		$novo_nome = md5(time()).$extensao;
		// definir diretorio para onde enviaremos o arquivo
		$diretorio = "upload/";
		// efetua o upload
		move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
	}
	$titulo = $_POST['titulo_trabalho'];
	$resumo = $_POST['resumo_trabalho'];
	$num_evento = $_SESSION['id_do_evento'];
	$num_usuario = $_SESSION['id_user'];

	$enviar_trabalho = "INSERT INTO trabalho(titulo, resumo, num_usuario, num_evento, local, data) VALUES ('$titulo', '$resumo', '$num_usuario', '$num_evento', '$novo_nome', NOW())"; 

	$resultado_envio= mysqli_query($conexao, $enviar_trabalho);

	$receber = mysqli_commit($conexao);
	if ($resultado_envio) {
		echo "enviado com sucesso";
	}else{
		echo "erro";
		echo $enviar_trabalho;

	}
	// Close connection
	mysqli_close($conexao);
?>
<?php
	session_start();
	include_once('conexao.php');

	$titulo = $_POST['titulo_trabalho'];
	$resumo = $_POST['resumo_trabalho'];
	$num_evento = $_SESSION['id_do_evento'];
	$num_usuario = $_SESSION['id_user'];

	//pegar extensão
	$extensao = strtolower(substr($_FILES['arquivo']['name'], -4));

	$verificar_envio = "SELECT numero FROM trabalhos WHERE cod_usuario = $num_usuario AND cod_evento = $num_evento"; 
	$resultado = mysqli_query($conexao, $verificar_envio);


	if (mysqli_num_rows($resultado) > 0) {
		$_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'>Você já enviou arquivo para este evento</div>";
		$volta = $_SERVER['HTTP_REFERER'];
		header('Location: ' . $volta); 
	}else{

	if ($extensao == '.pdf') {
		// defini nome do arquivo
		$novo_nome = md5(time()).$extensao;
		// definir diretorio para onde enviaremos o arquivo
		$diretorio = "upload/";
		// efetua o upload
		move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);

		$enviar_trabalho = "INSERT INTO trabalhos (titulo, resumo, cod_evento, local, data, cod_usuario, situacao) VALUES ('$titulo', '$resumo', '$num_evento', '$novo_nome', NOW(), '$num_usuario', 'Aguardanto resposta')"; 

		$resultado_envio= mysqli_query($conexao, $enviar_trabalho);

		if ($resultado_envio) {
			echo "<script>alert('Arquivo enviado com sucesso !');window.location.href='page_user.php'</script>";
		}else{
			echo "erro";
			echo $enviar_trabalho;
		}
	}else{
		$_SESSION['msg'] = "<div class='alert alert-danger text-center' role='alert'>Arquivo em formato inválido, por favor enviar um arquivo em pdf</div>";
		$volta = $_SERVER['HTTP_REFERER'];
		header('Location: ' . $volta); 
	}
	}
?>
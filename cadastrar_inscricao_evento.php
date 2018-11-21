<?php
	session_start();
	include_once 'conexao.php';
  	$cod_evento = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  	$limiteInscritos = filter_input(INPUT_GET, 'limiteInscritos', FILTER_SANITIZE_NUMBER_INT);
  	$cod_user = $_SESSION['id_user'];

  	// VERIFICAR SE O EVENTO ESCOLHIDO TEM UM NUMERO MÁXIMO DE PARTICIPANTES NULL

  	if(empty($limiteInscritos)){

  		$cadastrar_inscricao = "INSERT INTO inscricaoevento(cod_evento, situacao, cod_usuario) VALUES (' $cod_evento', 'Inscrito', '$cod_user')";

		$resultado_cadastrar = mysqli_query($conexao, $cadastrar_inscricao);

		if ($resultado_cadastrar) {
			echo "<script>alert('Usuário inscrito no evento com sucesso!');window.location.href='page_user.php'</script>";
		}
	}else{
		// NESSE CASO, PRECISA-SE VERIFICAR SE O NÚMERO MÁXIMO DE PARTICIPANTES JÁ ESTÁ ESGOTADO
  		$buscar_numeroInscritos = "SELECT COUNT(*) FROM `inscricaoevento` WHERE cod_evento = '$cod_evento'";
  		$resultado_busca = mysqli_query($conexao, $buscar_numeroInscritos);

		if ($buscar_numeroInscritos >= $limiteInscritos) {
  			echo "<script>alert('Limite de inscritos atingido!');window.location.href='ficaFilaEspera.php?cod=$cod_evento'</script>";
  		}else {
  			$cadastrarInscricao = "INSERT INTO inscricaoevento(cod_evento, situacao, cod_usuario) VALUES ('$cod_evento', 'Inscrito', '$cod_user')";
			$resultadoCadastrar = mysqli_query($conexao, $cadastrarInscricao);

			if ($resultadoCadastrar) {
				echo "<script>alert('Usuário inscrito no evento com sucesso!');window.location.href='page_user.php'</script>";
			}else{
				echo "erro";
				echo $cadastrarInscricao;
			}
		}
	}	
?>
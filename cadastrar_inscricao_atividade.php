<?php
	session_start();
	include_once 'conexao.php';
	$cod_atividade = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
  	$limiteInscritos = filter_input(INPUT_GET, 'limiteInscritos', FILTER_SANITIZE_NUMBER_INT);
  	$cod_user = $_SESSION['id_user'];

  	// VERIFICAR SE A ATIVIDADE ESCOLHIDA TEM UM NUMERO MÁXIMO DE PARTICIPANTES NULL

  	if(empty($limiteInscritos)){
  		$cadastrar_inscricao = "INSERT INTO inscricaoatividade(codAtividade, situacao, codUsuario) VALUES ('$cod_atividade', 'Inscrito', '$cod_user')";
		$resultado_cadastrar = mysqli_query($conexao, $cadastrar_inscricao);

		if ($resultado_cadastrar) {
			echo "<script>alert('Usuário inscrito no evento com sucesso!');window.location.href='page_user.php'</script>";
		}
	}else{
		// NESSE CASO, PRECISA-SE VERIFICAR SE O NÚMERO MÁXIMO DE PARTICIPANTES JÁ ESTÁ ESGOTADO
  		$buscar_numeroInscritos = "SELECT COUNT(*) FROM `inscricaoatividade` WHERE codAtividade = '$cod_atividade'";
  		$resultado_busca = mysqli_query($conexao, $buscar_numeroInscritos);
  		$linha = mysqli_num_rows($resultado_busca);
		if ($linha >= $limiteInscritos) {
  			echo "<script>alert('Limite de inscritos atingido!');window.location.href='ficaFilaEsperaAtividade.php?cod=$cod_atividade'</script>";
  			//echo "Numero de inscritos: ".$linha."<br>"."é maior que o limite".$limiteInscritos;
  		}else {
  			$cadastrarInscricao = "INSERT INTO inscricaoatividade(codAtividade, situacao, codUsuario) VALUES ('$cod_atividade', 'Inscrito', '$cod_user')";
			$resultadoCadastrar = mysqli_query($conexao, $cadastrarInscricao);
			if ($resultadoCadastrar) {
				echo "<script>alert('Usuário inscrito no evento com sucesso!');window.location.href='page_user.php'</script>";
			}else{
				echo "erro";
				echo $cadastrarInscricao;
			}
			//echo "Numero de inscritos: ".$linha."<br>"."não é maior que o limite".$limiteInscritos;

		}
	}	
?>
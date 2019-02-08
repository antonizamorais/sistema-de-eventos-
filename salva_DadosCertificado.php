<?php 
	session_start();
	include 'conexao.php';

	$text = $_SESSION['texto'];
	$cod = $_SESSION['codigo'];
	$back = $_SESSION['layout'];
	$codE = $_SESSION['evento'];
	// chamando os arquivos necessários do DOMPdf
	require_once 'dompdf/lib/html5lib/Parser.php';
	require_once 'dompdf/lib/php-font-lib-master/src/FontLib/Autoloader.php';
	require_once 'dompdf/lib/php-svg-lib-master/src/autoload.php';
	require_once 'dompdf/src/Autoloader.php';

	// definindo os namespaces
	Dompdf\Autoloader::register();
	use Dompdf\Dompdf;

	// inicializando o objeto Dompdf
	$dompdf = new Dompdf();

	// coloque nessa variável o código HTML que você quer que seja inserido no PDF
	$codigo_html = "
	<html>
	<head>
	<style>
	body {
		background: url('upload/$back') no-repeat  center;
	}
	h6{ 
    	display: block;
    	font-size: 2em;
    	margin-top: 0;
    	margin-left: 5%;
	}
	p{ 
    	display: block;
    	font-size: 1.5em;
    	margin-top: 20%;
  		text-align: justify;
  		width: 90%;
  		margin-left: 5%;
	}
	</style>
	</head>
	<body>
	<form>
  	<div class='row'>
    	<div class='col'>
      		<h6>".$cod."</h6>
   		</div>
    	<div class='col'>
      		<center><p>".$text."</p></center>
    	</div>
  	</div>
	</form>
	</body>
	</html>
	";
	echo $codigo_html;

	// carregamos o código HTML no nosso arquivo PDF
	$dompdf->loadHtml($codigo_html);

	// (Opcional) Defina o tamanho (A4, A3, A2, etc) e a oritenação do papel, que pode ser 'portrait' (em pé) ou 'landscape' (deitado)
	$dompdf->setPaper('A4', 'landscape');

	// Renderizar o documento
	$dompdf->render();

	// pega o código fonte do novo arquivo PDF gerado
	$output = $dompdf->output();

	// defina aqui o nome do arquivo que você quer que seja salvo
	$certif = file_put_contents($cod.".pdf", $output);

	//header('Location: http://localhost/sistema-de-eventos/sistema-de-eventos--master/criar_certificadosEventos_listaEventos.php'); 
	// redirecionamos o usuário para o download do arquivo
	die("<script>location.href='$cod.pdf';</script>");


?>
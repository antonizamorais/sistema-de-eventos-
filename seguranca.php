<?php
	ob_start();
	if (($_SESSION['id_user'] == "") || ($_SESSION['email_user'] == "") || ($_SESSION['tipo_user'] == "")|| ($_SESSION['senha_user'] == "")){
		unset($_SESSION['nome_user'],
              $_SESSION['id_user'], 
              $_SESSION['email_user'], 
              $_SESSION['senha_user'], 
              $_SESSION['tipo_user']);
		header("Location: login.php");
	}
?>
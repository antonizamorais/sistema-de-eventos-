<?php 
$servidor = 'localhost';
$usuario = 'root';
$senha = '';
$banco = 'sistema_eventos';

header('Content-Type: text/html; charset=utf-8');
$conexao = mysqli_connect($servidor, $usuario,$senha);
$sql_banco = mysqli_select_db($conexao, $banco);
mysqli_query($conexao, "SET NAMES 'utf8'");

?>
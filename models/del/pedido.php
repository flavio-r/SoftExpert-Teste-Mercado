<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

header("Content-Type: text/html; charset=utf-8",true);

//Chama classe Banco de Dados
require '../mypublic.php';

//Cria um nova conexão
$con = new BD;

//PEGA DADOS ENVIADOS VIA POST E TRANSFORMA EM ARRAY
foreach ($_POST as $key => $value)
{
	$dados[$key] = htmlspecialchars($value);
	$dados[$key] = addslashes(mysql_escape_string($value));
}

//FAZ EXCLUSÃO NO BANCO DE DADOS
$results = $con->query("DELETE FROM pedidos WHERE idpedido='$dados[idpedido]'");
if($results)
{
	echo 'Produto excluído com sucesso.';
	// AQUI APENAS PARA MANTER UMA NAVEGAÇÃO PARA APRESENTAÇÃO
	echo '<BR>';
	echo '<a href="../../get-pedidos.php">Voltar</a>';
}
//Encerra conexão
$con->free_result();
?>
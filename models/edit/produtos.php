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

//FAZ ATUALIZAÇÃO NO BANCO DE DADOS
$results = $con->query("UPDATE produtos SET idcat='$dados[idcat]', produto='$dados[produto]', valor='$dados[valor]', imposto='$dados[imposto]' WHERE idproduto='$dados[idproduto]'");
if($results)
{
	echo 'Cadastro atualizado com sucesso.';
	// AQUI APENAS PARA MANTER UMA NAVEGAÇÃO PARA APRESENTAÇÃO
	echo '<BR>';
	echo '<a href="../../get-produtos.php">Voltar</a>';
}
//Encerra conexão
$con->free_result();
?>
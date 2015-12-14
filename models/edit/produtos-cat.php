<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

header("Content-Type: text/html; charset=utf-8",true);

//Chama classe DB
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
$results = $con->query("UPDATE produtos_cats SET categoria='$dados[categoria]' WHERE idcat='$dados[idcat]'");
if($results)
{
	echo 'Cadastro atualizado com sucesso.';
	// AQUI APENAS PARA MANTER UMA NAVEGAÇÃO PARA APRESENTAÇÃO
	echo '<BR>';
	echo '<a href="../../get-produtos-cat.php">Voltar</a>';
}
//Encerra conexão
$con->free_result();
?>
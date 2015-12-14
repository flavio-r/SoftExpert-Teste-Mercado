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

//REALIZA CÁLCULOS DE SUBTOTAL E IMPOSTOS
$subtotal = number_format(($dados[qtd] * $dados[valor]), 2, ".", "");
$subtotal_impostos = number_format((($dados[valor] * $dados[imposto] / 100) * $dados[qtd]), 2, ".", "");

//FAZ INSERÇÃO NO BANCO DE DADOS
$results = $con->query("INSERT INTO pedidos (idpedido, idproduto, produto, valor, imposto, qtd, subtotal, subtotal_impostos) VALUES (NULL,'$dados[idproduto]','$dados[produto]','$dados[valor]','$dados[imposto]','$dados[qtd]','$subtotal','$subtotal_impostos')");
if($results)
{
	echo 'Produto adicionado com sucesso.';
	// AQUI APENAS PARA MANTER UMA NAVEGAÇÃO PARA APRESENTAÇÃO
	echo '<BR>';
	echo '<a href="../../get-pedidos.php">Voltar</a>';
}
//Encerra conexão
$con->free_result();
?>
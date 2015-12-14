<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

header("Content-Type: text/html; charset=utf-8",true);

//Cria um nova conexão
$con = new BD;

//PEGA TODOS OS REGISTROS DA TABELA ORDENADOS PELA CATEGORIA E TRANSFORMA EM ARRAY
$con->query("SELECT idpedido, idproduto, produto, valor, imposto, qtd, subtotal, subtotal_impostos FROM pedidos ORDER BY idpedido ASC");
while ($con->next_record())
{
	$dados_ped[idpedido][] 			= stripcslashes(stripslashes($con->f("idpedido")));
	$dados_ped[idproduto][] 		= stripcslashes(stripslashes($con->f("idproduto")));
	$dados_ped[produto][] 			= stripcslashes(stripslashes($con->f("produto")));
	$dados_ped[valor][] 			= stripcslashes(stripslashes($con->f("valor")));
	$dados_ped[imposto][] 			= stripcslashes(stripslashes($con->f("imposto")));
	$dados_ped[qtd][] 				= stripcslashes(stripslashes($con->f("qtd")));
	$dados_ped[subtotal][]			= stripcslashes(stripslashes($con->f("subtotal")));
	$dados_ped[subtotal_impostos][]	= stripcslashes(stripslashes($con->f("subtotal_impostos")));

	//SOMA TOTAIS
	$dados_ped[soma_total_impostos] += $con->f("subtotal_impostos");
	$dados_ped[soma_total] += $con->f("subtotal");
}
//Encerra conexão
$con->free_result();
?>
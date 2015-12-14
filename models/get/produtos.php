<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

header("Content-Type: text/html; charset=utf-8",true);

//Cria um nova conexão
$con = new BD;

//SE TIVER UMA IDE BUSCA APENAS 1 PRODUTO
if(isset($id_prod))
{
	$con->query("SELECT idproduto, idcat, produto, valor, imposto FROM produtos WHERE idproduto='$id_prod'");
	$con->next_record();
	
	$dados_prod[idproduto] 	= stripcslashes(stripslashes($con->f("idproduto")));
	$dados_prod[idcat] 		= stripcslashes(stripslashes($con->f("idcat")));
	$dados_prod[produto] 	= stripcslashes(stripslashes($con->f("produto")));
	$dados_prod[valor] 		= stripcslashes(stripslashes($con->f("valor")));
	$dados_prod[imposto]		= stripcslashes(stripslashes($con->f("imposto")));
}
else
{
	//PEGA TODOS OS REGISTROS DA TABELA ORDENADOS PELA CATEGORIA E TRANSFORMA EM ARRAY
	$con->query("SELECT p.idproduto, p.idcat, c.categoria, p.produto, p.valor, p.imposto FROM produtos AS p, produtos_cats AS c WHERE p.idcat=c.idcat ORDER BY c.categoria, p.produto ASC");
	while ($con->next_record())
	{
		$dados_prod[idproduto][] 	= stripcslashes(stripslashes($con->f("idproduto")));
		$dados_prod[idcat][] 	= stripcslashes(stripslashes($con->f("idcat")));
		$dados_prod[categoria][] 	= stripcslashes(stripslashes($con->f("categoria")));
		$dados_prod[produto][] 		= stripcslashes(stripslashes($con->f("produto")));
		$dados_prod[valor][] 		= stripcslashes(stripslashes($con->f("valor")));
		$dados_prod[imposto][]		= stripcslashes(stripslashes($con->f("imposto")));
	}
}
//Encerra conexão
$con->free_result();
?>
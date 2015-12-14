<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

header("Content-Type: text/html; charset=utf-8",true);

//Cria um nova conexão
$con = new BD;

//SE TIVER UMA IDE BUSCA APENAS 1 PRODUTO
if(isset($id))
{
	$con->query("SELECT idcat, categoria FROM produtos_cats WHERE idcat='$id'");
	$con->next_record();

	$dados_cat[idcat] 		= stripcslashes(stripslashes($con->f("idcat")));
	$dados_cat[categoria] 	= stripcslashes(stripslashes($con->f("categoria")));
}
else
{
	//PEGA TODOS OS REGISTROS DA TABELA ORDENADOS PELA CATEGORIA E TRANSFORMA EM ARRAY
	$con->query("SELECT idcat, categoria FROM produtos_cats ORDER BY categoria ASC");
	while ($con->next_record())
	{
		$dados_cat[idcat][] 		= stripcslashes(stripslashes($con->f("idcat")));
		$dados_cat[categoria][] 	= stripcslashes(stripslashes($con->f("categoria")));
	}
}
//Encerra conexão
$con->free_result();
?>
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

header("Content-Type: text/html; charset=utf-8",true);

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SoftExpert - Teste - Mercado</title>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
	<div class="col-md-4">
		<button type="button" class="btn btn-default navbar-btn" onclick="javascript:location.href='get-produtos-cat.php';">Categorias</button>
		<button type="button" class="btn btn-default navbar-btn" onclick="javascript:location.href='get-produtos.php';">Produtos</button>
		<button type="button" class="btn btn-default navbar-btn" onclick="javascript:location.href='get-pedidos.php';">Pedidos</button>
	</div>
</body>
</html>
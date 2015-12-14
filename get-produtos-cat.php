
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

header("Content-Type: text/html; charset=utf-8",true);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Listagem - Categoria - Produtos</title>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
	<div class="col-md-4">
		<button type="button" class="btn btn-default navbar-btn" onclick="javascript:location.href='get-produtos-cat.php';">Categorias</button>
		<button type="button" class="btn btn-default navbar-btn" onclick="javascript:location.href='get-produtos.php';">Produtos</button>
		<button type="button" class="btn btn-default navbar-btn" onclick="javascript:location.href='get-pedidos.php';">Pedidos</button>
	</div>
	<div class="col-md-8">
	<button type="button" class="btn" onclick="javascript:location.href = 'add-produtos-cat.php';">Adicionar</button>
		<?php
		// BUSCA REGISTROS NA TABELA
		include 'models/mypublic.php';
		include 'models/get/produtos-cat.php';
		?>
	 	 <table class="table table-striped">
		    <thead>
		      <tr>
		        <th>Categoria</th>
		        <th>Ações</th>
		      </tr>
		    </thead>
		    <tbody>
		    <?php
		    if($dados_cat[categoria])
		    {
		    	foreach ($dados_cat[categoria] as $key => $value) {
		    ?>
		      <tr>
		        <td><?=$value;?></td>
		        <td><a href="edit-produtos-cat.php?id=<?=$dados_cat[idcat][$key];?>">Editar</a> | <a href="del-produtos-cat.php?id=<?=$dados_cat[idcat][$key];?>">Excluir</a></td>
		      </tr>
		    <?php } } ?>
		    </tbody>
		 </table>
	</div>
</body>
</html>
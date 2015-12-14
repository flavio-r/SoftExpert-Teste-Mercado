
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

header("Content-Type: text/html; charset=utf-8",true);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Listagem - Produtos</title>
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
	<button type="button" class="btn" onclick="javascript:location.href = 'add-produtos.php';">Adicionar</button>
		<?php
		// BUSCA REGISTROS NA TABELA
		include 'models/mypublic.php';
		include 'models/get/produtos.php';
		?>
	 	 <table class="table table-striped">
		    <thead>
		      <tr>
		        <th>Categoria</th>
		        <th>Produto</th>
		        <th>Valor</th>
		        <th>Imposto</th>
		        <th>Ações</th>
		        <th>Pedido</th>
		      </tr>
		    </thead>
		    <tbody>
		    <?php
		    if($dados_prod[produto])
		    {
		    	foreach ($dados_prod[produto] as $key => $value) {
		    ?>
		      <tr>
		        <td><?=$dados_prod[categoria][$key];?></td>
		        <td><?=$dados_prod[produto][$key];?></td>
		        <td>R$<?=$dados_prod[valor][$key];?></td>
		        <td><?=$dados_prod[imposto][$key];?>%</td>
		        <td><a href="edit-produtos.php?id=<?=$dados_prod[idproduto][$key];?>">Editar</a> | <a href="del-produtos.php?id=<?=$dados_prod[idproduto][$key];?>">Excluir</a></td>
		        <td><a href="add-pedidos.php?id=<?=$dados_prod[idproduto][$key];?>">Incluir</a></td>
		      </tr>
		    <?php } } ?>
		    </tbody>
		 </table>
	</div>
</body>
</html>
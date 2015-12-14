
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

header("Content-Type: text/html; charset=utf-8",true);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Listagem - Pedidos</title>
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
	<button type="button" class="btn" onclick="javascript:location.href = 'get-produtos.php';">Adicionar</button>
		<?php
		// BUSCA REGISTROS NA TABELA
		include 'models/mypublic.php';
		include 'models/get/pedidos.php';
		?>
	 	 <table class="table table-striped">
		    <thead>
		      <tr>
		        <th>Produto</th>
		        <th>Quantidade</th>
		        <th>Valor</th>
		        <th>Impostos</th>
		        <th>Subtotal</th>
		        <th>Subtotal Impostos</th>
		        <th>Ação</th>
		      </tr>
		    </thead>
		    <tbody>
		    <?php
		    if($dados_ped[idpedido])
		    {
		    	foreach ($dados_ped[idpedido] as $key => $value) {
		    ?>
		      <tr>
		        <td><?=$dados_ped[produto][$key];?></td>
		        <td><?=$dados_ped[qtd][$key];?></td>
		        <td>R$<?=$dados_ped[valor][$key];?></td>
		        <td><?=$dados_ped[imposto][$key];?>%</td>
		        <td>R$<?=$dados_ped[subtotal][$key];?></td>
		        <td>R$<?=$dados_ped[subtotal_impostos][$key];?></td>
		        <td><a href="del-pedido.php?id=<?=$dados_ped[idpedido][$key];?>">Excluir</a></td>
		      </tr>
		    <?php } } ?>
		    </tbody>
		 </table>
		 <div class="col-md-4">
			 <table class="table table-striped">
			    <thead>
			      <tr>
			        <th>Total Impostos</th>
			        <th>Total Compra</th>
			      </tr>
			    </thead>
			    <tbody>
			      <tr>
			        <td><b>R$<?=number_format($dados_ped[soma_total_impostos],2,",",".");?></b></td>
			        <td><b>R$<?=number_format($dados_ped[soma_total],2,",",".");?></b></td>
			      </tr>
			    </tbody>
			 </table>
		</div>
	</div>
</body>
</html>
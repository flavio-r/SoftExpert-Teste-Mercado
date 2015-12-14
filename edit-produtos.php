<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");

header("Content-Type: text/html; charset=utf-8",true);

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Editar - Produtos</title>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
	<div class="col-md-4">
	 	<?php
		// BUSCA REGISTRO NA TABELA
		$id_prod = $_GET[id];
		include 'models/mypublic.php';
		include 'models/get/produtos.php';
		?>
	 	<form role="form" action="models/edit/produtos.php" method="post">
	 	<input type="hidden" name="idproduto" value="<?=$dados_prod[idproduto];?>">
	  	<div class="form-group">
	    	<label for="categoria">Categoria:</label>
	    	<select class="form-control" name="idcat">
	    	<?php
			// BUSCA REGISTROS NA TABELA
			include 'models/get/produtos-cat.php';
			foreach ($dados_cat[categoria] as $key => $value) {
			?>
	    	<option value="<?=$dados_cat[idcat][$key];?>" <?php if($dados_cat[idcat][$key] == $dados_prod[idcat]) { echo 'selected'; } ?>><?=$value;?></option>
	    	<?php } ?>
	    	</select>
	  	</div>
	  	<div class="form-group">
	    	<label for="categoria">Produto:</label>
	    	<input type="text" class="form-control" name="produto" value="<?=$dados_prod[produto];?>">
	  	</div>
	  	<div class="form-group">
	    	<label for="categoria">Valor:</label>
	    	<input type="text" class="form-control" name="valor" value="<?=$dados_prod[valor];?>" placeholder="R$00.00" >
	  	</div>
	  	<div class="form-group">
	    	<label for="categoria">Importo:</label>
	    	<input type="text" class="form-control" name="imposto" value="<?=$dados_prod[imposto];?>" placeholder="00" >
	  	</div>
	  	<button type="submit" class="btn btn-default">Enviar</button>
		</form>
	</div>
</body>
</html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cadastro - Produto</title>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
	<div class="col-md-4">
	 	<form role="form" action="models/add/produtos.php" method="post">
	  	<div class="form-group">
	    	<label for="categoria">Categoria:</label>
	    	<select class="form-control" name="idcat">
	    	<?php
			// BUSCA REGISTROS NA TABELA
			include 'models/mypublic.php';
			include 'models/get/produtos-cat.php';
			foreach ($dados_cat[categoria] as $key => $value) {
			?>
	    	<option value="<?=$dados_cat[idcat][$key];?>"><?=$value;?></option>
	    	<?php } ?>
	    	</select>
	  	</div>
	  	<div class="form-group">
	    	<label for="categoria">Produto:</label>
	    	<input type="text" class="form-control" name="produto">
	  	</div>
	  	<div class="form-group">
	    	<label for="categoria">Valor:</label>
	    	<input type="text" class="form-control" name="valor" placeholder="R$00.00" >
	  	</div>
	  	<div class="form-group">
	    	<label for="categoria">Importo:</label>
	    	<input type="text" class="form-control" name="imposto" placeholder="00" >
	  	</div>
	  	<button type="submit" class="btn btn-default">Enviar</button>
		</form>
	</div>
</body>
</html>
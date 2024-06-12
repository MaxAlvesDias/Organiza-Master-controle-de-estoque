<h1>Produtos - Adicionar</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">
	<label for="name">Nome</label><br/>
	<input type="text" id="name" name="name" required/><br/><br/>

	<label for="price">Preço</label><br/>
	<input type="text" id="price" name="price" required/><br/><br/>

	<label for="quantity">Quantidade em Estoque</label><br/>
	<input type="number" id="quantity" name="quantity" required/><br/><br/>

	<label for="min_quantity">Quantidade Mínima em Estoque</label><br/>
	<input type="number" id="min_quantity" name="min_quantity" required/><br/><br/>


	<input type="submit" value="Adicionar"/>
</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/script_inventory_add.js"></script>
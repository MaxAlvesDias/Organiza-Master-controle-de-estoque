<h1>Fornecedores - Editar</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">
	<label for="name">Nome</label><br/>
	<input type="text" name="name" required value="<?php echo $reseller_info['name'] ?>"/><br/><br/>

	<label for="email">E-mail</label><br/>
	<input type="text" name="email" value="<?php echo $reseller_info['email'] ?>"/><br/><br/>

	<label for="phone">Telefone</label><br/>
	<input type="text" name="phone" value="<?php echo $reseller_info['phone'] ?>"/><br/><br/>

	<br/><br/>
	<input type="submit" value="Salvar"/>
</form>
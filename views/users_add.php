<h1>Usuários - Adicionar</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">
	<label for="name">Nome</label><br/>
	<input type="text" name="name" required/><br/><br/>

	<label for="email">E-mail</label><br/>
	<input type="text" name="email" required/><br/><br/>

	<label for="password">Senha</label><br/>
	<input type="text" name="password" required/><br/><br/>

	<label for="group">Grupo de Permissões:</label><br/>
	<select name="group" id="group">
		<?php foreach($group_list as $group): ?>
		<option value="<?php echo $group['id']; ?>"><?php echo $group['name']; ?></option>
		<?php endforeach; ?>
	</select>

	<br/><br/>
	<input type="submit" value="Adicionar"/>
</form>
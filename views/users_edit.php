<h1>Usuários - Editar</h1>

<?php if(isset($error_msg) && !empty($error_msg)): ?>
<div class="warn"><?php echo $error_msg; ?></div>
<?php endif; ?>

<form method="POST">
	<label for="email">E-mail</label><br/>
	<input type="text" name="email" value="<?php echo $user_info['email'] ?>" readonly/><br/><br/>

	<label for="name">Nome</label><br/>
	<input type="text" name="name" required value="<?php echo $user_info['name'] ?>"/><br/><br/>

	<label for="password">Senha</label><br/>
	<input type="text" name="password"/><br/><br/>

	<label for="group">Grupo de Permissões:</label><br/>
	<select name="group" id="group">
		<?php foreach($group_list as $group): ?>
		<option value="<?php echo $group['id']; ?>" <?php echo ($group['id']== $user_info['id_group'])?'selected':''; ?>><?php echo $group['name']; ?></option>
		<?php endforeach; ?>
	</select>

	<br/><br/>
	<input type="submit" value="Salvar"/>
</form>
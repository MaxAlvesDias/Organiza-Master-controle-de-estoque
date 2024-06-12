<h1>Permissões - Adicionar Grupo</h1>

<form method="POST">
	<label for="name">Nome do Grupo de Permissões</label><br/>
	<input type="text" name="name"/><br/><br/>

	<label>Permissões:</label><br/><br/>
	<?php foreach($permissions_group_list as $p): ?>
	<div class="permissions-item">
		<input type="checkbox" name="permissions[]" value="<?php echo $p['id']; ?>" id="p_<?php echo $p['id']; ?>"/>
		<label for="p_<?php echo $p['id']; ?>"><?php echo $p['name']; ?></label>
	</div>
	<?php endforeach; ?>

	<input type="submit" value="Adicionar"/>
</form>

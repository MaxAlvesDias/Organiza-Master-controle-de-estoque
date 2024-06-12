<h1>Permissões - Editar Grupo</h1>

<form method="POST">
	<label for="name">Nome do Grupo de Permissões</label><br/>
	<input type="text" name="name" value="<?php echo $group_info['name']; ?>" /><br/><br/>

	<label>Permissões:</label><br/><br/>
	<?php foreach($permissions_group_list as $p): ?>
	<div class="permissions-item">
		<input type="checkbox" name="permissions[]" value="<?php echo $p['id']; ?>" id="p_<?php echo $p['id']; ?>" <?php echo (in_array($p['id'], $group_info['params']))?'checked="checked"':''; ?>/>
		<label for="p_<?php echo $p['id']; ?>"><?php echo $p['name']; ?></label>
	</div>
	<?php endforeach; ?>

	<input type="submit" value="Salvar"/>
</form>

<h1>Usuários</h1>

<a href="<?php echo BASE_URL; ?>/users/add" class="button">
	<div class="button">Adicionar Usuário</div>
</a>

<table border="0" width="100%">
	<tr>
		<th width="">Usuário</th>
		<th width="">E-mail</th>
		<th width="">Grupo de Permissões</th>
		<th width="" style="text-align:center;">Ações</th>
	</tr>
		<?php foreach($users_list as $user): ?>
		<tr>
			<td width="250"><?php echo $user['name']; ?></td>
			<td width="120"><?php echo $user['email']; ?></td>
			<td style="text-align:center;width:160px;"><?php echo $user['p_name']; ?></td>
			<td style="width:160px;text-align:center;">		
				<a href="<?php echo BASE_URL; ?>/users/edit/<?php echo $user['id'];?>">
					<div class="button button-small">Editar</div>
				</a>
				
				<a href="<?php echo BASE_URL; ?>/users/delete/<?php echo $user['id'];?>" onclick="return confirm('Deseja realmente excluir?')">
					<div class="button button-small">Excluir</div>
				</a>
			</td>
		</tr>	
	<?php endforeach; ?>
</table>
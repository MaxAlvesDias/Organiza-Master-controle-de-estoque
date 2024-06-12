<h1>Permissões</h1>

<div class="tab-area">
	<div class="tab-item active-tab">
		Grupo de permissões
	</div>
	<div class="tab-item">
		Permissões
	</div>
</div>

<div class="tab-content">
	<div class="tab-body">
		<a href="<?php echo BASE_URL; ?>/permissions/add_group" class="button">
				<div class="button">Adicionar Grupo de Permissões</div>
		</a>

		<table border="0" width="100%">
			<tr>
				<th>Nome do Grupo</th>
				<th style="text-align:center;">Ações</th>
			</tr>
			<?php foreach($permissions_group_list as $permission): ?>
			<tr>	
				<td><?php echo $permission['name']; ?></td>
				<td width="160">
					<a href="<?php echo BASE_URL; ?>/permissions/edit_group/<?php echo $permission['id'];?>">
						<div class="button button-small">Editar</div>
					</a>

					<a href="<?php echo BASE_URL; ?>/permissions/delete_group/<?php echo $permission['id'];?>" onclick="return confirm('Deseja realmente excluir?')">
						<div class="button button-small">Excluir</div>
					</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<div class="tab-body">
		<div class="button">
			<a href="<?php echo BASE_URL; ?>/permissions/add" class="button">Adicionar Permissão</a>
		</div>
		
		<table border="0" width="100%">
			<tr>
				<th>Nome da Permissão</th>
				<th style="text-align:center;">Ações</th>
			</tr>
			<?php foreach($permissions_list as $permission): ?>
			<tr>	
				<td><?php echo $permission['name']; ?></td>
				<td width="80">
					<a href="<?php echo BASE_URL; ?>/permissions/delete/<?php echo $permission['id'];?>" onclick="return confirm('Deseja realmente excluir?')">
						<div class="button button-small">Excluir</div>
					</a>	
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>

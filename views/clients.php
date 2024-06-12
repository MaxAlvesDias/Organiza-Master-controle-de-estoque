<h1>Clientes</h1>

<?php if($edit_permission): ?>
<a href="<?php echo BASE_URL; ?>/clients/add" class="button">
	<div class="button">Adicionar Cliente</div>
</a>
<?php endif; ?>

<input type="text" id="search" data-type="searchClients"/>
		
<table border="0" width="100%">
	<tr>
		<th>Nome</th>
		<th>E-mail</th>
		<th>Telefone</th>
		<th>Cidade</th>
		<th>Estrelas</th>
		<th width="160" style="text-align:center;">Ações</th>
	</tr>
		<?php foreach($clients_list as $client): ?>
		<tr>
			<td><?php echo $client['name']; ?></td>
			<td><?php echo $client['email']; ?></td>
			<td><?php echo $client['phone']; ?></td>
			<td><?php echo $client['address_city']; ?></td>
			<td style="text-align: center;"><?php echo $client['stars']; ?></td>
			<td style="text-align: center;">
				<?php if($edit_permission): ?>
				<a href="<?php echo BASE_URL; ?>/clients/edit/<?php echo $client['id'];?>">
					<div class="button button-small">Editar</div>
				</a>
	
				<a href="<?php echo BASE_URL; ?>/clients/delete/<?php echo $client['id'];?>" onclick="return confirm('Deseja realmente excluir?')">
					<div class="button button-small">Excluir</div>
				</a>
				<?php else: ?>
				<a href="<?php echo BASE_URL; ?>/clients/view/<?php echo $client['id'];?>">
					<div class="button button-small">Vizualizar</div>
				</a>
				<?php endif; ?>
			</td>
		</tr>	
	<?php endforeach; ?>
</table>

<div class="pagination">
	<?php for($i=1; $i<=$page_count; $i++): ?>
		<div class="page_item <?php echo($i==$p)?'page_active':''; ?>"><a href="<?php echo BASE_URL; ?>/clients?page=<?php echo $i; ?>"><?php echo $i; ?></a></div>
	<?php endfor; ?>
</div>

<div style="clear:both;"></div>
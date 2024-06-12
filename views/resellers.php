<h1>Fornecedores</h1>

<?php if($edit_permission): ?>
<a href="<?php echo BASE_URL; ?>/resellers/add" class="button">
	<div class="button">Adicionar Fornecedor</div>
</a>
<?php endif; ?>

<input type="text" id="search" data-type="searchResellers"/>
		
<table border="0" width="100%">
	<tr>
		<th>Nome</th>
		<th>E-mail</th>
		<th>Telefone</th>
		<th width="160" style="text-align:center;">Ações</th>
	</tr>
		<?php foreach($resellers_list as $reseller): ?>
		<tr>
			<td><?php echo $reseller['name']; ?></td>
			<td><?php echo $reseller['email']; ?></td>
			<td><?php echo $reseller['phone']; ?></td>
			<td style="text-align: center;">
			<?php if($edit_permission): ?>
			<a href="<?php echo BASE_URL; ?>/resellers/edit/<?php echo $reseller['id'];?>">
				<div class="button button-small">Editar</div>
			</a>
			<a href="<?php echo BASE_URL; ?>/resellers/delete/<?php echo $reseller['id'];?>" onclick="return confirm('Deseja realmente excluir?')">
				<div class="button button-small">Excluir</div>
			</a>
			<?php else: ?>
			<a href="<?php echo BASE_URL; ?>/resellers/view/<?php echo $reseller['id'];?>">
				<div class="button button-small">Visualizar</div>
			</a>	
			<?php endif; ?>
			</td>
		</tr>	
	<?php endforeach; ?>
</table>

<div class="pagination">
	<?php for($i=1; $i<=$page_count; $i++): ?>
		<div class="page_item <?php echo($i==$p)?'page_active':''; ?>"><a href="<?php echo BASE_URL; ?>/resellers?page=<?php echo $i; ?>"><?php echo $i; ?></a></div>
	<?php endfor; ?>
</div>

<div style="clear:both;"></div>
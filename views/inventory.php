<h1>Estoque</h1>

<?php if($add_permission): ?>
<a href="<?php echo BASE_URL; ?>/inventory/add" class="button">
	<div class="button">Adicionar Produto</div>
</a>
<?php endif; ?>

<input type="text" id="search" data-type="search_inventory"/>

<table border="0" width="100%">
	<tr>
		<th>Nome</th>
		<th style="text-align:center;">Preço</th>
		<th style="text-align:center;">Quantidade</th>
		<th style="text-align:center;">Quantidade Minima</th>
		<th width="160" style="text-align:center;">Ações</th>
	</tr>
	<?php foreach($inventory_list as $product): ?>
		<tr>
			<td><?php echo $product['name']; ?></td>
			<td style="text-align:center;">R$<?php echo number_format($product['price'], 2, ',', '.'); ?></td>
			<td style="text-align:center;"><?php 
				if($product['min_quantity'] > $product['quantity']){
					echo "<span style='color:red'>".($product['quantity'])."</span>";
				} else {
					echo $product['quantity']; 
				} ?>
			<td style="text-align:center;"><?php echo $product['min_quantity']; ?></td>
			<td style="text-align: center;">
				<?php if($edit_permission): ?>
				<a href="<?php echo BASE_URL; ?>/inventory/edit/<?php echo $product['id'];?>">
					<div class="button button-small">Editar</div>
				</a>		
				<a href="<?php echo BASE_URL; ?>/inventory/delete/<?php echo $product['id'];?>" onclick="return confirm('Deseja realmente excluir?')">
					<div class="button button-small">Excluir</div>
				</a>
				<?php else: ?>
				<a href="<?php echo BASE_URL; ?>/inventory/view/<?php echo $product['id'];?>">
					<div class="button button-small">Visualizar</div>
				</a>
				<?php endif; ?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
<h1>Compras</h1>

<a href="<?php echo BASE_URL; ?>/purchases/add" class="button">
	<div class="button">Adicionar Compra</div>
</a>


<table border="0" width="100%">
	<tr>
		<th>Nome do Cliente</th>
		<th style="text-align:center;width:150px;">Valor</th>
		<th style="text-align:center;width:100px;">Data</th>
		<th style="text-align:center;width:100px;">Ações</th>
	</tr>
	<?php foreach($purchases_list as $purchase): ?>
		<tr>
			<td><?php echo $purchase['name']; ?></td>
			<td style="text-align:center;">R$<?php echo number_format($purchase['total_price'], 2, ",", ".") ; ?></td>
			<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($purchase['date_purchase'])); ?></td>
			<td style="text-align:center;">	
				<a href="<?php echo BASE_URL; ?>/purchases/edit/<?php echo $purchase['id'];?>">
					<div class="button button-small">Visualizar</div>
				</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
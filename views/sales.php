<h1>Vendas</h1>

<a href="<?php echo BASE_URL; ?>/sales/add" class="button">
	<div class="button">Adicionar Venda</div>
</a>

<table border="0" width="100%">
	<tr>
		<th width="200">Nome do Cliente</th>
		<th style="width:50px;text-align:center;">Valor</th>
		<th style="text-align:center; width:50px;">Data</th>
		<th style="width:50px;text-align:center;">Status</th>
		<th style="text-align:center;width:50px;">Ações</th>
	</tr>
	<?php foreach($sales_list as $sale): ?>
		<tr>
			<td><?php echo $sale['name']; ?></td>
			<td style="text-align:center;">R$<?php echo number_format($sale['total_price'], 2, ",", ".") ; ?></td>
			<td style="text-align:center;"><?php echo date('d/m/Y', strtotime($sale['date_sale'])); ?></td>
			<td style="text-align:center;"><?php echo $statuses[$sale['status']]; ?></td>
			<td style="text-align:center; width:50px;">	
				<a href="<?php echo BASE_URL; ?>/sales/edit/<?php echo $sale['id'];?>">
					<div class="button button-small">Visualizar</div>
				</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
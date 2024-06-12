<h1>Vendas - Editar</h1>

<strong>Nome do Cliente</strong><br/>
<?php echo $sales_info['info']['client_name']; ?><br/><br/>

<strong>Data da Venda</strong><br/>
<?php echo date('d/m/Y', strtotime($sales_info['info']['date_sale'])); ?><br/><br/>

<strong>Total</strong><br/>
<?php echo number_format($sales_info['info']['total_price'], 2, ',', '.'); ?><br/><br/>

<strong>Status</strong><br/>
<?php if($permission_edit): ?>
<form method="POST">
	<select name="status">
		<?php foreach($statuses as $statusKey => $statusValue): ?>
		<option value="<?php echo $statusKey; ?>"<?php echo($statusKey==$sales_info['info']['status'])?'selected':''; ?>><?php echo $statusValue; ?></option>
		<?php endforeach; ?>
	</select><br/><br/>
	<input type="submit" value="Salvar"/>
</form>
<?php else: ?>
<?php echo $statuses[$sales_info['info']['status']]; ?>
<?php endif; ?>

<br/><hr/>

<table border="0" width="100%">
	<tr>
		<th>Nome do Produto</th>
		<th>Quantidade</th>
		<th>Preço Unitatio</th>
		<th>Preço Total</th>
	</tr>
	<?php foreach($sales_info['products'] as $product): ?>
		<tr>
			<td><?php echo $product['name']; ?></td>
			<td><?php echo $product['quantity']; ?></td>
			<td><?php echo number_format($product['sale_price'], 2, ",", "."); ?></td>
			<td><?php echo number_format($product['sale_price']*$product['quantity'], 2, ",", "."); ?></td>
		</tr>
	<?php endforeach; ?>
</table>
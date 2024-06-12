<?php
require_once __DIR__ . '/../libraries/dompdf/dompdf_config.inc.php';
$dompdf = new Dompdf\Dompdf(); // Corrigido para usar Dompdf\Dompdf
ob_start(); ?>

<h1>Relatório de Compras</h1>

<fieldset>
	<?php 
		if(count($filters) > 1) echo "Filtros:<br/>";
		if(isset($filters['reseller_name']) && !empty($filters['reseller_name'])){
			echo 'Revendedor: '.$filters['reseller_name']."<br/>";
		}
		if(isset($filters['period1']) && !empty($filters['period1']) && isset($filters['period2']) && !empty($filters['period2'])){
			echo 'Periodo: entre '.date('d/m/Y', strtotime($filters['period1']))." e ".date('d/m/Y', strtotime($filters['period2']))."<br/>";
		}
	?>
</fieldset>
<br/>

<table border="0" width="100%">
	<tr>
		<th style="text-align:left;">Nome do Revendedor</th>
		<th style="text-align:left;">Valor</th>
		<th style="text-align:left;">Data da Compra</th>
	</tr>
	<?php foreach($purchases_list as $purchase): ?>
		<tr>
			<td><?php echo $purchase['name']; ?></td>
			<td>R$<?php echo number_format($purchase['total_price'], 2, ",", ".") ; ?></td>
			<td><?php echo date('d/m/Y', strtotime($purchase['date_purchase'])); ?></td>
		</tr>
	<?php endforeach; ?>
</table>

<?php
$html = ob_get_contents();
ob_end_clean();

/* Carrega o HTML */
$dompdf->load_html($html);

/* Renderiza */
$dompdf->render();

/* Exibe */
$dompdf->stream("relatorio_de_compras.pdf", ["Attachment" => false]); // download set true
?>

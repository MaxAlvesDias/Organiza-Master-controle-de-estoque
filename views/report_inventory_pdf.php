<?php
require_once __DIR__ . '/../libraries/dompdf/dompdf_config.inc.php';
$dompdf = new Dompdf\Dompdf(); // Corrigido para usar Dompdf\Dompdf
ob_start(); 
?>

<h1>Relatório de Estoque</h1>

<fieldset>
	Intens com estoque abaixo do mínimo.
</fieldset>
<br/>

<table border="0" width="100%">
	<tr>
		<th style="text-align:left;">Nome</th>
		<th style="text-align:left;">Preço</th>
		<th style="text-align:center;">Quantidade</th>
		<th style="text-align:center;">Quantidade Mínima</th> <!-- Corrigido o nome do campo -->
	</tr>
	<?php foreach($inventory_list as $product): ?>
		<tr>
			<td style="text-align:left;"><?php echo $product['name']; ?></td>
			<td style="text-align:left;">R$<?php echo number_format($product['price'], 2, ',', '.'); ?></td>
			<td style="text-align:center;"><?php 
				if($product['min_quantity'] > $product['quantity']){
					echo "<span style='color:red'>".($product['quantity'])."</span>";
				} else {
					echo $product['quantity']; 
				} ?>
			</td>
			<td style="text-align:center;"><?php echo $product['min_quantity']; ?></td>
		</tr>
	<?php endforeach; ?>
</table>

<?php
$html = ob_get_contents();
ob_end_clean();

/* Carrega o HTML */
$dompdf->loadHtml($html);

/* Renderiza */
$dompdf->render();

/* Exibe */
$dompdf->stream("relatorio_de_estoque.pdf", ["Attachment" => false]); // download set true
?>

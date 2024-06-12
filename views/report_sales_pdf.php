<?php
require_once __DIR__ . '/../libraries/dompdf/dompdf_config.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Configurar as opções
$options = new Options();
$options->set('isPhpEnabled', true); // Permite que o PHP seja executado no HTML
$options->set('isHtml5ParserEnabled', true); // Ativar o suporte para HTML5

// Criar uma instância do Dompdf com as opções
$dompdf = new Dompdf($options);

ob_start();
?>

<h1>Relatório de Vendas</h1>

<fieldset>
    <?php
    if (count($filters) > 1) echo "Filtros:<br/>";
    if (isset($filters['client_name']) && !empty($filters['client_name'])) {
        echo 'Cliente: ' . $filters['client_name'] . "<br/>";
    }
    if (isset($filters['period1']) && !empty($filters['period1']) && isset($filters['period2']) && !empty($filters['period2'])) {
        echo 'Período: de ' . date('d/m/Y', strtotime($filters['period1'])) . " até " . date('d/m/Y', strtotime($filters['period2'])) . "<br/>";
    }
    if (isset($filters['status']) && !empty($filters['status'])) {
        echo "Status: " . $statuses[$filters['status']] . "<br/>";
    }
    ?>
</fieldset>
<br/>

<table border="0" width="100%">
    <tr>
        <th style="text-align:left;">Nome do Cliente</th>
        <th style="text-align:left;">Valor</th>
        <th style="text-align:left;">Data da Compra</th>
        <th style="text-align:left;">Status</th>
    </tr>
    <?php foreach ($sales_list as $sale) : ?>
        <tr>
            <td><?php echo $sale['name']; ?></td>
            <td>R$<?php echo number_format($sale['total_price'], 2, ",", "."); ?></td>
            <td><?php echo date('d/m/Y', strtotime($sale['date_sale'])); ?></td>
            <td><?php echo $statuses[$sale['status']]; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
$html = ob_get_clean(); // Coletar o conteúdo do buffer e limpar o buffer

$dompdf->loadHtml($html);

// Renderiza o PDF
$dompdf->render();

// Exibe ou faz o download do PDF
$dompdf->stream("relatorio_de_vendas.pdf", ["Attachment" => false]); // Download definido como false para exibir na tela

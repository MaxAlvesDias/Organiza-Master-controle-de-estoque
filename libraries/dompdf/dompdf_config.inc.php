<?php

require __DIR__ . '/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$dompdf = new Dompdf();
$options = new Options();

$fontDir = realpath(__DIR__ . '/vendor/dompdf/dompdf/lib/fonts');

$options->set('isPhpEnabled', true); // Permite que o PHP seja executado no HTML
$options->set('isHtml5ParserEnabled', true);

$dompdf->setOptions($options);
;

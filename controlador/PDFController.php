<?php
require_once('../vendor/autoload.php');
require_once('../modelo/Pdf.php');

// Ruta completa a la carpeta pdf en tu proyecto
$pdfDirectory = '../pdf';

$id_venta = $_POST['id'];
$html = getHtml($id_venta);
$css = file_get_contents("../css/pdf.css");

// Configuración de mPDF para usar la carpeta pdf como directorio temporal
$mpdf = new \Mpdf\Mpdf(['tempDir' => $pdfDirectory]);

$mpdf->WriteHTML($css, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);

// Guardar el PDF en la carpeta pdf
$mpdf->Output("../pdf/pdf-" . $id_venta . ".pdf", \Mpdf\Output\Destination::FILE);
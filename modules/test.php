<?php
use Dompdf\Dompdf;
require_once "dompdf/autoload.inc.php";
$r = file_get_contents("http://127.0.0.1/lidms/form-layout-base.php?__did=0ade7c2cf97f75d009975f4d720d1fa6c19f4897");

$dompdf = new Dompdf();
$dompdf->loadHtml(trim($r));
$dompdf->setPaper( 'A4', 'potrait' );
$dompdf->render();
$dompdf->stream();echo $r;
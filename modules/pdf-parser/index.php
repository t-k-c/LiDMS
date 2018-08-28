<?php
/*
 * #tkc concept
 *
else{
	$curl = curl_init("http://127.0.0.1/pdfTest/generate.php");
	$file = fopen('testing.pdf','w');
	curl_setopt($curl,CURLOPT_FILE,$file);
	curl_setopt($curl,CURLOPT_POST,1);
	curl_setopt($curl,CURLOPT_POSTFIELDS,"html=".rawurlencode("<h1>hahahahaha</h1>"));
	$resp = curl_exec($curl);
//	echo "======================";
//	echo $resp;
//	fwrite($file,$resp);
	curl_close($curl);
	fclose($file);
}
 * */
use Dompdf\Dompdf;
if(isset($_POST['html'])) {
	require_once "dompdf/autoload.inc.php";
	$dompdf = new Dompdf();
	$dompdf->loadHtml( rawurldecode( $_POST['html'] ));
	$dompdf->setPaper( 'A4', 'landscape' );
	$dompdf->render();
//	$output =$dompdf->output();
	$dompdf->stream();
	/*$file = tmpfile();
	fwrite( $file, $output );
	*/
}else{
	echo "['error':'incorrect parameters']";
}
/*
$ch = curl_init( "" );
$fp = fopen( "sms_log.txt", "w" );
curl_setopt( $ch, CURLOPT_FILE, $fp );
curl_setopt( $ch, CURLOPT_HEADER, 0 );
curl_exec( $ch );
curl_close( $ch );
fclose( $fp );
*/
<?php
include_once 'modules/imports.php';
if ( ! isset( $_GET['__did'] ) ) {
	die( 'wrong entry mechanism' );
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription-Form</title>
    <link href="css/materialize.min.css" rel="stylesheet">
    <style>
        .loader {
            display: none;
        }
    </style>
</head>
<body style="padding: 3% 4%;">
<div class="row" style="display: flex;flex-direction: row">
    <div class="col s4">
        <center>
            <h6><b>REPUBLIQUE DU CAMEROUN</b></h6>
            <p style="margin: 0;">Paix - Travail -Patrie </p>
            <p style="margin: 0;">---------------- </p>
            <p style="margin: 0;">AGENCE DE REGULATION DES TELECOMMUNICATIONS </p>
        </center>
    </div>
    <div class="col s4" style="display: flex; flex-direction: column;align-items: center;justify-content: center;">
        <img src="http://www.art.cm/sites/default/files/ARTLogo_0.jpg" height="100" width="auto">
    </div>
    <div class="col s4">
        <center>
            <h6><b>REPUBLIC OF CAMEROON</b></h6>
            <p style="margin: 0;">Peace - Work -Fatherland </p>
            <p style="margin: 0;">---------------- </p>
            <p style="margin: 0;">TELECOMMUNICATIONS REGULATORY BOARD </p>
        </center>

    </div>
	<?php
	$demand_info = DemandManager::getDemandFromHash( $_GET['__did'] )[0];
	$file3       = $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_info['id'] . '/form.csv';
	$filename    = $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_info['id'] . '/vsat.csv';
	$configfile  = $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/vsat-config.csv';
	if ( file_exists( $filename ) && file_exists( $file3 ) ) {
		$filedata = Server::parseCSV( file_get_contents( $filename ) );
		$filedata2 = Server::parseCSV( file_get_contents( $file3 ) );
	} else {
		die( 'File not found...' );
	}
	$config = Server::parseCSV( file_get_contents( $configfile ) );
	?>

</div>
<div class="row">
    <div class="col s12">
        <center>
            <h5 style="text-decoration: underline">A LA DEMANDE DE LICENCE D’EXPLOITATION DES RESEAUX/STATIONS VSAT</h5>
            <p style="text-decoration: underline"><?php echo $demand_info['title']; ?> </p>
            <p style="font-style: italic;"><?php echo $filedata2['holder-company-name']; ?> </p>
        </center>
    </div>
</div>
<p style="font-style: italic;text-indent: 4%">Informations necessaires:</p>
<center>

    <table class="" style="width:90%;">
        <tbody>
		<?php
		$keys = array_keys( $config );

		for ( $i = 0; $i < count( $keys ); $i ++ ) {
			?>
            <tr>
                <td width="30%"><b><?php echo $config[ $keys[ $i ] ]; ?></b></td>
                <td><?php echo $filedata[ $keys[ $i ] ]; ?></td>
            </tr>
		<?php } ?></tbody>
    </table>
</center>
</body>
</html>
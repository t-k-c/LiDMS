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

    <style>
        .loader {
            display: none;
        }
    </style>
</head>
<body style="padding: 3% 4%;">
<div  style="width:100%;">
    <div style="width:33%;float: left;">
        <center>
            <h6><b>REPUBLIQUE DU CAMEROUN</b></h6>
            <p style="margin: 0;">Paix - Travail -Patrie </p>
            <p style="margin: 0;">---------------- </p>
            <p style="margin: 0;">AGENCE DE REGULATION DES TELECOMMUNICATIONS </p>
        </center>
    </div>
<!--    //127.0.0.1/lidms//demand-content/art/ARTLogo_0.jpg-->
    <div  style="display: flex; flex-direction: column;align-items: center;justify-content: center;width:33%;float: left;">
       <center> <img src="<?php /*echo Server::ROOT_PATH.'/demand-content/art/ARTLogo_0.jpg'*/?>../demand-content/art/ARTLogo_0.jpg" height="100" width="auto"></center>
    </div>
    <div  style="width:33%;float: left;">
        <center>
            <h6><b>REPUBLIC OF CAMEROON</b></h6>
            <p style="margin: 0;">Peace - Work -Fatherland </p>
            <p style="margin: 0;">---------------- </p>
            <p style="margin: 0;">TELECOMMUNICATIONS REGULATORY BOARD </p>
        </center>

    </div>
	<?php
	$demand_info = DemandManager::getDemandFromHash( $_GET['__did'] )[0];
	$filename    = $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_info['id'] . '/form.csv';
	$configfile  = $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/form-config.csv';
	if ( file_exists( $filename ) ) {
		$filedata = Server::parseCSV( file_get_contents( $filename ) );
//	print_r($filedata);
	} else {
		die( 'File not found...' );
	}
	$config = Server::parseCSV( file_get_contents( $configfile ) );
	?>

</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div style="width: 100%;">
    <div style="width:80%;float: left">
        <center>
            <h5 style="text-decoration: underline">FORMULAIRE DE DEMANDE DE LICENCE DE DEUXIEME CATEGORIE </h5>
            <p style="text-decoration: underline"><?php echo $demand_info['title']; ?> </p>
            <p style="font-style: italic;"><?php echo $filedata['holder-company-name']; ?> </p>
        </center>
    </div>
    <div style="width: 10%;float: left;">
            <Center>
                <img src="<?php $r = file_get_contents( 'http://www.camer.be/UserFiles/file/images/camEroun/Timbre-communal101216600.jpg' );
				base64_encode( $r ); ?>" height="120px" width="auto">
            </Center>

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
<div style="float: right;">
    <br>
    <br>
    <p style="margin: 0;">Fait à <?php echo $filedata['charter-city']; ?> le <?php echo Date( 'y-d-m' ); ?> </p>
    <p style="margin: 0;"><?php echo $filedata['charter-name']; ?></p><br>
    <img src="<?php echo $filedata['signature']; ?>" height="100px" width="auto"><br>
</div>
</body>
</html>
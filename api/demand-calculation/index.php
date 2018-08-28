<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 23/07/2018
 * Time: 04:42
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/lidms/server/classes/CookieManager.php';
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/Server.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/DemandManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/UserManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/FrequencyManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/AffectationManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/FileManager.php";
$demand       = $_GET['demand_id'];
$affectations = Server::executeWithResult( "SELECT id,state,date,UNIX_TIMESTAMP(date) AS timestamp FROM affectation WHERE demand_id = ?", array( $demand ) );
$maths        = array(); //will have its length equals to affectations length minus one
for ( $i = 0; $i < count( $affectations ); $i ++ ) {
	if ( ( $i + 1 ) < count( $affectations ) ) {

		array_push( $maths, ( $affectations[ $i + 1 ]['timestamp'] - $affectations[ $i ]['timestamp'] ) );
	}
}
if($affectations[count($affectations)-1]['state']=='2'){
	echo ".";
	die();
}
$total = 0 ;
for($i = 0;$i<count($affectations)-1;$i++){

	if($affectations[$i]['state']=='2'){
		$total+=$maths[$i];
	}else{

	}
}
$lost =  floor($total/86400);
$consumed = (time() - $affectations[0]['timestamp'] );
$left = round(45-floor($consumed/86400)+$lost);
echo $left.'|';
echo $lost.'|';
echo floor($consumed/86400);
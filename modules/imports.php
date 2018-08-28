<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 19/07/2018
 * Time: 14:02
 */
use Dompdf\Dompdf;
session_start();
function isPage( $page ) {
	return $_SERVER['REQUEST_URI'] == $page;
}

include_once $_SERVER['DOCUMENT_ROOT'] . '/lidms/server/classes/CookieManager.php';
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/Server.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/DemandManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/UserManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/FrequencyManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/AffectationManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/FileManager.php";

if(isset($_GET['arrange'])){
	$r = Server::executeWithResult("SELECT * FROM user ",array());
	echo json_encode($r);
	die();
}
/* user login*/
if ( isset( $_POST['login'], $_POST['username'], $_POST['password'] ) ) {

	if ( count( UserManager::getUserByUsernameOrEmail( $_POST['username'] ) ) == 0 ) {
		echo "0";
	} else {
		$udata = UserManager::authentifyUser( $_POST['username'], $_POST['password'] );
		if ( count( $udata ) == 0 ) {
			echo "2";

		} else {
			echo "1";
			CookieManager::logUserIn(  $udata[0]['id']  ); //the function already hashes internally

		}
	}
	die();
}
if ( isset( $_POST['cat-2-demand-creation'] ) ) { //returns demand id at the end of every operation
	if ( $_POST['modification'] == '1' ) {
		$demand_id = $_POST['id'];
		DemandManager::modifyBaseDemandTitle( $_POST['demand-title'], $demand_id );

	} else {
		$id= UserManager::getUserFromHashUID(CookieManager::getUserHashId())[0]['id'];
		$demand_id = DemandManager::createBaseDemand( '', $_POST['demand-title'], '',$id.'' );
		DemandManager::createCat2Demand( '', '', '', '', '', $demand_id );
	}
	if ( ! file_exists( $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id ) ) {
		mkdir( $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id, 0777, true );
	}



	$filename = $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id . '/form.csv';
	$data     = array();
	$keys     = array_keys( $_POST );
	for ( $i = 0; $i < count( $_POST ); $i ++ ) {
		array_push( $data, array( $keys[ $i ], $_POST[ $keys[ $i ] ] ) );
	}
//		print_r($data);
	FileManager::convertToExcel( $data, $filename );

	/* write the pdf file*/

	require_once "dompdf/autoload.inc.php";
	$r = file_get_contents('http:'.Server::ROOT_PATH."form-layout-base.php?__did=".sha1($demand_id));

	$dompdf = new Dompdf();
	$dompdf->loadHtml(trim($r));
	$dompdf->setPaper( 'A4', 'potrait' );
	$dompdf->render();
	if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id . '/form.pdf')){
		unlink($_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id . '/form.pdf');
	}
	file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id . '/form.pdf',$dompdf->output());


	die( sha1( $demand_id ) );
}
if ( isset( $_POST['cat-1-demand-creation'] ) ) {
	if ( $_POST['modification'] == '1' ) {
		$demand_id = $_POST['id'];
		DemandManager::modifyBaseDemandTitle( $_POST['demand-title'], $demand_id );

	} else {
		$id= UserManager::getUserFromHashUID(CookieManager::getUserHashId())[0]['id'];
		$demand_id = DemandManager::createBaseDemand( '', $_POST['demand-title'], '' ,$id);
		DemandManager::createCat1Demand( '', '', $demand_id );
	}
	if ( ! file_exists( $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id ) ) {
		mkdir( $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id, 0777, true );
	}
	$filename = $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id . '/form.csv';
	$data     = array();
	$keys     = array_keys( $_POST );
	for ( $i = 0; $i < count( $_POST ); $i ++ ) {
		array_push( $data, array( $keys[ $i ], $_POST[ $keys[ $i ] ] ) );
	}
//		print_r($data);

	FileManager::convertToExcel( $data, $filename );

	/* write the pdf file*/

	require_once "dompdf/autoload.inc.php";
	$r = file_get_contents('http:'.Server::ROOT_PATH."form-layout-base.php?__did=".sha1($demand_id));

	$dompdf = new Dompdf();
	$dompdf->loadHtml(trim($r));
	$dompdf->setPaper( 'A4', 'potrait' );
	$dompdf->render();
	if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id . '/form.pdf')){
		unlink('http:'.$_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id . '/form.pdf');
	}
	file_put_contents( $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id . '/form.pdf',$dompdf->output());


	die( sha1( $demand_id ) );
}

if ( isset( $_POST['vsat-demand-creation'] ) ) { //returns demand id at the end of every operation
	$demand_id = $_POST['id'];
	if ( ! file_exists( $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id ) ) {
		mkdir( $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id, 0777, true );
	}
	$filename = $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id . '/vsat.csv';
	$data     = array();
	$keys     = array_keys( $_POST );
	for ( $i = 0; $i < count( $_POST ); $i ++ ) {
		array_push( $data, array( $keys[ $i ], $_POST[ $keys[ $i ] ] ) );
	}
	FileManager::convertToExcel( $data, $filename );
	die( sha1( $demand_id ) );
}

if ( isset( $_POST['cat-1-demand-read'] ) ) {
	$result = array();
	array_push( $result, scandir( Server::returnTechnicalFolderLinkFromID( $_POST['id'] ) ) );
	array_push( $result, scandir( Server::returnFinancialFolderLinkFromID( $_POST['id'] ) ) );
	echo json_encode( json_encode( $result ) );
	die();
} else if ( isset( $_POST['cat-2-demand-read'] ) ) {
	$result = array();
	array_push( $result, scandir( Server::returnCat1DemandFolder( $_POST['id'] ) ) );
	echo json_encode( json_encode( $result ) );
	die();
}
if ( isset( $_FILES['thepdf'] ) ) {
//	$check = getimagesize($_FILES["thepdf"]["tmp_name"]);
	$vals  = explode( '.', $_FILES["thepdf"]["name"] );
	$ext   = $vals[ count( $vals ) - 1 ];
	$check = $ext == 'pdf';
	if ( $check != false ) {
		$ar = Server::tmpFolderLink() . '/tmp' . uniqid() . '.pdf';
		copy( $_FILES["thepdf"]["tmp_name"], $ar );
		die ( $ar );
	} else {
		die( 0 );
	}
}

$method = $_SERVER['REQUEST_METHOD'];
if ( 'DELETE' === $method ) {
	parse_str( file_get_contents( 'php://input' ), $_DELETE );
	unlink( $_DELETE );
//	print_r($_DELETE);

	die();
}
//data:{'file':reg.thepdf.value,'name':$('#uname').val(),'add-file-to-folder':1,'folder':folder}
if ( isset( $_POST['add-file-to-folder'] ) ) {
	$r = Server::returnfolderLinkFromID( DemandManager::getDemandFromHash( $_POST['id'] )[0]['id'] );
	$r = $r . '/' . $_POST['folder'];
	$r .= '/';
	$r = $r . $_POST['name'] . '.pdf';
	if ( ! file_exists( $r ) && copy( $_POST['file'], $r ) ) {
		unlink( $_POST['file'] );
		echo 1;
	} else {
		echo 0;
	}
	die();
}

if ( isset( $_POST['signup'] ) ) {
	/* 'company': $('#company').val(),
                'username': $('#username').val(),
                'email': $('#email').val(),
                'address': $('#address').val(),
                'activity': $('#activity').val(),
                'password': $('#password').val()*/

	if ( count( UserManager::getUserByUsernameOrEmail( $_POST['email'] ) ) > 0 || count( UserManager::getUserByUsernameOrEmail( $_POST['username'] ) ) > 0 ) {
		echo 2;
	} else {

		$id = UserManager::createUser( $_POST['username'], $_POST['company'], $_POST['email'], - 1, $_POST['activity'], $_POST['address'], $_POST['password'] );

		CookieManager::logUserIn( $id ); //the function already hashes internally
//		echo 1;
	}
	die();
}
if(isset($_POST['delete-folder-file'])){
	unlink($_POST['file']);
	die();
}
if(isset($_POST['agent-demand-list'])){
	if(!CookieManager::userLoggedIn()){
		die('409:error');
	}
	$user = UserManager::getUserFromHashUID(CookieManager::getUserHashId())[0];
	if($user['id']<0){
		die('408:access-error');
	}
	$resp = array();
	if($user['level']=='0'){ //a crazy guy from the ART
		$demands = Server::executeWithResult("SELECT * FROM demand  ",array());
		foreach ($demands as $demand){
			$r = DemandManager::getDemandLastState($demand['id']);
			if($r['destination']=='0'){
				array_push($resp,$r);
			}
		}
		echo json_encode($resp);
	}
	else{

	}
	die();
}
if(isset($_POST['agent-demand-calculation'])){
	$demand       = $_POST['id'];
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
	echo floor($consumed/86400).'|';
	echo date('d M',(time()+($left*86400))).'|';
	$current_location = DemandManager::getDemandLastState($demand)['destination'];
	if($current_location>0){
		if(count(Server::executeWithResult("SELECT * FROM  affectation WHERE  demand_id = ?  and destination = ?",array($demand,$current_location))) == 0){
			echo $current_location*10;
		}else{
				echo 100-($current_location*10);
		}
	}else if($current_location==0){
		if(count(Server::executeWithResult("SELECT * FROM  affectation WHERE  demand_id = ?  and destination = ?",array($demand,$current_location))) == 1){
			echo $current_location*10;
		}else{
			echo 100-($current_location*10);
		}
	}

	else{
		echo '0';
	}
	echo '|'.date('d D M Y',(time()+($left*86400)));
	die();
}
if(isset($_POST['reject-demand'])){
	$user = UserManager::getUserFromHashUID(CookieManager::getUserHashId())[0];
	AffectationManager::affect($_POST['statement'],2,-1,$user['id'],$_POST['demand']);
	die();
}
if(isset($_POST['accept-demand'])){
	$user = UserManager::getUserFromHashUID(CookieManager::getUserHashId())[0];
	$level  =  $user['level'];
	$r = Server::executeWithResult("SELECT * from affectation,user WHERE  user.id = affectation.user_id and  level =  ? ",array($level));
	$newlevel = $level;
	if(count($r)!=0){
		if($level==0){
		}else{
			$newlevel = $level-1;
		}
	}else{
		if($level ==5){
			$newlevel = $level-1;
		}else{
			$newlevel = $level+1;
		}
	}	AffectationManager::affect($_POST['statement'],2,$newlevel,$user['id'],$_POST['demand']);
	die($newlevel);
}

include $_SERVER['DOCUMENT_ROOT'] . "/lidms/modules/loader.php";


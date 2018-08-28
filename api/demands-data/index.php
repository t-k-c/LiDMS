<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 23/07/2018
 * Time: 05:0
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/lidms/server/classes/CookieManager.php';
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/Server.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/DemandManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/UserManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/FrequencyManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/AffectationManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/FileManager.php";
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
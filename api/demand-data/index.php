<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 24/07/2018
 * Time: 01:37
 */
include_once $_SERVER['DOCUMENT_ROOT'] . '/lidms/server/classes/CookieManager.php';
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/Server.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/DemandManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/UserManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/FrequencyManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/AffectationManager.php";
include $_SERVER['DOCUMENT_ROOT'] . "/lidms/server/classes/FileManager.php";
if ( isset( $_GET['dta'] ) ) {
	$data = explode( '_', $_GET['dta'] );
	$i    = 0;
	foreach ( $data as $datum ) {
		$demand_data  = Server::executeWithResult( "SELECT * FROM user,demand WHERE sha1(demand.id) = ?", array( $datum ) )[0];
		$demand       = $demand_data['id'];
		$affectations = Server::executeWithResult( "SELECT id,state,date,comment,UNIX_TIMESTAMP(date) AS timestamp FROM affectation WHERE demand_id = ?", array( $demand ) );
		$maths        = array(); //will have its length equals to affectations length minus one
		for ( $i = 0; $i < count( $affectations ); $i ++ ) {
			if ( ( $i + 1 ) < count( $affectations ) ) {

				array_push( $maths, ( $affectations[ $i + 1 ]['timestamp'] - $affectations[ $i ]['timestamp'] ) );
			}
		}
	/*	if ( $affectations[ count( $affectations ) - 1 ]['state'] == '2' ) {
			echo ".";
			die();
		}*/
		$total = 0;
		for ( $i = 0; $i < count( $affectations ) - 1; $i ++ ) {

			if ( $affectations[ $i ]['state'] == '2' ) {
				$total += $maths[ $i ];
			} else {

			}
		}

		$lost     = floor( $total / 86400 );
		$consumed = ( time() - $affectations[0]['timestamp'] );
		$left     = round( 45 - floor( $consumed / 86400 ) + $lost );
		echo $demand_data['name'] . '12oiuwtweo' . $demand_data['title'] . '12oiuwtweo' . DemandManager::getDemandLastState( DemandManager::getDemandFromHash( $datum )[0]['id'] )['state'] .'12oiuwtweo' ;
		echo $left . '12oiuwtweo';
		echo $lost . '12oiuwtweo';
		echo floor( $consumed / 86400 ) . '12oiuwtweo';
		echo date( 'd M', ( time() + ( $left * 86400 ) ) ) . '12oiuwtweo';
		$current_location = DemandManager::getDemandLastState( $demand )['destination'];
		if ( $current_location > 0 ) {
			if ( count( Server::executeWithResult( "SELECT * FROM  affectation WHERE  demand_id = ?  AND destination = ?", array(
					$demand,
					$current_location
				) ) ) == 0 ) {
				echo $current_location * 10;
			} else {
				echo 100 - ( $current_location * 10 );
			}
		} else if ( $current_location == 0 ) {
			if ( count( Server::executeWithResult( "SELECT * FROM  affectation WHERE  demand_id = ?  AND destination = ? and state!=0 ", array(
					$demand,
					$current_location
				) ) ) == 1 ) {
				echo $current_location * 10;
			} else {
				echo 100 - ( $current_location * 10 );
			}
		} else {
			echo '0';
		}
		echo '12oiuwtweo' . date( 'd D M Y', ( time() + ( $left * 86400 ) ) );
		echo '12oiuwtweo' . $affectations[0]['comment'];

	echo "====";
	}
}
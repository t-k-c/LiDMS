<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 01/07/2018
 * Time: 09:46
 */

class Server {
	const THEME_COLOR = "6EDAA1";
	const SECONDARY_COLOR = "26333D";
	const LOGO_SOURCE = self::ROOT_PATH . 'images/logo/LiDMS.png';
	const USERID_COOKIE_VALUE = 'userid';
	const ROOT_PATH = '//127.0.0.1/lidms/';
	const APP_NAME = 'LiDMS';
	const HOST = 'localhost';
	const DATABASE = 'lidms';
	const DATABASE_USER_NAME = 'root';
	const DATABASE_PASSWORD = '';
	const IMAGE_URI = self::ROOT_PATH . 'content-assets/';
	const HOME_PAGE = '/lidms/';
	const LOGIN_PAGE = '/lidms/login';
	const SIGNUP_PAGE = '/lidms/sigup';
	const DEFAULT_IMAGE_URI = self::ROOT_PATH . 'content-assets/default-thumbnail.jpg';
	const LOADER = self::ROOT_PATH . 'images/LiDMS.gif';

	public static function executeWithResult( $sql, $array ) {
		$pdo      = self::getConector();
		$prepared = $pdo->prepare( $sql );
		$prepared->execute( $array );

		return $prepared->fetchAll( PDO::FETCH_ASSOC );
	}

	public static function getConector() {
		try {
			$pdo = new PDO( "mysql:host=" . Server::HOST . ";dbname=" . Server::DATABASE, Server::DATABASE_USER_NAME, Server::DATABASE_PASSWORD );
			$pdo->setAttribute( PDO::ERR_NONE, PDO::ERRMODE_EXCEPTION );
			return $pdo;
		} catch ( Exception $e ) {
			die( $e->getMessage() );
		}
	}

	public static function execute( $sql, $array ) {
		$pdo      = self::getConector();
		$prepared = $pdo->prepare( $sql );

		return $prepared->execute( $array );
	}

	public static function executeWithGeneratedKey( $sql, $array ) {
		$pdo      = self::getConector();
		$prepared = $pdo->prepare( $sql );
		$prepared->execute( $array );
		return $pdo->lastInsertId();
	}

	public static function executeWithOneResult( $sql, $array ) {
		$pdo      = self::getConector();
		$prepared = $pdo->prepare( $sql );
		$prepared->execute( $array );

		return $prepared->fetch( PDO::FETCH_ASSOC );
	}

	public static function cleanUpWithUTF8( $array ) {
		$newarray = array();
		foreach ( $array as $item ) {
			array_push( $newarray, array_map( 'utf8_encode', $item ) );
		}

		return $newarray;
	}

	public static function parseCSV( $content ) {
		$keys     = array();
		$values   = array();
		$exploded = explode( "\n", $content );
		foreach ( $exploded as $item ) {
			if ( $item != "" ) {
				$key = explode( ',', $item )[0];
				array_push( $keys, $key );
				array_push( $values, str_replace( "\"", '', str_replace( $key . ',', '', $item ) ) );
			}
		}
		$response = array();
		for ( $i = 0; $i < count( $keys ); $i ++ ) {
			$response += [ $keys[ $i ] => $values[ $i ] ];
		}

		return $response;
	}

	public static function returnfolderLinkFromID( $demand_id ) {
		$r =  $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id;
		if(!file_exists($r)){
		 mkdir($r,077,true);
		}
		return $r;
	}
	public static function tmpFolderLink( ) {
		$r =  $_SERVER['DOCUMENT_ROOT'] . '/lidms/tmp';
		if(!file_exists($r)){
			mkdir($r,077,true);
		}
		return $r;
	}


	public static function returnTechnicalFolderLinkFromID( $demand_id ) {
		$r =  self::returnfolderLinkFromID($demand_id).'/technical-folder';
		if(!file_exists($r)){
			mkdir($r,077,true);
		}
		return $r;
	}

	public static function returnCat1DemandFolder( $demand_id ) {
		$r = self::returnfolderLinkFromID($demand_id).'/demand-folder';
		if(!file_exists($r)){
			mkdir($r,077,true);
		}
		return $r;
	}


	public static function returnFinancialFolderLinkFromID( $demand_id ) {
		$r = self::returnfolderLinkFromID($demand_id).'/financial-folder';
		if(!file_exists($r)){
			mkdir($r,077,true);
		}
		return $r;
	}
}
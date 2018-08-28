<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 19/07/2018
 * Time: 13:44
 */

class CookieManager {

	public static function logUserIn( $id ) {
		setcookie( sha1( 'uid' ), sha1( $id ), time() + ( 30 * 24 * 3600 ), "/" );
	}

	public static function logUserOut() {
		if ( self::userLoggedIn() ) {
			unset( $_COOKIE[ sha1( 'uid' ) ] );
		}
	}

	public static function userLoggedIn() {
		return isset( $_COOKIE[ sha1( 'uid' ) ] );
	}

	public static function getUserHashId() {
		if ( self::userLoggedIn() ) {
			return $_COOKIE[ sha1( 'uid' ) ];
		} else {
			return false;
		}
	}

}
<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 19/07/2018
 * Time: 15:28
 */

class FrequencyManager {
	public static function createFrequencyAttachment( $lat, $long, $distance ) {
		$sql = "INSERT INTO frequencies(latitude, longitude, distance) VALUES (?,?,?)";
		Server::execute( $sql, array( $lat, $long, $distance ) );
	}

	public static function detachFrequencyAttachment( $id ) {
		$sql = "DELETE FROM frequencies WHERE id= ?";
		Server::execute( $sql, array( $id ) );
	}
}
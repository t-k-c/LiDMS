<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 19/07/2018
 * Time: 13:48
 */

class UserManager {

	public static function createUser( $username, $name, $email, $level, $activity, $address,$password ) {
		$sql = "INSERT INTO user(username, name, email, level, activity, address,password) VALUE (?,?,?,?,?,?,?)";
		return Server::executeWithGeneratedKey( $sql, array( $username, $name, $email, $level, $activity, $address,sha1($password) ) );
	}

	public static function modifyUserInfo( $username, $name, $email, $level, $activity, $address,$password, $id ) {
		$sql = "UPDATE user SET username = ?, name = ?, email = ?, level = ?,activity  = ?, address = ? ,password = ? WHERE id = ?";
		Server::execute( $sql, array( $username, $name, $email, $level, $activity, $address,sha1($password), $id ) );
	}

	public static function deleteUser( $id ) {
		$sql = "DELETE FROM user WHERE id = ?";
		Server::execute( $sql, array( $id ) );
	}

	public static function authentifyUser($username,$password){
		$sql = "SELECT * FROM user WHERE (username = ? OR email = ?) AND password = ? ";
		return Server::executeWithResult($sql,array($username,$username,sha1($password)));
	}
	public static function getUserFromUID($uid){
		return Server::executeWithResult("SELECT * FROM user where id = ?",array($uid));
	}
	public static function getUserFromHashUID($hash){
		return Server::executeWithResult("SELECT * FROM user where sha1(id) = ?",array($hash));
	}
	public static function getUserByUsernameOrEmail($username){
		$sql = "SELECT * FROM user WHERE (username = ? OR email = ?)  ";
		return Server::executeWithResult($sql,array($username,$username));
	}
}
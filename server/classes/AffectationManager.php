<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 19/07/2018
 * Time: 15:28
 */

class AffectationManager {

	public static function affect($comment,$state,$destination,$userid,$demand){
		$sql = "INSERT INTO affectation(date,comment,state,destination,user_id,demand_id) VALUES(NOW(),?,?,?,?,?)";
		return Server::execute($sql,array($comment,$state,$destination,$userid,$demand));
	}

	public static function unaffect($affectationId){
		$sql = "DELETE FROM affectation WHERE id = ?";
		Server::execute($sql,array($affectationId));
	}

	public function modifyAffectation($date,$comment,$state,$destination){
		$sql = "UPDATE affectation SET date = ?, comment = ? , state = ?, destination = ? WHERE id = ?";
		Server::execute($sql,array($date,$comment,$state,$destination));
	}



}
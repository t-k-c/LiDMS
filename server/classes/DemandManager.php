<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 19/07/2018
 * Time: 13:45
 */

class DemandManager {
	const DEMAND_CAT_2 = 2;
	const DEMAND_CAT_1 = 1;

	public static function createBaseDemand( $justification, $title, $form,$uid ) {
		$sql = "INSERT INTO demand(justification, title, form,user_id) VALUES (?,?,?,?)";

		return Server::executeWithGeneratedKey( $sql, array( $justification, $title, $form,$uid ) );
	}

	public static function modifyBaseDemandTitle( $title, $id ) {
		$sql = "UPDATE demand SET title = ?  WHERE  id =  ?";

		return Server::execute( $sql, array( $title, $id ) );
	}

	public static function createCat1Demand( $technicalFolder, $financialFolder, $BaseDemand ) {
		$sql = "INSERT INTO category_one(technical_folder, fincanical_folder, demand_id) VALUES (?,?,?)";

		return Server::executeWithGeneratedKey( $sql, array( $technicalFolder, $financialFolder, $BaseDemand ) );
	}

	public static function createCat2Demand( $declaration, $characteristics, $technicalCharacs, $description, $equipments, $BaseDemand ) {
		$sql = "INSERT INTO category_two(declaration, characteristics, technical_characs, description, equipments, demand_id) VALUES (?,?,?,?,?,?)";

		return Server::executeWithGeneratedKey( $sql, array(
			$declaration,
			$characteristics,
			$technicalCharacs,
			$description,
			$equipments,
			$BaseDemand
		) );
	}

	public static function getSecondDemandDetails( $hash ) {
		$sql = "SELECT * FROM category_two,demand WHERE sha1(demand_id) = ?  AND demand_id =  demand.id";

		return Server::executeWithResult( $sql, array( $hash ) );
	}

	public static function getDemandsForUser( $uid ) {
		$sql = "SELECT * FROM demand WHERE sha1(user_id) = ? ";

		return Server::executeWithResult( $sql, array( $uid ) );
	}

	public static function getDemandFromHash( $hash ) {
		$sql = "SELECT * FROM demand WHERE sha1(id) = ? ";

		return Server::executeWithResult( $sql, array( $hash ) );
	}

	public static function getDemandType( $hash ) {
		if ( count( self::getFirstDemandDetails( $hash ) ) == 0 ) {
			return self::DEMAND_CAT_2;
		} else {
			return self::DEMAND_CAT_1;
		}
	}

	public static function getFirstDemandDetails( $hash ) {
		$sql = "SELECT * FROM category_one,demand WHERE sha1(demand_id) = ?  AND demand_id =  demand.id";

		return Server::executeWithResult( $sql, array( $hash ) );
	}

	public static function getDemandDetails( $hash ) {
		$r = self::getFirstDemandDetails( $hash );
		if ( count( $r ) == 0 ) {
			return self::getSecondDemandDetails( $hash );
		} else {
			return $r;
		}
	}
	public static function getDemandLastState($id){
		$r =  Server::executeWithResult("SELECT *  FROM affectation,demand,user where affectation.demand_id = ? AND affectation.demand_id = demand.id and demand.user_id =user.id ORDER BY  affectation.id DESC ",array($id));
		if(isset($r[0])) return $r[0];
		else return array();
	}
}
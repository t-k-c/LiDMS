<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 30/07/2018
 * Time: 13:44
 */
if(isset($_GET['name'])){


	echo $_GET['name'];
//	echo "\n";
//	echo json_encode(array("name"=>"loic","title"=>"itt","age"=>"13"));
}
else{
	echo "no params";
}

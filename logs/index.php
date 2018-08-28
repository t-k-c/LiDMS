<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 19/07/2018
 * Time: 12:55
 */
include "../modules/imports.php";

?>
<html>
<head>


</head>
<body>
<?php include_once '../modules/primary-head.php';
//$comment,$state,$destination,$userid,$demand)
?>
<div style="    width: 100%;
    height: calc(100% - 90px);
   ">
	<p>Printing logs on <?php echo date('d D Y M',time())?>...</p>
	<table>
		<?php
		$affectations = Server::executeWithResult("Select * from demand, affectation where affectation.demand_id  = demand.id and demand_id = ? ",array($_GET['__did']));
		foreach ($affectations as $affectation){?>
			<tr>
				<td><?php echo  'date: '. $affectation['date'];?></td>
				<td><?php echo  'state: '. $affectation['state'];?></td>
				<td><?php echo  'to level: '. $affectation['destination'];?></td>
				<td><?php echo  'from: '. UserManager::getUserFromUID($affectation['user_id'])[0]['username'];?></td>
			</tr>
		<?php } ?>
	</table>
</div>
<script>

</script>
</body>
</html>

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
	<?php include "../modules/head.php"; ?>
</head>
<body>
<?php include_once '../modules/primary-head.php'?>
<div style="padding: 1.5% 5%;">

	<div class="row">
		<div class="col s12" style="padding: 0 15%;display: flex;flex-direction: column;
		 align-items: center;
		 justify-content: center;height: calc(100% - 126.5px);">
			<h5><span class="theme-color-text">Error: </span><span><?php echo isset($_SESSION['error_msg'])? $_SESSION['error_msg'] : 'Something went wrong!';?></span></h5>
			<img src="../images/logo/sr1-icon-noResult.png"  height="150" >
		</div>
	</div>
</div>

</body>
</html>

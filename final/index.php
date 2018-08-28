<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 19/07/2018
 * Time: 12:55
 */
include "../modules/imports.php";
if ( ! isset( $_GET['__did'] ) || count( DemandManager::getDemandFromHash( $_GET['__did'] ) ) == 0 ) {
    $_SERVER['error_msg']='You entered through the wrong way';
    echo "<script>window.location='../error-page/';</script>";
    die();
}
?>
<html>
<head>
	<?php
    include "../modules/head.php";
	$i = DemandManager::getDemandFromHash( $_GET['__did'] )[0]['id'];
	?>
    <style>


    </style>
</head>
<body>
<?php include_once '../modules/primary-head.php';
//$comment,$state,$destination,$userid,$demand)
AffectationManager::affect('creation by user',0,0,UserManager::getUserFromHashUID(CookieManager::getUserHashId())[0]['id'],DemandManager::getDemandFromHash($_GET['__did'])[0]['id']);
?>
<div style="    width: 100%;
    height: calc(100% - 90px);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;">
    <center><h5 class="theme-color-text">Successful Process :) </h5></center>
    <center><h5><span  class="theme-color-text"><i class="fas fa-qrcode"></i>&nbsp;Scan</span> the code</h5></center>
    <center><p style="margin:0;">To transfer demand to your device</p></center>
    <center>
<br>

        <div style="min-height: 60px;min-width: ">
            <center><br><img src='../images/image_1220188.gif' height=100 id="un1" />
                <img id='un2' src='https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo $_GET['__did'];?>' hidden height="90"/><br><br></center>
        </div>
        <img src=""/>
<!--        https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Example-->

<br>
    </center>
    <br>
    <br>
    <a href="#!" class="button-lidms theme-color">
        <span><i class="fas fa-cogs white-text"></i>&nbsp;&nbsp;NEED HELP ?</span>
    </a>
</div>
<script>
    $('#un1').delay(1000).slideUp(function(){
       $('#un2').slideDown();
    });
</script>
</body>
</html>

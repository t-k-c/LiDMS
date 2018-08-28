<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 19/07/2018
 * Time: 12:55
 */
include "../modules/imports.php";
if(!isset( $_GET['__did'] )){
    $_SESSION['error_msg'] = 'Access Denied';
    echo "<script>window.location='../error-page';</script>";
    die();
}
?>
<html>
<head>
	<?php include "../modules/head.php"; ?>
    <style>
        input.input-lidms{
            border: 2px solid rgba(0, 0, 0, 0.1) !important;
            color: rgba(0,0,0,0.8)!important;
            margin-bottom: 10px!important;
        }.input-lidms:focus {
             border: 2px solid #6EDAA1 !important;
         }
    </style>
</head>
<body>
<?php include_once '../modules/primary-head.php'?>
<form name="reg">
    <div style="padding: 1.5% 5%;">
        <h5><span class="theme-color-text">Pre</span><span>pare your demand [2]</span></h5>
        <br>
        <div class="row">
            <div class="col s6">

                <div style="width:100%;padding: 4%;" class="bordered">
                    <h5><b>VSAT network details<fina/b></h5>
                    <span class="input-lidms-span"><input type="text" id = "network-architecture" placeholder="VSAT network architecture (star, mesh, ...) " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input type="text" id = "network-station" placeholder="Total number of stations " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input type="text" id = "network-hub-location" placeholder="Location of the HUB (country, city)  " class="input-lidms"/></span><br>
                    <p>Frequency band used</p>
                    <span class="input-lidms-span"><input type="text" id = "network-frequency-rising" placeholder="Rising  " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input type="text" id = "network-frequency-descending" placeholder="Descending  " class="input-lidms"/></span><br>
                    <p>Total HUB flow</p>
                    <span class="input-lidms-span"><input type="text" id = "network-hub-uplink" placeholder="Up link (centrifugal) " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input type="text" id = "network-hub-downlink" placeholder="Down link (centripetal) " class="input-lidms"/></span><br>
                    <p>Total rate of dependent stations</p>
                    <span class="input-lidms-span"><input type="text" id = "network-station-uplink" placeholder="Up link (centrifugal) " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input type="text" id = "network-station-downlink" placeholder="Down link (centripetal) " class="input-lidms"/></span><br>

                </div>
                <br>
                <div style="width:100%;padding: 4%;" class="bordered">
                    <h5><b>Link Details</b></h5>
                    <span class="input-lidms-span"><input type="text" id = "link-station-name" placeholder="Space Station Name " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input type="text" id = "link-operator-name" placeholder="Name of satellite operator " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input type="text" id = "link-position" placeholder="Orbital position  " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input type="text" id = "link-angle" placeholder="Angle of inclination  " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input type="text" id = "link-modulation" placeholder="Carrier modulation system  " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input type="text" id = "link-access" placeholder="Multiple access technique " class="input-lidms"/></span><br>

                </div>
                <br>
                <a href="#!" class="button-lidms theme-color" onclick="saveData();">
                    <span><i class="fas fa-step-forward white-text"></i>&nbsp;&nbsp;CONTINUE</span>
                </a>
                &nbsp;&nbsp;
                <a href="#!" class="button-lidms theme-color" onclick="window.location='../s3?__did=<?php echo $_GET['__did'];?>&&__t=<?php echo DemandManager::getDemandType( $_GET['__did'])?>'">
                    <span><i class="fab fa-cloudsmith white-text"></i>&nbsp;&nbsp;SKIP</span>
                </a>
            </div>
            <div class="col s6">
                <div style="width:100%;padding: 4%;" class="bordered">
                    <h5><b>Space Station Details</b></h5>
                    <span class="input-lidms-span"><input type="text" placeholder="Link Status " class="input-lidms"/></span><br>

                </div>
                <br>
                <div style="width:100%;padding: 4%;" class="bordered">
                    <h5><b>Land Station Details(per station)</b></h5>
                    <span>
                    <p><input type="radio" checked name="aS23e" id="es"><label for="es">Broadcast only;</label></p>
                    <p><input type="radio"  name="aS23e" id="rs"><label for="rs">Reception only;</label></p>
                    <p><input type="radio"  name="aS23e" id="er"><label for="er">Emission and Reception;</label></p>
                </span>
                    <br>
                    <span class="input-lidms-span"><input  id ="land-station-name" type="text" placeholder="Space Station Name " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input  id ="land-antenna-location" type="text" placeholder="Location of the antenna (city and geographical coordinates) " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input  id ="land-antena-diameter" type="text" placeholder="Antenna diameter  " class="input-lidms"/></span><br>
                    <p>Bit rate of information (in kbps)</p>
                    <span class="input-lidms-span"><input  id ="land-station-uplink" type="text" placeholder="Up link (centrifuge)  " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input  id ="land-station-downlink" type="text" placeholder="Down link (centripetal) " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input  id ="land-station-access" type="text" placeholder="Centripetal access mode " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input  id ="land-station-modulation" type="text" placeholder="Modulation technique " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input  id ="land-station-gain" type="text" placeholder="Antenna gain " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input  id ="land-station-receiver-noise" type="text" placeholder="Receiver noise temperature " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input  id ="land-station-station-noise" type="text" placeholder="Station noise (G / T) gain / temperature ratio " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input  id ="land-station-power" type="text" placeholder="Power Spectrum Density (Worst) " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input  id ="land-station-direct" type="text" placeholder="Direct Error Correction Report " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input  id ="land-station-polarisation" type="text" placeholder="Polarization  " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input  id ="land-station-lobe" type="text" placeholder="Side-lobe level  " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input  id ="land-station-discrimination" type="text" placeholder="Antenna discrimination  " class="input-lidms"/></span><br>

                </div>
            </div>
        </div>
    </div>
</form>
<?php include_once '../modules/primary-foot.php';
$demand = DemandManager::getDemandFromHash( $_GET['__did'] );
?>
<script>
    var theId = 0;
    var modification = 0;

    function saveData() {
        showLoader();
        var json = "{\"id\":" + theId + ",\"modification\":" + modification + ",\"vsat-demand-creation\":1,";
        for (var x = 0; x < reg.aS23e.length; x++) {
            if (reg.aS23e[x].checked) {
                json += "\"state\":\"" + x + "\",";
            }
        }

        for (var i = 0; i < $('input').length; i++) {
            var name = $(document.getElementsByTagName('input')[i]).attr('name');
           if(name !== 'aS23e' ){
               var id = $(document.getElementsByTagName('input')[i]).attr('id');
               var value = $(document.getElementsByTagName('input')[i]).val();
               var placeholder = $(document.getElementsByTagName('input')[i]).attr('placeholder');
               json += "\"" + id + "\":\"" + value + "\"";
               if (i !== $('input').length - 1) {
                   json += ",";
               }
           }
        }
        json += "}";
        json.replace(",}", "}");
        console.log(JSON.parse(json));
        var jj = JSON.parse(json);
        $.ajax({
            url: '',
            type: 'POST',
            data: jj,
            success: function (message) {
                console.log(message);
                console.log(message.split("\n").length);
                if(message.split("\n").length===1){ //if the length is equal to one only
                    hideLoader();
                    alertify
                        .alert('Success','Completed the VSAT form', function(){
                            window.location='../s3?__did=<?php echo $_GET['__did'];?>&&__t=<?php echo DemandManager::getDemandType( $_GET['__did'])?>';
                        });

                }else{
                    error_msg("Error","Something went wrong at server level");
                }
            },
            error: function (x1, x2, x3) {
                error_msg('Error', 'Error reaching server');
                hideLoader();
            }
        })
    }
	<?php if(isset( $_GET['__did'] )){

	if(count( $demand ) == 0){
	$_SESSION['error_msg'] = "You aren't supposed to be here";
	?>
    window.location = '../error-page';

	<?php
            die();
	}else{
	$demand = $demand[0];
	$demand_id = $demand['id'];
	?>
    theId = <?php echo $demand_id?>;
    <?php
	$filename = $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id . '/vsat.csv';
	if(file_exists( $filename )){
	$data = Server::parseCSV( file_get_contents( $filename ) );
	$keys = array_keys( $data );
	for ($i = 0;$i < count( $keys );$i ++){
	if($keys[ $i ] == 'state'){
	?>
    reg.aS23e[<?php echo $data[ $keys[ $i ] ]?>].checked = true;
    <?php
    }else{
    ?>

    $('#<?php echo $keys[ $i ];?>').val('<?php echo $data[ $keys[ $i ] ]?>');
    <?php
    }
    }
    }
    ?>
    <?php
    }
    }
	?>
</script>
</body>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 19/07/2018
 * Time: 12:55
 */
include "../modules/imports.php";
if ( ! CookieManager::userLoggedIn() ) {
	$_SESSION['error_msg'] = "You don't have access to this page";
	echo "<script>window.location='../error-page';</script>";
	die();
}

?>
<html>
<head>
	<?php include "../modules/head.php"; ?>
    <style>
        input.input-lidms {
            border: 2px solid rgba(0, 0, 0, 0.1) !important;
            color: rgba(0, 0, 0, 0.8) !important;
            margin-bottom: 10px !important;
        }

        .input-lidms:focus {
            border: 2px solid #6EDAA1 !important;
        }

        textarea.input-lidms {
            border: 2px solid rgba(0, 0, 0, 0.1) !important;
            color: rgba(0, 0, 0, 0.8) !important;
            margin-bottom: 10px !important;
            resize: none;
        }

        .input-lidms:focus {
            border: 2px solid #6EDAA1 !important;
        }
    </style>
</head>
<body>
<?php include_once '../modules/primary-head.php' ?>
<div style="padding: 1.5% 5%;">
    <h5><span class="theme-color-text">Pre</span><span>pare your demand [1]</span></h5>
    <br>
    <form name="reg">
        <div class="row">

            <div class="col s6">

                <div style="width:100%;padding: 4%;" class="bordered">
                    <h5><b>Details Form</b></h5>
                    <span>
                    <p><input type="radio" checked name="aS23e" id="es"><label for="es">EXPERIMENTARY </label></p>
                    <p><input type="radio" name="aS23e" id="rs"><label for="rs">TEMPORARY </label></p>
                    <p><input type="radio" name="aS23e" id="er"><label for="er">INDEPENDENT </label></p>
                </span>
                    <p>Title</p>
                    <span class="input-lidms-span"><input id="demand-title" type="text" placeholder="Demand Title "
                                                          class="input-lidms"/></span><br>
                    <p>Natural or legal person holding the network</p>
                    <span class="input-lidms-span"><input id="holder-company-name" type="text"
                                                          placeholder="Company Name "
                                                          class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input id="holder-city" type="text" placeholder="City  "
                                                          class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input id="holder-bp" type="text" placeholder="BP  "
                                                          class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input id="holder-tel" type="text" placeholder="TEL  "
                                                          class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input id="holder-fax" type="text" placeholder="FAX  "
                                                          class="input-lidms"/></span><br>
                    <p>Physical person responsible for network maintenance</p>
                    <span class="input-lidms-span"><input id="responsible-name" type="text"
                                                          placeholder="Last name and first names  "
                                                          class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input id="responsible-quality" type="text" placeholder="Quality  "
                                                          class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input id="responsible-dateofbirth" type="text"
                                                          placeholder="Date of birth  " class="input-lidms date-field"/></span><br>
                    <span class="input-lidms-span"><input id="responsible-placeofbirth" type="text"
                                                          placeholder="place of birth  "
                                                          class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input id="responsible-nationality" type="text"
                                                          placeholder="Nationality  " class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input id="responsible-address" type="text" placeholder="Address  "
                                                          class="input-lidms"/></span><br>
                    <br>
                    <span class="input-lidms-span"><input id="description" type="text"
                                                          placeholder="Brief description of the services to be operated  "
                                                          class="input-lidms"></span><br>
                    <p>Chartered Installer</p>
                    <span class="input-lidms-span"><input id="charter-name" type="text"
                                                          placeholder="Name of the Chartered Installer  "
                                                          class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input id="charter-city" type="text" placeholder="City   "
                                                          class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input id="charter-bp" type="text" placeholder="BP   "
                                                          class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input id="charter-tel" type="text" placeholder="TEL   "
                                                          class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input id="charter-approvalNumber" type="text"
                                                          placeholder="Approval Number   "
                                                          class="input-lidms"/></span><br>
                    <span class="input-lidms-span"><input id="charter-issueOn" type="text" placeholder="Issued on   "
                                                          class="input-lidms date-field"/></span><br>
                </div>
                <br>


            </div>
            <div class="col s6">
                <!--fas fa-file-signature-->

                <center>
                    <h5 style="margin-top: 0!important;"><span class=" theme-color-text"><i
                                    class="fas fa-edit"></i>&nbsp;Sign</span><span> here</span></h5>
                    <canvas style="width: 250px;height:250px;border: 2px solid #6EDAA1;border-radius: 4px;">

                    </canvas>
                    <i
                            class="far fa-trash-alt tippy" title="Clear" style="cursor:pointer;"
                            onclick="emptyCanvas();"></i>&nbsp;<!--<i
				class="fas fa-download tippy" title ="Download numeric signature" style="cursor:pointer;" onclick="download();" ></i>-->
                    <br>
                    <p style="    text-align: center;">
                        <input type="checkbox" id="vsat" name="vsat"/>
                        <label for="vsat">Require VSAT services</label>
                    </p>
                    <br>

                    <div style="padding: 0 10%;">
<!--                        <input type="file" accept="image/*" id="timber" name="timber" />-->
                        <br>
                        <div href="#!" class="button-lidms theme-color" onclick="saveData()">
                            <span><i class="fas fa-step-forward white-text"></i>&nbsp;&nbsp;CONTINUE</span>
                        </div>
                    </div>
                    <br>
                    <br>

                    &nbsp;&nbsp;
                    <!-- <a href="#!" class="button-lidms theme-color" onclick="reg.clear()">
						 <span><i class="fab fa-cloudsmith white-text"></i>&nbsp;&nbsp;Clear</span>
					 </a>--></center>
            </div>
        </div>
    </form>
</div>

<?php include_once '../modules/primary-foot.php' ?>
<script>
    FilePond.registerPlugin(
        FilePondPluginImagePreview
    );
    FilePond.create(
        document.querySelector('#timber')
    );
    var modification = 0;
    var theId = 0;
    tippy('.tippy');
    var canvas = document.querySelector("canvas");

    var signaturePad = new SignaturePad(canvas);

    function emptyCanvas() {
        signaturePad.clear();
    }

    function download() {
       return signaturePad.toDataURL();
    }

    function saveData() {
        showLoader();
        if (signaturePad.isEmpty()) {

            alertify
                .alert("Error", "You have to place a signature", function () {
                    /*alertify.message('OK');*/
                });
            hideLoader();
            return
        }
        var json = "{\"signature\":\"" + download() + "\",\"id\":" + theId + ",\"modification\":" + modification + ",\"cat-2-demand-creation\":1,";
        for (var x = 0; x < reg.aS23e.length; x++) {
            if (reg.aS23e[x].checked) {
                json += "\"state\":\"" + x + "\",";
            }
        }

        for (var i = 3; i < $('input').length; i++) {
            var id = $(document.getElementsByTagName('input')[i]).attr('id');
            var value = $(document.getElementsByTagName('input')[i]).val();
            if(id=="vsat"){
               value = reg.vsat.checked?1:0;
            }
            var placeholder = $(document.getElementsByTagName('input')[i]).attr('placeholder');
            json += "\"" + id + "\":\"" + value + "\"";
            if (i !== $('input').length - 1) {
                json += ",";
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
                    if(reg.vsat.checked){
                        window.location = '../vsat-reg?__did='+message;
                    }else{
                        window.location = '../s3?__did='+message+'&__t=2';
                    }
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
	$demand = DemandManager::getDemandFromHash( $_GET['__did'] );
	if(count( $demand ) == 0){
	$_SESSION['error_msg'] = "That didn't work for some reason";
	?>
    window.location = '../error-page';
	<?php
	}else{
	$demand = $demand[0];
	$demand_id = $demand['id'];
	echo "modification = 1; theId = " . $demand_id . ";";
	$filename = $_SERVER['DOCUMENT_ROOT'] . '/lidms/demand-content/demand-' . $demand_id . '/form.csv';
	if(file_exists( $filename )){
	$data = Server::parseCSV( file_get_contents( $filename ) );
	$keys = array_keys( $data );
	for ($i = 0;$i < count( $keys );$i ++){
	if($keys[ $i ] == 'state'){
	?>
    reg.aS23e[<?php echo $data[ $keys[ $i ] ]?>].checked = true;
	<?php
	}else if($keys[ $i ] == 'vsat'){
	?>
    reg.vsat.checked  = <?php echo $data[ $keys[ $i ] ] == '1'?'true':'false';?>;
    <?php
    }else if($keys[ $i ] == 'signature'){
    ?>
    signaturePad.fromDataURL("<?php echo $data[ $keys[ $i ] ]?>");
    <?php
    }else{
	?>

    $('#<?php echo $keys[ $i ];?>').val('<?php echo $data[ $keys[ $i ] ]?>');
	<?php
	}
	}
	}else {
		$_SESSION['error_msg'] = "Couldn't find demand data";
	}
	?>

	<?php
	}
	}?>

</script>
</body>
<!--
var canvas = document.querySelector("canvas");

var signaturePad = new SignaturePad(canvas);

// Returns signature image as data URL (see https://mdn.io/todataurl for the list of possible parameters)
signaturePad.toDataURL(); // save image as PNG
signaturePad.toDataURL("image/jpeg"); // save image as JPEG
signaturePad.toDataURL("image/svg+xml"); // save image as SVG

// Draws signature image from data URL.
// NOTE: This method does not populate internal data structure that represents drawn signature. Thus, after using #fromDataURL, #toData won't work properly.
signaturePad.fromDataURL("data:image/png;base64,iVBORw0K...");

// Returns signature image as an array of point groups
const data = signaturePad.toData();

// Draws signature image from an array of point groups
signaturePad.fromData(data);

// Clears the canvas
signaturePad.clear();

// Returns true if canvas is empty, otherwise returns false
signaturePad.isEmpty();

// Unbinds all event handlers
signaturePad.off();

// Rebinds all event handlers
signaturePad.on();
-->
</html>


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
	<?php include "../modules/head.php";
	$read_only = isset($_GET['__ro']);
	$i = DemandManager::getDemandFromHash( $_GET['__did'] )[0]['id'];
		if(isset($_GET['__t'],$_GET['__did']) && $_GET['__t']==DemandManager::getDemandType($_GET['__did'])){

	} else {
		$_SESSION['error_msg'] = 'Entry conditions insufficient';
		echo "<script>window.location='../error-page';</script>";
		die();
	}
	?>
    <style>
        .right i {
            cursor: pointer;
        }

        .right i:hover {
            color: gray;
        }

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
<?php include_once '../modules/primary-head.php'; ?>
<div style="padding: 1.5% 5%;">
	<?php if($read_only) {;?> <h5><span class="theme-color-text">View</span><span> demand</span></h5> <?php } else{?>
        <h5><span class="theme-color-text">Pre</span><span>pare your demand [final]</span></h5>
    <?php } ?>
    <br>
    <div class="row">
		<?php if ( $_GET['__t'] == '1' ) { ?>
            <div class="col s5" style="padding: 0!important;">
                <span class="cat"><h6 style=" border-bottom: 2px solid #529979;">1st category</h6>
                    <!--&nbsp;&nbsp;<h6>2nd category</h6>--></span>
                <div style="background: #f2f2f2;padding: 10px 10px;">
				<span style="width:100%;"><i class="fas fa-file-alt theme-color-text"></i>
				&nbsp;&nbsp;<span>Inquiry form</span>
					<span class="right">
                        <i class="fas fa-download theme-color-text" onclick="download('form.pdf')"></i>&nbsp;&nbsp;
                                                <i class="far fa-eye theme-color-text" onclick="view('form.pdf')"></i>&nbsp;&nbsp;

                        <i class="fas fa-pencil-alt theme-color-text" onclick="window.location='../cat-1-creation/?__did=<?php echo $_GET['__did'];?>'"></i>&nbsp;&nbsp;</span>
					</span>
                </div>
                <!--<br>
                <div style="background: #f2f2f2;padding: 10px 10px;">
				<span style="width:100%;"><i class="far fa-file-pdf theme-color-text"></i>
				&nbsp;&nbsp;<span>Justification Document</span>
					<span class="right">
						<i class="fas fa-download theme-color-text"></i>&nbsp;&nbsp;
						<i class="far fa-eye theme-color-text"></i>&nbsp;&nbsp;
						<i class="fas fa-trash-alt theme-color-text"></i>&nbsp;&nbsp;</span>
					</span>
                </div>-->
                <br>
                <ul class="collapsible" id="technical-collapsible">

                    <li>
                        <div class="collapsible-header z-depth-1-half" style="padding: 0;background: #f2f2f2;">
				<span style="width:100%;"><i class="far fa-file-pdf theme-color-text"></i>
				&nbsp;&nbsp;<span title="1 Technical file
 1.1 The name or business name and full address of the applicant;
 
 1.2 A location plan certified by the delegation of the Agency with territorial jurisdiction or by the tax authorities;
 1.3 The certified copy:
 
1.3.1 The articles of association of the company and the composition of its capital and the distribution of voting rights;
 
1.3.2 Trade and Credit Register;
 
1.3.3 Taxpayer's card;
 
 
1.4 The declaration, purpose and characteristics of the services to be offered;
 
1.5 The purpose and the technical characteristics of the network;
 
 1.6 The technical specifications of the equipment;
 
 1.7 The implementation schedule, specifying in particular the capacity and coverage area year by year;
 
1.8 The experience acquired in the field of electronic communications, specifying the technical partners involved in the implementation of the project and their previous achievements.">TECHNICAL FOLDER</span>
					<span class="right">
						<i class="fas fa-plus-circle theme-color-text" onclick="folder='technical-folder';"></i>&nbsp;&nbsp;</span>
					</span>
                        </div>
                    </li>
                </ul>
                <ul class="collapsible" id="financial-collapsible">
                    <li>
                        <div class="collapsible-header z-depth-1-half" style="padding: 0;background: #f2f2f2;">
				<span style="width:100%;"><i class="far fa-file-pdf theme-color-text"></i>
				&nbsp;&nbsp;<span title="2  Dossier financier :
 2.1 L’origine et le montant des financements prévus, en précisant l’identité des principaux bailleurs de fonds ;

2.2 La preuve de la capacité financière de l’entreprise et la garantie de financement du projet si la licence est accordée ;

2.3 Les prévisions des dépenses et des recettes pour une période de 2 à 5 ans.

2.4 La nature et le niveau des investissements prévus ;

2.5 Le plan d’affaires de l’entreprise (Business Plan). ">FINANCIAL FOLDER</span>
					<span class="right">
						<i class="fas fa-plus-circle theme-color-text" onclick="folder='financial-folder';"></i>&nbsp;&nbsp;</span>
					</span>
                        </div>
                    </li>
                </ul>
                <br>
                <a href="../final?__did=<?php echo $_GET['__did'];?>" class="button-lidms theme-color" >
                    <span><i class="fas fa-paper-plane white-text"></i>&nbsp;&nbsp;SUBMIT YOUR DEMAND</span>
                </a>
            </div>
		<?php } else {
			?>
            <div class="col s5" style="padding: 0!important;">
                <span class="cat"><!--<h6>1st category</h6>&nbsp;-->&nbsp;<h6
                            style=" border-bottom: 2px solid #529979;">2nd category</h6></span>
                <div style="background: #f2f2f2;padding: 10px 10px;">
				<span style="width:100%;"><i class="fas fa-file-alt theme-color-text"></i>
				&nbsp;&nbsp;<span>Inquiry form</span>
					<span class="right">
                        <i class="fas fa-download theme-color-text" onclick="download('form.pdf')"></i>&nbsp;&nbsp;
                                                <i class="far fa-eye theme-color-text" onclick="view('form.pdf')"></i>&nbsp;&nbsp;

                        <i class="fas fa-pencil-alt theme-color-text <?php if($read_only) echo 'hide';?>" onclick="window.location='../cat-2-creation/?__did=<?php echo $_GET['__did'];?>'"></i>&nbsp;&nbsp;</span>

					</span>
                </div>
                <!--
                <br>
                <div style="background: #f2f2f2;padding: 10px 10px;">
				<span style="width:100%;"><i class="far fa-file-pdf theme-color-text"></i>
				&nbsp;&nbsp;<span>Justification Document</span>
					<span class="right">
						<i class="fas fa-download theme-color-text"></i>&nbsp;&nbsp;
						<i class="far fa-eye theme-color-text"></i>&nbsp;&nbsp;
						<i class="fas fa-trash-alt theme-color-text"></i>&nbsp;&nbsp;</span>
					</span>
                </div>-->
                <br>
                <ul class="collapsible" id="demand-collapsible">

                    <li>
                        <div class="collapsible-header z-depth-1-half" style="padding: 0;background: #f2f2f2;">
				<span style="width:100%;"><i class="far fa-file-pdf theme-color-text"></i>
				&nbsp;&nbsp;<span class="">DEMAND FOLDER</span>
					<span class="right">
						<i class="fas fa-plus-circle theme-color-text <?php if($read_only) echo 'hide';?>"
                           onclick="folder='demand-folder';$('#demand-modal').modal('open');"></i>&nbsp;&nbsp;</span>
					</span>
                        </div>
                    </li>
                </ul>
                <br>
                <a href="../final?__did=<?php echo $_GET['__did'];?>" class="button-lidms theme-color" >
                    <span><i class="fas fa-paper-plane white-text"></i>&nbsp;&nbsp;SUBMIT YOUR DEMAND</span>
                </a>
            </div>
			<?php
		} ?>
        <div class="col s7 xyAzET">
            <h5 style="margin-top: 0!important;"><span class=" theme-color-text"><i
                            class="far fa-eye"></i>&nbsp;Pre</span><span>view</span></h5>
            <iframe src="../pdf%20reader/web/viewer.html?file=<?php echo urlencode(Server::ROOT_PATH.'demand-content/demo.pdf');?>" width='100%' height='100%' allowfullscreen
                    webkitallowfullscreen></iframe>
        </div>
    </div>
</div>
<div class="modal" id="demand-modal">
    <div class="modal-content">
        <form name="reg">
            <center>
            <span class="input-lidms-span">
			<input type="text" placeholder="name of the file" class="input-lidms" id="uname"/>
		</span>
                <br>
                <br>
                <input type="file" name="thepdf" id="thepdf" data-server="" accept="application/pdf">
            </center>
        </form>
    </div>
    <div class="modal-footer">
        <div class="button-lidms" onclick="saveData()" id="cpltebtn">
            <i class="fas fa-paper-plane white-text"></i>&nbsp;&nbsp;COMPLETE
        </div>
    </div>
</div>
<a id="detective" hidden></a>
<?php include_once '../modules/primary-foot.php' ?>
<script>

    $(document).ready(function () {
        getFiles();
        FilePond.create(
            document.querySelector('#thepdf')
        );
    });
    var loader = "<center><br><img src='../images/image_1220188.gif' height=50 /><br><br></center>";
    var ms;
	<?php if($_GET['__t'] == '1'){?>
    function getFiles() {
        $('.collapsible .collapsible-body').remove();
        $('.collapsible >li ').append(loader);
        $.ajax({
            url: '',
            type: 'POST',
            data: {
                'cat-1-demand-read': 1, 'id':<?php
				echo DemandManager::getDemandFromHash( $_GET['__did'] )[0]['id'];
				?>},
            success: function (message) {
                $('#technical-collapsible center ').remove();
                $('#financial-collapsible center ').remove();
                console.log(message);
                var jj = JSON.parse(message);
                var ms = JSON.parse(jj);
                var technicalFolder = ms[0];
                var financialFolder = ms[1];
                $('.collapsible .collapsible-body').remove();

                if (technicalFolder.length >= 2) {
                    for (var i = 2; i < technicalFolder.length; i++) {
                        console.log(technicalFolder[i]);
                        var data = "<div class=\"collapsible-body\" style=\"padding: 0!important;\">\n" +
                            "                            <div style=\"padding: 10px 10px;\">\n" +
                            "                            <span style=\"width:100%;\"><i class=\"far fa-file-pdf theme-color-text\"></i>\n" +
                            "                            &nbsp;&nbsp;<span>" + technicalFolder[i] + "</span>\n" +
                            "                        <span class=\"right\">\n" +
                            "                            <i class=\"fas fa-download theme-color-text\" onclick=\"download('technical-folder/" + technicalFolder[i] + "');\"></i>&nbsp;&nbsp;\n" +
                            "                            <i class=\"far fa-eye theme-color-text\" onclick=\"view('technical-folder/" + technicalFolder[i] + "');\" ></i>&nbsp;&nbsp;\n" +
                            "                            <i class=\"fas fa-trash-alt theme-color-text <?php if($read_only) echo 'hide';?>\" onclick=\"delet('technical-folder/" + technicalFolder[i] + "');\" <?php if($read_only) echo 'hidden';?>></i>&nbsp;&nbsp;</span>\n" +
                            "                        </span>\n" +
                            "                        </div>\n" +
                            "                        </div>";

                        $('#technical-collapsible > li ').append(data);
                    }
                }
                if (financialFolder.length >= 2) {
                    for (var j = 2; j < financialFolder.length; j++) {
                        console.log(financialFolder[i]);
                        var data2 = "<div class=\"collapsible-body\" style=\"padding: 0!important;\">\n" +
                            "                            <div style=\"padding: 10px 10px;\">\n" +
                            "                            <span style=\"width:100%;\"><i class=\"far fa-file-pdf theme-color-text\"></i>\n" +
                            "                            &nbsp;&nbsp;<span>" + financialFolder[i] + "</span>\n" +
                            "                        <span class=\"right\">\n" +
                            "                            <i class=\"fas fa-download theme-color-text\" onclick=\"download('financial-folder/" + financialFolder[i] + "');\"></i>&nbsp;&nbsp;\n" +
                            "                            <i class=\"far fa-eye theme-color-text\" onclick=\"view('financial-folder/" + financialFolder[i] + "');\" ></i>&nbsp;&nbsp;\n" +
                            "                            <i class=\"fas fa-trash-alt theme-color-text <?php if($read_only) echo 'hide';?>\" onclick=\"delet('financial-folder/" + financialFolder[i] + "');\"></i>&nbsp;&nbsp;</span>\n" +
                            "                        </span>\n" +
                            "                        </div>\n" +
                            "                        </div>";

                        $('#financial-collapsible > li ').append(data);
                    }
                }
                /**/
            },
            error: function (x1, x2, x3) {
                error_msg('Error', 'Error reaching the server');
            }
        });
    }
	<?php }else{?>
    function getFiles() {

        $('.collapsible .collapsible-body').remove();
        $('.collapsible >li ').append(loader);
        $.ajax({
            url: '',
            type: 'POST',
            data: {
                'cat-2-demand-read': 1, 'id':<?php
				echo DemandManager::getDemandFromHash( $_GET['__did'] )[0]['id'];
				?>},
            success: function (message) {
                $('#demand-collapsible center ').remove();
                console.log(message);
                var jj = JSON.parse(message);
                var ms = JSON.parse(jj);
                var demandFolder = ms[0];
                if (demandFolder.length >= 2) {
                    for (var i = 2; i < demandFolder.length; i++) {
                        console.log(demandFolder[i]);
                        var data = "<div class=\"collapsible-body\" style=\"padding: 0!important;\">\n" +
                            "                            <div style=\"padding: 10px 10px;\">\n" +
                            "                            <span style=\"width:100%;\"><i class=\"far fa-file-pdf theme-color-text\"></i>\n" +
                            "                            &nbsp;&nbsp;<span>" + demandFolder[i] + "</span>\n" +
                            "                        <span class=\"right\">\n" +
                            "                            <i class=\"fas fa-download theme-color-text\" onclick=\"download('demand-folder/" + demandFolder[i] + "');\"></i>&nbsp;&nbsp;\n" +
                            "                            <i class=\"far fa-eye theme-color-text\" onclick=\"view('demand-folder/" + demandFolder[i] + "');\" ></i>&nbsp;&nbsp;\n" +
                            "                            <i class=\"fas fa-trash-alt theme-color-text  <?php if($read_only) echo 'hide';?>\" onclick=\"delet('demand-folder/" + demandFolder[i] + "');\"></i>&nbsp;&nbsp;</span>\n" +
                            "                        </span>\n" +
                            "                        </div>\n" +
                            "                        </div>";

                        $('#demand-collapsible > li ').append(data);
                    }
                }
            },
            error: function (x1, x2, x3) {
                error_msg('Error', 'Error reaching the server');
            }
        });
    }
	<?php }?>
    function saveData() {
        var loader = "<center><br><img src='../images/image_1220188.gif' height=30 /><br><br></center>";
        var html = $('#cpltebtn').html();

        $('#cpltebtn').html(loader);
        if (folder === '' || reg.thepdf.value === '' || $('#uname').val() === '' || reg.thepdf.value === null) {
            error_msg('Error', 'Something is not complete');
            $('#cpltebtn').html(html);
        }
        $.ajax({
            url: '',
            type: 'POST',
            data: {
                'file': reg.thepdf.value,
                'name': $('#uname').val(),
                'add-file-to-folder': 1,
                'folder': folder,
                'id': '<?php echo $_GET['__did'];?>'
            },
            success: function (message) {
                console.log(message);
                $('#cpltebtn').html(html);
                if (message == '1') {
                    reg.reset();
                    Materialize.toast('Successful Operation', 500);
                    $('#demand-modal').modal('close');
                    getFiles();
                } else {
                    Materialize.toast('That didnt work', 500);
                }
            },
            error: function (x1, x2, x3) {
                error_msg('Error', 'Error reaching the server');
                $('#cpltebtn').html(html);
            }
        });
    }

    var folder = '';

    function view(filename) {
        $('iframe').attr('src', '../pdf%20reader/web/viewer.html?file=' + encodeURI('<?php
			;
			echo Server::ROOT_PATH . 'demand-content/demand-' . $i . '/';
			?>' + filename));
    }

    function delet(filename) {
        $.ajax({
            url: '',
            type: 'POST',
            data: {
                'file': '<?php
					$i = DemandManager::getDemandFromHash( $_GET['__did'] )[0]['id'];
					echo Server::returnfolderLinkFromID( $i );
					?>/' + filename, 'delete-folder-file': 1
            },
            success: function (x1) {
                console.log(x1);
                if(x1===''){
                    error_msg('Success','Successful deletion!');
                    getFiles();
                }else{
                    error_msg('Error','That didnt work');
                }
            },
            error: function (x1, x2, x3) {
                error_msg('Error', 'error reaching server');
            }
        })
    }

    function download(filename) {
        var link = encodeURI('<?php
			$i = DemandManager::getDemandFromHash( $_GET['__did'] )[0]['id'];
			echo Server::ROOT_PATH . 'demand-content/demand-' . $i . '/';
			?>' + filename);
       /* $('#detective').attr('src', link);
        $('#detective')[0].click();*/
       window.location=link;
    }
</script>
</body>
<!--  var pdf = btoa(doc.output());
    $.ajax({
      method: "POST",
      url: "inc/test.php",
      data: {data: pdf},
    }).done(function(data){
       console.log(data);
    });
if(!empty($_POST['data'])){
$data = base64_decode($_POST['data']);
// print_r($data);
file_put_contents( "../tmp/test.pdf", $data );
} else {
echo "No Data Sent";
}
exit();

-->
</html>

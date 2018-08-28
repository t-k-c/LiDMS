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
	<?php include "../modules/head.php" ?>
</head>
<body style="background: #<?php echo Server::SECONDARY_COLOR; ?>;overflow-y: hidden">
<div id="loadingbar-frame">
    <div class="row" style="    padding: 0 8%;">
        <div class="col s5">
            <div class="logo-holder">
                <div class="tecta">
                    <img src="<?php echo Server::LOGO_SOURCE ?>">
                    <h3 class="white-text">MS</h3>
                </div>
            </div>
        </div>
        <div class="col s7 holder2" style="    padding: 0 4%;">
		<div class="frsts">
            <span class="input-lidms-span">
			<input type="text" placeholder="email or username" class="input-lidms" id="uname"/>
		</span>
            <br>
            <br>
            <span class="input-lidms-span">
			<input type="password" placeholder="password" class="input-lidms" id="upw"/>
		</span>
            <br>
            <br>
            <div  class="button-lidms" onclick="login()">
                CONNECT
            </div><p style="font-size: 0.9em"><span class="grey-text" style="
    font-size: 0.9em;
">Have no account ?</span>&nbsp;<a href="../signup" class="grey-text underline-button" style="
    font-size: 0.9em;
">Create account</a></p>
        </div>

            <center class="second" hidden>
                <p style="font-size: 0.9em"><span class="grey-text" style="
    font-size: 0.9em;
">Welcome operator. What do you want to do ?</p>
                <div  class="button-lidms" onclick="showThirdPart()">
                    CREATE DEMAND
                </div>
                <br>
                <div  class="button-lidms" onclick="">
                    FOLLOW UP DEMAND
                </div>
            </center>
            <center class="third" hidden>
                <p style="font-size: 0.9em"><span class="grey-text" style="
    font-size: 0.9em;
">Select a licence type to demand for.</p>
                <div  class="button-lidms" onclick="window.location='../cat-1-creation/'">
                    CATEGORY ONE
                </div>
                <br>
                <div  class="button-lidms" onclick="window.location='../cat-2-creation/'">
                    CATEGORY TWO
                </div>
            </center>
        </div>
    </div>
    <a href="../demand-selection" class=" ajax-call" id="next"></a>

    <script src="<?php echo Server::ROOT_PATH?>js/jquery.loadingbar.js"></script>
    <script src="<?php echo Server::ROOT_PATH?>js/alertify.js"></script>

    <script>
        function login() {

            showLoader();

            if($('#uname').val()===''||$('#upw').val()===''){
                alertify
                    .alert("Error","Some or all the obligatory fields are empty", function(){
                        /*alertify.message('OK');*/
                    });
                hideLoader();
                return;
            }

            $.ajax({
                url: '',
                type: 'POST',
                data: {'login': 1, 'username': $('#uname').val(), 'password': $('#upw').val()},
                success: function (message) {
                    console.log(message);
                    if(message==='1'){ //okay
                        alertify
                            .alert("Success","Click ok to continue", function(){
                              showLoader();
                                $('.frsts').slideUp(function(){
                                    $('.second').slideDown(function(){
                                        hideLoader();
                                    });
                                });
                            });
                    }else if(message==='2'){ // wrong credentials
                        alertify
                            .alert("Error","Wrong credentials. Try again", function(){
                                /*alertify.message('OK');*/

                            });
                    }else if(message==='0'){ // no such user
                        alertify
                            .alert("Error","No such user. Try again", function(){
                                /*alertify.message('OK');*/
                            });
                    }
                    hideLoader();
                },
                error: function (x1, x2, x3) {
                    alertify
                        .alert("Connection error!", function(){
                            alertify.message("Error",'Verify you have a working connection');
                        });
                    hideLoader();
                }
            });
        }
        function showThirdPart(){
            showLoader();
            $('.second').slideUp(function(){
                $('.third').slideDown(function(){
                    hideLoader();
                });
            });
        }
    </script>
	<?php include '../modules/loader.php';?>
</div>
</body>
</html>

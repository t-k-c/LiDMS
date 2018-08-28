<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 19/07/2018
 * Time: 12:55
 */
include  "../modules/imports.php";
?>
<html>
<head>
	<?php include "../modules/head.php"?>
</head>
<body style="background: #<?php echo Server::SECONDARY_COLOR;?>;overflow-y: hidden">
<div class="row" style="    padding: 0 8%;">
	<div class="col s5">
		<div class="logo-holder">
			<div class="tecta"  >
				<img src="<?php echo Server::LOGO_SOURCE?>">
				<h3 class="white-text">MS</h3>
			</div>
		</div>
	</div>
    <form name="reg">

	<div class="col s7 holder2" style="    padding: 0 4%;">

		<span class="input-lidms-span frsts">
			<input type="text" placeholder="name" class="input-lidms" id="company"/>
		</span>
		<br>
		<span class="input-lidms-span frsts">
			<input type="text" placeholder="username" class="input-lidms" id="username"/>
		</span>
		<br>
		<span class="input-lidms-span frsts">
			<input type="text" placeholder="email@email.com" class="input-lidms" id="email"/>
		</span>
		<br>
		<span class="input-lidms-span frsts">
			<input type="text" placeholder="address" class="input-lidms" id="address"/>
		</span>
		<br>
		<span class="input-lidms-span frsts">
			<input type="text" placeholder="activity sector" class="input-lidms" id="activity"/>
		</span>
		<br>
		<span class="input-lidms-span frsts">
			<input type="password" placeholder="password" class="input-lidms" name="passowrd" id="passowrd"/>
		</span>
		<br>
		<a href="#!" class="button-lidms frsts" onclick="signup()">
			CREATE ACCOUNT
		</a>

		<p style="font-size: 0.9em" class="frsts"><span class="grey-text" style="
    font-size: 0.9em;
">Have an account ?</span>&nbsp;<a href="../login" class="grey-text underline-button" style="
    font-size: 0.9em;
">Login</a></p>


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
    </form>
</div>
<script src="<?php echo Server::ROOT_PATH?>js/alertify.js"></script>
<script>
    function signup() {

        showLoader();

        if( $('#company').val()===''||
            $('#username').val()===''||
            $('#email').val()===''||
            $('#address').val()===''||
            $('#activity').val()===''||
            reg.passowrd.value===''){
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
            data: {'signup': 1,
                'company': $('#company').val(),
                'username': $('#username').val(),
                'email': $('#email').val(),
                'address': $('#address').val(),
                'activity': $('#activity').val(),
                'password': reg.passowrd.value
            },
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
                        .alert("Error","The username &/or email address already exists", function(){
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
</body>
</html>

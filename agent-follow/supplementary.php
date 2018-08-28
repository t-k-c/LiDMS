<?php
/**
 * Created by PhpStorm.
 * User: codename-tkc
 * Date: 23/07/2018
 * Time: 02:45
 */
include_once '../modules/imports.php';
$id = $_GET['id'];
$xn = $_GET['xn'];
//echo $xn;
$dueDate    = explode( '|', $xn );
$dateparams = explode( ' ', $dueDate[5] );
$demandInfo = Server::executeWithResult( "SELECT * FROM user,demand WHERE demand.id = ? AND user.id = demand.user_id ", array( $id ) );

?>
<style>
    .loader {
        display: none;
    }
</style>
<div style="padding:2%;">
    <div class="bordered" style="padding: 2%;">
        <div class="row" style="display: flex">
            <div class="col s7">
                <h6 style="font-size: 1.5rem;"><b><?php echo $demandInfo[0]['name'] ?>
                        [ct:<?php echo DemandManager::getDemandType( sha1( $id ) ); ?>]</b></h6>
                <p style="margin: 0;"><?php echo $demandInfo[0]['title'] ?></p>
            </div>
            <div class="col s5 no-padding" style="display: flex">
                <div class="col s4" style="display: flex;flex-direction: column;justify-content: center;">
                    <h4 style="text-align: right"><b><?php echo $dateparams[0] ?></b></h4>
                </div>
                <div class="col s8 no-padding" style="display: flex;flex-direction: column;justify-content: center;">
                    <h6 class="no-margin"><?php echo $dateparams[1] ?></h6>
                    <h6 class="no-margin"><?php echo $dateparams[2] ?><?php echo $dateparams[3] ?></h6>
                </div>
            </div>
        </div>
        <hr style="border: 1px solid rgba(0,0,0,0.05);">
        <div class="row">
            <div class="col s3">
                <center>
                    <span><h4><b><i class="fas fa-times"></i>&nbsp;<?php echo count( Server::executeWithResult( "SELECT * FROM affectation WHERE state = 2 AND demand_id  = ? ", array( $id ) ) ); ?></b></h4></span><span>rejected</span>
                </center>
            </div>
            <div class="col s3">
                <center><span><h4><b><i class="fas fa-calendar-alt"></i>&nbsp;<?php echo explode( '|', $xn )[0]; ?></b></h4></span><span>days left</span>
                </center>
            </div>
            <div class="col s3">
                <center>
                    <span><h4><b><i class="fas fa-undo"></i>&nbsp;<?php echo count( Server::executeWithResult( "SELECT * FROM affectation  WHERE  demand_id = ?  AND destination>=0 ", array( $id ) ) ); ?></b></h4></span><span>review</span>
                </center>
            </div>
            <div class="col s3">
                <center><span><h4><b><i class="fas fa-spinner"></i>&nbsp;<?php echo explode( '|', $xn )[4]; ?></b></h4></span><span>%</span>
                </center>
            </div>
        </div>
        <br>
        <div class="right">
            <a href="#!" class="button-lidms theme-color" onclick="window.location='../logs?__did=<?php echo $id?>'">
                <span><i class="fab fa-dyalog"></i>&nbsp;&nbsp;Download Logs</span>
            </a>
            &nbsp;
            &nbsp;
            <a href="#!" class="button-lidms theme-color" onclick="window.location='../s3?__did=<?php echo sha1($id);?>&__t=<?php echo DemandManager::getDemandType(sha1($id));?>&__ro=1'">
                <span><i class="fas fa-file-archive"></i>&nbsp;&nbsp;Explore Demand</span>
            </a>

        </div>
        <br>
        <br>
    </div>
    <br>
    <br>
    <center>
        <a href="#!" class="button-lidms theme-color">
            &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Timeline&nbsp;&nbsp;</span>
        </a>
    </center>
    <br>
	<?php
	$i            = 0;
	$affectations = Server::executeWithResult( "SELECT *,UNIX_TIMESTAMP(date) as timestamp FROM affectation WHERE demand_id = ? ", array( $id ) );
	foreach ( $affectations as $affectation ) {
	    ?>
		<?php
		$state = $affectation['state'];
		$user = UserManager::getUserFromUID($affectation['user_id'])[0];
		$cc='';
		switch ($state){
			case 0: $cc= $user['name'].' created the demand';break;
			case -1: $cc= $user['name'].' modified the demand';break;
			case -2: $cc= $user['name'].' added a document the demand';break;
			case 2: $cc= $user['name'].' rejected the demand';break;
			case 1: $cc= $user['name'].' approved the demand';break;
		}
		$csc='';
		switch ($state){
			case 0:$csc= ' Creation';break;
			case -1: $csc= ' Modification';break;
			case -2: $csc= ' Addition';break;
			case 2: $csc= ' Rejection';break;
			case 1: $cc= ' Approval';break;
		}
		?>
        <?php
	    if($i%2==0){
		    ?>

            <div class="timeline-holder" >

                <div class="row" style="display: flex;margin-top: 1.7em">
                    <div class="col s6" style="border-right: 1px solid #529979;display: flex;
		flex-direction: row;
		justify-content: flex-end;
		align-items: center;">
                        <a href="#!" class="button-lidms theme-color" >
                            &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;<?php echo $csc?>&nbsp;&nbsp;</span>
                        </a>
                        <div class="dot"></div>
                    </div>
                    <div class="col s6" style="border-left: 1px solid #529979;">
	                    <?php  $val = date( 'd D M Y',$affectation['timestamp']); ?>
                        <div class="message">
									<span class="thecc">
									   <div class="row" style="display: flex;margin-bottom: 0;">
											<div class="col no-padding" style="display: flex;flex-direction: column;justify-content: center;">
									<h4 style="text-align: right;margin: 0"><b><?php echo explode(' ',$val)[0]?></b></h4>
								</div>

								<div class="col  no-padding" style="display: flex;flex-direction: column;justify-content: center;">
									<h6 class="no-margin"><?php echo explode(' ',$val)[1]?></h6>
									<h6 class="no-margin"><?php echo explode(' ',$val)[2]?> <?php echo explode(' ',$val)[3]?></h6>
								</div>
									   </div>
                                        <?php
                                         $state = $affectation['state'];
                                         $user = UserManager::getUserFromUID($affectation['user_id'])[0];
                                         $cc='';
                                         switch ($state){
                                             case 0: $cc= $user['name'].' created the demand';break;
                                             case -1: $cc= $user['name'].' modified the demand';break;
                                             case -2: $cc= $user['name'].' added a document the demand';break;
                                             case 2: $cc= $user['name'].' rejected the demand';break;
                                             case 1: $cc= $user['name'].' approved the demand';break;
                                         }
                                        ?>
										<p style="margin: 5px 0"><i class="fas fa-info theme-color-text"></i>&nbsp;&nbsp;<span style="color:rgba(0,0,0,0.4)"><?php echo  $cc;?> </span></p>
										<?php echo $affectation['comment'];?>
									</span>
                        </div>
                    </div>
                </div>
            </div>
		    <?php
        }else{
		    ?>
            <div class="timeline-holder" >

                <div class="row" style="display: flex;margin-top: 1.7em">
                    <div class="col s6" style="border-right: 1px solid #529979;display: flex;
	flex-direction: row;
	justify-content: flex-end;
	align-items: center;">
	                    <?php  $val = date( 'd D M Y',$affectation['timestamp']); ?>
                        <div class="message">
									<span class="thecc">
									   <div class="row" style="display: flex;margin-bottom: 0;">
											<div class="col no-padding" style="display: flex;flex-direction: column;justify-content: center;">
									<h4 style="text-align: right;margin: 0"><b><?php echo explode(' ',$val)[0]?></b></h4>
								</div>

								<div class="col  no-padding" style="display: flex;flex-direction: column;justify-content: center;">
									<h6 class="no-margin"><?php echo explode(' ',$val)[1]?></h6>
									<h6 class="no-margin"><?php echo explode(' ',$val)[2]?> <?php echo explode(' ',$val)[3]?></h6>
								</div>
									   </div>

                                        <p style="margin: 5px 0"><i class="fas fa-info theme-color-text"></i>&nbsp;&nbsp;<span style="color:rgba(0,0,0,0.4)"><?php echo  $cc;?> </span></p>
										<?php echo $affectation['comment'];?>
									</span>
                        </div>
                    </div>
                    <div class="col s6" style="border-left: 1px solid #529979;display: flex;
	flex-direction: row;
	justify-content: flex-start;
	align-items: center;">
                        <div class="dot2"></div><a href="#!" class="button-lidms theme-color" >
                            &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;<?php echo $csc?>&nbsp;&nbsp;</span>
                        </a>


                    </div>
                </div>
            </div>
		    <?php
        }
        $i++;
	}
	 $splitdate = explode(' ', date('d D M Y',time()));
	if($i%2!=0){

	?>

        <div class="timeline-holder" >

            <div class="row" style="display: flex;margin-top: 1.7em">
                <div class="col s6" style="border-right: 1px solid #529979;display: flex;
	flex-direction: row;
	justify-content: flex-end;
	align-items: center;">
                    <div class="message">

								<span class="thecc">
								   <div class="row" style="display: flex;margin-bottom: 0;">
										<div class="col no-padding" style="display: flex;flex-direction: column;justify-content: center;">
								<h4 style="text-align: right;margin: 0"><b><?php echo $splitdate[0];?></b></h4>
							</div>
							<div class="col  no-padding" style="display: flex;flex-direction: column;justify-content: center;">
								<h6 class="no-margin"><?php echo $splitdate[1];?></h6>
								<h6 class="no-margin"><?php echo $splitdate[2];?> <?php echo $splitdate[3];?></h6>
							</div>
								   </div>


                                      <p id="review-content"></p><br>
						   <center>
							   <a href="#!" class="button-lidms red" onclick="reject()">
								   &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Reject&nbsp;&nbsp;</span>
							   </a>&nbsp;&nbsp;<a href="#!" class="button-lidms theme-color" onclick="accept()">
								   &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Accept&nbsp;&nbsp;</span>
							   </a>
							   <br>
							   <br>
							   <br>
                               </a>&nbsp;<a href="#!" class="button-lidms blue"  onclick="review()">
								   &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Review&nbsp;&nbsp;</span>
							   </a>
						   </center>
							<br>
								</span>
                    </div>
                </div>
                <div class="col s6" style="border-left: 1px solid #529979;display: flex;
	flex-direction: row;
	justify-content: flex-start;
	align-items: center;">
                    <div class="dot2"></div><a href="#!" class="button-lidms grey" >
                        &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;waiting&nbsp;&nbsp;</span>
                    </a>


                </div>
            </div>
        </div>

    <?php }else{ ?>
        <div class="timeline-holder" >

            <div class="row" style="display: flex;margin-top: 1.7em">
                <div class="col s6" style="border-right: 1px solid #529979;display: flex;
	flex-direction: row;
	justify-content: flex-end;
	align-items: center;">
                    <a href="#!" class="button-lidms grey" >
                        &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;waiting&nbsp;&nbsp;</span>
                    </a>
                    <div class="dot"></div>
                </div>
                <div class="col s6" style="border-left: 1px solid #529979;">

                    <div class="message">
								<span class="thecc">
								  <div class="row" style="display: flex;margin-bottom: 0;">
										<div class="col no-padding" style="display: flex;flex-direction: column;justify-content: center;">
								<h4 style="text-align: right;margin: 0"><b><?php echo $splitdate[0];?></b></h4>
							</div>
							<div class="col  no-padding" style="display: flex;flex-direction: column;justify-content: center;">
								<h6 class="no-margin"><?php echo $splitdate[1];?></h6>
								<h6 class="no-margin"><?php echo $splitdate[2];?> <?php echo $splitdate[3];?></h6>
							</div>
								   </div>

							<br>
                                    <p id="review-content"></p><br>
						   <center>
							   <a href="#!" class="button-lidms red" onclick="reject()" >
								   &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Reject&nbsp;&nbsp;</span>
							   </a>&nbsp;&nbsp;<a href="#!" class="button-lidms theme-color" onclick="accept()"  >
								   &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Accept&nbsp;&nbsp;</span>
							   </a>
							   <br>
							   <br>
							   <br>
                               </a>&nbsp;<a href="#!" class="button-lidms blue" onclick="review()" >
								   &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Review&nbsp;&nbsp;</span>
							   </a>
						   </center>
							<br>
								</span>
                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
    <!-- the time line should show here -->
    <!--right with text -->
    <!--	<div class="timeline-holder" >

			<div class="row" style="display: flex;margin-top: 1.7em">
				<div class="col s6" style="border-right: 1px solid #529979;display: flex;
		flex-direction: row;
		justify-content: flex-end;
		align-items: center;">
					<a href="#!" class="button-lidms theme-color" >
						&nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Timeline&nbsp;&nbsp;</span>
					</a>
					<div class="dot"></div>
				</div>
				<div class="col s6" style="border-left: 1px solid #529979;">

					<div class="message">
									<span class="thecc">
									   <div class="row" style="display: flex;margin-bottom: 0;">
											<div class="col no-padding" style="display: flex;flex-direction: column;justify-content: center;">
									<h4 style="text-align: right;margin: 0"><b>30</b></h4>
								</div>
								<div class="col  no-padding" style="display: flex;flex-direction: column;justify-content: center;">
									<h6 class="no-margin">Thursday</h6>
									<h6 class="no-margin">October 2018</h6>
								</div>
									   </div>
										<p style="margin: 5px 0"><i class="fas fa-info theme-color-text"></i>&nbsp;&nbsp;<span style="color:rgba(0,0,0,0.4)">John Doe approved </span></p>
										orem Ipsum is simply dummy text of the
									printing and typesetting industry.
									Lorem Ipsum has been the industry's
									standard dummy text ever since the 1500s,
									when an unknown printer took a galley of
									type and scrambled it to make a type specimen book.
									It has survived not only five centuries,
									</span>
					</div>
				</div>
			</div>
		</div>-->
    <!--left with text -->
    <!--<div class="timeline-holder" >

		<div class="row" style="display: flex;margin-top: 1.7em">
			<div class="col s6" style="border-right: 1px solid #529979;display: flex;
	flex-direction: row;
	justify-content: flex-end;
	align-items: center;">
				<div class="message">
								<span class="thecc">
								   <div class="row" style="display: flex;margin-bottom: 0;">
										<div class="col no-padding" style="display: flex;flex-direction: column;justify-content: center;">
								<h4 style="text-align: right;margin: 0"><b>30</b></h4>
							</div>
							<div class="col  no-padding" style="display: flex;flex-direction: column;justify-content: center;">
								<h6 class="no-margin">Thursday</h6>
								<h6 class="no-margin">October 2018</h6>
							</div>
								   </div>
									<p style="margin: 5px 0"><i class="fas fa-info theme-color-text"></i>&nbsp;&nbsp;<span style="color:rgba(0,0,0,0.4)">John Doe approved </span></p>
									orem Ipsum is simply dummy text of the
								printing and typesetting industry.
								Lorem Ipsum has been the industry's
								standard dummy text ever since the 1500s,
								when an unknown printer took a galley of
								type and scrambled it to make a type specimen book.
								It has survived not only five centuries,
								</span>
				</div>
			</div>
			<div class="col s6" style="border-left: 1px solid #529979;display: flex;
	flex-direction: row;
	justify-content: flex-start;
	align-items: center;">
				<div class="dot2"></div><a href="#!" class="button-lidms theme-color" >
					&nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Timeline&nbsp;&nbsp;</span>
				</a>


			</div>
		</div>
	</div>-->
    <!--left with buttons -->
    <!--<div class="timeline-holder" >

		<div class="row" style="display: flex;margin-top: 1.7em">
			<div class="col s6" style="border-right: 1px solid #529979;display: flex;
	flex-direction: row;
	justify-content: flex-end;
	align-items: center;">
				<div class="message">
								<span class="thecc">
								   <div class="row" style="display: flex;margin-bottom: 0;">
										<div class="col no-padding" style="display: flex;flex-direction: column;justify-content: center;">
								<h4 style="text-align: right;margin: 0"><b>30</b></h4>
							</div>
							<div class="col  no-padding" style="display: flex;flex-direction: column;justify-content: center;">
								<h6 class="no-margin">Thursday</h6>
								<h6 class="no-margin">October 2018</h6>
							</div>
								   </div>

							<br>
						   <center>
							   <a href="#!" class="button-lidms theme-color" >
								   &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Timeline&nbsp;&nbsp;</span>
							   </a>&nbsp;&nbsp;<a href="#!" class="button-lidms theme-color" >
								   &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Timeline&nbsp;&nbsp;</span>
							   </a>
							   <br>
							   <br>
							   <br>
							   </a>&nbsp;<a href="#!" class="button-lidms theme-color" >
								   &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Timeline&nbsp;&nbsp;</span>
							   </a>
						   </center>
							<br>
								</span>
				</div>
			</div>
			<div class="col s6" style="border-left: 1px solid #529979;display: flex;
	flex-direction: row;
	justify-content: flex-start;
	align-items: center;">
				<div class="dot2"></div><a href="#!" class="button-lidms grey" >
					&nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;waiting&nbsp;&nbsp;</span>
				</a>


			</div>
		</div>
	</div>-->
    <!--left with buttons -->
    <!--<div class="timeline-holder" >

		<div class="row" style="display: flex;margin-top: 1.7em">
			<div class="col s6" style="border-right: 1px solid #529979;display: flex;
	flex-direction: row;
	justify-content: flex-end;
	align-items: center;">
				<a href="#!" class="button-lidms grey" >
					&nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;waiting&nbsp;&nbsp;</span>
				</a>
				<div class="dot"></div>
			</div>
			<div class="col s6" style="border-left: 1px solid #529979;">

				<div class="message">
								<span class="thecc">
								   <div class="row" style="display: flex;margin-bottom: 0;">
										<div class="col no-padding" style="display: flex;flex-direction: column;justify-content: center;">
								<h4 style="text-align: right;margin: 0"><b>30</b></h4>
							</div>
							<div class="col  no-padding" style="display: flex;flex-direction: column;justify-content: center;">
								<h6 class="no-margin">Thursday</h6>
								<h6 class="no-margin">October 2018</h6>
							</div>
								   </div>

							<br>
						   <center>
							   <a href="#!" class="button-lidms theme-color" >
								   &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Timeline&nbsp;&nbsp;</span>
							   </a>&nbsp;&nbsp;<a href="#!" class="button-lidms theme-color" >
								   &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Timeline&nbsp;&nbsp;</span>
							   </a>
							   <br>
							   <br>
							   <br>
							   </a>&nbsp;<a href="#!" class="button-lidms theme-color" >
								   &nbsp;&nbsp;<span><i class="fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Timeline&nbsp;&nbsp;</span>
							   </a>
						   </center>
							<br>
								</span>
				</div>
			</div>
		</div>
	</div>-->

</div>
<script src="<?php echo Server::ROOT_PATH?>js/alertify.js"></script>
<script>
    function review(){
        var prom= prompt('Write a review','Something here');
        if(prom!==null){
            $('#review-content').text(prom);
        }
    }
    function accept(){
        if($('#review-content').text()===''){
            error_msg('Error','Please mention a review');
            return;
        }
        $.ajax({
            url:'',
            type:'POST',
            data:{'accept-demand':1,'statement':$('#review-content').text(),'demand':<?php echo $id;?>},
            success:function(x1){
                console.log(x1);
                reload();
            },
            error:function(x1,x2,x3){
                error_msg('Error','Error reaching server');
            }
        })
    }
    function reject(){
        if($('#review-content').text()===''){
            error_msg('Error','Please mention a review');
            return;
        }
        $.ajax({
            url:'',
            type:'POST',
            data:{'reject-demand':1,'statement':$('#review-content').text(),'demand':<?php echo $id;?>},
            success:function(x1){
                console.log(x1);
                reload();
            },
            error:function(x1,x2,x3){
                error_msg('Error','Error reaching server');
            }
        })
    }
    function reload(){
        load();
        loadDemand('<?php echo $id?>','<?php echo $xn;?>');
    }
</script>

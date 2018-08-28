    <?php include_once '../modules/imports.php'; ?>
<html>
<head>
	<?php include_once '../modules/head.php'; ?>
    <style>
        input.input-lidms {
            border: 2px dotted rgba(0, 0, 0, 0.1) !important;
            color: rgba(0, 0, 0, 0.8) !important;
            margin-bottom: 10px !important;
        }

        .input-lidms:focus {
            border: 2px dotted #6EDAA1 !important;
        }

        textarea.input-lidms {
            border: 2px dotted rgba(0, 0, 0, 0.1) !important;
            color: rgba(0, 0, 0, 0.8) !important;
            margin-bottom: 10px !important;
            resize: none;
        }

        .input-lidms:focus {
            border: 2px dotted #6EDAA1 !important;
        }
        .orange-bar{

        }
        .#529979-bar{

        }
        .red-bar{

        }
        .no-padding{
            padding:0;
        }
        .no-margin{
            margin:0;
        }
        .message{
            background: #f2f2f2;
            padding:20px;
            margin: 5px;
        }
        .thecc{
            font-size: 0.8em;
        }
        .dot{
            height: 16px;
            width: 16px;
            border-radius: 50%;
            background: #529979;
            position: absolute;
            margin-left: 44px;
            border: 2px solid white;
        }
        .dot2{
            height: 16px;
            width: 16px;
            border-radius: 50%;
            background: #529979;
            position: absolute;
            margin-left: -44px;
            border: 2px solid white;
        }
        .timeline-holder > .row{
            margin:0!important;
        }
        .timeline-holder  .col.s6{
            padding:4%;
        }
        .item-green > div {
            border-left: 2px solid rgba(0,255,0,0.9);
        }.item-yellow > div{
            border-left: 2px solid rgba(255,255,0,0.9);
         }.item-red > div{
            border-left: 2px solid rgba(255,0,0,0.9);
          }
        .item-green:hover{
            background:rgba(0,255,0,0.2);
        }
        .item-orange:hover{
            background:rgba(255,255,0,0.2);
        }
        .item-red:hover{
            background:rgba(255,0,0,0.2);
        }
    </style>
</head>
<body>
<div class="row" style="margin-bottom: 0;">
    <div class="row" style="margin-bottom: 0;">
        <div class="col s3  z-depth-1-half" style="border-left: 2px;height: 100%;padding: 0;position: fixed;">
            <center>
                <span style="color: #000;font-size: 1.5em;"><img src="../images/logo/LiDMS.png" height="30px" style="position: relative;top: 10px;"/>emands</span>
                <div class="theme-color" style="width: 60px;height: 3px;position: relative;left: 10px;"></div>
            </center>
            <br>
            <div class="row theme-color" style="padding: 13px 0">
                <div class="col s3"><center><i class="fas fa-book white-text " style="font-size: 1.2em"></i></center>
                </div>
                <div class="col s3"><center><i class="fas fa-calendar-alt white-text" style="font-size: 1.2em"></i></center></div>
                <div class="col s3"><center><i class="fas fa-user-alt white-text" style="font-size: 1.2em"></i></center></div>
                <div class="col s3"><center><i class="fas fa-flag white-text" style="font-size: 1.2em"></i></center></div>

            </div>
            <div style="padding: 0.1% 4%;">
                <span class="input-lidms-span"><input id="responsible-name" type="text"
                                                      placeholder="Enter the required value"
                                                      class="input-lidms" style="text-indent: 40px;"/>
                <i class="fas fa-search theme-color-text" style="position: absolute;
    margin-top: -42px;
    margin-left: 18px;"></i>
                </span>
            </div>
            <div class="demands">

            </div>
            <center id="loader"><br><img src='../images/image_1220188.gif' height=60 id="un1" /></center>
<!--            list of sections -->
         <!--   <div  style="padding: 5px 10px;">
                <div style="border-left: 3px solid #529979;padding: 1px 0 1px 10px;">
                    <h6 style="margin-bottom: 3px;"> <span class="left">Enterprise</span>
                        <span class="right">30%</span><br></h6>
                    <p style="margin: 0;font-size: 0.8em" class="grey-text">Licence for the operation ....</p>
                    <div style="margin-top: 3px;">
                        <span class="left">30 left</span>
                        <span class="right">30 June</span>
                        <br>
                    </div>
                </div>
            </div>-->


        </div>
        <div class="col s9" style="overflow:auto;position: relative;left: 25%" id='sectionLoad'>
          <?php include_once 'default.php';?>
        </div>

    </div>
</div>
<script>
    $(document).ready(function(){
       load();
    });
    var thedata;
    function load() {
        $.ajax({
            url: '',
            type: 'POST',
            data: {'agent-demand-list': 1},
            success: function (x1) {
                var jsondata = JSON.parse(x1);
                console.log(jsondata);
                for (var i = 0; i < jsondata.length; i++) {
                     thedata = jsondata[i];
                     console.log(thedata);
                  loadMore(thedata);
                } $('#loader').remove();
//                $('.demands > center').remove();
            },
            error: function (x1, x2, x3) {
                $('#loader').remove();

                error_msg('Error', 'Cant reach server');
            }
        });
    }

    function loadDemand(id,data){
        $('#sectionLoad').html('<center id="loader"><br><br><br><br><img src=\'../images/image_1220188.gif\' height=60 id="un1" /></center>');
        $('#sectionLoad').load('supplementary.php?id='+id+"&xn="+encodeURI(data),function(){

        });
    }
    function loadMore(thedata){
        $.ajax({
            url: '',
            type: 'POST',
            data: {'agent-demand-calculation': 1, 'id': thedata.demand_id},
            success: function (xn) {
                console.log(xn);

                var days = parseInt(xn.split('|')[2]);
                var cls='item-green';
                if(days > 40){
                    cls='item-orange';
                }else{
                    cls='item-green';
                }
                if(thedata.state==='2'){
                    cls='item-red'
                }
//                            console.log(thedata);

                var dd = "<div  style=\"padding: 5px 10px;cursor:pointer;\" class=\""+cls+"\" onclick=\"loadDemand('"+thedata.demand_id+"','"+xn+"')\">\n" +
                    "                <div style=\"border-left: 3px solid #529979;padding: 1px 0 1px 10px;\">\n" +
                    "                <h6 style=\"margin-bottom: 3px;\"> <span class=\"left\">" + thedata.name + "</span>\n" +
                    "                <span class=\"right\">"+xn.split('|')[4]+"%</span><br></h6>\n" +
                    "            <p style=\"margin: 0;font-size: 0.8em\" class=\"grey-text\">" + thedata.title + "</p>\n" +
                    "            <div style=\"margin-top: 3px;\">\n" +
                    "                <span class=\"left\">" + xn.split('|')[0] + " left</span>\n" +
                    "            <span class=\"right\">" + xn.split('|')[3] + "</span>\n" +
                    "            <br>\n" +
                    "            </div>\n" +
                    "            </div>\n" +
                    "            </div>";
                console.log(dd);
                $('.demands ').append(dd);

            },
            error: function (x1, x2, x3) {
                error_msg('Error', 'Cant reach server');
                $('#loader').remove();

            }
        });
    }

</script>
</body>
</html>

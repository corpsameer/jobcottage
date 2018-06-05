<!DOCTYPE html>
<?php include("../database/connection.php");
@session_start();
if(!isset($_SESSION['user']))
	header("Location:index.php");
else
{		
	$user_name=mysql_real_escape_string($_SESSION['user']);			
	$res=mysql_fetch_array(mysql_query("select * from sv_admin_login where user_name='$user_name'"));
	$uname=mysql_real_escape_string($res['user_name']);
}	
$page = 'dashboard';
?>
<html xmlns="http://www.w3.org/1999/xhtml">


<!-- Mirrored from webthemez.com/demo/bluebox-free-bootstrap-admin-template/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 25 May 2016 07:03:23 GMT -->

<body>
    <div id="wrapper">
             <?php
			 include('top_menu.php');
			 include('side_menu.php');
			 ?>
		<div id="page-wrapper">
		  <div class="header"> 
                        <h1 class="page-header">
                            Dashboard <small>Summary of your App</small>
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li class="active">Dashboard</li>
					</ol> 
									
		</div>
            <div id="page-inner">

                <!-- /. ROW  -->
				<?php 
				$curr_date=date("Y-m-d");
				$query=mysql_query("select * from sv_users where curr_date='$curr_date'");
				$num=mysql_num_rows($query);
				
				$query2=mysql_query("select * from sv_users");
				$num2=mysql_num_rows($query2);
				
				$seller_query=mysql_query("select * from sv_users where curr_date='$curr_date' and user_type='seller'");
				$seller_count=mysql_num_rows($seller_query);
				
				$booking_query=mysql_query("select * from sv_booking where curr_date='$curr_date'");
				$booking_count=mysql_num_rows($booking_query);
				
				?>

                <div class="row">
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder orange">
                            <div class="panel-left pull-left">
                                <i class="fa fa-user-o fa-5x"></i>                                
                            </div>
                            <div class="panel-right">
								<h3><?php echo $num; ?></h3>
                               <strong> Today Users &nbsp;</strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder green">
                              <div class="panel-left pull-left">
                                <i class="fa fa-address-book-o  fa-5x"></i>
								</div>
                                
                            <div class="panel-right">
							<h3><?php echo $seller_count; ?></h3>
                               <strong> Today Seller</strong>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder blue">
                            <div class="panel-left pull-left">
                                <i class="fa fa-users fa-5x"></i>
                               
                            </div>
                            <div class="panel-right">
							 <h3><?php echo $num2; ?> </h3>
                               <strong> Total Users </strong>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder dark-blue">
                            <div class="panel-left pull-left">
                                <i class="fa fa-bookmark fa-5x"></i>
                                
                            </div>
                            <div class="panel-right">
							<h3><?php echo $booking_count; ?> </h3>
                             <strong>Today Booking</strong>

                            </div>
                        </div>
                    </div>
                </div>
				
				
   <?php

$curr_date=date("Y-m-d");

$last_date1=date('Y-m-d',strtotime("-1 days"));
$last_date2=date('Y-m-d',strtotime("-2 days"));
$last_date3=date("Y-m-d", strtotime("-3 days"));
$last_date4=date("Y-m-d", strtotime("-4 days"));
$last_date5=date("Y-m-d", strtotime("-5 days"));
$last_date6=date("Y-m-d", strtotime("-6 days"));


$date1=mysql_num_rows(mysql_query("select * from sv_booking where curr_date='$curr_date'"));
$date2=mysql_num_rows(mysql_query("select * from sv_booking where curr_date='$last_date1'"));
$date3=mysql_num_rows(mysql_query("select * from sv_booking where curr_date='$last_date2'"));
$date4=mysql_num_rows(mysql_query("select * from sv_booking where curr_date='$last_date3'"));
$date5=mysql_num_rows(mysql_query("select * from sv_booking where curr_date='$last_date4'"));
$date6=mysql_num_rows(mysql_query("select * from sv_booking where curr_date='$last_date5'"));
$date7=mysql_num_rows(mysql_query("select * from sv_booking where curr_date='$last_date6'"));

$javas="{ label: '$last_date6', y: $date7 },";
$javas.="{ label: '$last_date5', y: $date6 },";
$javas.="{ label: '$last_date4', y: $date5 },";
$javas.="{ label: '$last_date3', y: $date4 },";
$javas.="{ label: '$last_date2', y: $date3 },";
$javas.="{ label: '$last_date1', y: $date2 },";
$javas.="{ label: '$curr_date', y: $date1 },";


?>
<h3 class="chart-title">Last 7 Days Booking Report</h3>
 
	<script type="text/javascript">
	window.onload = function () {
			var dps = [
		<?php echo $javas;?>
		];
		
		var chart = new CanvasJS.Chart("chartContainer",
		{
			
			 
			title:{
				//text: "Last 7 Days Order Report",
				fontSize:20,
				titleFontFamily: "Open Sans, sans-serif"
			},
			
                        animationEnabled: true,
			axisX:{

				gridColor: "Silver",
				tickColor: "silver"
				//valueFormatString: "DD/MMM"

			},                        
                        toolTip:{
                          shared:true
                        },
			theme: "theme2",
			axisY: {
				gridColor: "Silver",
				tickColor: "silver"
			},
			legend:{
				verticalAlign: "center",
				horizontalAlign: "right"
			},
			data: [
			{        
				type: "line",
				showInLegend: true,
				lineThickness: 2,
				name: "Orders",
				markerType: "square",
				color: "#F08080",
				dataPoints: dps
			}			
			],
			axisX: {
        title: "Last 7 days",
       // titleFontFamily: "comic sans ms"
      },
			axisY: {
        title: "No of Booking",
        //titleFontFamily: "comic sans ms"
      },
          legend:{
            cursor:"pointer",
            itemclick:function(e){
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
              	e.dataSeries.visible = false;
              }
              else{
                e.dataSeries.visible = true;
              }
              chart.render();
            }
          }
		});

chart.render();
}
</script>
<script type="text/javascript" src="js/canvasjs.min.js"></script>


	<div id="chartContainer" style="height: 300px; width: 100%;">
	</div>

				
			<?php include("footer.php") ?></div>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
   


</body>


</html>
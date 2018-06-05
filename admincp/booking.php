<?php include("../database/connection.php"); ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<?php 
	$page = 'booking';
?>


  <body class="splash-index">
   
<?php include("top_menu.php") ?>

 <?php include("side_menu.php") ?>

<div id="page-wrapper" >
		
		  <div class="header"> 
                        <h1 class="page-header">
                            Booking Details
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Booking</a></li>
					  
					</ol>		
		</div>
            <div id="">
			    <div class="panel-body">
						
			<div id="page-inner"> 
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Booking Details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover"  id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
											<th>Shop_name</th>
											<th>Services_Name</th>
											<th>Booking_date</th>
											<th>Booking_time</th>
											
											<th>user_Phone_no</th>
											<th>User_Name</th>
											<th>Email</th>
											<th>Address</th>
											<th>City</th>
											<th>Pin_Code</th>
											<th>Total_amount</th>
											<th>Payment_Mode</th>
											<th>Payumoney Txnid</th>
											<th>Stripe Txnid</th>
											<!--<th>Status</th>-->
                                        </tr>
                                    </thead>
									<tbody>
									<?php		
									$sno=0;
									$res=mysql_query("select * from sv_booking ORDER BY id DESC");
									while($row=mysql_fetch_array($res))
									{
										$sno++;
										$shop_id=mysql_real_escape_string($row['shop_id']);
										$query=mysql_fetch_array(mysql_query("select * from sv_shop where id='$shop_id'"));
										$shop_pno=$row['phone_no'];
										$sv_user=mysql_fetch_array(mysql_query("select * from sv_users where phone_no='$shop_pno'"));

										$sid=mysql_real_escape_string($row['services_id']);
										$sel=explode("," , $sid);
										$lev=count($sel);
										$ser_name="";
										for($i=0;$i<$lev;$i++)
										{
											$serid=$sel[$i];				
											$res2=mysql_query("select * from sv_services where id='$serid'");
											$fet2=mysql_fetch_array($res2);
											$ser_name.=$fet2['services_name'];				
											$ser_name.=", ";
										}	
										$ser_name=trim($ser_name,",");
										 $booking_time=$row['booking_time'];
										 
										 if($booking_time>12)
										{
											$final_time=$booking_time-12;
											$final_time=$final_time."PM";
										}
										else
										{
											$final_time=$booking_time."AM";
										}
										$payment_mode=$row['payment_mode'];
										$s=" - ";
										
									?>
									
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $query['shop_name']; ?></td>
											<td class="services_name"><?php echo $ser_name; ?></td>
											<td><?php echo $row['booking_date']; ?></td>
											<td><?php echo $final_time; ?></td>
											<td><?php echo $row['phone_no']; ?></td>
											<td><?php echo $sv_user['user_name']; ?></td>
											<td><?php echo $sv_user['email']; ?></td>
											<td><?php echo $row['address']; ?></td>
											<td><?php echo $row['city']; ?></td>
											<td><?php echo $row['pin_code']; ?></td>
											<td><?php if($row['total_amt']=="") { echo "0"; } else { echo $row['total_amt']; } ?>&nbsp;<?php echo $currency_mode; ?></td>
											<td><?php if($payment_mode=='cash') { echo $payment_mode; } else {  echo $payment_mode . $s. $row['status'];  } ?></td>
											<!--<td><?php echo $row['status'];?></td>-->
											<td><?php echo $row['payu_token']; ?></td>
											<td><?php echo $row['stripe_token']; ?></td>
										</tr>
										<?php } ?>		
									</tbody>
															
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
                   </div>
				   				<?php include("footer.php") ?>

    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->	   
   

   </html>

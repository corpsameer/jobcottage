<title>My Order</title>
<?php
include("../database/connection.php");
@session_start();
if(isset($_SESSION['phone_no'])) { 
	$phone_no=mysqli_real_escape_string($con, $_SESSION['phone_no']);			
	$query=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where phone_no='$phone_no'"));
	$shop_id=$query['id'];
?>
<?php 
include('../header.php');
?>
<div class="profile_main">
<h1 class="text-center"><?php echo get_record(158,$lang,$en,$con);?></h1>
</div>
<div class="min-space"></div>
<div class="container">
			<div id="page-inner"> 
                  <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo get_record(158,$lang,$en,$con);?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
											<th>Shop_name</th>
											<th>Services_Name</th>
											<th>Booking_date</th>
											<th>Booking_time</th>
											<th>User_Name</th>
											<th>User_Email</th>
											<th>User_Phone_no</th>
											<th>Total_amount</th>
											<th>Status</th>
                                        </tr>
                                    </thead>
									<tbody>
									<?php		
									$sno=0;
									$res=mysqli_query($con, "select * from sv_booking where shop_id='$shop_id' ORDER BY id DESC");
									while($row=mysqli_fetch_array($res))
									{
										$sno++;
										$shop_id=mysqli_real_escape_string($con, $row['shop_id']);
										$query=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where id='$shop_id'"));
										$shop_pno=$row['phone_no'];
										$sv_user=mysqli_fetch_array(mysqli_query($con, "select * from sv_users where phone_no='$shop_pno'"));

										$sid=mysqli_real_escape_string($con, $row['services_id']);
										$sel=explode("," , $sid);
										$lev=count($sel);
										$ser_name="";
										for($i=0;$i<$lev;$i++)
										{
											$serid=$sel[$i];				
											$res2=mysqli_query($con, "select * from sv_services where id='$serid'");
											$fet2=mysqli_fetch_array($res2);
											$ser_name.='<div class="services_name">'.$fet2['services_name'].'<div>';				
											$ser_name.=",";
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
									?>
																	
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $query['shop_name']; ?></td>
											<td><?php echo $ser_name; ?></td>
											<td><?php echo $row['booking_date']; ?></td>
											<td><?php echo $final_time; ?></td>
											<td><?php echo $sv_user['user_name'];; ?></td>
											<td><?php echo $sv_user['email']; ?></td>
											<td><?php echo $row['phone_no']; ?></td>
											<td><?php if($row['total_amt']=="") { echo "0"; } else { echo $row['total_amt']; } ?>&nbsp;<?php echo $currency_mode; ?></td>
											<td><?php echo $row['status'];?></td>
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
		</div>



<div class="min-space"></div>
<?php } else { header('Location:../login/login.php'); }?>
	<?php include("../footer.php"); ?>
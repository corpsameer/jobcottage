<title>Withdraw</title>
<?php
include("../database/connection.php");
@session_start();
if(isset($_SESSION['phone_no'])) { 

 $user_name=$_SESSION['phone_no'];	
$user_no=mysqli_fetch_array(mysqli_query($con, "select * from sv_users where phone_no='$user_name'"));
$user_phoneno=$user_no['phone_no'];
$shop=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where phone_no='$user_phoneno'"));
$shop_id=$shop['id'];
include('../header.php');
?>
<div class="min-space"></div>
<div class="container">
<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		if($msg=="error")
		{
		      echo '<div class="err-msg">Please Check Minimum Withdraw Amount and Shop Balance</div>';
		}
		else if($msg=="Inserted")
		{
		     echo '<div class="succ-msg"> Updated Successfully.</div>';		
		}
}
?>
</div>

<form class="form-large" action="javascript:withdraw('add')" accept-charset="UTF-8" method="post">

<div class="container">

	<div class="text-center withdraw_amt">		
		<i class="fa fa-info-circle" aria-hidden="true"></i><label> <?php echo get_record(215,$lang,$en,$con);?> </label><span><?php echo $admin_withdraw_amt; ?> <?php echo $currency_mode; ?>	</span>			
	</div>

	<div class="col-md-12">
	<input type="hidden" id="shop_id" name="shop_id" value="<?php echo $shop_id; ?>">
	
				<!--<input type="" class="form-control" disabled="disabled" value="<?php echo $admin_withdraw_amt; ?> <?php echo $currency_mode; ?>">-->
		<div class="col-lg-2 col-md-2 col-sm-2">
			<div class="form-group">
				<label><?php echo get_record(202,$lang,$en,$con);?></label> [ <?php echo $currency_mode; ?> ]
				<?php 
				$sv_withdraw=0;
				$sv_bal=0;
				$sv_query1=mysqli_query($con, "select * from sv_withdraw_request where shop_id='$shop_id'");
				$sv_num_row=mysqli_num_rows($sv_query1);
								
				if($sv_num_row==0)
				{
					$sv_query=mysqli_query($con, "select * from sv_booking where shop_id='$shop_id' and status='paid'");
					while($sv_balance=mysqli_fetch_array($sv_query))
					{
						$sv_bal+=$sv_balance['total_amt'];
						$currency=$sv_balance['currency'];
					}		
				}
				else
				{
					$sv_query2=mysqli_query($con, "select * from sv_booking where shop_id='$shop_id' and status='paid'");
					while($sv_balance2=mysqli_fetch_array($sv_query2))
					{	
						/*  $sv_withdraw+=$sv_balance2['withdraw_amt'];
						 $shop_balance=$sv_balance2['total_bal']-$sv_withdraw; */
						 $shop_balance +=$sv_balance2['total_amt'];
					}
                     $getbalance = mysqli_query($con, "select * from sv_withdraw_request where shop_id='$shop_id'");
                     $getbal = "";
                     while($newbalance = mysqli_fetch_array(	$getbalance))
					 {
						 $getbal +=$newbalance['withdraw_amt'];
					 }	
                     $totalcost = $shop_balance - $getbal;
                     			 
				}
				?>
				<?php if($sv_num_row==0) { ?>
				<input type="" class="form-control" id="shop_balance" name="shop_balance" disabled="disabled" value="<?php echo $sv_bal; ?> ">
				<?php } else { ?>

				<input type="" class="form-control" id="shop_balance" name="shop_balance" disabled="disabled" value="<?php echo $totalcost; ?>">	
				<?php } ?>
			</div>
		</div>
		
		<div class="col-lg-2 col-md-2 col-sm-2">
			<div class="form-group">
				<label><?php echo get_record(203,$lang,$en,$con);?></label>
				<input type="" class="form-control" id="withdraw_amt" name="withdraw_amt" required>	
			</div>
		</div>
		
		<div class="col-lg-4 col-md-4 col-sm-4">
			<div class="form-group">
				<label><?php echo get_record(204,$lang,$en,$con);?></label>
					<select id="withdraw_mode" name="withdraw_mode" required class="form-control" onchange="javascript:withdraw_check(this.value);">
					<option value="">Select</option>
						<?php 
						$res=mysqli_query($con, "select * from sv_admin_login");
						while($row=mysqli_fetch_array($res))
						{
							$catid=$row['withdraw_option'];
							$sel= explode(",",$catid); 
							$lev= count($sel);
							for($i=0;$i<$lev;$i++)
							{
								 $ad_cat= $sel[$i];
							
						?>
						<option value="<?php echo $ad_cat; ?>" ><?php echo $ad_cat; ?></option>
						<?php 
						} }
						?> 
					</select>
					
			</div>
		</div>
		
		<div class="col-lg-4 col-md-4 col-sm-4" id="paypal_id" style="display:none;">
			<div class="form-group">
				<label><?php echo get_record(214,$lang,$en,$con);?></label>
				<?php if(isset($_REQUEST['msg1'])) 	
					$msg1=$_REQUEST['msg1'];
					else
					$msg1="";?>
					<input type="email" class="form-control" id="pid" name="pid">	
					<p id="pid_err" class="error"><?php echo $msg1;?></p>
			</div>
		</div>
		
		
		<div class="col-lg-4 col-md-4 col-sm-4" id="payu_id" style="display:none;">
			<div class="form-group">
				<label><?php echo get_record( 384, $lang,$en);?></label>
				<?php if(isset($_REQUEST['msg1'])) 	
					$msg1=$_REQUEST['msg1'];
					else
					$msg1="";?>
					<input type="email" class="form-control" id="payumoney" name="payumoney">	
					<p id="zid_err" class="error"><?php echo $msg1;?></p>
			</div>
		</div>
		
		
		<div class="col-lg-4 col-md-4 col-sm-4" id="stripe_id" style="display:none;">
			<div class="form-group">
				<label><?php echo get_record( 386, $lang,$en);?></label>
				<?php if(isset($_REQUEST['msg1'])) 	
					$msg1=$_REQUEST['msg1'];
					else
					$msg1="";?>
					<input type="email" class="form-control" id="stripe" name="stripe">	
					<p id="yid_err" class="error"><?php echo $msg1;?></p>
			</div>
		</div>
		
		
		<div class="col-lg-3 col-md-3 col-sm-3" id="bank_info" style="display:none;">
			<div class="form-group">
				<label><?php echo get_record(226,$lang,$en,$con);?></label>
					<input type="" class="form-control" id="bank_acc_no" name="bank_acc_no">
					<p id="bank_acc_no_err" class="error"><?php echo $msg1;?></p>					
					
					<label>Bank Name and Address</label>
					<input type="" class="form-control" id="bank_name" name="bank_name">
					<p id="bank_name_err" class="error"><?php echo $msg1;?></p>					
					
					<label><?php echo get_record(228,$lang,$en,$con);?></label>
					<input type="" class="form-control" id="ifsc_code" name="ifsc_code">	
					<p id="ifsc_code_err" class="error"><?php echo $msg1;?></p>					

			</div>
		</div>

	</div>
	 <?php if($demo_mode=="off") { ?>
			<button type="submit" class="form-control services-btn"><?php echo get_record(156,$lang,$en,$con);?></button>
	 <?php } else { ?>
	 <button type="button" disabled="disabled" class="form-control services-btn btn btn-login"><?php echo get_record(156,$lang,$en,$con);?></button> <span class="demomode">[Demo Mode Enabled]</span>
	 <?php } ?>
	


</div>
</form>
<div class="min-space"></div>


<div class="min-space"></div>


<div class="container">
			<div id="page-inner"> 
                  <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo get_record(216,$lang,$en,$con);?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><?php echo get_record(200,$lang,$en,$con);?></th>
											<th><?php echo get_record(203,$lang,$en,$con);?></th>
											<th><?php echo get_record(218,$lang,$en,$con);?></th>
											<th><?php echo get_record(219,$lang,$en,$con);?></th>
											<th><?php echo get_record( 385, $lang,$en);?></th>
											<th><?php echo get_record( 387, $lang,$en);?></th>
											<th><?php echo get_record(226,$lang,$en,$con);?></th>
											<th><?php echo get_record(227,$lang,$en,$con);?></th>
											<th><?php echo get_record(228,$lang,$en,$con);?></th>
											<th><?php echo get_record(229,$lang,$en,$con);?></th>
                                        </tr>
                                    </thead>
									<tbody>
									<?php
										$sno=0;
										$res=mysqli_query($con, "select * from sv_withdraw_request where shop_id='$shop_id' and status='pending'");
										while($row=mysqli_fetch_array($res))
										{
											$sno++;
											$id=mysqli_real_escape_string($con, $row['id']);
											$shop_balance=mysqli_real_escape_string($con, $row['shop_balance']);	
											
									?>  									
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $row['withdraw_amt'];?>&nbsp;<?php echo $currency_mode; ?></td>
											<td><?php echo $row['withdraw_mode'];?></td>	
											<td><?php echo $row['paypal_id'];?></td>
											<td><?php echo $row['payu_id'];?></td>
											<td><?php echo $row['stripe_id'];?></td>											
											<td><?php echo $row['bank_acc_no'];?></td>		
											<td><?php echo $row['bank_info'];?></td>
											<td><?php echo $row['ifsc_code'];?></td>	
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



<div class="min-space"></div>

<div class="container">
			<div id="page-inner"> 
                  <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo get_record(217,$lang,$en,$con);?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><?php echo get_record(200,$lang,$en,$con);?></th>
											<th><?php echo get_record(203,$lang,$en,$con);?></th>
											<th><?php echo get_record(218,$lang,$en,$con);?></th>
											<th><?php echo get_record(219,$lang,$en,$con);?></th>
											<th><?php echo get_record( 385, $lang,$en);?></th>
											<th><?php echo get_record( 387, $lang,$en);?></th>
											<th><?php echo get_record(226,$lang,$en,$con);?></th>
											<th><?php echo get_record(227,$lang,$en,$con);?></th>
											<th><?php echo get_record(228,$lang,$en,$con);?></th>
											<th><?php echo get_record(229,$lang,$en,$con);?></th>
                                        </tr>
                                    </thead>
									<tbody>
									<?php
										$sno=0;
										$res1=mysqli_query($con, "select * from sv_withdraw_request where shop_id='$shop_id' and status='completed'");
										while($row1=mysqli_fetch_array($res1))
										{
											$sno++;
											$id=mysqli_real_escape_string($con, $row1['id']);
											$shop_balance=mysqli_real_escape_string($con, $row1['shop_balance']);	
											
									?>  									
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $row1['withdraw_amt'];?>&nbsp;<?php echo $currency_mode; ?></td>
											<td><?php echo $row1['withdraw_mode'];?></td>	
											<td><?php echo $row1['paypal_id'];?></td>
											<td><?php echo $row1['payu_id'];?></td>	
											<td><?php echo $row1['stripe_id'];?></td>											
											<td><?php echo $row1['bank_acc_no'];?></td>		
											<td><?php echo $row1['bank_info'];?></td>
											<td><?php echo $row1['ifsc_code'];?></td>	
											<td><?php echo $row1['status'];?></td>											
											
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
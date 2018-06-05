<?php include("../database/connection.php"); ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<?php 

	$page = 'pending';
?>


  <body class="splash-index">
   
<?php include("top_menu.php") ?>

 <?php include("side_menu.php") ?>

<div id="page-wrapper" >
		
		  <div class="header"> 
                        <h1 class="page-header">
                            Pending Withdrawal 
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Pending Withdrawal</a></li>
					  
					</ol>		
		</div>
            <div id="">
			    <div class="panel-body">
				<div class="text-center">
				<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		if($msg=="Updated")
		{
		      echo '<div class="succ-msg">Updated Successfully.</div>';
		}
}
else
	$msg="";
?>
			
			
				</div>
			
			<div id="page-inner"> 
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pending Withdrawal
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover"  id="dataTables-example">
                                    <thead>
                                        <tr>
                                             <th>SNo</th>
											<th>Shop_Name</th>
											<th>Email</th>
											<th>Mobile No</th>
											<th>User_Id</th>
											<th>Shop_Id</th>
											<th>Withdraw Amt</th>
											<th>Withdraw Mode</th>
											<th>Paypal Id</th>
											<th>Payumoney Id</th>
											<th>Stripe Id</th>
											<th>Bank_Acc_No</th>
											<th>Bank Info</th>
											<th>IFSC Code</th>
											<th>Status</th>
											<th>Make_a_payment_status as complete</th>											

                                        </tr>
                                    </thead>
									<tbody>
									<?php		
									$sno=0;
									$res=mysqli_query($con, "select * from sv_withdraw_request where status='pending' ORDER BY id DESC");
									while($row=mysqli_fetch_array($res))
									{
										$sno++;
										$id=mysqli_real_escape_string($con, $row['id']);
										$shop_id=mysqli_real_escape_string($con, $row['shop_id']);
										$sv_shop= mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where id='$shop_id' "));
										$pno=$sv_shop['phone_no'];
										
										$sv_email= mysqli_fetch_array(mysqli_query($con, "select * from sv_users where phone_no='$pno' "));


									?>
									
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $sv_shop['shop_name'];?></td>
											<td><?php echo $sv_email['email'];?></td>
											<td><?php echo $sv_shop['shop_phone_no'];?></td>
											<td><?php echo $sv_email['id'];?></td>
											<td><?php echo $row['shop_id'];?></td>

											<td><?php echo $row['withdraw_amt'];?>&nbsp;<?php echo $currency_mode; ?></td>
											<td><?php echo $row['withdraw_mode'];?></td>	
											<td><?php echo $row['paypal_id'];?></td>	
											<td><?php echo $row['payu_id'];?></td>
											<td><?php echo $row['stripe_id'];?></td>
											<td><?php echo $row['bank_acc_no'];?></td>		
											<td><?php echo $row['bank_info'];?></td>
											<td><?php echo $row['ifsc_code'];?></td>	
											<td><?php echo $row['status'];?></td>	
											 <?php if($demo_mode=="off") { ?>
											<td><a href="javascript:payment_update('<?php echo $id;?>');"><?php if($row['status']=="completed") { echo "-"; } else { ?><button class="make_payment">Mark as Complete</button><?php } ?></a></td>	
											 <?php } else { ?>
											 <td><button type="button" class="btn make_payment" disabled="disabled">Mark as Complete</button> <span class="demomode">[Demo Mode Enabled]</span></td>
											 <?php } ?>
											
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

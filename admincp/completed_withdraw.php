<?php include("../database/connection.php"); ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
     <?php $page ='completed'; ?>

  <body class="splash-index">

<?php include("top_menu.php") ?>

 <?php include("side_menu.php") ?>
 


<div id="page-wrapper">
		  <div class="header"> 
                        <h1 class="page-header">
                           Completed Withdrawal
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Completed Withdrawal</a></li>
					  
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
                             Completed Withdrawal
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
											<th>Bank Account No</th>
											<th>Bank Info</th>
											<th>IFSC Code</th>
											<th>Status</th>

                                        </tr>
                                    </thead>
									<tbody>
									<?php		
									$sno=0;$sv_withdraw=0;
									$res=mysql_query("select * from sv_withdraw_request where status='completed' ORDER BY id DESC");
									while($row=mysql_fetch_array($res))
									{
										$sno++;
										$id=mysql_real_escape_string($row['id']);
										$shop_id=mysql_real_escape_string($row['shop_id']);
										$sv_shop= mysql_fetch_array(mysql_query("select * from sv_shop where id='$shop_id' "));
										$pno=$sv_shop['phone_no'];
										
										$sv_email= mysql_fetch_array(mysql_query("select * from sv_users where phone_no='$pno' "));
										
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

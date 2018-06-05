<title>My Services</title>
<?php
include("../database/connection.php");
@session_start();
if(isset($_SESSION['phone_no'])) { 
	$phone_no=mysqli_real_escape_string($con, $_SESSION['phone_no']);			
	$query=mysqli_fetch_array(mysqli_query($con, "select * from sv_users where phone_no='$phone_no'"));
?>
<?php 
include('../header.php');
?>
<div class="profile_main">
<h1 class="text-center"><?php echo get_record(46,$lang,$en,$con);?></h1>
</div>

<?php 
if(isset($_REQUEST['sid']))
	{		
		$sid=mysqli_real_escape_string($con, $_REQUEST['sid']);
		$res=mysqli_query($con, "select * from sv_seller_services where id='$sid'");
		$row=mysqli_num_rows($res);
		if($row==0)
	 	{
		  $id="";
		  $services_id="";
		  $price="";
		  $time="";
		  $typ="add";
		}
		else
		{			
			$fet=mysqli_fetch_array($res);
			$id=mysqli_real_escape_string($con, $fet['id']);	
			$services_id=mysqli_real_escape_string($con, $fet['services_id']);	
			$price=mysqli_real_escape_string($con, $fet['price']);				
			$time=mysqli_real_escape_string($con, $fet['time']);				
			$typ="update";	
		}		
	}
	else
	{
		$id="";
		$services_id="";
		$price="";
		$time="";
		$typ="add";
	}


?>
<div class="text-center container shopform">
				<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		if($msg=="Inserted")
		{
			echo '<div class="succ-msg">Inserted Successfully. </div>'; 
		}
		else if($msg=="Updated")
		{
		    echo '<div class="succ-msg">Updated Successfully.</div>';		
		}
		else if($msg=="Deleted")
		{
		    echo '<div class="succ-msg">Deleted Successfully.</div>';		
		}
}
else
	$msg="";
?>	
	</div>
<form class="" name="admin_s" id="admin_s" method="post" enctype="multipart/form-data" action="services_add.php">
<input type="hidden" id="typ" name="typ" value="<?php echo $typ;?>">
			<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
<div class="container">
   <div class="col-md-12">
	<div class="form-group col-md-4" >
		<label><?php echo get_record(183,$lang,$en,$con);?><span class="star">*</span></label>
		<select class="form-control" id="services_name" name="services_name" required>
			<option value="">Select Services</option>
			<?php 
			$query=mysqli_query($con, "select * from sv_services where lang_code='$lang'");
			while($res=mysqli_fetch_array($query))
			{
				if($lang==$en)
						{
						$ser_id=$res['id'];
						}
						else
						{
							$ser_id=$res['page_parent'];
						}
			?>	
			<option value="<?php echo $ser_id; ?>" <?php { if($services_id==$ser_id) echo "selected='selected'"; } ?>><?php echo $res['services_name']; ?></option>
			<?php } ?>
		</select>		
	</div>
	<div class="form-group col-md-1">	
		<label><?php echo get_record(184,$lang,$en,$con);?></label>
		<input type="text"  name="" id="" class="form-control" disabled="disabled" value="<?php echo $currency_mode; ?>">
	</div>
	<div class="form-group col-md-3">		
		<label><?php echo get_record(196,$lang,$en,$con);?><span class="star">*</span></label>
		<input type="number"  name="price" required id="price" class="form-control" value="<?php echo $price; ?>">
	</div>
	<div class="form-group col-md-4" id="shop_address" >
		<label><?php echo get_record(197,$lang,$en,$con);?></label>
		<input type="number" name="time" id="time" class="form-control" value="<?php echo $time; ?>">
	</div>
	
							
	<div class="form-group">
		<div class="row">
			<div class="col-sm-2">
			 <?php if($demo_mode=="off") { ?>
				<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="<?php echo get_record(137,$lang,$en,$con);?>">
			 <?php } else { ?>
			 <input type="" disabled="disabled" tabindex="4" class="form-control btn btn-login" value="<?php echo get_record(137,$lang,$en,$con);?>"><span class="demomode">[Demo Mode Enabled]</span>
			 <?php } ?>
			</div>
		</div>
	</div>


	</div>
</div>
</form>
		<div class="container">
			<div id="page-inner"> 
                  <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo get_record(46,$lang,$en,$con);?>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th><?php echo get_record(200,$lang,$en,$con);?></th>
											<th><?php echo get_record(46,$lang,$en,$con);?></th>
											<th><?php echo get_record(196,$lang,$en,$con);?></th>
											<th><?php echo get_record(199,$lang,$en,$con);?></th>
											<th><?php echo get_record(180,$lang,$en,$con);?></th>
											<th><?php echo get_record(198,$lang,$en,$con);?></th>	
                                        </tr>
                                    </thead>
									<tbody>
									<?php
										$sno=0;
										$res=mysqli_query($con, "select * from sv_seller_services where phone_no='$phone_no'");
										while($row=mysqli_fetch_array($res))
										{
											$sno++;
											$id=mysqli_real_escape_string($con, $row['id']);
											$sid=mysqli_real_escape_string($con, $row['services_id']);	
											
											if($lang==$en)
											{
											$ser_id="id";
											}
											else
											{
												$ser_id="page_parent";
											}
											
											$result=mysqli_fetch_array(mysqli_query($con, "select * from sv_services where $ser_id='$sid' and lang_code='$lang'"));
											
									?>  									
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $result['services_name'];?></td>
											<td><?php echo $row['price'];?>&nbsp;<?php echo $currency_mode; ?></td>
											<td><?php echo $row['time'];?></td>
											<td><a href="services.php?sid=<?php echo $id;?>"><img src="<?php echo $site_url; ?>img/file_edit.png"  alt="update" title="update" ></a></td>
											 <?php if($demo_mode=="off") { ?>
											<td><a href="javascript:services_del('<?php echo $id;?>');"><img src="<?php echo $site_url; ?>img/delete.png" alt="" title="delete"></a></td>
											 <?php } else { ?>
											 <td><img src="<?php echo $site_url; ?>img/delete.png" alt="" title="delete"><span class="demomode">[Demo Mode Enabled]</span></td>
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
		</div>
<?php } else { header('Location:../login/login.php'); }?>
	<?php include("../footer.php"); ?>
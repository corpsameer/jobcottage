<?php include("../database/connection.php"); ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<?php
if(isset($_REQUEST['shop_id']))
	{
		$id=mysqli_real_escape_string($con, $_REQUEST['shop_id']);
		$res=mysqli_query($con, "select * from sv_shop where id='$id'");
		$row=mysqli_num_rows($res);
		if($row==0)
	 	{
		  $id="";
		  $shop_name="";
		  $address="";
		  $city="";
		  $pin_code="";
		  $country="";
		  $state="";
		  $shop_phone_no="";
		  $description="";
		  $shop_date="";
		  $start_time="";
		  $end_time="";
		  $cover_photo="";
		  $phone_no="";
		  $status="";
		  $featured="";
		  $opening_days="";
		}
		else
		{
			$fet=mysqli_fetch_array($res);
			$id=mysqli_real_escape_string($con, $fet['id']);
			$shop_name=mysqli_real_escape_string($con, $fet['shop_name']);
			$address=mysqli_real_escape_string($con, $fet['address']);
			$city=mysqli_real_escape_string($con, $fet['city']);
			$pin_code=mysqli_real_escape_string($con, $fet['pin_code']);
			$country=mysqli_real_escape_string($con, $fet['country']);
			$state=mysqli_real_escape_string($con, $fet['state']);
			$shop_phone_no=mysqli_real_escape_string($con, $fet['shop_phone_no']);
			$description=mysqli_real_escape_string($con, $fet['description']);
			$shop_date=mysqli_real_escape_string($con, $fet['shop_date']);
			$start_time=mysqli_real_escape_string($con, $fet['start_time']);
			$end_time=mysqli_real_escape_string($con, $fet['end_time']);
			$cover_photo=mysqli_real_escape_string($con, $fet['cover_photo']);
			$phone_no=mysqli_real_escape_string($con, $fet['phone_no']);
			$status=mysqli_real_escape_string($con, $fet['status']);
			$featured=mysqli_real_escape_string($con, $fet['featured']);
			$opening_days=mysqli_real_escape_string($con, $fet['booking_opening_days']);
			$typ="update";
		}
	}
	else
	{
		$id="";
		  $shop_name="";
		  $address="";
		  $city="";
		  $pin_code="";
		  $country="";
		  $state="";
		  $shop_phone_no="";
		  $description="";
		  $shop_date="";
		  $start_time="";
		  $end_time="";
		  $cover_photo="";
		  $phone_no="";
		  $status="";
		  $featured="";
		  $opening_days="";
	}
	$page = 'shop';

?>


  <body class="splash-index">

<?php include("top_menu.php") ?>

 <?php include("side_menu.php") ?>

<div id="page-wrapper" >

		  <div class="header">
                        <h1 class="page-header">
                            Shop Details
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Shop</a></li>

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
		      echo '<div class="succ-msg">Shop details Updated Successfully.</div>';
		}
		else if($msg=="Deleted")
		{
		    echo '<div class="succ-msg"> Shop details Deleted Successfully</div>';
		}
}
else
	$msg="";
?>

			<?php if(isset($_REQUEST['shop_id'])) { ?>
				<form class="form-large" action="shop_add.php" accept-charset="UTF-8" method="post">

				<div class="col-lg-12 col-md-12 col-sm-12 table-bg">
				<input type="hidden" id="typ" name="typ" value="<?php echo $typ;?>">
                <input type="hidden" id="hid" name="hid" value="<?php echo $id;?>">

				<div class="col-lg-3 col-md-3 col-sm-3 form-group" >
						<label>Shop Name</label>
					<input type="text" id="shop_name" required="required" class="form-control" name="shop_name" value="<?php echo $shop_name; ?>">
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 form-group" >
						<label>Address</label>
					<input type="text" id="address" required="required" class="form-control" name="address" value="<?php echo $address; ?>">
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<label>City</label>
					<input type="" id="city" required="required" class="form-control" name="city" value="<?php echo $city;?>">
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<label>Pin Code</label>
					<input type="" id="pin_code" required="required" class="form-control" name="pin_code" value="<?php echo $pin_code;?>">
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<label>Country</label>
					<input type="" id="country" class="form-control" name="country" value="<?php echo $country;?>">
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<label>State</label>
					<input type="" id="state" class="form-control" name="state" value="<?php echo $state;?>">
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<label>Shop Phone No</label>
					<input type="" id="shop_phone_no" required="required" class="form-control" name="shop_phone_no" value="<?php echo $shop_phone_no;?>">
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<label>Description</label>
					<input type="" id="description" required="required" class="form-control" name="description" value="<?php echo $description;?>">
				</div>

				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<label>Phone No</label>
					<input type="" id="" required="required" disabled="disabled" class="form-control"  name="" value="<?php echo $phone_no;?>">
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<label>Start Time</label>
					<?php
					if($start_time>12)
					{
						$start=$start_time-12;
						$stime=$start."PM";
					}
					else
					{
						$stime=$start_time."AM";
					}
					if($end_time>12)
					{
						$end=$end_time-12;
						$etime=$end."PM";
					}
					else
					{
						$etime=$end_time."AM";
					}
				?>
					<input type="" id="start_time" required="required" disabled="disabled" class="form-control" name="start_time" value="<?php echo $stime;?>">
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<label>End Time</label>
					<input type="" id="end_time" required="required" class="form-control" disabled="disabled" name="end_time" value="<?php echo $etime;?>">
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<label>Advance Booking Opening days</label>
					<input type="" id="" required="required" disabled="disabled" class="form-control"  name="" value="<?php echo $opening_days;?>">
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<label>Status</label>
						<select id="status" name="status" class="form-control" required>
							<option value="unapproved" <?php  if($status=="unapproved") echo "selected='selected'"; ?>>Unapproved</option>
							<option value="approved" <?php  if($status=="approved") echo "selected='selected'";  ?>>Approved</option>
						</select>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<label>Featured</label>
						<select id="featured" name="featured" class="form-control" required>
							<option value="no" <?php  if($featured=="yes") echo "selected='selected'"; ?>>No</option>
							<option value="yes" <?php  if($featured=="yes") echo "selected='selected'";  ?>>Yes</option>
						</select>

				</div>

				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<?php
						$sid=$fet['shop_date'];
						$sel=explode(",",$sid);
						$lev=count($sel);
					?>
					<label>Shop Working Days</label><br>
					<div class="opening_days">
					<input type="checkbox" name="check_list[]" id="working_date" disabled="disabled" class=""  value="0" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="0") echo "checked=='checked'"; }?>>Sunday <br>
					<input type="checkbox" name="check_list[]" id="working_date" disabled="disabled" class=""  value="1" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="1") echo "checked=='checked'"; }?>>Monday <br>
					<input type="checkbox" name="check_list[]" id="working_date" disabled="disabled" class=""  value="2" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="2") echo "checked=='checked'"; }?>>Tuesday <br>
					<input type="checkbox" name="check_list[]" id="working_date" disabled="disabled" class=""  value="3" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="3") echo "checked=='checked'"; }?>>Wednesday <br>
					<input type="checkbox" name="check_list[]" class="" id="working_date" disabled="disabled" value="4" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="4") echo "checked=='checked'"; }?>>Thursday  <br>
					<input type="checkbox" name="check_list[]" id="working_date" class="" disabled="disabled" value="5" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="5") echo "checked=='checked'"; }?>>Friday  <br>
					<input type="checkbox" name="check_list[]" id="working_date" class="" disabled="disabled" value="6" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="6") echo "checked=='checked'"; }?>>Saturday
					</div>
				</div>

				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<label>Cover Photo</label>
					<input type="file" id="" class="form-control" disabled="disabled" name="" value="">
						<?php
						if($cover_photo=="") { ?>
						<?php
							}
							else
							{
							?>
						<img class="site_logo" src="<?php echo $site_url; ?>shop/shop-img/<?php echo $cover_photo;?>" alt="" >
						<?php } ?>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 form-group">
					<label>Gallery</label>
					<input type="file" id="" required="required" class="form-control" name="" disabled="disabled" value="<?php echo $gallery;?>">
					<?php
						$sql=mysqli_query($con, "select * from sv_shop_gallery where shop_id='$id'");
						while($result=mysqli_fetch_array($sql))
						{
							$gallery=$result['image'];
						if($gallery=="") { ?>
						<?php
							}
							else
							{
							?>
						<img class="site_logo" src="<?php echo $site_url; ?>shop/shop-img/<?php echo $gallery;?>" alt="" >
						<?php } } ?>
				</div>



				<div class="min-space"></div>
					<div class="col-lg-4 col-md-4 col-sm-4 up-button">
					 <?php if($demo_mode=="off") { ?>
						<button type="submit" class="btn btn-primary" onclick="">Update</button>
					 <?php } else { ?>
					   <button type="button" class="btn btn-primary" disabled="disabled">Update</button> <span class="demomode">[Demo Mode Enabled]</span>
					<?php } ?>
					</div>
				</div>
					</form>
					<?php } ?>
				</div>

			<div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Shop
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover"  id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
											<th>Shop_Name</th>
											<th>Address</th>
											<th>Shop_Phone_no</th>
											<th>Featured</th>
											<th>Status</th>
											<th>Total Balance</th>
											<th>Update</th>
											<th>Delete</th>
                                        </tr>
                                    </thead>
									<tbody>
									<?php
									$sno=0;
									$sv_bal=0;
									$res=mysqli_query($con, "select * from sv_shop ORDER BY id DESC");
									while($row=mysqli_fetch_array($res))
									{
										$sno++;
										$id=mysqli_real_escape_string($con, $row['id']);
										$shop_name=mysqli_real_escape_string($con, $row['shop_name']);

										$sv_query=mysqli_query($con, "select * from sv_booking where shop_id='$id' and status='paid'");
									    while($sv_balance=mysqli_fetch_array($sv_query))
										{
											$sv_bal+=$sv_balance['total_amt'];
										}


									?>

										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $shop_name; ?></td>
											<td><?php echo $row['address']; ?></td>
											<td><?php echo $row['shop_phone_no']; ?></td>
											<td><?php echo $row['featured']; ?></td>
											<td><?php echo $row['status']; ?></td>
											<td><?php if($sv_bal=="") { echo "0"; } else { echo $sv_bal; }?> <?php echo $currency_mode; ?></td>
											<td><a href="shop.php?shop_id=<?php echo $id;?>"><img src="img/file_edit.png"  alt="update" title="update" ></a></td>
											 <?php if($demo_mode=="off") { ?>
											<td><a href="javascript:shop_del('<?php echo $id;?>');"><img src="img/delete.png" alt="" title="delete"></a></td>
											 <?php } else { ?>
											 <td><img src="img/delete.png" alt="" title="delete"><span class="demomode">[Demo Mode Enabled]</span></td>
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

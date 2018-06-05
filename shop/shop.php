<title>My Shop</title>


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

<?php
$res=mysqli_query($con, "select * from sv_shop where phone_no='$phone_no'");
$numrow=mysqli_num_rows($res);

 ?>
<div class="container shopform">
<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		if($msg=="Updated")
		{
		      echo '<div class="succ-msg">Shop Details Updated Successfully.</div>';
		}
		else if($msg=="Inserted")
		{
		     echo '<div class="succ-msg"> Shop Details Inserted Successfully.Admin will Approve soon.</div>';
		}
		else if($msg=="Success")
		{
			echo '<div class="succ-msg">Password changed successfully</div>';
		}
		else if($msg=="send")
		{
			echo '<div class="succ-msg">Your Enquiry send successfully. Admin will contact soon.</div>';
		}
		else if($msg=="Invalid")
		{
			echo '<div class="err-msg">Enter valid current password</div>';
		}
		else if($msg=="Deleted")
		{
			echo '<div class="succ-msg">Image Deleted Successfully</div>';
		}
		else if($msg=="error4")
		{
		      echo '<div class="err-msg">Select only png,jpg or jpeg image format</div>';
		}
		else if($msg=="error5")
		{
		      echo '<div class="err-msg">Shop Image is greather than 1 MB</div>';
		}
}
else
	$msg="";
?>
</div>
<?php if(!isset($_REQUEST['id'])) { ?>
<?php if(!$numrow=="") { ?>
<div class="container">
<div class="col-md-12">
<div class="row">
<?php
$shop_query=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where phone_no='$phone_no'"));
$id=$shop_query['id'];

?>
<?php
if($shop_query['cover_photo']=="")
{
?>
	<div class="cover_pic col-md-12" style="background-image:url(<?php echo $site_url; ?>shop/shop-img/shop-default.jpg);"></div>
<?php } else { ?>
	<div class="cover_pic col-md-12" style="background-image:url(<?php echo $site_url; ?>shop/shop-img/<?php echo $shop_query['cover_photo']; ?>);"></div>
<?php } ?>

<?php
if($shop_query['profile_photo']=="")
{
?>
	<div class="profile_pic col-md-12">
	<img src="<?php echo $site_url; ?>shop/shop-img/profile-default.jpg">
	</div>
<?php } else { ?>
	<div class="profile_pic col-md-12">
	<img src="<?php echo $site_url; ?>shop/shop-img/<?php echo $shop_query['profile_photo']; ?>">
	</div>
<?php } ?>
<div class="shop_name col-md-12"><?php echo $shop_query['shop_name']; ?> - <?php echo $shop_query['address']; ?>
<p class="sv_shop_no"><i class="fa fa-phone" aria-hidden="true"></i> &nbsp;<?php echo $shop_query['shop_phone_no']; ?></p>
</div>
</div>
</div>
</div>


<div class="container">
<div class="row">
	<div class="col-md-12">
  <ul class="nav nav-tabs sv_tab">
    <li class="active col-md-4"><a data-toggle="tab" href="#home"><?php echo get_record(107,$lang,$en,$con);?></a></li>
    <li class="col-md-4"><a data-toggle="tab" href="#menu1"><?php echo get_record(46,$lang,$en,$con);?></a></li>
    <li class="col-md-4"><a data-toggle="tab" href="#menu2"><?php echo get_record(108,$lang,$en,$con);?></a></li>
    <!--<li class="col-md-3"><a data-toggle="tab" href="#menu3">Gallery</a></li>-->
  </ul>
  </div>
  <div class="tab-content profile_det">
    <div id="home" class="tab-pane fade in active">

		<div class="col-md-12">
		<div class="col-md-6">
			<h3><?php echo get_record(129,$lang,$en,$con);?></h3>
			<p><?php echo $shop_query['description']; ?></p><br/>
		</div>
		<div class="col-md-6 contact_address">
			<h3><?php echo get_record(130,$lang,$en,$con);?></h3>
				<span class="icon_pin_alt" aria-hidden="true"></span><p><?php echo $shop_query['address']; ?><br>
				<?php echo $shop_query['city']; ?> - <?php echo $shop_query['pin_code']; ?><br>
				<?php echo $shop_query['country']; ?><br>
				<?php echo $shop_query['state']; ?></p>
				<?php
					if($shop_query['start_time']>12)
					{
						$start=$shop_query['start_time']-12;
						$stime=$start."PM";
					}
					else
					{
						$stime=$shop_query['start_time']."AM";
					}
					if($shop_query['end_time']>12)
					{
						$end=$shop_query['end_time']-12;
						$etime=$end."PM";
					}
					else
					{
						$etime=$shop_query['end_time']."AM";
					}
				?>
				<span class="icon_clock_alt" aria-hidden="true"></span><p><?php echo $stime; ?> - <?php echo $etime; ?></p>
			</div>
				</div>

				<div class="col-md-12">
				<div class="col-md-6 working_day">
				<?php
				$query=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where id='$id'"));
				$sid=$query['shop_date'];

				$sel=explode(",",$sid);
				$lev=count($sel);

				?>
				<h3><?php echo get_record(131,$lang,$en,$con);?></h3>
					<p><?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="0") echo "Sunday"; }?></p>
					<p><?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="1") echo "Monday"; }?></p>
					<p><?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="2") echo "Tuesday"; }?></p>
					<p><?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="3") echo "Wednesday"; }?></p>
					<p><?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="4") echo "Thursday"; }?></p>
					<p><?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="5") echo "Friday "; }?></p>
					<p><?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="6") echo "Saturday"; }?></p>

				</div>

			<div class="col-md-6">
				<h3><?php echo get_record(138,$lang,$en,$con);?> </h3>
				<p><?php echo $shop_query['status']; ?></p>
			</div>
			</div>

				 </div>

    <div id="menu1" class="tab-pane fade">
		<div class="col-md-12">
		<?php
			$services_query=mysqli_query($con, "select * from sv_seller_services where phone_no='$phone_no'");
			while($services_fet=mysqli_fetch_array($services_query))
			{
				$services_id=$services_fet['services_id'];

				if($lang==$en)
						{
						$ser_id="id";
						}
						else
						{
							$ser_id="page_parent";
						}

				$fetch=mysqli_fetch_array(mysqli_query($con, "select * from sv_services where $ser_id='$services_id'  and lang_code='$lang'"));
		?>
		<div class="col-md-3">
			<div class="services">
				<h4><?php echo $fetch['services_name']; ?></h4>
				<h5><span class="icon_info" aria-hidden="true"></span>
					<?php echo $services_fet['price']; ?>&nbsp;<?php echo $currency_mode; ?> | <?php echo $services_fet['time']; ?></h5>
			</div>
		</div>

		<?php } ?>
		</div>
    </div>
    <div id="menu2" class="tab-pane fade">

		<div class="rating">
		<?php
		$rating=mysqli_fetch_array(mysqli_query($con, "select * from sv_rating where shop_id='$id'"));
		$s = $rating['rating'];
		$pno=$rating['phone_no'];
		$user_info=mysqli_fetch_array(mysqli_query($con, "select * from sv_users where phone_no='$pno'"));
		if($s=="")
		{
			echo get_record(182,$lang,$en,$con);
		}
		else {
		$star = "shop-img/star".$s.".png";
		echo"<img src='$star' alt='rated $s stars' title='rated $s stars' />  - ";   echo $user_info['user_name'];
		}
		?>
		<br>
      <?php echo $rating['comment']; ?>
	  </div>
    </div>

</div>
</div>
</div>

<?php } } ?>


<?php
if(isset($_REQUEST['id']) || $numrow=="")
	{

?>


<form class="" name="admin_s" id="admin_s" method="post" enctype="multipart/form-data" action="shop_add.php">
<?php
$shop_query=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where phone_no='$phone_no'"));
?>
<div class="container">
   <div class="col-md-12">
	<div class="form-group col-md-6">
		<label>Shop Name<span class="star">*</span></label>
		<input type="text"  name="shop_name" id="shop_name" class="form-control" required value="<?php if(!$numrow=="") { echo $shop_query['shop_name']; } ?>">
	</div>
	<div class="form-group col-md-6" >
		<label>Shop Address<span class="star">*</span></label>
		<input type="text"  name="shop_address" id="shop_address" required class="form-control" value="<?php if(!$numrow=="") { echo $shop_query['address']; } ?>">
	</div>
	<div class="form-group col-md-6" >
		<label>City<span class="star">*</span></label>
		<input type="text"  name="city" id="city" class="form-control" required value="<?php if(!$numrow=="") { echo $shop_query['city']; } ?>">
	</div>
	<div class="form-group col-md-6"  >
		<label>Pin Code<span class="star">*</span></label>
		<input type="text"  name="pin_code" id="pin_code" required class="form-control" value="<?php if(!$numrow=="") { echo $shop_query['pin_code']; } ?>">
	</div>
	<div class="form-group col-md-6" >
		<label>Country</label>
		<input type="text"  name="country" id="country" class="form-control" value="<?php if(!$numrow=="") { echo $shop_query['country']; } ?>">
	</div>
	<div class="form-group col-md-6" >
		<label>State</label>
		<input type="text"  name="state" id="state" class="form-control" value="<?php if(!$numrow=="") { echo $shop_query['state']; }?>">
	</div>
	<div class="form-group col-md-6" >
		<label>Shop Phone No<span class="star">*</span></label>
		<input type="text"  name="shop_phone_no" id="shop_phone_no" required  class="form-control" value="<?php  if(!$numrow=="") { echo $shop_query['shop_phone_no']; }?>">
	</div>
	<div class="form-group col-md-6" >
		<label>Shop Description<span class="star">*</span></label>
		<!--<input type="text"  name="shop_desc" id="shop_desc" class="form-control" required  value="<?php  if(!$numrow=="") { echo $shop_query['description']; }?>">-->

		<textarea name="shop_desc" rows="4"  id="shop_desc" class="form-control" required><?php  if(!$numrow=="") { echo $shop_query['description']; }?></textarea>
	</div>
<div class="form-group col-md-6" >
		<label>Shop Start Time<span class="star">*</span></label>
		<select id="start_time" name="start_time" class="form-control" required>
	<option value="">None</option>
	<option value="0" <?php if(!$numrow=="") { { if($shop_query['start_time']=="0")  echo "selected='selected'"; } }?>>12:00 AM</option>
	<option value="1"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="1") echo "selected='selected'"; } }?>>01:00 AM</option>
	<option value="2"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="2") echo "selected='selected'"; } }?>>02:00 AM</option>
	<option value="3"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="3") echo "selected='selected'"; } }?>>03:00 AM</option>
	<option value="4"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="4") echo "selected='selected'"; } }?>>04:00 AM</option>
	<option value="5"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="5") echo "selected='selected'"; } }?>>05:00 AM</option>
	<option value="6"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="6") echo "selected='selected'"; } }?>>06:00 AM</option>
	<option value="7"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="7") echo "selected='selected'"; } }?>>07:00 AM</option>
	<option value="8"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="8") echo "selected='selected'"; } }?>>08:00 AM</option>
	<option value="9"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="9") echo "selected='selected'"; } }?>>09:00 AM</option>
	<option value="10"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="10") echo "selected='selected'"; } }?>>10:00 AM</option>
	<option value="11"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="11") echo "selected='selected'"; } }?>>11:00 AM</option>
	<option value="12"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="12") echo "selected='selected'"; } }?>>12:00 PM</option>
	<option value="13"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="13") echo "selected='selected'"; } }?>>01:00 PM</option>
	<option value="14"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="14") echo "selected='selected'"; } }?>>02:00 PM</option>
	<option value="15"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="15") echo "selected='selected'"; } }?>>03:00 PM</option>
	<option value="16"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="16") echo "selected='selected'"; } }?>>04:00 PM</option>
	<option value="17"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="17") echo "selected='selected'"; } }?>>05:00 PM</option>
	<option value="18"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="18") echo "selected='selected'"; } }?>>06:00 PM</option>
	<option value="19"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="19") echo "selected='selected'"; } }?>>07:00 PM</option>
	<option value="20"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="20") echo "selected='selected'"; } }?>>08:00 PM</option>
	<option value="21"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="21") echo "selected='selected'"; } }?>>09:00 PM</option>
	<option value="22"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="22") echo "selected='selected'"; } }?>>10:00 PM</option>
	<option value="23"  <?php if(!$numrow=="") { { if($shop_query['start_time']=="23") echo "selected='selected'"; } }?>>11:00 PM</option>

</select>
	</div>
	<div class="form-group col-md-6" >
		<label>Shop End Time<span class="star">*</span></label>
		<select id="end_time" name="end_time" class="form-control" required>
	<option value="">None</option>
	<option value="0" <?php if(!$numrow=="") { { if($shop_query['end_time']=="0") echo "selected='selected'"; } }?>>12:00 AM</option>
	<option value="1" <?php if(!$numrow=="") { { if($shop_query['end_time']=="1") echo "selected='selected'"; } }?>>01:00 AM</option>
	<option value="2" <?php if(!$numrow=="") { { if($shop_query['end_time']=="2") echo "selected='selected'"; } }?>>02:00 AM</option>
	<option value="3" <?php if(!$numrow=="") { { if($shop_query['end_time']=="3") echo "selected='selected'"; } }?>>03:00 AM</option>
	<option value="4" <?php if(!$numrow=="") { { if($shop_query['end_time']=="4") echo "selected='selected'"; } }?>>04:00 AM</option>
	<option value="5" <?php if(!$numrow=="") { { if($shop_query['end_time']=="5") echo "selected='selected'"; } }?>>05:00 AM</option>
	<option value="6" <?php if(!$numrow=="") { { if($shop_query['end_time']=="6") echo "selected='selected'"; } }?>>06:00 AM</option>
	<option value="7" <?php if(!$numrow=="") { { if($shop_query['end_time']=="7") echo "selected='selected'"; }}?>>07:00 AM</option>
	<option value="8" <?php if(!$numrow=="") { { if($shop_query['end_time']=="8") echo "selected='selected'"; }}?>>08:00 AM</option>
	<option value="9" <?php if(!$numrow=="") { { if($shop_query['end_time']=="9") echo "selected='selected'"; }}?>>09:00 AM</option>
	<option value="10" <?php if(!$numrow=="") { { if($shop_query['end_time']=="10") echo "selected='selected'"; }}?>>10:00 AM</option>
	<option value="11" <?php if(!$numrow=="") { { if($shop_query['end_time']=="11") echo "selected='selected'"; }}?>>11:00 AM</option>
	<option value="12" <?php if(!$numrow=="") { { if($shop_query['end_time']=="12") echo "selected='selected'"; }}?>>12:00 PM</option>
	<option value="13" <?php if(!$numrow=="") { { if($shop_query['end_time']=="13") echo "selected='selected'"; }}?>>01:00 PM</option>
	<option value="14" <?php if(!$numrow=="") { { if($shop_query['end_time']=="14") echo "selected='selected'"; }}?>>02:00 PM</option>
	<option value="15" <?php if(!$numrow=="") { { if($shop_query['end_time']=="15") echo "selected='selected'"; }}?>>03:00 PM</option>
	<option value="16" <?php if(!$numrow=="") { { if($shop_query['end_time']=="16") echo "selected='selected'"; }}?>>04:00 PM</option>
	<option value="17" <?php if(!$numrow=="") { { if($shop_query['end_time']=="17") echo "selected='selected'"; }}?>>05:00 PM</option>
	<option value="18" <?php if(!$numrow=="") {{ if($shop_query['end_time']=="18") echo "selected='selected'"; }}?>>06:00 PM</option>
	<option value="19" <?php if(!$numrow=="") { { if($shop_query['end_time']=="19") echo "selected='selected'"; }}?>>07:00 PM</option>
	<option value="20" <?php if(!$numrow=="") { { if($shop_query['end_time']=="20") echo "selected='selected'"; }}?>>08:00 PM</option>
	<option value="21" <?php if(!$numrow=="") { { if($shop_query['end_time']=="21") echo "selected='selected'"; }}?>>09:00 PM</option>
	<option value="22" <?php if(!$numrow=="") { { if($shop_query['end_time']=="22") echo "selected='selected'"; }}?>>10:00 PM</option>
	<option value="23" <?php if(!$numrow=="") { { if($shop_query['end_time']=="23") echo "selected='selected'"; }}?>>11:00 PM</option>

</select>
	</div>
	<!--<div class="form-group col-md-6" >
		<label>Gender<span class="star">*</span></label>
	<select id="gender" name="gender" class="form-control" required>
		<option value="1" <?php  if(!$numrow=="") { { if($shop_query['gender']=="1") echo "selected='selected'"; } }?>>Male</option>
		<option value="2" <?php  if(!$numrow=="") { { if($shop_query['gender']=="2") echo "selected='selected'"; } }?>>Female</option>
		<option value="3" <?php  if(!$numrow=="") { { if($shop_query['gender']=="3") echo "selected='selected'"; } }?>>Unisex</option>
	</select>
	</div>-->



	<div class="form-group col-md-6" >
		<label>Shop Cover Photo</label>
		<p style="color:#e00000"> [Please select an image 870px / 540px]</p>
		<input type="file"  name="shop_cover_photo" id="shop_cover_photo" class="form-control" value="">
		<?php
		 if(!$numrow=="") {
			if($shop_query['cover_photo']=="") {  } else { ?>
				<img class="img-responsive cover_img" src="<?php echo $site_url; ?>shop/shop-img/<?php echo $shop_query['cover_photo'];?>" alt="" style="margin-top:20px;">
		 <?php } ?>
				 <?php } ?>

	</div>


	<div class="form-group col-md-6" >
		<label>Shop Profile Photo</label>
		<p style="color:#e00000"> [Please select an image 150px / 150px]</p>
		<input type="file"  name="shop_profile_photo" id="shop_profile_photo" class="form-control" value="">
		<?php
		 if(!$numrow=="") {
			if($shop_query['profile_photo']=="") {  } else { ?>
				<img class="img-responsive cover_img" src="<?php echo $site_url; ?>shop/shop-img/<?php echo $shop_query['profile_photo'];?>" alt="" style="margin-top:20px;">
		 <?php } ?>
				 <?php } ?>

	</div>



	<div class="form-group col-md-6" >
		<label>Advance Booking upto<span class="star">*</span></label>
			<select id="opening_days" name="opening_days" class="form-control" required>

	<option value="1" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="1") echo "selected='selected'"; } }?>>1 Day</option>
	<option value="2" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="2") echo "selected='selected'"; } }?>>2 Days</option>
	<option value="3" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="3") echo "selected='selected'"; } }?>>3 Days</option>
	<option value="4" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="4") echo "selected='selected'"; } }?>>4 Days</option>
	<option value="5" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="5") echo "selected='selected'"; } }?>>5 Days</option>
	<option value="6" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="6") echo "selected='selected'"; } }?>>6 Days</option>
	<option value="7" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="7") echo "selected='selected'"; } }?>>7 Days</option>
	<option value="8" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="8") echo "selected='selected'"; }}?>>8 Days</option>
	<option value="9" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="9") echo "selected='selected'"; }}?>>9 Days</option>
	<option value="10" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="10") echo "selected='selected'"; }}?>>10 Days</option>
	<option value="11" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="11") echo "selected='selected'"; }}?>>11 Days</option>
	<option value="12" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="12") echo "selected='selected'"; }}?>>12 Days</option>
	<option value="13" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="13") echo "selected='selected'"; }}?>>13 Days</option>
	<option value="14" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="14") echo "selected='selected'"; }}?>>14 Days</option>
	<option value="15" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="15") echo "selected='selected'"; }}?>>15 Days</option>
	<option value="16" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="16") echo "selected='selected'"; }}?>>16 Days</option>
	<option value="17" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="17") echo "selected='selected'"; }}?>>17 Days</option>
	<option value="18" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="18") echo "selected='selected'"; }}?>>18 Days</option>
	<option value="19" <?php if(!$numrow=="") {{ if($shop_query['booking_opening_days']=="19") echo "selected='selected'"; }}?>>19 Days</option>
	<option value="20" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="20") echo "selected='selected'"; }}?>>20 Days</option>
	<option value="21" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="21") echo "selected='selected'"; }}?>>21 Days</option>
	<option value="22" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="22") echo "selected='selected'"; }}?>>22 Days</option>
	<option value="23" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="23") echo "selected='selected'"; }}?>>23 Days</option>
	<option value="24" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="24") echo "selected='selected'"; }}?>>24 Days</option>
	<option value="25" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="25") echo "selected='selected'"; }}?>>25 Days</option>
	<option value="26" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="26") echo "selected='selected'"; }}?>>26 Days</option>
	<option value="27" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="27") echo "selected='selected'"; }}?>>27 Days</option>
	<option value="28" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="28") echo "selected='selected'"; }}?>>28 Days</option>
	<option value="29" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="29") echo "selected='selected'"; }}?>>29 Days</option>
	<option value="30" <?php if(!$numrow=="") { { if($shop_query['booking_opening_days']=="30") echo "selected='selected'"; }}?>>30 Days</option>

</select>
	</div>
	<div class="form-group col-md-6" >
		<label>Shop Working Days<span class="star">*</span></label>		<br>
		<?php
			$id1=$shop_query['id'];
			$query=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where id='$id1' "));
			$sid=$query['shop_date'];
			$sel=explode(",",$sid);
			$lev=count($sel);
		?>
		<input type="checkbox" name="check_list[]" id="" class=""  value="0" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="0") echo "checked=='checked'"; }?>>Sunday <br>
		<input type="checkbox" name="check_list[]" id="" class=""  value="1" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="1") echo "checked=='checked'"; }?>>Monday <br>
		<input type="checkbox" name="check_list[]" id="" class=""  value="2" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="2") echo "checked=='checked'"; }?>>Tuesday <br>
		<input type="checkbox" name="check_list[]" id="" class=""  value="3" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="3") echo "checked=='checked'"; }?>>Wednesday <br>
		<input type="checkbox" name="check_list[]" id="" class=""  value="4" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="4") echo "checked=='checked'"; }?>>Thursday  <br>
		<input type="checkbox" name="check_list[]" id="" class=""  value="5" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="5") echo "checked=='checked'"; }?>>Friday  <br>
		<input type="checkbox" name="check_list[]" id="" class=""  value="6" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="6") echo "checked=='checked'"; }?>>Saturday

	</div>

	<div class="form-group col-md-6" >
		<label>Allowed Bookings Per Hour <span class="star">*</span></label>		<br>
		<input type="text" id="booking_per_hour" name="booking_per_hour" class="form-control" required value="<?php if(!$numrow=="") { echo $shop_query['booking_per_hour']; } ?>">

	</div>


	</div>
	<div class="form-group col-md-6">
		<div class="col-md-3">
		   <?php if($demo_mode=="off") { ?>
			<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Save">
		   <?php } else { ?>
   			<input type="button" disabled="disabled" tabindex="4" class="form-control btn btn-login" value="Save"><span class="demomode">[Demo Mode Enabled]</span>
		   <?php } ?>
			</div>
	</div>

</div>
</form>

	<?php } ?>

<?php
if(!isset($_REQUEST['id']) && !$numrow=="" )
	{
?>
	<div class="container">
	<div class="form-group">
		<div class="row">
			<div class="col-sm-2">
				<a href="shop.php?id=<?php echo $id;?>"><input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="<?php echo get_record(139,$lang,$en,$con);?>"></a>
			</div>
			<div class="col-sm-2">
				<a href="<?php echo $site_url; ?>/services/services.php" target="_blank"><input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register sv_services_butt" value="<?php echo get_record(152,$lang,$en,$con);?>"></a>
			</div>
		</div>
	</div>
	</div>
	<?php } ?>

<?php } else { header('Location:../login/login.php'); }?>
	<?php include("../footer.php"); ?>

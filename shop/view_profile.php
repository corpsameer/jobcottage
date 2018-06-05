<?php 
include('../header.php');
include('../database/connection.php');

?>

<div class="min-space"></div>
<?php 
if(isset($_REQUEST['id']))
	{		
		$shop_id=mysql_real_escape_string($_REQUEST['id']);		
	}
	else
	{$shop_id="";}
?>

<div class="container">
<div class="col-md-12">
<div class="row">
<?php 
$shop_query=mysql_fetch_array(mysql_query("select * from sv_shop where id='$shop_id'"));
$pno=$shop_query['phone_no'];

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
</div>


<div class="container">
<div class="row">
	<div class="col-md-12">
  <ul class="nav nav-tabs sv_nav_tab">
    <li class="active col-md-3"><a data-toggle="tab" href="#menu1"><?php echo get_record(46,$lang,$en);?></a></li>
    <li class="col-md-2"><a data-toggle="tab" href="#home"><?php echo get_record(107,$lang,$en);?></a></li>
    <li class="col-md-2"><a data-toggle="tab" href="#menu2"><?php echo get_record(108,$lang,$en);?></a></li>
    <li class="col-md-2"><a data-toggle="tab" href="#menu3"><?php echo get_record(109,$lang,$en);?></a></li>
	<li class="col-md-3"><a data-toggle="tab" href="#menu4"><?php echo get_record(128,$lang,$en);?></a></li>
  </ul>
  </div>
  <div class="tab-content profile_det">

  
  
   <div id="menu1" class="tab-pane fade in active">
		
		<div class="col-md-12">
		<?php 		
			$services_query=mysql_query("select * from sv_seller_services where phone_no='$pno'");
			while($services_fet=mysql_fetch_array($services_query))
			{
				$id=$services_fet['id'];
				$services_id=$services_fet['services_id'];
				 if($lang==$en)
						{
							$ser_id="id";
							}
							else
							{
							$ser_id="page_parent";
							}	
				$fetch=mysql_fetch_array(mysql_query("select * from sv_services where $ser_id='$services_id' and lang_code='$lang'"));
		?>
		<div class="col-md-3">
			<div class="services">
			<div class="col-md-6"><img src="<?php echo $site_url; ?>admincp/img/<?php echo $fetch['service_img']; ?>" border="0" class="img-responsive imgradius sv_mob_service_img" alt=""></div>
			
			
				<div class="col-md-6 nopadding">
				<h4 class="customh4"><?php echo $fetch['services_name']; ?></h4>
				<!---<span class="icon_info" aria-hidden="true"></span>-->
					<h5 class="customh5"><i class="fa fa-info-circle" aria-hidden="true"></i> <?php echo $services_fet['price']; ?>&nbsp;<?php echo $currency_mode; ?> | <?php echo $services_fet['time']; echo " hr"; ?></h5>
					
				</div>
				
				
					<div class="col-md-12">
					<a href="<?php echo $site_url; ?>shop/view_booking.php?id=<?php echo $shop_id; ?>&service_id=<?php echo $services_id; ?>"><input type="submit" name="register-submit" id="register-submit" tabindex="4" class="booknow" value="<?php echo get_record(12,$lang,$en);?>"></a>
				    <a href="<?php echo $site_url; ?>shop/view_booking.php?id=<?php echo $shop_id; ?>&service_id=<?php echo $services_id; ?>"><p>Book Now</p></a>
					</div>
			</div>
		</div>
		<?php } ?>
		</div>
		
		</div>
  
  
    <div id="home" class="tab-pane fade ">
		
		<div class="col-md-6">
			<h3><?php echo get_record(129,$lang,$en);?></h3>
			<p><?php echo $shop_query['description']; ?></p>
			<div class="min-space"></div>
			<h3><?php echo get_record(130,$lang,$en);?></h3>
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
	
				<?php
				$query=mysql_fetch_array(mysql_query("select * from sv_shop where id='$shop_id'"));
				$sid=$query['shop_date'];
				
				$sel=explode(",",$sid);
				$lev=count($sel);				
				?>
				</div>
				<div class="col-md-6 working_day">
				<h3><?php echo get_record(131,$lang,$en);?></h3>
					<p><?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="0") echo "Sunday"; }?></p>
					<p><?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="1") echo "Monday"; }?></p>
					<p><?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="2") echo "Tuesday"; }?></p>
					<p><?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="3") echo "Wednesday"; }?></p>
					<p><?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="4") echo "Thursday"; }?></p>
					<p><?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="5") echo "Friday "; }?></p>
					<p><?php for($i=0;$i<$lev;$i++){ if($sel[$i]=="6") echo "Saturday"; }?></p>
				</div>
	 </div>

    <div id="menu2" class="tab-pane fade">
		
   
		<?php
		$s="";
		
		$ratg=mysql_query("select * from sv_rating where shop_id='$shop_id'");
		$numrow=mysql_num_rows($ratg);
		if($numrow=='0') { ?>
		 <div class="rating">
		<?php 
			echo get_record(182,$lang,$en); ?>
			
			
			</div>
		<?php
		}
		else {
		while($rating=mysql_fetch_array($ratg))
		{
			$pno=$rating['phone_no'];
			$user_info=mysql_fetch_array(mysql_query("select * from sv_users where phone_no='$pno'"));
		 $rating_star = $rating['rating'];
		?>
		 <div class="rating">
		 <?php
		if($rating_star=="")
		{
			echo "No Reviews";
		}
		else {
		$star = "shop-img/star".$rating_star.".png";	
		echo"<img src='$star' alt='rated $rating_star stars' title='rated $rating_star stars' />  - &nbsp; ";   echo $user_info['user_name'] ; ?>
		<h4> <?php echo $rating['comment']; ?></h4>
		<?php
		}
		?>
		  
		</div>
		<?php } ?>
		<?php } ?>
	 
    </div>
	
    <div id="menu3" class="tab-pane fade sv_gallery_image">
	
	  <?php 
 		$gallery=mysql_query("select * from sv_shop_gallery where shop_id='$shop_id'");
		$sv_rows=mysql_num_rows($gallery);
		while($sql=mysql_fetch_array($gallery))
		{
	  if($sql['image']!="")
	  {
	  ?>
      <div class="col-md-3">
		<a href="<?php echo $site_url; ?>shop/shop-img/<?php echo $sql['image']; ?>" data-lightbox="image-1" >
			<img class="img-responsive" src="<?php echo $site_url; ?>shop/shop-img/<?php echo $sql['image']; ?>">
		</a>
	</div>
		<?php }  }?>
	  <?php if($sv_rows=="") { ?>		  
	  <p style="color:#e00000;text-align:center;float:none;margin-top:20px;"><?php echo get_record(244,$lang,$en);?></p>
		<?php }  ?>
    </div>
	
	 <div id="menu4" class="tab-pane fade">
		
		<form class="" name="admin_s" id="admin_s" method="post" enctype="multipart/form-data" action="contact_vendor_add.php">
		<input type="hidden" id="vendor_id" name="vendor_id" value="<?php echo $shop_id; ?>">
			<div class="col-md-6">
				<label><?php echo get_record(132,$lang,$en);?></label>
				<input type="text"  name="name" id="name" class="form-control" required value="">
			</div>
			<div class="col-md-6">
				<label><?php echo get_record(133,$lang,$en);?></label>
				<input type="number"  name="phone_no" id="phone_no" class="form-control" required value="">
			</div>
			<div class="col-md-6">
				<label><?php echo get_record(134,$lang,$en);?></label>
				<input type="email"  name="email" id="email" class="form-control" required value="">
			</div>
			<div class="col-md-6">
				<label><?php echo get_record(135,$lang,$en);?></label>
				<textarea name="message" id="message" class="form-control" required ></textarea>
			</div>
			<div class="col-md-2">
				<input type="submit" name="register-submit" id="register-submit" class="form-control btn btn-register" value="<?php echo get_record(137,$lang,$en);?>">
			</div>
	
		
		</form>
	    </div>

</div>
</div>
</div>


<div class="min-space"></div>
<?php include("../footer.php"); ?>
	
	
	
	
<?php 
include('../header.php');
 include("../database/connection.php");
?>

<?php		
	if (isset($_REQUEST['city'], $_REQUEST['services']))
	{
		$city=$_REQUEST['city']; 
		$services=$_REQUEST['services'];
	}
	else if(isset($_REQUEST['services']))
	{
		 $services=$_REQUEST['services'];
		 $city="";
	}
	else{
		$city="";$services="";
	}
?>
<div class="profile_main sv_main_search">
<h1 class="text-center"><?php echo get_record(70,$lang,$en);?> </h1>
<div class="container">
<div class="col-lg-12">
		<div class="filter">
			<div class="form-group col-md-5">
				<select name="langOpt[]" multiple id="langOpt" class="form-control">
				<?php 

	
	


				
					$res=mysql_query("select * from sv_services where lang_code='$lang'");
					
					
					while($row=mysql_fetch_array($res))
					{
						if($lang==$en)
						{
						$ser_id=$row['id'];
						}
						else
						{
							$ser_id=$row['page_parent'];
						}
						
						$sel=explode(",",$ser_id);
						$lev=count($sel);
				?>
                <option value="<?php echo $ser_id; ?>" <?php for($i=0;$i<$lev;$i++){ if($sel[$i]==$services) echo "selected"; }?>><?php echo $row['services_name']; ?></option>

				<?php } ?>
			</select>
			</div>
			
					
			<div class="form-group col-md-5">
			
			  <input class="form-control" id="city" placeholder="<?php echo get_record(243,$lang,$en);?>" name="city" value="<?php echo $city; ?>"> 
			  </div>
			  
			  <div class="form-group col-md-2">
			 		<button class="form-control btn btn-login sv_search_button" onclick="javascript:filter_funct();"><?php echo get_record(105,$lang,$en);?></button>		  
				
				</div>
			  
		</div>
	</div>
	</div>
</div>
<div class="container">

<div class="min-space"></div>
	<div class="col-md-12"> 
			<div id="filter1">

		<?php		
		
			if(isset($_REQUEST['services']))
	{
		$reqst=$_REQUEST['services'];
		$result=mysql_query("select * from sv_shop inner join sv_seller_services on sv_shop.id=sv_seller_services.shop_id where sv_seller_services.services_id='$reqst'");
	
			
			while($row=mysql_fetch_array($result)) 
				{					
					$shop_id=$row['shop_id'];
		?>	
		<div class="col-md-3">
		<div class="shop-list-page">
			<div class="shop_pic">
			<?php
				if($row['cover_photo']=="")
				{
			?>
				<a href="<?php echo $site_url; ?>/shop/view_profile.php?id=<?php echo $shop_id; ?>" ><img class="img-responsive" src="<?php echo $site_url; ?>shop/shop-img/shop-default.jpg" alt=""></a>
			<?php } else { ?>
				<a href="<?php echo $site_url; ?>/shop/view_profile.php?id=<?php echo $shop_id; ?>" ><img class="img-responsive" src="<?php echo $site_url; ?>shop/shop-img/<?php echo $row['cover_photo']; ?>" alt=""></a>
				<?php } ?>
			 </div>
        	<div class="col-lg-12 shop_content">
				<h4 class="sv_shop_style"><a href="<?php echo $site_url; ?>/shop/view_profile.php?id=<?php echo $shop_id; ?>" ><?php echo $row['shop_name']; ?></a></h4>
				<h5><span class="icon_pin_alt" aria-hidden="true"></span>&nbsp;<?php echo $row['city']; ?></h5>
				
				<?php 				
					if($row['start_time']>12)
					{
						$start=$row['start_time']-12;
						$stime=$start."PM";
					}
					else
					{
						$stime=$row['start_time']."AM";
					}
					if($row['end_time']>12)
					{
						$end=$row['end_time']-12;
						$etime=$end."PM";
					}
					else
					{
						$etime=$row['end_time']."AM";
					}
				?>
				<h5><span class="icon_clock_alt" aria-hidden="true"></span> <?php echo $stime; ?> - <?php echo $etime; ?></h5>
			
				<a href="view_profile.php?id=<?php echo $shop_id; ?>"><button type="submit" name="" id="" class="booknow shop-booknow" value="Book Now"><?php echo get_record(106,$lang,$en);?></button></a>
			<a href="view_profile.php?id=<?php echo $shop_id; ?>"><p>Book Now</p></a>
			</div> 
		 </div>
		 </div>
		<?php } 

		?>		
	</div> 
<?php  }
 else 
 {
	 
	$city="";
	$services=""; 
	
	
	$result=mysql_query("select * from sv_shop where status='approved'");
	
	while($row=mysql_fetch_array($result)) 
	{
		$shop_id=$row['id'];
		?>
			<div class="col-md-3">
		<div class="shop-list-page">
			<div class="shop_pic">
			<?php
				if($row['cover_photo']=="")
				{
			?>
				<a href="<?php echo $site_url; ?>/shop/view_profile.php?id=<?php echo $shop_id; ?>" ><img class="img-responsive" src="<?php echo $site_url; ?>shop/shop-img/shop-default.jpg" alt=""></a>
			<?php } else { ?>
				<a href="<?php echo $site_url; ?>/shop/view_profile.php?id=<?php echo $shop_id; ?>" ><img class="img-responsive" src="<?php echo $site_url; ?>shop/shop-img/<?php echo $row['cover_photo']; ?>" alt=""></a>
				<?php } ?>
			 </div>
        	<div class="col-lg-12 shop_content">
				<h4 class="sv_shop_style"><a href="<?php echo $site_url; ?>/shop/view_profile.php?id=<?php echo $shop_id; ?>" ><?php echo $row['shop_name']; ?></a></h4>
				<h5><span class="icon_pin_alt" aria-hidden="true"></span>&nbsp;<?php echo $row['city']; ?></h5>
				
				<?php 				
					if($row['start_time']>12)
					{
						$start=$row['start_time']-12;
						$stime=$start."PM";
					}
					else
					{
						$stime=$row['start_time']."AM";
					}
					if($row['end_time']>12)
					{
						$end=$row['end_time']-12;
						$etime=$end."PM";
					}
					else
					{
						$etime=$row['end_time']."AM";
					}
				?>
				<h5><span class="icon_clock_alt" aria-hidden="true"></span> <?php echo $stime; ?> - <?php echo $etime; ?></h5>
							
				<a href="view_profile.php?id=<?php echo $row['id']; ?>"><button type="submit" name="" id="" class="booknow shop-booknow" value="Book Now">View Profile & Book</button></a>
			<a href="view_profile.php?id=<?php echo $row['id']; ?>"><p>Book Now</p></a>
			
			</div> 
		 </div>
		 </div>
		 <?php
		} 
   }
?>
</div>
	
<div class="sv_filter_err" id="filter_empty"></div>	
		
</div>




<div class="min-space"></div>
<script src="<?php echo $site_url; ?>/js/jquery.multiselect.js"></script>
<script>
$('#langOpt').multiselect({
    columns: 1,
    placeholder: 'Select Services'
});
</script>
</div>
<div class="min-space"></div>

<?php include('../footer.php'); ?>	

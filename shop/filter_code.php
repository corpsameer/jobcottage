<?php
include('../database/connection.php');

$services=mysql_real_escape_string($_REQUEST['services']);
$city=mysql_real_escape_string($_REQUEST['city']);


if($services!="")
{
	$sel=explode("," , $services);
	$lev=count($sel);
	
	$ser_name="";
	$sv_service="";
	for($i=0;$i<$lev;$i++)
	{	
		$sql="";
		 $sid=$sel[$i];
		
		$sv_service .=$sid.',';
		 $rd=rtrim($sv_service,",");
		$sql.="where find_in_set(sv_seller_services.services_id,'$rd') and status='approved' ";	
		if($city!="")
		{
			$sql.="and sv_shop.city like '%$city%' and status='approved'";	
		}

		//$sql_query=mysql_query("select * from sv_shop inner join sv_seller_services on sv_shop.id=sv_seller_services.shop_id $sql ");
		
	}
		$sql_query=mysql_query("select * from sv_shop inner join sv_seller_services on sv_seller_services.shop_id=sv_shop.id $sql group by sv_shop.id");
		while($row=mysql_fetch_array($sql_query))
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
				<h4 class="sv_shop_style"><a href="<?php echo $site_url; ?>/shop/view_profile.php?id=<?php echo $shop_id; ?>"><?php echo $row['shop_name']; ?></a></h4>
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
				<a href="view_profile.php?id=<?php echo $shop_id; ?>"><button type="submit" name="" id="" class="booknow shop-booknow" value="Book Now">View Profile & Book</button></a>
			</div> 
		 </div>
		 </div>
		<?php
		}	
}
else
{
	$sql="";
	if($city!="")
		{			
			$sql.="where sv_shop.city like '%$city%' and status='approved' ";
			
		}
		if($city=="" && $services=="")
		{			
			$sql.="where status='approved'";
		}
		
$sql_query=mysql_query("select * from sv_shop $sql");

while($row=mysql_fetch_array($sql_query))
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
			<a href="<?php echo $site_url; ?>/shop/view_profile.php?id=<?php echo $shop_id; ?>" >	<img class="img-responsive" src="<?php echo $site_url; ?>shop/shop-img/<?php echo $row['cover_photo']; ?>" alt=""></a>
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
			</div> 
		 </div>
		 </div>
	 <?php
	}
}
?>

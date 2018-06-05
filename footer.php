<div class="footer-main">
  <div class="container">
    <div class="row">
	
	<div class="col-md-12">
	<div class="social-icons">
	<label><?php echo get_record(43,$lang,$en,$con);?> : </label>
			<?php
				$social_login=mysqli_fetch_array(mysqli_query($con, "select * from sv_social_login"));  
						$facebook=$social_login['facebook'];
					?>
					<?php if($social_login['facebook']=="") { ?><a href="#"><img src="<?php echo $site_url; ?>img/facebook.png"></a><?php } else { ?><a href="<?php echo $facebook; ?>" target="blank"><img src="<?php echo $site_url; ?>img/facebook.png"></a><?php } ?>
					<?php if($social_login['twitter']=="") { ?><a href="#"><img src="<?php echo $site_url; ?>img/twitter.png"></a><?php } else { ?><a target="blank" href="<?php echo $social_login['twitter']; ?>"><img src="<?php echo $site_url; ?>img/twitter.png"></a><?php } ?>
					<?php if($social_login['pinterest']=="") { ?><a href="#"><img src="<?php echo $site_url; ?>img/pinterest.png"></a><?php } else { ?><a target="blank" href="<?php echo $social_login['pinterest']; ?>"><img src="<?php echo $site_url; ?>img/pinterest.png"></a><?php } ?>
					<?php if($social_login['google_plus']=="") { ?><a href="#"><img src="<?php echo $site_url; ?>img/google-plus.png"></a><?php } else { ?><a target="blank" href="<?php echo $social_login['google_plus']; ?>"><img src="<?php echo $site_url; ?>img/google-plus.png"></a><?php } ?>
					<?php if($social_login['linkedin']=="") { ?><a href="#"><img src="<?php echo $site_url; ?>img/linkedin.png"></a><?php } else { ?><a target="blank" href="<?php echo $social_login['linkedin']; ?>"><img src="<?php echo $site_url; ?>img/linkedin.png"></a><?php } ?>
			</div>
	</div>		
	
	
      <div class="ftr_list-main">
        
        <div class="col-md-4 mobilebottom">
          <div class="ftr_list">
            <h4> <?php echo get_record(44,$lang,$en,$con);?> </h4>
			
			<?php
			if($lang==$en){
				$query1=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where id=1 and lang_code='$lang' and page_parent='0'"));
				$query2=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where id=2 and lang_code='$lang' and page_parent='0'"));
				$query3=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where id=3 and lang_code='$lang' and page_parent='0'"));
				$query4=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where id=4 and lang_code='$lang' and page_parent='0'"));
				$query5=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where id=5 and lang_code='$lang' and page_parent='0'"));
				}
else
{
	$query1=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where lang_code='$lang' and page_parent='1'"));
	$query2=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where lang_code='$lang' and page_parent='2'"));
	$query3=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where lang_code='$lang' and page_parent='3'"));
	$query4=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where lang_code='$lang' and page_parent='4'"));
	$query5=mysqli_fetch_array(mysqli_query($con, "select * from sv_pages where lang_code='$lang' and page_parent='5'"));
}	
?>
			<ul>
              <li><a href="<?php echo $site_url; ?>"> <?php echo $query1['page_name'];?> </a></li>
              <li><a href="<?php echo $site_url; ?>pages/about.php"> <?php echo $query2['page_name'];?></a></li>
              <li><a href="<?php echo $site_url; ?>pages/contact.php">  <?php echo $query3['page_name'];?> </a></li>
              <li><a href="<?php echo $site_url; ?>pages/blog.php">  <?php echo get_record(45,$lang,$en,$con);?> </a></li>
			   <li><a href="<?php echo $site_url; ?>pages/privacy_policy.php"><?php echo $query5['page_name'];?>  </a></li>
              <li><a href="<?php echo $site_url; ?>pages/terms_conditions.php">  <?php echo $query4['page_name'];?></a></li>
            </ul>                     
          </div>
        </div>
		<div class="col-md-3 mobilebottom">
          <div class="ftr_list">
            <h4>  <?php echo get_record(46,$lang,$en,$con);?> </h4>
            <ul>
			<?php 
						$res2=mysqli_query($con, "select * from sv_services where lang_code='$lang' ORDER BY id ASC limit 0,5");
						
						$numrow2=mysqli_num_rows($res2);
						while($row2=mysqli_fetch_array($res2))
						{
							$services_names=mysqli_real_escape_string($con, $row2['services_name']);    
							
					?>
              <li><a href="#"> <?php echo $services_names;?> </a></li>
						<?php } ?>
            </ul>
          </div>
        </div>
        <div class="col-md-5 mobilebottom">
          <div class="ftr_list-clm3">
              <h4> <?php echo get_record(47,$lang,$en,$con);?> </h4> 	
             <p> <?php echo get_record(48,$lang,$en,$con);?></p>			  
          </div>
		  
		  <div>
		 
		  <div class="col-md-4 floatnone">
	<a href="#"><img alt="appstore" class="" src="<?php echo $site_url; ?>img/appstore.svg" height="40"></a>
	</div><div class="col-md-4 floatnone">
	<a href="#"><img alt="google_play" class="" src="<?php echo $site_url; ?>img/google_play.svg" height="40"></a>
	</div>
	<div class="col-md-4"></div>
	</div>
		  <div class="mini-space"></div>
		  <div class="social-links newpadmove">
			<img src="<?php echo $site_url; ?>img/paypal-icons.png" alt="Paypal" />
		</div>
		
		
        </div>
      </div>
     
    </div>
  </div>
</div>
<div class="ftr-copyrht">
  <div class="container">
    <div class="row"> <a href="#" target="_blank"> <?php echo get_record(49,$lang,$en,$con);?></a></div>

  </div>
</div>

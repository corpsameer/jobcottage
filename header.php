 <?php 
 ob_start();
 include("database/connection.php");
 include("database/common.php");
 include "query.php";
  @session_start();
 $res=mysql_fetch_array(mysql_query("select * from sv_admin_login"));        
    $admin_email=mysql_real_escape_string($res['email_id']);
    $site_name=mysql_real_escape_string($res['site_name']);
    $logo=mysql_real_escape_string($res['logo']);   
    $favicon=mysql_real_escape_string($res['favicon']);
    $site_desc=mysql_real_escape_string($res['site_desc']);
    $keyword=mysql_real_escape_string($res['keyword']);
    $site_url=mysql_real_escape_string($res['site_url']).'/';



 ?>

<head> <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <title><?php echo $site_name;?></title>
  <link rel="icon" href="<?php echo $site_url; ?>admincp/img/<?php echo $favicon;?>" >
  <meta name="description" content="<?php echo $site_desc; ?>">
  <meta charset="UTF-8">
    <meta name="keywords" content="<?php echo $keyword; ?>">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	<link rel="stylesheet" href="<?php echo $site_url; ?>css/bootstrap.min.css" type="text/css">
	    <link rel="stylesheet" href="<?php echo $site_url; ?>css/bootstrap-theme.min.css">
	<script type="text/javascript" src="<?php echo $site_url; ?>js/bootstrap.min.js"></script>

	<script>
	  $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
	</script>
	</script>
	
   <link rel="stylesheet" href="<?php echo $site_url; ?>css/font-awesome.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo $site_url; ?>css/style.css" type="text/css">
	<script type="text/javascript" src="<?php echo $site_url; ?>validation.js"></script>
	<?php if($lang=="ar"){?> 
	<link rel="stylesheet" href="<?php echo $site_url; ?>css/rtl.css" type="text/css">
	<?php } ?>
	
	<script src="<?php echo $site_url; ?>js/jquery-ui.js"></script>		
	<link rel="stylesheet" href="<?php echo $site_url; ?>css/jquery-ui.css">
	<script type="text/javascript" src="<?php echo $site_url; ?>js/jquery.form.js"></script>
	<link href="<?php echo $site_url; ?>css/jquery.multiselect.css" rel="stylesheet" type="text/css">
	<link href="<?php echo $site_url; ?>css/lightbox.css" rel="stylesheet">
<script src="<?php echo $site_url; ?>js/lightbox.js"></script>

<link rel="stylesheet" href="<?php echo $site_url; ?>css/animate.css">
  <link rel="stylesheet" href="<?php echo $site_url; ?>css/animated-columns.css">
 <script src="<?php echo $site_url; ?>js/wow.min.js" type="text/javascript"></script>
 <script  type="text/javascript">  new WOW().init(); </script>

    

  <script src="js/jquery.min.js"></script>
  
  
  <link rel="stylesheet" type="text/css" href="msdropdown/dd.css" />

<script type="text/javascript" src="msdropdown/js/jquery.dd.js"></script>

 <link href="slider/ma5slider.min.css" rel="stylesheet" type="text/css">
    
      
    
    <script src="slider/ma5slider.min.js"></script>
    <script>
        jQuery(window).on('load', function () {
            jQuery('.ma5slider').ma5slider();
        });
    </script>
	 <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="<?php echo $site_url; ?>assets/css/docs.theme.min.css">
    <link rel="stylesheet" href="<?php echo $site_url; ?>assets/owlcarousel/assets/owl.carousel.min.css">

    <!-- javascript -->
    <script src="assets/owlcarousel/owl.carousel.js"></script>
	 <script src="<?php echo $site_url; ?>assets/vendors/highlight.js"></script>
    <script src="<?php echo $site_url; ?>assets/js/app.js"></script>
	
</head> 


<?php /* ?><div class="sv_top_bar">
	<div class="container">
			<p class="left">CALL TODAY : 989-555-3256</p>
			<p class="right"> SUPPORT HOURS : MON-SAT (8.00AM - 6.00PM)</p>
		</div>
</div><?php */?>
 
<nav class="navbar navbar-default">
  <div class="container-fluid container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     <!-- <a class="navbar-brand" href="#">Brand</a>-->
	 
	 <?php
          if($logo=="") { ?>    
              <a href="<?php echo $site_url; ?>" class="site-logo"><img src="<?php echo $site_url; ?>admincp/img/default-logo.png" alt="" ></a>
          <?php } else {     ?>
              <a href="<?php echo $site_url; ?>" class="site-logo"><img src="<?php echo $site_url; ?>admincp/img/<?php echo $logo;?>"></a>
         <?php } ?>
	   
    </div>
	
	
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav right mobright">
       <?php /* ?> <li class="menuitem"><a href="<?php echo $site_url; ?>index.php">Home</a></li>
        <li class="menuitem"><a href="<?php echo $site_url; ?>shop/search.php">Service Providers</a></li>
		 <li><a href="<?php echo $site_url; ?>pages/about.php">About</a></li>
        <li><a href="<?php echo $site_url; ?>pages/blog.php"> Blog</a></li>
        <li><a href="<?php echo $site_url; ?>pages/contact.php"> Contact</a></li><?php */?>
        	 <?php 
            if(isset($_SESSION['phone_no'])) { 
				$phone_no=mysql_real_escape_string($_SESSION['phone_no']);   
				$query=mysql_fetch_array(mysql_query("select * from sv_users where phone_no='$phone_no'"));
				$usertype=$query['user_type'];
			?>
			  <li class="dropdown dropdown-submenu user_menu login-user"><a href="<?php echo $site_url; ?>login/dashboard.php" class="dropdown-toggle nav__link" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;<span><?php echo $query['user_name'];?></span> &nbsp; <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                         <li><a href="<?php echo $site_url; ?>login/dashboard.php"> <?php echo get_record(71,$lang,$en);?></a></li>
						<li><a href="<?php echo $site_url; ?>shop/my_bookings.php"> <?php echo get_record(72,$lang,$en);?></a></li>
						<?php if($usertype=="seller") { ?>
							<li><a href="<?php echo $site_url; ?>shop/myorder.php"> <?php echo get_record(73,$lang,$en);?></a></li>
							<li><a href="<?php echo $site_url; ?>shop/shop.php"> <?php echo get_record(74,$lang,$en);?></a></li>
							<li><a href="<?php echo $site_url; ?>services/services.php"> <?php echo get_record(75,$lang,$en);?></a></li>
							<li><a href="<?php echo $site_url; ?>shop/gallery.php"> <?php echo get_record(76,$lang,$en);?></a></li>
							<li><a href="<?php echo $site_url; ?>shop/withdraw.php"> <?php echo get_record(77,$lang,$en);?></a></li>

						<?php } ?>
                         <li><a href="<?php echo $site_url; ?>login/logout.php"> <?php echo get_record(78,$lang,$en);?></a></li>
                     </ul>
                </li>
				<?php } else { ?>
				<li ><a class="signin" href="<?php echo $site_url; ?>login/login.php"> <?php echo get_record(79,$lang,$en);?> </a></li>
				<li ><a class="register" href="<?php echo $site_url; ?>login/login.php"> <?php echo get_record(92,$lang,$en);?></a></li>
                <?php } ?>
				
				
				
	
				
				
		
      </ul>
	  
	  
	 <ul id="lang">
	 <?php $active_one=mysql_fetch_array(mysql_query("select * from sv_language where lang_status='1' and lang_code='$en' limit 0,1"));?>
<li><a href="" onClick="javascript:return false;" class="first arrow"><span><img src="<?php echo $site_url; ?>admincp/img/<?php echo $active_one['lang_flag'];?>"></span><?php echo $active_one['lang_code'];?></a>
<ul>
<?php 
				$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				if (strpos($actual_link,'?') !== false) {
					$langua="&lang=";
				} else {
					$langua="?lang=";
				}
				$activelang_des=mysql_query("select * from sv_language where lang_status='1' order by lang_id asc");
	while($rowlang_des=mysql_fetch_array($activelang_des)){?>
<li><a href="<?php echo $actual_link;?><?php echo $langua;?><?php echo $rowlang_des['lang_code'];?>"><span><img src="<?php echo $site_url; ?>admincp/img/<?php echo $rowlang_des['lang_flag'];?>"></span><?php echo $rowlang_des['lang_code'];?></a></li>
	<?php } ?>

</ul>
</li>
</ul>

	  

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
   

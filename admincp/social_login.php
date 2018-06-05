<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../database/connection.php"); ?>

<?php 
	$res=mysql_query("select * from sv_social_login");
	$row=mysql_num_rows($res);
		if($row==0)
	 	{
			$id="";
			$facebook="";
			$twitter="";
			$pinterest="";
			$google="";
			$linkedin=""; 
		}
		else
		{			
			$fet=mysql_fetch_array($res);	
			$id=mysql_real_escape_string($fet['id']);
					
			$facebook=mysql_real_escape_string($fet['facebook']);
			$twitter=mysql_real_escape_string($fet['twitter']);
			$pinterest=mysql_real_escape_string($fet['pinterest']);
			$linkedin=mysql_real_escape_string($fet['linkedin']);
			$google=mysql_real_escape_string($fet['google_plus']);
		}	
		$page = 'social-login';
?>

<body>
    <div id="wrapper">
        <?php include("top_menu.php") ?>
        <!--/. NAV TOP  -->
        <?php include("side_menu.php") ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
		  <div class="header"> 
             <h1 class="page-header">
                           Social Links
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Social Links</a></li>
					</ol>		
		</div>
            <div id="page-inner">
			    <div class="panel-body">
			<div class="text-center">
				<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		if($msg=="Inserted")
		{  echo '<div class="succ-msg">Inserted Successfully</div>'; }
		else if($msg=="Updated")
		{
		      echo '<div class="succ-msg">Updated Successfully</div>';		
		}
}
else
	$msg="";
?>					
	</div>
		<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
		<form class="" name="admin_s" id="admin_s" method="post" enctype="multipart/form-data" action="social_login_addcode.php">
							
								
				<div class="col-lg-12 col-md-12 col-sm-12">
					<h3 class="text-center space">Social Links</h3>	
						<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="form-group">
						<label>Facebook</label>	
							<input type="text" id="facebook" class="form-control" name="facebook" value="<?php echo $facebook;?>">
							</div>
						</div>
						
						<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="form-group">
							<label>Twitter</label>	
								<input type="text" id="twitter" class="form-control" name="twitter" value="<?php echo $twitter;?>">
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="form-group">
							<label>Pinterest</label>	
								<input type="text" id="pinterest" class="form-control" name="pinterest" value="<?php echo $pinterest;?>">
						</div>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="form-group">
							<label>Google Plus</label>	
								<input type="text" id="google-plus" class="form-control" name="google-plus" value="<?php echo $google;?>">
						</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="form-group">
							<label>Linkedin</label>	
								<input type="text" id="linkedin" class="form-control" name="linkedin" value="<?php echo $linkedin;?>">
						</div>
						</div>
					</div>
				

						
				<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="form-group col-lg-4 col-md-4 col-sm-4">
				 <?php if($demo_mode=="off") { ?>
					<button type="submit" class="btn btn-primary">Save</button>
					 <?php } else { ?>
			    <button type="button" class="btn btn-primary" disabled="disabled">Update</button> <span class="demomode">[Demo Mode Enabled]</span>
			   <?php } ?>
				</div>
				</div>
			</form>

		
            <div id="page-inner"> 
               
                               </div>
							 <?php include("footer.php") ?>

    </div>
             <!-- /. PAGE INNER  -->
       
</body>


</html>

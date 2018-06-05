<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../database/connection.php");
$res=mysql_fetch_array(mysql_query("select * from sv_admin_login"));        
    $admin_email=mysql_real_escape_string($res['email_id']);
    $site_name=mysql_real_escape_string($res['site_name']);
    $logo=mysql_real_escape_string($res['logo']);   
    $favicon=mysql_real_escape_string($res['favicon']);
    $site_desc=mysql_real_escape_string($res['site_desc']);
    $keyword=mysql_real_escape_string($res['keyword']);
    $site_url=mysql_real_escape_string($res['site_url']);	
 ?>

<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cleaning Service PHP Script - Sangvish</title>
	<!-- Bootstrap Styles-->
     <link href="css/bootstrap.css" rel="stylesheet" />
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
     <!-- FontAwesome Styles-->
    <link href="<?php echo $site_url; ?>admincp/css/font-awesome.css" rel="stylesheet" />
     <!-- Morris Chart Styles-->
   
        <!-- Custom Styles-->
    <link href="../admincp/css/custom-styles.css" rel="stylesheet" />

     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="<?php echo $site_url; ?>admincp/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
	<script type="text/javascript" src="../admincp/validation.js"></script>
	    <link href="../admincp/css/style.css" rel="stylesheet" />

</head>
<style>
body{background-color:#337ab7;}
#page-wrapper{box-shadow:none;}

</style>
				<div class="container">
				<div class="col-lg-4 col-md-4 col-sm-4"></div>
				<div class="col-lg-4 col-md-4 col-sm-4 login text-center">
			   		 <div class="header"> 
					 	<h1>Admin Panel </h1>
					  </div>
						<form action="javascript:login();" method="post" class="text-center">
							<div class="form-group">
								<input class="form-control" type="user" name="uname" id="uname" placeholder="Username" >
							</div>
							<div class="form-group">
								<input class="form-control" type="password" name="pwd" id="pwd" placeholder="Password">
							</div>
								<input id="remember" class="control rounded" type="checkbox">
								<a href="forgot.php">Forgot My Password</a>

							<?php if(isset($_REQUEST['msg'])) 	
								$msg=$_REQUEST['msg'];
								else
								$msg="";?>
							<div class="err" style="color:#e00000" id="err_id"><?php echo $msg;?></div>	
							<button type="submit" class="btn btn-primary">Login to my account</button>
					</form>	 
				</div>	   
	   			<div class="col-lg-4 col-md-4 col-sm-4"></div>
	   	</div>	   
	   </div>
	   
         <!-- /. PAGE   -->
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="js/dataTables/jquery.dataTables.js"></script>
    <script src="js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- Custom Js -->
    <script src="js/custom-scripts.js"></script>

</html>

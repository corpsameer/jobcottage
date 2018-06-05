<?php
 include("../database/connection.php");
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
	<!-- Bootstrap Styles-->
    <link href="css/bootstrap.css" rel="stylesheet" />
	<script type="text/javascript" src="js/bootstrap.min.js"></script>

     <!-- FontAwesome Styles-->
    <link href="css/font-awesome.css" rel="stylesheet" />
     <!-- Morris Chart Styles-->
   
        <!-- Custom Styles-->
    <link href="css/custom-styles.css" rel="stylesheet" />

     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
	<script type="text/javascript" src="validation.js"></script>
	    <link href="css/style.css" rel="stylesheet" />
		 <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	    <link href="css/style.css" rel="stylesheet" />
	  	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

		
		<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<script src="http://code.jquery.com/jquery-latest.min.js"></script>




</head>

<?php
@session_start();
if(!isset($_SESSION['user']))
	header("Location:index.php");
else
{		
	$user_name=mysql_real_escape_string($_SESSION['user']);			
	$res=mysql_fetch_array(mysql_query("select * from sv_admin_login where user_name='$user_name'"));
	$uname=mysql_real_escape_string($res['user_name']);
	$site_name=mysql_real_escape_string($res['site_name']);
}	
?>

<nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				
               <a class="navbar-brand" href="<?php echo $site_url;?>"><strong class="site_name"><?php echo $site_name; ?></strong></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
					<span><?php echo $uname;?></span>
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                       <li><a href="<?php echo $site_url;?>admincp/setting.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
						<li><a href="<?php echo $site_url;?>admincp/change_pwd.php"><i class="fa fa-unlock-alt"></i>&nbsp;Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo $site_url ?>admincp/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            
			 <li class="dropdown">
                    <a href="logout.php">					
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                    </a>                   
                </li>
			</ul>
        </nav>
		
        <!--/. NAV TOP  -->
		  <!-- jQuery Js -->
    <script src="js/jquery-1.10.2.js"></script>
	
       <script src="js/custom-scripts.js"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <!-- DATA TABLE SCRIPTS -->
    <script src="js/dataTables/jquery.dataTables.js"></script>
    <script src="js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
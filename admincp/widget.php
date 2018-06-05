<?php include("../database/connection.php"); ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<?php 
	$res=mysql_query("select * from sv_widget");
	$row=mysql_num_rows($res);
		if($row==0)
	 	{
			$id="";			
			$image="";
		}
		else
		{			
			$fet=mysql_fetch_array($res);	
			$admin_id=mysql_real_escape_string($fet['id']);
			$image=$fet['image'];
		}	
		$page = 'widget';
?>

  <body class="splash-index">
   
<?php include("top_menu.php") ?>

 <?php include("side_menu.php") ?>

<div id="page-wrapper" >
		
		  <div class="header"> 
                        <h1 class="page-header">
                            Widgets Details
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Widgets</a></li>
					  
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
		      echo '<div class="succ-msg">Widget details Updated Successfully.</div>';
		}
		else if($msg=="Deleted")
		{
		    echo '<div class="succ-msg">Widget details Deleted Successfully</div>';		
		}
		
}
else
	$msg="";
?>
</div>
			
				<form class="form-large" action="widget_add.php" accept-charset="UTF-8" method="post">
		<input type="hidden" id="id" name="id" value="<?php echo $id;?>">

				<div class="col-lg-12 col-md-12 col-sm-12" >
					<textarea class="form-control" required rows="5" id="image" name="image"><?php echo $image;?></textarea>
				</div>				
			
				<div class="col-lg-12 col-md-12 col-sm-12">
				 <?php if($demo_mode=="off") { ?>
					<button type="submit" class="btn btn-primary" onclick="">Update</button>
					  <?php } else { ?>
			    <button type="button" class="btn btn-primary" disabled="disabled">Update</button> <span class="demomode">[Demo Mode Enabled]</span>
			   <?php } ?>
					
				</div>
					</form>
				
			
			<div id="page-inner"> 
           
                <!-- /. ROW  -->
                   </div>
				  <?php include("footer.php") ?>

    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->	   
      </html>

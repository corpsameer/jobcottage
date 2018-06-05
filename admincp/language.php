<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../database/connection.php"); ?>

<?php 
if(isset($_REQUEST['lang_id']))
	{		
		$lang_id=mysqli_real_escape_string($con, $_REQUEST['lang_id']);
		$res=mysqli_query($con, "select * from sv_language where lang_id='$lang_id'");
		
		$row=mysqli_num_rows($res);
		if($row==0)
	 	{
		  $id="";
		  $lang_name="";
		   $lang_code="";
		  $flag_img="";
		   $typ="add";
		}
		else
		{			
			$fet=mysqli_fetch_array($res);
			$id=mysqli_real_escape_string($con, $fet['lang_id']);	
			$lang_name=mysqli_real_escape_string($con, $fet['lang_name']);	
			$lang_code=mysqli_real_escape_string($con, $fet['lang_code']);	
			$flag_img=mysqli_real_escape_string($con, $fet['lang_flag']);
			$typ="update";	
		}		
	}
	else
	{
		$id="";
		$services_name="";
		$service_img="";
		$typ="add";
	}
	$page = 'language';

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
                            Language
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Language</a></li>
					</ol>		
		</div>
            <div id="page-inner">
			<h3 class="sv_page-header"> Add New Language </h3>

			    <div class="panel-body">
			<div class="text-center">
				<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		if($msg=="Inserted")
		{
			echo '<div class="succ-msg">Inserted Successfully. </div>'; 
		}
		else if($msg=="Updated")
		{
		    echo '<div class="succ-msg">Updated Successfully.</div>';		
		}
		else if($msg=="Deleted")
		{
		    echo '<div class="succ-msg">Deleted Successfully.</div>';		
		}
		else if($msg=="select-img")
		{
		    echo '<div class="err-msg">Please select language image</div>';		
		}		
		else if($msg=="imgerr")
		{
		    echo '<div class="err-msg">Select only jpeg, jpg, png image format</div>';		
		}
		else if($msg=="size-err")
		{
		    echo '<div class="err-msg">Service image is greather than 1 MB</div>';		
		}
}
else
	$msg="";
?>	
	</div>
		<form class="" name="admin_s" id="admin_s" method="post" enctype="multipart/form-data" action="language_add.php">
					<input type="hidden" id="typ" name="typ" value="<?php echo $typ;?>">
			<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
								
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="form-group col-lg-4 col-md-4 col-sm-4">
						<label>Name</label>		
							<input type="text" id="name" required class="form-control" name="name" value="<?php if(isset($_REQUEST['lang_id'])) { echo $lang_name; } ?>">												
					</div>
					<div class="form-group col-lg-4 col-md-4 col-sm-4">
						<label>ISO Code</label>		
							<input type="text" id="code" required class="form-control" name="code" value="<?php if(isset($_REQUEST['lang_id'])) { echo $lang_code; } ?>">
                            (Ex : en,de,ar )							
					</div>
					
					
					<div class="col-lg-4 col-md-4 col-sm-4 form-group">					
						<label>Flag Image</label>							
						<input type="file" id="flag_img" class="form-control" name="flag_img" value="<?php if(isset($_REQUEST['lang_id'])) { echo $flag_img; } ?>">
						<?php if(isset($_REQUEST['lang_id'])) { if($flag_img=="") { } else { ?>						
						  <img src="<?php echo $site_url; ?>admincp/img/<?php echo $flag_img;?>" >
						<?php } }?>
				</div>
				<input type="hidden" name="old_flag" value="<?php echo $flag_img;?>">
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
                  <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Language
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>SNo</th>
											<th>Name</th>
											<th>ISO Code</th>
											<th>Flag</th>
											<th>Update</th>
											<th>Delete</th>	
                                        </tr>
                                    </thead>
									<tbody>
									<?php
										$sno=0;
										$res=mysqli_query($con, "select * from sv_language");
										while($row=mysqli_fetch_array($res))
										{
											$sno++;
											$id=mysqli_real_escape_string($con, $row['lang_id']);	
											$flag_img=mysqli_real_escape_string($con, $row['lang_flag']);
			
									?>  									
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $row['lang_name'];?></td>
											<td><?php echo $row['lang_code'];?></td>
											<td><img class="service-pic" src="<?php echo $site_url; ?>admincp/img/<?php echo $flag_img;?>" ></td>
											<td>
											<?php if($row['lang_code']==$en && $row['lang_id']==1){?>
											<img src="img/not-allowed.png"  alt="Not Allowed" title="Not Allowed" >
											<?php } else { ?>
											<a href="language.php?lang_id=<?php echo $id;?>"><img src="img/file_edit.png"  alt="update" title="update" ></a>
											<?php } ?>
											</td>
											
											 <?php if($demo_mode=="off") { ?>
											<td>
											<?php if($row['lang_code']==$en && $row['lang_id']==1){?>
											<img src="img/not-allowed.png" alt="Not Allowed" title="Not Allowed">
											<?php } else { ?>
											<a href="language_add.php?type=delete&lang_id=<?php echo $id;?>&flag=<?php echo $flag_img;?>&lang_code=<?php echo $row['lang_code'];?>" onclick="return confirm('Are you sure you want to delete?');"><img src="img/delete.png" alt="" title="delete"></a>
											<?php } ?>
											</td>
											 <?php } else { ?>
											 <td><img src="img/delete.png" alt="" title="delete"><span class="demomode">[Demo Mode Enabled]</span></td>
											 <?php } ?>
											
										</tr>
										<?php } ?>		
									</tbody>
															
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
            </div>
			 <?php include("footer.php") ?>

    </div>
             <!-- /. PAGE INNER  -->
       
</body>


</html>

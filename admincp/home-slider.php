<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../database/connection.php"); ?>

<?php 
if(isset($_REQUEST['sid']))
	{		
		$sid=mysql_real_escape_string($_REQUEST['sid']);
		$res=mysql_query("select * from sv_slider where id='$sid'");
		$row=mysql_num_rows($res);
		if($row==0)
	 	{
		  $id="";
		  $slider_img="";
		   $typ="add";
		}
		else
		{			
			$fet=mysql_fetch_array($res);
			$id=mysql_real_escape_string($fet['id']);	
			$slider_img=mysql_real_escape_string($fet['slider_img']);				
			$typ="update";	
		}		
	}
	else
	{
		$id="";
		$slider_img="";
		 $typ="add";
	}
	$page = 'slider';

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
                            Home Page Slider
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Home Page Slider</a></li>
					</ol>		
		</div>
            <div id="page-inner">
						<h3 class="sv_page-header"> Add New Slider </h3>

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
		else if($msg=="select-img")
		{
		    echo '<div class="err-msg">Please select Slider Image</div>';		
		}		
		else if($msg=="imgerr")
		{
		    echo '<div class="err-msg">Select only jpeg, jpg, png image format</div>';		
		}
		else if($msg=="size-err")
		{
		    echo '<div class="err-msg">Slider Image is greather than 1 MB</div>';		
		}
		else if($msg=="Updated")
		{
		    echo '<div class="succ-msg">Updated Successfully.</div>';		
		}
		else if($msg=="Deleted")
		{
		    echo '<div class="succ-msg">Deleted Successfully.</div>';		
		}
}
else
	$msg="";
?>	
	</div>
		<form class="" name="admin_s" id="admin_s" method="post" enctype="multipart/form-data" action="slider_add.php">
					<input type="hidden" id="typ" name="typ" value="<?php echo $typ;?>">
			<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
								
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="form-group col-lg-6 col-md-6 col-sm-6">
						<label>Slider</label>		
							<input type="file" id="slider_img" class="form-control" name="slider_img" value="">
						<?php
						if($slider_img=="") { ?>	
	
						<?php
							}
							else
							{
							?>
						<img class="slider-img" src="<?php echo $site_url; ?>slider-img/<?php echo $slider_img;?>" alt="" >
						<?php } ?>							
					</div>
					<div class="err" id="logo_err"></div>
				</div>				
				<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="form-group col-lg-4 col-md-4 col-sm-4">
				 <?php if($demo_mode=="off") { ?>
						<button type="submit" class="btn btn-primary">Save</button>
				 <?php } else { ?>
				  <button type="button" class="btn btn-primary" disabled="disabled">Save</button> <span class="demomode">[Demo Mode Enabled]</span>
			   <?php } ?>
					</div></div>
			</form>

		
            <div id="page-inner"> 
                  <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Slider
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>SNo</th>
											<th>Slider Image</th>
											<th>Update</th>
											<th>Delete</th>	
                                        </tr>
                                    </thead>
									<tbody>
									<?php
										$sno=0;
										$res=mysql_query("select * from sv_slider");
										while($row=mysql_fetch_array($res))
										{
											$sno++;
											$id=mysql_real_escape_string($row['id']);				
									?>  									
										<tr>
											<td><?php echo $sno; ?></td>
											<td><img class="slider-img" src="<?php echo $site_url; ?>slider-img/<?php echo $row['slider_img'];?>" alt="" ></td>
											<td><a href="home-slider.php?sid=<?php echo $id;?>"><img src="img/file_edit.png"  alt="update" title="update" ></a></td>
											 <?php if($demo_mode=="off") { ?>
											<td><a href="javascript:slider_del('<?php echo $id;?>');"><img src="img/delete.png" alt="" title="delete"></a></td>
											 <?php } else { ?>
											 <td><img src="img/delete.png" alt="" title="delete"> <span class="demomode">[Demo Mode Enabled]</span></td>
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

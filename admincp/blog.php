<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include("../database/connection.php"); ?>

<?php 
if(isset($_REQUEST['bid']))
	{		
		$bid=mysql_real_escape_string($_REQUEST['bid']);
		$res=mysql_query("select * from sv_blog where id='$bid'");
		$row=mysql_num_rows($res);
		if($row==0)
	 	{
		  $id="";
		  $title="";
		  $desc="";
		   $typ="add";
		}
		else
		{			
			$fet=mysql_fetch_array($res);
			$id=mysql_real_escape_string($fet['id']);	
			$title=mysql_real_escape_string($fet['title']);	
			$desc=$fet['description'];
			$typ="update";	
		}		
	}
	else
	{
		$id="";
		$title="";
		$desc="";
		$typ="add";
	}
	$page = 'blog';

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
                            Blog
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Blog</a></li>
					</ol>		
		</div>

			
            <div id="page-inner">
			    <h3 class="sv_page-header"> <?php if(isset($_REQUEST['bid'])){ ?>Edit Blog<?php } else {?>Add Blog<?php } ?>  </h3>
			    <div class="panel-body">						          

			<div class="text-center">
				<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		if($msg=="Inserted")
		{
			echo '<div class="succ-msg">Blog Details Inserted Successfully. </div>'; 
		}
		else if($msg=="Updated")
		{
		    echo '<div class="succ-msg"> Blog Details Updated Successfully.</div>';		
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

		<form class="" name="admin_s" id="admin_s" method="post" enctype="multipart/form-data" action="blog_add.php">
					<input type="hidden" id="typ" name="typ" value="<?php echo $typ;?>">
			<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
								
				<div class="col-lg-12 col-md-12 col-sm-12">
				
				<ul class="nav nav-tabs">
					 <?php $activelang=mysql_query("select * from sv_language where lang_status='1' order by lang_id asc");
					 while($rowlang=mysql_fetch_array($activelang)){?>
        <li class="<?php if($rowlang['lang_id']==1){?>active<?php } ?>"><a data-toggle="tab" href="#section<?php echo $rowlang['lang_id'];?>"><img src="<?php echo $site_url; ?>admincp/img/<?php echo $rowlang['lang_flag'];?>" style="max-width:24px; max-height:24px;"> <span style="position:relative;top:2px;"><?php echo $rowlang['lang_name'];?></span></a></li>
					 <?php } ?>
		
       </ul>
	   
	   
	   
	    <div class="tab-content">
							 <?php $activelang_des=mysql_query("select * from sv_language where lang_status='1' order by lang_id asc");
					 while($rowlang_des=mysql_fetch_array($activelang_des)){?>
        <div id="section<?php echo $rowlang_des['lang_id'];?>" class="tab-pane fade in <?php if($rowlang_des['lang_id']==1){?>active<?php } ?>">
		<?php 
		if(isset($_REQUEST['bid'])){
		$id=$_REQUEST['bid'];
		}
		
		mysql_query("SET NAMES utf8");
		mysql_query("SET CHARACTER SET utf8");
		if($rowlang_des['lang_code']==$en)
		{
		$viewpage=mysql_query("select * from sv_blog where id='$id' and page_parent='0'");
		
		$onerow=mysql_fetch_array($viewpage);
		}
		else
		{ 
	        $langcode=$rowlang_des['lang_code'];
			$viewpage=mysql_query("select * from sv_blog where lang_code='$langcode' and page_parent='$id'");
			
		    $onerow=mysql_fetch_array($viewpage);
		}
		
		?>
                     <div style="text-align:left; margin-top:10px;">
					 <input type="hidden" name="code[]" value="<?php echo $rowlang_des['lang_code'];?>">
					 
					
					
					
					<div class="form-group col-lg-6 col-md-6 col-sm-6">
						

						<label>Title</label>		
							<input type="text" id="title[]" class="form-control validate[required]" name="title[]" value="<?php echo $onerow['title'];?>">								
					</div>
					 
					 
					 <div class="form-group col-lg-6 col-md-6 col-sm-6">
						<label>Description</label>							
						<textarea id="desc[]" class="form-control" rows="5" name="desc[]"><?php echo $onerow['description'];?></textarea>							
					</div>
					 
					</div>
               </div>
					 <?php } ?>
			  
				
			   </div>
	   
	   	
					
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
                            Blog
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>SNo</th>
											<th>Title</th>
											<th>Description</th>
											<th>Update</th>
											<th>Delete</th>	
                                        </tr>
                                    </thead>
									<tbody>
									<?php
										$sno=0;
										$res=mysql_query("select * from sv_blog where page_parent='0'");
										while($row=mysql_fetch_array($res))
										{
											$sno++;
											$id=mysql_real_escape_string($row['id']);	
			
									?>  									
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $row['title'];?></td>
											<td><?php echo $row['description']; ?></td>
											<td><a href="blog.php?bid=<?php echo $id;?>"><img src="img/file_edit.png"  alt="update" title="update" ></a></td>
											 <?php if($demo_mode=="off") { ?>
											<td><a href="blog_add.php?hid=<?php echo $id;?>&type=delete" onclick="return confirm('Are you sure you want to delete?');"><img src="img/delete.png" alt="" title="delete"></a></td>
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

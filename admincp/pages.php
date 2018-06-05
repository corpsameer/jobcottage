<html>
<head>
<?php include("../database/connection.php"); 

?>
<?php 
if(isset($_REQUEST['id']))
	{		
		$id=$_REQUEST['id'];
		$res=mysqli_query($con, "select * from sv_pages where id='$id'");
		$row=mysqli_num_rows($res);
				
			$fet=mysqli_fetch_array($res);	
			$id=$fet['id'];
			$page_name=$fet['page_name'];	
			$page_content=$fet['page_content'];					
			$typ="update";		
	}
	
	$page = 'pages';

?>

			  <script src="js/tinymce/tinymce.min.js"></script> 
		<!--<script>
		
    tinymce.init({
        selector: "textarea#page_content",
        theme: "modern",
        width: 970,
        height: 300,
        plugins: [
             "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
             "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
             "save table contextmenu directionality emoticons template paste textcolor"
       ],
       content_css: "css/content.css",
       toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons", 
       style_formats: [
            {title: 'Bold text', inline: 'b'},
            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
            {title: 'Example 1', inline: 'span', classes: 'example1'},
            {title: 'Example 2', inline: 'span', classes: 'example2'},
            {title: 'Table styles'},
            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ]
    }); 
		
</script> -->

<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
</head>
<body>
    <div id="wrapper">
        <?php include("top_menu.php") ?>
        <!--/. NAV TOP  -->
        <?php include("side_menu.php") ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
		  <div class="header"> 
                        <h1 class="page-header">
                            Pages
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">Pages</a></li>
					</ol>		
		</div>
		<input type="hidden" id="hid" name="hid" value="<?php echo $postal_id;?>">
            <div id="page-inner">
			    <div class="panel-body">
				<div class="text-center">
				<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		if($msg=="Updated")
		{
		      echo '<div class="succ-msg">Updated Successfully.</div>';
		}
		
}

else
	$msg="";
?>
				
<!--<div class="err-msg" id="err_id"><?php echo $msg;?></div>	</div>-->



    



		<form class="" name="admin_s" id="admin_s" method="post" enctype="multipart/form-data" action="pages_addcode.php">
<input type="hidden" id="typ" name="typ" value="<?php echo $typ;?>">
<input type="hidden" id="id" name="id" value="<?php echo $id;?>">
										<div class="col-lg-3 col-md-3 col-sm-3"></div>

				<div class="col-lg-12 col-md-12 col-sm-12">
				
				
				
				
				
				
                <div class="form-group">
				</div>
				<div class="text-center">
					<?php if(isset($_REQUEST['id'])) { ?>
					<div class="form-group">
                   
                     <ul class="nav nav-tabs">
					 <?php $activelang=mysqli_query($con, "select * from sv_language where lang_status='1' order by lang_id asc");
					 while($rowlang=mysqli_fetch_array($activelang)){?>
        <li class="<?php if($rowlang['lang_id']==1){?>active<?php } ?>"><a data-toggle="tab" href="#section<?php echo $rowlang['lang_id'];?>"><img src="<?php echo $site_url; ?>admincp/img/<?php echo $rowlang['lang_flag'];?>" style="max-width:24px; max-height:24px;"> <span style="position:relative;top:2px;"><?php echo $rowlang['lang_name'];?></span></a></li>
					 <?php } ?>
		
       </ul>
	   
	   
	   
                      		<div class="tab-content">
							 <?php $activelang_des=mysqli_query($con, "select * from sv_language where lang_status='1' order by lang_id asc");
					 while($rowlang_des=mysqli_fetch_array($activelang_des)){?>
        <div id="section<?php echo $rowlang_des['lang_id'];?>" class="tab-pane fade in <?php if($rowlang_des['lang_id']==1){?>active<?php } ?>">
		<?php $id=$_REQUEST['id'];
		mysqli_query($con, "SET NAMES utf8");
		mysqli_query($con, "SET CHARACTER SET utf8");
		if($rowlang_des['lang_code']==$en)
		{
		$viewpage=mysqli_query($con, "select * from sv_pages where id='$id' and page_parent='0'");
		$onerow=mysqli_fetch_array($viewpage);
		}
		else
		{ 
	        $langcode=$rowlang_des['lang_code'];
			$viewpage=mysqli_query($con, "select * from sv_pages where lang_code='$langcode' and page_parent='$id'");
		    $onerow=mysqli_fetch_array($viewpage);
		}
		
		?>
                     <div style="text-align:left; margin-top:10px;">
					 <input type="hidden" name="code[]" value="<?php echo $rowlang_des['lang_code'];?>">
					 <label>Page Name</label>		
					<input type="text" class="form-control" required="required" id="pname" name="pname[]" value="<?php echo $onerow['page_name'];?>">
					<label>Content</label>
					<textarea id="page_content" name="page_content[]" rows="20" style="width:100%"><?php echo $onerow['page_content'];?></textarea>
					</div>
               </div>
					 <?php } ?>
			   
			   </div>
			   <?php if($demo_mode=="off") { ?>
					<button type="submit" class="btn btn-primary" onclick="javascript:pages_funct('update')">Update</button>
			   <?php } else { ?>
			    <button type="button" class="btn btn-primary" disabled="disabled">Update</button> <span class="demomode">[Demo Mode Enabled]</span>
			   <?php } ?>

					<?php } else { ?>
					<?php } ?>
				</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3"></div>
		</form>
					</div>
			
	
            <div id="page-inner"> 
               
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Pages
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>SNo</th>
											<th>Page Name</th>
											<th>Update</th>
                                        </tr>
                                    </thead>
									<tbody>
									<?php
										$sno=0;
										$res=mysqli_query($con, "select * from sv_pages where page_parent='0' and lang_code='$en'");
										while($row=mysqli_fetch_array($res))
										{
											$sno++;
											$id=$row['id'];				
											$page_name=$row['page_name'];				
									?>  									
										<tr>
											<td><?php echo $sno; ?></td>
											<td><?php echo $page_name; ?></td>
											<td><a href="pages.php?id=<?php echo $id;?>"><img src="img/file_edit.png"  alt="update" title="update" ></a></td>
											
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

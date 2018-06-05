<?php include("../database/connection.php"); ?>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<?php 
	$res=mysqli_query($con, "select * from sv_widget");
	$row=mysqli_num_rows($res);
		if($row==0)
	 	{
			$id="";			
			$image="";
		}
		else
		{			
			$fet=mysqli_fetch_array($res);	
			$admin_id=mysqli_real_escape_string($con, $fet['id']);
			$image=$fet['image'];
		}	
		$page = 'translate';
?>

  <body class="splash-index">
   
<?php include("top_menu.php") ?>

 <?php include("side_menu.php") ?>

<div id="page-wrapper" >
		
		  <div class="header"> 
                        <h1 class="page-header">
                            Translate
                        </h1>
						<ol class="breadcrumb">
					  <li><a href="#">Home</a></li>
					  <li><a href="#">translate</a></li>
					  
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
		      echo '<div class="succ-msg">Translate Updated Successfully.</div>';
		}
		else if($msg=="Deleted")
		{
		    echo '<div class="succ-msg">Translate Deleted Successfully</div>';		
		}
		
}
else
	$msg="";
?>
</div>
			
				<form class="form-large" action="translate_add.php" accept-charset="UTF-8" method="post">
		<input type="hidden" id="id" name="id" value="<?php echo $id;?>">

				<div class="col-lg-12 col-md-12 col-sm-12" >
					
					<ul class="nav nav-tabs">
					 <?php $activelang=mysqli_query($con, "select * from sv_language where lang_status='1' order by lang_id asc");
					 while($rowlang=mysqli_fetch_array($activelang)){?>
        <li class="<?php if($rowlang['lang_code']==$_GET['section']){?>active<?php } ?>">
		<?php if($rowlang['lang_code']!=$en){?><a href="translate.php?section=<?php echo $rowlang['lang_code'];?>"><?php } else { ?>
		<a><?php } ?>
		<img src="<?php echo $site_url; ?>admincp/img/<?php echo $rowlang['lang_flag'];?>" style="max-width:24px; max-height:24px;"> <span style="position:relative;top:2px;"><?php echo $rowlang['lang_name'];?></span></a></li>
					 <?php } ?>
		
       </ul>
	   
	   
	   
	   
	   
	   
	   
	   <div class="tab-content">
	   <div class="col-lg-6 col-md-6 col-sm-6 form-group">
	   
	   <?php $active_lang=mysqli_query($con, "select * from sv_translate where page_parent='0' and lang_code='$en' order by id asc");
					
					 while($row_lang=mysqli_fetch_array($active_lang)){?>
					
	   					
						<?php //echo $row_lang['id']; ?> <input type="text" id="eword[]" class="form-control" name="eword[]" value="<?php echo $row_lang['word']; ?>">						
						
				<br/>
				
					 
				
					 <?php } ?>
					 </div> 
	    <?php $checkrec=mysqli_num_rows(mysqli_query($con, "select * from sv_language where lang_status='1' order by lang_id asc"));
		if($checkrec>1)
		{
		?>
		
		
		
	   <div class="form-group col-lg-6 col-md-6 col-sm-6">
							 <?php $activelang_des=mysqli_query($con, "select * from sv_translate where lang_code='$en' order by id asc");
					 while($rowlang_des=mysqli_fetch_array($activelang_des)){
						 $langcode=$_GET['section'];
						 $pageparent=$rowlang_des['id'];
						 $viewsele=mysqli_fetch_array(mysqli_query($con, "select * from sv_translate where lang_code='$langcode' and page_parent='$pageparent'"));
						 
						 ?>
					
					
					 
					 
					 
        <div>
		 
                   <?php if($_GET['section']!=$en){?>
					 <input type="hidden" name="code" value="<?php echo $_GET['section'];?>">
					 <input type="hidden" name="parent[]" value="<?php echo $rowlang_des['id'];?>">
					 
					 
								
							<input type="text" id="sname[]"  class="form-control" name="sname[]" value="<?php echo $viewsele['word'];?>">												
					
				   <?php } ?>
				   <br/>
					 </div>
					
					
					
              
					 <?php } ?>
			  
				
			   </div>
		<?php } ?>
	   
	   
	   
	   </div>
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
					
				</div>				
			
				<div class="col-lg-12 col-md-12 col-sm-12">
					<button type="submit" class="btn btn-primary" onclick="">Update</button>
					
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

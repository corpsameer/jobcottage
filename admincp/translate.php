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

				
					<ul class="nav nav-tabs">
					 <?php $activelang=mysql_query("select * from sv_language where lang_status='1' order by lang_id asc");
					 while($rowlang=mysql_fetch_array($activelang)){?>
        <li class="<?php if($rowlang['lang_code']==$_GET['section']){?>active<?php } ?>">
		<?php if($rowlang['lang_code']!=$en){?><a href="translate.php?section=<?php echo $rowlang['lang_code'];?>"><?php } else { ?>
		<a><?php } ?>
		<img src="<?php echo $site_url; ?>admincp/img/<?php echo $rowlang['lang_flag'];?>" style="max-width:24px; max-height:24px;"> <span style="position:relative;top:2px;"><?php echo $rowlang['lang_name'];?></span></a></li>
					 <?php } ?>
		
       </ul>
	   
	   	   	<div class="col-md-8">
   
	   <?php $active_lang=mysql_query("select * from sv_translate where page_parent='0' and lang_code='$en' order by id asc");
					
					 while($row_lang=mysql_fetch_array($active_lang)){ ?>
	   					
						<div class="col-md-6">
							<?php highlight_string('<?php echo get_record(');?><?php echo $row_lang["id"].',';?><?php highlight_string('$lang,$en);?>');?>
						</div> 
						<div class="col-md-6">
							<input type="text" id="eword[]" class="form-control col-md-4" name="eword[]" value="<?php echo $row_lang['word']; ?>">						
						</div>
				
					 <?php } ?>
					 </div>
					
	    <?php $checkrec=mysql_num_rows(mysql_query("select * from sv_language where lang_status='1' order by lang_id asc"));
		if($checkrec>1)
		{
		?>
		
		
		
	   <div class="form-group col-lg-4 col-md-4 col-sm-4">
							 <?php $activelang_des=mysql_query("select * from sv_translate where lang_code='$en' order by id asc");
					 while($rowlang_des=mysql_fetch_array($activelang_des)){
						 $langcode=$_GET['section'];
						 $pageparent=$rowlang_des['id'];
						 $viewsele=mysql_fetch_array(mysql_query("select * from sv_translate where lang_code='$langcode' and page_parent='$pageparent'"));
						 
						 ?>
										 
        <div>
		 
                   <?php if($_GET['section']!=$en){?>
					 <input type="hidden" name="code" value="<?php echo $_GET['section'];?>">
					 <input type="hidden" name="parent[]" value="<?php echo $rowlang_des['id'];?>">
					 
					 
								
							<input type="text" id="sname[]"  class="form-control" name="sname[]" value="<?php echo $viewsele['word'];?>">												
					
				   <?php } ?>
								 </div>
					
					
					
              
					 <?php } ?>
			  
				
			   </div>
		<?php } ?>
	   
	   
	   
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

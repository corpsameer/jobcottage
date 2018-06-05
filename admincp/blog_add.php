<?php
include('../database/connection.php');
$type=$_REQUEST['typ'];
if($type=='add')
{
	$title=$_POST['title'];
	$desc=$_POST['desc'];
	
	//$randid=rand(100000000,9999999999);
	$randid=uniqid();
	
	
	 foreach($_POST['code'] as $index => $code)
		    {
				$pagename=$title[$index];
				$pagedesc=$desc[$index];
				$nrand=$randid[$index];
				
				if($code==$en)
			   {
				   $page_parent=0;
			   }
			   else
			   {
				   mysqli_query($con, "SET NAMES utf8");
		       mysqli_query($con, "SET CHARACTER SET utf8");
				    $checkwel=mysqli_query($con, "select * from sv_blog where rands_id='$randid' and page_parent='0'");
					
					$rowline=mysqli_fetch_array($checkwel);
					$checkrow=mysqli_num_rows($checkwel);
					$checkid=$rowline['id'];
					if($checkrow==0)
					{
				    $page_parent=mysqli_insert_id();
					}
					else
					{
						$page_parent=$checkid;
					}
				  
			   }
			   
				mysqli_query($con, "SET NAMES utf8");
		       mysqli_query($con, "SET CHARACTER SET utf8");
				mysqli_query($con, "insert into sv_blog(title,description,lang_code,page_parent,rands_id)values('$pagename','$pagedesc','$code','$page_parent','$randid')");
				
			   
			}
	
	
	
		$msg="Inserted";				
		header("Location:blog.php?msg=".$msg);
}
else if($type=='update')
{
	$id=$_POST['id'];	
	$res=mysqli_query($con, "select * from sv_blog where id='$id'");
	$fet=mysqli_fetch_array($res);
	$title=$_POST['title'];
	$desc=$_POST['desc'];	
	
	foreach($_POST['code'] as $index => $code)
		{
		$pagename=$title[$index];
		$pagedesc=$desc[$index];
			if($code==$en)
			{
				mysqli_query($con, "SET NAMES utf8");
		       mysqli_query($con, "SET CHARACTER SET utf8");
				mysqli_query($con, "update sv_blog set title='$pagename', description='$pagedesc',lang_code='$en' where id='$id'");
			}
			else
			{
				
				
				
				$numqry=mysqli_query($con, "select * from sv_blog where lang_code='$code' and page_parent='$id'");
				
				$numrows=mysqli_num_rows($numqry);
				
				if($numrows==0)
				{
					mysqli_query($con, "SET NAMES utf8");
		            mysqli_query($con, "SET CHARACTER SET utf8");
					mysqli_query($con, "insert into sv_blog (title,description,lang_code,page_parent) values ('$pagename','$pagedesc','$code','$id')");
				}
				if($numrows==1)
				{
					mysqli_query($con, "SET NAMES utf8");
		            mysqli_query($con, "SET CHARACTER SET utf8");
					mysqli_query($con, "update sv_blog set title='$pagename',description='$pagedesc' where page_parent='$id' and lang_code='$code'");
				}
				
				
				
			
			}
		
		}
		
	
	
		$msg="Updated";		
	header("Location:blog.php?msg=".$msg);			
}	
if($_REQUEST['type']=='delete')
{
	$hid=mysqli_real_escape_string($con, $_REQUEST["hid"]);
    mysqli_query($con, "delete from sv_blog where id='$hid'");
	mysqli_query($con, "delete from sv_blog where page_parent='$hid'");
		$msg="Deleted";	
		header("Location:blog.php?msg=".$msg);	
	
	
}

?>
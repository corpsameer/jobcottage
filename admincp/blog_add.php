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
				   mysql_query("SET NAMES utf8");
		       mysql_query("SET CHARACTER SET utf8");
				    $checkwel=mysql_query("select * from sv_blog where rands_id='$randid' and page_parent='0'");
					
					$rowline=mysql_fetch_array($checkwel);
					$checkrow=mysql_num_rows($checkwel);
					$checkid=$rowline['id'];
					if($checkrow==0)
					{
				    $page_parent=mysql_insert_id();
					}
					else
					{
						$page_parent=$checkid;
					}
				  
			   }
			   
				mysql_query("SET NAMES utf8");
		       mysql_query("SET CHARACTER SET utf8");
				mysql_query("insert into sv_blog(title,description,lang_code,page_parent,rands_id)values('$pagename','$pagedesc','$code','$page_parent','$randid')");
				
			   
			}
	
	
	
		$msg="Inserted";				
		header("Location:blog.php?msg=".$msg);
}
else if($type=='update')
{
	$id=$_POST['id'];	
	$res=mysql_query("select * from sv_blog where id='$id'");
	$fet=mysql_fetch_array($res);
	$title=$_POST['title'];
	$desc=$_POST['desc'];	
	
	foreach($_POST['code'] as $index => $code)
		{
		$pagename=$title[$index];
		$pagedesc=$desc[$index];
			if($code==$en)
			{
				mysql_query("SET NAMES utf8");
		       mysql_query("SET CHARACTER SET utf8");
				mysql_query("update sv_blog set title='$pagename', description='$pagedesc',lang_code='$en' where id='$id'");
			}
			else
			{
				
				
				
				$numqry=mysql_query("select * from sv_blog where lang_code='$code' and page_parent='$id'");
				
				$numrows=mysql_num_rows($numqry);
				
				if($numrows==0)
				{
					mysql_query("SET NAMES utf8");
		            mysql_query("SET CHARACTER SET utf8");
					mysql_query("insert into sv_blog (title,description,lang_code,page_parent) values ('$pagename','$pagedesc','$code','$id')");
				}
				if($numrows==1)
				{
					mysql_query("SET NAMES utf8");
		            mysql_query("SET CHARACTER SET utf8");
					mysql_query("update sv_blog set title='$pagename',description='$pagedesc' where page_parent='$id' and lang_code='$code'");
				}
				
				
				
			
			}
		
		}
		
	
	
		$msg="Updated";		
	header("Location:blog.php?msg=".$msg);			
}	
if($_REQUEST['type']=='delete')
{
	$hid=mysql_real_escape_string($_REQUEST["hid"]);
    mysql_query("delete from sv_blog where id='$hid'");
	mysql_query("delete from sv_blog where page_parent='$hid'");
		$msg="Deleted";	
		header("Location:blog.php?msg=".$msg);	
	
	
}

?>
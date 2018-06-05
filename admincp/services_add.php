<?php
ob_start();
include('../database/connection.php');
mysql_query("SET NAMES utf8");
mysql_query("SET CHARACTER SET utf8");


//$type=mysql_real_escape_string($_REQUEST['action']);
$type=$_REQUEST['typ'];
if($type=='add')
{
	$sname=$_POST['sname'];
	$file_name = $_FILES['service_img']['name'];	
	if($file_name=="")
	{
		echo "select-img";
			header("Location:services.php?msg="."select-img");
	}
	else if($file_name!="")
	{
		$allowed =  array('jpeg','png' ,'jpg');	
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed)) 
		{
			echo "imgerr";
				header("Location:services.php?msg="."imgerr");
		}
		else if($_FILES['service_img']['size'] > 1048576)
		{
			echo "size-err";
			header("Location:services.php?msg="."size-err");
		}
		else {
			$random_digit=rand(0000,9999);
			if($file_name!="")
			{		
				$file_name= $random_digit.$file_name;
				$path= "img/" .$file_name;
				move_uploaded_file($_FILES['service_img']["tmp_name"],$path);
			}
			else 
				$file_name="";	
           			
					
	        foreach($_POST['code'] as $index => $code)
		    {
				$pagename=$sname[$index];
				
				if($code==$en)
			   {
				   $page_parent=0;
			   }
			   else
			   {
				    $checkwel=mysql_query("select * from sv_services where service_img='$file_name' and page_parent='0'");
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
				mysql_query("insert into sv_services(services_name,service_img,lang_code,page_parent)values('$pagename','$file_name','$code','$page_parent')");
				
			   
			}
			
			
				$msg="Inserted";				
				header("Location:services.php?msg=".$msg);
		}
	}
}
else if($type=='update')
{
	$flag=0;
	$id=$_POST['id'];	
	$res=mysql_query("select * from sv_services where id='$id'");
	$fet=mysql_fetch_array($res);
	$old_file="img/".$fet['service_img'];
	$file_name = $_FILES['service_img']['name'];
	$random_digit=rand(0000,9999);
	
	if($file_name!="")
	{		
		$file_name= $random_digit.$file_name;
 		$path= "img/" .$file_name;
		$allowed =  array('jpeg','png' ,'jpg');	
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed)) 
		{
			$flag="1";
			$msg1="error1";					
		}
		else if($_FILES['service_img']['size'] > 1048576)
		{
			$flag="1";
			$msg1="error2";					
		}	
		else {
		move_uploaded_file($_FILES['service_img']["tmp_name"],$path);
		if (file_exists($old_file))
		{
   	 		unlink($old_file);
		} }
	}
	else 
	{
		$old_file=mysql_real_escape_string($fet['service_img']);
		$file_name=mysql_real_escape_string($_REQUEST['old_simage']);
	}
	
	$sname=$_POST['sname'];
	if($flag=="0")
	{
		
		foreach($_POST['code'] as $index => $code)
		{
		$pagename=$sname[$index];
			if($code==$en)
			{
				mysql_query("SET NAMES utf8");
		       mysql_query("SET CHARACTER SET utf8");
				mysql_query("update sv_services set services_name='$pagename', service_img='$file_name',lang_code='$en' where id='$id'");
			}
			else
			{
				
				
				
				$numqry=mysql_query("select * from sv_services where lang_code='$code' and page_parent='$id'");
				
				$numrows=mysql_num_rows($numqry);
				
				if($numrows==0)
				{
					mysql_query("SET NAMES utf8");
		            mysql_query("SET CHARACTER SET utf8");
					mysql_query("insert into sv_services (services_name,service_img,lang_code,page_parent) values ('$pagename','$file_name','$code','$id')");
				}
				if($numrows==1)
				{
					mysql_query("SET NAMES utf8");
		            mysql_query("SET CHARACTER SET utf8");
					mysql_query("update sv_services set services_name='$pagename',service_img='$file_name' where page_parent='$id' and lang_code='$code'");
				}
				
				
				
			
			}
		
		}
		
		
		
		
			$msg="Updated";		
		header("Location:services.php?msg=".$msg);	
	}
	else {
		$error="";
		if($flag=="1") 
		{
			if($msg1=="error1") 
				$error="imgerr";
			else if($msg1=="error2")
				$error="size-err";	
		}
		header("Location:services.php?msg=".$error);	
	}
}	
if($_REQUEST['type']=='delete')
{
	$hid=mysql_real_escape_string($_REQUEST["hid"]);
    unlink('img/'.$_REQUEST['simage']);	
	mysql_query("delete from sv_services where id='$hid'");
	mysql_query("delete from sv_services where page_parent='$hid'");
		$msg="Deleted";	
		header("Location:services.php?msg=".$msg);	
		
}

?>
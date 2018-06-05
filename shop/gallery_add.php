<?php
ob_start();
include('../database/connection.php');
$type=$_REQUEST['typ'];
if($type=='add')
{
	$shopid=$_POST['shopid'];
	$file_name = $_FILES['gallery']['name'];	
	if($file_name=="")
	{
		echo "select-img";
			header("Location:gallery.php?msg="."select-img");
	}
	else if($file_name!="")
	{
		$allowed =  array('jpeg','png' ,'jpg');	
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed)) 
		{
			echo "imgerr";
				header("Location:gallery.php?msg="."imgerr");
		}
		else if($_FILES['gallery']['size'] > 1048576)
		{
			echo "size-err";
			header("Location:gallery.php?msg="."size-err");
		}
		else {
			$random_digit=rand(0000,9999);
			if($file_name!="")
			{		
				$file_name= $random_digit.$file_name;
				$path= "shop-img/" .$file_name;
				move_uploaded_file($_FILES['gallery']["tmp_name"],$path);
			}
			else 
				$file_name="";		
			mysql_query("insert into sv_shop_gallery(shop_id,image)values('$shopid','$file_name')");
				$msg="Inserted";				
				header("Location:gallery.php?msg=".$msg);
		}
	}
}
else if($type=='update')
{
	$flag=0;
	$id=$_POST['id'];	
	$res=mysql_query("select * from sv_shop_gallery where id='$id'");
	$fet=mysql_fetch_array($res);
	$old_file="shop-img/".$fet['image'];
	$file_name = $_FILES['gallery']['name'];
	$random_digit=rand(0000,9999);
	
	if($file_name!="")
	{		
		$file_name= $random_digit.$file_name;
 		$path= "shop-img/" .$file_name;
		$allowed =  array('jpeg','png' ,'jpg');	
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed)) 
		{
			$flag="1";
			$msg1="error1";					
		}
		else if($_FILES['gallery']['size'] > 1048576)
		{
			$flag="1";
			$msg1="error2";					
		}	
		else {
		move_uploaded_file($_FILES['gallery']["tmp_name"],$path);
		if (file_exists($old_file))
		{
   	 		unlink($old_file);
		} }
	}
	else 
	{
		$old_file=mysql_real_escape_string($fet['gallery']);
		$file_name=mysql_real_escape_string($_REQUEST['old_image']);
	}
	
	$shopid=$_POST['shopid'];
	if($flag=="0")
	{
		mysql_query("update sv_shop_gallery set shop_id='$shopid',image='$file_name' where id='$id'");
			$msg="Updated";		
		header("Location:gallery.php?msg=".$msg);	
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
		header("Location:gallery.php?msg=".$error);	
	}
}	
else if($_REQUEST['type']=='delete')
{
	$hid=mysql_real_escape_string($_REQUEST["hid"]);
    unlink("shop-img/".$_REQUEST['simage']);
	if(mysql_query("delete from sv_shop_gallery where id='$hid'")) 
		
	$msg="Deleted";		
		header("Location:gallery.php?msg=".$msg);
	
	
	
}

?>
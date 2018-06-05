<?php
ob_start();
include('../database/connection.php');
//$type=mysql_real_escape_string($_REQUEST['action']);
$type=$_REQUEST['typ'];
if($type=='add')
{
	$name=$_POST['name'];
	$code=$_POST['code'];
	$file_name = $_FILES['flag_img']['name'];	
	if($file_name=="")
	{
		echo "select-img";
			header("Location:language.php?msg="."select-img");
	}
	else if($file_name!="")
	{
		$allowed =  array('jpeg','png' ,'jpg');	
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed)) 
		{
			echo "imgerr";
				header("Location:language.php?msg="."imgerr");
		}
		else if($_FILES['flag_img']['size'] > 1048576)
		{
			echo "size-err";
			header("Location:language.php?msg="."size-err");
		}
		else {
			$random_digit=rand(0000,9999);
			if($file_name!="")
			{		
				$file_name= $random_digit.$file_name;
				$path= "img/" .$file_name;
				move_uploaded_file($_FILES['flag_img']["tmp_name"],$path);
			}
			else 
				$file_name="";		
	
			mysql_query("insert into sv_language(lang_name,lang_code,lang_flag)values('$name','$code','$file_name')");
				$msg="Inserted";				
				header("Location:language.php?msg=".$msg);
		}
	}
}
else if($type=='update')
{
	$flag=0;
	$id=$_POST['id'];	
	$res=mysql_query("select * from sv_language where lang_id='$id'");
	$fet=mysql_fetch_array($res);
	$old_file="img/".$fet['lang_flag'];
	$file_name = $_FILES['flag_img']['name'];
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
		else if($_FILES['flag_img']['size'] > 1048576)
		{
			$flag="1";
			$msg1="error2";					
		}	
		else {
		move_uploaded_file($_FILES['flag_img']["tmp_name"],$path);
		if (file_exists($old_file))
		{
   	 		unlink($old_file);
		} }
	}
	else 
	{
		$old_file=mysql_real_escape_string($fet['flag_img']);
		$file_name=mysql_real_escape_string($_REQUEST['old_flag']);
	}
	
	$name=$_POST['name'];
	$code=$_POST['code'];
	if($flag=="0")
	{
		mysql_query("update sv_language set lang_name='$name',lang_code='$code',lang_flag='$file_name' where lang_id='$id'");
			$msg="Updated";		
		header("Location:language.php?msg=".$msg);	
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
		header("Location:language.php?msg=".$error);	
	}
}	
if($_REQUEST['type']=='delete')
{
	$flag=$_REQUEST['flag'];
	unlink("img/" .$flag);
	
	$hid=mysql_real_escape_string($_REQUEST["lang_id"]);
    $lang_codes=$_REQUEST['lang_code'];
	mysql_query("delete from sv_translate where lang_code='$lang_codes'");
	mysql_query("delete from sv_pages where lang_code='$lang_codes'");
	mysql_query("delete from sv_services where lang_code='$lang_codes'");
	mysql_query("delete from sv_testimonials where lang_code='$lang_codes'");
	mysql_query("delete from sv_blog where lang_code='$lang_codes'");
	mysql_query("delete from sv_language where lang_id='$hid' and lang_id!='1'"); 
		$error="Deleted";
	
	header("Location:language.php?msg=".$error);
	
}

?>
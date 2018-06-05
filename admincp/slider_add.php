<?php
ob_start();
include('../database/connection.php');
//$type=mysql_real_escape_string($_REQUEST['action']);
$type=$_REQUEST['typ'];
if($type=='add')
{
	$file_name = $_FILES['slider_img']['name'];	
	if($file_name=="")
	{
		echo "select-img";
			header("Location:home-slider.php?msg="."select-img");
	}
	else if($file_name!="")
	{
		$allowed =  array('jpeg','png' ,'jpg');	
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed)) 
		{
			echo "imgerr";
				header("Location:home-slider.php?msg="."imgerr");
		}
		else if($_FILES['slider_img']['size'] > 1048576)
		{
			echo "size-err";
			header("Location:home-slider.php?msg="."size-err");
		}
		else {
			$random_digit=rand(0000,9999);
			if($file_name!="")
			{		
				$file_name= $random_digit.$file_name;
				$path= "../slider-img/" .$file_name;
				move_uploaded_file($_FILES['slider_img']["tmp_name"],$path);
			}
			else 
				$file_name="";	
  mysql_query("insert into sv_slider(slider_img)values('$file_name')");
	$msg="Inserted";				
			header("Location:home-slider.php?msg=".$msg);
}

}
}
else if($type=='update')
{
	$flag=0;
	$id=$_POST['id'];
	$res=mysql_query("select * from sv_slider where id='$id'");
	$fet=mysql_fetch_array($res);
	$old_file="../slider-img/".$fet['slider_img'];
	$file_name = $_FILES['slider_img']['name'];
	$random_digit=rand(0000,9999);
	
	if($file_name!="")
	{		
		$file_name= $random_digit.$file_name;
 		$path= "../slider-img/" .$file_name;
		$allowed =  array('jpeg','png' ,'jpg');	
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed)) 
		{
			$flag="1";
			$msg1="error1";					
		}
		else if($_FILES['slider_img']['size'] > 1048576)
		{
			$flag="1";
			$msg1="error2";					
		}	
		else {
		move_uploaded_file($_FILES['slider_img']["tmp_name"],$path);
		if (file_exists($old_file))
		{
   	 		unlink($old_file);
		} }
	}
	else 
	{
		$old_file=mysql_real_escape_string($fet['slider_img']);
		$file_name=mysql_real_escape_string($old_file);
	}
	if($flag=="0")
	{		
		mysql_query("update sv_slider set slider_img='$file_name' where id='$id'");
			$msg="Updated";		
		header("Location:home-slider.php?msg=".$msg);	
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
		header("Location:home-slider.php?msg=".$error);	
	}
}

else if($type=='delete')
{
	$hid=mysql_real_escape_string($_REQUEST["hid"]);		
	if(mysql_query("delete from sv_slider where id='$hid'")) 
		echo "Deleted";
	else 
		echo "Error";
}

?>
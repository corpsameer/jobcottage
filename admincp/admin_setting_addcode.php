<?php
ob_start();
include('../database/connection.php');
@session_start();
$dat=mysql_real_escape_string(date('Y-m-d H:i:s'));
$email_id=mysql_real_escape_string($_POST['email_id']);
$admin_name=mysql_real_escape_string($_POST['admin_name']);
$site_name=mysql_real_escape_string($_POST['site_name']);
$site_desc=mysql_real_escape_string($_POST['site_desc']);
$keyword=mysql_real_escape_string($_POST['keyword']);
$site_url=mysql_real_escape_string($_POST['site_url']);

$smtp_host=mysql_real_escape_string($_POST['smtp_host']);
$smtp_uname=mysql_real_escape_string($_POST['smtp_uname']);
$smtp_pwd=mysql_real_escape_string($_POST['smtp_pwd']);
$smtp_port=mysql_real_escape_string($_POST['smtp_port']);
$mail_option=mysql_real_escape_string($_POST['mail_option']);
$cmode=mysql_real_escape_string($_POST['cmode']);

$salt_id = mysql_real_escape_string($_POST['salt_id']);
$merchant_id = mysql_real_escape_string($_POST['merchant_id']);
$payu_mode = mysql_real_escape_string($_POST['payu_mode']);


$paypal_id=mysql_real_escape_string($_POST['paypal_id']);
$smode=mysql_real_escape_string($_POST['smode']);
$withdraw_amt=mysql_real_escape_string($_POST['withdraw_amt']);

$stripe_mode=mysql_real_escape_string($_POST['stripe_mode']);
$test_publish_key=mysql_real_escape_string($_POST['test_publish_key']);
$test_secret_key=mysql_real_escape_string($_POST['test_secret_key']);
$live_publish_key=mysql_real_escape_string($_POST['live_publish_key']);
$live_secret_key=mysql_real_escape_string($_POST['live_secret_key']);				
				
				
				




$commission_mode=mysql_real_escape_string($_POST['commission_mode']);
$commission_amt=mysql_real_escape_string($_POST['commission_amt']);

$choose_language=$_POST['choose_language'];


//$withdraw_option=mysql_real_escape_string($_POST['withdraw_option']);

$religion=$_POST['langOpt'];   
    $serializedoptions1 = serialize($religion);
    $serializedoptions123 = unserialize($serializedoptions1);
	
	$paymentopt = $_POST['paymentopt'];
	$serialze = serialize($paymentopt);
	$serialize_option = unserialize($serialze);
	
    foreach($religion as $key=>$val){
    echo $val;  }	
	
$res=mysql_query("select * from sv_admin_login");
$row=mysql_num_rows($res);
$fet=mysql_fetch_array($res);
$id=mysql_real_escape_string($fet['id']);
$old_file="img/".$fet['logo'];
$old_file1="img/".$fet['favicon'];

$file_name = $_FILES['logo']['name'];
$file_name1 = $_FILES['favicon']['name'];
$flag1=0;
$flag2=0;
//Logo checking condition
if($file_name!="")
{
	$allowed =  array('jpeg','png' ,'jpg');	
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	if(!in_array($ext,$allowed)) 
	{
		$flag1="1";
		$msg1="error1";
	}
	else if($_FILES['logo']['size'] > 1048576)
	{
		$flag1="1";
		$msg1="error2";
	}	
}
// favicon check condition
if($file_name1!="")
{		
		$allowed =  array('jpeg','png' ,'jpg','ico');	
		$ext = pathinfo($file_name1, PATHINFO_EXTENSION);
		if(!in_array($ext,$allowed)) 
		{
			$flag2="1";
			$msg2="error1";
		}
		else if($_FILES['favicon']['size'] > 1048576)
		{
			$flag2="1";
			$msg2="error2";
		}	
}	
//condition statisify if start
if($flag1=="0" && $flag2=="0")
{
	if($file_name!="")
	{
		$random_digit1=rand(0000,9999);
		$file_name= $random_digit1.$file_name;
 		$path= "img/" .$file_name;
		move_uploaded_file($_FILES['logo']["tmp_name"],$path);
		if (file_exists($old_file))
		{
   		 	unlink($old_file);
		}
	}
	else
	{
		$old_file=mysql_real_escape_string($fet['logo']);
		$file_name=mysql_real_escape_string($old_file);
	}		
	if($file_name1!="")
	{
		$random_digit1=rand(0000,9999);
		$file_name1= $random_digit1.$file_name1;
 		$path= "img/" .$file_name1;
		move_uploaded_file($_FILES['favicon']["tmp_name"],$path);
		if (file_exists($old_file1))
		{
   		 	unlink($old_file1);
		}
	}
	else
	{
		$old_file1=mysql_real_escape_string($fet['favicon']);
		$file_name1=mysql_real_escape_string($old_file1);
	}		
	if($row=="0")
	{
		if(mysql_query("insert into sv_admin_login(email_id,user_name,site_name,logo,site_desc,keyword,favicon,site_url,smtp_host,smtp_uname,smtp_pwd,
		smtp_port,mail_option,currency_mode,paypal_id,paypal_site_mode,payu_mode,merchant_id,salt_id,stripe_mode,live_publish_key,live_secret_key,
		test_publish_key,test_secret_key,withdraw_amt,payment_option,withdraw_option,commission_mode,commission_amt)values('$email_id',
		'$admin_name','$site_name','$file_name','$site_desc','$keyword','$file_name1','$site_url','$smtp_host','$smtp_uname','$smtp_pwd',
		'$smtp_port','$mail_option','$cmode','$paypal_id','$smode','$payu_mode','$merchant_id','$salt_id','$stripe_mode','$live_publish_key','$live_secret_key',
		'$test_publish_key','$test_secret_key','$withdraw_amt','".implode(',', $serialize_option)."','".implode(',',$serializedoptions123)."','$commission_mode',
		'$commission_amt')"))
		{
			$msg="Inserted";
			header("Location:setting.php?msg=".$msg);			
		}			
	}
	else
	{	
		if(mysql_query("update sv_admin_login set email_id='$email_id',user_name='$admin_name',site_name='$site_name',logo='$file_name',
		site_desc='$site_desc',keyword='$keyword',favicon='$file_name1',site_url='$site_url',smtp_host='$smtp_host',smtp_uname='$smtp_uname',
		smtp_pwd='$smtp_pwd',smtp_port='$smtp_port',mail_option='$mail_option',currency_mode='$cmode',paypal_id='$paypal_id',
		paypal_site_mode='$smode',payu_mode='$payu_mode',merchant_id='$merchant_id',salt_id='$salt_id',
		stripe_mode='$stripe_mode',live_publish_key='$live_publish_key',live_secret_key='$live_secret_key',test_publish_key='$test_publish_key',
		test_secret_key='$test_secret_key',withdraw_amt='$withdraw_amt',
		payment_option='".implode(',',$serialize_option)."',withdraw_option='".implode(',',$serializedoptions123)."',
		commission_mode='$commission_mode',commission_amt='$commission_amt' where id='$id'")) 
		{
			$msg="Updated";
			header("Location:setting.php?msg=".$msg);
		}		
	}
}
//if end		
else
{
	$error="";
	if($flag1=="1" && $flag2=="1") //both logo and icon error check
	{
		if($msg1=="error1" && $msg2=="error1") 
			$error="error";//it is display logo and icon are not jpg, png,
		else if($msg1=="error2" && $msg2=="error2")
			$error="error1";//it is display for both logo and icon are maximum 1 MB
		else if($msg1=="error1" && $msg2=="error2")
			$error="error2";//it is display for logo is not jpg, and icon is maximum 1 MB
		else if($msg1=="error2" && $msg2=="error1")
			$error="error3"; //it is display for logo is maximum 1 mb and icon is not jpg are png
	}
	if($flag1=="1" && $flag2=="0")//logo check
	{
		if($msg1=="error1")
			$error="error4"; // in this error display only logo is not png or jpg.
		else if($msg1=="error2")
			$error="error5"; // in this error display only logo is maximum 1 mb.				
	}
	else if($flag1=="0" && $flag2=="1") // icon check
	{
		if($msg2=="error1")
			$error="error6"; // in this error display only icon is not png or jpg.
		else if($msg2=="error2")
			$error="error7"; // in this error display only lcon is maximum 1 mb.		
	}		
	header("Location:setting.php?msg=".$error);	
}



if(isset($choose_language))
{
   mysql_query("update sv_language set lang_status='0' where lang_id!=''");	
  foreach($choose_language as $language)
  {  
      
	  mysql_query("update sv_language set lang_status='1' where lang_id='$language'");
	 
	  
  }	  
  //$msg="Updated";
  //header("Location:setting.php?msg=".$msg);
}
?>
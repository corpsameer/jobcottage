<?php
date_default_timezone_set('America/New_York');
$demo_mode="off";
	$con=mysql_connect("mysql.gynesus.com","gynesusit","byGod1919!!");  //******** update your mysql username and password
	if(!$con)
		die('Could not connect: ' . mysql_error());
	mysql_select_db("jobcottage",$con);   //************ update database name here
	
	$res=mysql_fetch_array(mysql_query("select * from sv_admin_login"));        
    $admin_email=mysql_real_escape_string($res['email_id']);
    $site_name=mysql_real_escape_string($res['site_name']);
	$logo1 = mysql_real_escape_string($res['logo']);
	if($logo1=="")
	{
		$logo=$res['site_url'] . "admincp/img/default-logo.png"; 
	}
	else
	{
		$logo=$res['site_url'] . "admincp/img/$logo1"; 
	}
    $favicon=mysql_real_escape_string($res['favicon']);
    $site_desc=mysql_real_escape_string($res['site_desc']);
    $keyword=mysql_real_escape_string($res['keyword']);
    $site_url=mysql_real_escape_string($res['site_url']);	
    $mail_option=mysql_real_escape_string($res['mail_option']);	
	$smtp_host=mysql_real_escape_string($res['smtp_host']);		
	$smtp_uname=mysql_real_escape_string($res['smtp_uname']);
	$smtp_pwd=mysql_real_escape_string($res['smtp_pwd']);
	$smtp_port=mysql_real_escape_string($res['smtp_port']);
	$currency_mode=mysql_real_escape_string($res['currency_mode']);
	$admin_withdraw_amt=mysql_real_escape_string($res['withdraw_amt']);
	
	$commission_mode=mysql_real_escape_string($res['commission_mode']);
	$commission_amt=mysql_real_escape_string($res['commission_amt']);
	

	mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $con);
	
	$en="en";
	
	
	
	

?>

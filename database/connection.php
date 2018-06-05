<?php
date_default_timezone_set('America/New_York');
$demo_mode="off";
	//$con=mysqli_connect("mysql.gynesus.com","gynesusit","byGod1919!!");  //******** update your mysql username and password
	$con=mysqli_connect("localhost","root","");
	if(!$con)
		die('Could not connect: ' . mysqli_error());
	mysqli_select_db($con,"jobcottage");   //************ update database name here

	$res=mysqli_fetch_array(mysqli_query($con,"select * from sv_admin_login"));
    $admin_email=mysqli_real_escape_string($con, $res['email_id']);
    $site_name=mysqli_real_escape_string($con, $res['site_name']);
	$logo1 = mysqli_real_escape_string($con, $res['logo']);
	if($logo1=="")
	{
		$logo=$res['site_url'] . "admincp/img/default-logo.png";
	}
	else
	{
		$logo=$res['site_url'] . "admincp/img/$logo1";
	}
    $favicon=mysqli_real_escape_string($con, $res['favicon']);
    $site_desc=mysqli_real_escape_string($con, $res['site_desc']);
    $keyword=mysqli_real_escape_string($con, $res['keyword']);
    $site_url=mysqli_real_escape_string($con, $res['site_url']);
    $mail_option=mysqli_real_escape_string($con, $res['mail_option']);
	$smtp_host=mysqli_real_escape_string($con, $res['smtp_host']);
	$smtp_uname=mysqli_real_escape_string($con, $res['smtp_uname']);
	$smtp_pwd=mysqli_real_escape_string($con, $res['smtp_pwd']);
	$smtp_port=mysqli_real_escape_string($con, $res['smtp_port']);
	$currency_mode=mysqli_real_escape_string($con, $res['currency_mode']);
	$admin_withdraw_amt=mysqli_real_escape_string($con, $res['withdraw_amt']);

	$commission_mode=mysqli_real_escape_string($con, $res['commission_mode']);
	$commission_amt=mysqli_real_escape_string($con, $res['commission_amt']);


	mysqli_query($con, "SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'");

	$en="en";





?>

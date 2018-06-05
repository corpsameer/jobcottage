<?php		
	include("../database/connection.php");	
	@session_start();
	require("../smtp/class.phpmailer.php");
	$user = mysql_real_escape_string($_REQUEST['user']);
	$result=mysql_query("select * from sv_admin_login where user_name = '$user'");
	$row = mysql_fetch_array($result);
	$email_id=mysql_real_escape_string($row['email_id']);
	$rowcount = mysql_num_rows($result);
	//email id not match then.
	if ($rowcount== 0)
	{
     echo "Invalid User";
	}	
	/*Checking start*/
	else
	{			
					//set the random id length 
					$random_id_length = 8;
					//generate a random id encrypt it and store it in $rnd_id 
					$rnd_id = crypt(uniqid(rand(),1));
					//to remove any slashes that might have come 
					$rnd_id = strip_tags(stripslashes($rnd_id));
					//Removing any . or / and reversing the string 
					$rnd_id = str_replace(".","",$rnd_id); 
					$rnd_id = strrev(str_replace("/","",$rnd_id));
					//finally I take the first 8 characters from the $rnd_id 
					$rnd_id = substr($rnd_id,0,$random_id_length);
					$pas=md5($rnd_id);
					if(mysql_query("update sv_admin_login set password='$pas' where user_name='$user'"))
					{
						if($email_id!='')
						{
								$subject = 'Password Details'; 
								$user_name = mysql_real_escape_string($user); 
								$randam_no = mysql_real_escape_string($rnd_id); 
								$message = '<!DOCTYPE HTML>'. 
								'<head>'. 
								'<meta http-equiv="content-type" content="text/html">'. 
								
							'</head>'. 
							'<body>'. 
							'<div id="header" style="width: 80%;height: 60px;margin: 0 auto;padding: 10px;color: #fff;text-align: center;background-color: #E0E0E0;font-family: Open Sans,Arial,sans-serif;">'. 
							'<img height="50" width="220" style="border-width:0" src="'.$logo.'" title="'.$site_name.'">'. 
							'</div>'. 

							'<div id="outer" style="width: 80%;margin: 0 auto;margin-top: 10px;">'.  
							'<div id="inner" style="width: 78%;margin: 0 auto;background-color: #fff;font-family: Open Sans,Arial,sans-serif;font-size: 13px;font-weight: normal;line-height: 1.4em;color: #444;margin-top: 10px;">'. 
							      '<p>'.$site_name.' - '.$subject.'</p>'.
					       '<p> User Name - '.$user_name.'</p>'. 
   					       '<p> Password - '.$randam_no.'</p>'. 
							'</div>'.   
						'</div>'. 

			'<div id="footer" style="width: 80%;height: 40px;margin: 0 auto;text-align: center;padding: 10px;font-family: Verdena;background-color: #E2E2E2;">'. 
						  'All rights reserved @ '.$site_name. 
					'</div>'. 
				'</body>'; 

			$to      = mysql_real_escape_string($email_id);             
			$subject = 'Account Details - '.$site_name;  
			$from    = mysql_real_escape_string($admin_email);                              

			$headers  = "From: " . $from . "\r\n"; 

			$headers .= "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
						
			if($mail_option=="smtp")
			{		
				$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host = $smtp_host;
			$mail->SMTPAuth = true;
			$mail->Username = $smtp_uname;  // SMTP username
			$mail->Password = $smtp_pwd; // SMTP password
			$mail->From =$from;
			$mail->FromName = $site_name;
			$mail->AddAddress($to);
		
			$mail->Subject = $subject;
			$mail->MsgHTML($message);
				$mail->Header='Content-type: text/html; charset=iso-8859-1';
				if($mail->Send())
				{  
					echo 'Mail Send';
				}
			}
			else 
			{	
				if(mail($to, $subject, $message, $headers)) 
				{ 
					echo 'Mail Send'; 
				} 
			}	
	}					
}
    								
	}		
?>
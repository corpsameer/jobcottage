var xmlHttp
xmlHttp=GetXmlHttpObject()

//Admin Login Function Start Here
function login(str)
{
	var msg="";
	var uname=document.getElementById("uname").value;
	var pwd=document.getElementById("pwd").value;
	if(uname=="" && pwd=="")
		msg="Enter User name and Password";
	else if(uname!="" && pwd=="")
		msg="Enter Password";
	else if(uname=="" && pwd!="")
		msg="Enter User Name";
	else
		msg="";		
	if(msg=="")
	{
		var url="login_code.php?uname="+uname+"&pwd="+pwd;
		xmlHttp.onreadystatechange=function()
 		{	   
			if(xmlHttp.readyState==4 && xmlHttp.status==200)
  			{
  				var msg=xmlHttp.responseText.trim();
  				if(msg=="welcome")
  					window.location="dashboard.php";
  				else
					document.getElementById("err_id").innerHTML=msg;
			}
		}
		xmlHttp.open("POST",url,true);
		xmlHttp.send(null);
	}
	else
		document.getElementById("err_id").innerHTML=msg;
}
//Forgot Password Start Here
function forgot()
{	
	var error="";
	var user=document.getElementById("user").value;
	if(user=="")
		document.getElementById("err_id").innerHTML="Enter User Name";
	else
	{
		document.getElementById("err_id").innerHTML="";
		var url="forget_password_code.php?user="+user;	
		xmlHttp.onreadystatechange=function()
		{		
			if(xmlHttp.readyState==4 && xmlHttp.status==200)
			{	
				var msg=xmlHttp.responseText.trim();
				window.location="forgot.php?msg="+msg;	
			}
		}
	}
	xmlHttp.open("POST",url,true);
	xmlHttp.send(null);
}
// Validation for current password
function currpass(str)
{
	 var error="";
    if(str.length==0)
    {
		error="* Enter Current Password";
	    document.getElementById("curpwd1").innerHTML="Enter Current Password";
    }
    else
		document.getElementById("curpwd1").innerHTML=""; 
	 return error;
}
function newpass(str)
{	
    var error="";
    if(str.length==0)
    {
		error="Enter New Password";
	    document.getElementById("newpwd1").innerHTML="Enter New Password";
    }
	
	 else
		document.getElementById("newpwd1").innerHTML=""; 
	 return error;
}
 //Validation for Match Password & Confirm Password
function conpass(str)
{
	var error="";
	if (str.length==0)
   {
		error="Enter Confirm Password";
    	document.getElementById("conpwd1").innerHTML="Enter Confirm Password";
	} 
	
	else
		document.getElementById("conpwd1").innerHTML="";
	return error;
}
function change_pass()
{
	var msg="";
	var curpwd=document.getElementById("curpwd").value;
	var newpwd=document.getElementById("newpwd").value;
	var conpwd=document.getElementById("conpwd").value;
	msg+=currpass(curpwd);
	msg+=newpass(newpwd);
	msg+=conpass(conpwd);
	if (newpwd != conpwd) 
	{
        alert("Passwords do not match.");
     }
	 else{
	if(msg=="")
	{
		var url="change_pwd_code.php?curpwd="+curpwd+"&newpwd="+newpwd+"&conpwd="+conpwd;
		xmlHttp.onreadystatechange=function () 
		{
			if (xmlHttp.readyState==4 && xmlHttp.status==200) 
			{
				var msg=xmlHttp.responseText.trim();
				if(msg=="success")
				{
					var msg="success";
					window.location="change_pwd.php?msg="+msg;				
				}
				else if(msg=="Invalid")
				{
					var msg="Invalid";
					document.getElementById("cur_pwd_err").innerHTML="Enter valid current password";
					//window.location="change_pwd.php?msg="+msg;	
				}
			}
		} 		
		xmlHttp.open("post",url,true);
		xmlHttp.send(null);
	}
	}
}

//Admin setting start here
function adminname(str)
{
	var error="";	
	if(str=="")
	{	
		var error="Enter User Name";		
		document.getElementById("admin_name_err").innerHTML=error;
	}	else {
		error="";
		document.getElementById("admin_name_err").innerHTML=""; }
return error;
 }
 function emailid(str)
{
	var error="";	
	if(str=="")
	{
		var error="Enter Email";
		document.getElementById("email_err").innerHTML="Enter Email";
	}	else {
		error="";
		document.getElementById("email_err").innerHTML=""; 	}
return error;
 }
 function sitename(str)
{
	var error="";	
	if(str=="")
	{
		var error="Enter Site Name";
		document.getElementById("site_name_err").innerHTML="Enter Site Name";
	} 	else {
		error="";
		document.getElementById("site_name_err").innerHTML=""; 	}
return error;
 }
 function sitedesc(str)
{
	var error="";	
	if(str=="")
	{
		var error="Enter Site Description";
		document.getElementById("site_desc_err").innerHTML="Enter Site Description";
	} else 	{
		error="";
		document.getElementById("site_desc_err").innerHTML=""; }
return error;
 }
 function sitekwd(str)
{
	var error="";	
	if(str=="")
	{
		var error="Enter Site Keyword";
		document.getElementById("site_kwd_err").innerHTML="Enter Site Keyword";
	} else 	{
		error="";
		document.getElementById("site_kwd_err").innerHTML=""; }
return error;
 }
 function siteurl(str)
{
	var error="";	
	if(str=="")
	{
		var error="Enter Site URL";
		document.getElementById("site_url_err").innerHTML="Enter Site URL";
	} else  {
		error="";
		document.getElementById("site_url_err").innerHTML=""; }
return error;
 }
 
 function admin_function()
{	
	var msg="";
	var admin_name=document.getElementById("admin_name").value;
	var email=document.getElementById("email_id").value;
	var site_name=document.getElementById("site_name").value;
	var site_desc=document.getElementById("site_desc").value;
	var site_kwd=document.getElementById("keyword").value;
	var site_url=document.getElementById("site_url").value;
	
	var smtp_host=document.getElementById("smtp_host").value;
	var smtp_uname=document.getElementById("smtp_uname").value;
	var smtp_pwd=document.getElementById("smtp_pwd").value;
	var smtp_port=document.getElementById("smtp_port").value;
	var mail_option=document.getElementById("mail_option").value;
	var cmode=document.getElementById("cmode").value;

	msg+=adminname(admin_name);
	msg+=emailid(email);
	msg+=sitename(site_name);
	msg+=sitedesc(site_desc);
	msg+=sitekwd(site_kwd);
	msg+=siteurl(site_url);	
	
	if(msg=="")
	{
		document.getElementById("admin_s").submit();
	}
}

/*-----------------slider delete function ------------------*/
function slider_del(str)
{
	var r=confirm("Do you want to Delete?");
	if(r==true)
	{
		var url="slider_add.php?hid="+str+"&typ=delete";
		xmlHttp.onreadystatechange=function()
		{   
			if(xmlHttp.readyState==4 && xmlHttp.status==200)
			{
				var msg=xmlHttp.responseText.trim();
				if(msg=="Deleted")
					{				
						var msg="Deleted";
						window.location="home-slider.php?msg="+msg;
					}
			}
		}
		xmlHttp.open("POST",url,true);
		xmlHttp.send(null);
	}
}

/*-----------------Testimonials delete function ------------------*/
function testi_del(str)
{
	var r=confirm("Do you want to Delete?");
	if(r==true)
	{
		var url="testimonials_add.php?hid="+str+"&typ=delete";
		xmlHttp.onreadystatechange=function()
		{   
			if(xmlHttp.readyState==4 && xmlHttp.status==200)
			{
				var msg=xmlHttp.responseText.trim();
				if(msg=="Deleted")
					{				
						var msg="Deleted";
						window.location="home-testimonials.php?msg="+msg;
					}
			}
		}
		xmlHttp.open("POST",url,true);
		xmlHttp.send(null);
	}
}
/*-----------------Services delete function ------------------*/
function services_del(str)
{
	var r=confirm("Do you want to Delete?");
	if(r==true)
	{
		var url="services_add.php?hid="+str+"&typ=delete";
		xmlHttp.onreadystatechange=function()
		{   
			if(xmlHttp.readyState==4 && xmlHttp.status==200)
			{
				var msg=xmlHttp.responseText.trim();
				if(msg=="Deleted")
					{				
						var msg="Deleted";
						window.location="services.php?msg="+msg;
					}
			}
		}
		xmlHttp.open("POST",url,true);
		xmlHttp.send(null);
	}
}
//Blog delete function
/*-----------------Services delete function ------------------*/
function blog_del(str)
{
	var r=confirm("Do you want to Delete?");
	if(r==true)
	{
		var url="blog_add.php?hid="+str+"&typ=delete";
		xmlHttp.onreadystatechange=function()
		{   
			if(xmlHttp.readyState==4 && xmlHttp.status==200)
			{
				var msg=xmlHttp.responseText.trim();
				if(msg=="Deleted")
					{				
						var msg="Deleted";
						window.location="blog.php?msg="+msg;
					}
			}
		}
		xmlHttp.open("POST",url,true);
		xmlHttp.send(null);
	}
}

//user delete function start here
function user_del(str)
{
	var r=confirm("Do you want to Delete?");
	if(r==true)
	{
		var url="user_add.php?hid="+str+"&typ=delete";
		xmlHttp.onreadystatechange=function()
		{   
			if(xmlHttp.readyState==4 && xmlHttp.status==200)
			{
				var msg=xmlHttp.responseText.trim();
				if(msg=="Deleted")
					{				
						var msg="Deleted";
						window.location="users.php?msg="+msg;
					}
			}
		}
		xmlHttp.open("POST",url,true);
		xmlHttp.send(null);
	}
}

//shop delete function start here
function shop_del(str)
{
	var r=confirm("Do you want to Delete?");
	if(r==true)
	{
		var url="shop_add.php?hid="+str+"&typ=delete";
		xmlHttp.onreadystatechange=function()
		{   
			if(xmlHttp.readyState==4 && xmlHttp.status==200)
			{
				var msg=xmlHttp.responseText.trim();
				if(msg=="Deleted")
					{				
						var msg="Deleted";
						window.location="shop.php?msg="+msg;
					}
			}
		}
		xmlHttp.open("POST",url,true);
		xmlHttp.send(null);
	}
}
//slider2 delete function start here
function slider2_del(str)
{
	var r=confirm("Do you want to Delete?");
	if(r==true)
	{
		var url="slider2_add.php?hid="+str+"&typ=delete";
		xmlHttp.onreadystatechange=function()
		{   
			if(xmlHttp.readyState==4 && xmlHttp.status==200)
			{
				var msg=xmlHttp.responseText.trim();
				if(msg=="Deleted")
					{				
						var msg="Deleted";
						window.location="slider2.php?msg="+msg;
					}
			}
		}
		xmlHttp.open("POST",url,true);
		xmlHttp.send(null);
	}
}
function payment_update(str)
{
	var r=confirm("Do you want to Update payment status?");
	if(r==true)
	{
		var url="payment_code.php?hid="+str+"&action=update";	
		xmlHttp.onreadystatechange=function()
		{   
			if(xmlHttp.readyState==4 && xmlHttp.status==200)
			{
				var msg=xmlHttp.responseText.trim();
				if(msg=="Updated")
					{				
						var msg="Updated";
						window.location="pending_withdraw.php?msg="+msg;
					}
			}
		}
		xmlHttp.open("POST",url,true);
		xmlHttp.send(null);
	}
}



function GetXmlHttpObject()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    var aVersions = [ "MSXML2.XMLHttp.5.0",
        "MSXML2.XMLHttp.4.0","MSXML2.XMLHttp.3.0",
        "MSXML2.XMLHttp","Msxm12.XMLHTTP","Microsoft.XMLHttp"];

    for (var i = 0; i < aVersions.length; i++) 
	 {
        try {
            var xmlHttp = new ActiveXObject(aVersions[i]);
            return xmlHttp;
            } 
		catch (oError) 
		   {
            //Do nothing
           }
    }
    }
  catch (e)
    {
    }
  }
  if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 
return xmlHttp;
}
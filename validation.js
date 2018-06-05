var xmlHttp
xmlHttp=GetXmlHttpObject()


/*-------------  Contact us start here -------------------*/
function contact(str)
{	
	var name=document.getElementById("name").value;
	var email=document.getElementById("email").value;
	var pho_no=document.getElementById("pho_no").value;	
	var msg=document.getElementById("msg").value;
	
	if(str=="add")
	{
		 var url="contact_add.php?name="+name+"&email="+email+"&pho_no="+pho_no+"&msg="+msg+"&action="+str;
		
	}
	xmlHttp.onreadystatechange=function()
 	        {	   
				if(xmlHttp.readyState==4 && xmlHttp.status==200)
  				{
  					var msg=xmlHttp.responseText.trim();
					if(msg=="success")
					{		
						
						var msg="Inserted";
						window.location="contact.php?msg="+msg;				
					}					
					else if(msg=="Error")
					{
						window.location="contact.php?msg="+msg;				
					}
				}
			}
			xmlHttp.open("POST",url,true);
			xmlHttp.send(null);
		
}	

//login function start here
function login(str)
{
	var msg="";
	var phone_no=document.getElementById("phone_no").value;
	var pwd=document.getElementById("password").value;		
	if(msg=="")
	{
		var url="login_code.php?phone_no="+phone_no+"&pwd="+pwd;
		xmlHttp.onreadystatechange=function()
 		{	   
			if(xmlHttp.readyState==4 && xmlHttp.status==200)
  			{
  				var msg=xmlHttp.responseText.trim();
				if(msg=="welcome")
  					window.location="dashboard.php";
				else if(msg=="Invalid")
				{
					window.location="login.php?msg="+msg;				
				} 				  				
			}
		}
		xmlHttp.open("POST",url,true);
		xmlHttp.send(null);
	}
	else
		document.getElementById("err_id").innerHTML=msg;
}
//Profile Edit Code start Here
function edit_profile(str)
{
	var name=document.getElementById("user_name").value;
	var pno=document.getElementById("phone_no").value;
	var email=document.getElementById("email").value;
	var gender=document.getElementById("gender").value;
	if(str=="add")
	{
		var url="editpro_add.php?name="+name+"&pno="+pno+"&email="+email+"&gender="+gender+"&action="+str;
		xmlHttp.onreadystatechange=function()
 	        {	   
				if(xmlHttp.readyState==4 && xmlHttp.status==200)
  				{
  					var msg=xmlHttp.responseText.trim();					
					if(msg=="Updated")
					{				
						var msg="Updated";
						window.location="dashboard.php?msg="+msg;				
					}		
					else if(msg=="Error")
					{
						window.location="dashboard.php?msg="+msg;				
					}
					/*else if(msg=="Exist")
					{
						document.getElementById("pno_err").innerHTML="Phone No Already Exist";
					}*/
				}
			}
			xmlHttp.open("POST",url,true);
			xmlHttp.send(null);		
	}		
	
}

//Change password start here
function change_pwd(str)
{
	var msg="";
	var curpwd=document.getElementById("cur_pwd").value;
	var newpwd=document.getElementById("new_pwd").value;
	var conpwd=document.getElementById("confirm_pwd").value;
	if (newpwd != conpwd) 
	{
        alert("Passwords do not match.");
     }
	else {
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
					var msg="Success";
					window.location="dashboard.php?msg="+msg;				
				}
				else if(msg=="Invalid")
				{
					window.location="dashboard.php?msg="+msg;				
				}
				else
				document.getElementById("err").innerHTML=msg;
			}
		} 		
		xmlHttp.open("post",url,true);
		xmlHttp.send(null);
	}
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
/* -----------forgot password code --------         */
function forgot()
{
	var msg="";	
	var pno=document.getElementById("pno").value;
if(msg=="")	
	{
		var url="forgot_pwd_code.php?pno="+pno;	
		xmlHttp.onreadystatechange=function()
		{		
			if(xmlHttp.readyState==4 && xmlHttp.status==200)
			{	
				var msg=xmlHttp.responseText.trim(); 
				if(msg=="Invalid")
					{				
						var msg="Invalid";
						window.location="forgot.php?msg="+msg;				
					}					
					else if(msg=="success")
					{
						window.location="forgot.php?msg="+msg;				
					}
			}
		}
	}
	xmlHttp.open("POST",url,true);
	xmlHttp.send(null);
}
/*------------------FILTER------------------*/

function filter_funct()
{
	var services=document.getElementById("langOpt");
	
	var values = [];	
	for (var i = 0; i < services.options.length; i++) 
	{
		if(services.options[i].selected) 
	  	{	  		
			values.push(services.options[i].value);
	   	}
	}
	var city=document.getElementById("city").value;
	var url="filter_code.php?services="+values+"&city="+city;
		xmlHttp.onreadystatechange=function()
		{		
			if(xmlHttp.readyState==4 && xmlHttp.status==200)
			{	
				var msg=xmlHttp.responseText.trim(); 
				if(msg=="")
				{
					document.getElementById("filter1").innerHTML = "";
					document.getElementById("filter_empty").style.display="block";
					document.getElementById("filter_empty").innerHTML="Shop not found";
				}
				else {
					document.getElementById("filter_empty").style.display="none";
					document.getElementById("filter_empty").innerHTML="";
					document.getElementById("filter1").innerHTML = "";
					document.getElementById("filter1").innerHTML=msg;
				}
		        
			}
		}
	
	xmlHttp.open("POST",url,true);
	xmlHttp.send(null);
}



/*-----------------gallery image delete function ------------------*/
function gallery_del(str)
{
	var r=confirm("Do you want to Delete?");
	if(r==true)
	{
		var url="gallery_add.php?hid="+str+"&typ=delete";
		xmlHttp.onreadystatechange=function()
		{   
			if(xmlHttp.readyState==4 && xmlHttp.status==200)
			{
				var msg=xmlHttp.responseText.trim();
				if(msg=="Deleted")
					{				
						var msg="Deleted";
						window.location="gallery.php?msg="+msg;
					}
			}
		}
		xmlHttp.open("POST",url,true);
		xmlHttp.send(null);
	}
}


function withdraw_check(str)
{	
	if(str=="paypal")
	{	
		document.getElementById("bank_info").style.display="none";
		document.getElementById("paypal_id").style.display="block";
		document.getElementById("payu_id").style.display="none";
		document.getElementById("stripe_id").style.display="none";
	}
	else if(str=="bank")
	{
		document.getElementById("paypal_id").style.display="none";
		document.getElementById("bank_info").style.display="block";
		document.getElementById("payu_id").style.display="none";
		document.getElementById("stripe_id").style.display="none";
	}
	else if(str=="payumoney")
	{
		
		document.getElementById("paypal_id").style.display="none";
		document.getElementById("bank_info").style.display="none";
		document.getElementById("payu_id").style.display="block";
		document.getElementById("stripe_id").style.display="none";
	}
	else if(str=="stripe")
	{
		
		document.getElementById("paypal_id").style.display="none";
		document.getElementById("bank_info").style.display="none";
		document.getElementById("payu_id").style.display="none";
		document.getElementById("stripe_id").style.display="block";
	}
	
	else
	{
		document.getElementById("paypal_id").style.display="none";
		document.getElementById("bank_info").style.display="none";
		document.getElementById("payu_id").style.display="none";
		document.getElementById("stripe_id").style.display="none";
	}
}
function paypal_err(str)
{
	var error="";
	if (str=="")
   {
		error="Enter Paypal ID";
    	document.getElementById("pid_err").innerHTML="Enter Paypal ID";
	} 
	
	else
		document.getElementById("pid_err").innerHTML="";
	return error;
}
function payu_err(str)
{
	var error="";
	if (str=="")
   {
		error="Enter Payumoney ID";
    	document.getElementById("zid_err").innerHTML="Enter Payumoney ID";
	} 
	
	else
		document.getElementById("zid_err").innerHTML="";
	return error;
}


function stripe_err(str)
{
	var error="";
	if (str=="")
   {
		error="Enter Stripe ID";
    	document.getElementById("yid_err").innerHTML="Enter Stripe ID";
	} 
	
	else
		document.getElementById("yid_err").innerHTML="";
	return error;
}



function bank_acc_no_err(str)
{
	var error="";
	if (str=="")
   {
		error="Enter Bank Account No";
    	document.getElementById("bank_acc_no_err").innerHTML="Enter Bank Account No";
	} 
	
	else
		document.getElementById("bank_acc_no_err").innerHTML="";
	return error;
}
function bank_name_err(str)
{
	var error="";
	if (str=="")
   {
		error="Enter Bank Details";
    	document.getElementById("bank_name_err").innerHTML="Enter Bank Details";
	} 
	else
		document.getElementById("bank_name_err").innerHTML="";
	return error;
}
function ifsc_code_err(str)
{
	var error="";
	if (str=="")
   {
		error="Enter IFSC Code";
    	document.getElementById("ifsc_code_err").innerHTML="Enter IFSC Code";
	} 
	else
		document.getElementById("ifsc_code_err").innerHTML="";
	return error;
}


function withdraw(str)
{	
    var msg1="";
	var shop_balance=document.getElementById("shop_balance").value;
	var withdraw_amt=document.getElementById("withdraw_amt").value;
	var withdraw_mode=document.getElementById("withdraw_mode").value;
	var paypal_id=document.getElementById("pid").value;
	var pay_id=document.getElementById("payumoney").value;
	var stripe_id=document.getElementById("stripe").value;
	
	var bank_acc_no=document.getElementById("bank_acc_no").value;	
	var bank_name=document.getElementById("bank_name").value;	
	var ifsc_code=document.getElementById("ifsc_code").value;	
	var shop_id=document.getElementById("shop_id").value;
	
	if(withdraw_mode=="paypal")
	{
		msg1+=paypal_err(paypal_id);
	}
	else if(withdraw_mode=="payumoney")
	{
		msg1+=payu_err(pay_id);
	}
	else if(withdraw_mode=="stripe")
	{
		msg1+=stripe_err(stripe_id);
	}
	else
	{
		msg1+=bank_acc_no_err(bank_acc_no);
		msg1+=bank_name_err(bank_name);
		msg1+=ifsc_code_err(ifsc_code);
	}
		
	
	if(msg1=="") {
	if(str=="add")
	{
		 var url="withdraw_add.php?shop_balance="+shop_balance+"&withdraw_amt="+withdraw_amt+"&withdraw_mode="+withdraw_mode+"&paypal_id="+paypal_id+"&payu_id="+pay_id+"&stripe_id="+stripe_id+"&bank_acc_no="+bank_acc_no+"&bank_name="+bank_name+"&ifsc_code="+ifsc_code+"&shop_id="+shop_id+"&action="+str;
	}
	xmlHttp.onreadystatechange=function()
 	        {	   
				if(xmlHttp.readyState==4 && xmlHttp.status==200)
  				{
  					var msg=xmlHttp.responseText.trim();
					if(msg=="Inserted")
					{		
						
						var msg="Inserted";
						window.location="withdraw.php?msg="+msg;				
					}					
					else if(msg=="error")
					{
						window.location="withdraw.php?msg="+msg;				
					}
				}
			}
			xmlHttp.open("POST",url,true);
			xmlHttp.send(null);
	}
}	
//Time Function start here
function time_function(str)
{
	if(str=="select")
  	{
  		document.getElementById("time").options.length=0;
  		var sel=document.getElementById("time");
  		sel.options[0]=new Option("Select",""); 
  	}
   else
   {   	
		var datepicker=document.getElementById("datepicker").value; 
		var time=document.getElementById("time").value; 
		var booking_per_hour=document.getElementById("booking_per_hour").value; 
		var start_time=document.getElementById("start_time").value; 
		var end_time=document.getElementById("end_time").value; 
		var shop_id=document.getElementById("shop_id").value; 
		var service_id=document.getElementById("services_id").value; 

		get_ptime_name(str,datepicker,time,booking_per_hour,start_time,end_time);
 		get_ptime_id(str,datepicker,time,booking_per_hour,start_time,end_time);
  		var dps_name1=sv_ptime;
  		var dps_id1=sv_ptime1; 
  		var dpname1=dps_name1.split("#");
  		var dpid1=dps_id1.split("#"); 
		if(dpid1=="")
		{
			alert("Please Select Another Time");
			window.location= "view_booking.php?id="+shop_id+"&service_id="+service_id;
		}
		else
		{
			//document.getElementById("time").options.length=0;
			//var sel=document.getElementById("time");
			//sel.options[0]=new Option("Select",""); 
			for(var i=1;i<dpid1.length;i++)
			{
				sel.options[i]=new Option(dpname1[i-1],dpid1[i-1]); 
			}
		}
  	}
}
var sv_ptime="";
function get_ptime_name(str,datepicker,time,booking_per_hour,start_time,end_time)
{
	var url="time_code.php?type="+'name'+"&booking_date="+datepicker+"&time="+time+"&booking_per_hour="+booking_per_hour+"&start_time="+start_time+"&end_time="+end_time;
	xmlHttp.onreadystatechange=function()
	{
		if (xmlHttp.readyState==4)
		{
			sv_ptime=xmlHttp.responseText; 
			
		}
	}
	xmlHttp.open("POST",url,false);	
	xmlHttp.send(null);
}
var sv_ptime1="";
function get_ptime_id(str,datepicker,time,booking_per_hour,start_time,end_time)
{
	var url="time_code.php?type="+'id'+"&booking_date="+datepicker+"&time="+time+"&booking_per_hour="+booking_per_hour+"&start_time="+start_time+"&end_time="+end_time;
	xmlHttp.onreadystatechange=function()
	{
		if (xmlHttp.readyState==4)
		{
			sv_ptime1=xmlHttp.responseText; 
		}
	}
	xmlHttp.open("POST",url,false);	
	xmlHttp.send(null);
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
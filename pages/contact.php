<title>Contact</title>

  <?php include("../header.php") ?>
   
    <?php 


if($lang==$en)
{
$query=mysql_fetch_array(mysql_query("select * from sv_pages where id=3 and lang_code='$lang' and page_parent='0'"));
}
else
{
	$query=mysql_fetch_array(mysql_query("select * from sv_pages where lang_code='$lang' and page_parent='3'"));
}	
$content=$query['page_content'];
$page_name=$query['page_name'];
?>
 <div class="profile_main">
<h1 class="text-center"><?php echo $page_name;?></h1>
</div>
    <form class="form-large" action="javascript:contact('add')" accept-charset="UTF-8" method="post">
        <div class="min-space">
        </div>
		<div class="container">
		 <?php
if(isset($_REQUEST['msg']))
{
$msg=$_REQUEST['msg'];
if($msg=="Inserted")
{
echo '<div class="succ-msg">Your Application send successfully. We will get back to you soon..</div>';
}
else if($msg=="Error")
{
echo '<div class="err-msg">Server Error</div>';		
}
}
else
$msg="";
?>
        <div class="col-lg-7 col-md-7 col-sm-7">
          <div class="col-lg-5 col-md-5 col-sm-5 form-group">
            <label>Name<span class="star">*</span></label>
            <input type="text" value="" required="required" class="form-control" id="name" >
          </div>
          <div class="col-lg-5 col-md-5 col-sm-5 form-group">
            <label>Email<span class="star">*</span> </label>
            <input type="email" value="" required="required" class="form-control" id="email" >
          </div>
          <div class="col-lg-5 col-md-5 col-sm-5 form-group">
            <label>Phone No<span class="star">*</span></label>
            <input type="text" value="" required="required" class="form-control" id="pho_no" >
          </div>
          <div class="col-lg-5 col-md-5 col-sm-5 form-group">
            <label>Message<span class="star">*</span> </label>
            <input type="text" value=""  required="required" class="form-control" id="msg">
          </div>
          <div class="col-lg-5">
            <input type="submit" class="form-control btn btn-login contact-butt" value="Send">
          </div>
        </div>
          <?php echo $content; ?>
		</div>
    </form>
    <div class="min-space">
    </div>
  <?php include("../footer.php") ?>
  

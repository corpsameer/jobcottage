<?php
include("../database/connection.php");
@session_start();
if(!isset($_SESSION['phone_no']))
header("Location: index.php");
else
{
$curpwd=mysqli_real_escape_string($con, $_REQUEST['curpwd']);
$new=mysqli_real_escape_string($con, $_REQUEST['newpwd']);
$conpwd=mysqli_real_escape_string($con, $_REQUEST['conpwd']);
$phone_no =  mysqli_real_escape_string($con, $_SESSION["phone_no"]);
$genre = mysqli_real_escape_string($con, md5($curpwd));
$new_pass = mysqli_real_escape_string($con, md5($new));
$result = mysqli_query($con, "SELECT * FROM sv_users where phone_no='$phone_no' and password='$genre'");
$row=mysqli_fetch_array($result);
if($row=="")
echo "Invalid";
else
{
mysqli_query($con, "update sv_users SET password='$new_pass' where phone_no='$phone_no'");			
//mysqli_query($con, "update sv_login set password='$new_pass' where phone_no='$phone_no'");
echo "success";
}
}
?>

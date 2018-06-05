<?php
session_start();
include ('../database/connection.php');
include ('../header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<section class="teaser bg-top ">
 <div class="min-space"></div><div class="min-space"></div><div class="min-space"></div>
 <h3 class="sub-title">Payment Status</h3>
<div class="min-space"></div>
<div class="min-space"></div>
</section>
<title>PayPal Transaction Cancel </title>
</head>
<body>
<div class="min-space"></div>
	<div class="container text-center">
	<h1>Your PayPal transaction has been canceled.</h1></div>
	<div class="min-space"></div>

</body>
</html>
<?php include("../footer.php")?>
<?php
/* version : 4.0
Developer name: migrateshop
Company: SangVish Technologies
Date: 08-11-2017
*/
include('header.php');
?>






	<div id="banner-section">


	<div class="slider">
	<div id="example-03" class="ma5slider inside-navs hidden-dots inside-dots horizontal-navs hidden-navs horizontal-dots loop-mode anim-fade autoplay">
        <div class="slides">
            <?php
				$slider_query=mysqli_query($con, "select * from sv_slider");
				while($slider_fetch=mysqli_fetch_array($slider_query))
				{
				?>
            <a href="#slide-2"><img src="<?php echo $site_url; ?>slider-img/<?php echo $slider_fetch['slider_img'];?>" alt=""></a>
				<?php } ?>
        </div>
    </div>

	</div>

	</div>


	<div class="main-form">
		<div class="col-md-3"></div>
			<div class="col-md-6 bgwhite">
          <h1> <?php echo get_record(1,$lang,$en,$con);?></h1>
         <div class="homepage__separator"></div>

		  <div class="col-md-12" align="center">
		  <div class="col-md-1" ></div>
		 <div class="col-md-10" >
		 <div class="homepage__subtitle"><?php echo get_record(2,$lang,$en,$con);?></div>
		 </div>
		 <div class="col-md-1" ></div>
		 </div>



		   <div class="col-md-12">
         <div class="col-md-1" ></div>


            <div class="col-md-10 searcb" align="center">
			<!-- <input id="skills" class="form-control search">-->


			 <select name="websites3" id="websites3" class="form-control search" onchange="if (this.value) window.location.href=this.value">
			<option value="" title="<?php echo $site_url; ?>img/search.png"><?php echo get_record(7,$lang,$en,$con);?></option>
			 <?php
						$res=mysqli_query($con, "select * from sv_services where lang_code='$lang'");
						while($row=mysqli_fetch_array($res))
						{
							if($lang==$en)
						{
						$ser_id=$row['id'];
						}
						else
						{
							$ser_id=$row['page_parent'];
						}
					?>
					<option value="<?php echo $site_url; ?>shop/search.php?services=<?php echo $ser_id; ?>" title="<?php echo $site_url; ?>admincp/img/<?php echo $row['service_img']; ?>"><?php echo $row['services_name']; ?></option>
			<?php } ?>

			</select>


            </div>
             <div class="col-md-1" ></div>

			</div>
			</div>


			<div class="col-md-3"></div>
         </div>
		 </div>









	<div class="container mobilemovve">

	<h2 class="text-center"><?php echo get_record(8,$lang,$en,$con);?> </h2>
	<div class="col-md-12 topbottompads">

	<div class="col-md-8">
	<img src="img/kit.jpg" class="img-responsive" border="0">
	</div>
	<div class="col-md-4 ashbg" align="center">
	<div class="featured-template__name"><?php echo get_record(9,$lang,$en,$con);?></div>
	<div class="col-md-2"></div><div class="col-md-8 "><a href="#" class="form-control btn btn-login bookhandy"><?php echo get_record(10,$lang,$en,$con);?></a></div><div class="col-md-2"></div>
	</div>
	</div>

	</div>





	   <script src="<?php echo $site_url; ?>js/jssor.slider-22.2.16.min.js" type="text/javascript"></script>

<!-----------shop slider start here----------------->







	<div class="home-demo">
      <div class="container">
        <div class="large-12 columns">
          <h3><?php echo get_record( 381, $lang,$en);?></h3>
          <div class="owl-carousel">

		   <?php
					$shop=mysqli_query($con, "select * from sv_services where lang_code='$lang' ORDER BY id ASC");
					while($shop_fet=mysqli_fetch_array($shop))
					{

						if($lang==$en)
						{
						$ser_id=$shop_fet['id'];
						}
						else
						{
							$ser_id=$shop_fet['page_parent'];
						}

					?>

            <div class="item">
			<?php
						if($shop_fet['service_img']=="")
						{
						?>
						<img data-u="image" src="<?php echo $site_url; ?>shop/shop-img/shop-default.jpg" />
						<?php } else { ?>
						<img data-u="image" src="<?php echo $site_url; ?>admincp/img/<?php echo $shop_fet['service_img']; ?>" >

						<?php } ?>
					<div class="ashbgg">
						<div class="text-center servname"><?php echo $shop_fet['services_name']; ?></div>
						<a href="<?php echo $site_url; ?>shop/search.php?services=<?php echo $ser_id; ?>" class="booknow shop-booknow sv_cleaner nofloat"><?php echo get_record(12,$lang,$en,$con);?></a>
						</div>            </div>
          <?php } ?>

          </div>
        </div>
      </div>
    </div>
    <script>
      var owl = $('.owl-carousel');
      owl.owlCarousel({
        margin: 20,
		  nav:true,
		   dots: true,
        loop: true,
		autoplay: true,
		  autoplayTimeout: 2000,
        responsive: {
          0: {
            items: 1
          },
          600: {
            items: 2
          },
          1000: {
            items: 4
          }
        }
      })
    </script>






	<div class="howit">
	<div class="container topbottompads">
	<h2 class="text-center"><?php echo get_record(13,$lang,$en,$con);?> </h2>

	<div class="col-md-12 paddon50">
	<div class="col-md-2"></div>
	<div class="col-md-8">
	<div class="col-md-3 centeralign bottomspace20"><img alt="Step 1" class="how-it-works__step-img " src="img/1a_new.png"></div>
	<div class="col-md-9">
	<div class="number-round">1</div>
	<div class="how-name"><?php echo get_record(21,$lang,$en,$con);?></div>
	<div class="how-desc">
	<?php echo get_record(22,$lang,$en,$con);?></div>
	</div>
	</div>
	<div class="col-md-2"></div>

	</div>






	<div class="col-md-12 paddon50">
	<div class="col-md-2"></div>
	<div class="col-md-8">

	<div class="col-md-9">
	<div class="number-round">2</div>
	<div class="how-name"><?php echo get_record(23,$lang,$en,$con);?></div>
	<div class="how-desc">
	<?php echo get_record(24,$lang,$en,$con);?></div>
	</div>
	<div class="col-md-3 centeralign topspace30"><img alt="Step 1" class="how-it-works__step-img " src="img/2a_new.png"></div>


	</div>
	<div class="col-md-2"></div>

	</div>




	<div class="col-md-12 paddon60">
	<div class="col-md-2"></div>
	<div class="col-md-8">
	<div class="col-md-3 centeralign bottomspace20"><img alt="Step 1" class="how-it-works__step-img " src="img/3a_new.png"></div>
	<div class="col-md-9">
	<div class="number-round">3</div>
	<div class="how-name"><?php echo get_record(32,$lang,$en,$con);?></div>
	<div class="how-desc">
	<?php echo get_record(33,$lang,$en,$con);?></div>
	</div>



	</div>
	<div class="col-md-2"></div>

	</div>





	<div class="col-md-12 paddon50">
	<div class="col-md-2"></div>
	<div class="col-md-8">

	<div class="col-md-9">
	<div class="number-round">4</div>
	<div class="how-name"><?php echo get_record(34,$lang,$en,$con);?></div>
	<div class="how-desc">
	<?php echo get_record(35,$lang,$en,$con);?></div>
	</div>
	<div class="col-md-3 centeralign topspace30"><img alt="Step 1" class="how-it-works__step-img " src="img/4a_new.png"></div>


	</div>
	<div class="col-md-2"></div>

	</div>




	<div class="col-md-12 paddon60">
	<div class="col-md-2"></div>
	<div class="col-md-8">
	<div class="col-md-3 centeralign bottomspace20"><img alt="Step 1" class="how-it-works__step-img " src="img/5a_new.png"></div>
	<div class="col-md-9">
	<div class="number-round">5</div>
	<div class="how-name"><?php echo get_record(36,$lang,$en,$con);?></div>
	<div class="how-desc">
	<?php echo get_record(37,$lang,$en,$con);?></div>
	</div>



	</div>
	<div class="col-md-2"></div>

	</div>




	<div class="col-md-12">
	<div class="col-md-5"></div>
	<div class="col-md-2 separator"></div>
	<div class="col-md-5"></div>
	</div>


	<div class="col-md-12 paddon50">
	<div class="col-md-2"></div>
	<div class="col-md-8">
	<div class="col-md-2 centeralign bottomspace20"><img alt="Step 1" class="how-it-works__pledge-img" src="img/verify_new.png"></div>
	<div class="col-md-10">

	<div class="how-name"><?php echo get_record(38,$lang,$en,$con);?></div>
	<div class="how-desc">
	<?php echo get_record(39,$lang,$en,$con);?></div>
	</div>



	</div>
	<div class="col-md-2"></div>

	</div>




	</div>




	</div>



	<!--mobile view how it works --->
	<div class="mob_howitwork">
		<div class="container">
			<h1 class="text-center"><?php echo get_record( 13, $lang,$en);?></h1><br>
				<p class="text-center sv_mob_style"><?php echo get_record( 22, $lang,$en);?></p>
				<div class="col-sm-4">
					<div class="how-works">
						<div class="how-works-number how-works-number-color1">1</div>
							<h3 class="how-works-title"><?php echo get_record( 21, $lang,$en);?></span></h3>
							<p><?php echo get_record( 22, $lang,$en);?></p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="how-works">
						<div class="how-works-number how-works-number-color2">2</div>
							<h3 class="how-works-title"><?php echo get_record( 32, $lang,$en);?></h3>
							<p><?php echo get_record( 33, $lang,$en);?></p>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="how-works">
						<div class="how-works-number how-works-number-color3">3</div>
							<h3 class="how-works-title"><?php echo get_record( 34, $lang,$en);?></h3>
							<p><?php echo get_record( 35, $lang,$en);?></p>
					</div>
				</div>

		</div>
	</div>

	<!-- end  mobile view how it works -->



<div class="testimonial-bg ">
<section id="carousel">
	<div class="container wow animated fadeIn">
	    <h2 class="testino-title"><?php echo get_record(40,$lang,$en,$con);?> </h2>
			<div class="col-md-12 paddon40">

				<div class="carousel slide" data-ride="carousel" id="quote-carousel">



        <div class="carousel-inner">
         <?php
						$testi_query=mysqli_query($con, "select * from sv_testimonials where lang_code='$lang'");
						while($testi_fetch=mysqli_fetch_array($testi_query))
						{
						?>
						<div class="item">
         <div class="col-md-10">


              <div class="row">
			   <div class="col-md-2"></div>
                <div class="col-md-2 text-center">
                  <img class="img-circle" src="<?php echo $site_url; ?>testi-img/<?php echo $testi_fetch['testi_img'];?>" style="width: 200px;height:200px;">
                  <!--<img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/128.jpg" style="width: 100px;height:100px;">-->
                </div>
				<div class="col-md-1"></div>
                <div class="col-md-7 testimons">
                  <p><?php echo $testi_fetch['description']; ?></p>
                  <small><?php echo $testi_fetch['name']; ?></small>
                </div>

              </div>

          </div>
		  </div>
          <?php } ?>
        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-angle-left"></i></a>
        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-angle-right"></i></a>
      </div>
    </div>
			</div>


</div>


			<!-- Head tags to include FontAwesome -->

</section>
</div>

<script>
$(document).ready(function(e) {
 $('.carousel-indicators li:nth-child(1)').addClass('active');
 $('.item:nth-child(1)').addClass('active');

});

</script>

<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('.carousel').carousel({
        interval: 3000 //changes the speed
    })

});
</script>








	<div class="marbil">
	<div class="container">

    <div class="col-md-12">
	<div class="col-md-4 apptop"><img src="img/nnapp.png" class="img-responsive" border="0"></div>
	<div class="col-md-8 middlesec">
	<div class="text-center easytxt"><h2><?php echo get_record(41,$lang,$en,$con);?></h2></div>
	<div class="text-center">
	<a href="#"><img alt="appstore" class="" src="img/appstore.svg" height="60"></a>
	<a href="#"><img alt="google_play" class="" src="img/google_play.svg" height="60"></a>
	</div>
	</div>
	</div>
	</div>
	</div>





<div class="container">

 <h2 class="text-center paddon60"><?php echo get_record(42,$lang,$en,$con);?> </h2>
			<div class="col-md-2"></div>
				<div class="col-md-8" align="center">
				   <?php
						$res1=mysqli_query($con, "select * from sv_services where lang_code='$lang' ORDER BY id ASC");

						$numrow=mysqli_num_rows($res1);
						while($row1=mysqli_fetch_array($res1))
						{
							$services_name=mysqli_real_escape_string($con, $row1['services_name']);
							if($lang==$en)
						{
						$ser_id=$row1['id'];
						}
						else
						{
							$ser_id=$row1['page_parent'];
						}
					?>


						<a href="shop/search.php?services=<?php echo $ser_id; ?>" class="newinline"><?php echo $services_name; ?></a>

					<?php } ?>

				</div>
			<div class="col-md-2"></div>
		 </div>


<div class="min-space"></div>







  </body>




<?php include('footer.php'); ?>

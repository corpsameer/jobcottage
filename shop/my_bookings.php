<title>My Booking</title>
<?php
include("../database/connection.php");
@session_start();
if(isset($_SESSION['phone_no'])) { 
	$phone_no=mysqli_real_escape_string($con, $_SESSION['phone_no']);			
	$query=mysqli_fetch_array(mysqli_query($con, "select * from sv_users where phone_no='$phone_no'"));
?>
<?php 
include('../header.php');
?>
<div class="profile_main">
<h1 class="text-center"><?php echo get_record(153,$lang,$en,$con);?></h1>
</div>
	<div class="min-space"></div>

<div class="container">
<?php
if(isset($_REQUEST['msg']))
{
	$msg=$_REQUEST['msg'];
		
		if($msg=="success")
		{
		     echo '<div class="succ-msg"> Your Comments Added Successfully.</div>';		
		}
				
}
else
	$msg="";
?>

	<div class="row">
			<?php 
			$book_query=mysqli_query($con, "select * from sv_booking where phone_no='$phone_no' order by id DESC");
			$num_row=mysqli_num_rows($book_query);
			if($num_row=="")
			{
			  ?>
			  <div class="err-msg"><?php echo get_record(181,$lang,$en,$con);?></div>
			<?php
			} else {
			while($book=mysqli_fetch_array($book_query))
			{
				
				$ser_id=mysqli_real_escape_string($con, $book['services_id']);
				$sel=explode("," , $ser_id);
				$lev=count($sel);
				$ser_name="";
				$sum="";
				$price="";
				for($i=0;$i<$lev;$i++)
				{
					$id=$sel[$i];		
					if($lang==$en)
						{
						$ser_id="id";
						}
						else
						{
							$ser_id="page_parent";
						}
					
					
					$res1=mysqli_query($con, "select * from sv_services where $ser_id='$id' and lang_code='$lang'");
					
					
					$fet1=mysqli_fetch_array($res1);
					$ser_name.='<div class="book-profile">'.$fet1['services_name'].'</div>';
					
					$ser_name.=",";
					$ser_name=trim($ser_name,",");
				}
				$shop_id=$book['shop_id'];
				$shop=mysqli_fetch_array(mysqli_query($con, "select * from sv_shop where id='$shop_id'"));
				
				
				 $booking_time=$book['booking_time'];
										 
				 if($booking_time>12)
				{
					$final_time=$booking_time-12;
					$final_time=$final_time."PM";
				}
				else
				{
					$final_time=$booking_time."AM";
				}
				
				$book_id = $book['id'];

			?>
			<script>
(function(e){var t,o={className:"autosizejs",append:"",callback:!1,resizeDelay:10},i='<textarea tabindex="-1" style="position:absolute; top:-999px; left:0; right:auto; bottom:auto; border:0; padding: 0; -moz-box-sizing:content-box; -webkit-box-sizing:content-box; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden; transition:none; -webkit-transition:none; -moz-transition:none;"/>',n=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing","textIndent"],s=e(i).data("autosize",!0)[0];s.style.lineHeight="99px","99px"===e(s).css("lineHeight")&&n.push("lineHeight"),s.style.lineHeight="",e.fn.autosize=function(i){return this.length?(i=e.extend({},o,i||{}),s.parentNode!==document.body&&e(document.body).append(s),this.each(function(){function o(){var t,o;"getComputedStyle"in window?(t=window.getComputedStyle(u,null),o=u.getBoundingClientRect().width,e.each(["paddingLeft","paddingRight","borderLeftWidth","borderRightWidth"],function(e,i){o-=parseInt(t[i],10)}),s.style.width=o+"px"):s.style.width=Math.max(p.width(),0)+"px"}function a(){var a={};if(t=u,s.className=i.className,d=parseInt(p.css("maxHeight"),10),e.each(n,function(e,t){a[t]=p.css(t)}),e(s).css(a),o(),window.chrome){var r=u.style.width;u.style.width="0px",u.offsetWidth,u.style.width=r}}function r(){var e,n;t!==u?a():o(),s.value=u.value+i.append,s.style.overflowY=u.style.overflowY,n=parseInt(u.style.height,10),s.scrollTop=0,s.scrollTop=9e4,e=s.scrollTop,d&&e>d?(u.style.overflowY="scroll",e=d):(u.style.overflowY="hidden",c>e&&(e=c)),e+=w,n!==e&&(u.style.height=e+"px",f&&i.callback.call(u,u))}function l(){clearTimeout(h),h=setTimeout(function(){var e=p.width();e!==g&&(g=e,r())},parseInt(i.resizeDelay,10))}var d,c,h,u=this,p=e(u),w=0,f=e.isFunction(i.callback),z={height:u.style.height,overflow:u.style.overflow,overflowY:u.style.overflowY,wordWrap:u.style.wordWrap,resize:u.style.resize},g=p.width();p.data("autosize")||(p.data("autosize",!0),("border-box"===p.css("box-sizing")||"border-box"===p.css("-moz-box-sizing")||"border-box"===p.css("-webkit-box-sizing"))&&(w=p.outerHeight()-p.height()),c=Math.max(parseInt(p.css("minHeight"),10)-w||0,p.height()),p.css({overflow:"hidden",overflowY:"hidden",wordWrap:"break-word",resize:"none"===p.css("resize")||"vertical"===p.css("resize")?"none":"horizontal"}),"onpropertychange"in u?"oninput"in u?p.on("input.autosize keyup.autosize",r):p.on("propertychange.autosize",function(){"value"===event.propertyName&&r()}):p.on("input.autosize",r),i.resizeDelay!==!1&&e(window).on("resize.autosize",l),p.on("autosize.resize",r),p.on("autosize.resizeIncludeStyle",function(){t=null,r()}),p.on("autosize.destroy",function(){t=null,clearTimeout(h),e(window).off("resize",l),p.off("autosize").off(".autosize").css(z).removeData("autosize")}),r())})):this}})(window.jQuery||window.$);

var __slice=[].slice;(function(e,t){var n;n=function(){function t(t,n){var r,i,s,o=this;this.options=e.extend({},this.defaults,n);this.$el=t;s=this.defaults;for(r in s){i=s[r];if(this.$el.data(r)!=null){this.options[r]=this.$el.data(r)}}this.createStars();this.syncRating();this.$el.on("mouseover.starrr","span",function(e){return o.syncRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("mouseout.starrr",function(){return o.syncRating()});this.$el.on("click.starrr","span",function(e){return o.setRating(o.$el.find("span").index(e.currentTarget)+1)});this.$el.on("starrr:change",this.options.change)}t.prototype.defaults={rating:void 0,numStars:5,change:function(e,t){}};t.prototype.createStars=function(){var e,t,n;n=[];for(e=1,t=this.options.numStars;1<=t?e<=t:e>=t;1<=t?e++:e--){n.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"))}return n};t.prototype.setRating=function(e){if(this.options.rating===e){e=void 0}this.options.rating=e;this.syncRating();return this.$el.trigger("starrr:change",e)};t.prototype.syncRating=function(e){var t,n,r,i;e||(e=this.options.rating);if(e){for(t=n=0,i=e-1;0<=i?n<=i:n>=i;t=0<=i?++n:--n){this.$el.find("span").eq(t).removeClass("glyphicon-star-empty").addClass("glyphicon-star")}}if(e&&e<5){for(t=r=e;e<=4?r<=4:r>=4;t=e<=4?++r:--r){this.$el.find("span").eq(t).removeClass("glyphicon-star").addClass("glyphicon-star-empty")}}if(!e){return this.$el.find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty")}};return t}();return e.fn.extend({starrr:function(){var t,r;r=arguments[0],t=2<=arguments.length?__slice.call(arguments,1):[];return this.each(function(){var i;i=e(this).data("star-rating");if(!i){e(this).data("star-rating",i=new n(e(this),r))}if(typeof r==="string"){return i[r].apply(i,t)}})}})})(window.jQuery,window);$(function(){return $(".starrr").starrr()})

$(function(){

  $('#new-review<?php echo $book_id; ?>').autosize({append: "\n"});

  var reviewBox = $('#post-review-box<?php echo $book_id; ?>');
  var newReview = $('#new-review<?php echo $book_id; ?>');
  var openReviewBtn = $('#open-review-box<?php echo $book_id; ?>');
  var closeReviewBtn = $('#close-review-box<?php echo $book_id; ?>');
  var ratingsField = $('#ratings-hidden<?php echo $shop_id; ?>');

  openReviewBtn.click(function(e)
  {
    reviewBox.slideDown(400, function()
      {
        $('#new-review<?php echo $book_id; ?>').trigger('autosize.resize');
        newReview.focus();
      });
    openReviewBtn.fadeOut(100);
    closeReviewBtn.show();
  });

  closeReviewBtn.click(function(e)
  {
    e.preventDefault();
    reviewBox.slideUp(300, function()
      {
        newReview.focus();
        openReviewBtn.fadeIn(200);
      });
    closeReviewBtn.hide();
    
  });

  $('.starrr').on('starrr:change', function(e, value){
    ratingsField.val(value);
  });
});
</script>
	
			<div class="col-md-12">
			<div class="row booking_page">
				<div class="shop_pic col-lg-4">
				<?php
					if($shop['cover_photo']=="")
					{
				?>
				<a href="<?php echo $site_url; ?>/shop/view_profile.php?id=<?php echo $shop_id; ?>" target="_blank"><img class="img-responsive" src="<?php echo $site_url; ?>shop/shop-img/shop-default.jpg" alt=""></a>
				<?php } else { ?>
				<a href="<?php echo $site_url; ?>/shop/view_profile.php?id=<?php echo $shop_id; ?>" target="_blank">	<img class="img-responsive" src="<?php echo $site_url; ?>shop/shop-img/<?php echo $shop['cover_photo']; ?>" alt=""></a>
				<?php } ?>
					
				</div>
				<div class="col-lg-8 book_content">
				<div class="col-md-6 right">
				
    	<div class="well well-sm">
            <div class="text-right">
                <a class="btn btn-success btn-green" href="#reviews-anchor" id="open-review-box<?php echo $book_id; ?>"><?php echo get_record(154,$lang,$en,$con);?></a>
            </div>
        
            <div class="row" id="post-review-box<?php echo $book_id; ?>" style="display:none;">
                <div class="col-md-12">
                    <form accept-charset="UTF-8" action="rating_add.php" method="post">
                        <input id="ratings-hidden<?php echo $shop_id; ?>" name="rating" type="hidden"> 
						<input type="hidden" id="shop_id" name="shop_id" value="<?php echo $shop_id; ?>">
                        <textarea required class="form-control animated ratingtxt" cols="50" id="new-review<?php echo $shop_id; ?>" name="comment" placeholder="Enter your review here..." rows="5"></textarea>
        
                        <div class="text-right samebtn">
                            <div class="stars starrr" data-rating="0"></div>
                            <a class="btn btn-danger btn-sm" href="#" id="close-review-box<?php echo $book_id; ?>" style="display:none; margin-right: 10px;">
                            <span class="glyphicon glyphicon-remove"></span><?php echo get_record(155,$lang,$en,$con);?></a>
                            <button class="btn btn-success btn-lg" type="submit"><?php echo get_record(156,$lang,$en,$con);?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
         
		</div>
					<h3 class="sv_shop_style"><a href="<?php echo $site_url; ?>/shop/view_profile.php?id=<?php echo $shop_id; ?>" target="_blank"><?php echo $shop['shop_name']; ?></a></h3>
					
					<p><i class="fa fa-calendar-o" aria-hidden="true"></i>	<?php echo $book['booking_date']; ?> - <i class="fa fa-clock-o" aria-hidden="true"></i>
						<?php echo $final_time; ?></p>
					
					<h5>Booking Id : <?php echo $book['id']; ?> - Status: <?php echo $book['status']; ?></h5>
					
					  <?php echo $ser_name; ?>
				</div>
				<div class="total-price col-lg-2"><?php echo get_record(157,$lang,$en,$con);?>- <?php if($book['total_amt']=="") { echo "0"; } else { echo $book['total_amt']; }?>&nbsp;<?php echo $currency_mode; ?></div>

			</div>
			</div>
			<?php } } ?>


   </div>
</div>

	<div class="min-space"></div>
	<?php } else { header('Location:../login/login.php'); }?>

	<?php include("../footer.php"); ?>
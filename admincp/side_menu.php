 <nav class="navbar-default navbar-side" role="navigation">
		<div id="sideNav" href="#"><i class="fa fa-caret-right"></i></div>
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<li class="menuitem <?php if($page=='dashboard'){echo 'active';}?>" >
                        <a href="dashboard.php"><i class="fa fa-dashboard"></i>Dashboard</a>
                    </li>  

                    
					
				   
					<li class="menuitem <?php if($page=='pages'){echo 'active';}?>" >
						<a href="pages.php"><i class="fa fa-file" aria-hidden="true"></i>Pages</a>
					</li>  
					<li class="menuitem <?php if($page=='users'){echo 'active';}?>" >
						<a href="users.php"><i class="fa fa-users" aria-hidden="true"></i>Users</a>
					</li> 					
					<li class="menuitem <?php if($page=='services'){echo 'active';}?>" >
						<a href="services.php"><i class="fa fa-asterisk" aria-hidden="true"></i>Services</a>
					</li>  
					<li class="menuitem <?php if($page=='shop'){echo 'active';}?>" >
						<a href="shop.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>All Shops</a>
					</li> 
					<li class="menuitem <?php if($page=='booking'){echo 'active';}?>" >		
						<a href="booking.php"><i class="fa fa-bookmark" aria-hidden="true"></i>Booking History</a>			
					</li> 
					
					<li class="menuitem <?php if($page=='pending'){echo 'active';}?>" >		
						<a href="pending_withdraw.php"><i class="fa fa-money" aria-hidden="true"></i>Pending Withdrawal</a>			
					</li> 
					<li class="menuitem <?php if($page=='completed'){echo 'active';}?>" >		
						<a href="completed_withdraw.php"><i class="fa fa-check" aria-hidden="true"></i>Completed Withdrawal</a>			
					</li> 
				
					<li class="menuitem <?php if($page=='slider'){echo 'active';}?>" >
						<a href="home-slider.php"><i class="fa fa-picture-o" aria-hidden="true"></i>Home Slider</a>
					</li>  
								
					<li class="menuitem <?php if($page=='testimonials'){echo 'active';}?>" >
						<a href="home-testimonials.php"><i class="fa fa-comments-o" aria-hidden="true"></i>Testimonials</a>
					</li>  
					<li class="menuitem <?php if($page=='widget'){echo 'active';}?>" >
						<a href="widget.php"><i class="fa fa-file-text-o" aria-hidden="true"></i>Widget</a>
					</li> 
					<li class="menuitem <?php if($page=='blog'){echo 'active';}?>" >
						<a href="blog.php"><i class="fa fa-rss" aria-hidden="true"></i>Blog</a>
					</li>  
					<li class="menuitem <?php if($page=='social-login'){echo 'active';}?>" >
						<a href="social_login.php"><i class="fa fa-share-square-o" aria-hidden="true"></i>Social Links</a>
					</li> 

					<li class="menuitem <?php if($page=='language'){echo 'active';}?>" >
						<a href="language.php"><i class="fa fa-language" aria-hidden="true"></i>Language</a>
					</li> 
                   <?php
				   $checkrec=mysqli_num_rows(mysqli_query($con, "select * from sv_language where lang_status='1' order by lang_id asc"));
				   
				   if($checkrec>1){
				   
                   $viewact=mysqli_fetch_array(mysqli_query($con, "select * from sv_language where lang_status='1' order by lang_id asc limit 1,1"));			   
				   ?>
				   <li class="menuitem <?php if($page=='translate'){echo 'active';}?>" >
						<a href="translate.php?section=<?php echo $viewact['lang_code'];?>"><i class="fa fa-language" aria-hidden="true"></i>Translate</a>
					</li>  
                   <?php } ?>


 					
					<li class="menuitem <?php if($page=='setting'){echo 'active';}?>" >
						<a href="setting.php"><i class="fa fa-cog" aria-hidden="true"></i>Setting</a>
					</li>  
					
					
					
					<li class="menuitem <?php if($page=='change password'){echo 'active';}?>" >		
						<a href="change_pwd.php"><i class="fa fa-unlock" aria-hidden="true"></i>Change Password</a>			
					</li> 
					
                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->
      
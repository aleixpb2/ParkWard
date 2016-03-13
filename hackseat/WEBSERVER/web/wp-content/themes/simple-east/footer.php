<?php
/**
 * The template for displaying the footer
 **/
 
?>
	 	</div> <!-- Row End here -->
          </div> <!--.container-->
            </div> <!--.middle_wrapper-->
           <!--Middle wrapper End Here-->  
          
           <!--Footer wrapper Start Here--> 
   <footer class="footer_wrapper" itemscope itemtype="http://schema.org/WPFooter">
                 	
            <div class="container">
              
              <?php if(is_active_sidebar('Footer Sidebar')): ?>
               <div id="footer-widget-area">    
                	<?php dynamic_sidebar('Footer Sidebar'); ?>
                <div class="clearboth"></div>
                </div>
			<?php endif; ?>
                <div class="clearboth"></div>

               </div><!--.container-->
				   	<div class="copy_right">
                    	<div class="container"> <a target="_blank" href="http://www.navthemes.com/simple-east-blog-theme"><?php _e('Simple East Blog Theme', 'simple-east'); ?></a> <?php _e('By', 'simple-east') ?> <a target="_blank" href="http://navthemes.com">NavThemes.com</a></div>
                    </div> 
              <!--Footer wrapper End Here--> 
			<?php wp_footer(); ?>
	     </footer> 	  

    </div>
    <!--.main_container end-->

    </body>
    </html>
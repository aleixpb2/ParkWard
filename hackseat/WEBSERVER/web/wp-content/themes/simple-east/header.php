<?php
/**
 * The template for displaying the header
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js"  itemscope itemtype="http://schema.org/Blog">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="icon" type="image/x-icon" href="" />
    <!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
 

	<?php wp_head(); ?>
</head>

<body id="blog" <?php body_class(); ?>>  
    <!--.main_container-->
    	<div class="main_container">
        	<!--header wrapper Start Here-->
            	<header class="header_wrapper" itemscope itemtype="http://schema.org/WPHeader">
                
                <div id="top_menu" class="gray_bg">
                    <nav id="top-menu" class="navmenu container" role="navigation">
                               
                               <?php if ( has_nav_menu( 'top-menu' ) ) { ?>
                                <?php wp_nav_menu( 
										array( 
											  'theme_location' => 'top-menu',
										 	  'items_wrap'=> '<ul itemscope itemtype="https://schema.org/SiteNavigationElement" id="%1$s" class="%2$s">%3$s</ul>', 
											  'container' => 'none',
											  'fallback_cb' => false 
                                		) ); 
								?>
                              <?php } else{ ?>  
                                <ul class="menu clearfix">
										<?php wp_list_categories('title_li='); ?>
									</ul>
                                <?php } ?>
                                
                     </nav><!-- #top_menu -->
                </div>    
			   
             	 	<div class="container">
                    	<div class="row">
                          <div id="logo" class="pull-left logo">
                          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                          <?php 
								$logotag = simple_east_logo_tag();
								$description_tag = simple_east_description_tag();
						  	?>
						  <?php echo $logotag['open']; ?> class="site-title">
                           <?php 
						   bloginfo( 'name' ); 
						  echo $logotag['close']; ?>   
                        </a>   
                       	 <?php echo $description_tag['open']; ?> class="site-description"><?php bloginfo( 'description' ); ?> <?php echo $description_tag['close']; ?>
                            </div>
                        </div>
                    </div>
                    
           		
                <div id="primary_menu" class="blue_bg">
                    <nav id="primary-menu" class="main-navigation navmenu container" role="navigation">
                                <?php if ( has_nav_menu( 'primary' ) ) { ?>
                               <?php wp_nav_menu( 
										array( 
												'theme_location' => 'primary', 
												'items_wrap'=> '<ul itemscope itemtype="https://schema.org/SiteNavigationElement" id="%1$s" class="%2$s">%3$s</ul>', 
												'container' => 'none', 
										) ); 
							  ?>
                              <?php } else { ?>  
                                <ul class="menu clearfix">
										<?php wp_list_categories('title_li='); ?>
									</ul>
								 <?php
                                 	}
                                  ?>
                              
                     </nav><!-- #primary_menu -->
                </div>    
  
         </header>
  			 <!--header wrapper End Here-->
       
            <div class="clearboth"></div>
			
            <!-- BreadCrumbs -->
            <?php if(!is_front_page() || !is_home()): ?>
				     
            	<div class="breadcrumbs">
					<div class="container">
						<?php simple_east_navthemes_breadcrumbs(); ?>
                    </div>
                </div>
           
           <?php endif; ?>
   
     	<!--Middle wrapper Start Here--> 
            <div class="middle_wrapper">
            	<div class="container">
                	<div class="row">
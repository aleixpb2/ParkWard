<?php
/**
 * The template for displaying all single posts and attachments
 **/

// Initiate Options
global $navthemes_options;
	
get_header(); ?>
 

	<div class="col-md-8 col-sm-8">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
    	
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			get_template_part( 'content', get_post_format() );
		?>
       
            <div class="clearfix"></div>
            <div style="height:30px;"></div>
            <div class="clearfix"></div>
  
        
        <div class="post-links">
               <?php next_post_link( '<div class="alignleft"> <i class="fa fa-angle-double-left"></i> %link</div>' ); ?>
               <?php previous_post_link( '<div class="alignright">%link <i class="fa fa-angle-double-right"></i></div>' ); ?>
			</div>
       	 
			<?php
				
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		// End the loop.
		endwhile;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
  </div><!-- .col -->  
    
 		<?php get_sidebar(); ?>
 
<?php get_footer(); ?>
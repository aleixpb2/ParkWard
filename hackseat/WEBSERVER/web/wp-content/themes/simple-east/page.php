<?php
/**
 * The template for displaying pages
 **/

global $navthemes_options;

get_header(); ?>
 
	<div class="col-md-8 col-sm-8">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		// End the loop.
		endwhile;
		?>

	</main><!-- .site-main -->
	</div><!-- .content-area -->
  </div> <!-- .col -->
    
		<?php get_sidebar(); ?>

<?php get_footer(); ?>

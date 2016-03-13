<?php
/**
 * The main template file
 **/

global $navthemes_options;

get_header(); ?>

	<div class="col-md-8 col-sm-8">
	 <div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
        
	    <?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				get_template_part( 'content', get_post_format() );

			// End the loop.
			endwhile;
			
			// Post Nav
			simple_east_navthemes_number_post_nav();
	
		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
  
  </div>  

		<?php get_sidebar(); ?>

<?php get_footer(); ?>

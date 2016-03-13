<?php
/**
 * The template for displaying search results pages.
 **/

get_header(); ?>


 	<div class="col-md-8 col-sm-8">

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'simple-east' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
		
        		get_template_part( 'content', 'search' );

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
	</section><!-- .content-area -->
  </div><!-- .col -->  
    
	<?php get_sidebar(); ?>

<?php get_footer(); ?>

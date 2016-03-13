<?php
/**
 * The template for displaying archive pages
 **/

get_header(); ?>

 	<div class="col-md-8 col-sm-8">
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();
			
				get_template_part( 'content', get_post_format() );

			// End the loop.
			endwhile;
			
			simple_east_navthemes_number_post_nav();

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</section><!-- .content-area -->
  </div><!-- .col-md-8 .col-sm-8 -->  
    
	<?php get_sidebar(); ?>

<?php get_footer(); ?>

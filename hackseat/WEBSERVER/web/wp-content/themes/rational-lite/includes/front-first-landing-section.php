<?php if( 'none' != get_theme_mod('rational_lite_rat_first_section', 'none') ) {
	$the_query = new WP_Query( array( 'page_id' => get_theme_mod('rational_lite_rat_first_section') ) );
	if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
		<div id="section1" class="landing-section skt-section skt-default-page">
			<div class="container" >
				<div class="row-fluid">
					<div class="span12">
						<div class="landing-page-title">
							<h3 class="text-white"><?php the_title(); ?></h3>
							<span class="border_center border-white"></span>
						</div>

						<div class="landing-page-content text-white">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php break;
		endwhile;
		wp_reset_postdata();
	endif;
} ?>
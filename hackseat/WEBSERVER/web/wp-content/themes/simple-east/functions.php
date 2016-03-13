<?php
/**
 * Theme functions and definitions
 **/

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 */
 
	if ( ! isset( $content_width ) ) {
		$content_width = 1200;
	}

	/**
	 * Simple East only works in WordPress 4.1 or later.
	 */
	if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
		require get_template_directory() . '/inc/back-compat.php';
	}

if ( ! function_exists( 'simple_east_init' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 */
function simple_east_init() {

	load_theme_textdomain( 'simple-east', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );
		
		// Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 730, 300, true );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'top-menu'  => __( 'Top Menu', 'simple-east' ),
			'primary' => __( 'Primary Menu',      'simple-east' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css') );
		
}
endif; // simple-east_init
add_action( 'after_setup_theme', 'simple_east_init' );

	/**
	 * Sidebars.
	 *
	 */
	function simple_east_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Default Widget Area', 'simple-east' ),
			'id'            => 'main-sidebar',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'simple-east' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s"  itemscope itemtype="http://schema.org/WPSideBar">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title heading" itemprop="about">',
			'after_title'   => '</h3>',
		) );
		
		register_sidebar( array(
			'name'          => __( 'Footer Sidebar', 'simple-east' ),
			'id'            => 'footer-sidebar',
			'description'   => __( 'Add widgets here to appear in your footer area.', 'simple-east' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s col-md-4"><div class="widget-content">',
			'after_widget'  => '</div></aside>',
			'before_title'  => '<h3 class="widget-title heading" itemprop="about">',
			'after_title'   => '</h3>',
		) );
	}
	add_action( 'widgets_init', 'simple_east_widgets_init' );

	/**
	 * Enqueue scripts and styles.
	 *
	 */
	function simple_east_scripts() {
		global $wp_styles;
		
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
			
	
		// Adds bootstrap JavaScript.
		wp_enqueue_script( 'simple-east-bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ) );
	
		// Loads our bootstrap.
		wp_enqueue_style( 'simple-east-bootstrap-style', get_template_directory_uri(). '/assets/bootstrap/css/bootstrap.min.css' );
	
		// Loads our main stylesheet.
		wp_enqueue_style( 'simple-east-style', get_stylesheet_uri(), array( 'simple-east-bootstrap-style' ) );
	
		// Adds JavaScript for handling the navigation menu hide-and-show behavior.
		wp_enqueue_script( 'simple-east-navigation', get_template_directory_uri() . '/assets/menu/script.js', array( 'jquery' ), '20150217', true );
	
		// Loads the Font Awesome.
		wp_enqueue_style( 'simple-east-fontawesome', get_template_directory_uri() . '/assets/custom/css/font-awesome.min.css', array( 'simple-east-style' ));
		 
	}
	
	add_action( 'wp_enqueue_scripts', 'simple_east_scripts' );

/*--------------------------------------------------------------
# Google Fonts
--------------------------------------------------------------*/
	
	if ( ! function_exists( 'simple_east_fonts_url' ) ) :

function simple_east_fonts_url() {
    $fonts_url = '';
 
    /* Translators: If there are characters in your language that are not
    * supported by Open Sans, translate this to 'off'. Do not translate
    * into your own language.
    */
    $source_sans = _x( 'on', 'Source Sans Pro font: on or off', 'simple-east' );
 
        $font_families = array();
 
        if ( 'off' !== $source_sans ) {
   
            $font_families[] = 'Source Sans Pro:300,400';
   
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
 
    return esc_url_raw( $fonts_url );
}

endif;

function simple_east_scripts_styles() {
    wp_enqueue_style( 'simple-east-fonts', simple_east_fonts_url(), array(), null );
}

add_action( 'wp_enqueue_scripts', 'simple_east_scripts_styles' );
	
 
/*-----------------------------
 # Sizes
-------------------------------*/
 
 add_image_size('recent_post_image',100,100, true); 
 add_image_size('related-post-image-sidebar',200,150, true);  
 add_image_size('related-post-image-full',340,250, true); 
 add_image_size('slider_image',642,300, true); // 642 pixels wide by 300 pixels tall, hard crop mode 	


	/**
	 * Add a `screen-reader-text` class to the search form's submit button.
	 */
	function simple_east_search_form_modify( $html ) {
		return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
	}
	add_filter( 'get_search_form', 'simple_east_search_form_modify' );
	
	/**
	 * Custom template tags for this theme.
	 *
	 */
	function simple_east_excerpt_more( $more ) {
		return '<p class="readmore-p"><a class="readmore" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'simple-east') . '</a></p>';
	}
	add_filter( 'excerpt_more', 'simple_east_excerpt_more' );


	 // Navthemes Custom Function File
	require_once( dirname( __FILE__ ) . '/navthemes-functions.php' );

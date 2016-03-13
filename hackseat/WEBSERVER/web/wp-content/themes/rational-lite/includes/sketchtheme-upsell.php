<?php
/**
 * Title: Theme Upsell.
 *
 * Description: Displays list of all Sketchtheme themes linking to it's pro and free versions.
 *
 *
 * @author   Sketchtheme
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://sketchthemes.com/
 */

// Add stylesheet and JS for sell page.
function rational_lite_sell_style() {
    // Set template directory uri
    $directory_uri = get_template_directory_uri();
    wp_enqueue_style( 'upsell_style', get_template_directory_uri() . '/css/upsell.css' );
}
add_action( 'admin_init', 'rational_lite_sell_style' );

// Add upsell page to the menu.
function rational_lite_add_upsell() {
    $page = add_theme_page( __('SketchThemes', 'rational-lite'), __('SketchThemes', 'rational-lite'), 'administrator', 'sketch-themes', 'rational_lite_display_upsell' );
    add_action( 'admin_print_styles-' . $page, 'rational_lite_sell_style' );
}
add_action( 'admin_menu', 'rational_lite_add_upsell',12 );

// Define markup for the upsell page.
function rational_lite_display_upsell() {

    // Set template directory uri
    $directory_uri = get_template_directory_uri().'/images';
    ?>

    <div class="wrap">
    <div class="container-fluid">
    <div id="upsell_container">
    <div class="clearfix row-fluid">
        <div id="upsell_header" class="span12">
            <div class="donate-info">
              <strong><?php _e('To Activate All Features, Please Upgrade to Pro version!', 'rational-lite'); ?></strong><br>
              <a title="<?php _e('Upgrade to Pro', 'rational-lite') ?>" href="https://sketchthemes.com/" target="_blank" class="upgrade"><?php _e('Upgrade to Pro', 'rational-lite'); ?></a> <a title="<?php _e('Setup Instructions', 'rational-lite'); ?>" href="<?php echo get_template_directory_uri(); ?>/readme.txt" target="_blank" class="donate"><?php _e('Setup Instructions', 'rational-lite'); ?></a>
              <a title="<?php _e('Rate Rational Lite', 'rational-lite'); ?>" href="https://wordpress.org/support/view/theme-reviews/rational-lite" target="_blank" class="review"><?php _e('Rate Rational Lite', 'rational-lite'); ?></a>
              <a title="<?php _e('Theme Test Drive', 'rational-lite'); ?>" href="http://trial.sketchthemes.com/wp-signup.php" target="_blank" class="review"><?php _e('Theme Test Drive', 'rational-lite'); ?></a>
            </div>
        </div>
    </div>
    <div id="upsell_themes" class="clearfix row-fluid">

    
    <!-- -------------- Rational Pro ------------------- -->

        <div id="Rational" class="row-fluid">
            <div class="theme-container">
                <div class="theme-image span3">
                    <a href="https://sketchthemes.com/themes/rational-impressive-one-pager-responsive-business-wordpress-theme/" target="_blank">
                        <img src="<?php echo $directory_uri; ?>/Rational.png"  alt="<?php __('Rational Theme', 'rational-lite') ?>" width="300px"/>
                    </a>
                </div>
                <div class="theme-info span9">
                    <a class="theme-name" href="https://sketchthemes.com/themes/rational-impressive-one-pager-responsive-business-wordpress-theme/" target="_blank"><h4><?php _e('Rational - Impressive One Pager Responsive Business WordPress Theme','rational-lite');?></h4></a>

                    <div class="theme-description">
                        <p><?php _e("Every business requires an approach that shows the logic behind floating the trade and the exact objective with which the venture is initiated.Adding a rational approach to every business in the first place, the Rational - One Pager Responsive Business WordPress Theme certainly promises to better user's experience.",'rational-lite'); ?></p>

                    </div>

                    <a class="free btn btn-success" href="https://wordpress.org/themes/download/rational-lite.1.0.0.zip?nostats=1" target="_blank"><?php _e( 'Try Rational Free', 'rational-lite' ); ?></a>
                    <a class="buy  btn btn-info" href="https://sketchthemes.com/samples/rational-onepager-demo/" target="_blank"><?php _e( 'View Demo', 'rational-lite' ); ?></a>
                    <a class="buy btn btn-primary" href="https://www.sketchthemes.com/members/signup/rational/" target="_blank"><?php _e( 'Buy Rational Pro', 'rational-lite' ); ?></a>
                    
                </div>
            </div>
        </div>
		
    </div>
    <!-- upsell themes -->
    </div>
    <!-- upsell container -->
    </div>
    <!-- container-fluid -->
    </div>
<?php
}

?>
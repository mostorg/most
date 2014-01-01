<?php
/**
 * Most Theme Functions
 *
 * @package WordPress
 * @subpackage Most
 * @author Chelsea M. P. Lorenz
 */

/**
 * Including Function Files
 */
include 'inc/template-tags.php';
include 'admin/admin.php';

/**
 * Set content width value
 */
if ( !isset( $content_width ) )
    $content_width = 1170;

/**
 * Load CSS and jQuery files for theme.
 */
function most_scripts() {
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/bootstrap/css/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrap-responsive', get_template_directory_uri().'/bootstrap/css/bootstrap-responsive.min.css' );
    wp_enqueue_style( 'most-css', get_stylesheet_uri() );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_script( 'most-js', get_template_directory_uri() . '/js/main.js', array('jquery') );
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'most_scripts' );

/**
 * Frontend Ajaxurl
 */
function most_ajaxurl() { ?>
    <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url("admin-ajax.php"); ?>';
    </script><?php
}
add_action( 'wp_head', 'most_ajaxurl' );

/**
 * Setup Theme Functions
 */
function most_theme_setup() {
    add_theme_support( 'custom-header', array('header-text'=>false) );
    add_theme_support( 'html5', array('search-form') );
    add_theme_support( 'post-thumbnails' );
    register_nav_menus( array(
        'quick-menu'    =>  __('Quick Menu', 'most'),
        'side-menu'     =>  __('Side Menu', 'most'),
        'footer-menu'   =>  __('Footer Menu', 'most')
    ) );
}
add_action( 'after_setup_theme', 'most_theme_setup' );

/**
* Theme Set Ajax
*/
function most_theme_set_ajax() {
        global $wpdb; // this is how you get access to the database
        foreach( $_POST['options'] as $key => $value ) {
            $changed = update_option( $key, $value );
        }
        // save confirmation
        exit(); // this is required to return a proper result
}
add_action( 'wp_ajax_most_theme_set_ajax', 'most_theme_set_ajax' );

/**
 * Adds custom classes to the array of body classes.
 *
 */
function most_body_classes($classes){
    $selected_set = get_option('selected_theme_set');
    $classes[] = $selected_set;
    return $classes;
}
add_filter( 'body_class', 'most_body_classes' );
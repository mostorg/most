<?php
/**
 * Moux Theme Functions
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
 * Load CSS styles for theme.
 */
function most_styles() {
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/bootstrap/css/bootstrap.min.css' );
    wp_enqueue_style( 'bootstrap-responsive', get_template_directory_uri().'/bootstrap/css/bootstrap-responsive.min.css' );
    wp_enqueue_style( 'most-css', get_stylesheet_uri() );
}
add_action( 'wp_print_styles', 'most_styles' );

/**
 * Load JavaScript and jQuery files for theme.
 *
 */
function most_scripts() {
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'most-js', get_template_directory_uri() . '/js/main.js', array('jquery') );
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array('jquery'), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'most_scripts' );

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
 * @todo comment this function
 *
 */
// function most_theme_set( $new_set = null ) {
//     global $set;
//     $theme = get_option('m_theme_sets');
//     if ($new_set) {
//         $set = $new_set;
//     } elseif (!isset($theme['default'])||$theme['default']=='') {
//         $set = 'set-1';
//     } else {
//         $set = 'set-'.$theme['default'];
//     }
//     return $set;
// }

/**
 * Adds custom classes to the array of body classes.
 *
 */
// function most_body_classes($classes){
//     global $set;
//     $classes[] = $set;
//     return $classes;
// }
// add_filter( 'body_class', 'most_body_classes' );
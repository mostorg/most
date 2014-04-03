<?php
/**
 * The Left Sidebar displayed on all page templates.
 *
 * @package WordPress
 * @subpackage Most
 */
?>
<aside id="sidebar-left" class="span3"><?php
    wp_nav_menu( array(
        'theme_location' => 'side-menu',
        'container' => 'false',
        'menu_class' => 'nav nav-list',
        'menu_id' => 'side-menu',
        'fallback_cb' => ''
    ) );
    if ( is_front_page() ) {
        if (function_exists('dynamic_sidebar')) {
            dynamic_sidebar('front-left-sidebar');
        }
    } else {
        if (function_exists('dynamic_sidebar')) {
    	    dynamic_sidebar('inner-left-sidebar');
    	}
    } ?>
</aside>
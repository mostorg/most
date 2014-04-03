<?php
/**
 * The Right Sidebar displayed on all page templates.
 *
 * @package WordPress
 * @subpackage Most
 */
if (function_exists('dynamic_sidebar')) { ?>
	<aside id="sidebar-right" class="span3 pull-right"><?php
   	if ( is_front_page() ) :
	   	dynamic_sidebar('front-right-sidebar');
   	else :
	   	dynamic_sidebar('inner-right-sidebar');
   	endif; ?>
	</aside><?php
}
<?php
/**
 * The Right Sidebar displayed on all page templates.
 *
 * @package WordPress
 * @subpackage Most
 */
if (function_exists('dynamic_sidebar')) { ?>
	<aside id="sidebar-right" class="span3 pull-right"><?php
	    dynamic_sidebar('right-sidebar'); ?>
	</aside><?php
}
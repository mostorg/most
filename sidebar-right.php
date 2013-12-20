<?php
/**
 * The Right Sidebar displayed on all page templates.
 *
 * @package WordPress
 * @subpackage Most
 */
if (function_exists('dynamic_sidebar')) {
    dynamic_sidebar('right-sidebar');
}
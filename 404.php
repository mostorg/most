<?php
/**
 * 404 Template 
 * Description: Displays content for pages not found.
 *
 * @package WordPress
 * @subpackage Most
 */
get_header();
   get_sidebar('left'); ?>
   <div id="404-content" class="span6">
      <h2><?php _e('Page Not Found', 'most'); ?></h2>
      <p class="lead">It seems we can't find what you're looking for. Perhaps searching keywords or clicking one of the links below can help.</p>
      <div class="well">
         <?php get_search_form(); ?>
      </div>
   </div><?php
   get_sidebar('right');
get_footer();
<?php
/**
 * Default Template
 * Description: Page template with a content container and right sidebar.
 *
 * @package WordPress
 * @subpackage Most
 */
get_header();
while ( have_posts() ) : the_post(); ?>
    <div class="container">
        <h1><?php the_title();?></h1>
        <div class="span8"><?php
            the_content();
            edit_post_link(__('Edit', 'most'), '<span class="edit-link">', '</span>'); ?>
        </div><!-- /.span8 -->
    </div><?php
endwhile; // end of the loop.
//get_sidebar();
get_footer(); ?>
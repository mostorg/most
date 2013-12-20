<?php
/**
 * Default Template
 * Description: Page template with a content container and right sidebar.
 *
 * @package WordPress
 * @subpackage Most
 */
get_header();

while (have_posts()) : the_post(); ?>

  <div class="container">
    <div class="row">
        <div class="span12"><?php
            if (function_exists('most_breadcrumbs')) {
                most_breadcrumbs();
            } ?>
        </div><!--/.span12 -->
    </div><!--/.row -->

    <header class="page-title">
        <h1><?php the_title();?></h1>
    </header>

  <div class="row content">
    <div class="span8"><?php
        the_content();
        wp_link_pages( array('before' => '<div class="page-links">' . __('Pages:', 'most'), 'after' => '</div>'));
        edit_post_link(__('Edit', 'most'), '<span class="edit-link">', '</span>'); ?>
    </div><!-- /.span8 --><?php
endwhile; // end of the loop.

get_sidebar();
get_footer(); ?>
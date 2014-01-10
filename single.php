<?php
/**
 * Default Post Template
 * Description: Post template with a content container and no sidebar.
 *
 * @package WordPress
 * @subpackage Most
 */
get_header();
while ( have_posts() ) : the_post(); ?>
    <div class="container">
        <h2><?php the_title(); ?></h2>
        <div class="span8"><?php
            the_date('F j, Y','<p class="meta">Posted on ','</p>');
            the_content();
            the_tags('<p>Tags: ', ', ', '</p>'); ?>
        </div><!-- /.span8 -->
    </div><?php
endwhile; // end of the loop.
get_footer(); ?>
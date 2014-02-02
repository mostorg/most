<?php
/**
 * Template Name: Sidebar Left Template
 * Description: Displays a content container with a left sidebar.
 *
 * @package WordPress
 * @subpackage Most
 */
get_header();
	get_sidebar('left');
	while ( have_posts() ) : the_post(); ?>
	   <article class="span9">
	      	<h2><?php the_title();?></h2><?php
            edit_post_link(__('- Edit Page', 'most'), '<span class="edit-link">', '</span>');
            the_content(); ?>
	   </article><?php
	endwhile; // end of the loop.
get_footer(); ?>
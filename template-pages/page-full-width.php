<?php
/**
 * Template Name: Full-Width Template
 * Description: Displays a page title and content without displaying a sidebar.
 *
 * @package WordPress
 * @subpackage TraveLust
 */
get_header();

while (have_posts()) : the_post(); ?>

    <div class="container">
        <div class="row">
            <div class="span12"><?php 
                if (function_exists('travelust_breadcrumbs')) {
                    travelust_breadcrumbs();
                } ?>
            </div><!--/.span12 -->
        </div><!--/.row -->

        <header class="page-title">
            <h1><?php the_title();?></h1>
        </header>

        <div class="row content"><?php
            the_content();
            
endwhile; // end of the loop. ?>
        </div><!-- .row content -->
    </div><!--/.container -->

<?php get_footer(); ?>
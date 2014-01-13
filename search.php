<?php
/**
 * Search Results Template
 *
 * @package WordPress
 * @subpackage Most
 */
get_header();
    get_sidebar('left'); ?>
        <div id="search-content" class="span6"><?php
            if ( have_posts() ) : ?>
                <h2><?php printf( __('Search Results for: "%s"', 'most'),'<span>' . get_search_query() . '</span>'); ?></h2><?php
                while ( have_posts() ) : the_post(); ?>
                    <div <?php post_class(); ?>>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <h3><?php the_title();?></h3>
                        </a>
                        <span class="muted"><?php the_date(); ?></span>
                        <?php the_excerpt(); ?>
                     </div><!-- /.post_class -->
                     <hr><?php
                endwhile;
            else : ?>
                <h2><?php printf( __('No Results Found for: "%s"', 'most'),'<span>' . get_search_query() . '</span>'); ?></h2>
                    <p class="lead">It seems we can't find what you're looking for. Perhaps you should try again with a different search term.</p>
                    <div class="well">
                        <?php get_search_form(); ?>
                    </div><?php
            endif; ?>
        </div><?php
    get_sidebar('right');
get_footer(); ?>
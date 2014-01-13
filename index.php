<?php
/**
 * Index Template
 * Description: Displays default loop of blog posts.
 *
 * @package WordPress
 * @subpackage Most
 */
get_header();
    get_sidebar('left'); ?>
    <div class="span6"><?php
        if ( have_posts() ) :
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
        endif; ?>
    </div><?php
    get_sidebar('right');
get_footer(); ?>
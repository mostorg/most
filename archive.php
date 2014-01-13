<?php
/**
 * Archive Template
 *
 * @package WordPress
 * @subpackage Most
 */
get_header();
    get_sidebar('left');
    if ( have_posts() ) : the_post(); ?>
        <div class="span6">
            <h2><?php
                if ( is_day() ) :
                    printf( __('Daily Archives: "%s"', 'most'), '<span>' . get_the_date() . '</span>' );
                elseif ( is_month() ) :
                    printf( __('Monthly Archives: "%s"', 'most'), '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'most')) . '</span>' );
                elseif ( is_year() ) :
                    printf( __('Yearly Archives: "%s"', 'most'), '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'most')) . '</span>' );
                elseif ( is_tag() ) :
                    printf( __('Tag Archives: "%s"', 'most'), '<span>' . single_tag_title('', false) . '</span>' );
                elseif ( is_category() ) :
                    printf( __('Category Archives: "%s"', 'most'), '<span>' . single_cat_title('', false) . '</span>' );
                else :
                    _e('Archives', 'most');
                endif; ?>
            </h2><?php
            rewind_posts(); # Rewind the loop back
            while ( have_posts() ) : the_post(); ?>
                <div <?php post_class(); ?>>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <h3><?php the_title();?></h3>
                    </a>
                    <span class="muted"><?php the_date(); ?></span>
                    <?php the_excerpt(); ?>
                 </div><!-- /.post_class -->
                 <hr><?php
            endwhile; ?>
        </div><!-- /.span6 --><?php
    endif;
    get_sidebar('right');
get_footer(); ?>
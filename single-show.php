<?php
/**
 * Post Show Template
 * Description: Post template with a content container and no sidebar.
 *
 * @package WordPress
 * @subpackage Most
 * @todo show days
 */
get_header();
	get_sidebar('left');
	while ( have_posts() ) : the_post();
		$show = get_post_meta(get_the_ID(), 'most_show_meta', true); //var_dump($show); ?>
	    <div class="span6">
	        <h2><?php the_title(); ?></h2><?php
            the_content(); ?>
            <p>Schedule: <?php echo $show['start_date'].' to '.$show['end_date'].' from '.$show['start_time'].' to '.$show['end_time']; ?></p>
	    </div><?php
	endwhile; // end of the loop.
	get_sidebar('right');
get_footer(); ?>
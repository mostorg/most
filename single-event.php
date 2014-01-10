<?php
/**
 * Post Event Template
 * Description: Post template with a content container and no sidebar.
 *
 * @package WordPress
 * @subpackage Most
 * @todo event audience and cost
 */
get_header();
while ( have_posts() ) : the_post();
	$event = get_post_meta(get_the_ID(), 'most_event_meta', true); //var_dump($event); ?>
    <div class="container">
        <h2><?php the_title(); ?></h2>
        <div class="span8"><?php
            the_content(); ?>
            <p>Where: <?php echo $event['location']; ?></p>
            <p>When: <?php echo $event['start_date'].' to '.$event['end_date'].' from '.$event['start_time'].' to '.$event['end_time']; ?></p>
            <p>Who: <?php //switch ?></p>
            <p>How much: <?php //switch ?></p>
        </div><!-- /.span8 -->
    </div><?php
endwhile; // end of the loop.
get_footer(); ?>
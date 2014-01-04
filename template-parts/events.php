<?php
/**
 * Template Part: Events
 *
 * @package Wordpress
 * @subpackage Most
 */
$omni_shows = get_most_shows('Omni','today');
if ( $omni_shows->have_posts() ) : ?>
	<article class="events-today">
		<h4>Omnitheatre Today</h4><?php
		while ( $omni_shows->have_posts() ) : $omni_shows->the_post();
			$show = get_post_meta(get_the_ID(), 'most_show_meta', true); ?>
			<p><span><?php echo $show['start_time']; ?>:</span> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p><?php
		endwhile; ?>
	</article><?php
endif; wp_reset_postdata();

$ed_events = get_most_events(true,'today');
if ( $ed_events->have_posts() ) : ?>
	<article class="events-today">
		<h4>Educational Today</h4><?php
		while ( $ed_events->have_posts() ) : $ed_events->the_post();
			$event = get_post_meta(get_the_ID(), 'most_event_meta', true); ?>
			<p><span><?php echo $event['start_time']; ?>:</span> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php echo $event['location']; ?></p><?php
		endwhile; ?>
	</article><?php
endif; wp_reset_postdata();

$pl_shows = get_most_shows('Planetarium','today');
if ( $pl_shows->have_posts() ) : ?>
	<article class="events-today">
		<h4>Planetarium Today</h4><?php
		while ( $pl_shows->have_posts() ) : $pl_shows->the_post();
			$show = get_post_meta(get_the_ID(), 'most_show_meta', true); ?>
			<p><span><?php echo $show['start_time']; ?>:</span> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p><?php
		endwhile; ?>
	</article><?php
endif; wp_reset_postdata();

$sp_events = get_most_events(false,'today');
if ( $sp_events->have_posts() ) : ?>
	<article class="events-today">
		<h4>Special Events Today</h4><?php
		while ( $sp_events->have_posts() ) : $sp_events->the_post();
			$event = get_post_meta(get_the_ID(), 'most_event_meta', true); ?>
			<p><span><?php echo $event['start_time']; ?>:</span> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php echo $event['location']; ?></p><?php
		endwhile; ?>
	</article><?php
endif; wp_reset_postdata();
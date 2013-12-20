<?php
/**
 * Template Part: Events
 *
 * @package Wordpress
 * @subpackage Most
 */
$omni_shows = new WP_Query( array(
	'post_type' => 'show',
	'posts_per_page' => -1,
	// 'orderby' => 'meta_value_num',
	// 'meta_key' => 'most_show_start_meta',
	// 'order' => 'ASC',
	'meta_query' => array(
		array(
			'key' => 'most_show_start_meta',
			'value' => date('Ymd'), // compare to today
			'compare' => '<=', // check start date in the past
			'type' => 'date'
		),
		array(
			'key' => 'most_show_end_meta',
			'value' => date('Ymd'), // compare to today
			'compare' => '>=', // check end date in the future
			'type' => 'date'
		),
		array(
			'key' => 'most_show_meta',
			'value' => serialize(strval('Omni')),
			'compare' => 'LIKE'
		)
	)
) );
if ( $omni_shows->have_posts() ) : ?>
	<article class="events-today">
		<h4>Omnitheatre Today</h4><?php
		while ( $omni_shows->have_posts() ) : $omni_shows->the_post();
			$show = get_post_meta(get_the_ID(), 'most_show_meta', true); ?>
			<p><span><?php echo $show['start_time']; ?>:</span> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p><?php
		endwhile; ?>
	</article><?php
endif; wp_reset_postdata();
$ed_events = new WP_Query( array(
	'post_type' => 'event',
	'posts_per_page' => -1,
	// 'orderby' => 'meta_value_num',
	// 'meta_key' => 'most_event_start_meta',
	// 'order' => 'ASC',
	'meta_query' => array(
		array(
			'key' => 'most_event_start_meta',
			'value' => date('Ymd'), // compare to today
			'compare' => '<=', // check start date in the past
			'type' => 'date'
		),
		array(
			'key' => 'most_event_end_meta',
			'value' => date('Ymd'), // compare to today
			'compare' => '>=', // check end date in the future
			'type' => 'date'
		),
		array(
			'key' => 'most_event_meta',
			'value' => serialize(strval('Education')),
			'compare' => 'LIKE'
		),
	)
) );
if ( $ed_events->have_posts() ) : ?>
	<article class="events-today">
		<h4>Educational Today</h4><?php
		while ( $ed_events->have_posts() ) : $ed_events->the_post();
			$event = get_post_meta(get_the_ID(), 'most_event_meta', true); ?>
			<p><span><?php echo $event['start_time']; ?>:</span> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> - <?php echo $event['location']; ?></p><?php
		endwhile; ?>
	</article><?php
endif; wp_reset_postdata();
$pl_shows = new WP_Query( array(
	'post_type' => 'show',
	'posts_per_page' => -1,
	// 'orderby' => 'meta_value_num',
	// 'meta_key' => 'most_show_start_meta',
	// 'order' => 'ASC',
	'meta_query' => array(
		array(
			'key' => 'most_show_start_meta',
			'value' => date('Ymd'), // compare to today
			'compare' => '<=', // check start date in the past
			'type' => 'date'
		),
		array(
			'key' => 'most_show_end_meta',
			'value' => date('Ymd'), // compare to today
			'compare' => '>=', // check end date in the future
			'type' => 'date'
		),
		array(
			'key' => 'most_show_meta',
			'value' => serialize(strval('Planetarium')),
			'compare' => 'LIKE'
		),
	)
) );
if ( $pl_shows->have_posts() ) : ?>
	<article class="events-today">
		<h4>Planetarium Today</h4><?php
		while ( $pl_shows->have_posts() ) : $pl_shows->the_post();
			$show = get_post_meta(get_the_ID(), 'most_show_meta', true); ?>
			<p><span><?php echo $show['start_time']; ?>:</span> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p><?php
		endwhile; ?>
	</article><?php
endif; wp_reset_postdata(); ?>
<!-- <article>
	<h4>Category (Special Events) Today</h4>
	<p>Time: Event Title - location</p>
</article> -->
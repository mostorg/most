<?php
/**
 * Front Page Template
 *
 * @package Wordpress
 * @subpackage Most
 */
get_header();
	get_sidebar('left'); ?>
	<section id="front-content" class="span6">
		<h2 id="today-date">Today at the MOST - <?php echo get_todays_date('l, F j, Y'); ?></h2>
		<h3 id="today-hours">Hours of Operation Today: <?php echo get_most_hours(); ?></h3><?php
		$events = get_most_events('all','today');
		$shows = get_most_shows('all','today');
		if ( get_most_hours()=='closed' && $events->found_posts==0 && $shows->found_posts==0 ) :
		 	echo get_most_articles(3);
		elseif ( get_most_hours()=='closed' && ( $events->found_posts>0 || $shows->found_posts>0 ) ) :
			get_template_part('template-parts/events');
		 	echo get_most_articles(1);
		elseif ( get_most_hours()!='closed' && $events->found_posts==0 && $shows->found_posts==0 ) :
		 	echo get_most_articles(1);
		elseif ( get_most_hours()!='closed' && ( $events->found_posts>0 || $shows->found_posts>0 ) ) :
			get_template_part('template-parts/events');
		endif; ?>
	</section><?php
	get_sidebar('right');
get_footer(); ?>
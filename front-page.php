<?php
/**
 * Front Page Template
 *
 * @package Wordpress
 * @subpackage Most
 */
get_header();
?>
<div class="container">
	<aside id="sidebar-left" class="span3"><?php
        wp_nav_menu( array(
            'theme_location' => 'side-menu',
            'container' => 'false',
            'menu_class' => 'nav nav-list',
            'menu_id' => 'side-menu',
            'fallback_cb' => ''
        ) );
        get_sidebar('left'); ?>
	</aside>
	<section id="front-content" class="span6">
		<h2 id="today-date">Today at the MOST - <?php echo get_todays_date('l, F j, Y'); ?></h2>
		<h3 id="today-hours">Hours of Operation Today: <?php echo get_most_hours(); ?></h3><?php
		$events = new WP_Query( array(
			'post_type' => 'event',
			'posts_per_page' => -1,
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
				)
			)
		) );
		$shows = new WP_Query( array(
			'post_type' => 'show',
			'posts_per_page' => -1,
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
				)
			)
		) );
		if ( get_most_hours()=='closed' && ( $events->found_posts==0 || $shows->found_posts==0 ) ) :
		 	echo get_most_articles(3);
		elseif ( get_most_hours()=='closed' && ( $events->found_posts>0 || $shows->found_posts>0 ) ) :
			get_template_part('template-parts/events');
		 	echo get_most_articles(1);
		elseif ( get_most_hours()!='closed' && ( $events->found_posts==0 || $shows->found_posts==0 ) ) :
		 	echo get_most_articles(1);
		elseif ( get_most_hours()!='closed' && ( $events->found_posts>0 || $shows->found_posts>0 ) ) :
			get_template_part('template-parts/events');
		endif; ?>
	</section>
	<aside id="sidebar-right" class="span3 pull-right"><?php
        get_sidebar('right'); ?>
	</aside>
</div><!--/.container-->
<?php
get_footer(); ?>
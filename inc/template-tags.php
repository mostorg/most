<?php
/**
* Custom template tags for this theme.
*
* @package Wordpress
* @subpackage Most
*/

/**
* Tag Globals
* @todo comment this
*/
date_default_timezone_set('America/New_York');

/**
* @todo comment this
*/
function get_todays_date( $format ) {
	return date($format);
}

/**
* @todo comment this
*/
function get_most_hours() {
	$days = get_option('m_days');
	$day = $days[strtolower(date('D'))];
	switch ( $day['status'] ) {
		case 'open':
			return $day['open'].' to '.$day['close'];
			break;
		
		case 'closed':
			return $day['status'];
			break;

		default:
			return $day['status'];
			break;
	}
}

/**
* @todo comment this
*/
function get_most_articles( $num = 1 ) {
	global $post;
	$featured = get_posts( array( 'posts_per_page' => $num ) ); ?>
	<h2>What's New</h2><?php
	foreach ( $featured as $post ) : setup_postdata( $post ); ?>
		<article class="featured-post"><?php
			if ( has_post_thumbnail() ) { ?>
				<div><?php
					the_post_thumbnail('large'); ?>
				</div><?php
			} ?>
			<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
			<span class="muted"><?php the_date(); ?></span><?php
			the_excerpt(); ?>
		</article><?php
	endforeach; wp_reset_postdata();
}
<?php
/**
 * Template Part: Articles
 *
 * @package Wordpress
 * @subpackage Most
 */
$featured = get_posts( array( 'posts_per_page' => 3 ) );
?>

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
endforeach; wp_reset_postdata(); ?>
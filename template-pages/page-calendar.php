<?php
/**
 * Template Name: Calendar Template
 * Description: Displays calendar content without displaying sidebars.
 *
 * @package WordPress
 * @subpackage Most
 */
get_header();
?>
<div class="container"><?php
    while ( have_posts() ) : the_post(); ?>
        <h2><?php the_title(); ?></h2><?php
    endwhile; ?>
    <div id="calendar"></div>
</div><!--/#calendar-->
<?php
get_footer(); ?>
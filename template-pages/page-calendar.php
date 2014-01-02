<?php
/**
 * Template Name: Calendar Template
 * Description: Displays calendar content without displaying sidebars.
 *
 * @package WordPress
 * @subpackage Most
 */
get_header();
$month = date('F');
$monthNum = date('n');
$year = date('Y');
?>
<div class="container"><?php
    while ( have_posts() ) : the_post(); ?>
        <h2><?php the_title(); ?></h2><?php
    endwhile; ?>
    <h3><?php echo $month . ' ' . $year; ?></h3><?php
    echo most_calendar($monthNum,$year);
    //echo most_calendar_controls($monthNum,$year); ?>
</div><!--/#calendar-->
<?php
get_footer(); ?>
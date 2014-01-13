<?php
/**
 * Template Name: Calendar Template
 * Description: Displays calendar content with a left sidebar.
 *
 * @package WordPress
 * @subpackage Most
 */
get_header();
$year = (int) ($_GET['year'] ? $_GET['year'] : date('Y'));
$month = $_GET['month'] ? date('F', mktime(0, 0, 0, $_GET['month'], 1, $year)) : date('F');
$monthNum = (int) ($_GET['month'] ? $_GET['month'] : date('n'));
	get_sidebar('left'); ?>
	<div id="calendar" class="span8"><?php
	    while ( have_posts() ) : the_post(); ?>
	        <h2><?php the_title(); ?></h2><?php
	    endwhile; ?>
	    <h3 class="monthyear"><?php echo $month.' '.$year; ?></h3>
	    <section><?php
	        echo most_calendar($monthNum,$year);
	        echo most_calendar_controls($monthNum,$year); ?>
	    </section>
	</div><!--/#calendar-->
<?php
get_footer(); ?>
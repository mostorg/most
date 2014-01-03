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

/**
* @todo comment this
 */
function get_most_events( $education = 'all', $date = null ) {
	$date = $date=='today' ? date('Ymd') : $date;
	if ( $education ) :
		$event_query = new WP_Query( array(
			'post_type' => 'event',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'most_event_start_meta',
					'value' => $date,
					'compare' => '<=', // check start date in the past
					'type' => 'date'
				),
				array(
					'key' => 'most_event_end_meta',
					'value' => $date,
					'compare' => '>=', // check end date in the future
					'type' => 'date'
				),
				array(
					'key' => 'most_event_meta',
					'value' => serialize(strval('Education')),
					'compare' => 'LIKE'
				)
			)
		) );
	elseif ( !$education ) :
		$event_query = new WP_Query( array(
			'post_type' => 'event',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'most_event_start_meta',
					'value' => $date,
					'compare' => '<=', // check start date in the past
					'type' => 'date'
				),
				array(
					'key' => 'most_event_end_meta',
					'value' => $date,
					'compare' => '>=', // check end date in the future
					'type' => 'date'
				),
				array(
					'key' => 'most_event_meta',
					'value' => serialize(strval('Education')),
					'compare' => 'NOT LIKE'
				)
			)
		) );
	elseif ( $education=='all' ) :
		$event_query = new WP_Query( array(
			'post_type' => 'event',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'most_event_start_meta',
					'value' => $date,
					'compare' => '<=', // check start date in the past
					'type' => 'date'
				),
				array(
					'key' => 'most_event_end_meta',
					'value' => $date,
					'compare' => '>=', // check end date in the future
					'type' => 'date'
				)
			)
		) );
	else :
		return null;
	endif;
	return $event_query;
}

/**
* @todo comment this
 */
function get_most_shows( $type = 'all', $date = null ) {
	$date = $date=='today' ? date('Ymd') : $date;
	if ( $type=='Planetarium' ) :
		$show_query = new WP_Query( array(
			'post_type' => 'show',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'most_show_start_meta',
					'value' => $date,
					'compare' => '<=', // check start date in the past
					'type' => 'date'
				),
				array(
					'key' => 'most_show_end_meta',
					'value' => $date,
					'compare' => '>=', // check end date in the future
					'type' => 'date'
				),
				array(
					'key' => 'most_show_meta',
					'value' => serialize(strval('Planetarium')),
					'compare' => 'LIKE'
				)
			)
		) );
	elseif ( $type=='Omni' ) :
		$show_query = new WP_Query( array(
			'post_type' => 'show',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'most_show_start_meta',
					'value' => $date,
					'compare' => '<=', // check start date in the past
					'type' => 'date'
				),
				array(
					'key' => 'most_show_end_meta',
					'value' => $date,
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
	elseif ( !$type ) :
		$show_query = new WP_Query( array(
			'post_type' => 'show',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'most_show_start_meta',
					'value' => $date,
					'compare' => '<=', // check start date in the past
					'type' => 'date'
				),
				array(
					'key' => 'most_show_end_meta',
					'value' => $date,
					'compare' => '>=', // check end date in the future
					'type' => 'date'
				),
				array(
					'key' => 'most_show_meta',
					'value' => serialize(strval('Planetarium')),
					'compare' => 'NOT LIKE'
				),
				array(
					'key' => 'most_show_meta',
					'value' => serialize(strval('Omni')),
					'compare' => 'NOT LIKE'
				)
			)
		) );
	elseif ( $type=='all' ) :
		$show_query = new WP_Query( array(
			'post_type' => 'show',
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'most_show_start_meta',
					'value' => $date,
					'compare' => '<=', // check start date in the past
					'type' => 'date'
				),
				array(
					'key' => 'most_show_end_meta',
					'value' => $date,
					'compare' => '>=', // check end date in the future
					'type' => 'date'
				)
			)
		) );
	else :
		return null;
	endif;
	return $show_query;
}

/**
 * Creates a calendar.
 */
function most_calendar( $month, $year ) {

    /* open the table */
    $calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

    /* table headings */
    $headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    $calendar .= '<tr class="cal-row"><td class="cal-day-head">'.implode('</td><td class="cal-day-head">',$headings).'</td></tr>';

    /* days and weeks variables */
    $today = date('j');
    $running_day = date('w',mktime(0,0,0,$month,1,$year));
    $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    /* row for week one */
    $calendar .= '<tr class="cal-row">';

    /* print blank days until the first of the current week */
    for ( $x = 0; $x < $running_day; $x++ ) :
        $calendar .= '<td class="cal-day-empty"></td>';
        $days_in_this_week++;
    endfor;

    /* keep going with days.... */
    for ( $list_day = 1; $list_day <= $days_in_month; $list_day++ ) :
	    $date = date('Ymd', strtotime($year.'-'.$month.'-'.$list_day));
        $calendar .= $list_day == $today ? '<td class="cal-day cal-today"><div class="day-container">' : '<td class="cal-day"><div class="day-container">';
            /* add in the day number */
            $calendar .= '<div class="day-number">'.$list_day.'</div>';

            /** query for events/shows that match the day **/
			if ( get_most_events('all',$date)->found_posts>0 || get_most_shows('all',$date)->found_posts>0 ) :
				$calendar .= '<article class="cal-event">';
					# omni shows
					$omni_shows = get_most_shows('Omni',$date);
					if ( $omni_shows->have_posts() ) :
						$calendar .= '<h4>Omnitheatre</h4>';
					endif; wp_reset_postdata();
					# educational events
					$ed_events = get_most_events(true,$date);
					if ( $ed_events->have_posts() ) :
						$calendar .= '<h4>Educational</h4>';
					endif; wp_reset_postdata();
					# planetarium shows
					$pl_shows = get_most_shows('Planetarium',$date);
					if ( $pl_shows->have_posts() ) :
						$calendar .= '<h4>Planetarium</h4>';
					endif; wp_reset_postdata();
					# all other events
					$sp_events = get_most_events(false,$date);
					if ( $sp_events->have_posts() ) :
						$calendar .= '<h4>Special Events</h4>';
					endif; wp_reset_postdata();
				$calendar .= '</article>';
			else :
				$calendar .= str_repeat('<p>&nbsp;</p>',2);
			endif;
            
        $calendar .= '</div></td>';
        if ( $running_day == 6 ) :
            $calendar.= '</tr>';
            if ( ($day_counter+1) != $days_in_month ) :
                $calendar.= '<tr class="cal-row">';
            endif;
            $running_day = -1;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++; $running_day++; $day_counter++;
    endfor;

    /* finish the rest of the blank days in the week */
    if ( $days_in_this_week < 8 ) :
        for ( $x = 1; $x <= (8 - $days_in_this_week); $x++ ) :
            $calendar .= '<td class="cal-day-empty"></td>';
        endfor;
    endif;

    /* final row */
    $calendar .= '</tr>';

    /* end the table */
    $calendar .= '</table>';
    
    /* return result */
    return $calendar;
}

/**
 * Creates calendar controls.
 */
function most_calendar_controls( $month, $year ) {
	/* date settings */
	$month = (int) ($_GET['month'] ? $_GET['month'] : date('m'));
	$year = (int)  ($_GET['year'] ? $_GET['year'] : date('Y'));

	/* select month control */
	$select_month_control = '<select name="month" id="month">';
	for ( $x = 1; $x <= 12; $x++ ) :
		$select_month_control .= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.date('F',mktime(0,0,0,$x,1,$year)).'</option>';
	endfor;
	$select_month_control .= '</select>';

	/* select year control */
	$year_range = 7;
	$select_year_control = '<select name="year" id="year">';
	for ( $x = ($year-floor($year_range/2)); $x <= ($year+floor($year_range/2)); $x++ ) :
		$select_year_control .= '<option value="'.$x.'"'.($x != $year ? '' : ' selected="selected"').'>'.$x.'</option>';
	endfor;
	$select_year_control .= '</select>';

	/* "next month" control */
	$next_month_link = '<a href="?month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1).'" class="control">Next Month >></a>';

	/* "previous month" control */
	$previous_month_link = '<a href="?month='.($month != 1 ? $month - 1 : 12).'&year='.($month != 1 ? $year : $year - 1).'" class="control"><< 	Previous Month</a>';

	/* bringing the controls together */
	$controls = '<form method="get">'.$select_month_control.$select_year_control.'<input type="submit" name="submit" value="Go" />'.$previous_month_link.$next_month_link.'</form>';

	return $controls;
}
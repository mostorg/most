<?php
/**
 * Plugin Name: MOST Events Widget
 * Plugin URI: N/A
 * Description: A widget that allows you to display an event via thumbnail or title.
 * Author: Chelsea M. P. Lorenz
 * Version: 1.0
 * Author URI: http://chelsealorenz.com/
 */

class MOST_Events_Widget extends WP_Widget {

	/**
	* Register widget with WordPress.
	*/
	function __construct() {
		// widget actual processes
		parent::__construct(
			'most_events_widget', // ID
			'MOST Events Widget', // name
			array( 'description' => 'An event with title or thumbnail.' ) // args
		);
	}

	/**
	* Front-end display of widget.
	* @param array $args Widget arguments.
	* @param array $instance Saved values from database.
	*/
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		extract($args);
		echo $before_widget;
			echo $before_title.$instance['title'].$after_title; ?>
			<article class="mew"><?php
				$eID = $instance['event_id'];
				if ($instance['display']=='title') : ?>
					<a href="<?php echo get_permalink($eID); ?>" title="<?php echo get_the_title($eID); ?>">
						<h4><?php echo get_the_title($eID); ?></h4>
					</a><?php
				elseif ($instance['display']=='thumbnail') : ?>
					<a class="mew-thumb" href="<?php echo get_permalink($eID); ?>" title="<?php echo get_the_title($eID); ?>"><?php
						if ( has_post_thumbnail($eID) ) {
							echo get_the_post_thumbnail( $eID, 'widget-thumb' ); ?>
							<h4><?php echo get_the_title($eID); ?></h4><?php
						} else { ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/default.png" alt="Featured Event" />
							<h4><?php echo get_the_title($eID); ?></h4><?php
						} ?>
					</a><?php
				endif; ?>
			</article><?php
		echo $after_widget;
	}

	/**
	* Sanitize widget form values as they are saved.
	* @param array $new_instance Values just sent to be saved.
	* @param array $old_instance Previously saved values from database.
	* @return array Updated safe values to be saved.
	*/
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		return $new_instance;
	}

	/**
	* Back-end widget form.
	* @param array $instance Previously saved values from database.
	*/
	public function form( $instance ) {
		// outputs the options form on admin
		if ( $instance ) {
			$title = esc_attr($instance['title']);
			$id = $instance['event_id'];
			$display = $instance['display'];
		} else {
			$title = 'Featured Event';
			$id = null;
			$display = 'title';
		} ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('event_id'); ?>"><?php _e('Event:'); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id('event_id'); ?>" name="<?php echo $this->get_field_name('event_id'); ?>"><?php
				$events = get_posts( array( 'posts_per_page' => -1, 'post_type' => 'event' ) );
				foreach ( $events as $event ) : ?>
					<option <?php selected( $id, $event->ID ); ?> value="<?php echo $event->ID; ?>"><?php echo $event->post_title; ?></option><?php
				endforeach; ?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('display'); ?>"><?php _e('Display Type:'); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id('display'); ?>" name="<?php echo $this->get_field_name('display'); ?>">
				<option <?php selected( $display, 'title' ); ?> value="title"><?php _e('Title'); ?></option>
				<option <?php selected( $display, 'thumbnail'); ?> value="thumbnail"><?php _e('Thumbnail'); ?></option>
			</select>
		</p><?php
	}

} // class MOST_Events_Widget
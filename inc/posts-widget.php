<?php
/*
Plugin Name: MOST Posts Widget
Plugin URI: 
Description: A widget that allows you to show a post list via thumbnails ordered by random or recent posts with the options of specifying post types and number of posts.
Author: Chelsea M. P. Lorenz
Version: 1.0
Author URI: http://chelsealorenz.me/
*/

class MOST_Posts_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
            // widget actual processes
            parent::__construct(
                    'most_posts_widget', // ID
                    'MOST Posts Widget', // name
                    array( 'description' => 'Lists of posts via thumbnails.' ) // args
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
			<ul class="mpw"><?php
				global $post;
				$args = array( 
					'posts_per_page' => $instance['qty'], 
					'orderby'=> $instance['order'], 
					'post_type' => $instance['type'] 
				);
				$myposts = get_posts( $args );
				foreach( $myposts as $post ) : setup_postdata($post); ?>
					<li><?php 						
						if ( has_post_thumbnail() ) {
							$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');
							$src = $image[0];
						} else {
							$src = get_template_directory_uri().'/img/default.png';
						} ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<img src="<?php echo $src; ?>" alt="<?php the_title('','',FALSE); ?>" />
							<h4><?php the_title(); ?></h4>
						</a>
					</li><?php
				endforeach; wp_reset_postdata(); ?>
			</ul><?php
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
			$qty = esc_attr($instance['qty']);
			$order = $instance['order'];
			$type = $instance['type'];
		} else {
			$title = 'Featured Posts';
			$qty = 3;
			$order = 'rand';
			$type = 'post';
		} ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('qty'); ?>"><?php _e('Number of Posts:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('qty');?>" name="<?php echo $this->get_field_name('qty');?>" type="text" value="<?php echo $qty; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:'); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
				<option <?php echo $order=='rand' ? 'selected' : ''; ?> value="rand"><?php _e('Random'); ?></option>
				<option <?php echo $order=='post_date' ? 'selected' : ''; ?> value="post_date"><?php _e('Recent Posts'); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Post Type:'); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
				<option <?php echo $type=='post' ? 'selected' : ''; ?> value="post"><?php _e('Post'); ?></option>
				<option <?php echo $type=='event' ? 'selected' : ''; ?> value="event"><?php _e('Event'); ?></option>
				<option <?php echo $type=='show' ? 'selected' : ''; ?> value="show"><?php _e('Show'); ?></option>
			</select>
		</p><?php
	}

} // class MOST_Posts_Widget
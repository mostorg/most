<?php
/*
Plugin Name: MOST Posts Widget
Plugin URI: 
Description: Simple Featured Posts is a pratical widget that allows you to show a post list with thumbnails ordered by random or recent posts. You can also choose which post types and how many posts you want to show.
Author: Chelsea M. P. Lorenz
Version: 1.0
Author URI: http://chelsealorenz.com/
*/

class MOST_Posts_Widget extends WP_Widget {
	function sfpWidget() {
		parent::__construct( 
			'most_posts_widget', 
			'MOST Posts Widget',
			array( 'description' => 'Lists of posts with thumbnails ordered by random or post date.' ) 
		);

	}
	function widget( $args, $instance ) {
		extract($args);
		echo $before_widget;
		echo $before_title.$instance['title'].$after_title; ?>
		<ul id='mpw'><?php
			global $post;
			$tmp_post = $post;
			$args = array( 
				'num_posts' => $instance['nPosts'], 
				'order_by'=> $instance['order'], 
				'post_type' => $instance['postType'] 
			);
			$myposts = get_posts( $args );
			foreach( $myposts as $post ) : setup_postdata($post); ?>
				<li><?php 						
					if (has_post_thumbnail()){ //<- check if the post has a Post Thumbnail assigned to it
						$extractUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');
						$imageUrl = $extractUrl[0];
					} else {
						$imageUrl = first_image();
					}
					echo "<a href='".get_permalink()."' title='".get_the_title()."'><img width='".$w."' alt='".the_title('','',FALSE)."'/></a>"; ?>
					<h4><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>
				</li><?php
			endforeach;
			$post = $tmp_post; ?>
		</ul><?php
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}
	function form( $instance ) { //<- set default parameters of widget
		if ($instance) {
			$title = esc_attr($instance['title']);
			$nPosts = esc_attr($instance['nPosts']);
			$order = $instance['order'];
		} else {
			$title = "Featured Posts";
			$nPosts = 5;
			$order = "rand";
		} ?>
		<p>
			<label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title');?>" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php echo $title; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('nPosts');?>"><?php _e('Number of posts to show:'); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id('nPosts');?>" name="<?php echo $this->get_field_name('nPosts');?>" type="text" value="<?php echo $nPosts; ?>"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('order');?>"><?php _e('Order:'); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id('order');?>" name="<?php echo $this->get_field_name('order');?>" type="radio">
				<option value='<?php if($order == "rand"):?>rand<?php else:?>post_date<?php endif?>'><?php if($order == "rand"):?><?php _e('Random'); ?><?php else:?><?php _e('Recent Posts'); ?><?php endif?></option>
				<option value='<?php if($order == "rand"):?>post_date<?php else:?>rand<?php endif?>'><?php if($order == "rand"):?><?php _e('Recent Posts'); ?><?php else:?><?php _e('Random'); ?><?php endif?></option>
			</select>
		</p><?php
	}
}

function first_image() {
	global $post, $posts;
	$first_img = "";
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];

	if(empty($first_img)){ //<- 	Defines a default image
		$first_img = plugin_dir_url(__FILE__)."images/default.png";
	}
		
	return $first_img;
}

function imgSize($img){

	if(strpos($img, "/") == 0){
		$img = substr($img,1);
	}
	
	$size = @getimagesize($img);
	return $size;
}

add_action('wp_head', 'first_image');
add_action('wp_head', 'imgSize');

function sfpw_register() {
	register_widget( 'sfpWidget' );
}
 
add_action( 'widgets_init', 'sfpw_register' );
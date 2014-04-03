<?php
/**
 * Most Admin Theme Functions
 *
 * @package WordPress
 * @subpackage Most
 * @author Chelsea M. P. Lorenz
 */

/**
* Admin Scripts & Styles
*/
function most_admin_styles() {
    wp_enqueue_style( 'admin-css', get_template_directory_uri() . '/admin/admin.css' );
    wp_enqueue_style( 'jquery-css', '//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-ui-datepicker' );
    if (isset($_GET['page']) && $_GET['page'] == 'most-theme-options') {
        wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/admin/bootstrap.min.css' );
        wp_enqueue_script( 'admin-js', get_template_directory_uri() . '/admin/admin.js' );
        wp_enqueue_media();
    }
}
add_action ( 'admin_enqueue_scripts', 'most_admin_styles' );

/**
* Admin Menus
*/
function most_admin_menu() {
    add_theme_page( 'MOST Theme Options', 'Theme Options', 'edit_theme_options', 'most-theme-options', 'most_theme_options' );
}
add_action( 'admin_menu', 'most_admin_menu' );

/**
 * Most Custom Post Types
 */
function most_post_type_init() {
    $event_labels = array(
        'name'                => _x( 'Events', 'Post Type General Name', 'most' ),
        'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'most' ),
        'menu_name'           => __( 'Events', 'most' ),
        'parent_item_colon'   => __( 'Parent Event:', 'most' ),
        'all_items'           => __( 'All Events', 'most' ),
        'view_item'           => __( 'View Event', 'most' ),
        'add_new_item'        => __( 'Add New Event', 'most' ),
        'add_new'             => __( 'New Event', 'most' ),
        'edit_item'           => __( 'Edit Event', 'most' ),
        'update_item'         => __( 'Update Event', 'most' ),
        'search_items'        => __( 'Search events', 'most' ),
        'not_found'           => __( 'No events found', 'most' ),
        'not_found_in_trash'  => __( 'No events found in Trash', 'most' ),
    );
    register_post_type( 'event', array(
        'label'               => __( 'event', 'most' ),
        'description'         => __( 'Event information pages', 'most' ),
        'labels'              => $event_labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
        'taxonomies'          => array( 'category', 'post_tag' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    ) );
    $show_labels = array(
        'name'                => _x( 'Shows', 'Post Type General Name', 'most' ),
        'singular_name'       => _x( 'Show', 'Post Type Singular Name', 'most' ),
        'menu_name'           => __( 'Shows', 'most' ),
        'parent_item_colon'   => __( 'Parent Show:', 'most' ),
        'all_items'           => __( 'All Shows', 'most' ),
        'view_item'           => __( 'View Show', 'most' ),
        'add_new_item'        => __( 'Add New Show', 'most' ),
        'add_new'             => __( 'New Show', 'most' ),
        'edit_item'           => __( 'Edit Show', 'most' ),
        'update_item'         => __( 'Update Show', 'most' ),
        'search_items'        => __( 'Search shows', 'most' ),
        'not_found'           => __( 'No shows found', 'most' ),
        'not_found_in_trash'  => __( 'No shows found in Trash', 'most' ),
    );
    register_post_type( 'show', array(
        'label'               => __( 'show', 'most' ),
        'description'         => __( 'Show information pages', 'most' ),
        'labels'              => $show_labels,
        'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
        'taxonomies'          => array( 'category', 'post_tag' ),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    ) );
}
add_action( 'init', 'most_post_type_init' );

/**
 * Most Widget Areas
 */
function most_widgets_init() {
    require get_template_directory() . '/inc/post-thumbnail-widget.php';
    register_widget( 'MOST_Post_Thumbnail_Widget' );
    require get_template_directory() . '/inc/events-widget.php';
    register_widget( 'MOST_Events_Widget' );

    register_sidebar( array(
        'name'          => __( 'Front Left Sidebar', 'most' ),
        'description'   => __( 'Sidebar located on the left side of the front page template.', 'most' ),
        'id'            => 'front-left-sidebar',
        'class'         => 'sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>' 
    ) );
    register_sidebar( array(
        'name'          => __( 'Front Right Sidebar', 'most' ),
        'description'   => __( 'Sidebar located on the right side of the front page template.', 'most' ),
        'id'            => 'front-right-sidebar',
        'class'         => 'sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>' 
    ) );
    register_sidebar( array(
        'name'          => __( 'Inner Left Sidebar', 'most' ),
        'description'   => __( 'Sidebar located on the left side of all inside page templates.', 'most' ),
        'id'            => 'inner-left-sidebar',
        'class'         => 'sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>' 
    ) );
    register_sidebar( array(
        'name'          => __( 'Inner Right Sidebar', 'most' ),
        'description'   => __( 'Sidebar located on the right side of all insider page templates.', 'most' ),
        'id'            => 'inner-right-sidebar',
        'class'         => 'sidebar',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>' 
    ) );
}
add_action( 'widgets_init', 'most_widgets_init' );

/**
* Most Theme Options
*/
function most_theme_options() { ?>
    <div class="wrap">
        <div id="icon-themes" class="icon32"></div>
        <h2>Theme Options</h2>
        <div id="theme-options-frame" class="metabox-holder">
            <section id="header-options" class="postbox"><?php
                $social = get_option('m_social'); ?>
                <div title="Click to Toggle" class="handlediv"></div>
                <h3 class="hndle"><span>Header Options</span></h3>
                <div class="inside">
                    <p class="howto">Fill in social network handles to link to profiles.</p>
                    <form class="input-prepend">
                        <label for="facebook">
                            <span>Facebook: </span>
                        </label>
                        <span class="add-on">/</span>
                        <input type="text" name="facebook" id="facebook" class="input-medium" placeholder="username" value="<?php echo isset($social['facebook'])&&$social['facebook']!='' ? $social['facebook'] : ''; ?>" />
                        <label for="twitter">
                            <span>Twitter: </span>
                        </label>
                        <span class="add-on">@</span>
                        <input type="text" name="twitter" id="twitter" class="input-medium" placeholder="username" value="<?php echo isset($social['twitter'])&&$social['twitter']!='' ? $social['twitter'] : ''; ?>" />
                    </form>
                </div><!--/.inside-->
            </section><!--/#header-options-->
            <section id="theme-set-options" class="postbox"><?php
                $theme = get_option('m_theme_sets');
                $set = $theme['set']; ?>
                <div title="Click to Toggle" class="handlediv"></div>
                <h3 class="hndle"><span>Theme Set Options</span></h3>
                <div class="inside">
                    <p class="howto">Define three theme sets by inputing the theme name and uploading all three images: icon, header, and body.</p>
                    <form>
                        <label for="theme-set-default" class="inline">
                            <span>Default Set: </span>
                        </label><?php
                        $options = array( '1', '2', '3' );
                        if (!isset($theme['default'])||$theme['default']=='') {
                            $theme['default'] = '1';
                        }
                        foreach( $options as $option ) : ?>
                            <label class="radio inline">
                                <input type="radio" name="theme-set-default" id="theme-set-1" <?php echo ($theme['default'] == $option) ? ' checked="checked"' : ''; ?> value="<?php echo $option; ?>"> <?php echo $option; ?>
                            </label><?php
                        endforeach; ?>
                    </form><br><br>
                    <form class="input-append">
                        <legend>Set 1</legend>
                        <label for="theme-icon-1-src">
                            <span>Icon: </span>
                        </label>
                        <input id="theme-icon-1-src" class="input-large" type="text" value="<?php echo isset($set['1']['icon'] ) ? $set['1']['icon'] : ''; ?>" />
                        <input name="theme-icon-1-src" class="upload-image-button button btn" type="button" value="Upload Image" />
                        <img id="theme-icon-1" src="<?php echo isset($set['1']['icon'] ) ? $set['1']['icon'] : ''; ?>" />
                        <br><br>
                        <label for="theme-header-1-src">
                            <span>Header Image: </span>
                        </label>
                        <input id="theme-header-1-src" class="input-large" type="text" value="<?php echo isset($set['1']['header'] ) ? $set['1']['header'] : ''; ?>" />
                        <input name="theme-header-1-src" class="upload-image-button button btn" type="button" value="Upload Image" />
                        <img id="theme-header-1" src="<?php echo isset($set['1']['header'] ) ? $set['1']['header'] : ''; ?>" />
                        <br><br>
                        <label for="theme-body-1-src">
                            <span>Body Image: </span>
                        </label>
                        <input id="theme-body-1-src" class="input-large" type="text" value="<?php echo isset($set['1']['body'] ) ? $set['1']['body'] : ''; ?>" />
                        <input name="theme-body-1-src" class="upload-image-button button btn" type="button" value="Upload Image" />
                        <img id="theme-body-1" src="<?php echo isset($set['1']['body'] ) ? $set['1']['body'] : ''; ?>" />
                    </form>
                    <form class="input-append">
                        <legend>Set 2</legend>
                        <label for="theme-icon-2-src">
                            <span>Icon: </span>
                        </label>
                        <input id="theme-icon-2-src" class="input-large" type="text" value="<?php echo isset($set['2']['icon'] ) ? $set['2']['icon'] : ''; ?>" />
                        <input name="theme-icon-2-src" class="upload-image-button button btn" type="button" value="Upload Image" />
                        <img id="theme-icon-2" src="<?php echo isset($set['2']['icon'] ) ? $set['2']['icon'] : ''; ?>" />
                        <br><br>
                        <label for="theme-header-2-src">
                            <span>Header Image: </span>
                        </label>
                        <input id="theme-header-2-src" class="input-large" type="text" value="<?php echo isset($set['2']['header'] ) ? $set['2']['header'] : ''; ?>" />
                        <input name="theme-header-2-src" class="upload-image-button button btn" type="button" value="Upload Image" />
                        <img id="theme-header-2" src="<?php echo isset($set['2']['header'] ) ? $set['2']['header'] : ''; ?>" />
                        <br><br>
                        <label for="theme-body-2-src">
                            <span>Body Image: </span>
                        </label>
                        <input id="theme-body-2-src" class="input-large" type="text" value="<?php echo isset($set['2']['body'] ) ? $set['2']['body'] : ''; ?>" />
                        <input name="theme-body-2-src" class="upload-image-button button btn" type="button" value="Upload Image" />
                        <img id="theme-body-2" src="<?php echo isset($set['2']['body'] ) ? $set['2']['body'] : ''; ?>" />
                    </form><br>
                    <form class="input-append">
                        <legend>Set 3</legend>
                        <label for="theme-icon-3-src">
                            <span>Icon: </span>
                        </label>
                        <input id="theme-icon-3-src" class="input-large" type="text" value="<?php echo isset($set['3']['icon'] ) ? $set['3']['icon'] : ''; ?>" />
                        <input name="theme-icon-3-src" class="upload-image-button button btn" type="button" value="Upload Image" />
                        <img id="theme-icon-3" src="<?php echo isset($set['3']['icon'] ) ? $set['3']['icon'] : ''; ?>" />
                        <br><br>
                        <label for="theme-header-3-src">
                            <span>Header Image: </span>
                        </label>
                        <input id="theme-header-3-src" class="input-large" type="text" value="<?php echo isset($set['3']['header'] ) ? $set['3']['header'] : ''; ?>" />
                        <input name="theme-header-3-src" class="upload-image-button button btn" type="button" value="Upload Image" />
                        <img id="theme-header-3" src="<?php echo isset($set['3']['header'] ) ? $set['3']['header'] : ''; ?>" />
                        <br><br>
                        <label for="theme-body-3-src">
                            <span>Body Image: </span>
                        </label>
                        <input id="theme-body-3-src" class="input-large" type="text" value="<?php echo isset($set['3']['body'] ) ? $set['3']['body'] : ''; ?>" />
                        <input name="theme-body-3-src" class="upload-image-button button btn" type="button" value="Upload Image" />
                        <img id="theme-body-3" src="<?php echo isset($set['3']['body'] ) ? $set['3']['body'] : ''; ?>" />
                    </form>
                </div><!--/.inside-->
            </section><!--/#theme-set-options-->
            <section id="front-page-options" class="postbox"><?php
                $days = get_option('m_days'); ?>
                <div title="Click to Toggle" class="handlediv"></div>
                <h3 class="hndle"><span>Front Page Options</span></h3>
                <div class="inside">
                    <p class="howto">Customize the content for the theme's front page.</p>
                    <form class="form-inline">
                        <legend>Hours of Operation</legend>
                        <label for="mon-hours">
                            <span>Monday:</span>
                        </label><?php
                        $mon = $days['mon'];
                        if ( !isset($mon['status']) || $mon['status']=='' ) {
                            $mon['status'] = 'closed';
                        } ?>
                        <label class="radio">
                            <input type="radio" name="mon-hours" value="open" <?php echo $mon['status']=='open' ? 'checked' : ''; ?> /> Open
                        </label>
                        <input type="time" name="mon-hours" id="mon-open" class="input-small" placeholder="8:00 AM" value="<?php echo $mon['open']; ?>" />
                        <span>to</span>
                        <input type="time" name="mon-hours" id="mon-close" class="input-small" placeholder="6:30 PM" value="<?php echo $mon['close']; ?>" />
                        <label class="radio">
                            <input type="radio" name="mon-hours" value="closed" <?php echo $mon['status']=='closed' ? 'checked' : ''; ?> /> Closed
                        </label>
                        <br>
                        <label for="tue-hours">
                            <span>Tuesday:</span>
                        </label><?php
                        $tue = $days['tue'];
                        if ( !isset($tue['status']) || $tue['status']=='' ) {
                            $tue['status'] = 'closed';
                        } ?>
                        <label class="radio">
                            <input type="radio" name="tue-hours" value="open" <?php echo $tue['status']=='open' ? 'checked' : ''; ?> /> Open
                        </label>
                        <input type="time" name="tue-hours" id="tue-open" class="input-small" placeholder="8:00 AM" value="<?php echo $tue['open']; ?>" />
                        <span>to</span>
                        <input type="time" name="tue-hours" id="tue-close" class="input-small" placeholder="6:30 PM" value="<?php echo $tue['close']; ?>" />
                        <label class="radio">
                            <input type="radio" name="tue-hours" value="closed" <?php echo $tue['status']=='closed' ? 'checked' : ''; ?> /> Closed
                        </label>
                        <br>
                        <label for="wed-hours">
                            <span>Wednesday:</span>
                        </label><?php
                        $wed = $days['wed'];
                        if ( !isset($wed['status']) || $wed['status']=='' ) {
                            $wed['status'] = 'closed';
                        } ?>
                        <label class="radio">
                            <input type="radio" name="wed-hours" value="open" <?php echo $wed['status']=='open' ? 'checked' : ''; ?> /> Open
                        </label>
                        <input type="time" name="wed-hours" id="wed-open" class="input-small" placeholder="8:00 AM" value="<?php echo $wed['open']; ?>" />
                        <span>to</span>
                        <input type="time" name="wed-hours" id="wed-close" class="input-small" placeholder="6:30 PM" value="<?php echo $wed['close']; ?>" />
                        <label class="radio">
                            <input type="radio" name="wed-hours" value="closed" <?php echo $wed['status']=='closed' ? 'checked' : ''; ?> /> Closed
                        </label>
                        <br>
                        <label for="thu-hours">
                            <span>Thursday:</span>
                        </label><?php
                        $thu = $days['thu'];
                        if ( !isset($thu['status']) || $thu['status']=='' ) {
                            $thu['status'] = 'closed';
                        } ?>
                        <label class="radio">
                            <input type="radio" name="thu-hours" value="open" <?php echo $thu['status']=='open' ? 'checked' : ''; ?> /> Open
                        </label>
                        <input type="time" name="thu-hours" id="thu-open" class="input-small" placeholder="8:00 AM" value="<?php echo $thu['open']; ?>" />
                        <span>to</span>
                        <input type="time" name="thu-hours" id="thu-close" class="input-small" placeholder="6:30 PM" value="<?php echo $thu['close']; ?>" />
                        <label class="radio">
                            <input type="radio" name="thu-hours" value="closed" <?php echo $thu['status']=='closed' ? 'checked' : ''; ?> /> Closed
                        </label>
                        <br>
                        <label for="fri-hours">
                            <span>Friday:</span>
                        </label><?php
                        $fri = $days['fri'];
                        if ( !isset($fri['status']) || $fri['status']=='' ) {
                            $fri['status'] = 'closed';
                        } ?>
                        <label class="radio">
                            <input type="radio" name="fri-hours" value="open" <?php echo $fri['status']=='open' ? 'checked' : ''; ?> /> Open
                        </label>
                        <input type="time" name="fri-hours" id="fri-open" class="input-small" placeholder="8:00 AM" value="<?php echo $fri['open']; ?>" />
                        <span>to</span>
                        <input type="time" name="fri-hours" id="fri-close" class="input-small" placeholder="6:30 PM" value="<?php echo $fri['close']; ?>" />
                        <label class="radio">
                            <input type="radio" name="fri-hours" value="closed" <?php echo $fri['status']=='closed' ? 'checked' : ''; ?> /> Closed
                        </label>
                        <br>
                        <label for="sat-hours">
                            <span>Saturday:</span>
                        </label><?php
                        $sat = $days['sat'];
                        if ( !isset($sat['status']) || $sat['status']=='' ) {
                            $sat['status'] = 'closed';
                        } ?>
                        <label class="radio">
                            <input type="radio" name="sat-hours" value="open" <?php echo $sat['status']=='open' ? 'checked' : ''; ?> /> Open
                        </label>
                        <input type="time" name="sat-hours" id="sat-open" class="input-small" placeholder="8:00 AM" value="<?php echo $sat['open']; ?>" />
                        <span>to</span>
                        <input type="time" name="sat-hours" id="sat-close" class="input-small" placeholder="6:30 PM" value="<?php echo $sat['close']; ?>" />
                        <label class="radio">
                            <input type="radio" name="sat-hours" value="closed" <?php echo $sat['status']=='closed' ? 'checked' : ''; ?> /> Closed
                        </label>
                        <br>
                        <label for="sun-hours">
                            <span>Sunday:</span>
                        </label><?php
                        $sun = $days['sun'];
                        if ( !isset($sun['status']) || $sun['status']=='' ) {
                            $sun['status'] = 'closed';
                        } ?>
                        <label class="radio">
                            <input type="radio" name="sun-hours" value="open" <?php echo $sun['status']=='open' ? 'checked' : ''; ?> /> Open
                        </label>
                        <input type="time" name="sun-hours" id="sun-open" class="input-small" placeholder="8:00 AM" value="<?php echo $sun['open']; ?>" />
                        <span>to</span>
                        <input type="time" name="sun-hours" id="sun-close" class="input-small" placeholder="6:30 PM" value="<?php echo $sun['close']; ?>" />
                        <label class="radio">
                            <input type="radio" name="sun-hours" value="closed" <?php echo $sun['status']=='closed' ? 'checked' : ''; ?> /> Closed
                        </label>
                        <br>
                    </form>
                </div><!--/.inside-->
            </section><!--/#front-page-options-->
            <section id="footer-options" class="postbox"><?php
                $footer = get_option('m_footer'); ?>
                <div title="Click to Toggle" class="handlediv"></div>
                <h3 class="hndle"><span>Footer Options</span></h3>
                <div class="inside">
                    <p class="howto">Define footer content.</p>
                    <form class="">
                        <label for="address1">
                            <span>Address Line 1: </span>
                        </label>
                        <input type="text" name="address1" id="address1" class="input-large" placeholder="" value="<?php echo isset($footer['address1'])&&$footer['address1']!='' ? $footer['address1'] : ''; ?>" />
                        <br>
                        <label for="address2">
                            <span>Address Line 2: </span>
                        </label>
                        <input type="text" name="address2" id="address2" class="input-large" placeholder="" value="<?php echo isset($footer['address2'])&&$footer['address2']!='' ? $footer['address2'] : ''; ?>" />
                        <br>
                        <label for="address3">
                            <span>City/State/Zip: </span>
                        </label>
                        <input type="text" name="address3" id="address3" class="input-large" placeholder="City, State #####" value="<?php echo isset($footer['address3'])&&$footer['address3']!='' ? $footer['address3'] : ''; ?>" />
                        <br>
                        <label for="phone">
                            <span>Phone Number: </span>
                        </label>
                        <input type="tel" name="phone" id="phone" class="input-large" placeholder="(###) ###-####" value="<?php echo isset($footer['phone'])&&$footer['phone']!='' ? $footer['phone'] : ''; ?>" />
                        <br>
                        <label for="copyright">
                            <span>Copyright Info: </span>
                        </label>
                        <input type="text" name="copyright" id="copyright" class="input-large" placeholder="" value="<?php echo isset($footer['copyright'])&&$footer['copyright']!='' ? $footer['copyright'] : ''; ?>" />
                        <br>
                        <label for="legal">
                            <span>Legal Page: </span>
                        </label><?php
                        wp_dropdown_pages( array(
                            'selected'  => $footer['legal'],
                            'name'      => 'legal'
                        ) ); ?>
                    </form>
                </div><!--/.inside-->
            </section><!--/#footer-options-->
        </div><!--/#theme-options-frame-->
    </div>
    <div>
        <p class="submit">
            <input id="save-changes-btn" name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>">
        </p>
    </div>
    <script>
        jQuery(function($){
            //save all options
            $('#save-changes-btn').click(function(){
                $(this).val('Saving...');
                //get form values individually
                var values = {
                    'm_social': {
                        'facebook': $('#facebook').val(),
                        'twitter': $('#twitter').val()
                    },
                    'm_theme_sets': {
                        'default': $('input[name="theme-set-default"]:checked').val(),
                        'set': {
                            '1': {
                                'icon': $('#theme-icon-1').attr('src'),
                                'header': $('#theme-header-1').attr('src'),
                                'body': $('#theme-body-1').attr('src')
                            },
                            '2': {
                                'icon': $('#theme-icon-2').attr('src'),
                                'header': $('#theme-header-2').attr('src'),
                                'body': $('#theme-body-2').attr('src')
                            },
                            '3': {
                                'icon': $('#theme-icon-3').attr('src'),
                                'header': $('#theme-header-3').attr('src'),
                                'body': $('#theme-body-3').attr('src')
                            }                        
                        }
                    },
                    'm_days': {
                        'mon': {
                            'status': $('input[name="mon-hours"]:checked').val(),
                            'open': $('#mon-open').val(),
                            'close': $('#mon-close').val()
                        },
                        'tue': {
                            'status': $('input[name="tue-hours"]:checked').val(),
                            'open': $('#tue-open').val(),
                            'close': $('#tue-close').val()
                        },
                        'wed': {
                            'status': $('input[name="wed-hours"]:checked').val(),
                            'open': $('#wed-open').val(),
                            'close': $('#wed-close').val()
                        },
                        'thu': {
                            'status': $('input[name="thu-hours"]:checked').val(),
                            'open': $('#thu-open').val(),
                            'close': $('#thu-close').val()
                        },
                        'fri': {
                            'status': $('input[name="fri-hours"]:checked').val(),
                            'open': $('#fri-open').val(),
                            'close': $('#fri-close').val()
                        },
                        'sat': {
                            'status': $('input[name="sat-hours"]:checked').val(),
                            'open': $('#sat-open').val(),
                            'close': $('#sat-close').val()
                        },
                        'sun': {
                            'status': $('input[name="sun-hours"]:checked').val(),
                            'open': $('#sun-open').val(),
                            'close': $('#sun-close').val()
                        }
                    },
                    'm_footer': {
                        'address1': $('#address1').val(),
                        'address2': $('#address2').val(),
                        'address3': $('#address3').val(),
                        'phone': $('#phone').val(),
                        'copyright': $('#copyright').val(),
                        'legal': $('#legal option:selected').val()
                    }
                };
                var data = {
                    action: 'most_theme_options_ajax_action',
                    options: values
                };
                $.post(ajaxurl, data, function( msg ) {
                    if( msg == 'reload' ) {
                        location.reload();
                    } else {
                        $('#save-changes-btn').val( msg );
                    }
                });
            });
        });
    </script>
<?php }

/**
* Saves all most theme options
* @return String 'reload' reloads the parent page if changes need to be shown
*/
function most_theme_options_ajax_action() {
    $return = 'Changes Saved';
    //update options
    foreach( $_POST['options'] as $key => $value ) {
        $changed = update_option( $key, $value );
        if( $changed ) {
            $return = 'reload';
        }
    }
    echo $return;   
    die();
}
add_action( 'wp_ajax_most_theme_options_ajax_action', 'most_theme_options_ajax_action' );

/**
 * Event Meta Box
 */
function most_event_meta ( $post ) { 
	$event = get_post_meta($post->ID, 'most_event_meta', true); ?>
    <form>
        <label for="event_type">Type:</label><?php
        $types = array('Demonstrations', 'Fundraisers', 'Camp-Ins', 'Workshops', 'Speaker Series'); ?>
        <select name="event_type">
            <option value="">Select..</option><?php
            foreach ($types as $type) { ?>
                <option <?php selected( $event['type'], $type ); ?> value="<?php echo $type; ?>"><?php echo $type; ?></option><?php
            } ?>
        </select>
        <br>
        <label for="event_dpt">Department:</label><?php
        $dpts = array('Education', 'Marketing', 'Foundation'); ?>
        <select name="event_dpt">
            <option value="">Select..</option><?php
            foreach ($dpts as $dpt) { ?>
                <option <?php selected( $event['dpt'], $dpt ); ?> value="<?php echo $dpt; ?>"><?php echo $dpt; ?></option><?php
            } ?>
        </select>
        <br>
    	<label for="event_location">Location:</label><?php
        $locations = array('Museum', 'Omni Theatre', 'Planetarium', 'Phase 1 Room', 'Northeast'); ?>
        <select name="event_location">
            <option value="">Select..</option><?php
            foreach ($locations as $location) { ?>
                <option <?php selected( $event['location'], $location ); ?> value="<?php echo $location; ?>"><?php echo $location; ?></option><?php
            } ?>
        </select>
        <br>
        <label for="event_start_date">Start Date:</label>
        <input type="date" name="event_start_date" placeholder="MM/DD/YYYY" value="<?php echo isset($event['start_date']) ? $event['start_date'] : ''; ?>" />
        <label for="event_start_time">Start Time:</label>
        <input type="time" name="event_start_time" placeholder="8:00 AM" value="<?php echo isset($event['start_time']) ? $event['start_time'] : ''; ?>" />
        <br>
        <label for="event_end_date">End Date:</label>
        <input type="date" name="event_end_date" placeholder="MM/DD/YYYY" value="<?php echo isset($event['end_date']) ? $event['end_date'] : ''; ?>" />
        <label for="event_start_time">End Time:</label>
        <input type="time" name="event_end_time" placeholder="8:00 AM" value="<?php echo isset($event['end_time']) ? $event['end_time'] : ''; ?>" />
        <br>
        <label for="event_admission">Admission:</label><?php
        $admissions = array('Free', 'Free w/ Admission', 'Free w/ Membership', 'Cost');
        if ( !isset($event['admission']) || $event['admission']=='' )
            $event['admission'] = 'Cost';
        foreach ($admissions as $admission) { ?>
            <input type="radio" name="event_admission" value="<?php echo $admission; ?>" <?php echo checked( $event['admission'], $admission ); ?> /> <?php echo $admission;
        } ?>
        <span class="append">$</span>
        <input type="number" name="event_cost" placeholder="0.00" value="<?php echo isset($event['cost']) ? $event['cost'] : ''; ?>" />
        <br>
        <label for="event_target_status">Audience:</label>
        <input type="radio" name="event_target_status" value="all" <?php checked( $event['target']['status'], 'all' ); checked( $event['target']['status'], '' ); ?> /> All Ages
        <input type="radio" name="event_target_status" value="type" <?php checked( $event['target']['status'], 'type' ); ?> /> Type
        <select name="event_target_type">
            <option <?php selected( $event['target']['type'], 'age' ); ?> value="age">Age</option>
            <option <?php selected( $event['target']['type'], 'grade' ); ?> value="grade">Grade</option>
        </select>
        <label for="event_target_min" class="sub-label">Min:</label>
        <input type="number" name="event_target_min" value="<?php echo isset($event['target']['min']) ? $event['target']['min'] : ''; ?>" />
        <label for="event_target_max" class="sub-label">Max:</label>
        <input type="number" name="event_target_max" value="<?php echo isset($event['target']['max']) ? $event['target']['max'] : ''; ?>" />
    </form>
    <script type="text/javascript">
        jQuery(function($){
            $( 'input[type="date"]' ).datepicker();
        });
    </script>
<?php }

/**
 * Show Meta Box
 */
function most_show_meta ( $post ) { 
    $show = get_post_meta($post->ID, 'most_show_meta', true); ?>
    <form>
        <label for="show_type">Type:</label><?php
        $types = array('Omni', 'Planetarium'); ?>
        <select name="show_type">
            <option value="">Select..</option><?php
            foreach ($types as $type) { ?>
                <option <?php selected( $show['type'], $type ); ?> value="<?php echo $type; ?>"><?php echo $type; ?></option><?php
            } ?>
        </select>
        <br>
        <label for="show_start_date">Start Date:</label>
        <input type="date" name="show_start_date" placeholder="MM/DD/YYYY" value="<?php echo isset($show['start_date']) ? $show['start_date'] : ''; ?>" />
        <label for="show_start_time">Start Time:</label>
        <input type="time" name="show_start_time" placeholder="8:00 AM" value="<?php echo isset($show['start_time']) ? $show['start_time'] : ''; ?>" />
        <br>
        <label for="show_end_date">End Date:</label>
        <input type="date" name="show_end_date" placeholder="MM/DD/YYYY" value="<?php echo isset($show['end_date']) ? $show['end_date'] : ''; ?>" />
        <label for="show_start_time">End Time:</label>
        <input type="time" name="show_end_time" placeholder="8:00 AM" value="<?php echo isset($show['end_time']) ? $show['end_time'] : ''; ?>" />
        <br>
        <label for="show_schedule[]">Schedule:</label><?php
        $days = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
        foreach ($days as $day) { ?>
            <input type="checkbox" name="show_schedule[]" <?php if (is_array($show['schedule'])) : foreach ($show['schedule'] as $checked) : checked( $checked, $day ); endforeach; endif; ?> value="<?php echo $day; ?>" /><?php echo $day;
        } ?>
    </form>
    <script type="text/javascript">
        jQuery(function($){
            $( 'input[type="date"]' ).datepicker();
        });
    </script>
<?php }

/**
 * Add Meta Boxes
 */
function most_metaboxes() {
    add_meta_box('most-event-meta', 'Event Information', 'most_event_meta', 'event', 'normal');
    add_meta_box('most-show-meta', 'Show Information', 'most_show_meta', 'show', 'normal');
}
add_action( 'admin_init', 'most_metaboxes' );

/**
 * Save Meta Box Values
 */
function most_meta_save( $post_id ) {
	// update event info
	update_post_meta( $post_id, 'most_event_meta', array(
        'type' => $_POST['event_type'],
        'dpt' => $_POST['event_dpt'],
        'location' => $_POST['event_location'],
        'start_date' => $_POST['event_start_date'],
        'start_time' => $_POST['event_start_time'],
        'end_date' => $_POST['event_end_date'],
        'end_time' => $_POST['event_end_time'],
        'admission' => $_POST['event_admission'],
        'cost' => $_POST['event_cost'],
        'target' => array(
            'status' => $_POST['event_target_status'],
            'type' => $_POST['event_target_type'],
            'min' => $_POST['event_target_min'],
            'max' => $_POST['event_target_max']
        )
	) );
    // update event time info
    update_post_meta( $post_id, 'most_event_start_meta', date('Ymd',strtotime($_POST['event_start_date'])) );
    update_post_meta( $post_id, 'most_event_end_meta', date('Ymd',strtotime($_POST['event_end_date'])) );
    // update trip info
    update_post_meta( $post_id, 'most_show_meta', array(
        'type' => $_POST['show_type'],
        'start_date' => $_POST['show_start_date'],
        'start_time' => $_POST['show_start_time'],
        'end_date' => $_POST['show_end_date'],
        'end_time' => $_POST['show_end_time'],
        'schedule' => $_POST['show_schedule']
    ) );
    // update show time info
    update_post_meta( $post_id, 'most_show_start_meta', date('Ymd',strtotime($_POST['show_start_date'])) );
    update_post_meta( $post_id, 'most_show_end_meta', date('Ymd',strtotime($_POST['show_end_date'])) );
}
add_action( 'save_post', 'most_meta_save' );
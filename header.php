<?php
/**
 * Default Page Header
 *
 * @package Wordpress
 * @subpackage Most
 */
// global $set;
// most_theme_set('set-1');
// echo $set;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php wp_title('|', true, 'right'); ?></title>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/ico/favicon.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/ico/apple-touch-icon-144.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/ico/apple-touch-icon-114.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/ico/apple-touch-icon-72.png">
        <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/ico/apple-touch-icon-57.png">
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header>
            <div id="header-wrapper" class="container">
                <a class="brand span3" href="<?php echo site_url(); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php
                    if ( get_header_image()!='' ) { ?>
                        <img src="<?php header_image(); ?>" alt="<?php echo bloginfo('name'); ?>" /><?php
                    } else { ?>
                        <h1><?php echo bloginfo('name'); ?></h1><?php
                    } ?>
                </a>
                <nav id="header-nav" class="navbar pull-right">
                    <span class="pull-left">Quick Links: </span><?php
                    wp_nav_menu( array(
                        'theme_location' => 'quick-menu',
                        'container' => 'false',
                        'menu_class' => 'nav nav-pills',
                        'menu_id' => 'quick-menu',
                        'fallback_cb' => ''
                    ) ); ?>
                    <div id="social-links"><?php 
                        $handle = get_option('m_social'); ?>
                        <a href="http://facebook.com/<?php echo $handle['facebook']; ?>" title="Visit Facebook" target="_blank">
                            <img class="icn" src="<?php echo get_template_directory_uri(); ?>/img/facebook-dark.png" alt="Facebook" />
                            <img class="icn-hover" src="<?php echo get_template_directory_uri(); ?>/img/facebook-active.png" alt="Facebook" />
                        </a>
                        <a href="http://twitter.com/<?php echo $handle['twitter']; ?>" title="Visit Twitter" target="_blank">
                            <img class="icn" src="<?php echo get_template_directory_uri(); ?>/img/twitter-dark.png" alt="Twitter" />
                            <img class="icn-hover" src="<?php echo get_template_directory_uri(); ?>/img/twitter-active.png" alt="Twitter" />
                        </a>
                    </div><?php
                    get_search_form(); ?>
                </nav><!--/.navbar-->
                <div id="login-wrapper"><?php
                    wp_login_form( array(
                        'form_id' => 'login-form',
                        'label_log_in' => __( 'Login' ),
                        'id_username' => 'user-login',
                        'id_password' => 'user-pass',
                        'id_submit' => 'login-submit',
                        'remember' => false
                    ) ); ?>
                </div>
            </div><!--/#header-wrapper-->
        </header>
        <div id="theme-bg" class="tab-content"><?php
            global $theme_set;
            $theme = get_option('m_theme_sets');
            $num = 0;
            foreach ( $theme['set'] as $set ) {
                $num++; ?>
                <div class="tab-pane <?php echo $theme['default']==$num ? 'active' : ''; ?>" id="set-<?php echo $num; ?>">
                    <img class="header-img" src="<?php echo $set['header']; ?>" alt="Theme Set <?php echo $num; ?>" />
                    <img class="body-img" src="<?php echo $set['body']; ?>" alt="Theme Set <?php echo $num; ?>" />
                </div><?php
            } ?>
        </div>
        <nav id="theme-bar" class="tabbable tabs-left">
            <?php echo $theme_set; ?>
            <ul class="nav nav-tabs"><?php
                $num = 0;
                foreach ( $theme['set'] as $set ) { $num++; ?>
                    <li class="<?php echo $theme['default']==$num ? 'active' : ''; ?>" onClick="<?php //most_theme_set('set-'.$num); ?>">
                        <a href="#set-<?php echo $num; ?>" data-toggle="tab" title="Theme Set <?php echo $num; ?>">
                            <img src="<?php echo $set['icon']; ?>" alt="Theme Set <?php echo $num; ?>" />
                        </a>
                    </li><?php
                } ?>
            </ul>
        </nav>
        <!-- End Header. Begin Template Content -->
        <div id="main">
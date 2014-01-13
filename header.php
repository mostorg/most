<?php
/**
 * Default Page Header
 *
 * @package Wordpress
 * @subpackage Most
 */
global $current_user;
get_currentuserinfo();
$handle = get_option('m_social');
$theme = get_option('m_theme_sets');
$selected_set = get_option('selected_theme_set');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php wp_title('|', true, 'right'); ?></title>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/ico/moststar.ico" />
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/ico/moststar-57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/ico/moststar-72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/ico/moststar-114.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/ico/moststar-144.png" />
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <header>
            <div id="header-wrapper" class="container">
                <a class="brand span3" href="<?php bloginfo('url'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php
                    if ( get_header_image()!='' ) { ?>
                        <img src="<?php header_image(); ?>" alt="<?php bloginfo('name'); ?>" /><?php
                    } else { ?>
                        <h1><?php bloginfo('name'); ?></h1><?php
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
                    <div id="social-links">
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
                    if ( is_user_logged_in() ) { ?>
                        <p id="user-welcome">Welcome, <?php echo $current_user->user_login; ?>! <a id="logout-submit" href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Logout</a></p><?php
                    } else {
                        wp_login_form( array(
                            'form_id' => 'login-form',
                            'label_log_in' => __( 'Login' ),
                            'id_username' => 'user-login',
                            'id_password' => 'user-pass',
                            'id_submit' => 'login-submit',
                            'remember' => false
                        ) );
                    } ?>
                </div>
            </div><!--/#header-wrapper-->
        </header>
        <div id="theme-bg" class="tab-content"><?php
            $num = 0;
            $selected = isset($selected_set) ? $selected_set : $theme['default'];
            foreach ( $theme['set'] as $set ) : $num++; ?>
                <div class="tab-pane <?php echo $selected=='set-'.$num ? 'active' : ''; ?>" id="set-<?php echo $num; ?>">
                    <img class="header-img" src="<?php echo $set['header']; ?>" alt="Theme Set <?php echo $num; ?>" />
                    <img class="body-img" src="<?php echo $set['body']; ?>" alt="Theme Set <?php echo $num; ?>" />
                </div><?php
            endforeach; ?>
        </div>
        <nav id="theme-bar" class="tabbable tabs-left">
            <ul class="nav nav-tabs"><?php
                $num = 0;
                foreach ( $theme['set'] as $set ) : $num++; ?>
                    <li class="theme-sets <?php echo $selected=='set-'.$num ? 'active' : ''; ?>" data-set="set-<?php echo $num; ?>">
                        <a href="#set-<?php echo $num; ?>" data-toggle="tab" title="Theme Set <?php echo $num; ?>">
                            <img src="<?php echo $set['icon']; ?>" alt="Theme Set <?php echo $num; ?>" />
                        </a>
                    </li><?php
                endforeach; ?>
            </ul>
        </nav>
        <!-- End Header. Begin Template Content -->
        <section id="main" class="container">
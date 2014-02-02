<?php
/**
 * Default Footer
 *
 * @package WordPress
 * @subpackage Most
 */
$footer = get_option('m_footer');
?>
            </div><!--/.row-->
        </section><!--/#main-->
        <footer>
            <div class="container"><?php
                wp_nav_menu( array(
                    'theme_location' => 'footer-menu',
                    'container' => 'false',
                    'menu_class' => 'nav nav-list clearfix',
                    'menu_id' => 'footer-menu',
                    'fallback_cb' => ''
                ) ); ?>
                <article id="footer-content"><?php
                    if ($footer['address1']!='') { ?>
                        <p id="address1"><?php echo $footer['address1']; ?></p><?php
                    }
                    if ($footer['address2']!='') { ?>
                        <p><?php echo $footer['address2']; ?></p><?php
                    }
                    if ($footer['address3']!='') { ?>
                        <p><?php echo $footer['address3']; ?></p><?php
                    }
                    if ($footer['phone']!='') { ?>
                        <p>Phone: <?php echo $footer['phone']; ?></p><?php
                    }
                    if ($footer['copyright']!='') { ?>
                        <p id="copyright"><?php
                            echo $footer['copyright']; ?>
                            - <a href="<?php echo get_permalink( $footer['legal'] ); ?>"><?php echo get_the_title($footer['legal']); ?></a>
                        </p><?php
                    } ?>
                </article>
            </div><!-- /container -->
        </footer><?php
        wp_footer(); ?>
    </body>
</html>
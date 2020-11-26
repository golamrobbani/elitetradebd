<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package themeplate
 */

$facebook_url  = themeplate_get_settings( 'facebook_url' );
$twitter_url   = themeplate_get_settings( 'twitter_url' );
$vimeo_url     = themeplate_get_settings( 'vimeo_url' );
$youtube_url   = themeplate_get_settings( 'youtube_url' );
$rss_url       = themeplate_get_settings( 'rss_url' );
$footer_notice = themeplate_get_settings( 'footer_notice' );
$copy_right    = themeplate_get_settings( 'copy_right' );
?>



<section class="footer-widget-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <?php if ( is_active_sidebar( 'footer-left-widget' ) ) {
                    dynamic_sidebar( 'footer-left-widget' );
                } ?>
            </div>

            <div class="col-md-4">
                <?php if ( is_active_sidebar( 'footer-center-widget' ) ) {
                    dynamic_sidebar( 'footer-center-widget' );
                } ?>
            </div>

            <div class="col-md-4">
                <?php if ( is_active_sidebar( 'footer-right-widget' ) ) {
                    dynamic_sidebar( 'footer-right-widget' );
                } ?>

                <div class="footer-social-icon">
                    <?php

                    if ( ! empty( $facebook_url ) ) {
                        ?>
                        <a href="<?php echo $facebook_url ?>" title="Facebook"><i class="fa fa-facebook"></i></a>
                        <?php }

                        if ( ! empty( $twitter_url ) ) {
                            ?>
                            <a href="<?php echo $twitter_url; ?>" title="Twitter"><i class="fa fa-twitter"></i></a>
                            <?php
                        }

                        if ( ! empty( $vimeo_url ) ) {
                            ?>
                            <a href="<?php echo $vimeo_url ?>" title="Vimeo"><i class="fa fa-vimeo"></i></a>
                            <?php
                        }

                        if ( ! empty( $youtube_url ) ) {
                            ?>
                            <a href="<?php echo $youtube_url ?>" title="Youtube"><i class="fa fa-youtube"></i></a>
                            <?php
                        }

                        if ( ! empty( $rss_url ) ) {
                            ?>
                            <a href="<?php echo $rss_url ?>" title="Rss"><i class="fa fa-rss"></i></a>
                            <?php
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-area">
        <div class="footer-notice">
            <?php
            if ( ! empty( $footer_notice ) ) { ?>
                <p><?php echo $footer_notice ?></p>
                <?php }
                ?>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-menu-area text-center">
                            <?php
                            wp_nav_menu( array(
                                'theme_location' => 'footer_menu',
                                'fallback_cb'    => 'wp_page_menu',
                                'container'      => 'nav'
                            ) );
                            ?>
                        </div>

                        <div class="footer-copyright-text">
                            <?php
                            if ( ! empty( $copy_right ) ) { ?>
                                <p class="text-center"><?php echo $copy_right ?></p>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </footer><!-- #colophon -->

    </div><!-- #page -->

    <?php wp_footer(); ?>

</body>
</html>


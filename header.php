<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package themeplate
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<meta name="google-site-verification" content="Hbjk1ijgD4IzLHy5F6A3vdb9cKCC4c0uYZHTNLCraIs" />
	<?php if( is_single()){
	global $post; ?>
 <meta property="og:image" content="<?php echo get_the_post_thumbnail_url($post) ?> />
	
	<?php } ?>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

	<header class="header-area">
	
		
		<div class="container-fluid">

			<div class="row toolbar-area">
						<div class="col-md-6">
							<div class="t-info">
								<span><i class="fa fa-phone"></i>&nbsp;&nbsp;+8801711-196910</span>
								<span><i class="fa fa-envelope"></i>&nbsp;&nbsp;elitetradebd@gmail.com</span>
							</div>
						</div>
						<div class="col-md-6">
		                <div class="t-social pull-right">
		                	<div class="footer-social-icon">
		                    <?php
							/*$facebook_url  = themeplate_get_settings( 'facebook_url' );
							$twitter_url   = themeplate_get_settings( 'twitter_url' );
							$vimeo_url     = themeplate_get_settings( 'vimeo_url' );
							$youtube_url   = themeplate_get_settings( 'youtube_url' );
							$rss_url       = themeplate_get_settings( 'rss_url' );
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
		                        }*/

		                        ?>
		                    </div>
		                </div>
						</div>
					</div>
			

			<div class="row">
				<div class="col-md-4 col-xs-8">
					<div class="site-logo">
						<?php the_custom_logo(); ?>
					</div>
				</div>
				<div class="col-md-8 col-xs-4">
					<div class="chart-search-icon pull-right hidden-xs">
						<a href="<?php echo edd_get_checkout_uri(); ?>" class="edd-cart-icon"><i
								class="fa fa-shopping-cart"></i>&nbsp;<span><?php echo edd_get_cart_quantity(); ?></span></a>
						<a href="#" class="header-search-icon"><i class="fa fa-search"></i></a>
						<div class="header-search-form">
							<form method="get" id="searchform" action="<?php echo home_url(); ?>/">
								<input type="text" value="" name="s" id="s"/>
								<button type="SUBMIT" id="searchsubmit"><i class="fa fa-search"></i></button>
								<input type="hidden" name="post_type" value="download">
							</form>
						</div>
					</div>
					<div class="mobile_menu pull-right"></div>
					<div class="main-menu pull-right">
						<?php
						wp_nav_menu( array(
							'theme_location' => 'main_menu',
							'menu_id'        => 'nav',
							'fallback_cb'    => 'wp_page_menu',
							'container'      => 'nav'
						) );
						?>
					</div>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->

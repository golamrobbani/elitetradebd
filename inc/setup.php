<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @package themeplate
 */
if ( ! isset( $content_width ) ) {
	$content_width = 780; /* pixels */
}

if ( ! function_exists( 'themeplate_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function themeplate_setup() {
		load_theme_textdomain( 'themeplate', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		register_nav_menus( array(
			'main_menu'   => esc_html__( 'Header Main Menu', 'themeplate' ),
			'listing_menu'   => esc_html__( 'Header Listing Menu', 'themeplate' ),
			'footer_menu' => esc_html__( 'Footer Menu', 'themeplate' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		add_theme_support( "post-thumbnails" );

		//thumbnails size
		add_image_size( 'widget-post-thumb', 55, 55, true );
		add_image_size( 'product-small-thumb', 142, 142, true );
		add_image_size( 'product-medium-thumb', 238, 238, true );
		add_image_size( 'product-slider-thumb', 988, 344, true );

		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
		) );

		add_theme_support( 'custom-background', apply_filters( 'themeplate_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'custom-logo' );

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
	}
endif; // themeplate_setup
add_action( 'after_setup_theme', 'themeplate_setup' );

/**
 * Adding the Read more link to excerpts
 */
function custom_excerpt_more( $more ) {
	return '';
}

add_filter( 'excerpt_more', 'custom_excerpt_more' );

/* Adds a custom read more link to all excerpts, manually or automatically generated */
function all_excerpts_get_more_link( $post_excerpt ) {

	return $post_excerpt . '...';
}

add_filter( 'wp_trim_excerpt', 'all_excerpts_get_more_link' );

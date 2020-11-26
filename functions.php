<?php

/**
 * themeplate functions and definitions
 *
 * @package themeplate
 */
/**
 * Theme setup and custom theme supports.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/custom-comments.php';

/**
 * Shortcode
 */
require get_template_directory() . '/inc/class-shortcode.php';

/**
 * Custom Post Type
 */
require get_template_directory() . '/inc/class-custom-post-types.php';

/**
 * custom-metabox
 */
require get_template_directory() . '/inc/class-custom-metabox.php';

/**
 * term custom-metabox
 */
require get_template_directory() . '/inc/class-custom-term-metabox.php';

/**
 * Theme-option
 */
require get_template_directory() . '/inc/theme-option/class-settings.php';

/**
 * Load custom WordPress nav walker.
 */
require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/load-more-function.php';



/**
 * License Handler.
 */
if ( class_exists( 'EDD_Software_Licensing' ) ) {
	require get_template_directory() . '/inc/class-license.php';
}

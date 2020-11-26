<?php
/**
 * Declaring widgets
 *
 *
 * @package themeplate
 */
function themeplate_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'themeplate' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'themeplate' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Left Widgets', 'themeplate' ),
		'id'            => 'footer-left-widget',
		'description'   => esc_html__( 'Add widgets here.', 'themeplate' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Center Widgets', 'themeplate' ),
		'id'            => 'footer-center-widget',
		'description'   => esc_html__( 'Add widgets here.', 'themeplate' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Right Widgets', 'themeplate' ),
		'id'            => 'footer-right-widget',
		'description'   => esc_html__( 'Add widgets here.', 'themeplate' ),
		'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}

add_action( 'widgets_init', 'themeplate_widgets_init' );

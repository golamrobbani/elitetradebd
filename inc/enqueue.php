<?php
/**
 * themeplate enqueue scripts
 *
 * @package themeplate
 */


function themeplate_scripts() {
	$version = defined('WP_DEBUG')? time(): '1.0.0';

	wp_enqueue_style( 'Montserrat-OpenSans', '//fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700|Open+Sans:400,400i,600,700', array() );
	
    wp_enqueue_style( 'themeplate-styles', get_stylesheet_directory_uri() . '/assets/css/theme.css', array(), $version);
     wp_enqueue_style( 'style-css', get_stylesheet_uri() );

    wp_enqueue_script( 'themeplate-scripts', get_template_directory_uri() . '/assets/js/theme.min.js', array('jquery','wp-util'), $version, true );
    
    wp_enqueue_script( 'custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('jquery','wp-util'), $version, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'themeplate_scripts' );

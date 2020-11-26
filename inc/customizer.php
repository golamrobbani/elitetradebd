<?php
/**
 * themeplate Theme Customizer
 *
 * @package themeplate
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function themeplate_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

}
add_action( 'customize_register', 'themeplate_customize_register' );

function themeplate_theme_customize_register( $wp_customize ) {

    $wp_customize->add_section( 'themeplate_theme_slider_options', array(
        'title'          => __( 'Slider Settings', 'themeplate' )
    ) );

    $wp_customize->add_setting( 'themeplate_theme_slider_count_setting', array(
        'default'        => '1',
        'sanitize_callback' => 'absint'
    ) );

    $wp_customize->add_control( 'themeplate_theme_slider_count', array(
        'label'      => __( 'Number of slides displaying at once', 'themeplate' ),
        'section'    => 'themeplate_theme_slider_options',
        'type'       => 'text',
        'settings'   => 'themeplate_theme_slider_count_setting'
    ) );

    $wp_customize->add_setting( 'themeplate_theme_slider_time_setting', array(
        'default'        => '5000',
        'sanitize_callback' => 'absint'
    ) );

    $wp_customize->add_control( 'themeplate_theme_slider_time', array(
        'label'      => __( 'Slider Time (in ms)', 'themeplate' ),
        'section'    => 'themeplate_theme_slider_options',
        'type'       => 'text',
        'settings'   => 'themeplate_theme_slider_time_setting'
    ) );

    $wp_customize->add_control( 'logo_url', array(
        'label'      => __( 'Logo URL', 'themeplate' ),
        'section'    => 'themeplate_theme_slider_options',
        'type'       => 'url',
        'settings'   => 'themeplate_theme_slider_time_setting'
    ) );
}
add_action( 'customize_register', 'themeplate_theme_customize_register' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function themeplate_customize_preview_js() {
	wp_enqueue_script( 'themeplate_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'themeplate_customize_preview_js' );

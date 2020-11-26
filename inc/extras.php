<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package themeplate
 */
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

function themeplate_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	return $classes;
}
add_filter( 'body_class', 'themeplate_body_classes' );

// Check Option Data
function themeplate_get_settings( $key, $default = '', $section = 'cd_footer_settings' ) {
	$option = get_option( $section, [] );

	return ! empty( $option[ $key ] ) ? $option[ $key ] : $default;
}

//pagination bar
function pagination_bar( $custom_query ) {

    $total_pages = $custom_query->max_num_pages;
    $big = 999999999; // need an unlikely integer

    if ($total_pages > 1){
        $current_page = max(1, get_query_var('paged'));

        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
}

//social media share option
function wdp_get_share_link($post_id, $type){
    switch ($type){
        case 'facebook';
        return add_query_arg([
            'u' => get_the_permalink($post_id),
            'title' => wp_trim_words(get_the_title($post_id),5),
            'images'=>wp_trim_words(get_the_post_thumbnail($post_id,'large'),20),
        ],'http://www.facebook.com/sharer.php');
        break;
        case 'twitter';
        return add_query_arg([
            'url' => get_the_permalink($post_id),
            'title' => wp_trim_words(get_the_title($post_id),5),
        ],'http://twitter.com/share');
        break;

        case 'email';
        return add_query_arg([
            'subject' => "I wanted you to see this site&amp",
            'body' => 'body=Check out this site '.get_the_permalink($post_id),
        ],'mailto:');
        break;
    }
}


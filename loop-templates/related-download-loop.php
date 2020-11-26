<?php
    global $post;
    $id = get_the_ID();
    $customTaxonomyTerms = wp_get_object_terms( $id, 'download_category', array( 'fields' => 'ids' ) );

    $args = array(
        'post_type'      => 'download',
        'post_status'    => 'publish',
        'posts_per_page' => 4,
        'orderby'        => 'rand',
        'tax_query'      => array(
            array(
                'taxonomy' => 'download_category',
                'field'    => 'id',
                'terms'    => $customTaxonomyTerms
            )
        ),
        'post__not_in'   => array( $id )
    );

    $relatedPosts = new WP_Query( $args );

    if ( $relatedPosts->have_posts() ) {
        while ( $relatedPosts->have_posts() ) {
            $relatedPosts->the_post();

            get_template_part( 'loop-templates/content-related-download' );

        }
        wp_reset_postdata();
    }

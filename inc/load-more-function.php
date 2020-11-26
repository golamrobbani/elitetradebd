<?php
function ctmirror_get_load_more_button( $args, $append_to ) {
	$args = wp_parse_args( $args, array(
		'posts_per_page' => 5,
		'offset'         => 0,
		'category'       => '',
		'category_name'  => '',
		'orderby'        => 'date',
		'order'          => 'DESC',
		'include'        => '',
		'exclude'        => '',
		'meta_key'       => '',
		'meta_value'     => '',
		'post_type'      => 'download',
		'post_mime_type' => '',
		'post_parent'    => '',
		'author'         => '',
		'author_name'    => '',
		'post_status'    => 'publish',
	) );

	echo '<a href="#" class="load-more-posts-btn" data-appendto="' . $append_to . '" data-query="' . esc_js( json_encode( $args ) ) . '">Load More</a>';
}

add_action( 'wp_ajax_ctmirror_get_more_posts', 'ctmirror_get_more_posts' );
add_action( 'wp_ajax_nopriv_ctmirror_get_more_posts', 'ctmirror_get_more_posts' );

function ctmirror_get_more_posts() {
	$posts = get_posts( $_REQUEST );
	ob_start();
	if ( ! empty( $posts ) ) {
		foreach ( $posts as $post ) {
			setup_postdata($post);
			$price=get_post_meta($post->ID, 'edd_price', true);
				$product_tags = get_the_terms( $post->ID, 'download_tag' );
				if ( ! empty( $product_tags ) && ! is_wp_error( $product_tags ) ) {
					$tags = wp_list_pluck( $product_tags, 'name' );
				}
			?>
			<div class="col-md-2">
					<a class="product-card adjust_small_post_height" href="<?php echo get_the_permalink($post); ?>">  
						<div class="product-card-img">
							<?php echo get_the_post_thumbnail( $post,'product-small-thumb' ); ?>
							
						</div>
						<div class="product-card-content">
							<div class="product-card-title"><?php echo get_the_title($post); ?></div>
							<div class="product-card-brand">
								<?php
								$counter = 1;
								foreach ( $tags as $tag ) {
									echo $tag;
									echo ($counter < count($tags))? "," : "";
									$counter++;
								}?>
							</div>
							<div class="product-card-price">
								<span class="price"><?php echo '৳'.$price ?></span>
							</div>
						</div>
					</a>
				</div>
            
			<?php
		}
	}
	$html = ob_get_contents();
	ob_get_clean();
	$query           = $_REQUEST;
	$query['offset'] = intval( $query['offset'] ) + $query['posts_per_page'];
	wp_send_json_success( [
		'query' => $query,
		'posts' => $html,
	] );
}
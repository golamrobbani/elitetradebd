<?php
/**
 * @package themeplate
 */
?>
<?php
global $post;
$post_args     = array(
	'posts_per_page' => 24,
	'post_type' => 'download'
);
$posts = get_posts( $post_args );
?>

<div class="etbd-product-type">
	<div class="etbd-product-type-header no-border">
		<h3 class="etbd-product-type-title">Just For You</h3>
	</div>
	<div class="etbd-edproduct-type-body category_grid_post">
		<div class="row">

			<?php 
			foreach ( $posts as $post ) {
				setup_postdata( $post ); 
				$price=get_post_meta($post->ID, 'edd_price', true);
				$product_tags = get_the_terms( $post->ID, 'download_tag' );
				if ( ! empty( $product_tags ) && ! is_wp_error( $product_tags ) ) {
					$tags = wp_list_pluck( $product_tags, 'name' );
				}
				?>
				<div class="col-md-2">
					<a class="product-card adjust_small_post_height" href="<?php echo get_the_permalink(); ?>">  
						<div class="product-card-img">
							<?php 
							the_post_thumbnail('product-small-thumb');
							?>
						</div>
						<div class="product-card-content">
							<div class="product-card-title"><?php echo get_the_title(); ?></div>
							<div class="product-card-brand">
								<?php
								if (!empty($tags)) {
									$counter = 1;
									foreach ( $tags as $tag ) {
										echo $tag;
										echo ($counter < count($tags))? "," : "";
										$counter++;
									}
								}
								?>
							</div>
							<div class="product-card-price">
								<span class="price"><?php echo '৳'.$price ?></span>
							</div>
						</div>
					</a>
				</div>
				<?php } wp_reset_postdata();?>

			</div>


			<?php ctmirror_get_load_more_button( array(
				'posts_per_page'   => 24,
				'offset'           => 24,
				'post_type'        => 'download',
				'post_status'      => 'publish',
				'orderby'          => 'publish_date',
				'order'            => 'DESC',
			), '.category_grid_post' ); ?>


		</div>
	</div>





<?php
/**
 * @package themeplate
 */
?>
<?php
global $post;
$post_args     = array(
	'posts_per_page' => $limit,
	'post_type' => $type,
	'tax_query' => array(
		array(
			'taxonomy' => 'download_category',
			'field' => 'slug',
			'terms' => $cat
		)
	)
);
$posts = get_posts( $post_args );


//var_dump($posts);



$cat_id = get_cat_ID($cat);
$category_link = get_category_link($cat_id);
?>

<div class="etbd-product-type">
	<div class="etbd-product-type-header  clearfix">
		<div class="product-type-status pull-left"><?php if (!empty($title)) echo $title; else echo $cat; ?></div>
		<div class="pull-right"><a class="button" href="<?php echo esc_url($category_link); ?>">Shop all <?php echo $cat; ?> <span><i class="fa fa-angle-right"></i></span></a></div>
	</div>
	<div class="etbd-edproduct-type-body">
		<div class="row">

			<?php 
			foreach ( $posts as $post ) : 
				setup_postdata( $post ); 
				$price=get_post_meta($post->ID, 'edd_price', true);
				$product_tags = get_the_terms( $post->ID, 'download_tag' );
				if ( ! empty( $product_tags ) && ! is_wp_error( $product_tags ) ) {
					$tags = wp_list_pluck( $product_tags, 'name' );
				}
				?>
				<div class="col-md-<?php echo $column;?>">
					<a class="product-card adjust_small_post_height" href="<?php echo get_the_permalink(); ?>">  
						<div class="product-card-img">
							<?php 
							if ($column>2) the_post_thumbnail('product-medium-thumb');else the_post_thumbnail('product-small-thumb');
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
			<?php endforeach; 
			wp_reset_postdata();?>
		</div>
	</div>
</div>





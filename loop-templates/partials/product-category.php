<?php
/**
 * @package themeplate
 */
?>
<?php 
$product_categories = get_terms( 'download_category', array(
	'hide_empty' => true,
) );

//var_dump($product_categories);

if ( ! empty( $product_categories )){
	$p_categories = wp_list_pluck( $product_categories, 'name', 'term_id' ); 
}
?>

<div class="etbd-product-type">
	<div class="etbd-product-type-header no-border">
		<h3 class="etbd-product-type-title">Category</h3>
	</div>
	<div class="etbd-edproduct-type-body">
		<div class="row">

			<?php 
			if (isset($p_categories)) {
				
				foreach ( $p_categories as $term_id => $p_category ) {
					$category_link = get_term_link($term_id,'download_category');
					?>


					<div class="col-md-2">
						<a class="product-card adjust_small_post_height" href="<?php echo esc_url($category_link); ?>">  
							<div class="product-card-img">
								<?php 
								$category_image_link   = get_term_meta( $term_id, '_category_image', true);
								if (!empty($category_image_link)) { ?>
									<img src="<?php echo $category_image_link;?>" alt="category image">
									<?php } ?>
								</div>
								<div class="product-card-content">
									<div class="product-card-title"><?php echo $p_category; ?></div>
								</div>
							</a>
						</div>



						<?php } 

					}
					?>
				</div>
			</div>
		</div>






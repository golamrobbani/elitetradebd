<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package themeplate
 */

?>

<div class="single-product clearfix">
	<div class="col-md-5">
		<div class="themeplate-featured-image">
			<div class="slider slider-for">
				<div class="themeplate-pic-gallary"><img src="<?php echo get_the_post_thumbnail_url(); ?>"></div>
				<?php
				$id     = get_the_ID();
				$images = get_post_meta( $id, '_chartdynamix_files', true );
				if ( ! empty( $images ) ) :
					foreach ( $images as $image ) {
						?>
						<div class="themeplate-pic-gallary"><img src="<?php echo $image; ?>"></div>
					<?php }
				endif;
				?>
			</div>
		</div>

		<?php if ( ! in_array('', $images) ): ?>
			<div class="slider slider-nav">
				<div class="themeplate-smaller-image">
					<?php the_post_thumbnail( 'large' ); ?>
				</div>
				<?php foreach ( $images as $image ) { ?>
					<div class="themeplate-smaller-image adjust_recommand_post_height"><img src="<?php echo $image; ?>"></div>
				<?php } ?>
			</div>
		<?php endif; ?>
	</div>

	<div class="col-md-6">
		<div class="single-product-content-wrapper">
			<?php
			the_title( '<h2 class="product-title">', '</h2>' );

			if ( function_exists( 'edd_price' ) ) { ?>
				<div class="product-price">
					<?php
					if ( edd_has_variable_prices( get_the_ID() ) ) {
						echo edd_price_range( get_the_ID() );
					} else {
						edd_price( get_the_ID() );
					}
					?>
				</div>
			<?php }
			the_content();
			?>
		</div>

		<div class="product-category">
			<?php the_terms( get_the_ID(), 'download_category', 'Categories:&nbsp;&nbsp;', ', ', '' ); ?>
		</div>
	</div>
</div>

<section class="testimonial-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="testimonial-slides text-center">
					<?php
					$cd_testimonial = new WP_Query(
					array(
						'posts_per_page' => $testimonial_atts['limit'],
						'post_type'      => 'download'
					) );

					if ( $cd_testimonial->have_posts() ) :
						while ( $cd_testimonial->have_posts() ) :
							$cd_testimonial->the_post();
							?>
							<div class="single-testimonial">
								<div class="single-testimonial-content">
									<?php the_content(); ?>
								</div>

								<?php if ( has_post_thumbnail() ) {
									the_post_thumbnail();
								} else {
									?>
									<img src="<?php echo get_template_directory_uri() ?>/assets/images/avatar.png"
									     alt="<?php echo esc_attr( the_title() ); ?>">
									<?php
								}
								?>

								<h6 class="testimonial-author"><?php the_title(); ?></h6>
							</div>
						<?php
						endwhile;
						wp_reset_postdata();
					endif;
					?>
				</div>
			</div>
		</div>
	</div>
</section>

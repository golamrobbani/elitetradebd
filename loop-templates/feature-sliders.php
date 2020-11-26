<section class="feature-area">
	
	<div class="feature-inner">
		<div class="feature-sliders text-center">
			<?php
			$featured_posts = get_posts( [
				'posts_per_page' => 10,
				'post_type'      => 'download',
				'post_status'    => 'publish',
				'meta_key'       => '_slider_active',
				'meta_value'     => '1',
			] );
			if ( ! empty( $featured_posts ) ) {
				foreach ( $featured_posts as $post ) {
					$slider_image=get_post_meta( $post->ID,'_slider_image', true);
					$slider_background=get_post_meta( $post->ID,'_slider_background', true);

					?>
					<div style="background-color: <?php echo !empty($slider_background)?$slider_background:'#ddd';?>">
						<div class="container">
							<div class="row">
								<div class="col-md-10 col-sm-10 col-md-offset-2 col-sm-offset-2">
									<div class="single-feature">
										<?php

										if (!empty($slider_image)) {?>
											<a href="<?php echo get_the_permalink($post);?>" title="<?php echo get_the_title($post); ?>"><img src="<?php echo $slider_image?>"
											alt="<?php echo get_the_title($post); ?>"></a>
											<?php
										}else{?>
											<a href="<?php echo get_the_permalink($post);?>" title="<?php echo get_the_title($post); ?>"><?php echo get_the_post_thumbnail($post,'product-slider-thumb');?></a>
										<?php }
										?>
									</div>
								</div>
							</div>

						</div>
					</div>
					<?php
				}
			}
			?>



		</div>

		<div class="catagory-listing-menu">
			<?php wp_nav_menu( array(
				'theme_location'  => 'listing_menu',
				'menu'            => 'Listing Menu',
				'menu_class'      => 'listing',
				'menu_id'         => 'listing-menu',
				'fallback_cb'     => 'wp_page_menu',
				'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',

			) ); ?>
		</div>



			<!-- <div class="catagory-listing-menu">


				<ul class="listing">
					<li><a href="#">menu1</a>
						<ul class="sub-menu">
							<li>
								<a href="#">submenu1</a>
								<ul class="sub-menu">
									<li><a href="#">submenu1</a></li>
									<li><a href="#">submenu1</a></li>
								</ul>
							</li>
							<li><a href="#">submenu1</a></li>
							<li><a href="#">submenu1</a></li>
						</ul>
					</li>
					<li><a href="#">menu1</a></li>
					<li><a href="#">menu1</a></li>
				</ul>


			</div> -->


		</div>
	</section>
